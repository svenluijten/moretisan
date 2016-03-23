<?php

namespace Sven\Moretisan\MakeView;

class ViewCreator extends ViewHelper
{
    /**
     * Create a new view.
     *
     * @param  string $name      The name of the view.
     * @param  string $extension The extension the view should have.
     * @return \Sven\Moretisan\MakeView\ViewCreator
     */
    public function create($name, $extension = '.blade.php')
    {
        $filename = $this->createFileName($name, $extension);

        $this->createFile($filename);

        return $this;
    }

    /**
     * Extend the view we're working with.
     *
     * @param  string $name Name of view to extend.
     * @return \Sven\Moretisan\MakeView\ViewCreator
     */
    public function extend($name)
    {
        $file = $this->pathTo($this->workingWith);
        $contents = $this->getStub('extends', [$name]);

        $this->appendTo($file, $contents);

        return $this;
    }

    /**
     * Add a section to the view.
     *
     * @param  string $name Name of section to create.
     * @return \Sven\Moretisan\MakeView\ViewCreator
     */
    public function section($name)
    {
        $file = $this->pathTo($this->workingWith);
        $contents = $this->getStub('section', [$name]);

        $this->appendTo($file, $contents);

        return $this;
    }

    /**
     * Create multiple sections in the view.
     *
     * @param  array  $sections Names of the sections to create.
     * @return \Sven\Moretisan\MakeView\ViewCreator
     */
    public function sections(array $sections)
    {
        foreach ($sections as $section) {
            $this->section($section);
        }

        return $this;
    }
}
