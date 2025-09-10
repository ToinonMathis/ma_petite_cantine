<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class RecipeImageController extends Controller
{
    public function show($filename)
    {
        // Générer une URL temporaire vers R2 (10 minutes par ex)
        $url = Storage::disk('r2')->temporaryUrl(
            $filename,
            now()->addMinutes(10)
        );

        return response()->json(['url' => $url]);
    }
}
