<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin extends Middleware
{
public function handle($request,Closure $next,...$guards)
{

    if ($request->user()->role === "admin") return $next($request);
       return $next(false);
}
}
