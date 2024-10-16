<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audition extends Model
{
    use HasFactory;
    protected $fillable = [
        'auditioncity',
        'user_id',
        'plan_id',
        'stagename',
        'why_tup_expectations',
        'why_we_select_you',
        'future_plan_if_win',
        'opinion_new_season_tup',
        'written_composed_song_inspiration',
        'life_changing_incident',
        'change_about_self_love_about_self',
        'unique_qualities',
        'main_goal_difficulties',
        'biggest_strength_support',
        'favorite_judge_why',
        'role_model_inspiration',
        'prepared_songs',
        'how_know_about_auditions',
        'how_know_about_auditions_detail',
        'genre_of_singing',
        'previous_performance',
        'music_experience',
        'music_qualification',
        'status',
        'state',
        'probability',
        'contract',
        'rolemodel',
        'group_together',
        'how_long_group_together',
        'members',
        'responsibility',
        'privacy_policy',
        'terms_conditions',
        'refund_policy',

        'dance_form',
        'dance_style',
        'choreograph',
        'name_representing',
    ];

    protected $casts = [
        'members' => 'json'
    ];

    // User model relationship
    function user()
    {
        return $this->belongsTo(User::class);
    }
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    // public function videos()
    // {
    //     return $this->hasMany(Video::class);
    // }

    public function videos()
    {
        return $this->hasMany(Video::class, 'plan_id', 'plan_id');
    }
}
