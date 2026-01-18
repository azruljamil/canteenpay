<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thank You for Registering</title>
    <style>
        /* Ensure responsiveness */
        @media only screen and (max-width: 600px) {
            .container {
                width: 100% !important;
            }
        }
        @media only screen and (max-width: 600px) {
            .qr-container {
                text-align: center !important;
            }
            .qr-code {
                width: 80% !important;
                max-width: 200px !important; /* Prevents excessive scaling */
                height: auto !important;
            }
        }
        .logo_footer {
            /* max-width: 350px; */
            width: 120px;
        }
        .footer_title {
            color: black;
            font-weight: bold;
            font-size: 12px;
        }
    </style>
</head>
<body style="background-color: #f8f9fa; font-family: Arial, sans-serif; margin: 0; padding: 20px;">

    <table class="container" width="100%" cellspacing="0" cellpadding="0" style="max-width: 600px; margin: auto; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
        <tr>
            <td align="center">
                <img width="350" style="max-width: 100%; height: auto; display: block;" src="https://ba9a-2001-e68-5416-1ff6-9dcc-694f-659a-d0ad.ngrok-free.app/contagiuos/public/img/celcomdigi.jpg">
                <h2 style="color: #007bff;">Thank You for Registering!</h2>
                <p style="color: #6c757d;">Hello {{ $detail['name'] }},</p>
                <p style="color: #6c757d;">
                    We’re excited to have you on board. Your registration was successful. <br>
                    Please ensure you save the provided QR code, as it will be required for event verification before entering the hall.
                </p>
                <div class="qr-container">
                    <img class="qr-code" style="max-width: 200px; width: 100%; height: auto; display: block; margin: 0 auto;" src="https://ba9a-2001-e68-5416-1ff6-9dcc-694f-659a-d0ad.ngrok-free.app/contagiuos/public/qrcodes/{{ $detail['qrcode'] }}">
                </div><br>    
                
                <p style="color: #6c757d; margin-top: 20px;">If you have any questions, feel free to contact us.

                </p>
            <hr style="border: none; border-top: 1px solid #ddd; margin: 8px 0;">
            <span class="footer_title">&copy; {{ date('Y') }} Digitvent.com by &nbsp;</span><img width="90" style="padding-top:8px; max-width: 100%; height: auto; display: block;" src="https://ba9a-2001-e68-5416-1ff6-9dcc-694f-659a-d0ad.ngrok-free.app/contagiuos/public/img/nazsoft-logo.png" class="logo_footer">
            </td>
        </tr>
    </table>

</body>
</html>
