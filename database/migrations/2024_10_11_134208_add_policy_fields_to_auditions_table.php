<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('auditions', function (Blueprint $table) {
            $table->boolean('responsibility')->default(false);
            $table->boolean('privacy_policy')->default(false);
            $table->boolean('terms_conditions')->default(false);
            $table->boolean('refund_policy')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('auditions', function (Blueprint $table) {
            $table->dropColumn(['responsibility', 'privacy_policy', 'terms_conditions', 'refund_policy']);
        });
    }
};
