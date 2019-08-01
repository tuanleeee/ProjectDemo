<?php
namespace App\Modules\AuthModule\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImgServices
{
    public function save_img($image,$image_name){
        if ($image == null) return;
        $image_path = $image->storeAs('public/image/',$image_name.".jpeg");
        $image->save();
    }
}