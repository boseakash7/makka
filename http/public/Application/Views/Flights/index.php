<?php

use Application\Controllers\Ajax\Flight;
use Application\Models\Flights;
use Application\Models\User;
use System\Core\Model;
use System\Helpers\URL;
use System\Models\Language;


$lang = Model::get(Language::class);

$userM = Model::get(User::class);

?>
<define title>
    <?php echo $lang('flights') ?>
</define>
<define page_desc>
    <?php echo $lang('manage_flights_from_here') ?>
</define>
<define right_header>
    <?php if ( !isset($arrival) && $userM->isSup() ): ?>
    <a href="<?php echo URL::full('flights/add') ?>" class="btn btn-primary"><?php echo $lang('add') ?></a>
    <?php endif; ?>
    <a href="<?php echo URL::current() ?>" class="btn btn-primary"><?php echo $lang('reload') ?></a>
</define>
<section class="section">
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <table class="datatable table">
                <thead>
                    <tr>
                        <th><?php echo $lang('id'); ?></th>
                        <th><?php echo $lang('flight_number'); ?></th>
                        <th><?php echo $lang('airlines'); ?></th>
                        <th><?php echo $lang('take_off_date'); ?></th>
                        <th><?php echo $lang('take_off_time'); ?></th>
                        <th><?php echo $lang('saudi_date'); ?></th>
                        <th><?php echo $lang('saudi_time'); ?></th>
                        <th><?php echo $lang('number_of_passengers'); ?></th>
                        <th><?php echo $lang('status'); ?></th>
                        <!-- <th><?php // echo $lang('source'); ?></th> -->
                        <!-- <th><?php // echo $lang('destination'); ?></th> -->
                        <th><?php echo $lang('action'); ?></th>
                    </tr>
                </thead>
                <?php foreach ( $flights as $flight ): ?>

                    
                    <?php 
                        $statusBg = 'bg-primary';

                        switch( $flight['status'] )
                        {
                            case Flights::STATUS_NOT_OPENED:
                                $statusBg = 'bg-secondary';
                                break;
                            case Flights::STATUS_CHECK_IN:
                            case Flights::STATUS_CHECK_OUT:
                                $statusBg = 'bg-primary';
                                break;
                            case Flights::STATUS_ON_AIR:                            
                                $statusBg = 'bg-warning';
                                break;
                            case Flights::STATUS_CLOSED:                            
                                $statusBg = 'bg-warning';
                                break;
                            case Flights::STATUS_ARRIVED:                            
                                $statusBg = 'bg-info';
                                break;
                            case Flights::STATUS_COMPLETE:                            
                                $statusBg = 'bg-info';
                                break;
                        }
                    ?>
                    <tr>
                        <td><?php echo $flight['id'] ?></td>
                        <td><?php echo htmlentities($flight['number']); ?></td>
                        <td><?php echo htmlentities($flight['airline'][$lang->current() . '_name']); ?></td>
                        <td><?php echo $flight['tdate'] ?></td>
                        <td><?php echo $flight['ttime'] ?></td>
                        <td><?php echo $flight['saudi_date'] ?></td>
                        <td><?php echo $flight['saudi_time'] ?></td>
                        <td><?php echo $flight['passengers'] ?></td>                        
                        <td><span class="badge <?php echo $statusBg ?>"><?php echo $lang($flight['status']); ?></span></td>                        
                        <!-- <td><?php // echo $flight['sairport'][$lang->current() . '_name']; ?></td>       -->
                        <!-- <td><?php // echo $flight['dairport'][$lang->current() . '_name']; ?></td>       -->
                        <td>
                            <?php if ( $flight['status'] == Flights::STATUS_NOT_OPENED ): ?>
                                <?php if ( $userM->isSup() ): ?>
                                <a href="<?php echo URL::full('flights/open/' . $flight['id']) ?>" class="btn btn-primary"><?php echo $lang('open'); ?></a>
                                <a href="<?php echo URL::full('flights/edit/' . $flight['id']); ?>" class="btn btn-primary"><?php echo $lang('edit') ?></a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            <?php elseif( $flight['status'] == Flights::STATUS_OPENED || $flight['status'] == Flights::STATUS_CHECK_IN || $flight['status'] == Flights::STATUS_CHECK_OUT ): ?>                                
                                <?php if ( $userM->isEmp() ): ?>
                                    <a href="<?php echo URL::full('flights/scan/' . $flight['id']) ?>/check-in" class="btn btn-danger" target="_blank"><?php echo $lang('start_scanning') ?></a>
                                <?php endif; ?>
                                <?php if ( $userM->isSup() ): ?>
                                    <a href="<?php echo URL::full('flights/close/' . $flight['id']) ?>" class="btn btn-secondary m-2 close-flight"><?php echo $lang('close_flight') ?></a>                                    
                                <?php endif; ?>
                                    <a href="<?php echo URL::full('/form/departure-assessment/' . $flight['id']) ?>" class="btn btn-primary m-2" target="_blank"><?php echo $lang('assessment_form') ?></a>
                            <?php elseif ( $flight['status'] == Flights::STATUS_CLOSED ): ?>
                                <?php if ( $userM->isSup() ): ?>
                                    <a href="<?php echo URL::full('form/departure/' . $flight['id']) ?>" class="btn btn-primary"><?php echo $lang('departure_form_submit') ?></a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            <?php elseif ( $flight['status'] == Flights::STATUS_ON_AIR ): ?>
                                <?php if ( $userM->isSup() ): ?>
                                    <a href="<?php echo URL::full('flights/arrived/' . $flight['id']) ?>" class="btn btn-primary m-2"><?php echo $lang('arrived') ?></a>        
                                <?php else: ?>
                                    -
                                    <?php endif; ?>                                    
                            <?php elseif ( $flight['status'] == Flights::STATUS_ARRIVED ): ?>
                                <?php if ( $userM->isSup() ): ?>
                                    <a href="<?php echo URL::full('/form/arrival-assessment/' . $flight['id']) ?>" class="btn btn-primary m-2" target="_blank"><?php echo $lang('assessment_form') ?></a>
                                    <a href="<?php echo URL::full('form/arrival/' . $flight['id']) ?>" class="btn btn-primary" target="_blank"><?php echo $lang('arrival_form_submit') ?></a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            <?php elseif ( $flight['status'] == Flights::STATUS_COMPLETE ): ?>
                                <?php if ( $userM->isSup() ): ?>
                                    <a href="<?php echo URL::full('flights/summary/' . $flight['id']) ?>" class="btn btn-primary" target="_blank"><?php echo $lang('view_summery') ?></a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            <?php endif; ?>              
                            <?php if ( !isset($arrival) ): ?>                                          
                            <a href="<?php echo URL::full('flights/log/' . $flight['id']) ?>" class="btn btn-info m-2" target="_blank"><?php echo $lang('view_log') ?></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                
            </table>
        </div>
    </div>
</div>

<define footer_js>
    <script>
        $(document).ready( function () {
            $('.table').DataTable({
                responsive: true
            });
        } );

        $(".close-flight").on('click', function(e) {
            e.preventDefault();

            var href = $(this).attr('href');

            swal({
                title: "<?php echo $lang('are_you_sure_close_flight') ?>",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
            .then((confirm) => {
            if (confirm) {
                window.location.href = href;
            }
            });
        })

        <?php if( count($flights) > 0 ): ?>
            setTimeout(function() {
                window.location.reload();
            }, 30000);
        <?php endif; ?>
    </script>
</define>


<define header_css>
    <style>
        /* .dataTables_wrapper {
            overflow-y: auto;
        } */
    </style>
</define>