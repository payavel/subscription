<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaseSubscriptionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $usingDatabaseDriver = config('subscription.defaults.driver') === 'database';

        if ($usingDatabaseDriver) {
            Schema::create('subscription_providers', function (Blueprint $table) {
                $table->string('id')->primary();
                $table->string('name');
                $table->string('request_class');
                $table->string('response_class');
                $table->timestamps();
            });
        }

        Schema::create('subscription_products', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('subscriptions', function (Blueprint $table) use ($usingDatabaseDriver) {
            $table->bigIncrements('id');
            $table->unsignedMediumInteger('subscription_product_id');
            $table->string('provider_id');
            $table->string('reference')->index();
            $table->unsignedBigInteger('subscriber_id');
            $table->string('subscriber_type');
            $table->unsignedSmallInteger('status');
            $table->timestamps();

            $table->foreign('subscription_product_id')->references('id')->on('subscription_products')->onDelete('cascade');
            if ($usingDatabaseDriver) {
                $table->foreign('provider_id')->references('id')->on('subscription_providers')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
        Schema::dropIfExists('subscription_products');
        Schema::dropIfExists('subscription_providers');
    }
}
