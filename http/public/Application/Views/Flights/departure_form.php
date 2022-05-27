<?php

use Application\Models\Flights;
use System\Core\Model;
use System\Helpers\URL;
use System\Models\Language;
use System\Responses\View;

$lang = Model::get(Language::class);
?>
<define title>
    <?php echo $lang('departure_form', ['flight' => $flight['number']]) ?>
</define>
<!-- <define page_desc>
    <?php // echo $lang('scan_flight_desc') 

    ?>
</define> -->
<section class="section">
    <div class="row">
        <div class="col-md-12">
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
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5><?php echo $lang('date') ?></h5>
                            <p><?php echo $departureInfo['arr']['date'] ?></p>
                        </div>

                        <div class="col">
                            <h5><?php echo $lang('departure_city') ?></h5>
                            <p><?php echo $departureInfo['arr']['departure_city'] ?></p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <h5><?php echo $lang('departure_airport') ?></h5>
                            <p><?php echo $flight['dairport'][$lang->current() . '_name'] ?></p>
                        </div>

                        <div class="col">
                            <h5><?php echo $lang('flight_number') ?></h5>
                            <p><?php echo $departureInfo['arr']['flight_number'] ?></p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <h5><?php echo $lang('flight_number') ?></h5>
                            <p><?php echo $departureInfo['arr']['flight_number'] ?></p>
                        </div>

                        <div class="col">
                            <h5><?php echo $lang('passengers') ?></h5>
                            <p><?php echo $departureInfo['arr']['passengers'] ?></p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <h5><?php echo $lang('departure_time') ?></h5>
                            <p><?php echo $departureInfo['arr']['departure_time'] ?></p>
                        </div>

                        <div class="col">
                            <h5><?php echo $lang('arrival_city') ?></h5>
                            <p><?php echo $departureInfo['arr']['arrival_city'] ?></p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <h5><?php echo $lang('arrival_time') ?></h5>
                            <p><?php echo $departureInfo['arr']['arrival_time'] ?></p>
                        </div>

                        <div class="col">
                            <h5><?php echo $lang('working_counts') ?></h5>
                            <p><?php echo $departureInfo['arr']['working_counts'] ?></p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <h5><?php echo $lang('non_working_counts') ?></h5>
                            <p><?php echo $departureInfo['arr']['non_working_counts'] ?></p>
                        </div>

                        <div class="col">
                            <h5><?php echo $lang('average_pilgrim_waiting') ?></h5>
                            <p><?php echo $departureInfo['arr']['average_pilgrim_waiting'] ?></p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <h5><?php echo $lang('average_pilgrim_service') ?></h5>
                            <p><?php echo $departureInfo['arr']['average_pilgrim_service'] ?></p>
                        </div>

                        <div class="col">
                            <h5><?php echo $lang('counters_working_start_time') ?></h5>
                            <p><?php echo $departureInfo['arr']['counters_working_start_time'] ?></p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <h5><?php echo $lang('counters_working_end_time') ?></h5>
                            <p><?php echo $departureInfo['arr']['counters_working_end_time'] ?></p>
                        </div>

                        <div class="col">
                            <h5><?php echo $lang('number_of_men') ?></h5>
                            <p><?php echo $departureInfo['arr']['number_of_men'] ?></p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <h5><?php echo $lang('number_of_women') ?></h5>
                            <p><?php echo $departureInfo['arr']['number_of_women'] ?></p>
                        </div>

                        <div class="col">
                            <h5><?php echo $lang('number_of_seats') ?></h5>
                            <p><?php echo $departureInfo['arr']['number_of_seats'] ?></p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <h5><?php echo $lang('number_of_cases') ?></h5>
                            <p><?php echo $departureInfo['arr']['number_of_cases'] ?></p>
                        </div>

                        <div class="col">
                            <h5><?php echo $lang('number_of_people_fingerprinted') ?></h5>
                            <p><?php echo $departureInfo['arr']['number_of_people_fingerprinted'] ?></p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <h5><?php echo $lang('number_of_bags') ?></h5>
                            <p><?php echo $departureInfo['arr']['number_of_bags'] ?></p>
                        </div>

                        <div class="col">
                            <h5><?php echo $lang('fingerprint_status') ?></h5>
                            <p><?php echo $departureInfo['arr']['fingerprint_status'] ?></p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <h5><?php echo $lang('connection_status') ?></h5>
                            <p><?php echo $departureInfo['arr']['connection_status'] ?></p>
                        </div>

                        <div class="col">
                            <h5><?php echo $lang('speed_of_communication') ?></h5>
                            <p><?php echo $departureInfo['arr']['speed_of_communication'] ?></p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <h5><?php echo $lang('challenges') ?></h5>
                            <p><?php echo $departureInfo['arr']['challenges'] ?></p>
                        </div>

                        <div class="col">
                            <h5><?php echo $lang('treatment') ?></h5>
                            <p><?php echo $departureInfo['arr']['treatment'] ?></p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <h5><?php echo $lang('recommendations') ?></h5>
                            <p><?php echo $departureInfo['arr']['recommendations'] ?></p>
                        </div>

                        <div class="col">
                            <h5><?php echo $lang('reviews') ?></h5>
                            <p><?php echo $departureInfo['arr']['reviews'] ?></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>