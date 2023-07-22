<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    /*
    * get the menu
    */
    function get() {
        $pathToFile = storage_path('Menu.json');

        if(!file_exists($pathToFile)) return response()->json(['error' => 'File not found'], 404);
        return response()->download($pathToFile);
    }
}
