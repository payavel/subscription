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
        Schema::create('subscription_products', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('subscription_periods', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->unsignedInteger('frequency');
            $table->string('unit');
            $table->timestamps();
        });

        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedMediumInteger('subscription_product_id');
            $table->unsignedInteger('price');
            $table->char('currency', 3)->default('USD');
            $table->unsignedSmallInteger('renew_period_id');
            $table->unsignedSmallInteger('grace_period_id')->nullable();
            $table->unsignedSmallInteger('trial_period_id')->nullable();
            $table->unsignedSmallInteger('status');
            $table->timestamps();

            $table->foreign('subscription_product_id')->references('id')->on('subscription_products')->onDelete('cascade');
            $table->foreign('renew_period_id')->references('id')->on('subscription_periods')->onDelete('cascade');
            $table->foreign('grace_period_id')->references('id')->on('subscription_periods')->onDelete('set null');
            $table->foreign('trial_period_id')->references('id')->on('subscription_periods')->onDelete('set null');
        });

        Schema::create('subscription_agreements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('subscription_plan_id');
            $table->unsignedBigInteger('subscribable_id');
            $table->string('subscribable_type');
            $table->unsignedBigInteger('primary_payment_method_id')->nullable();
            $table->unsignedBigInteger('backup_payment_method_id')->nullable();
            $table->date('start_date');
            $table->date('next_billing_date');
            $table->unsignedSmallInteger('status');
            $table->timestamps();

            $table->foreign('subscription_plan_id')->references('id')->on('subscription_plans')->onDelete('cascade');
            $table->foreign('primary_payment_method_id')->references('id')->on('payment_methods')->onDelete('set null');
            $table->foreign('backup_payment_method_id')->references('id')->on('payment_methods')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_agreements');
        Schema::dropIfExists('subscription_plans');
        Schema::dropIfExists('subscription_periods');
        Schema::dropIfExists('subscription_products');
    }
}
