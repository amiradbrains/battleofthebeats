<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Video;
use App\Models\Payment;
use App\Models\Audition;
use App\Models\UserDetail;
use App\Mail\VideoUploaded;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
// use League\Flysystem\AwsS3V3\AwsS3V3Adapter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\AwsS3V3Adapter;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    public function index(Request $request)
    {

        $plan_id = Plan::where('name', $request->plan)->first()->id ?? null;
        $user_id = Auth::id();

        // $is_paid = Payment::where('user_id', $user_id)->where('plan_id', '=', $plan_id)->where('status', '=', 'COMPLETED')->exists();
        // if (!$is_paid)
        //     return redirect()->route('goToPayment', ['plan' => $request->plan])->with('error', 'You need to make payment first');



        if ($request->has('step') && $request->step == 'profile') {
            $userDetail = UserDetail::where('user_id', Auth::id())->first();
            return view('details', compact('userDetail'));
        } else if ($request->has('step') && $request->step == 'audition') {
            $userDetail = Audition::where('user_id', Auth::id())->where('plan_id', '=', $plan_id)->first();
            $payment = Payment::where('user_id', Auth::user()->id)->where('plan_id', $plan_id)->where('status', '=', 'COMPLETED')->first();

            // if (!$payment) {
            //     return redirect()->route('goToPayment', ['plan' => $request->plan])->with('error', 'You need to make payment first');
            // }
            return view('audition', compact('userDetail', 'payment'));
        } else {
            $audition = Audition::where('plan_id', $plan_id)->where('user_id', $user_id)->first();
            if ($audition) {
                if ($audition->status == 'disqualified') {
                    return view('thanks');
                }
                $videos = Video::where('user_id', $user_id)->where('plan_id', $plan_id)->where('status', $audition->status)->get();
                if (count($videos) >= env('MAX_VIDEO_FILE_UPLOAD')) {
                    return view('thanks');
                }
            }


            $hasUserDetails = UserDetail::where('user_id', $user_id)->exists();

            if ($hasUserDetails && $audition)
                return view('upload-video');
            else if ($hasUserDetails) {
                $userDetail = $audition;
                $payment = Payment::where('user_id', Auth::user()->id)->where('plan_id', $plan_id)->where('status', '=', 'COMPLETED')->first();
                // if (!$payment) {
                //     return redirect()->route('goToPayment', ['plan' => $request->plan])->with('error', 'You need to make payment first');
                // }
                return view('audition', compact('userDetail', 'payment'));
            }
        }
        $userDetail = UserDetail::where('user_id', Auth::id())->first();
        return view('details', compact('userDetail'));
    }
    // public function index(Request $request)
    // {

    //     $plan_id = Plan::where('name', $request->plan)->first()->id ?? null;
    //     $user_id = Auth::id();

    //     if ($plan_id) {
    //         $uploaded_videos_count = Payment::where('payments.user_id', $user_id)
    //             ->where('payments.payment_id', '!=', '')
    //             ->where('payments.plan_id', '=', $plan_id)
    //             ->join('videos', 'payments.payment_id', '=', 'videos.payment_id')
    //             ->count();

    //         // Allow up to 2 video uploads
    //         if ($uploaded_videos_count >= 2) {
    //             return view('thanks');
    //         }
    //     }

    //     if ($request->has('step') && $request->step == 'profile') {
    //         $userDetail = UserDetail::where('user_id', Auth::id())->first();
    //         return view('details', compact('userDetail'));
    //     } else if ($request->has('step') && $request->step == 'audition') {
    //         if ($plan_id) {


    //             $userDetail = Audition::where('user_id', Auth::id())->where('plan_id', '=', $plan_id)->first();
    //         } else {
    //             $plan = Payment::where('user_id', $user_id)->where('payment_id', '!=', '')->first()->plan_id ?? '';

    //             $userDetail = Audition::where('user_id', Auth::id())->where('plan_id', '=', $plan)->first();
    //         }
    //         return view('audition', compact('userDetail'));
    //     } else {

    //         $plan = Payment::where('user_id', $user_id)->where('payment_id', '!=', '')->first()->plan_id ?? '';

    //         $hasUserDetails = UserDetail::where('user_id', $user_id)->exists();
    //         $hasAudition = Audition::where('user_id', $user_id)->where('plan_id', $plan)->exists();

    //         $uploaded_videos_count = Payment::where('payments.user_id', $user_id)
    //             ->where('payments.payment_id', '!=', '')
    //             ->where('payments.plan_id', '=', $plan)
    //             ->join('videos', 'payments.payment_id', '=', 'videos.payment_id')
    //             ->count();

    //         if ($uploaded_videos_count >= 2) {

    //             return view('thanks');
    //         } else if ($hasUserDetails && $hasAudition)
    //             return view('upload-video');
    //         else if ($hasUserDetails) {
    //             $userDetail = Audition::where('user_id', Auth::id())->where('plan_id', '=', $plan)->first();
    //             return view('audition', compact('userDetail'));
    //         }
    //     }

    //     $userDetail = UserDetail::where('user_id', Auth::id())->first();
    //     return view('details', compact('userDetail'));
    // }
    public function upload(Request $request)
    {
        $user = auth()->user();  // Single user instance
        $plan = Plan::where('is_active', 1)->first();

        if (!$plan) {
            return redirect()->back()->with('error', 'No plan found #P404');
        }

        $audition = Audition::where('plan_id', $plan->id)->where('user_id', $user->id)->first();
        // Validate the form inputs
        $validator = Validator::make(
            $request->all(),
            [
                'videoDescription' => 'required|string',
                'videoFile' => [
                    'required',
                    'mimetypes:video/mp4,video/mpeg,video/quicktime',
                    'max:200000', // Max size is 200MB (adjust as needed)
                ],
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle file upload
        if ($request->hasFile('videoFile')) {
            $videoFile = $request->file('videoFile');

            // Generate unique filename and retrieve original name
            $fileName = uniqid() . '.' . $videoFile->getClientOriginalExtension();
            $oname = $videoFile->getClientOriginalName();

            // Upload to S3
            $path = $videoFile->storeAs($plan->name, $fileName, 's3'); // Assuming 's3' is the disk configured for AWS S3

            // Create new Video entry
            $video = new Video();
            $video->user_id = $user->id;
            $video->plan_id = $plan->id;
            $video->file_path = $path;
            $video->original_name = $oname;
            $video->title = $request->input('videoTitle', ''); // Assuming videoTitle can be null
            $video->description = $request->videoDescription;
            $video->status = $audition ? $audition->status : 'pending'; // Set status based on the audition or default
            $video->audition_id = $audition ? $audition->id : null; // Associate with audition if exists

            // Save the video to the database
            $video->save();

            $successMessage = "Video uploaded successfully, you will be notified once it is qualified or disqualified for the next round.";
            session()->flash('success', $successMessage);
            // Send email to the uploader (authenticated user) - passing false for the $isAdmin parameter
            Mail::to($user->email)->send(new VideoUploaded($video, $user, false));

            // Send email to the admin - passing true for the $isAdmin parameter
            Mail::to('contact@battleofthebeats.in')->send(new VideoUploaded($video, $user, true));

            return response()->json(['success' => true, 'message' => $successMessage], 200);
        }

        return redirect()->back()->withErrors(['message' => 'No video file found.'])->withInput();
    }



    public function generatePreSignedUrl(Request $request)
    {
        $folder = $request->plan;
        $fileExtension =  $request->fileExtension ?? 'mp4';
        $filePath = $folder . '/' . uniqid() . '-' . time() . '.' . $fileExtension; // Set your file path here

        $client = Storage::disk('s3')->getClient();
        $command = $client->getCommand('PutObject', [
            'Bucket' => env('AWS_BUCKET'),
            'Key'    => $filePath,
            'ACL'    => 'public-read',
        ]);
        $request = $client->createPresignedRequest($command, '+20 minutes');
        $preSignedUrl = (string) $request->getUri();

        return response()->json(['url' => $preSignedUrl, 'filePath' => $filePath]);
    }
}
