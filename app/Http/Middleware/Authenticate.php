<?php
namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Jika request mengharapkan JSON, jangan redirect
        if ($request->expectsJson()) {
            return null;
        }

        // Redirect berdasarkan prefix URI
        if ($request->is('backend/*')) {
            return route('backend.login');  // Login backend/admin
        } elseif ($request->is('customer/*') || $request->is('keranjang*')) {
            return route('customer.login'); // Login customer
        }

        // Default redirect ke login customer
        return route('customer.login');
    }
}
