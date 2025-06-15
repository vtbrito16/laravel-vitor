<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\CategoriaDataTable;
use App\Models\Categoria;
use Illuminate\Support\Str;

class CategoriaController extends Controller
{
public function index(CategoriaDataTable $dataTable)
{
return $dataTable->render('admin.categoria.index');
}

public function create()
{
return view('admin.categoria.create');
}

public function store(Request $request)
{
$request->validate([
'icone' => ['required', 'not_in:empty'],
'nome' => ['required', 'max:200', 'unique:categorias,nome'],
'status' => ['required'],
]);

$categoria = new Categoria();
$categoria->icone = $request->icone;
$categoria->nome = $request->nome;
$categoria->slug = Str::slug($request->nome); // Corrigido
$categoria->status = $request->status;
$categoria->save();

toastr()->success('Categoria criada com sucesso!');
return redirect()->route('categoria.index');
}
public function edit(string $id)
{
$categoria = Categoria::findOrFail($id);
return view('admin.categoria.edit', compact('categoria'));
}

public function update(Request $request, string $id)
{
//dd($request->all());
$request->validate([
'icone' => ['required', 'not_in:empty'],
'nome' => ['required', 'max:200', 'unique:categorias,nome,' .$id],
'status' => ['required'],
]);
$categoria = Categoria::findOrFail($id);
$categoria->icone = $request->icone;
$categoria->nome = $request->nome;
$categoria->slug = Str::slug($request->nome); // Corrigido
$categoria->status = $request->status;
$categoria->save();

toastr()->success('Categoria atualizada com sucesso!');
return redirect()->route('categoria.index');
}

public function destroy(string $id)
{

}

}
