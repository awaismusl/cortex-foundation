<?php

declare(strict_types=1);

namespace Cortex\Foundation\Overrides\Livewire\Controllers;

use Livewire\FileUploadConfiguration;

class FilePreviewHandler
{
    use CanPretendToBeAFile;

    public function handle($filename)
    {
        abort_unless(request()->hasValidSignature(), 401);

        return $this->pretendResponseIsFile(
            FileUploadConfiguration::storage()->path(FileUploadConfiguration::path($filename)),
            FileUploadConfiguration::mimeType($filename)
        );
    }
}
