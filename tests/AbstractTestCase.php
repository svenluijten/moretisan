<?php

namespace Sven\Moretisan\Tests;

use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use Sven\Moretisan\MakeView\ViewCreator;
use Sven\Moretisan\MoretisanServiceProvider;
use GrahamCampbell\TestBench\AbstractPackageTestCase;

abstract class AbstractTestCase extends AbstractPackageTestCase
{
    /**
     * The ViewCreator instance.
     * @var \Sven\Moretisan\MakeView\ViewCreator
     */
    protected $view;

    /**
     * Get the service provider class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return string
     */
    protected function getServiceProviderClass($app)
    {
        return MoretisanServiceProvider::class;
    }

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

    public function getView()
    {
        return new ViewCreator(__DIR__ . '/assets');
    }
}