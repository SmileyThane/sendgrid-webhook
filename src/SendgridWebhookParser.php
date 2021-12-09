<?php

namespace Smileythane\SendgridWebhook;


use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Smileythane\SendgridWebhook\Models\SendgridWebhookEvent;
use Throwable;

class SendgridWebhookParser
{

    protected $eventBody = null;

    public function parse(Request $request): void
    {
        $model = config('sendgrid-webhook.recipient_model');
        $attribute = config('sendgrid-webhook.recipient_attribute');

        foreach ($request->all() as $eventItem) {
            if (array_key_exists('email', $eventItem)) {
                $recipient = $model::query()->where($attribute, $eventItem['email'])->first();
                if ($recipient) {
                    try {
                        $this->eventBody = json_encode($eventItem, JSON_THROW_ON_ERROR);
                    } catch (Throwable $throwable) {
                        Log::error('sendgrid-webhook: incorrect resporse body! Details: ' . $throwable);
                    }

                    if ($this->eventBody) {
                        $this->setAdditionalMessageData();
                        $this->setWebhookEvent($eventItem, $recipient);
                    }
                }
            }
        }
    }

    private function setAdditionalMessageData(): void
    {
        try {
            $guzzleClient = new Client([
                'base_uri' => config('sendgrid-webhook.sendgrid_messages_api_url'),
            ]);
            $result = $guzzleClient->request('GET',
                $this->eventBody['sg_message_id'],
                [
                    RequestOptions::HEADERS => [
                        'Authorization' => 'Bearer ' . config('sendgrid-webhook.sendgrid_token'),
                    ],
                ]);
            $this->eventBody['additional_message_data'] = json_decode($result->getBody()->getContents());

        } catch (Throwable $throwable) {
            //TODO add correct exception handler
        }
    }

    private function setWebhookEvent($eventItem, $recipient)
    {
        SendgridWebhookEvent::query()->firstOrCreate(
            [
                'email' => $eventItem['email'],
                'timestamp' => Carbon::parse($eventItem['timestamp']),
                'smtp_id' => $eventItem['smtp-id']
            ],
            [
                'event' => $eventItem['event'],
                'event_body' => $this->eventBody,
                'model_id' => $recipient->id
            ]);
    }

}
