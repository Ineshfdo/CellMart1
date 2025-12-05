<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $user = auth()->user();

        // After registration, redirect based on user type
        // By default, new users are 'user' type, so they go to homepage
        if ($user->isAdmin()) {
            return redirect('/admin/dashboard');
        }

        // Regular users go to homepage
        return redirect('/');
    }
}
