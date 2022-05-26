<?php

use Application\Models\Flights;
use System\Core\Model;
use System\Helpers\URL;
use System\Models\Language;

$lang = Model::get(Language::class);
?>
<define title>
    <?php echo $lang('scan_flight', [ 'flight' => $flight['number'] ]) ?>
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
                    <h1><?php echo $lang('flight_num', [ 'num' => $flight['number'] ]) ?></h1>
                    <div class="other-info clearfix">
                        <p class="float-start me-3"><strong><?php echo $lang('airlines'); ?>:</strong> <?php echo $flight['number'] ?></p>
                        <p class="float-start me-3"><strong><?php echo $lang('take_off_date'); ?>:</strong> <?php echo $flight['tdate'] ?></p>
                        <p class="float-start me-3"><strong><?php echo $lang('take_off_time'); ?>:</strong> <?php echo $flight['ttime'] ?></p>
                        <p class="float-start me-3"><strong><?php echo $lang('number_of_passengers'); ?>:</strong> <?php echo $flight['passengers'] ?></p>
                        <p class="float-start me-3"><strong><?php echo $lang('source_airport'); ?>:</strong> <?php echo $flight['sairport'][$lang->current() . '_name'] ?></p>
                    </div>
                    <hr>   
                    <div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
                        <?php
                            $ciClass = "";
                            $coClass = "";
                            if ( $flight['status'] == Flights::STATUS_CHECK_IN || $flight['status'] == Flights::STATUS_OPENED )
                            {
                                $ciClass = "btn-primary";
                            } else if ( $flight['status'] == Flights::STATUS_CHECK_OUT )
                            {
                                $coClass = "btn-primary";
                            }
                        ?>
                        <a href="<?php echo !empty($ciClass) ? '' : URL::full('flights/check-in/' . $flight['id']) ?>" class="btn <?php echo $ciClass ?>"><?php echo $lang('check_in') ?></a>
                        <a href="<?php echo !empty($coClass) ? '' : URL::full('flights/check-out/' . $flight['id']) ?>" class="btn <?php echo $coClass ?>"><?php echo $lang('check_out') ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>