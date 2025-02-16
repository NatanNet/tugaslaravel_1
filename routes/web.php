<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;

// Route dasar
Route::get('/', function () {
    return view('welcome');
});

// Menampilkan teks sederhana
Route::get('foo', function () {
    return 'Hello World Boy';
});

// Route dengan parameter
Route::get('user/{id}', function ($id) {
    return 'User ' . $id;
})->where('id', '[0-9]+'); // Menentukan hanya angka

// Route dengan multiple parameter
Route::get('posts/{post}/comments/{comment}', function ($post, $comment) {
    return "Post ID: $post, Comment ID: $comment";
});

// Route menggunakan controller
Route::get('/user', [UserController::class, 'index']);

// HTTP Methods
Route::get('/data', function () {
    return 'Membaca data';
});
Route::post('/data', function () {
    return 'Menyimpan data';
});
Route::put('/data', function () {
    return 'Mengupdate data';
});
Route::patch('/data', function () {
    return 'Update sebagian data';
});
Route::delete('/data', function () {
    return 'Menghapus data';
});
Route::options('/data', function () {
    return 'Opsi metode tersedia';
});

// Match beberapa metode sekaligus
Route::match(['get', 'post'], '/match', function () {
    return 'Route ini menerima GET atau POST';
});

// Route menerima metode apa saja
Route::any('/any', function () {
    return 'Route ini menerima semua metode HTTP';
});

// CSRF Protection
Route::get('/form', function () {
    return '
    <form method="POST" action="/profile">
        ' . csrf_field() . '
        <input type="text" name="name" placeholder="Nama">
        <button type="submit">Submit</button>
    </form>';
});

Route::post('/profile', function (Request $request) {
    return 'Data berhasil dikirim: ' . $request->input('name');
});

// Redirect Route
Route::redirect('/here', '/there');

Route::get('/there', function () {
    return 'Anda telah dialihkan ke halaman ini.';
});

// Redirect dengan status code 301 (permanent redirect)
Route::redirect('/old-route', '/new-route', 301);

Route::get('/new-route', function () {
    return 'Halaman baru setelah redirect permanen.';
});

// Permanent Redirect
Route::permanentRedirect('/here', '/there');

// Menampilkan view
Route::view('/welcome', 'welcome');

// Menampilkan view dengan parameter
Route::view('/welcome', 'welcome', ['name' => 'Taylor']);

// Route dengan validasi parameter
Route::get('user/{name}', function ($name) {
    return "Nama: $name";
})->where('name', '[A-Za-z]+');

Route::get('user/{id}/{name}', function ($id, $name) {
    return "User ID: $id, Nama: $name";
})->where(['id' => '[0-9]+', 'name' => '[a-zA-Z]+']);

// Route global pattern untuk ID
Route::pattern('id', '[0-9]+');

// Route search dengan bebas karakter
Route::get('search/{search}', function ($search) {
    return "Hasil pencarian: $search";
})->where('search', '.*');
