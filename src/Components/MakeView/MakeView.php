<?php

namespace Sven\Moretisan\Components\MakeView;

use Illuminate\Support\Str;
use Sven\Moretisan\Exceptions\FileAlreadyExists;

class MakeView
{
    /**
     * Full path where the file to create should be located.
     *
     * @var string
     */
    protected $path;

    /**
     * Full path to the file.
     *
     * @var string
     */
    protected $file;

    /**
     * Instantiate the MakeView component.
     *
     * @param string $path Path to create the views in.
     */
    public function __construct($path)
    {
        $this->path = realpath($path);
    }

    /**
     * Create a new view file.
     *
     * @param  string $name      The name of the view to create.
     * @param  string $extension The extension to give the view.
     * @return \Sven\Moretisan\Components\MakeView\MakeView
     */
    public function create($name, $extension = '.blade.php')
    {
        $fragments = $this->parseName($name);

        $filename = array_pop($fragments);

        $this->createFolders($fragments);

        $this->makeFile($filename, $extension);

        return $this;
    }

    /**
     * Extend a layout file.
     *
     * @param  string $name The name of the file to extend.
     * @return \Sven\Moretisan\Components\MakeView\MakeView
     */
    public function extend($name)
    {
        $this->appendToFile(
            $this->getStub('extend', [$name])
        );

        return $this;
    }

    /**
     * Add sections to the file.
     *
     * @param  string $sections Comma-separated list of sections to add.
     * @return \Sven\Moretisan\Components\MakeView\MakeView
     */
    public function sections($sections)
    {
        foreach ($this->parseSections($sections) as $section) {
            $stub = $this->getStub('section', [$section]);

            $this->appendToFile($stub);
        }

        return $this;
    }

    /**
     * Append to the current file.
     *
     * @param  string $content Content to append.
     * @return void
     */
    protected function appendToFile($content)
    {
        file_put_contents($this->file, $content,FILE_APPEND);
    }

    /**
     * Normalize the sections to an array.
     *
     * @param  string $sections Comma-separated list of sections.
     * @return array
     */
    protected function parseSections($sections)
    {
        if (! Str::contains($sections, ',')) return [$sections];

        return explode(',', $sections);
    }

    /**
     * Get a stub by name and replace optional parameters.
     *
     * @param  string $name   Name of the stub.
     * @param  array  $params Parameters to replace in the stub.
     * @return string         Contents of the stub.
     */
    protected function getStub($name, $params = [])
    {
        $stub = file_get_contents(__DIR__.'/stubs/'.$name.'.stub');

        foreach ($params as $param) {
            $stub = Str::replaceFirst('*', $param, $stub);
        }

        return $stub;
    }

    /**
     * Normalize the name of the view to an array.
     *
     * @param  string $name Dot-notated name of the view to create.
     * @return array
     */
    protected function parseName($name)
    {
        if (! Str::contains($name, '.')) return [$name];

        return explode('.', $name);
    }

    /**
     * Recursively create folders.
     *
     * @param  array  $folders Folders to create inside each other.
     * @return void
     */
    protected function createFolders($folders)
    {
        if (empty($folders)) return;

        $path = $this->addToPath( array_pop($folders) );

        if (! is_dir($path)) mkdir($path);

        return $this->createFolders($folders);
    }

    /**
     * Add given folder to the path property.
     *
     * @param string $folder The folder to add to the path.
     */
    protected function addToPath($folder)
    {
        $this->path .= "/$folder";

        return $this->path;
    }

    /**
     * Create a file from the filename and extension.
     *
     * @param  string $filename  The name of the file.
     * @param  string $extension The extension of the file.
     * @return void
     */
    protected function makeFile($filename, $extension)
    {
        $extension = $this->parseExtension($extension);

        $this->file = $this->path . '/' . $filename . $extension;

        if (file_exists($this->file)) {
            throw new FileAlreadyExists("The file at [$this->file] already exists.");
        }

        file_put_contents($this->file, '');
    }

    /**
     * Normalize the extension so it starts with a period.
     *
     * @param  string $extension The extension to normalize.
     * @return string
     */
    protected function parseExtension($extension)
    {
        return Str::startsWith($extension, '.') ? $extension : ".$extension";
    }
}
