<?php

namespace App\Services\MediaLibrary;

use App\Models\Blogs;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class CustomPathGenerator implements PathGenerator
{
    /*
     * Get the path for the given media, relative to the root storage path.
     */
    public function getPath(Media $media): string
    {
        return $this->folder($media);
    }

    /*
     * Get the path for conversions of the given media, relative to the root storage path.
     */
    public function getPathForConversions(Media $media): string
    {
        return $media->id."-ndp".'/conversions/';
    }

    /*
     * Get the path for responsive images of the given media, relative to the root storage path.
     */
    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->folder($media)."img-responsive".DIRECTORY_SEPARATOR;
        // return $media->id."-ndp".'/responsive-images/';
    }

    private function folder(Media $media): string
    {
        switch ($media->model_type) {
            case Blogs::class:
                return Blogs::PATH.DIRECTORY_SEPARATOR.$media->id.DIRECTORY_SEPARATOR;
                break;

            default: 
                return $media->id.DIRECTORY_SEPARATOR;
                break;
        }
    }
}
