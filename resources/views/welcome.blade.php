<!DOCTYPE html>
<html>
<head>
    <title>Gallery</title>
</head>
<body>
    <h1>Images</h1>
    <p> {{ $images }}</p>
    @if(count($images))
        @foreach($images as $image)
            <p>{{ $image }}</p>  <!-- Debugging: Show the image URL -->
            <img src="{{ $image }}" style="width: 200px; margin: 10px;">
        @endforeach
    @else
        <p>No images found.</p>
    @endif

    <h1>Videos</h1>
    @if(count($videos))
        @foreach($videos as $video)
            <p>{{ $video }}</p>  <!-- Debugging: Show the video URL -->
            <video width="320" height="240" controls style="margin: 10px;">
                <source src="{{ $video }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        @endforeach
    @else
        <p>No videos found.</p>
    @endif
</body>
</html>