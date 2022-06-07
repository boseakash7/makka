<?php

use System\Libs\FormValidator;

$formValidator = FormValidator::instance("arrival-assesment");

?>
<div class="card">
    <div class="card-header">

    </div>
    <div class="card-body">
        <div class="form-group">
            <label class="mb-2" for="employment_interaction">আপনার সাথে কর্মচারীবৃন্দ কেমন আচরণ করেন?<span class="text-danger">*</span></label>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('employment_interaction') == 'Yes' ) echo 'checked' ?> value="Yes" class="form-check-input" type="radio" name="employment_interaction" id="employment_interaction1">
                <label class="form-check-label" for="employment_interaction1">
                হ্যাঁ  <i class="bi bi-emoji-laughing-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('employment_interaction') == 'Somewhat' ) echo 'checked' ?> value="Somewhat" class="form-check-input" type="radio" name="employment_interaction" id="employment_interaction2">
                <label class="form-check-label" for="employment_interaction2">
                কিছুটা <i class="bi bi-emoji-neutral-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('employment_interaction') == 'Not' ) echo 'checked' ?> value="Not" class="form-check-input" type="radio" name="employment_interaction" id="employment_interaction3">
                <label class="form-check-label" for="employment_interaction3">
                না <i class="bi bi-emoji-angry-fill"></i>
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
            <label class="mb-2" for="clarity_procedure"> লাইনে দাঁড়ানোর প্রক্রিয়া কি আপনি সঠিক ভাবে বুঝতে পেরেছেন ?<span class="text-danger">*</span></label>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('clarity_procedure') == 'Yes' ) echo 'checked' ?> value="Yes" class="form-check-input" type="radio" name="clarity_procedure" id="clarity_procedure1">
                <label class="form-check-label" for="clarity_procedure1">
                হ্যাঁ  <i class="bi bi-emoji-laughing-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('clarity_procedure') == 'Somewhat' ) echo 'checked' ?> value="Somewhat" class="form-check-input" type="radio" name="clarity_procedure" id="clarity_procedure2">
                <label class="form-check-label" for="clarity_procedure2">
                কিছুটা <i class="bi bi-emoji-neutral-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('clarity_procedure') == 'Not' ) echo 'checked' ?> value="Not" class="form-check-input" type="radio" name="clarity_procedure" id="clarity_procedure3">
                <label class="form-check-label" for="clarity_procedure3">
                না <i class="bi bi-emoji-angry-fill"></i>
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
            <label class="mb-2" for="employment_interaction">আপনি এখানে কেমন সেবা পাচ্ছেন?<span class="text-danger">*</span></label>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('service_provided') == 'Yes' ) echo 'checked' ?> value="Yes" class="form-check-input" type="radio" name="service_provided" id="service_provided1">
                <label class="form-check-label" for="service_provided1">
                হ্যাঁ  <i class="bi bi-emoji-laughing-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('service_provided') == 'Somewhat' ) echo 'checked' ?> value="Somewhat" class="form-check-input" type="radio" name="service_provided" id="service_provided2">
                <label class="form-check-label" for="service_provided2">
                কিছুটা <i class="bi bi-emoji-neutral-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('service_provided') == 'Not' ) echo 'checked' ?> value="Not" class="form-check-input" type="radio" name="service_provided" id="service_provided3">
                <label class="form-check-label" for="service_provided3">
                না <i class="bi bi-emoji-angry-fill"></i>
                </label>
            </div>
            <?php if ($formValidator->hasError('service_provided')) : ?>
                <p class="text-danger"><?php echo $formValidator->getError('service_provided'); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>
<button class="btn btn-primary"><?php echo $lang('submit'); ?></button>