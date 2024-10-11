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
            $table->text('choreograph')->nullable();
            $table->text('dance_form')->nullable();
            $table->text('dance_style')->nullable();
            $table->text('name_representing')->nullable();
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
            $table->dropColumn(['choreograph', 'dance_form', 'dance_style', 'name_representing']);
        });
    }
};
