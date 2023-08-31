<?php
namespace Collector\Uploaders;
use Intervention\Image\ImageManagerStatic as Image;

class ImageUploader {
    public static function upload(array $file, string $filename)
    {        
        Image::make($file['tmp_name'])
            ->fit(500, 500)
            ->save(PATH_IMAGES . '/large-' . $filename);

        Image::make($file['tmp_name'])
            ->fit(250, 250)
            ->save(PATH_IMAGES . '/' . $filename);
    }
}
