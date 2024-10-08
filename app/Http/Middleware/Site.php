<?php

namespace App\Http\Middleware;

use App\Http\Service\LanguageService;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Site
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $data['languages'] = LanguageService::getAll();
        $data['users'] = User::all();
        view()->share($data);
        return $next($request);
    }
}
