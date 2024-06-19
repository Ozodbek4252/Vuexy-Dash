<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Image as ImageModel;
use Intervention\Image\Facades\Image;

trait ImageTrait
{
    protected $img;
    protected $width;
    protected $height;
    protected $directory;
    protected $photo_name;
    protected $imagebleId;
    protected $imageableType;
    protected $extension;
    protected $size;

    public function storeImage($imageRequest, $directory, $imageableType, $imagebleId): void
    {
        $this->init($imageRequest, $directory, $imageableType, $imagebleId);

        // save the original image
        $this->store();
    }

    public function convertToWebP($imageRequest, $directory, $imageableType, $imagebleId)
    {
        $this->directory = $directory;
        $this->imagebleId = $imagebleId;
        $this->imageableType = $imageableType;
        $this->photo_name = Str::random(20);
        $this->extension = 'webp';

        // Create the directory if it does not exist
        $publicDirectory = storage_path('app/public') . '/' . $this->directory;
        if (!file_exists($publicDirectory)) {
            mkdir($publicDirectory, 0700, true);
        }

        if (function_exists('imagewebp')) {
            // Convert image to WebP format
            $webpImage = Image::make($imageRequest)
                ->encode('webp', 100);

            // Save the WebP image to storage or serve directly to the client
            $webpImagePath = $directory . '/' . $this->photo_name . '.webp';
            Storage::put('public/' . $webpImagePath, $webpImage->stream());

            $imagePath = Storage::path('public/' . $webpImagePath);

            // Get the size of the image in bytes
            $this->size =  File::size($imagePath);

            $this->createImage($webpImagePath);

            return $webpImagePath;
        } else {
            return ['error' => 'GD library does not support WebP.'];
        }
    }

    /**
     * Delete image
     *
     * @param $image
     * @param string $path
     * @return void
     */
    public function deleteImage($image, $path = 'path'): void
    {
        if (Storage::exists('/public/' . $image->$path)) {
            Storage::delete('/public/' . $image->$path);
        }
        $image->delete();
    }

    private function init($imageRequest, $directory, $imageableType, $imagebleId)
    {
        $this->directory = $directory;
        $this->imagebleId = $imagebleId;
        $this->imageableType = $imageableType;
        $this->photo_name = Str::random(20);
        $this->extension = $imageRequest->getClientOriginalExtension();
        $this->createDirectory();
        $this->width = Image::make($imageRequest)->width();
        $this->height = Image::make($imageRequest)->height();
        $this->img = Image::make($imageRequest);

        // backup status
        $this->img->backup();
    }

    private function store()
    {
        $this->img->encode($this->extension, 50)->resize($this->width, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        $path = $this->directory . '/' . $this->photo_name . '.' . $this->extension;
        $this->img->save(storage_path('app/public/' . $path));
        $imagePath = Storage::path('public/' . $path);
        // Get the size of the image in bytes
        $this->size = File::size($imagePath);

        $this->createImage($path);
    }

    private function createImage($path)
    {
        ImageModel::create([
            'path' => $path,
            'imageable_id' => $this->imagebleId,
            'imageable_type' => $this->imageableType,
            'size' => $this->size,
            'extension' => $this->extension
        ]);
    }

    private function createDirectory()
    {
        $publicDirectory = storage_path('app/public') . '/' . $this->directory;
        if (!file_exists($publicDirectory)) {
            mkdir($publicDirectory, 0700, true);
        }
    }
}
