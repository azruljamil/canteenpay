<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Canteen Pay System</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
    
    <script>
        $(document).ready(function(){
           
            $("#refresh").on('click',function() {
                $('#information').trigger('reset');
                $("#information").show();
                $("#refresh").hide();
                $("#responseMessage").hide();
            });

            $("#information").submit(function(e) {
                e.preventDefault(); 

                $("#submit").hide();
                $("#spinner").show();
                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ url('/submit-form') }}",
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if(response.status == true) {
                            var type_qr = response.type;
                            var token_qr = response.message;
                            var token_qr_guest = response.guest;

                            $("#information").hide();
                            $("#refresh").show();
                            $("#responseMessage").show();
                            if(type_qr == 1) {
                               
                                $("#responseMessage").html("<center><strong>Thank you for registering! Your registration has been successfully received. "+
                                "Please ensure you save the provided QR code, as it will be required for event verification before entering the hall.</strong> "+
                                "<br> <br> <img class='img-fluid-qr' src='" + token_qr + "'> <center></div>");
                            }
                            else if(type_qr == 2) {
                                $("#responseMessage").html("<div><center><strong>Dear attendee, Your information already exists in our system, and your QR code has been generated based on your previous successful registration.</strong> <br><br> <img class='img-fluid-qr' src='" + token_qr + "'> <br><br><center></div>");
                            }
                            else {
                                console.log(response);
                            }
                            $("body").focus();
                        }
                        else {
                            $("#submit").show();
                            $("#spinner").hide();
                            let errors = response.errors;
                            $.each(errors, function(key, value) {
                                $("." + key + "-error").text(value[0]);
                            });
                        }
                    },
                    error: function() {
                        $("#submit").show();
                        $("#spinner").hide();
                        $("#responseMessage").html("<div class='alert alert-danger'>There was an error submitting the form. Please try again.</div>");
                    }
                });
            });
        });
    </script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
