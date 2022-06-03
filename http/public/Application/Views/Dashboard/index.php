<?php

use Application\Models\User;
use System\Core\Model;
use System\Helpers\URL;
use System\Models\Language;
use System\Responses\View;

$lang = Model::get(Language::class);

/**
 * @var User
 */
$userM = Model::get(User::class);

?>

<div class="section">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Default</h4>
                </div>
                <div class="card-body">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link <?php echo $page == 'ms' ? 'btn-primary text-white' :  '' ?>" aria-current="page" href="<?php echo URL::full('dashboard/ms') ?>">Source - 1</a>
                        </li>                
                        <?php if ( !$userM->isExecutive() ): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $page == 'ms-2' ? 'btn-primary text-white' :  '' ?>" aria-current="page" href="<?php echo URL::full('dashboard/ms-2') ?>">Source - 2</a>
                            </li>       
                        <?php endif; ?>         
                        <li class="nav-item">
                            <a class="nav-link <?php echo $page == 'md' ? 'btn-primary text-white' :  '' ?>" href="<?php echo URL::full('dashboard/md') ?>">Destination - 1</a>
                        </li>           
                        <?php if ( !$userM->isExecutive() ): ?>     
                            <li class="nav-item">
                                <a class="nav-link <?php echo $page == 'md-2' ? 'btn-primary text-white' :  '' ?>" href="<?php echo URL::full('dashboard/md-2') ?>">Destination - 2</a>
                            </li>  
                        <?php endif; ?>               
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">        
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="#" method="GET">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="form"><?php echo $lang('from'); ?></label>
                                    <input type="date" class="form-control" name="from" id="form" value="<?php echo isset($from) ? $from : ''  ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="to"><?php echo $lang('to'); ?></label>
                                    <input type="date" class="form-control" name="to" id="to" value="<?php echo isset($to) ? $to : ''  ?>" min="<?php echo isset($from) ? $from : ''  ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><?php echo $lang('city') ?></label>      
                            <select class="form-control" name="city">
                                <option value=""><?php echo $lang('select_city') ?></option>
                                <?php foreach ( $cities as $city ): ?>
                                    <option value="<?php echo $city['id'] ?>" <?php echo $cityId == $city['id'] ? 'selected' : ''; ?>><?php echo $city[$lang->current() . '_name']; ?></option>
                                <?php endforeach; ?>
                            </select>                      
                        </div>
                        <div class="btn-group">
                            <button type="submit" class="btn btn-primary"><?php echo $lang('submit'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>    
    </div>
    
    <?php View::include('Dashboard/' . $page . '/top_widgets', [
        'from' => $from,
        'to' => $to,
        'cityId' => $cityId
    ]); ?>

    <?php View::include('Dashboard/' . $page . '/table', [
        'from' => $from,
        'to' => $to,
        'cityId' => $cityId
    ]); ?>

</div>

<define footer_js>
    <script>
        
        $('#form').on('change', function() {            
            $('#to').val('');
            $('#to').attr('min', $('#form').val());
        });

        $('.datatable').DataTable({
            responsive: true
        });

    </script>
</define>