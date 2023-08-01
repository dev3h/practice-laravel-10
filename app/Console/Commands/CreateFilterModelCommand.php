<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateFilterModelCommand extends Command
{
    protected $signature = 'make:filtermodel {name} {namespace}';
    protected $description = 'Create a new model with custom options';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name = $this->argument('name');
        $namespace = $this->argument('namespace');
        $modelPath = app_path('ModelFilters/' . $name . '.php');

        if (file_exists($modelPath)) {
            $this->error('Model already exists!');
            return;
        }

        $content = "<?php\n\nnamespace App\ModelFilters;\n\nuse App\Models\\$namespace;\n\nclass $name extends $namespace\n{\n    // Model logic goes here\n}\n";

        file_put_contents($modelPath, $content);

        $this->info('Model created successfully!');
    }
}
