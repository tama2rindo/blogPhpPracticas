<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next){
        if (auth()->check()) {
            $user = User::with('role')->find(auth()->id()); 

            // Log user and role details for debugging
            Log::info('User: ', ['user' => $user]);

            // Check if the user is an admin
            if ($user && $user->isAdmin()) {
                return $next($request);
        }
        
        return redirect('/')->with('error', 'Unauthorized');

    }   
}

        
    
}
