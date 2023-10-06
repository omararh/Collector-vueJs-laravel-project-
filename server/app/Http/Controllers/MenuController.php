<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


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
        if (!file_exists($this->pathToFile)) {
            return response()->json(['error' => 'Menu not found'], 404);
        }

        $content = json_decode(file_get_contents($this->pathToFile), true);

        return response()->json($content);
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
