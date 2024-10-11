<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('auditions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('plan_id');
            $table->string('participant_name'); // name for representing identity
            $table->boolean('has_participated_before'); // dance competition participation
            $table->string('choreographer_details')->nullable(); // choreographer details
            $table->string('dance_form'); // dance form
            $table->text('opportunities_after_participation')->nullable(); // opportunities after competition

            // Unique Fields for Junior Solo Entry
            $table->text('strengths_and_weaknesses')->nullable(); // strengths and weaknesses
            $table->string('favorite_dancer')->nullable(); // favorite dancer
            $table->string('role_model')->nullable(); // role model
            $table->string('best_dance_styles', 255)->nullable(); // best dance styles (2 minimum)
            $table->text('video_description')->nullable(); // audition video description

            // Additional Fields for Solo Entry
            $table->text('expectations')->nullable(); // expectations from competition
            $table->text('own_choreography_experience')->nullable(); // personal choreography experience
            $table->text('goals_and_difficulties')->nullable(); // goals and difficulties
            $table->text('what_makes_you_better')->nullable(); // unique factors

            // Additional Fields for Duet
            $table->text('duo_story')->nullable(); // story behind duo formation
            $table->integer('years_performing')->nullable(); // years performing together
            $table->text('strengths_and_weaknesses_duet')->nullable(); // duet strengths and weaknesses

            // Additional Fields for Group
            $table->text('group_story')->nullable(); // story behind group formation
            $table->text('group_strengths_and_weaknesses')->nullable(); // group strengths and weaknesses
            $table->text('what_makes_group_better')->nullable(); // why is the group better

            // Common fields for agreements and video submission
            $table->boolean('privacy_policy')->default(false); // privacy policy agreement
            $table->boolean('terms_conditions')->default(false); // terms and conditions
            $table->boolean('refund_policy')->default(false); // refund policy
            $table->string('audition_video')->nullable(); // video file path

            $table->timestamps(); // timestamps
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auditions');
    }
};
