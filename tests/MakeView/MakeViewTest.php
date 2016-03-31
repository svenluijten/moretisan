<?php

namespace Sven\Moretisan\Tests\MakeView;

use Sven\Moretisan\Exceptions\FileAlreadyExists;
use Sven\Moretisan\Tests\AbstractMakeViewTestCase;

class MakeViewTest extends AbstractMakeViewTestCase
{
    /** @test */
    public function it_creates_a_view()
    {
        $this->view->create('index');

        $this->assertTrue(
            file_exists(__DIR__.'/../assets/index.blade.php')
        );
    }

    /** @test */
    public function it_creates_a_view_in_a_subfolder()
    {
        $this->view->create('pages.index');

        $this->assertTrue(
            is_dir(__DIR__.'/../assets/pages')
        );

        $this->assertTrue(
            file_exists(__DIR__.'/../assets/pages/index.blade.php')
        );
    }

    /** @test */
    public function it_adds_a_file_to_existing_subfolder()
    {
        mkdir(__DIR__.'/../assets/pages');

        $this->view->create('pages.index');

        $this->assertTrue(
            file_exists(__DIR__.'/../assets/pages/index.blade.php')
        );
    }

    /** @test */
    public function it_accepts_a_different_extension()
    {
        $this->view->create('index', 'html');

        $this->assertTrue(
            file_exists(__DIR__.'/../assets/index.html')
        );
    }

    /** @test */
    public function it_extends_a_view()
    {
        $this->view->create('index')->extend('layout');

        $this->assertEquals(
            '@extends(\'layout\')'.PHP_EOL,
            file_get_contents(__DIR__.'/../assets/index.blade.php')
        );
    }

    /** @test */
    public function it_adds_a_section()
    {
        $this->view->create('index')->sections('foo');

        $this->assertEquals(
            PHP_EOL.'@section(\'foo\')'.PHP_EOL.PHP_EOL.'@endsection'.PHP_EOL,
            file_get_contents(__DIR__.'/../assets/index.blade.php')
        );
    }

    /** @test */
    public function it_adds_multiple_sections()
    {
        $this->view->create('index')->sections('foo,bar');

        $this->assertEquals(
            PHP_EOL.'@section(\'foo\')'.PHP_EOL.PHP_EOL.'@endsection'.PHP_EOL.
            PHP_EOL.'@section(\'bar\')'.PHP_EOL.PHP_EOL.'@endsection'.PHP_EOL,
            file_get_contents(__DIR__.'/../assets/index.blade.php')
        );
    }

    /** @test */
    public function it_extends_a_view_and_adds_sections()
    {
        $this->view->create('index')->extend('foo')->sections('bar,baz');

        $this->assertEquals(
            '@extends(\'foo\')'.PHP_EOL.
            PHP_EOL.'@section(\'bar\')'.PHP_EOL.PHP_EOL.'@endsection'.PHP_EOL.
            PHP_EOL.'@section(\'baz\')'.PHP_EOL.PHP_EOL.'@endsection'.PHP_EOL,
            file_get_contents(__DIR__.'/../assets/index.blade.php')
        );
    }

    /** @test */
    public function it_throws_an_exception_if_file_already_exists()
    {
        $this->expectException(FileAlreadyExists::class);

        $this->view->create('index');
        $this->view->create('index');
    }
}
