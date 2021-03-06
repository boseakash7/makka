<?php

use System\Core\Model;
use System\Helpers\URL;
use System\Models\Language;


$lang = Model::get(Language::class);

?>
<define title>
    <?php echo $lang('airports') ?>
</define>
<define page_desc>
    <?php echo $lang('manage_your_airport_from_here') ?>
</define>
<define right_header>
    <a href="<?php echo URL::full('airports/add') ?>" class="btn btn-primary"><?php echo $lang('add') ?></a>
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
                        <th><?php echo $lang('name'); ?></th>
                        <th><?php echo $lang('city'); ?></th>                
                        <th><?php echo $lang('type'); ?></th>     
                        <th><?php echo $lang('action'); ?></th>    
                    </tr>
                </thead>
                <?php foreach ( $airports as $airport ): ?>
                    <tr>
                        <td><?php echo $airport['id'] ?></td>
                        <td><?php echo $airport[$lang->current() . '_name'] ?></td>
                        <td><?php echo $airport['city'][$lang->current() . '_name'] ?></td>
                        <td><?php echo $lang($airport['type']) ?></td>
                        <td>
                            <a href="<?php echo URL::full('airports/edit/' . $airport['id']); ?>" class="btn btn-primary"><?php echo $lang('edit') ?></a>
                            <a href="<?php echo URL::full('supervisor/add/' . $airport['id']); ?>" class="btn btn-primary"><?php echo $lang('add_supervisor') ?></a>
                            <a href="<?php echo URL::full('employee/add/' . $airport['id']); ?>" class="btn btn-primary"><?php echo $lang('add_scanner') ?></a>
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
    $('.datatable').DataTable();
} );
    </script>
</define>