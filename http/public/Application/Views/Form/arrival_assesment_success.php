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
                    <a href="#!" class="go-back"><u><?php echo $lang('do_another_assessment') ?></u></a>
                </div>
            </div>
        </div>
    </div>
</section>

<define footer_js>
    <script>
        $(".go-back").on('click', function(e) {
            e.preventDefault();

            window.history.back();
        })
    </script>
</define>

<define header_css>
    <style>
        .success-icon{
            color: green;
            font-size: 50px;
        }
    </style>
</define>