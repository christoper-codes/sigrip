<?php

namespace App\Http\Middleware;

use App\Models\Application;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApplicationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $slug = $request->route('slug');
        $application = Application::where('slug', $slug)->firstOrFail();

        if(! $application->is_active){
            abort(403, __('Aplicación no activa.'));
        }

        if($application->auth_required && ! Auth::check()){
            return redirect()->route('login');
        }

        $request->attributes->set('application', $application);

        return $next($request);
    }
}
