<?php

namespace Smileythane\SendgridWebhook\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SendgridWebhookEvent
 *
 * @property integer model_id
 * @property string email
 * @property string timestamp
 * @property string smtp_id
 * @property string event
 * @property string event_body
 *
 */
class SendgridWebhookEvent extends Model
{
    protected $table = 'sendgrid_webhook_events';

    protected $fillable = ['model_id', 'email', 'timestamp', 'smtp_id', 'event', 'event_body'];


}
