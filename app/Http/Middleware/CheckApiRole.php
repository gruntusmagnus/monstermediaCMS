<?php

namespace App\Http\Middleware;

use App\Employee;
use App\User;
use Closure;
use Illuminate\Auth\AuthenticationException;
use InvalidArgumentException;

class CheckApiRole
{
    protected $roles = [
        'employee' => Employee::class,
        'user'     => User::class
    ];

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param                          $requiredRole
     *
     * @return mixed
     * @throws AuthenticationException
     */
    public function handle($request, Closure $next, $requiredRole)
    {
        if (!auth('api')->check()) {
            throw new AuthenticationException('Unauthenticated.', ['api'], $this->redirectTo($request));
        }
        if (!isset($this->roles[$requiredRole])) {
            throw new InvalidArgumentException('Invalid role ' . $requiredRole);
        }

        $classname = $this->roles[$requiredRole];
        if (auth('api')->user()->authenticable instanceof $classname) {
            return $next($request);
        } else {
            throw new AuthenticationException('Unauthenticated.', ['api'], $this->redirectTo($request));
        }
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return string
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {

            if (strpos($request->url(), 'admin') !== false) {
                return route('admin.login');
            }

            return route('login');
        }
    }
}
