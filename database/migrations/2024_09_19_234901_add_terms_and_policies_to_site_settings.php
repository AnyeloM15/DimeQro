<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->longText('terms')->nullable();
            $table->longText('refund_policy')->nullable();
            $table->longText('shipping_policy')->nullable();
            $table->longText('cookie_policy')->nullable();
            $table->longText('warranty_policy')->nullable();
            $table->longText('payment_methods')->nullable();
            $table->longText('security_policy')->nullable();
        });
    }

    public function down()
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['terms', 'refund_policy', 'shipping_policy', 'cookie_policy', 'warranty_policy', 'payment_methods', 'security_policy']);
        });
    }

};
