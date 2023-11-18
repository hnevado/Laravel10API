<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Recipe;

use App\Http\Resources\RecipeResource;

class RecipeController extends Controller
{
    public function index()
    {

        //with porque es una consulta de 0
        return RecipeResource::collection(Recipe::with('category','tags','user')->get());
    }

    public function store() 
    {

    }

    public function show(Recipe $recipe)
    {
        //load porque ya existe, lo tengo en $recipe
        return new RecipeResource($recipe->load('category','tags','user'));

    }

    

    public function update()
    {

    }

    public function delete()
    {

    }

}
