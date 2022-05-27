<?php

use System\Core\Model;
use System\Helpers\URL;
use System\Models\Language;

$lang = Model::get(Language::class);

?>
<section class="section">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body text-center">
                    <i class="bi bi-check-circle success-icon"></i>
                    <h2><?php echo $lang('arrival_assesment_form_submitted') ?></h2>
                </div>
            </div>
        </div>
    </div>
</section>

<define header_css>
    <style>
        .success-icon{
            color: green;
            font-size: 50px;
        }
    </style>
</define>