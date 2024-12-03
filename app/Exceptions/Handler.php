<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];
// this function is responsible for displaying error pages by using the status codes from $response->status()
    public function render($request, Throwable $e)
    {
        $response = parent::render($request, $e);

        if(in_array($response->status(), [403, 404, 419, 500])){
            return inertia()->render('Error', [
                'status' => $response->status()
            ]);
        }
    }
}
