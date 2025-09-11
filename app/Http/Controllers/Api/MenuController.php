<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

// Si tu as un modèle Menu

class MenuController extends Controller
{
    // GET /api/menus
    public function index()
    {
        $today = Carbon::today();

        $menus = $menu = Menu::latest()->first();
        if ($menus->image) {
            $menus->image = Storage::disk('r2')->temporaryUrl(
                $menus->image,
                now()->addMinutes(20) // URL valable 10 min
            );
        } else {
            $menus->image = null;
        }

        // Lundi et vendredi de la semaine courante
        //$startOfWeek = $today->copy()->startOfWeek(Carbon::MONDAY); // lundi
        //$endOfWeek = $startOfWeek->copy()->addDays(4); // vendredi

        //$menus = Menu::whereBetween('menu_date', [$startOfWeek, $endOfWeek])
        //    ->orderBy('menu_date', 'asc')
        //    ->get();

        return response()->json($menus->image);
    }
}
