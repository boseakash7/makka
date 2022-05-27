<?php

use System\Core\Model;
use System\Models\Language;

$lang = Model::get(Language::class);
?>
<define title>
    <?php echo $lang('logs_for', [ 'flight' => $flight['number'] ]) ?>
</define>
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
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3><?php echo $lang('check_in') ?></h3>
                </div>
                <div class="card-body">
                    <?php if ( !empty($ciPassengers) ): ?>
                        <?php foreach ( $ciPassengers as $passenger ): ?>
                            <div class="mb-2 mt-2 clearfix">
                                <?php echo $passenger['info']; ?>
                                <p class="special-need">
                                    <strong><?php echo $lang('special') ?>:</strong> <?php echo $lang($passenger['special']) ?>
                                </p>
                                <strong class="float-end"><?php echo date('Y-m-d H:m:s', $passenger['created_at']); ?></strong>
                            </div>
                            <hr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <?php echo $lang('no_data') ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3><?php echo $lang('check_out') ?></h3>
                </div>
                <div class="card-body">
                <?php if ( !empty($coPassengers) ): ?>
                        <?php foreach ( $coPassengers as $passenger ): ?>
                            <div class="mb-2 mt-2 clearfix">
                                <?php echo $passenger['info']; ?>
                                <strong class="float-end"><?php echo date('Y-m-d H:m:s', $passenger['created_at']); ?></strong>
                            </div>
                            <hr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <?php echo $lang('no_data') ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>    
</section>

<define footer_js>
    <script>
        setTimeout(function() {
            window.location.reload();
        }, 3000);
    </script>
</define>