<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

trait UploadImageTrait
{

public function uploadImage(Request $request, $inputName, $path)
{
if($request->hasFile($inputName)){

$image =  $request->file($inputName);
$day = date('d');
$month = date('m');
$year = date('Y');
$ext = $image->getClientOriginalExtension();
$imageName = 'media_' .uniqid() . '-vtbshop-' . $day .'-'. $month .'-'. $year . '-.' . $ext;
$image->move(public_path($path), $imageName);

//caminho da pasta de imagens
return $path . '/' . $imageName;

}
}

public function updateImage(Request $request, $inputName, $path, $oldpath = null)
{
if($request->hasFile($inputName)){
//verifica se existe imagem do usuário, se existir, deleta a imagem antiga
if ($oldpath && File::exists(public_path($oldpath))) {
File::delete(public_path($oldpath));

}
$image =  $request->file($inputName);
$day = date('d');
$month = date('m');
$year = date('Y');
$ext = $image->getClientOriginalExtension();
$imageName = 'media_' .uniqid() . '-vtbshop-' . $day .'-'. $month .'-'. $year . '-.' . $ext;
$image->move(public_path($path), $imageName);

//caminho da pasta de imagens
return $path . '/' . $imageName;

}
}
public function deleteImage( string $Path)
{
if (File::exists(public_path($Path))) {
    File::delete(public_path($Path));
}
}

}
