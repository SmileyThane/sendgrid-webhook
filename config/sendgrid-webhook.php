<?php

use App\Models\User;

return [
    'recipient_model' => User::class,
    'recipient_attribute' => 'email',
    'sendgrid_webhook_path' => '/sendgrid/webhook',
    'sendgrid_token' => 'token',
    'sendgrid_messages_api_url' => 'https://api.sendgrid.com/v3/messages/'
];
