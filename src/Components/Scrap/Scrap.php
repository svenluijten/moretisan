<?php

namespace Sven\Moretisan\Components\Scrap;

use Sven\Moretisan\Shared\FileInteractor;

class Scrap extends FileInteractor
{
    /**
     * Scrap an existing view file.
     *
     * @param  string|array $name Name of the view to scrap
     * @return \Sven\Moretisan\Components\Scrap\Scrap
     */
    public function view($name, $extension = '.blade.php')
    {
        $filename = $this->parseName($name);

        $this->removeFile($filename, $extension);

        return $this;
    }
}
