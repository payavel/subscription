<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Payavel\Serviceable\Traits\ServesConfig;

class CreateBaseSubscriptionTables extends Migration
{
    use ServesConfig;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $usingDatabaseDriver = $this->config('subscription', 'defaults.driver') === 'database';

        Schema::create('subscription_products', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('subscription_accounts', function (Blueprint $table) use ($usingDatabaseDriver) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('subscribable_id')->nullable();
            $table->string('subscribable_type')->nullable();
            $table->string('provider_id');
            $table->string('merchant_id');
            $table->string('token')->index();
            $table->timestamps();

            if ($usingDatabaseDriver) {
                $table->foreign('provider_id')->references('id')->on('providers')->onDelete('set null');
                $table->foreign('merchant_id')->references('id')->on('merchants')->onDelete('set null');
            }
        });

        Schema::create('subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('account_id')->nullable();
            $table->string('reference')->index();
            $table->unsignedMediumInteger('product_id');
            $table->unsignedSmallInteger('status');
            $table->timestamps();

            $table->foreign('account_id')->references('id')->on('subscription_accounts')->onDelete('set null');
            $table->foreign('product_id')->references('id')->on('subscription_products')->onDelete('cascade');
        });

        Schema::create('subscribable_payment_method', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('subscribable');
            $table->unsignedBigInteger('payment_method_id');
            $table->unsignedSmallInteger('role');
            $table->timestamps();

            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscribable_payment_method');
        Schema::dropIfExists('subscriptions');
        Schema::dropIfExists('subscription_accounts');
        Schema::dropIfExists('subscription_products');
    }
}
