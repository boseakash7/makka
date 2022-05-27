<?php

use Application\Models\Flights;
use System\Core\Model;
use System\Helpers\URL;
use System\Models\Language;
use System\Responses\View;

$lang = Model::get(Language::class);
?>
<define title>
    <?php echo $lang('departure_assessment', ['flight' => $flight['number']]) ?>
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
                    <span class="badge custom-badge"><?php echo $departureInfo['langFull'] ?></span>
                </div>
                <div class="card-body">
                    <?php if( $departureInfo['lang'] == 'en' ): ?>
                        <?php
                            View::include('Flights/DepartureAssessmentView/en', [
                                'departureInfo' => $departureInfo
                            ]);
                        ?>
                    <?php elseif( $departureInfo['lang'] == 'arb' ): ?>
                        <?php
                            View::include('Flights/DepartureAssessmentView/arb', [
                                'departureInfo' => $departureInfo
                            ]);
                        ?>
                    <?php elseif( $departureInfo['lang'] == 'bng' ): ?>
                        <?php
                            View::include('Flights/DepartureAssessmentView/bng', [
                                'departureInfo' => $departureInfo
                            ]);
                        ?>
                    <?php elseif( $departureInfo['lang'] == 'indo' ): ?>
                        <?php
                            View::include('Flights/DepartureAssessmentView/indo', [
                                'departureInfo' => $departureInfo
                            ]);
                        ?>
                    <?php elseif( $departureInfo['lang'] == 'malay' ): ?>
                        <?php
                            View::include('Flights/DepartureAssessmentView/malay', [
                                'departureInfo' => $departureInfo
                            ]);
                        ?>
                    <?php elseif( $departureInfo['lang'] == 'pak' ): ?>
                        <?php
                            View::include('Flights/DepartureAssessmentView/pak', [
                                'departureInfo' => $departureInfo
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