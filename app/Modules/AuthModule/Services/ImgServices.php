<?php
namespace App\Modules\AuthModule\Services;

use Intervention\Image\Facades\Image;

class ImgServices
{
    public function save_img(Image $image,String $image_name){

        if ($image == null) return;
        $image->storeAs(config('AuthModule_config.image.location'),$image_name.config('AuthModule_config.image.file_type'));
        $image->save();
    
    }
}