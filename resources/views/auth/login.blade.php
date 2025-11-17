<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - IMPEERCOL</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/logo/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, #cd0b0b 0%, #c60e0e 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* Efecto de fondo decorativo */
        body::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: pulse 15s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }

        .login-container {
            max-width: 480px;
            width: 100%;
            position: relative;
            z-index: 1;
        }

        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            background: linear-gradient(135deg, #cd0b0b 0%, #c60e0e 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
        }

        .login-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        }

        .logo-container {
            margin-bottom: 20px;
        }

        .logo-container img {
            max-width: 180px;
            height: auto;
            filter: brightness(0) invert(1);
        }

        .login-header h2 {
            margin: 0;
            font-weight: 700;
            font-size: 1.8rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .login-header p {
            margin: 10px 0 0;
            opacity: 0.9;
            font-size: 0.95rem;
        }

        .login-body {
            padding: 40px 35px;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }

        .form-label i {
            color: #cd0b0b;
            margin-right: 6px;
        }

        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #cd0b0b;
            box-shadow: 0 0 0 0.2rem rgba(205, 11, 11, 0.15);
            outline: none;
        }

        .form-control::placeholder {
            color: #999;
        }

        .form-check {
            margin-top: 5px;
        }

        .form-check-input:checked {
            background-color: #cd0b0b;
            border-color: #cd0b0b;
        }

        .form-check-label {
            font-weight: 500;
            color: #555;
            font-size: 0.9rem;
        }

        .btn-login {
            background: linear-gradient(135deg, #cd0b0b 0%, #c60e0e 100%);
            border: none;
            padding: 14px;
            font-weight: 600;
            font-size: 1.05rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 10px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(205, 11, 11, 0.4);
            background: linear-gradient(135deg, #c60e0e 0%, #cd0b0b 100%);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .back-link {
            color: #cd0b0b;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .back-link:hover {
            color: #c60e0e;
            transform: translateX(-3px);
        }

        .alert {
            border-radius: 10px;
            border: none;
            padding: 12px 15px;
            margin-bottom: 20px;
        }

        .invalid-feedback {
            display: block;
            font-size: 0.875rem;
            margin-top: 5px;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .login-body {
                padding: 30px 25px;
            }

            .login-header {
                padding: 30px 20px;
            }

            .logo-container img {
                max-width: 150px;
            }

            .login-header h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo-container">
                    <img src="{{ asset('assets/img/logo/logo-white.png') }}" alt="IMPEERCOL Logo">
                </div>
                <h2>Acceso al Sistema</h2>
                <p>Ingresa tus credenciales para continuar</p>
            </div>
            <div class="login-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">
                            <i class="bi bi-envelope"></i> Correo Electrónico
                        </label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autofocus
                               placeholder="tu@email.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">
                            <i class="bi bi-lock"></i> Contraseña
                        </label>
                        <input type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               id="password" 
                               name="password" 
                               required
                               placeholder="••••••••">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">
                            Recordarme en este dispositivo
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-login w-100">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Iniciar Sesión
                    </button>
                </form>

                <div class="text-center mt-4">
                    <a href="{{ route('web.home') }}" class="back-link">
                        <i class="bi bi-arrow-left"></i> Volver al sitio web
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

