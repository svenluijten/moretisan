<?php

namespace Sven\Moretisan\Components\Scrap;

use Sven\Moretisan\Shared\FileInteractor;

class Scrap extends FileInteractor
{
    /**
     * Scrap an existing view file.
     *
     * @param  string $name Name of the view to scrap
     * @return \Sven\Moretisan\Components\Scrap
     */
    public function view($name, $extension = '.blade.php')
    {
        $fragments = $this->normalizeToArray($name, '.');

        $filename = array_pop($fragments);

        $this->createFolders($fragments);

        $this->removeFile($filename, $extension);

        return $this;
    }
}
