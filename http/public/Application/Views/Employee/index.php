<?php

use System\Core\Model;
use System\Helpers\URL;
use System\Models\Language;


$lang = Model::get(Language::class);

?>
<define title>
    Employee
</define>
<define page_desc>
    Manage your employees from here
</define>
<define right_header>
    <a href="<?php echo URL::full('employee/add') ?>" class="btn btn-primary">Add</a>
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
                        <th><?php echo $lang('email'); ?></th>                
                        <th><?php echo $lang('airport'); ?></th>                
                        <th><?php echo $lang('action'); ?></th>    
                    </tr>
                </thead>
                <?php foreach ( $users as $item ): ?>
                    <tr>
                        <td><?php echo $item['id'] ?></td>
                        <td><?php echo htmlentities($item['name']); ?></td>
                        <td><?php echo $item['email'] ?></td>
                        <td><?php echo $item['airport'][ $lang->current() . '_name'] ?> (<?php echo $lang($item['airport']['type']); ?>)</td>
                        <td><a href="<?php echo URL::full('employee/edit/' . $item['id']); ?>" class="btn btn-primary"><?php echo $lang('edit') ?></a></td>
                    </tr>
                <?php endforeach; ?>
                <thead>
                    <tr>
                        <th><?php echo $lang('id'); ?></th>
                        <th><?php echo $lang('name'); ?></th>
                        <th><?php echo $lang('email'); ?></th>    
                        <th><?php echo $lang('airport'); ?></th>                            
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