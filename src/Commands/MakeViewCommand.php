<?php

namespace Sven\Moretisan\Commands;

use Illuminate\Console\Command;
use Sven\Moretisan\MakeView\MakeView;

class MakeViewCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:view
                           {name : The name of the view to create.}
                           {--extends= : What \'master\' view should be extended?}
                           {--sections= : A comma-separated list of sections to create.}
                           {--directory=resources/views/ : The directory where your views are stored.}
                           {--extension=blade.php : What file extension should the view have?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new view';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $view = new MakeView(
            base_path($this->option('directory'))
        );

        $name      = $this->argument('name');
        $extension = $this->option('extension');
        $extend    = $this->option('extends');
        $sections  = $this->option('sections');

        try {
            $view->create($name, $extension)
                 ->extend($extend)
                 ->sections($sections);

            return $this->info("View [$name] successfully created");
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
