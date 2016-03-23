<?php

namespace Sven\Moretisan\MakeView;

class ViewCreator extends ViewHelper
{
    /**
     * The full path to the view to create.
     *
     * @var string
     */
    protected $fullPath;

    /**
     * Instantiate the ViewCreator.
     *
     * @param string $fullPath Absolute path to the views folder.
     */
    public function __construct($fullPath)
    {
        $this->fullPath = $fullPath;
    }

    public function create(string $name)
    {
        $this->parseName($name);

        return $this;
    }


}
