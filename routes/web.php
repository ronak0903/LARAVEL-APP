<?php

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'messages' => Message::latest()->get(),
    ]);
});

Route::post('/messages', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'body' => 'required|string|max:1000',
    ]);

    Message::create($validated);

    return redirect('/');
});
