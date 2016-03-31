<?php

namespace Sven\Moretisan\Tests\Scrap;

use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use Sven\Moretisan\Components\Scrap\Scrap;
use GrahamCampbell\TestBench\AbstractPackageTestCase;

abstract class ScrapTestCase extends AbstractPackageTestCase
{
    /**
     * @var \Sven\Moretisan\Components\Scrap\Scrap
     */
    protected $scrap;

    /**
     * Set up the testing suite.
     */
    public function setUp()
    {
        mkdir(__DIR__.'/../assets');

        $this->scrap = new Scrap(__DIR__.'/../assets');
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
