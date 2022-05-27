<?php

use System\Core\Model;
use System\Helpers\URL;
use System\Libs\FormValidator;
use System\Models\Language;
use System\Responses\View;

$lang = Model::get(Language::class);

$formValidator = FormValidator::instance("departure-assesment");

?>
<define title>
    Departure Assesment Form
</define>
<define page_desc>
    Complete the form
</define>
<define right_header>
    <a href="<?php echo URL::full('flights') ?>">
        < Back</a>
</define>
<section class="section">
    <div class="row">
        <div class="col-md-12">
            <form action="<?php echo URL::current() . '?lang=' . $selectedLang?>" method="POST">
                <div class="card">
                    <div class="card-header">

                    </div>
                    <div class="card-body">


                        <div class="form-group">
                            <label class="mb-2" for="selected_lang">Language<span class="text-danger">*</span></label>
                            <select name="selected_lang" class="form-control" id="selected_lang">
                                <option <?php if( $selectedLang == 'en' ) echo 'selected' ?> value="en">English</option>
                                <option <?php if( $selectedLang == 'indo' ) echo 'selected' ?> value="indo">Indonesia</option>
                                <option <?php if( $selectedLang == 'malay' ) echo 'selected' ?> value="malay">Malaysia</option>
                                <option <?php if( $selectedLang == 'pak' ) echo 'selected' ?> value="pak">Pakistan</option>
                                <option <?php if( $selectedLang == 'arb' ) echo 'selected' ?> value="arb">Arabic</option>
                                <option <?php if( $selectedLang == 'bng' ) echo 'selected' ?> value="bng">Bangladesh</option>
                            </select>
                        </div>
                    </div>
                </div>
                    <?php if ($selectedLang == 'en') : ?>
                        <?php
                            View::include('Form/DepartureAssesmentForm/en_form', [
                                'flight' => $flight,
                                'lang' => $lang
                            ]);
                        ?>
                    <?php elseif( $selectedLang == 'indo' ): ?>
                        <?php
                            View::include('Form/DepartureAssesmentForm/indo_form', [
                                'flight' => $flight,
                                'lang' => $lang
                            ]);
                        ?>
                    <?php elseif( $selectedLang == 'malay' ): ?>
                        <?php
                            View::include('Form/DepartureAssesmentForm/malay_form', [
                                'flight' => $flight,
                                'lang' => $lang
                            ]);
                        ?>
                    <?php elseif( $selectedLang == 'pak' ): ?>
                        <?php
                            View::include('Form/DepartureAssesmentForm/pak_form', [
                                'flight' => $flight,
                                'lang' => $lang
                            ]);
                        ?>
                    <?php elseif( $selectedLang == 'arb' ): ?>
                        <?php
                            View::include('Form/DepartureAssesmentForm/arb_form', [
                                'flight' => $flight,
                                'lang' => $lang
                            ]);
                        ?>
                    <?php elseif( $selectedLang == 'bng' ): ?>
                        <?php
                            View::include('Form/DepartureAssesmentForm/bng_form', [
                                'flight' => $flight,
                                'lang' => $lang
                            ]);
                        ?>
                    <?php endif; ?>
            </form>
        </div>
    </div>
</section>

<define footer_js>
    <script>
        $("#selected_lang").on('change', function(e) {
            var selectedLang = $(this).val();

            window.location.href = '<?php echo URL::current() . '?lang=' ?>' + selectedLang;
        })
    </script>
</define>