<?php

namespace Smileythane\SendgridWebhook\Commands;

use Illuminate\Console\Command;
use Smileythane\SendgridWebhook\Models\SendgridWebhookEvent;

class ClearWebhookEventsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendgrid-webhook:clear {--model_id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear cache for sendgrid webhook';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        if ($this->option('model_id')) {
            $continue = $this->ask('Do you want to delete sendgrid cache for selected model?');
            if ($continue === 'n' || $continue === 'N' || $continue === 0) {
                return 0;
            }
            SendgridWebhookEvent::query()->where('model_id', '=', $this->option('model_id'))->delete();
        } else {
            $continue = $this->ask('Warning! This operation will remove all cached items from sendgrid! Please, type "DELETE" for confirmation.');
            if ($continue !== 'DELETE') {
                return 0;
            }
            SendgridWebhookEvent::query()->delete();
        }

        $this->info('Sendgrid cache successfully cleared!');
        return 0;
    }

}
