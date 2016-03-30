<?php

namespace Sven\Moretisan\Tests;

use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use Sven\Moretisan\MakeView\ViewCreator;
use GrahamCampbell\TestBench\AbstractPackageTestCase;

abstract class AbstractMakeViewTestCase extends AbstractPackageTestCase
{
    /**
     * The ViewCreator instance.
     * @var \Sven\Moretisan\MakeView\ViewCreator
     */
    protected $view;

    /**
     * Set up the testing suite.
     */
    public function setUp()
    {
        mkdir(__DIR__ . '/assets');

        $this->view = new ViewCreator(__DIR__ . '/assets');
    }

    /**
     * Tear down the testing suite.
     */
    public function tearDown()
    {
        $directory = __DIR__ . '/assets';
        $iterator = new RecursiveDirectoryIterator($directory, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::CHILD_FIRST);

        foreach ($files as $file) {
            $file->isDir() ? rmdir($file->getRealPath()) : unlink($file->getRealPath());
        }

        rmdir($directory);
    }

    /**
     * Get a new ViewCreator instance.
     * @return \Sven\Moretisan\ViewCreator
     */
    public function getView()
    {
        return new ViewCreator(__DIR__ . '/assets');
    }
}