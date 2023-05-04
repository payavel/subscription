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

        Schema::create('subscription_customers', function (Blueprint $table) use ($usingDatabaseDriver) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('subscribable_id')->nullable();
            $table->string('subscribable_type')->nullable();
            $table->string('provider_id');
            $table->string('token')->index();
            $table->timestamps();

            if ($usingDatabaseDriver) {
                $table->foreign('provider_id')->references('id')->on('subscription_providers')->onDelete('set null');
            }
        });

        Schema::create('subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('reference')->index();
            $table->unsignedMediumInteger('product_id');
            $table->unsignedSmallInteger('status');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('subscription_customers')->onDelete('set null');
            $table->foreign('product_id')->references('id')->on('subscription_products')->onDelete('cascade');
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
        Schema::dropIfExists('subscription_customers');
        Schema::dropIfExists('subscription_products');
        Schema::dropIfExists('subscription_providers');
    }
}
