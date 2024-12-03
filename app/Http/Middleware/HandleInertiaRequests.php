<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        // return any data you want to share here:
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            'greeting' => 'Hello Application',
            // here, we are sharing any session that has a key called message
            'message' => $request->session()->get('message')
        ];
    }
}
