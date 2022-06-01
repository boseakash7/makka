<?php

use System\Core\Model;
use System\Models\Language;

$lang = Model::get(Language::class);
?>

<div class="section">
    <div class="row">

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center"><?php echo $lang('number_of_flights') ?></h3>
                </div>
                <div class="card-body">
                    <div class="number text-center h1 text-primary">1,23,45</div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center"><?php echo $lang('number_of_flights') ?></h3>
                </div>
                <div class="card-body">
                    <div class="number text-center h1 text-primary">1,23,45</div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center"><?php echo $lang('passengers') ?></h3>
                </div>
                <div class="card-body">
                    <div class="number text-center h1 text-primary">1,23,45</div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center"><?php echo $lang('avg_service_time') ?></h3>
                </div>
                <div class="card-body">
                    <div class="number text-center h1 text-primary">1,23,45</div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center"><?php echo $lang('counter_working_time') ?></h3>
                </div>
                <div class="card-body">
                    <div class="number text-center h1 text-primary">1,23,45</div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center"><?php echo $lang('hajj_satisfaction_rate') ?></h3>
                </div>
                <div class="card-body">
                    <div class="number text-center h1 text-primary">1,23,45</div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <h3 class="details"><?php echo $lang('details'); ?></h3>
        </div>        
        <div class="col-md-12">
            <table class="table datatable">
                <thead>
                    <tr>
                        <td><?php echo $lang('asd') ?></td>
                        <td><?php echo $lang('asd') ?></td>
                        <td><?php echo $lang('asd') ?></td>
                        <td><?php echo $lang('asd') ?></td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>    
</div>

<define footer_js>
    <script>
        $('.datatable').DataTable();
    </script>
</define>