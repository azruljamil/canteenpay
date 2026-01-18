@extends('layouts.reader')

@section('title', 'Canteen Pay System')

@section('content')
    <div class="container">
        <div class="scan" id="scan">
            
            <img src="{{ url('img/MDT-logo.png') }}" alt="" width="350" height="80">
            <br><br>
            <div class="section">
            <h1 style="color: #000000;">Scan QR Codes</h1>
                <div id="my-qr-reader">
                </div>

                <div class="row">
                    <div class="col">
                        <a href="/scan-attendee-qr"><button id="back" type="button" class="btn btn-primary mb-3 btn-lg">Home</button></a>
                    </div>
                </div>

            </div>

            
        </div>

        
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <!-- <span class="close">&times;</span> -->
            <h2></h2>
            <p>Please wait.....</p>
        </div>
    </div>
@endsection
    