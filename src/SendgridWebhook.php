<?php

namespace Smileythane\SendgridWebhook;

use Illuminate\Http\Request;

class SendgridWebhook
{
    private $parser;

    public function __construct(SendgridWebhookParser $sendgridWebhookParser)
    {
        $this->parser = $sendgridWebhookParser;
    }

    public function handle(Request $request)
    {
        $this->parser->parse($request);

        return response()->json(['success' => true]);
    }

}
