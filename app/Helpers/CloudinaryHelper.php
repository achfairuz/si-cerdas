<?php

namespace App\Helpers;

use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;
use Illuminate\Support\Facades\Log;
use SebastianBergmann\Environment\Console;

class CloudinaryHelper
{
    protected static function instance()
    {
        return new \Cloudinary\Cloudinary([
            'cloud' => [
                'cloud_name' => config('cloudinary.cloud_name'),
                'api_key'    => config('cloudinary.api_key'),
                'api_secret' => config('cloudinary.api_secret'),
            ],
            'url' => [
                'secure' => true,
            ],
        ]);
    }

    public static function upload($file, $folder = 'si-cerdas')
    {
        $cloudinary = self::instance();

        $result = $cloudinary->uploadApi()->upload(
            $file->getRealPath(),
            [
                'folder' => $folder,
                'format' => 'webp',
                'quality' => 'auto',
            ]
        );

        return [
            'url' => $result['secure_url'],
            'public_id' => $result['public_id'],
        ];
    }

    public static function delete($publicId)
    {
        $cloudinary = self::instance();
        return $cloudinary->uploadApi()->destroy($publicId);
    }
}