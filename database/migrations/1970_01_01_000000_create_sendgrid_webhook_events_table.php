<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSendgridWebhookEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sendgrid_webhook_events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('model_id')->nullable();
            $table->string('email');
            $table->timestamp('timestamp')->nullable();
            $table->string('smtp_id');
            $table->string('event');
            $table->longText('event_body');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sendgrid_webhook_events');
    }
}
