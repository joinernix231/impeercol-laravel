# Impeercol – Corporate Web Platform 🏢

> Production platform for **Impeercol**, an impermeabilization company based in Bogotá, Colombia.  
> Live at: [impeercol.com.co](https://impeercol.com.co)

Built with Laravel 11 and Blade, this system handles the company's full digital presence — from a public-facing product catalog to a complete admin panel for content management.

---

## 🚀 What This Project Does

- **Public site** with product catalog (80+ SKUs across multiple brands: SIKA, MAPEI, METIC, CORONA)
- **Admin panel** for managing products, projects, categories, blog posts and images
- **File & image management** with symbolic storage links and organized folder structure
- **Authentication** with role-based access (admin vs public)
- **SEO-optimized** pages for impermeabilization products in Colombia
- **Full CRUD** operations with relational database logic and Eloquent ORM

---

## 🛠️ Tech Stack

| Layer | Technology |
|-------|-----------|
| Backend | Laravel 11, PHP 8.2 |
| Frontend | Blade, Vite, NPM |
| Database | MySQL |
| Auth | Laravel Auth + Role-based access |
| Storage | Laravel Storage + Symbolic Links |
| Deploy | Production server (live) |

---

## 📐 Architecture Decisions

- **MVC with service layer** — logic separated from controllers
- **Eloquent relationships** — Products → Variants → Categories with optimized queries
- **Storage structure** organized by entity (`projects/`, `products/`, `categories/`)
- **Environment-based config** — `.env.example` included, secrets never committed

---

## ⚙️ Local Setup

```bash
git clone https://github.com/joinernix231/impeercol-laravel
cd impeercol-laravel

composer install
cp .env.example .env
php artisan key:generate
```

Configure your `.env` database credentials, then:

```bash
php artisan migrate
php artisan db:seed        # optional sample data
php artisan storage:link   # required for image loading
npm install && npm run dev
php artisan serve
```

> ⚠️ `php artisan storage:link` is required. Without it, images won't load.

---

## 🗄️ Database Structure

| Table | Purpose |
|-------|---------|
| `users` | Admin authentication |
| `products` | Product catalog |
| `product_variants` | Product variants per SKU |
| `categories` | Product categorization |
| `projects` | Company project portfolio |

---

## 🔐 Create Admin User

```bash
php artisan tinker
```
```php
User::create([
    'name' => 'Admin',
    'email' => 'admin@example.com',
    'password' => bcrypt('password'),
    'role' => 'admin'
]);
```

---

## 📞 Contact

**Joiner Davila** — [joiner.backend@gmail.com](mailto:joiner.backend@gmail.com)  
Portfolio: [jdeveloper.netlify.app](https://jdeveloper.netlify.app)
