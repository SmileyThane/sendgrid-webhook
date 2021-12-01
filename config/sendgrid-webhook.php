<?php

use App\Models\User;

return [
    'recipient_model' => User::class,
    'recipient_attribute' => 'email',
    'sendgrid_webhook_path' => '/sendgrid/webhook',
    'sendgrid_token' => 'token',
];
