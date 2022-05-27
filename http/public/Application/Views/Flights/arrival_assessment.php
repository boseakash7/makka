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
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <span class="badge custom-badge"><?php echo $arrivalInfo['langFull'] ?></span>
                </div>
                <div class="card-body">
                    <?php if( $arrivalInfo['lang'] == 'en' ): ?>
                        <?php
                            View::include('Flights/ArrivalAssessmentView/en', [
                                'arrivalInfo' => $arrivalInfo
                            ]);
                        ?>
                    <?php elseif( $arrivalInfo['lang'] == 'arb' ): ?>
                        <?php
                            View::include('Flights/ArrivalAssessmentView/arb', [
                                'arrivalInfo' => $arrivalInfo
                            ]);
                        ?>
                    <?php elseif( $arrivalInfo['lang'] == 'bng' ): ?>
                        <?php
                            View::include('Flights/ArrivalAssessmentView/bng', [
                                'arrivalInfo' => $arrivalInfo
                            ]);
                        ?>
                    <?php elseif( $arrivalInfo['lang'] == 'indo' ): ?>
                        <?php
                            View::include('Flights/ArrivalAssessmentView/indo', [
                                'arrivalInfo' => $arrivalInfo
                            ]);
                        ?>
                    <?php elseif( $arrivalInfo['lang'] == 'malay' ): ?>
                        <?php
                            View::include('Flights/ArrivalAssessmentView/malay', [
                                'arrivalInfo' => $arrivalInfo
                            ]);
                        ?>
                    <?php elseif( $arrivalInfo['lang'] == 'pak' ): ?>
                        <?php
                            View::include('Flights/ArrivalAssessmentView/pak', [
                                'arrivalInfo' => $arrivalInfo
                            ]);
                        ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<define header_css>
    <style>
        .custom-badge{
            background-color: #435ebe;
        }
    </style>
</define>