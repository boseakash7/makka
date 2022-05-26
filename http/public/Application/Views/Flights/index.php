<?php

use Application\Models\Flights;
use System\Core\Model;
use System\Helpers\URL;
use System\Models\Language;


$lang = Model::get(Language::class);

?>
<define title>
    Flights
</define>
<define page_desc>
    Manage your flights from here
</define>
<define right_header>
    <a href="<?php echo URL::full('flights/add') ?>" class="btn btn-primary"><?php echo $lang('add') ?></a>
    <a href="<?php echo URL::full('flights') ?>" class="btn btn-primary"><?php echo $lang('reload') ?></a>
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
                        <th><?php echo $lang('number_of_passengers'); ?></th>
                        <th><?php echo $lang('status'); ?></th>
                        <!-- <th><?php // echo $lang('source'); ?></th> -->
                        <!-- <th><?php // echo $lang('destination'); ?></th> -->
                        <th><?php echo $lang('action'); ?></th>
                    </tr>
                </thead>
                <?php foreach ( $flights as $flight ): ?>
                    <tr>
                        <td><?php echo $flight['id'] ?></td>
                        <td><?php echo htmlentities($flight['number']); ?></td>
                        <td><?php echo htmlentities($flight['airline'][$lang->current() . '_name']); ?></td>
                        <td><?php echo $flight['tdate'] ?></td>
                        <td><?php echo $flight['ttime'] ?></td>
                        <td><?php echo $flight['passengers'] ?></td>                        
                        <td><span class="badge bg-primary"><?php echo $lang($flight['status']); ?></span></td>                        
                        <!-- <td><?php // echo $flight['sairport'][$lang->current() . '_name']; ?></td>       -->
                        <!-- <td><?php // echo $flight['dairport'][$lang->current() . '_name']; ?></td>       -->
                        <td>
                            <?php if ( $flight['status'] == Flights::STATUS_NOT_OPENED ): ?>
                                <a href="<?php echo URL::full('flights/open/' . $flight['id']) ?>" class="btn btn-primary"><?php echo $lang('open'); ?></a>
                            <?php elseif( $flight['status'] == Flights::STATUS_OPENED ): ?>
                                <a href="<?php echo URL::full('flights/scan/' . $flight['id']) ?>" class="btn btn-danger" target="_blank"><?php echo $lang('start_scanning') ?></a>
                                <a href="<?php echo URL::full('flights/log/' . $flight['id']) ?>" class="btn btn-info" target="_blank"><?php echo $lang('view_log') ?></a>
                            <?php endif; ?>
                            <a href="<?php echo URL::full('flights/edit/' . $flight['id']); ?>" class="btn btn-primary"><?php echo $lang('edit') ?></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <thead>
                    <tr>
                    <th><?php echo $lang('id'); ?></th>
                        <th><?php echo $lang('flight_number'); ?></th>
                        <th><?php echo $lang('airlines'); ?></th>
                        <th><?php echo $lang('take_off_date'); ?></th>
                        <th><?php echo $lang('take_off_time'); ?></th>
                        <th><?php echo $lang('number_of_passengers'); ?></th>
                        <th><?php echo $lang('status'); ?></th>
                        <!-- <th><?php // echo $lang('source'); ?></th> -->
                        <!-- <th><?php // echo $lang('destination'); ?></th> -->                        
                        <th><?php echo $lang('action'); ?></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<define footer_js>
    <script>
        $(document).ready( function () {
            $('.datatable').DataTable();
        } );
    </script>
</define>