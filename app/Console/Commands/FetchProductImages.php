<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\Brand;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use DOMDocument;
use DOMXPath;

class FetchProductImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:fetch-images 
                            {--brand= : Filtrar por marca específica (mapei, sika)}
                            {--limit= : Limitar número de productos a procesar}
                            {--dry-run : Solo mostrar qué productos se procesarían sin descargar imágenes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Busca y descarga imágenes de productos sin imagen de las marcas Mapei y Sika desde sus sitios web oficiales';

    /**
     * URLs base de los sitios web
     */
    private $baseUrls = [
        'mapei' => 'https://www.mapei.com',
        'sika' => 'https://col.sika.com',
    ];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 Buscando productos sin imagen de marcas Mapei y Sika...');

        // Obtener productos sin imagen
        $query = Product::where(function ($q) {
            $q->whereNull('image')
              ->orWhere('image', '')
              ->orWhere('image', 'assets/img/product/1.png'); // Imagen por defecto
        })
        ->whereHas('brand', function ($q) {
            $q->where(function ($subQ) {
                $subQ->where('name', 'LIKE', '%mapei%')
                     ->orWhere('name', 'LIKE', '%Mapei%')
                     ->orWhere('name', 'LIKE', '%MAPEI%')
                     ->orWhere('name', 'LIKE', '%sika%')
                     ->orWhere('name', 'LIKE', '%Sika%')
                     ->orWhere('name', 'LIKE', '%SIKA%');
            });
        });

        // Filtrar por marca específica si se proporciona
        $brandFilter = $this->option('brand');
        if ($brandFilter) {
            $brandFilter = strtolower($brandFilter);
            $query->whereHas('brand', function ($q) use ($brandFilter) {
                $q->where('name', 'LIKE', "%{$brandFilter}%");
            });
        }

        // Limitar resultados si se especifica
        $limit = $this->option('limit');
        if ($limit) {
            $query->limit((int) $limit);
        }

        $products = $query->with('brand')->get();

        // #region agent log
        $logPath = base_path('.cursor/debug.log');
        file_put_contents($logPath, json_encode([
            'id' => 'log_' . time() . '_' . uniqid(),
            'timestamp' => time() * 1000,
            'location' => 'FetchProductImages.php:80',
            'message' => 'Productos encontrados sin imagen',
            'data' => ['count' => $products->count(), 'brand_filter' => $brandFilter ?? null, 'limit' => $limit ?? null],
            'runId' => 'run1',
            'hypothesisId' => 'A'
        ]) . "\n", FILE_APPEND);
        // #endregion

        if ($products->isEmpty()) {
            $this->info('✅ No se encontraron productos sin imagen de las marcas Mapei o Sika.');
            return Command::SUCCESS;
        }

        $this->info("📦 Se encontraron {$products->count()} producto(s) sin imagen.");
        
        if ($this->option('dry-run')) {
            $this->warn('🔍 MODO DRY-RUN: No se descargarán imágenes, solo se mostrará información.');
        }

        $this->newLine();

        $successCount = 0;
        $failedCount = 0;
        $skippedCount = 0;

        $progressBar = $this->output->createProgressBar($products->count());
        $progressBar->start();

        foreach ($products as $product) {
            $progressBar->advance();
            
            try {
                $brandName = strtolower($product->brand->name ?? '');
                
                // #region agent log
                $logPath = base_path('.cursor/debug.log');
                file_put_contents($logPath, json_encode([
                    'id' => 'log_' . time() . '_' . uniqid(),
                    'timestamp' => time() * 1000,
                    'location' => 'FetchProductImages.php:105',
                    'message' => 'Procesando producto',
                    'data' => ['product_id' => $product->id, 'product_name' => $product->name, 'brand_name' => $product->brand->name ?? null],
                    'runId' => 'run1',
                    'hypothesisId' => 'A'
                ]) . "\n", FILE_APPEND);
                // #endregion
                
                // Determinar qué marca es
                $brandType = null;
                if (str_contains($brandName, 'mapei')) {
                    $brandType = 'mapei';
                } elseif (str_contains($brandName, 'sika')) {
                    $brandType = 'sika';
                }

                // #region agent log
                file_put_contents($logPath, json_encode([
                    'id' => 'log_' . time() . '_' . uniqid(),
                    'timestamp' => time() * 1000,
                    'location' => 'FetchProductImages.php:114',
                    'message' => 'Marca determinada',
                    'data' => ['brand_type' => $brandType, 'brand_name' => $brandName],
                    'runId' => 'run1',
                    'hypothesisId' => 'B'
                ]) . "\n", FILE_APPEND);
                // #endregion

                if (!$brandType) {
                    $skippedCount++;
                    continue;
                }

                if ($this->option('dry-run')) {
                    $this->newLine();
                    $this->line("  📋 Producto: {$product->name} (Marca: {$product->brand->name})");
                    $this->line("  🔗 Buscaría en: {$this->baseUrls[$brandType]}");
                    continue;
                }

                // Buscar y descargar imagen
                $imageUrl = $this->searchProductImage($product, $brandType);

                // #region agent log
                $logPath = base_path('.cursor/debug.log');
                file_put_contents($logPath, json_encode([
                    'id' => 'log_' . time() . '_' . uniqid(),
                    'timestamp' => time() * 1000,
                    'location' => 'FetchProductImages.php:129',
                    'message' => 'Imagen encontrada',
                    'data' => ['image_url' => $imageUrl ? substr($imageUrl, 0, 100) : null, 'product_id' => $product->id],
                    'runId' => 'run1',
                    'hypothesisId' => 'C'
                ]) . "\n", FILE_APPEND);
                // #endregion

                if ($imageUrl) {
                    $savedPath = $this->downloadAndSaveImage($imageUrl, $product, $brandType);
                    
                    // #region agent log
                    file_put_contents($logPath, json_encode([
                        'id' => 'log_' . time() . '_' . uniqid(),
                        'timestamp' => time() * 1000,
                        'location' => 'FetchProductImages.php:133',
                        'message' => 'Imagen guardada',
                        'data' => ['saved_path' => $savedPath, 'product_id' => $product->id],
                        'runId' => 'run1',
                        'hypothesisId' => 'D'
                    ]) . "\n", FILE_APPEND);
                    // #endregion
                    
                    if ($savedPath) {
                        $product->image = $savedPath;
                        $product->save();
                        $successCount++;
                    } else {
                        $failedCount++;
                    }
                } else {
                    $failedCount++;
                }

                // Pequeña pausa para no sobrecargar los servidores
                usleep(500000); // 0.5 segundos

            } catch (\Exception $e) {
                // #region agent log
                $logPath = base_path('.cursor/debug.log');
                file_put_contents($logPath, json_encode([
                    'id' => 'log_' . time() . '_' . uniqid(),
                    'timestamp' => time() * 1000,
                    'location' => 'FetchProductImages.php:148',
                    'message' => 'Error procesando producto',
                    'data' => ['product_id' => $product->id, 'product_name' => $product->name, 'error' => $e->getMessage(), 'trace' => substr($e->getTraceAsString(), 0, 200)],
                    'runId' => 'run1',
                    'hypothesisId' => 'G'
                ]) . "\n", FILE_APPEND);
                // #endregion
                
                $failedCount++;
                if ($this->option('verbose')) {
                    $this->newLine();
                    $this->error("  ❌ Error con producto {$product->name}: " . $e->getMessage());
                }
            }
        }

        $progressBar->finish();
        $this->newLine(2);

        // Resumen
        $this->info('📊 Resumen:');
        $this->table(
            ['Estado', 'Cantidad'],
            [
                ['✅ Exitosos', $successCount],
                ['❌ Fallidos', $failedCount],
                ['⏭️  Omitidos', $skippedCount],
                ['📦 Total', $products->count()],
            ]
        );

        return Command::SUCCESS;
    }

    /**
     * Busca la URL de la imagen del producto en el sitio web de la marca
     */
    private function searchProductImage(Product $product, string $brandType): ?string
    {
        try {
            $baseUrl = $this->baseUrls[$brandType];
            
            // Estrategia 1: Buscar en el sitio web oficial
            $searchUrl = $this->buildSearchUrl($product, $brandType);
            
            if ($searchUrl) {
                $imageUrl = $this->searchInWebsite($searchUrl, $product, $brandType, $baseUrl);
                if ($imageUrl) {
                    return $imageUrl;
                }
            }

            // Estrategia 2: Buscar usando Google Images (fallback)
            // #region agent log
            $logPath = base_path('.cursor/debug.log');
            file_put_contents($logPath, json_encode([
                'id' => 'log_' . time() . '_' . uniqid(),
                'timestamp' => time() * 1000,
                'location' => 'FetchProductImages.php:269',
                'message' => 'Intentando búsqueda en Google Images',
                'data' => ['product_id' => $product->id, 'product_name' => $product->name, 'brand_type' => $brandType],
                'runId' => 'run1',
                'hypothesisId' => 'H'
            ]) . "\n", FILE_APPEND);
            // #endregion
            
            $imageUrl = $this->searchInGoogleImages($product, $brandType);
            
            // #region agent log
            file_put_contents($logPath, json_encode([
                'id' => 'log_' . time() . '_' . uniqid(),
                'timestamp' => time() * 1000,
                'location' => 'FetchProductImages.php:275',
                'message' => 'Resultado de Google Images',
                'data' => ['image_url' => $imageUrl ? substr($imageUrl, 0, 100) : null, 'product_id' => $product->id],
                'runId' => 'run1',
                'hypothesisId' => 'H'
            ]) . "\n", FILE_APPEND);
            // #endregion
            
            if ($imageUrl) {
                return $imageUrl;
            }

            return null;

        } catch (\Exception $e) {
            if ($this->option('verbose')) {
                $this->error("Error buscando imagen: " . $e->getMessage());
            }
            return null;
        }
    }

    /**
     * Busca imagen en el sitio web oficial
     */
    private function searchInWebsite(string $searchUrl, Product $product, string $brandType, string $baseUrl): ?string
    {
        try {
            // #region agent log
            $logPath = base_path('.cursor/debug.log');
            file_put_contents($logPath, json_encode([
                'id' => 'log_' . time() . '_' . uniqid(),
                'timestamp' => time() * 1000,
                'location' => 'FetchProductImages.php:212',
                'message' => 'Buscando en sitio web',
                'data' => ['search_url' => $searchUrl, 'product_id' => $product->id],
                'runId' => 'run1',
                'hypothesisId' => 'F'
            ]) . "\n", FILE_APPEND);
            // #endregion
            
            // Hacer petición HTTP
            $response = Http::timeout(30)
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                    'Accept-Language' => 'es-ES,es;q=0.9,en;q=0.8',
                ])
                ->get($searchUrl);

            // #region agent log
            file_put_contents($logPath, json_encode([
                'id' => 'log_' . time() . '_' . uniqid(),
                'timestamp' => time() * 1000,
                'location' => 'FetchProductImages.php:224',
                'message' => 'Respuesta HTTP recibida',
                'data' => ['status' => $response->status(), 'successful' => $response->successful(), 'url' => $searchUrl],
                'runId' => 'run1',
                'hypothesisId' => 'F'
            ]) . "\n", FILE_APPEND);
            // #endregion

            if (!$response->successful()) {
                return null;
            }

            $html = $response->body();

            // Parsear HTML para encontrar imagen
            $imageUrl = $this->extractImageFromHtml($html, $product, $brandType, $baseUrl);
            
            // #region agent log
            file_put_contents($logPath, json_encode([
                'id' => 'log_' . time() . '_' . uniqid(),
                'timestamp' => time() * 1000,
                'location' => 'FetchProductImages.php:231',
                'message' => 'Imagen extraída del HTML',
                'data' => ['image_url' => $imageUrl ? substr($imageUrl, 0, 100) : null, 'html_length' => strlen($html)],
                'runId' => 'run1',
                'hypothesisId' => 'F'
            ]) . "\n", FILE_APPEND);
            // #endregion
            
            return $imageUrl;

        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Busca imagen usando Google Images como fallback
     */
    private function searchInGoogleImages(Product $product, string $brandType): ?string
    {
        try {
            $logPath = base_path('.cursor/debug.log');
            
            $brandName = $brandType === 'mapei' ? 'Mapei' : 'Sika';
            $searchQuery = urlencode("{$brandName} {$product->name} producto");
            
            // Usar Google Images (sin API, scraping básico)
            $googleUrl = "https://www.google.com/search?tbm=isch&q={$searchQuery}";
            
            // #region agent log
            file_put_contents($logPath, json_encode([
                'id' => 'log_' . time() . '_' . uniqid(),
                'timestamp' => time() * 1000,
                'location' => 'FetchProductImages.php:389',
                'message' => 'Buscando en Google Images',
                'data' => ['google_url' => $googleUrl, 'search_query' => $searchQuery, 'product_id' => $product->id],
                'runId' => 'run1',
                'hypothesisId' => 'H'
            ]) . "\n", FILE_APPEND);
            // #endregion
            
            $response = Http::timeout(30)
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                    'Accept-Language' => 'es-ES,es;q=0.9,en;q=0.8',
                ])
                ->get($googleUrl);

            // #region agent log
            file_put_contents($logPath, json_encode([
                'id' => 'log_' . time() . '_' . uniqid(),
                'timestamp' => time() * 1000,
                'location' => 'FetchProductImages.php:395',
                'message' => 'Respuesta de Google Images',
                'data' => ['status' => $response->status(), 'successful' => $response->successful(), 'html_length' => strlen($response->body())],
                'runId' => 'run1',
                'hypothesisId' => 'H'
            ]) . "\n", FILE_APPEND);
            // #endregion

            if (!$response->successful()) {
                return null;
            }

            // Buscar URLs de imágenes en el HTML (Google Images usa datos JSON embebidos)
            $html = $response->body();
            
            // Múltiples patrones para extraer URLs de imágenes de Google
            // Excluir explícitamente .jfif por baja calidad
            $patterns = [
                '/"ou":"([^"]+\.(jpg|jpeg|png|gif|webp))"/i',
                '/"originalUrl":"([^"]+\.(jpg|jpeg|png|gif|webp))"/i',
                '/\["(https?:\/\/[^"]+\.(jpg|jpeg|png|gif|webp))"/i',
                '/src="(https?:\/\/[^"]+\.(jpg|jpeg|png|gif|webp))"/i',
            ];
            
            $allMatches = [];
            foreach ($patterns as $pattern) {
                preg_match_all($pattern, $html, $matches);
                if (!empty($matches[1])) {
                    $allMatches = array_merge($allMatches, $matches[1]);
                }
            }
            
            // Filtrar explícitamente URLs con .jfif (por si alguna se coló)
            $allMatches = array_filter($allMatches, function($url) {
                $extension = strtolower(pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION));
                return $extension !== 'jfif';
            });
            
            // #region agent log
            file_put_contents($logPath, json_encode([
                'id' => 'log_' . time() . '_' . uniqid(),
                'timestamp' => time() * 1000,
                'location' => 'FetchProductImages.php:420',
                'message' => 'URLs encontradas en Google Images',
                'data' => ['matches_count' => count($allMatches), 'first_url' => !empty($allMatches[0]) ? substr($allMatches[0], 0, 100) : null],
                'runId' => 'run1',
                'hypothesisId' => 'H'
            ]) . "\n", FILE_APPEND);
            // #endregion
            
            if (!empty($allMatches)) {
                // Tomar la primera imagen que parezca ser del producto
                foreach ($allMatches as $imageUrl) {
                    // Limpiar la URL
                    $imageUrl = str_replace(['\\u003d', '\\u0026'], ['=', '&'], $imageUrl);
                    $imageUrl = stripslashes($imageUrl);
                    
                    if ($this->isValidImageUrl($imageUrl)) {
                        // Verificar que la URL no sea de un sitio genérico
                        if (str_contains(strtolower($imageUrl), strtolower($brandName)) || 
                            str_contains(strtolower($imageUrl), 'mapei.com') ||
                            str_contains(strtolower($imageUrl), 'sika.com')) {
                            // #region agent log
                            file_put_contents($logPath, json_encode([
                                'id' => 'log_' . time() . '_' . uniqid(),
                                'timestamp' => time() * 1000,
                                'location' => 'FetchProductImages.php:432',
                                'message' => 'Imagen encontrada del sitio oficial',
                                'data' => ['image_url' => substr($imageUrl, 0, 100)],
                                'runId' => 'run1',
                                'hypothesisId' => 'H'
                            ]) . "\n", FILE_APPEND);
                            // #endregion
                            return $imageUrl;
                        }
                    }
                }
                
                // Si no encontramos una del sitio oficial, usar la primera válida
                if (!empty($allMatches[0])) {
                    $firstUrl = $allMatches[0];
                    $firstUrl = str_replace(['\\u003d', '\\u0026'], ['=', '&'], $firstUrl);
                    $firstUrl = stripslashes($firstUrl);
                    
                    if ($this->isValidImageUrl($firstUrl)) {
                        // #region agent log
                        file_put_contents($logPath, json_encode([
                            'id' => 'log_' . time() . '_' . uniqid(),
                            'timestamp' => time() * 1000,
                            'location' => 'FetchProductImages.php:448',
                            'message' => 'Usando primera imagen válida',
                            'data' => ['image_url' => substr($firstUrl, 0, 100)],
                            'runId' => 'run1',
                            'hypothesisId' => 'H'
                        ]) . "\n", FILE_APPEND);
                        // #endregion
                        return $firstUrl;
                    }
                }
            }

            return null;

        } catch (\Exception $e) {
            // #region agent log
            $logPath = base_path('.cursor/debug.log');
            file_put_contents($logPath, json_encode([
                'id' => 'log_' . time() . '_' . uniqid(),
                'timestamp' => time() * 1000,
                'location' => 'FetchProductImages.php:460',
                'message' => 'Error en Google Images',
                'data' => ['error' => $e->getMessage()],
                'runId' => 'run1',
                'hypothesisId' => 'H'
            ]) . "\n", FILE_APPEND);
            // #endregion
            return null;
        }
    }

    /**
     * Construye la URL de búsqueda según la marca
     */
    private function buildSearchUrl(Product $product, string $brandType): ?string
    {
        $productName = $product->name;
        $baseUrl = $this->baseUrls[$brandType];

        // #region agent log
        $logPath = base_path('.cursor/debug.log');
        file_put_contents($logPath, json_encode([
            'id' => 'log_' . time() . '_' . uniqid(),
            'timestamp' => time() * 1000,
            'location' => 'FetchProductImages.php:299',
            'message' => 'Construyendo URL de búsqueda',
            'data' => ['product_name' => $productName, 'brand_type' => $brandType, 'base_url' => $baseUrl],
            'runId' => 'run1',
            'hypothesisId' => 'E'
        ]) . "\n", FILE_APPEND);
        // #endregion

        if ($brandType === 'mapei') {
            // Para Mapei, intentar buscar en el catálogo
            // Estrategia 1: Buscar directamente por nombre
            $slug = Str::slug($productName);
            $urls = [
                "{$baseUrl}/co/es-co/productos/{$slug}",
                "{$baseUrl}/co/es-co/productos/{$slug}.html",
                "{$baseUrl}/co/es-co/productos?q=" . urlencode($productName),
            ];
            
            // Probar cada URL hasta encontrar una que funcione
            $selectedUrl = null;
            foreach ($urls as $url) {
                // #region agent log
                file_put_contents($logPath, json_encode([
                    'id' => 'log_' . time() . '_' . uniqid(),
                    'timestamp' => time() * 1000,
                    'location' => 'FetchProductImages.php:316',
                    'message' => 'Probando URL',
                    'data' => ['url' => $url, 'brand_type' => $brandType],
                    'runId' => 'run1',
                    'hypothesisId' => 'E'
                ]) . "\n", FILE_APPEND);
                // #endregion
                
                $response = Http::timeout(10)->head($url);
                if ($response->successful()) {
                    $selectedUrl = $url;
                    break;
                }
            }
            
            // Si ninguna funciona, retornar la primera para intentar parsear
            $finalUrl = $selectedUrl ?? $urls[0];
            
            // #region agent log
            file_put_contents($logPath, json_encode([
                'id' => 'log_' . time() . '_' . uniqid(),
                'timestamp' => time() * 1000,
                'location' => 'FetchProductImages.php:323',
                'message' => 'URL seleccionada',
                'data' => ['final_url' => $finalUrl],
                'runId' => 'run1',
                'hypothesisId' => 'E'
            ]) . "\n", FILE_APPEND);
            // #endregion
            
            return $finalUrl;
            
        } elseif ($brandType === 'sika') {
            // Para Sika, intentar buscar en el catálogo
            $searchQuery = urlencode($productName);
            $urls = [
                "{$baseUrl}/search?q={$searchQuery}",
                "{$baseUrl}/productos?q={$searchQuery}",
                "{$baseUrl}/productos/{$searchQuery}",
            ];
            
            // Probar cada URL
            foreach ($urls as $url) {
                $response = Http::timeout(10)->head($url);
                if ($response->successful()) {
                    return $url;
                }
            }
            
            return $urls[0];
        }

        return null;
    }

    /**
     * Extrae la URL de la imagen del HTML
     */
    private function extractImageFromHtml(string $html, Product $product, string $brandType, string $baseUrl): ?string
    {
        try {
            // Suprimir errores de HTML mal formado
            libxml_use_internal_errors(true);
            
            $dom = new DOMDocument();
            @$dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
            
            $xpath = new DOMXPath($dom);

            // Estrategias de búsqueda según la marca
            $imageSelectors = $this->getImageSelectors($brandType);

            foreach ($imageSelectors as $selector) {
                $nodes = $xpath->query($selector['xpath']);
                
                foreach ($nodes as $node) {
                    $imageUrl = null;
                    
                    // Si el XPath retorna un atributo (@src), usar nodeValue
                    // Si retorna un elemento, usar getAttribute
                    if ($node instanceof \DOMAttr) {
                        $imageUrl = $node->nodeValue;
                    } elseif ($node instanceof \DOMElement) {
                        $imageUrl = $node->getAttribute('src');
                    } else {
                        $imageUrl = $node->nodeValue;
                    }

                    if ($imageUrl) {
                        // Convertir URL relativa a absoluta
                        $imageUrl = $this->makeAbsoluteUrl($imageUrl, $baseUrl);
                        
                        // Validar que sea una URL de imagen válida
                        if ($this->isValidImageUrl($imageUrl)) {
                            return $imageUrl;
                        }
                    }
                }
            }

            // Si no se encuentra con selectores específicos, buscar cualquier imagen grande
            $imgNodes = $xpath->query("//img[@src]");
            foreach ($imgNodes as $imgNode) {
                if ($imgNode instanceof \DOMElement) {
                    $src = $imgNode->getAttribute('src');
                    $alt = strtolower($imgNode->getAttribute('alt') ?? '');
                    $productNameLower = strtolower($product->name);
                    
                    // Si el alt contiene el nombre del producto, es probable que sea la imagen correcta
                    if (str_contains($alt, $productNameLower) || 
                        str_contains($alt, strtolower(Str::slug($product->name, ' ')))) {
                        $imageUrl = $this->makeAbsoluteUrl($src, $baseUrl);
                        if ($this->isValidImageUrl($imageUrl)) {
                            return $imageUrl;
                        }
                    }
                }
            }

            return null;

        } catch (\Exception $e) {
            if ($this->option('verbose')) {
                $this->error("Error extrayendo imagen del HTML: " . $e->getMessage());
            }
            return null;
        }
    }

    /**
     * Obtiene los selectores XPath según la marca
     */
    private function getImageSelectors(string $brandType): array
    {
        if ($brandType === 'mapei') {
            return [
                ['xpath' => "//img[contains(@class, 'product-image')]/@src", 'attribute' => null],
                ['xpath' => "//img[contains(@class, 'product-img')]/@src", 'attribute' => null],
                ['xpath' => "//div[contains(@class, 'product-image')]//img/@src", 'attribute' => null],
                ['xpath' => "//picture//img/@src", 'attribute' => null],
                ['xpath' => "//img[contains(@src, 'product')]/@src", 'attribute' => null],
            ];
        } elseif ($brandType === 'sika') {
            return [
                ['xpath' => "//img[contains(@class, 'product-image')]/@src", 'attribute' => null],
                ['xpath' => "//img[contains(@class, 'product-img')]/@src", 'attribute' => null],
                ['xpath' => "//div[contains(@class, 'product-image')]//img/@src", 'attribute' => null],
                ['xpath' => "//picture//img/@src", 'attribute' => null],
                ['xpath' => "//img[contains(@src, 'product')]/@src", 'attribute' => null],
            ];
        }

        return [];
    }

    /**
     * Convierte una URL relativa en absoluta
     */
    private function makeAbsoluteUrl(string $url, string $baseUrl): string
    {
        // Si ya es absoluta, retornarla
        if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://')) {
            return $url;
        }

        // Si empieza con //, agregar https:
        if (str_starts_with($url, '//')) {
            return 'https:' . $url;
        }

        // Si empieza con /, es relativa al dominio
        if (str_starts_with($url, '/')) {
            $parsed = parse_url($baseUrl);
            return $parsed['scheme'] . '://' . $parsed['host'] . $url;
        }

        // URL relativa, agregar base
        return rtrim($baseUrl, '/') . '/' . ltrim($url, '/');
    }

    /**
     * Valida si una URL es una imagen válida
     */
    private function isValidImageUrl(string $url): bool
    {
        // Verificar extensión
        $extension = strtolower(pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION));
        
        // Rechazar explícitamente .jfif por baja calidad
        if ($extension === 'jfif') {
            // #region agent log
            $logPath = base_path('.cursor/debug.log');
            file_put_contents($logPath, json_encode([
                'id' => 'log_' . time() . '_' . uniqid(),
                'timestamp' => time() * 1000,
                'location' => 'FetchProductImages.php:757',
                'message' => 'Imagen .jfif rechazada por baja calidad',
                'data' => ['url' => substr($url, 0, 100), 'extension' => $extension],
                'runId' => 'run1',
                'hypothesisId' => 'I'
            ]) . "\n", FILE_APPEND);
            // #endregion
            return false;
        }
        
        $validExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
        
        if (!in_array($extension, $validExtensions)) {
            return false;
        }

        // Verificar que no sea un icono pequeño o logo
        $urlLower = strtolower($url);
        $excludedTerms = ['logo', 'icon', 'favicon', 'thumbnail', 'thumb'];
        
        foreach ($excludedTerms as $term) {
            if (str_contains($urlLower, $term)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Descarga y guarda la imagen en storage
     */
    private function downloadAndSaveImage(string $imageUrl, Product $product, string $brandType): ?string
    {
        try {
            // Descargar imagen
            $response = Http::timeout(30)
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                ])
                ->get($imageUrl);

            if (!$response->successful()) {
                return null;
            }

            $imageContent = $response->body();
            
            // Determinar extensión
            $extension = strtolower(pathinfo(parse_url($imageUrl, PHP_URL_PATH), PATHINFO_EXTENSION));
            
            // Rechazar .jfif explícitamente
            if ($extension === 'jfif') {
                // #region agent log
                $logPath = base_path('.cursor/debug.log');
                file_put_contents($logPath, json_encode([
                    'id' => 'log_' . time() . '_' . uniqid(),
                    'timestamp' => time() * 1000,
                    'location' => 'FetchProductImages.php:797',
                    'message' => 'Imagen .jfif rechazada al descargar',
                    'data' => ['url' => substr($imageUrl, 0, 100), 'product_id' => $product->id],
                    'runId' => 'run1',
                    'hypothesisId' => 'I'
                ]) . "\n", FILE_APPEND);
                // #endregion
                return null; // Rechazar la descarga
            }
            
            if (!in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                $extension = 'jpg'; // Por defecto
            }

            // Generar nombre único
            $year = date('Y');
            $month = date('m');
            $productSlug = Str::slug($product->name);
            $fileName = "{$productSlug}_{$brandType}_" . time() . '_' . Str::random(8) . '.' . $extension;
            
            // Ruta de almacenamiento (misma estructura que FileUploadController)
            $path = "products/images/{$year}/{$month}/{$fileName}";

            // Guardar en storage
            $saved = Storage::disk('public')->put($path, $imageContent);

            if (!$saved) {
                return null;
            }

            return $path;

        } catch (\Exception $e) {
            if ($this->option('verbose')) {
                $this->error("Error descargando imagen: " . $e->getMessage());
            }
            return null;
        }
    }
}

