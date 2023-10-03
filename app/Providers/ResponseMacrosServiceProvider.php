<?php

namespace App\Providers;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacrosServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $response = app(ResponseFactory::class);

        $response->macro('success', function ($data) {
            return response()->json(['code' => 0, 'data' => $data], 200);
        });

        $response->macro('error', function ($message) {
            return response()->json(['code' => -1, 'message' => $message], 200);
        });
    }
}
