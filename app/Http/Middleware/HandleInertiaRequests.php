<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $user = $request->user();

        if( basename($request->url()) == 'login'){
            session()->forget('user_token');
        }

        $user_token = null;
        if( session()->has('user_token') ){
            $user_token = session()->get('user_token');


        }
        return array_merge(parent::share($request,$user_token), [
            //
            'user_token' => $user_token,
            'locale' => 'en',
            'user' => $user,
        ]);
    }
}
