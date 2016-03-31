<?php

namespace Sven\Moretisan\Tests;

use Sven\Moretisan\MoretisanServiceProvider;
use GrahamCampbell\TestBench\AbstractPackageTestCase;

abstract class TestCase extends AbstractPackageTestCase
{
    /**
     * Get the service provider class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
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
        //
    }

    /**
     * Tear down the testing suite.
     */
    public function tearDown()
    {
        //
    }
}
