<?php

namespace Yaslak\Auth\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class InstallCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature  ="auth:install";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "";

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        // install breeze
        $this->info('install breeze');
        $this->call("breeze:install");

        $this->info('Copy setting files');
        // Controllers...
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Controllers/Auth'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/default/App/Http/Controllers/Auth', app_path('Http/Controllers/Auth'));
        // Request
        (new Filesystem)->ensureDirectoryExists(app_path('Http\Requests\Auth'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/default/App/Http/Requests/Auth', app_path('Http/Requests/Auth'));
        // view
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/default/resources/views/auth', resource_path('views/auth'));
        // routes
        copy(__DIR__.'/../../stubs/default/routes/auth.php', base_path('routes/auth.php'));
        // lang

        copy(__DIR__.'/../../stubs/default/lang/en/setting.php', base_path('lang/en/setting.php'));

    }

}
