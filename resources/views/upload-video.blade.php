@extends('layouts.auth')

@section('content')
    @include('partials.steps', ['active' => 'upload'])
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @php
        $uploaded_videos_types = [];
        $styles = [
            'Jazz' => [
                'img' => 'https://img.freepik.com/free-vector/sport-equipment-concept_1284-13034.jpg?size=626&ext=jpg',
            ],
            'Classical' => [
                'img' =>
                    'https://img.freepik.com/free-vector/hand-drawn-flat-design-poetry-illustration_23-2149279810.jpg?size=626&ext=jpg',
            ],
            'Pop' => [
                'img' =>
                    'https://img.freepik.com/free-vector/hand-drawn-twerk-illustration_23-2149447957.jpg?size=626&ext=jpg',
            ],
        ];
    @endphp

    <div class="progress bg-label-primary" id="progress-wrapper" style="display: none;">
        <div id="upload-progress" class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar"
            style="width: 2%" upload-progress="2" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <form name="upload-video" action="{{ route('video.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="main-container">

            <!-- <h2>Select the type of your video</h2> -->
            <div class="alert alert-info">You can add upto {{ env('MAX_VIDEO_FILE_UPLOAD', 2) }} different style videos,
                however If you upload only one video it won't effect the ranking and won't effect chance to be selected for
                next round.</div>

            @php
                use App\Models\Video; // Import the Video model

                $videos = Video::where('user_id', auth()->user()->id)->get(); // Fetch videos for the logged-in user
            @endphp

            <table class="table table-bordered">
                <tr>
                    <td>#</td>
                    <td>Video</td>
                </tr>
                @foreach ($videos as $index => $video)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $video->original_name }}</td>
                        <!-- Assuming 'file_name' is the video file field in the Video model -->
                    </tr>
                @endforeach
            </table>
        </div>
        {{-- <div class="form-group mb-2">
        <label for="videoTitle">Video Title</label>
        <input type="text" class="form-control" id="videoTitle" name="videoTitle" required>
        <input type="hidden" id="plan" name="plan" value="{{request()->plan}}">

    </div> --}}
        <div class="form-group mb-3">
            <label for="videoDescription">Description of your audition Video: <span class="required">*</span></label>
            <textarea class="form-control" id="videoDescription" name="videoDescription" rows="3"></textarea>
        </div>
        <div class="form-group mb-3">
            <label for="videoFile">Choose Video File <span class="required">*</span></label>
            <input type="file" class="form-control" id="videoFile" accept=".mp4" name="videoFile" required>
            Max file size allowed: {{ env('MAX_VIDEO_FILE_SIZE', 100000) / 1000 }}MB
            <!-- <input type="file" accept="video/*" class="form-control-file" id="videoFile" name="videoFile" required>Max file size allowed: {{ env('MAX_VIDEO_FILE_SIZE', 100000) / 1000 }}MB -->
        </div>
        @if ($videos->count() <= 2)
            <button type="submit" class="btn btn-primary">Upload Video</button>
        @endif
        @if ($videos->count() > 0)
            <a href="{{ route('thank-you') }}" class="btn btn-primary cnfBtn">Confirm
                Registration</a>
        @endif
    </form>



@endsection

@section('bottom')
    <script>
        // $("form[name='upload-video']").submit(function(e) {
        //     e.preventDefault();
        //     fetch('/get-pre-signed-url')
        //         .then(response => response.json())
        //         .then(data => {
        //             const preSignedUrl = data.url;

        //             // File upload
        //             const fileInput = document.getElementById('videoFile');
        //             const file = fileInput.files[0];
        //             const xhr = new XMLHttpRequest();
        //             xhr.open('PUT', preSignedUrl, true);
        //             xhr.upload.addEventListener('progress', function(event) {
        //                 const percent = (event.loaded / event.total) * 100;
        //                 console.log('Upload Progress: ' + percent + '%');
        //                 // Update progress UI here
        //             });
        //             xhr.send(file);
        //         });
        // });

        $("form[name='upload-video']").submit(function(e) {
            e.preventDefault();
            const fileInput = document.getElementById('videoFile');
            const file = fileInput.files[0];
            const fileName = file.name;
            const fileExtension = fileName.split('.').pop().toLowerCase();

            const maxSizeBytes = 100 * 1024 * 1024; // 100MB in bytes
            if (file.size > maxSizeBytes) {
                alert('File size exceeds maximum limit (100MB). Please choose a smaller file.');
                return;
            }

            // Validate file type (allow only videos)
            const allowedExtensions = ['mp4', 'avi', 'mov', 'wmv', 'flv',
                'mkv'
            ]; // Add more video extensions if needed

            if (!allowedExtensions.includes(fileExtension)) {
                alert('Invalid file type. Please choose a video file (mp4, avi, mov, wmv, flv, mkv).');
                return;
            }

            fetch('{{ route('get-pre-signed-url') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        fileName: fileName,
                        fileExtension: fileExtension,
                        plan: '{{ request()->plan }}',
                        _token: '{{ csrf_token() }}'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    const preSignedUrl = data.url;
                    const xhr = new XMLHttpRequest();
                    xhr.open('PUT', preSignedUrl, true);
                    xhr.upload.addEventListener('progress', function(event) {
                        const percent = (event.loaded / event.total) * 100;
                        console.log('Upload Progress: ' + percent + '%');
                        $('#progress-wrapper').show();
                        $('#upload-progress').width(percent + '%');
                        $('#upload-progress').attr('upload-progress', percent);
                        // Update progress UI here
                    });
                    xhr.addEventListener('load', function() {
                        if (xhr.status === 200) {
                            console.log('File Upload Successful');

                            const formElement = document.querySelector("form[name='upload-video']");
                            const formData = new FormData(formElement);

                            formData.append('plan', '{{ request()->plan }}');
                            formData.append('filePath', data.filePath);
                            formData.append('oname', fileName);
                            // formData.delete('videoFile');
                            fetch("{{ route('video.upload') }}", {
                                    method: 'POST',
                                    body: formData
                                })
                                .then(response => {
                                    console.log('Response:', response);
                                    if (response.ok) {

                                        console.log('Metadata stored successfully');
                                        // window.location.href = "{{ route('thank-you') }}";
                                        window.location.reload();
                                        // Do something if metadata is stored successfully
                                    } else {
                                        console.error('Failed to store metadata');
                                        // Handle error if metadata storage fails
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    // Handle any errors during metadata storage
                                });
                        } else {
                            console.error('File Upload Failed');
                            // Handle file upload failure
                        }
                    });
                    xhr.send(file);
                });
        });
    </script>
@endsection
