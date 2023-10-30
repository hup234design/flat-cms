<?php

namespace Hup234design\FlatCms\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use RuntimeException;
use Symfony\Component\Process\Process;

class FlatCmsCommand extends Command
{
    public $signature = 'flat-cms:install';

    public $description = 'Install script for FLAT CMS.';

    public function handle(): int
    {

        $this->line('************************');
        $this->line('*     FILAMENT CMS     *');
        $this->line('************************');
        $this->newLine(1);

        // Spatie Media Library Plugin
        if (! Schema::hasTable('media')) {
            $this->callSilent('vendor:publish', [
                '--provider' => "Spatie\MediaLibrary\MediaLibraryServiceProvider",
                '--tag' => 'migrations',
            ]);
            $this->callSilent('migrate');
        }

        // Spatie Tags Plugin
        if (! Schema::hasTable('tags')) {
            $this->callSilent('vendor:publish', [
                '--provider' => "Spatie\Tags\TagsServiceProvider",
                '--tag' => 'tags-migrations',
            ]);
            $this->callSilent('migrate');
        }

        // Spatie Roles Permissions Plugin
        if (! Schema::hasTable('permissions')) {
            $this->callSilent('vendor:publish', [
                '--provider' => "Spatie\Permission\PermissionServiceProvider",
            ]);
            $this->callSilent('vendor:publish', [
                '--tag' => 'filament-spatie-roles-permissions-config',
                '--force' => true,
            ]);
            $this->callSilent('migrate');
        }

        // Spatie Google Fonts Plugin
        $this->callSilent('vendor:publish', [
            '--provider' => "Spatie\GoogleFonts\GoogleFontsServiceProvider",
            '--tag' => 'google-fonts-plugin',
        ]);

        // Spatie Eloquent Sortable
        $this->callSilent('vendor:publish', [
            '--tag' => 'eloquent-sortable-config',
        ]);

        // Laravel SEO Plugin
        if (! Schema::hasTable('seo')) {
            $this->callSilent('vendor:publish', [
                '--tag' => 'seo-migrations',
            ]);
            $this->callSilent('vendor:publish', [
                '--tag' => 'seo-config',
            ]);
            $this->callSilent('migrate');
        }

        // Filament Breezy Plugin
        if (! Schema::hasTable('breezy_sessions')) {
            $this->call('breezy:install');
        }

        // FLAT CMS Migrations
        $this->call('vendor:publish', [
            '--tag' => 'flat-cms-migrations',
        ], true);

        // FLAT CMS Config
        $this->call('vendor:publish', [
            '--tag' => 'flat-cms-config',
        ], true);

        $this->comment('All done');

        return self::SUCCESS;
    }

    /**
     * Run the given commands.
     *
     * @param  array  $commands
     * @return void
     */
    protected function runCommands($commands)
    {
        $process = Process::fromShellCommandline(implode(' && ', $commands), null, null, null, null);

        if ('\\' !== DIRECTORY_SEPARATOR && file_exists('/dev/tty') && is_readable('/dev/tty')) {
            try {
                $process->setTty(true);
            } catch (RuntimeException $e) {
                $this->output->writeln('  <bg=yellow;fg=black> WARN </> '.$e->getMessage().PHP_EOL);
            }
        }

        $process->run(function ($type, $line) {
            $this->output->write('    '.$line);
        });
    }
}
