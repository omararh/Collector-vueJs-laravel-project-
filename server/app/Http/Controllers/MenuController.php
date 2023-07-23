<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


class MenuController extends Controller
{

    private $pathToFile;
    public function __construct()
    {
        $this->pathToFile = storage_path('Menu.json');
    }

    /*
    * get the menu
    */
    function get() {
        if(!file_exists($this->pathToFile)) return response()->json(['error' => 'Menu not found'], 404);
        return Response::file($this->pathToFile, ['Content-Type' => 'application/json']);
    }

    /*
    * get article by Id
    */
    function getById($id) {
        if(!file_exists($this->pathToFile)) return response()->json(['error' => 'Menu not found'], 404);

        $content = file_get_contents($this->pathToFile);
        $articles = json_decode($content, true);

        if (!isset($articles[$id])) {
            return response()->json(['error' => 'Article not found in the Menu'], 404);
        }

        return response()->json($articles[$id]);
    }

}
