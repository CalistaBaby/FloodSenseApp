<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'));

require __DIR__.'/auth.php';

require app_path('Modules/Masyarakat/Routes/web.php');
require app_path('Modules/Admin/Routes/web.php');




