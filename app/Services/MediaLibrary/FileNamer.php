<?php
namespace App\Services\MediaLibrary;

use Spatie\MediaLibrary\Support\FileNamer\DefaultFileNamer;

class FileNamer extends DefaultFileNamer
{
    public function originalFileName(string $fileName): string
    {
        return \Str::random(16);
    }
}
