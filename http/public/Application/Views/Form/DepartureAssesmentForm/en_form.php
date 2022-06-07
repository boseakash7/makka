<?php

use System\Libs\FormValidator;

$formValidator = FormValidator::instance("departure-assesment");

?>
<div class="card">
    <div class="card-body">
        Welcome<br />
        You are kindly requested to evaluate the preparation for the pilgrims, as
        per your experience, before leaving for Saudi Arabia
    </div>
</div>
<div class="card">
    <div class="card-header">

    </div>
    <div class="card-body">
        <div class="form-group">
            <label class="mb-2" for="employment_interaction">Was the residence of the Hajj Authority comfortable?<span class="text-danger">*</span></label>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('employment_interaction') == 'Comfortable' ) echo 'checked' ?> value="Comfortable" class="form-check-input" type="radio" name="employment_interaction" id="employment_interaction1">
                <label class="form-check-label" for="employment_interaction1">
                    Comfortable <i class="bi bi-emoji-laughing-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('employment_interaction') == 'Somewhat' ) echo 'checked' ?> value="Somewhat" class="form-check-input" type="radio" name="employment_interaction" id="employment_interaction2">
                <label class="form-check-label" for="employment_interaction2">
                    Somewhat <i class="bi bi-emoji-neutral-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('employment_interaction') == 'Not' ) echo 'checked' ?> value="Not" class="form-check-input" type="radio" name="employment_interaction" id="employment_interaction3">
                <label class="form-check-label" for="employment_interaction3">
                    Not <i class="bi bi-emoji-angry-fill"></i>
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
            <label class="mb-2" for="clarity_procedure">Procedures for issuing a boarding pass and completing the necessary documents was quick and easy?<span class="text-danger">*</span></label>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('clarity_procedure') == 'Quick' ) echo 'checked' ?> value="Quick" class="form-check-input" type="radio" name="clarity_procedure" id="clarity_procedure1">
                <label class="form-check-label" for="clarity_procedure1">
                    Quick and Easy <i class="bi bi-emoji-laughing-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('clarity_procedure') == 'Somewhat' ) echo 'checked' ?> value="Somewhat" class="form-check-input" type="radio" name="clarity_procedure" id="clarity_procedure2">
                <label class="form-check-label" for="clarity_procedure2">
                    Somewhat <i class="bi bi-emoji-neutral-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('clarity_procedure') == 'Not' ) echo 'checked' ?> value="Not" class="form-check-input" type="radio" name="clarity_procedure" id="clarity_procedure3">
                <label class="form-check-label" for="clarity_procedure3">
                 Not <i class="bi bi-emoji-angry-fill"></i>
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
            <label class="mb-2" for="employment_interaction">Was it easy to enter the Road to Makkah hall?<span class="text-danger">*</span></label>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('service_provided') == 'Easy' ) echo 'checked' ?> value="Easy" class="form-check-input" type="radio" name="service_provided" id="service_provided1">
                <label class="form-check-label" for="service_provided1">
                    Easy <i class="bi bi-emoji-laughing-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('service_provided') == 'Somewhat' ) echo 'checked' ?> value="Somewhat" class="form-check-input" type="radio" name="service_provided" id="service_provided2">
                <label class="form-check-label" for="service_provided2">
                    Somewhat <i class="bi bi-emoji-neutral-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('service_provided') == 'Not' ) echo 'checked' ?> value="Not" class="form-check-input" type="radio" name="service_provided" id="service_provided3">
                <label class="form-check-label" for="service_provided3">
                    Not <i class="bi bi-emoji-angry-fill"></i>
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
            <label class="mb-2" for="makkah_hall">Are you welcomed when you enter the Road to Makkah Hall?<span class="text-danger">*</span></label>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('makkah_hall') == 'Yes' ) echo 'checked' ?> value="Yes" class="form-check-input" type="radio" name="makkah_hall" id="makkah_hall1">
                <label class="form-check-label" for="makkah_hall1">
                    Yes <i class="bi bi-emoji-laughing-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('makkah_hall') == 'Somewhat' ) echo 'checked' ?> value="Somewhat" class="form-check-input" type="radio" name="makkah_hall" id="makkah_hall2">
                <label class="form-check-label" for="makkah_hall2">
                    Somewhat <i class="bi bi-emoji-neutral-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('makkah_hall') == 'Not' ) echo 'checked' ?> value="Not" class="form-check-input" type="radio" name="makkah_hall" id="makkah_hall3">
                <label class="form-check-label" for="makkah_hall3">
                 Not <i class="bi bi-emoji-angry-fill"></i>
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
            <label class="mb-2" for="awareness">Did you benefit from the awareness video that was shown?<span class="text-danger">*</span></label>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('awareness') == 'Yes' ) echo 'checked' ?> value="Yes" class="form-check-input" type="radio" name="awareness" id="awareness1">
                <label class="form-check-label" for="awareness1">
                    Yes <i class="bi bi-emoji-laughing-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('awareness') == 'Somewhat' ) echo 'checked' ?> value="Somewhat" class="form-check-input" type="radio" name="awareness" id="awareness2">
                <label class="form-check-label" for="awareness2">
                    Somewhat <i class="bi bi-emoji-neutral-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('awareness') == 'Not' ) echo 'checked' ?> value="Not" class="form-check-input" type="radio" name="awareness" id="awareness3">
                <label class="form-check-label" for="awareness3">
                 Not <i class="bi bi-emoji-angry-fill"></i>
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
        Thank You!
    </div>
</div>
<button class="btn btn-primary"><?php echo $lang('submit'); ?></button>