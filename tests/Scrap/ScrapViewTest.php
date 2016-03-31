<?php

namespace Sven\Moretisan\Tests\Scrap;

use Sven\Moretisan\Exceptions\FileDoesNotExist;

class ScrapViewTest extends ScrapTestCase
{
    /** @test */
    public function it_scraps_a_view()
    {
        file_put_contents(__DIR__.'/../assets/index.blade.php', '');

        $this->scrap->view('index');

        $this->assertFalse(
            file_exists(__DIR__.'/../assets/index.blade.php')
        );
    }

    /** @test */
    public function it_can_handle_dot_notation()
    {
        mkdir(__DIR__.'/../assets/pages');
        file_put_contents(__DIR__.'/../assets/pages/index.blade.php', '');

        $this->scrap->view('pages.index');

        $this->assertFalse(
            file_exists(__DIR__.'/../assets/pages/index.blade.php')
        );

        $this->assertTrue(is_dir(__DIR__.'/../assets/pages'));
    }

    /** @test */
    public function it_throws_an_exception_when_file_does_not_exist()
    {
        $this->setExpectedException(FileDoesNotExist::class);

        $this->scrap->view('index');
    }

    /** @test */
    public function it_throws_an_exception_if_a_folder_does_not_exist()
    {
        $this->setExpectedException(FileDoesNotExist::class);

        $this->scrap->view('pages.index');
    }
}
