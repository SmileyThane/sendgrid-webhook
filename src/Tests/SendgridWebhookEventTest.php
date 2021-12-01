<?php

use Smileythane\SendgridWebhook\Tests\SendgridWebhookEventData;
use Tests\TestCase;

class SendgridWebhookEventTest extends TestCase
{

    public function testSampleData(): void
    {

        $response = $this->post(
            config('sendgrid-webhook.sendgrid_webhook_path'),
            SendgridWebhookEventData::getArray()
        );

        echo $response->getContent();
        self::assertEquals(200, $response->status());
    }

}
