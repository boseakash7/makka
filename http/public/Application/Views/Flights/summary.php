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
                        <a target="_blank" href="<?php echo URL::full('flights/arrival-assessment/' . $flight['id']) ?>" class="btn btn-primary mb-2"><?php echo $lang('view_arrival_assessment') ?>View Arrival Assessment</a>
                        <a target="_blank" href="<?php echo URL::full('flights/departure-assessment/' . $flight['id']) ?>" class="btn btn-primary mb-2"><?php echo $lang('view_departure_assessment') ?>View Departure Assessment</a>
                        <a target="_blank" href="<?php echo URL::full('flights/departure-form/' . $flight['id']) ?>" class="btn btn-primary mb-2"><?php echo $lang('view_departure_form') ?>View Departure Form</a>
                        <a target="_blank" href="<?php echo URL::full('flights/arrival-form/' . $flight['id']) ?>" class="btn btn-primary mb-2"><?php echo $lang('view_arrival_form') ?>View Arrival Form</a>
                        <a target="_blank" href="<?php echo URL::full('flights/log/' . $flight['id']) ?>" class="btn btn-primary mb-2"><?php echo $lang('view_logs') ?>View Logs</a>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</section>