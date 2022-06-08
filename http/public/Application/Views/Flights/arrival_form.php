<?php

use Application\Models\Flights;
use Application\Models\User;
use System\Core\Model;
use System\Helpers\URL;
use System\Models\Language;
use System\Responses\View;

$lang = Model::get(Language::class);

$userM = Model::get(User::class);
?>
<define title>
    <?php echo $lang('arrival_form', ['flight' => $flight['number']]) ?>
</define>
<!-- <define page_desc>
    <?php // echo $lang('scan_flight_desc') 

    ?>
</define> -->
<section class="section">
    <div class="row">
        <div class="col-md-12">
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
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <?php if( $userM->isSupAdmin() ) : ?>
                        <a href="<?php echo URL::full('/form/arrival/edit/' . $arrivalInfo['flight_id']) ?>" class="btn btn-primary">Edit Form</a>
                    <?php endif; ?>
                </div>
                <?php
                    if ( !empty($arrivalInfo) ):
                ?>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5><?php echo $lang('date') ?></h5>
                            <p><?php echo $arrivalInfo['arr']['date'] ?></p>
                        </div>

                        <div class="col">
                            <h5><?php echo $lang('arrival_city') ?></h5>
                            <p><?php echo $arrivalFlightInfo[$lang->current() . '_name'] ?></p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <h5><?php echo $lang('flight_number') ?></h5>
                            <p><?php echo $arrivalInfo['arr']['flight_number'] ?></p>
                        </div>

                        <div class="col">
                            <h5><?php echo $lang('number_of_staffs') ?></h5>
                            <p><?php echo $arrivalInfo['arr']['number_of_staffs'] ?></p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <h5><?php echo $lang('number_of_counter_custom_staffs') ?></h5>
                            <p><?php echo $arrivalInfo['arr']['number_of_counter_custom_staffs'] ?></p>
                        </div>

                        <div class="col">
                            <h5><?php echo $lang('passengers') ?></h5>
                            <p><?php echo $arrivalInfo['arr']['passengers'] ?></p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <h5><?php echo $lang('arrival_time') ?></h5>
                            <p><?php echo date('Y-m-d H:i', strtotime($arrivalInfo['arr']['arrival_time'])) ?></p>
                        </div>

                        <div class="col">
                            <h5><?php echo $lang('take_off_place') ?></h5>
                            <p><?php echo $takeOffPlace[$lang->current() . '_name'] ?></p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <h5><?php echo $lang('expected_arrival_time') ?></h5>
                            <p><?php echo $arrivalInfo['arr']['expected_arrival_time'] ?></p>
                        </div>

                        <div class="col">
                            <h5><?php echo $lang('average_waiting_time_unitil_access') ?></h5>
                            <p><?php echo $arrivalInfo['arr']['average_waiting_time_unitil_access'] ?></p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <h5><?php echo $lang('average_waiting_time_unitil_end_of_inspection') ?></h5>
                            <p><?php echo $arrivalInfo['arr']['average_waiting_time_unitil_end_of_inspection'] ?></p>
                        </div>

                        <div class="col">
                            <h5><?php echo $lang('average_waiting_until_sorting_system') ?></h5>
                            <p><?php echo $arrivalInfo['arr']['average_waiting_until_sorting_system'] ?></p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <h5><?php echo $lang('how_long_does_luggage_arrive_at') ?></h5>
                            <p><?php echo $arrivalInfo['arr']['how_long_does_luggage_arrive_at'] ?></p>
                        </div>

                        <div class="col">
                            <h5><?php echo $lang('duration_of_arrival_pilgrims') ?></h5>
                            <p><?php echo $arrivalInfo['arr']['duration_of_arrival_pilgrims'] ?></p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <h5><?php echo $lang('flight_delay') ?></h5>
                            <p><?php echo $lang( $arrivalInfo['arr']['flight_delay']) ?></p>
                        </div>

                        <div class="col">
                            <h5><?php echo $lang('number_of_buses_operated_to_transport_pilgrims') ?></h5>
                            <p><?php echo $arrivalInfo['arr']['number_of_buses_operated_to_transport_pilgrims'] ?></p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <h5><?php echo $lang('number_of_buses_operating_with_mecca_logo') ?></h5>
                            <p><?php echo $arrivalInfo['arr']['number_of_buses_operating_with_mecca_logo'] ?></p>
                        </div>

                        <div class="col">
                            <h5><?php echo $lang('are_there_unmarked_buses') ?></h5>
                            <p><?php echo $lang($arrivalInfo['arr']['are_there_unmarked_buses']) ?></p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <h5><?php echo $lang('are_there_any_accidents') ?></h5>
                            <p><?php echo $lang($arrivalInfo['arr']['are_there_any_accidents'] )?></p>
                        </div>

                        <div class="col">
                            <h5><?php echo $lang('number_of_cases') ?></h5>
                            <p><?php echo $arrivalInfo['arr']['number_of_cases'] ?></p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <h5><?php echo $lang('challenges') ?></h5>
                            <p><?php echo $arrivalInfo['arr']['challenges'] ?></p>
                        </div>

                        <div class="col">
                            <h5><?php echo $lang('solutions') ?></h5>
                            <p><?php echo $arrivalInfo['arr']['solutions'] ?></p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <h5><?php echo $lang('recommendations') ?></h5>
                            <p><?php echo $arrivalInfo['arr']['recommendations'] ?></p>
                        </div>

                        <div class="col">
                            <h5><?php echo $lang('reviews') ?></h5>
                            <p><?php echo $arrivalInfo['arr']['reviews'] ?></p>
                        </div>

                    </div>
                </div>
                <?php
                else:
                ?>
                    <div class="card-body">
                        <?php echo $lang('no_data'); ?>
                    </div>
                <?php
                endif;
                ?>
            </div>
        </div>
    </div>
</section>