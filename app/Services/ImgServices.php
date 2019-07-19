<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImgServices
{
    public function save_img($image,$image_name,$at,$dimensionX,$dimensionY){
        $image_path = $image->storeAs('public/'.$at,$image_name);
        $split = explode("/",$image_path,2);
        $image_path=$split[1];
        $image = Image::make("storage/".$image_path)->fit($dimensionX,$dimensionY);
        $image->save();
        //to get pic use storage/.at/image_name
    }
}