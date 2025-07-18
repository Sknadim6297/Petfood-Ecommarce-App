<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(Request $request): View
    {
        // Store the redirect URL in session if provided
        if ($request->has('redirect')) {
            $request->session()->put('url.intended', $request->get('redirect'));
        }
        
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Migrate session cart to database after successful login
        $cartController = new CartController();
        $cartController->migrateSessionCartToDatabase();

        // Check if there's an intended URL from the form or session
        $intendedUrl = $request->input('intended_url') ?: $request->session()->get('url.intended');
        
        if ($intendedUrl && filter_var($intendedUrl, FILTER_VALIDATE_URL)) {
            // Remove the intended URL from session
            $request->session()->forget('url.intended');
            return redirect($intendedUrl);
        }

        // Redirect to intended page or home if no intended page
        return redirect()->intended('/');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
