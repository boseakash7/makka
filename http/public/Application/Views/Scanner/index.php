<?php 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        #reader{
            width: 500px;
        }

        @media only screen and (max-width: 786px) {
            #reader{
                width: 350px;
            }
        }
        .img-wrapper{
            width: 200px;
        }
    </style>
</head>
<body >
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="img-wrapper mx-auto">
                    <img src="./assets/logo-png.png" class="w-100" alt="">
                </div>
            </div>
            <div class="col-md-12 col-lg-6 mx-auto mt-5">
                <div  id="reader" class="mx-auto"></div>
                <p class="result" style="display: none;">Whatever</p>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        <?php if( !$safari ): ?>
            Swal.fire({
            title: 'Please open this url in safari browser only ',
            showDenyButton: false,
            showCancelButton: false,
            showConfirmButton: false,
            allowOutsideClick: false
            })
        <?php endif; ?>

        var scan = true;

        const html5QrCode = new Html5Qrcode("reader");
        const qrCodeSuccessCallback = (decodedText, decodedResult) => {
            if( scan ) {
                Swal.fire({
                title: 'Scan Result',
                html: decodedText,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText:
                    'Scan Another',
                }).then((result) => {
                    if( result.isConfirmed ) {
                        scan = true;
                    }
                })
            }
            scan = false;
        };
        const config = { 
            fps: 10, 
            qrbox: 250 ,
            supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA],
            facingMode: "environment"
        };

        // If you want to prefer front camera
        html5QrCode.start({ facingMode: "environment" }, config, qrCodeSuccessCallback);

    </script>
</body>
</html>