@extends('layouts.qr')

@section('title', 'Canteen Pay System')

@section('content')
<div class="background-image"></div>
<div class="form-container-qr">

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
    
    <div id="responseMessage"></div>

    <div>
        <button id="print" class="btn button btn-lg me-2" style="display:none;" onclick="printDiv('responseMessage')">Print Profile</button> 
        <button id="refresh_redemption" class="btn button btn-lg" onclick="back()" style="display:none;">Home</button>
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
        <div class="row" id="main_mode">
            <div class="col-md-12 text-center">
                <p class="sub-title">Please select the type of registration you would like to proceed with:</p>
            </div>
            <div class="col-md-12">
                <div class="row text-center">
                    <div class="col-md-4" id="qr">
                        <div class="card">
                            <div class="card-body text-center" style="cursor:pointer; color: #1E4385;">
                                <i class="fa-3x fa-classic fa-solid fa-qrcode fa-fw"></i>
                                <h5 class="card-title mt-2">QR <br>Code</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" id="email">
                        <div class="card">
                            <div class="card-body text-center" style="cursor:pointer; color: #1E4385;">
                                <i class="fa-regular fa-envelope fa-3x"></i>
                                <h5 class="card-title mt-2">Email <br>Address</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" id="phone">
                        <div class="card">
                            <div class="card-body text-center" style="cursor:pointer; color: #1E4385;">
                                <i class="fa-solid fa-mobile fa-3x"></i>
                                <h5 class="card-title mt-2">Phone <br>Number</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <span class="back-button btn" id="back_button" onclick="back()" style="display:none;">← Back</span>
        <div class="row" id="qrcode_input" style="display:none;">
            <div class="col-md-12 text-center">
                <p class="sub-title">Please scan the QR code to the scanner below:</p>
            </div>
            <div class="col-md-12">
                <div class="row text-center">
                    <div class="col-md-2 text-center"></div>
                    <div class="col-md-8 text-center">
                        <input type="text" id="token" class="form-control" name="token" style="width: ; text-align: center;" placeholder="Scan QR Code" autofocus>
                    </div>
                    <div class="col-md-2 text-center"></div>
                </div>
            </div>
        </div>
        <div class="row" id="email_input" style="display:none;">
            <div class="col-md-12 text-center">
                <p class="sub-title">Kindly enter your email below:</p>
            </div>
            <div class="col-md-12">
                <div class="row text-center">
                    <div class="input-group text-center">
                        <input type="email" id="email" class="form-control" name="email" style="width: ; text-align: center;" placeholder="Please provide your email address below" autofocus>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="phone_input" style="display:none;">
            <div class="col-md-12 text-center">
                <p class="sub-title">Kindly enter your mobile number below:</p>
            </div>
            <div class="col-md-12">
                <div class="row text-center">
                    <div class="input-group text-center">
                        <input type="phone" id="phone" class="form-control" name="phone" style="width: ; text-align: center;" placeholder="Please provide your mobile number below" autofocus>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
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