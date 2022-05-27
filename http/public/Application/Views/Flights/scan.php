<?php

use Application\Models\Flights;
use System\Core\Model;
use System\Helpers\URL;
use System\Models\Language;

$lang = Model::get(Language::class);
?>
<define title>
    <?php echo $lang('scan_flight', ['flight' => $flight['number']]) ?>
</define>
<define page_desc>
    <?php echo $lang('scan_flight_desc') ?>
</define>
<section class="section">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">
                    <?php if ($supports) : ?>
                        <h1><?php echo $lang('flight_num', ['num' => $flight['number']]) ?></h1>
                        <div class="other-info clearfix">
                            <p class="float-start me-3"><strong><?php echo $lang('airlines'); ?>:</strong> <?php echo $flight['number'] ?></p>
                            <p class="float-start me-3"><strong><?php echo $lang('take_off_date'); ?>:</strong> <?php echo $flight['tdate'] ?></p>
                            <p class="float-start me-3"><strong><?php echo $lang('take_off_time'); ?>:</strong> <?php echo $flight['ttime'] ?></p>
                            <p class="float-start me-3"><strong><?php echo $lang('number_of_passengers'); ?>:</strong> <?php echo $flight['passengers'] ?></p>
                            <p class="float-start me-3"><strong><?php echo $lang('source_airport'); ?>:</strong> <?php echo $flight['sairport'][$lang->current() . '_name'] ?></p>
                        </div>
                        <hr>
                        <div class="other-info clearfix">
                            <p><strong>Employee Name</strong>: <?php echo $userInfo['name'] ?></p>
                        </div>
                        <hr>
                        <div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
                            <?php
                            $ciClass = "";
                            $coClass = "";
                            if ($flight['status'] == Flights::STATUS_CHECK_IN || $flight['status'] == Flights::STATUS_OPENED) {
                                $ciClass = "btn-primary";
                            } else if ($flight['status'] == Flights::STATUS_CHECK_OUT) {
                                $coClass = "btn-primary";
                            }
                            ?>
                            <a href="<?php echo !empty($ciClass) ? '' : URL::full('flights/check-in/' . $flight['id']) ?>" class="btn <?php echo $ciClass ?>"><?php echo $lang('check_in') ?></a>
                            <a href="<?php echo !empty($coClass) ? '' : URL::full('flights/check-out/' . $flight['id']) ?>" class="btn <?php echo $coClass ?>"><?php echo $lang('check_out') ?></a>
                        </div>
                        <div class="form mt-5">
                            <form action="<?php echo URL::current() ?>" method="POST" onsubmit="submitForm(event)">
                                <div class="form-group">
                                    <label for=""><?php echo $lang('id'); ?></label>
                                    <input type="text" name="qr_code" class="form-control" id="qr_input">
                                </div>
                                <button type="submit" class="btn btn-primary"><?php echo $lang('submit'); ?></button>
                            </form>
                        </div>
                        <div id="reader" class="mx-auto mt-5"></div>
                    <?php else : ?>
                        <p>Please open this url in safari browser only</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<define footer_js>
    <script>

            var qrCodeSuccessCallback = function (decodedText) {                
                if (scan) {                                        
                    scan = false;
                    $.ajax({
                        url: '<?php echo URL::full('ajax/flight/passenger-check/') ?>',
                        type: 'POST',
                        accepts: 'JSON',
                        dataType: 'JSON',
                        data: {
                            id: decodedText
                        },
                        beforeSend: function() {

                        },
                        success: function( data ) {
                            if ( !data ) {
                                swal({
                                    title: '<?php echo $lang('success') ?>',    
                                    text: decodedText,
                                    icon: "success",
                                    button: '<?php echo $lang('scan_another') ?>'
                                }).then((result) => {
                                    _handleAjax();
                                });
                            }
                            
                        }
                    });

                    var _handleAjax = function() {
                        $.ajax({
                            url: '<?php echo URL::full('ajax/flight/passenger-add/') ?>',
                            type: 'POST',
                            accepts: 'JSON',
                            dataType: 'JSON',
                            data: {
                                id: decodedText
                            },
                            beforeSend: function() {

                            },
                            success: function( data ) {
                                swal({
                                    title: '<?php echo $lang('success') ?>',    
                                    text: decodedText,
                                    icon: "success",
                                    button: '<?php echo $lang('scan_another') ?>'
                                }).then((result) => {

                                });
                            }
                        });
                    };
                }
            };

        try {


            var scan = true;

            var html5QrCode = new Html5Qrcode("reader");            
            var config = {
                fps: 10,
                qrbox: 250,
                supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA],
                facingMode: "environment"
            };

            // If you want to prefer front camera
            html5QrCode.start({
                facingMode: "environment"
            }, config, qrCodeSuccessCallback);
        } catch (e) {
            document.body.innerHTML = e.toString();
        }
    </script>

    <script>
        function submitForm(e) {
            e.preventDefault();

            var val = $('#qr_input').val().trim();            
            if ( val == '' ) return;

            qrCodeSuccessCallback(val);
        }
    </script>
</define>