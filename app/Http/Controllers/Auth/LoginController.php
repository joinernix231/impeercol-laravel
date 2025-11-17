<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

/**
 * ============================================
 * CONTROLADOR: LoginController
 * ============================================
 * 
 * Maneja la autenticación de usuarios (login/logout).
 * Redirige según el rol del usuario después del login.
 */
class LoginController extends Controller
{
    /**
     * Muestra el formulario de login
     */
    public function showLoginForm()
    {
        // Si ya está autenticado, redirigir según su rol
        if (Auth::check()) {
            return $this->redirectByRole();
        }

        return view('auth.login');
    }

    /**
     * Procesa el login
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return $this->redirectByRole()
                ->with('success', '¡Bienvenido! Has iniciado sesión correctamente.');
        }

        throw ValidationException::withMessages([
            'email' => 'Las credenciales proporcionadas no son correctas.',
        ]);
    }

    /**
     * Cierra la sesión del usuario
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Has cerrado sesión correctamente.');
    }

    /**
     * Redirige al usuario según su rol
     */
    private function redirectByRole()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isCliente()) {
            return redirect()->route('cliente.dashboard');
        }

        // Por defecto, redirigir al home
        return redirect()->route('web.home');
    }
}
