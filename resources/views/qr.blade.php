@extends('layouts.qr')

@section('title', 'Canteen Pay System')

@section('content')

<div class="form-container-qr">
    <div class="background-image"></div>
    <div class="loading-overlay" id="loadingOverlay">
        <div class="text-center">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Checking Attendee Information...</span>
            </div>
            <p class="mt-2">Loading, please wait...</p>
        </div>
    </div>

    <div class="title" id="welcomingMessage" style="display:none;">
        <h4 class="text-center "><strong>Welcome to the launch of Canteen Pay System</strong></h4>
        <!-- <p class="text-center">Enjoy the event, connect with key people in the industry, and make the most of the opportunities ahead.</p> -->
    </div>

    <div id="responseMessage">
        
    </div>

    <div>
        <button id="print" class="btn button btn-lg me-2" style="display:none;" onclick="printDiv('printableArea')">Print Profile</button> 
        <button id="refresh" class="btn button btn-lg" onclick="refreshPage()" style="display:none;">Back to QR</button>
    </div>

    <form id="information" name="information">
        @csrf
        <div class="row">
            <div class="col-md-12 text-center">
                <img src="img/MDT-logo.png" class="img-fluid logo-qr">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center title p-3">
                <h4>Canteen Pay System</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <p class="sub-title">Please scan the QR code to the scanner below:</p>
            </div>
            <!-- Left Column -->
            <div class="col-md-12">
                <div class="row text-center">
                    <div class="col-md-2 text-center"></div>
                    <div class="col-md-8 text-center">
                        <input type="text" id="token" class="form-control" name="token" style="width: ; text-align: center;" placeholder="Scan QR Code" autofocus>
                    </div>
                    <div class="col-md-2 text-center"></div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.getElementById('token').focus();
                        });
                    </script>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="mb-3">
                <div style="display:none;" id="spinner">
                    <button class="btn btn-primary" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" ></span>
                    Loading...
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center p-0">
                <span class="footer_title">Canteen Pay System by ALZ Services</span>
            </div>
            <!-- <div class="col-md-12 text-center p-0">
                <img src="img/nazsoft-logo.png" class="logo_footer">
            </div> -->
        </div>
    </form>
</div>

@endsection