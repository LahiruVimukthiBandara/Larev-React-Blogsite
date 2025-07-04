<?php

namespace App\Http\Controllers\Auth;

use App\Enums\RolesEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class AuthenticatedSessionController extends Controller {
    /**
    * Display the login view.
    */

    public function create(): Response {
        return Inertia::render( 'Auth/Login', [
            'canResetPassword' => Route::has( 'password.request' ),
            'status' => session( 'status' ),
        ] );
    }

    /**
    * Handle an incoming authentication request.
    */

    public function store( LoginRequest $request ): HttpFoundationResponse {
        $request->authenticate();

        $request->session()->regenerate();

        /* @var User $user */

        $user = Auth::user();

        if ( $user->hasAnyRole( [ RolesEnum::Admin->value, RolesEnum::Writer->value ] ) ) {
            return Inertia::location( '/admin' );
        } else {
            $route = route( 'home', absolute:false );
        }

        return redirect()->intended( $route );
    }

    /**
    * Destroy an authenticated session.
    */

    public function destroy( Request $request ): RedirectResponse {
        Auth::guard( 'web' )->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect( '/' );
    }
}
