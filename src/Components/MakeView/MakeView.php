<?php

namespace Sven\Moretisan\MakeView;

use Illuminate\Support\Collection;

class MakeView
{
    /**
     * Create a new view file.
     *
     * @param  string $name      The name of the view to create.
     * @param  string $extension The extension to give the view.
     * @return \Sven\Moretisan\MakeView\MakeView
     */
    public function create($name, $extension)
    {
        // If there are dots in the name, parse it to a full path.
        $fragments = $this->parseName($name); // ['pages', 'index']

        // Get the name of the file to create.
        $nameOfFileToCreate = array_pop($fragments);
        // $fragments: ['pages']

        // Create directories based on the name.
        $this->createFolders($fragments);


        $this->parseExtension($nameOfFileToCreate);

        // Build up the full path (including extension)
        $name = $this->buildName($name, $extension);

        // Create the view.
    }

    public function parseName($name)
    {
        if (! \Illuminate\Support\Str::contains('.', $name)) return $name;

        return explode('.', $name);
    }

    protected function createFolders(array $folders)
    {
        if (emtpy($folders)) return;

        $folders = new Collection($folders);

        // $this->createFolder($folders->pop());
        mkdir($folders->pop());

        $this->createFolders($folders);
    }
}
