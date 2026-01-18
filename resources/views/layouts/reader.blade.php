<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Canteen Pay System
    </title>
    <style>
        /* style.css file*/
    body {
        display: flex;
        justify-content: center;
        margin: 0;
        padding: 0;
        height: 100vh;
        box-sizing: border-box;
        text-align: center;
        /* background: rgb(128 0 0 / 66%); */
    }
    .container {
        width: 100%;
        max-width: 500px;
        margin: 5px;
    }

    .container h1 {
        color: #ffffff;
    }

    .section {
        background-color: #ffffff;
        padding: 5px 30px;
        border: 1.5px solid #b2b2b2;
        border-radius: 0.25em;
        box-shadow: 0 20px 25px rgba(0, 0, 0, 0.25);
    }

    #my-qr-reader {
        padding: 20px !important;
        border: 1.5px solid #b2b2b2 !important;
        border-radius: 8px;
    }

    #my-qr-reader img[alt="Info icon"] {
        display: none;
    }

    #my-qr-reader img[alt="Camera based scan"] {
        width: 100px !important;
        height: 100px !important;
    }

    button {
        padding: 10px 20px;
        border: 1px solid #b2b2b2;
        outline: none;
        border-radius: 0.25em;
        color: white;
        font-size: 15px;
        cursor: pointer;
        margin-top: 15px;
        margin-bottom: 10px;
        background-color: #008000ad;
        transition: 0.3s background-color;
    }

    button:hover {
        background-color: #008000;
    }

    #html5-qrcode-anchor-scan-type-change {
        text-decoration: none !important;
        color: #1d9bf0;
    }

    video {
        width: 100% !important;
        border: 1px solid #b2b2b2 !important;
        border-radius: 0.25em;
    }

    /* Modal Container */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        background-color: rgba(0, 0, 0, 0.5); /* Black with opacity */
        z-index: 1; /* On top */
    }

    /* Modal Content */
    .modal-content {
        background-color: white;
        margin: 15% auto; /* Center vertically and horizontally */
        padding: 20px;
        width: 80%; /* Could be more or less, depending on screen size */
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    /* Close Button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
    }

    </style>
</head>

<body>
@yield('content')
<script
        src="{{ url('js/camera.js') }}">
    </script>
    <script >
        function domReady(fn) {
            if (
                document.readyState === "complete" ||
                document.readyState === "interactive"
            ) {
                setTimeout(fn, 1000);
            } else {
                document.addEventListener("DOMContentLoaded", fn);
            }
        }

        domReady(function () {

// If found you qr code
function onScanSuccess(decodeText, decodeResult) {
    modal.style.display = "block";
    fetch('/register-to-lucky-draw/'+decodeText)
        .then(response => response.json())
        .then(data => {
            if (data.status == true) {
                alert('Registration successful for : '+data.title + ' ' + data.name);
                modal.style.display = "none";
                window.location.reload();
            } else {
                alert('Registration failed for : '+data.title + ' ' + data.name);
                modal.style.display = "none";
                window.location.reload();
            }
        })
        .catch(error => {
            alert('Error: ' + error.message);
            modal.style.display = "none";
        });
}

let htmlscanner = new Html5QrcodeScanner(
    "my-qr-reader",
    { fps: 10, qrbos: 250 }
);
htmlscanner.render(onScanSuccess);
});

// Get the modal element
var modal = document.getElementById("myModal");


</script>
</body>

</html>