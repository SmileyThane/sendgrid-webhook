<?php

namespace Smileythane\SendgridWebhook;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Smileythane\SendgridWebhook\Models\SendgridWebhookEvent;
use Throwable;

class SendgridWebhookParser
{

    public function parse(Request $request): void
    {
        $model = config('sendgrid-webhook.recipient_model');
        $attribute = config('sendgrid-webhook.recipient_attribute');

        foreach ($request->all() as $eventItem) {
            if (array_key_exists('email', $eventItem)) {
                $recipient = $model::query()->where($attribute, $eventItem['email'])->first();
                if ($recipient) {
                    try {
                        $event_body = json_encode($eventItem, JSON_THROW_ON_ERROR);

                        $sendgridWebhookEventItem = new SendgridWebhookEvent();
                        $sendgridWebhookEventItem->email = $eventItem['email'];
                        $sendgridWebhookEventItem->timestamp = Carbon::parse($eventItem['timestamp']);
                        $sendgridWebhookEventItem->smtp_id = $eventItem['smtp-id'];
                        $sendgridWebhookEventItem->event = $eventItem['event'];
                        $sendgridWebhookEventItem->event_body = $event_body;
                        $sendgridWebhookEventItem->model_id = $recipient->id;
                        $sendgridWebhookEventItem->save();
                    } catch (Throwable $throwable) {
                        Log::error('sendgrid-webhook: incorrect resporse body! Details: ' . $throwable);
                    }
                }
            }
        }
    }

}
