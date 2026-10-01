<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "Laravel ECS CI/CD Working";
});

// Deploy hook: the Azure App Service PHP runtime this app is deployed to has
// no php-cli binary and no working SSH, so `artisan migrate` can't be run
// out-of-band. This lets the GitHub Actions workflow trigger it over HTTP
// right after each deploy, through the one execution path (PHP-FPM) that's
// actually reachable.
Route::post('/__deploy/migrate', function (Request $request) {
    $token = env('MIGRATE_TOKEN');
    abort_if(! $token || ! hash_equals($token, (string) $request->header('X-Migrate-Token')), 403);

    Artisan::call('migrate', ['--force' => true]);

    return response(Artisan::output(), 200)->header('Content-Type', 'text/plain');
});