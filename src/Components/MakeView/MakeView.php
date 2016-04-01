<?php

namespace Sven\Moretisan\Components\MakeView;

use Illuminate\Support\Str;
use Sven\Moretisan\Shared\FileInteractor;

class MakeView extends FileInteractor
{
    /**
     * Create a new view file.
     *
     * @param  string $name      The name of the view to create.
     * @param  string $extension The extension to give the view.
     * @return \Sven\Moretisan\Components\MakeView\MakeView
     */
    public function create($name, $extension = '.blade.php')
    {
        $filename = $this->parseName($name);

        $this->makeFile($filename, $extension);

        return $this;
    }

    /**
     * Create a RESTful resource.
     *
     * @param  string       $name      The name of the resource.
     * @param  string|array $verbs     The verbs the resource should include.
     * @param  string       $extension The extension the files should get.
     * @return void
     */
    public function resource($name, $verbs = null, $extension = '.blade.php')
    {
        $types = ['index', 'show', 'edit', 'create'];

        if ( ! is_null($verbs)) {
            $types = $this->normalizeToArray($verbs, ',');
        }

        foreach ($types as $type) {
            $this->clean()->create("$name.$type", $extension);
        }
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
     * @param  string|array $sections Array or comma-separated list of sections.
     * @return \Sven\Moretisan\Components\MakeView\MakeView
     */
    public function sections($sections)
    {
        foreach ($this->normalizeToArray($sections, ',') as $section) {
            $stub = $this->getStub('section', [$section]);

            $this->appendToFile($stub);
        }

        return $this;
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
}
