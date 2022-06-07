<?php

use System\Libs\FormValidator;

$formValidator = FormValidator::instance("departure-assesment");

?>
<div class="card">
    <div class="card-body">
        Selamat datang.. Sila nilai mengenai perkhidmatan yang kami sediakan kepada Jemaah
        Haji sebelum berlepas dari Saudi Arabia.
    </div>
</div>
<div class="card">
    <div class="card-header">

    </div>
    <div class="card-body">
        <div class="form-group">
            <label class="mb-2" for="employment_interaction">Kediaman Jemaah Haji dilengkapi dan Sesuai.<span class="text-danger">*</span></label>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('employment_interaction') == 'Yes' ) echo 'checked' ?> value="Yes" class="form-check-input" type="radio" name="employment_interaction" id="employment_interaction1">
                <label class="form-check-label" for="employment_interaction1">
                    Saya setuju <i class="bi bi-emoji-laughing-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('employment_interaction') == 'Somewhat' ) echo 'checked' ?> value="Somewhat" class="form-check-input" type="radio" name="employment_interaction" id="employment_interaction2">
                <label class="form-check-label" for="employment_interaction2">
                    Semacam <i class="bi bi-emoji-neutral-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('employment_interaction') == 'Not' ) echo 'checked' ?> value="Not" class="form-check-input" type="radio" name="employment_interaction" id="employment_interaction3">
                <label class="form-check-label" for="employment_interaction3">
                Saya tidak setuju <i class="bi bi-emoji-angry-fill"></i>
                </label>
            </div>
            <?php if ($formValidator->hasError('employment_interaction')) : ?>
                <p class="text-danger"><?php echo $formValidator->getError('employment_interaction'); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">

    </div>
    <div class="card-body">
        <div class="form-group">
            <label class="mb-2" for="clarity_procedure">Prosedur Dokumentasi<span class="text-danger">*</span></label>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('clarity_procedure') == 'Yes' ) echo 'checked' ?> value="Yes" class="form-check-input" type="radio" name="clarity_procedure" id="clarity_procedure1">
                <label class="form-check-label" for="clarity_procedure1">
                    Saya setuju <i class="bi bi-emoji-laughing-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('clarity_procedure') == 'Somewhat' ) echo 'checked' ?> value="Somewhat" class="form-check-input" type="radio" name="clarity_procedure" id="clarity_procedure2">
                <label class="form-check-label" for="clarity_procedure2">
                    Semacam <i class="bi bi-emoji-neutral-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('clarity_procedure') == 'Not' ) echo 'checked' ?> value="Not" class="form-check-input" type="radio" name="clarity_procedure" id="clarity_procedure3">
                <label class="form-check-label" for="clarity_procedure3">
                    Saya tidak setuju <i class="bi bi-emoji-angry-fill"></i>
                </label>
            </div>
            <?php if ($formValidator->hasError('clarity_procedure')) : ?>
                <p class="text-danger"><?php echo $formValidator->getError('clarity_procedure'); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">

    </div>
    <div class="card-body">
        <div class="form-group">
            <label class="mb-2" for="employment_interaction">Akses mudah ke Pintu Makkah Road<span class="text-danger">*</span></label>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('service_provided') == 'Yes' ) echo 'checked' ?> value="Yes" class="form-check-input" type="radio" name="service_provided" id="service_provided1">
                <label class="form-check-label" for="service_provided1">
                    Saya setuju <i class="bi bi-emoji-laughing-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('service_provided') == 'Somewhat' ) echo 'checked' ?> value="Somewhat" class="form-check-input" type="radio" name="service_provided" id="service_provided2">
                <label class="form-check-label" for="service_provided2">
                    Semacam <i class="bi bi-emoji-neutral-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('service_provided') == 'Not' ) echo 'checked' ?> value="Not" class="form-check-input" type="radio" name="service_provided" id="service_provided3">
                <label class="form-check-label" for="service_provided3">
                    Saya tidak setuju <i class="bi bi-emoji-angry-fill"></i>
                </label>
            </div>
            <?php if ($formValidator->hasError('service_provided')) : ?>
                <p class="text-danger"><?php echo $formValidator->getError('service_provided'); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">

    </div>
    <div class="card-body">
        <div class="form-group">
            <label class="mb-2" for="employment_interaction">Disambut dan disapa apabila masuk ke Pintu Jalan Makkah<span class="text-danger">*</span></label>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('makkah_hall') == 'Yes' ) echo 'checked' ?> value="Yes"  class="form-check-input" type="radio" name="makkah_hall" id="makkah_hall1">
                <label class="form-check-label" for="makkah_hall1">
                    Saya setuju <i class="bi bi-emoji-laughing-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('makkah_hall') == 'Somewhat' ) echo 'checked' ?> value="Somewhat"  class="form-check-input" type="radio" name="makkah_hall" id="makkah_hall2">
                <label class="form-check-label" for="makkah_hall2">
                    Semacam <i class="bi bi-emoji-neutral-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('makkah_hall') == 'Not' ) echo 'checked' ?> value="Not" class="form-check-input" type="radio" name="makkah_hall" id="makkah_hall3">
                <label class="form-check-label" for="makkah_hall3">
                    Saya tidak setuju <i class="bi bi-emoji-angry-fill"></i>
                </label>
            </div>
            <?php if ($formValidator->hasError('makkah_hall')) : ?>
                <p class="text-danger"><?php echo $formValidator->getError('makkah_hall'); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">

    </div>
    <div class="card-body">
        <div class="form-group">
            <label class="mb-2" for="employment_interaction">Saya mendapat manfaat daripada video yang ditayangkan<span class="text-danger">*</span></label>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('awareness') == 'Yes' ) echo 'checked' ?> value="Yes" class="form-check-input" type="radio" name="awareness" id="awareness1">
                <label class="form-check-label" for="awareness1">
                    Saya setuju <i class="bi bi-emoji-laughing-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('awareness') == 'Somewhat' ) echo 'checked' ?> value="Somewhat" class="form-check-input" type="radio" name="awareness" id="awareness2">
                <label class="form-check-label" for="awareness2">
                    Semacam <i class="bi bi-emoji-neutral-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('awareness') == 'Not' ) echo 'checked' ?> value="Not" class="form-check-input" type="radio" name="awareness" id="awareness3">
                <label class="form-check-label" for="awareness3">
                    Saya tidak setuju <i class="bi bi-emoji-angry-fill"></i>
                </label>
            </div>
            <?php if ($formValidator->hasError('awareness')) : ?>
                <p class="text-danger"><?php echo $formValidator->getError('awareness'); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
    Terima Kasih ..<br />
    Semoga Haji Para Jemaah diterima oleh Allah. S.W.T
    </div>
</div>
<button class="btn btn-primary"><?php echo $lang('submit'); ?></button>