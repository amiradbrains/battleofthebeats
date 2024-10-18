<?php

namespace App\Mail;

use App\Models\Video;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VideoUploaded extends Mailable
{
    use SerializesModels;

    public $video;
    public $user;
    public $isAdmin;

    public function __construct(Video $video, $user, $isAdmin = false)
    {
        $this->video = $video;
        $this->user = $user;
        $this->isAdmin = $isAdmin; // Pass whether it's for admin or not
    }

    public function build()
    {
        if ($this->isAdmin) {
            return $this->markdown('emails.admin_video_uploaded')
                ->with([
                    'userName' => $this->user->name,
                    'userEmail' => $this->user->email,
                'videoTitle' => $this->video->original_name,
                ]);
        }
        return $this->markdown('emails.user_video_uploaded')
            ->with([
                'videoTitle' => $this->video->original_name,
                'userName' => $this->user->name,
            ]);
    }
}
