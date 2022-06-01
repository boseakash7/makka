<?php

use Application\Models\Flights;
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
        <div class="col-md-12">
            <div class="card">                
                <div class="card-body">
                    <?php if ( !empty($passengers) ): ?>
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th><?php echo $lang('check_in') ?></th>
                                    <th><?php echo $lang('check_out') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ( $passengers as $passenger ): ?>
                                <tr>
                                    <td><?php echo $passenger['info']; ?></td>
                                    <td><?php echo $passenger['check_in_time'] != null ? date('Y-m-d H:i:s', $passenger['check_in_time']) : '-'; ?></td>
                                    <td><?php echo $passenger['check_out_time'] != null ? date('Y-m-d H:i:s', $passenger['check_out_time']) : '-'; ?></td>
                                </tr>
                            
                            <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th><?php echo $lang('check_in') ?></th>
                                    <th><?php echo $lang('check_out') ?></th>
                                </tr>
                            </tfoot>
                        </table>                        
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
        <?php if( $flight['status'] != Flights::STATUS_COMPLETE ): ?>
            setTimeout(function() {
                window.location.reload();
            }, 3000);
        <?php endif; ?>
    </script>
</define>