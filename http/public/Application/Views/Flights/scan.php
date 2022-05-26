<?php

use System\Core\Model;
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
                    <h1><?php echo $lang('flight_number', [ 'num' => $flight['number'] ]) ?></h1>
                </div>
            </div>
        </div>
    </div>
</section>