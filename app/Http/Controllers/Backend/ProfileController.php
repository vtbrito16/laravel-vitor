<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
//visualizar perfil
public function index()
{
return view('admin/profile.index');
}

//atualiza o perfil
public function update(Request $request)
{
//dd($request->all());
$request->validate([
'name' => ['required', 'max:100'],
'email' => ['required', 'email', 'unique:users,email,' . Auth::user()->id],
'image' => ['image', 'max:3048'],
]);
$user = UserModel::find(Auth::id());
if($request->hasFile('image')) {

//verifica se existe imagem do usuário, se existir, deleta a imagem antiga
if(File::exists(public_path($user->image))) {
File::delete(public_path($user->image));
}

$image = $request->image;
$imageName = rand() . '-vtbshop-' . $image->getClientOriginalname();
$image->move(public_path('uploads'), $imageName);

//caminho da pasta de imagens
$path = "/uploads/" . $imageName;
$user->image = $path;

}

$user->name = $request->name;
$user->email = $request->email;
$user->save();

//return redirect()->back()->with('success', 'Dados atualizado com sucesso!');
toastr()->success('Dados atualizado com sucesso!');
return redirect()->back();
}

//atualiza a senha do usuário
public function updatePassword(Request $request){
//dd($request->all());
$request->validate([
'current_password' => ['required', 'current_password'],
'password' => ['required', 'min:8', 'confirmed'],
]);
$request->user()->update([
'password' => bcrypt($request->password),
]);

//return redirect()->back()->with('success', 'Senha alterada com sucesso!');
toastr()->success('Senha atualizada com sucesso!');
return redirect()->back();
}

}
