<?php

namespace App\Http\Controllers\Api\V1;

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
 

        $recipe = $request->user()->recipes()->create($request->all());
        $recipe->tags()->attach(json_decode($request->tags));

        $recipe->image = $request->file('image')->store('recipes','public');
        $recipe->save();

        return response()->json(new RecipeResource($recipe), Response::HTTP_CREATED);

    }

    public function show(Recipe $recipe)
    {
        //load porque ya existe, lo tengo en $recipe
        return new RecipeResource($recipe->load('category','tags','user'));

    }

    

    public function update(UpdateRecipeRequest $request, Recipe $recipe)
    {

        $this->authorize('update', $recipe);

        $recipe->update($request->all());

        
        if ($tags = json_decode($request->tags)) {
            $recipe->tags()->sync($tags); //Sincroniza las etiquetas. Elimina las viejas y pon las nuevas
        }

        if ($request->file('image'))
        {
            $recipe->image = $request->file('image')->store('recipes','public');
            $recipe->save();
        }
        
        return response()->json(new RecipeResource($recipe), Response::HTTP_OK);

    }

    public function destroy(Request $request, Recipe $recipe)
    {
        $this->authorize('delete', $recipe);

        $recipe->delete();

        return response()->json(null,Response::HTTP_NO_CONTENT);

    }

}
