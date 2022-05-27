<?php

use Application\Models\Flights;
use System\Core\Model;
use System\Helpers\URL;
use System\Models\Language;
use System\Responses\View;

$lang = Model::get(Language::class);
?>
<define title>
    <?php echo $lang('arrival_assessment', ['flight' => $flight['number']]) ?>
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
            <?php foreach ($arrivalInfos as $arrivalInfo) : ?>
                <div class="card">
                    <div class="card-header">
                        <span class="badge custom-badge"><?php echo $arrivalInfo['langFull'] ?></span>
                    </div>
                    <div class="card-body">
                        <?php if ($arrivalInfo['lang'] == 'en') : ?>
                            <?php
                            View::include('Flights/ArrivalAssessmentView/en', [
                                'arrivalInfo' => $arrivalInfo
                            ]);
                            ?>
                        <?php elseif ($arrivalInfo['lang'] == 'arb') : ?>
                            <?php
                            View::include('Flights/ArrivalAssessmentView/arb', [
                                'arrivalInfo' => $arrivalInfo
                            ]);
                            ?>
                        <?php elseif ($arrivalInfo['lang'] == 'bng') : ?>
                            <?php
                            View::include('Flights/ArrivalAssessmentView/bng', [
                                'arrivalInfo' => $arrivalInfo
                            ]);
                            ?>
                        <?php elseif ($arrivalInfo['lang'] == 'indo') : ?>
                            <?php
                            View::include('Flights/ArrivalAssessmentView/indo', [
                                'arrivalInfo' => $arrivalInfo
                            ]);
                            ?>
                        <?php elseif ($arrivalInfo['lang'] == 'malay') : ?>
                            <?php
                            View::include('Flights/ArrivalAssessmentView/malay', [
                                'arrivalInfo' => $arrivalInfo
                            ]);
                            ?>
                        <?php elseif ($arrivalInfo['lang'] == 'pak') : ?>
                            <?php
                            View::include('Flights/ArrivalAssessmentView/pak', [
                                'arrivalInfo' => $arrivalInfo
                            ]);
                            ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<define header_css>
    <style>
        .custom-badge {
            background-color: #435ebe;
        }
    </style>
</define>