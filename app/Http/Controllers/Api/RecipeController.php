<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Recipe;

class RecipeController extends Controller
{
    public function index()
    {

        //with porque es una consulta de 0
        return Recipe::with('category','tags','user')->get();
    }

    public function show(Recipe $recipe)
    {
        //load porque ya existe, lo tengo en $recipe
        return $recipe->load('category','tags','user');

    }
}
