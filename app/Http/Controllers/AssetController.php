<?php

namespace App\Http\Controllers;

use App\Models\Asset;

class AssetController extends Controller
{
    public function show(Asset $asset)
    {
        return view('assets.show', compact('asset'));
    }
}