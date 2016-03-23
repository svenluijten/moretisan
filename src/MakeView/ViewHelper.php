<?php

namespace Sven\Moretisan\MakeView;

class ViewHelper
{
    protected function parseName(string $name)
    {
        // If there is no '.' in the name of the view to
        // create, we will just return the name as it
        // was passed in. No need for more folders.
        if (! strpos($name, '.')) return $name;

        // If there is a '.' in the name, we will
        // make a new array of all folders to
        // create excluding the filename.
        $fragments = explode('.', $name);
        $file = array_pop($fragments);

        $this->recursivelyCreateFolders($fragments, $file);
    }

    protected function recursivelyCreateFolders(array $folders, $filename)
    {
        if (empty($folders)) return $filename;

        $file = array_pop($folders);
    }
}
