<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Inertia\Inertia;

class HelloController extends Controller
{
    function helloPage(){
        $menus = Menu::where('menu_date', now()->toDateString())->get();
        return Inertia::render('Hello', ['name' => 'Mathis', 'menus' => $menus]);

    }
}
