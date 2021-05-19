<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ResponseController;
use Closure;

class RoleMiddleware
{

    public function handle($request, Closure $next, $role, $permission = null)
    {
        if(!$request->user()->hasRole($role)) {

            ResponseController::set_errors(true);
            ResponseController::set_messages('Sin permiso');
            return ResponseController::response('UNAUTHORIZED');

        }

        if($permission !== null && !$request->user()->can($permission)) {

            ResponseController::set_errors(true);
            ResponseController::set_messages('Sin permiso');
            return ResponseController::response('UNAUTHORIZED');
        }

        return $next($request);

    }
}
