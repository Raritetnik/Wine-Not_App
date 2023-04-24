@extends('layouts.app')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
<div class="container mt-10">
    <h1 class="text-center">Camera feature :D</h1>

    <form method="POST" action="{{ route('webcam.capture') }}">
        @csrf
        <div class="row">
            <div class="col-md-6 flex flex-col items-center justify-center">
                <div id="my_camera"></div>
                <br />
                <input type=button  class="bg-accent_wine-50 py-2 px-6 m-2" value="Take Snapshot" onClick="take_snapshot()">
                <input type="hidden" name="image" class="image-tag">
            </div>
            <div class="col-md-6">
                <div id="results">Faire une photo...</div>
            </div>
            <div class="col-md-12 text-center">
                <br />
                <button class="bg-accent_wine-50 py-2 px-6">Sauvegarde</button>
            </div>
        </div>
    </form>
</div>
<script language="JavaScript">
    Webcam.set({
        width: 400,
        height: 350,
        image_format: 'jpeg',
        jpeg_quality: 90
    });

    Webcam.attach('#my_camera');

    function take_snapshot() {
        Webcam.snap(function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
        });
    }
</script>

<style type="text/css">
    #results {
        padding: 20px;
        border: 1px solid;
        background: #ccc;
    }
</style>
