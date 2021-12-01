<?php

namespace Smileythane\SendgridWebhook;

use Illuminate\Support\ServiceProvider;
use Smileythane\SendgridWebhook\Commands\ClearWebhookEventsCommand;

class SendgridWebhookServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'smileythane');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'smileythane');
         $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
         $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->commands([
            ClearWebhookEventsCommand::class
        ]);

        $this->mergeConfigFrom(__DIR__.'/../config/sendgrid-webhook.php', 'sendgrid-webhook');

        // Register the service the package provides.
        $this->app->singleton('sendgrid-webhook', function ($app) {
            return new SendgridWebhook;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['sendgrid-webhook'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/sendgrid-webhook.php' => config_path('sendgrid-webhook.php'),
        ], 'sendgrid-webhook.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/smileythane'),
        ], 'sendgrid-webhook.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/smileythane'),
        ], 'sendgrid-webhook.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/smileythane'),
        ], 'sendgrid-webhook.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
