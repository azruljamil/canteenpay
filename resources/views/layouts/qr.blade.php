<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Canteen Pay System</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/fontawesome.js') }}"></script>
</head>
<body style="background-color: #1E4385;">
    <div class="container">
        @yield('content')
    </div>
    
    <script>
    ///////////////////////////////////////////////////////////////////////// redemption page 

    $("#qr").on('click', function() {
        $("#main_mode").hide();
        $("#back_button").show();
        $("#qrcode_input").show();
        $("#phone_input").hide();
        $("#email_input").hide();
        $("#token").focus();
    });

    $("#email").on('click', function() {
        $("#main_mode").hide();
        $("#back_button").show();
        $("#qrcode_input").hide();
        $("#phone_input").hide();
        $("#email_input").show();
        $("#token").focus();
    });

    $("#phone").on('click', function() {
        $("#main_mode").hide();
        $("#back_button").show();
        $("#qrcode_input").hide();
        $("#email_input").hide();
        $("#phone_input").show();
        $("#token").focus();
    });
    
    function back() {
        location.reload();
    }

    ///////////////////////////////////////////////////////////////////////// qrcode stand alone page
        $("#refresh").on('click',function() {
            $("#welcomingMessage").empty();
        });

        $("#welcomingMessage").empty();

        // function printDiv(divId) {
        //     var printContents = document.getElementById(divId).innerHTML;
        //     var originalContents = document.body.innerHTML;

        //     var printWindow = window.open('', '', 'height=400,width=800');
        //     printWindow.document.write('<html><head><title>Print</title>');
        //     printWindow.document.write('<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css" />');
        //     printWindow.document.write('<link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css" />');
        //     printWindow.document.write('</head><body style="text-align: center; margin-top: 15px;">');
        //     // printWindow.document.write('<div style="width: 100%; margin: auto; page-break-after: always;">');
        //     printWindow.document.write(printContents);
        //     printWindow.document.write('</div>');
        //     printWindow.document.write('</body></html>');
        //     printWindow.document.close();
        //     printWindow.print();
        //     printWindow.close(); // Close the print window after printing

        //     // document.body.innerHTML = originalContents;
        // }
        function printDiv(divId) {
            var printContents = document.getElementById(divId).innerHTML;
            var printWindow = window.open('', '_blank', 'width=650,height=600');

            printWindow.document.write('<html><head><title>Print</title>');
            printWindow.document.write('<link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@400;700&display=swap" rel="stylesheet">');
            printWindow.document.write('<style>@media print { body { font-family: "Alexandria", sans-serif !important; font-size: 18px; text-align: center; margin-top: 150px; } img { width: 80px; } }</style>'); // Optional styling
            printWindow.document.write('</head><body>');
            printWindow.document.write('<div style="width: 83%; margin: auto; text-transform: capitalize;">' + printContents + '</div>');
            printWindow.document.write('</body></html>');

            printWindow.document.close(); // Close document to apply styles
            printWindow.focus(); // Focus on the print window

            setTimeout(() => {
            printWindow.print(); // Open print dialog
            printWindow.close(); // Close window after printing
            }, 100); // Wait a bit to ensure print dialog is triggered
        }


        $(document).ready(function(){
            document.getElementById("loadingOverlay").style.display = "none";
            $("#refresh").on('click',function() {
                $('#information').trigger('reset');
                $("#information").show();
                $("#refresh").hide();
                $("#print").hide();
                $("#responseMessage").hide();
            });

            $("#information").submit(function(e) {
                e.preventDefault(); 

                document.getElementById("loadingOverlay").style.display = "flex";
                
                $("#submit").hide();
                // $("#spinner").show();
                $(".attending-error").hide();
                $(".guest-error").hide();
                var formData = $(this).serialize();
                
                $.ajax({
                    url: "{{ url('/attendeeConfirm') }}",
                    type: 'POST',
                    data: formData,
                    success: function(response) {

                        var title = response.title;
                        var name = response.name;
                        var error_type = response.error_type;
                        var message = response.message;
                        var qr = response.qr ? "{{ url('/') }}/qrcodes/"+response.qr+".png" : "";
                        var redeem_on = response.redeem_on;

                        var titleCheck = '';
                                
                        if(title == 'Tan Sri') {
                            titleCheck = 'Tan Sri';
                        }
                        else if(title == 'Puan Sri') {
                            titleCheck = 'Puan Sri';
                        }
                        else if(title == 'Datuk Sri') {
                            titleCheck = 'Datuk Sri';
                        }   
                        else if(title == 'Dato\' Sri ') {
                            titleCheck = 'Dato\' Sri ';
                        }
                        else if(title == 'Datin Sri') {
                            titleCheck = 'Datin Sri';
                        }
                        else if(title == 'Datuk') {
                            titleCheck = 'Datuk';
                        }
                        else if(title == 'Dato\'') {
                            titleCheck = 'Dato\'';
                        }
                        else if(title == 'Datin') {
                            titleCheck = 'Datin';
                        }
                        else {
                            titleCheck = "";
                        }

                        if(response.status == true) {
                           
                            $("#information").hide();
                            $("#refresh").show();
                            $("#back_button").hide();
                            $("#print").show();
                            $("#refresh_redemption").show();
                            $("#welcomingMessage").show();
                            $("#responseMessage").show();

                            if(qr != "") {

                                document.getElementById("loadingOverlay").style.display = "none";
                                $("#welcomingMessage").html('<h4 class="text-center "><strong>Welcome to the launch of Canteen Pay System!</strong></h4>'+
                                '<p class="text-center">Enjoy the event, connect with key people in the industry, and make the most of the opportunities ahead.</p>');
                                $("#responseMessage").html(
                                '    <div class="badge-container" id="badgeContainer" style="background-image: url({{ asset("img/event-badge-rev2.png") }}); background-size: cover; background-position: center;">'+       
                                '        <br><div id="printableArea" class="text-center"><h4 class="mt-3 h4 fw-bold text-capitalize">'+ titleCheck + " <br> " + name + '</h4>'+
                                '        <div class="qr-code">'+
                                '            <img class="img" src='+ qr + '>'+
                                '        </div>'+
                                '        <div class="footer">'+
                                '        </div>'+ 
                                '    </div>');
                            
                            }
                            
                            else {
                                document.getElementById("loadingOverlay").style.display = "none";
                                $("#responseMessage").html("<div class='alert alert-danger'>No record found. Please try again.</div>");
                            }
                            $("body").focus();
                        }
                        else if(error_type == 2 && redeem_on != null) {
                            $("#token").val("");
                            $("#responseMessage").html("<div class='alert alert-danger text-center text-capitalize'>"+message+" <br> by " + titleCheck + " " + name + " on " + formatDateTime(redeem_on) + "</div>");
                            document.getElementById("loadingOverlay").style.display = "none";
                        }
                        else if(error_type == 1) {
                            $("#responseMessage").html("<div class='alert alert-danger text-capitalize'>"+message+"</div>");
                            document.getElementById("loadingOverlay").style.display = "none";
                        }
                        else {
                            $("#token").val("");
                            $("#submit").show();
                            $("#spinner").hide();
                            document.getElementById("loadingOverlay").style.display = "none";
                            $("#responseMessage").html("<div class='alert alert-danger text-capitalize'>No record found. Please try again.</div>");
                            
                        }
                    },
                    error: function() {
                        document.getElementById("loadingOverlay").style.display = "none";
                        $("#submit").show();
                        $("#spinner").hide();
                        $("#responseMessage").html("<div class='alert alert-danger text-capitalize'>There was an error submitting the form. Please try again.</div>");
                    }
                });
            });
        });

        function refreshPage() {
            location.reload();
        }

        function formatDateTime(datetimeString) {
            let date = new Date(datetimeString);
            let year = date.getFullYear();
            let month = String(date.getMonth() + 1).padStart(2, '0');
            let day = String(date.getDate()).padStart(2, '0');
            let hh = String(date.getHours()).padStart(2, "0");
            let mi = String(date.getMinutes()).padStart(2, "0");
            let ss = String(date.getSeconds()).padStart(2, "0");
            let ampm = hh >= 12 ? 'PM' : 'AM';

            hh = hh % 12 || 12; // Convert 0 to 12 for 12-hour format

            return `${day}-${month}-${year} ${String(hh).padStart(2, "0")}:${mi}:${ss} ${ampm}`;
        }

    </script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
