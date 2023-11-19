<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;

use App\Models\Recipe;

use App\Http\Resources\RecipeResource;

use Symfony\Component\HttpFoundation\Response;

class RecipeController extends Controller
{
    public function index()
    {

        //with porque es una consulta de 0
        return RecipeResource::collection(Recipe::with('category','tags','user')->get());
    }

    public function store(StoreRecipeRequest $request) 
    {
 

        $recipe = Recipe::create($request->all());

        return response()->json(new RecipeResource($recipe), Response::HTTP_CREATED);

    }

    public function show(Recipe $recipe)
    {
        //load porque ya existe, lo tengo en $recipe
        return new RecipeResource($recipe->load('category','tags','user'));

    }

    

    public function update(UpdateRecipeRequest $request, Recipe $recipe)
    {

        $recipe->update($request->all());

        
        if ($tags = json_decode($request->tags)) {
            $recipe->tags()->sync($tags); //Sincroniza las etiquetas. Elimina las viejas y pon las nuevas
        }


        return response()->json(new RecipeResource($recipe), Response::HTTP_OK);

    }

    public function destroy(Request $request, Recipe $recipe)
    {

        $recipe->delete();

        return response()->json(null,Response::HTTP_NO_CONTENT);

    }

}
