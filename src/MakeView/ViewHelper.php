<?php

namespace Sven\Moretisan\MakeView;

use Illuminate\Support\Str;

class ViewHelper
{
    /**
     * The full path to the view to create.
     *
     * @var string
     */
    protected $fullPath;

    /**
     * The view we're currently working with.
     *
     * @var string
     */
    protected $workingWith;

    /**
     * Instantiate the ViewCreator.
     *
     * @param string $fullPath Absolute path to the views folder.
     */
    public function __construct($fullPath)
    {
        $this->fullPath = $fullPath;
    }

    /**
     * Create the full name of the file.
     *
     * @param  string $name      The view to create.
     * @param  string $extension The extension the view should have.
     * @return string
     */
    protected function createFileName($name, $extension)
    {
        if (Str::contains($name, '.')) {
            $fragments = explode('.', $name);
            $name = array_pop($fragments);

            $this->recursivelyCreateFolders($fragments);
        }

        $this->workingWith = $name . $this->parseExtension($extension);

        return $this->workingWith;
    }

    /**
     * Create folders in folders in folders in folders...
     *
     * @param  array  $folders The folders to create.
     * @return void
     */
    protected function recursivelyCreateFolders(array $folders)
    {
        if (empty($folders)) return;

        foreach ($folders as $folder) {
            $path = $this->pathTo($folder, true);

            if (is_dir($path) || file_exists($path)) continue;

            mkdir($path);
        }
    }

    /**
     * Make sure the file extension is valid.
     *
     * @param  string $extension The extension to parse.
     * @return string
     */
    protected function parseExtension($extension)
    {
        return Str::startsWith($extension, '.') ? $extension : ".$extension";
    }

    /**
     * Create a new file.
     *
     * @param  string $filename The name of the file to create.
     * @return void
     */
    protected function createFile($filename)
    {
        file_put_contents($this->pathTo($filename), '');
    }

    /**
     * Get the path to a file.
     *
     * @param  string $filename The name of the file you want the path to.
     * @return string
     */
    protected function pathTo($filename, $concat = false)
    {
        if ($concat) {
            $this->fullPath .= '/' . $filename;

            return $this->fullPath;
        }

        return $this->fullPath . '/' . $filename;
    }

    /**
     * Get the stub with its values replaced. The values are read
     * from top to bottom.
     *
     * @param  string $name The name of the stub to search for.
     * @param  array  $data Data to replace the wildcards with.
     * @return string
     */
    protected function getStub($name, $data = [])
    {
        $stub = file_get_contents(__DIR__ . '/stubs/'. $name);

        foreach ($data as $replace) {
            $stub = Str::replaceFirst('*', $replace, $stub);
        }

        return $stub;
    }

    /**
     * Append data to a file.
     *
     * @param  string $file     File to put data into.
     * @param  string $contents Contents to append to the file.
     * @return void
     */
    protected function appendTo($file, $contents)
    {
        file_put_contents($file, $contents, FILE_APPEND);
    }
}
