<?php

namespace Sven\Moretisan\Tests;

use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use Sven\Moretisan\Components\MakeView\MakeView;
use GrahamCampbell\TestBench\AbstractPackageTestCase;

abstract class MakeViewTestCase extends AbstractPackageTestCase
{
    /**
     * @var \Sven\Moretisan\MakeView\MakeView
     */
    protected $view;

    /**
     * Set up the testing suite.
     */
    public function setUp()
    {
        mkdir(__DIR__.'/../assets');

        $this->view = new MakeView(__DIR__.'/../assets');
    }

    /**
     * Tear down the testing suite.
     */
    public function tearDown()
    {
        $directory = realpath(__DIR__.'/../assets');
        $iterator = new RecursiveDirectoryIterator($directory, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::CHILD_FIRST);

        foreach ($files as $file) {
            $file->isDir() ? rmdir($file->getRealPath()) : unlink($file->getRealPath());
        }

        rmdir($directory);
    }
}
