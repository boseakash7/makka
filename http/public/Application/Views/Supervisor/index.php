<?php

use System\Core\Model;
use System\Helpers\URL;
use System\Models\Language;


$lang = Model::get(Language::class);

?>
<define title>
    <?php echo $lang('supervisor') ?>
</define>
<define page_desc>
    <?php echo $lang('manage_your_supervisor_from_here') ?>
</define>
<define right_header>
    <a href="<?php echo URL::full('supervisor/add') ?>" class="btn btn-primary"><?php echo $lang('add') ?></a>
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
                <?php foreach ($users as $item) : ?>
                    <tr>
                        <td><?php echo $item['id'] ?></td>
                        <td><?php echo htmlentities($item['name']); ?></td>
                        <td><?php echo $item['email'] ?></td>
                        <td><?php echo $item['airport'][$lang->current() . '_name'] ?> (<?php echo $lang($item['airport']['type']); ?>)</td>
                        <td><a href="<?php echo URL::full('supervisor/edit/' . $item['id']); ?>" class="btn btn-primary"><?php echo $lang('edit') ?></a></td>
                    </tr>
                <?php endforeach; ?>
                <tfoot>
                    <tr>
                        <th><?php echo $lang('id'); ?></th>
                        <th><?php echo $lang('name'); ?></th>
                        <th><?php echo $lang('email'); ?></th>
                        <th><?php echo $lang('airport'); ?></th>
                        <th><?php echo $lang('action'); ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    </div>

    <define footer_js>
        <script>
            $(document).ready(function() {
                $('.datatable').DataTable({
                    responsive: true
                });
            });
        </script>
    </define>