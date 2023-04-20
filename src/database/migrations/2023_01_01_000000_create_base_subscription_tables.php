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

        Schema::create('subscribers', function (Blueprint $table) use ($usingDatabaseDriver) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('subscribable_id');
            $table->string('subscribable_type');
            $table->string('provider_id');
            $table->string('token')->index();

            if ($usingDatabaseDriver) {
                $table->foreign('provider_id')->references('id')->on('subscription_providers')->onDelete('set null');
            }
        });

        Schema::create('subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('subscriber_id');
            $table->string('reference')->index();
            $table->unsignedMediumInteger('subscription_product_id');
            $table->unsignedSmallInteger('status');
            $table->timestamps();

            $table->foreign('subscriber_id')->references('id')->on('subscribers')->onDelete('set null');
            $table->foreign('subscription_product_id')->references('id')->on('subscription_products')->onDelete('cascade');
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
        Schema::dropIfExists('subscribers');
        Schema::dropIfExists('subscription_products');
        Schema::dropIfExists('subscription_providers');
    }
}
