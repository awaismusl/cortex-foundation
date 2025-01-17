<?php

declare(strict_types=1);

namespace Cortex\Foundation\Overrides\Livewire\Commands;

use Illuminate\Support\Facades\File;
use Cortex\Foundation\Traits\ConsoleMakeModuleCommand;

class DeleteCommand extends FileManipulationCommand
{
    use ConsoleMakeModuleCommand;

    protected $signature = 'livewire:delete {name} {--inline} {--force} {--test} {--m|module= : The module name to generate the file within.} {--a|accessarea= : The accessarea to generate the file within.}';

    protected $description = 'Delete a Livewire component';

    public function handle()
    {
        $this->parser = new ComponentParser(
            $rootNamespace = $this->rootNamespace(),
            $this->getResourcePath($rootNamespace, 'src/Http/Components'),
            $this->getResourcePath($rootNamespace, 'resources/views'),
            $this->getAccessareaName(),
            $this->argument('name')
        );

        if (! $force = $this->option('force')) {
            $shouldContinue = $this->confirm(
                "<fg=yellow>Are you sure you want to delete the following files?</>\n\n{$this->parser->relativeClassPath()}\n{$this->parser->relativeViewPath()}\n"
            );

            if (! $shouldContinue) {
                return;
            }
        }

        $inline = $this->option('inline');
        $test = $this->option('test');

        $class = $this->removeClass($force);

        if (! $inline) {
            $view = $this->removeView($force);
        }

        if ($test) {
            $test = $this->removeTest($force);
        }

        $this->refreshComponentAutodiscovery();

        $this->line("<options=bold,reverse;fg=yellow> COMPONENT DESTROYED </> 🦖💫\n");
        $class && $this->line("<options=bold;fg=yellow>CLASS:</> {$this->parser->relativeClassPath()}");

        if (! $inline) {
            $view && $this->line("<options=bold;fg=yellow>VIEW:</>  {$this->parser->relativeViewPath()}");
        }

        if ($test) {
            $test && $this->line("<options=bold;fg=yellow>Test:</>  {$this->parser->relativeTestPath()}");
        }
    }

    protected function removeTest($force = false)
    {
        $testPath = $this->parser->testPath();

        if (! File::exists($testPath) && ! $force) {
            $this->line("<options=bold,reverse;fg=red> WHOOPS-IE-TOOTLES </> 😳 \n");
            $this->line("<fg=red;options=bold>Test doesn't exist:</> {$this->parser->relativeTestPath()}");

            return false;
        }

        File::delete($testPath);

        return $testPath;
    }

    protected function removeClass($force = false)
    {
        $classPath = $this->parser->classPath();

        if (! File::exists($classPath) && ! $force) {
            $this->line("<options=bold,reverse;fg=red> WHOOPS-IE-TOOTLES </> 😳 \n");
            $this->line("<fg=red;options=bold>Class doesn't exist:</> {$this->parser->relativeClassPath()}");

            return false;
        }

        File::delete($classPath);

        return $classPath;
    }

    protected function removeView($force = false)
    {
        $viewPath = $this->parser->viewPath();

        if (! File::exists($viewPath) && ! $force) {
            $this->line("<fg=red;options=bold>View doesn't exist:</> {$this->parser->relativeViewPath()}");

            return false;
        }

        File::delete($viewPath);

        return $viewPath;
    }
}
