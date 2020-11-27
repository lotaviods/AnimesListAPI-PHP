<?php
namespace App\Http\Controllers;

use App\Anime;
use Illuminate\Http\Request;




class AnimesController
{
    public function index()
    {
        return response()->json(Anime::all(), 200) ;
    }

    public function store(Request $request)
{
    return response()
        ->json(
            Anime::create($request->all()),
            201
        );
}

public function show(int $id)
{
    $Animes = Anime::find($id);
    if (is_null($Animes)) {
        return response()->json('', 204);
    }

    return response()->json($Animes);
}

public function update(int $id, Request $request)
{
    $Animes = Anime::find($id);
    if (is_null($Animes)) {
        return response()->json([
            'erro' => 'Recurso não encontrado'
        ], 404);
    }
    $Animes->fill($request->all());
    $Animes->save();

    return $Animes;
}

public function destroy(int $id)
{
    $qtdRecursosRemovidos = Anime::destroy($id);
    if ($qtdRecursosRemovidos === 0) {
        return response()->json([
            'erro' => 'Recurso não encontrado'
        ], 404);
    }

    return response()->json('', 204);
}
}