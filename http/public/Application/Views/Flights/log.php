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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
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
    <div class="row">
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