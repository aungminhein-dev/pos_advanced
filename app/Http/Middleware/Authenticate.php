<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{


    protected function redirectTo(Request $request): ?string
    {
        toastr()->warning('Please log in to an account to continue.','Failed.');
        return $request->expectsJson() ? null : route('loginPage');
    }
}
