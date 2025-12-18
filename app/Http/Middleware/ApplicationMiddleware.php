<?php

namespace App\Http\Middleware;

use App\Models\Application;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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
            return redirect()->route('application.inactive');
        }

        if($application->auth_required && ! Auth::check()){
            return redirect()->guest(route('login'));
        }

        if($application->auth_required && Auth::check()){
            $user = Auth::user();
            $user_application = $user->applications()->where('application_id', $application->id)->first();

            if ($user->company_id !== $application->company_id) {
                abort(403, __('Aplicación no autorizada.'));
            }

            if (! $user_application) {
                if (
                    ! Gate::check('viewSystemOwner', $user) &&
                    ! Gate::check('viewCompanyAdmin', $user) &&
                    ! Gate::check('viewDepartmentManager', $user)
                ) {
                    abort(403, __('Aplicación no autorizada.'));
                }
            }

           if ($user_application && ! $user_application->pivot->is_active) {
                return redirect()->route('application.answered');
            }
        }

        $request->attributes->set('application', $application);

        return $next($request);
    }
}
