<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateOpenApiDoc extends Command
{
    /**
     * generate open api documentation file from the annotations.
     *
     * @var string
     */
    protected $signature = 'GenerateOpenApiDoc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate open api documentation file from the annotations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $openapi = \OpenApi\Generator::scan(['app/Http/Controllers']);
        file_put_contents('storage/app/openapi.json', $openapi->toJson());
        $this->info('Documentation generated successfully.');
    }
}
