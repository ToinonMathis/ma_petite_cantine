<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Menu; // Si tu as un modèle Menu

class MenuController extends Controller
{
    // GET /api/menus
    public function index()
    {
        $today = Carbon::today();

        // Lundi et vendredi de la semaine courante
        $startOfWeek = $today->copy()->startOfWeek(Carbon::MONDAY); // lundi
        $endOfWeek = $startOfWeek->copy()->addDays(4); // vendredi

        $menus = Menu::whereBetween('menu_date', [$startOfWeek, $endOfWeek])
            ->orderBy('menu_date', 'asc')
            ->get();

        return response()->json($menus);
    }
}
