\<?php

use System\Libs\FormValidator;

$formValidator = FormValidator::instance("departure-assesment");

?>
<div class="card">
    <div class="card-header">

    </div>
    <div class="card-body">
        <div class="form-group">
            <label class="mb-2" for="employment_interaction">হজ কর্তৃপক্ষের বাসস্থান কি আরামদায়ক ছিল?<span class="text-danger">*</span></label>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('employment_interaction') == 'Yes' ) echo 'checked' ?> value="Yes" class="form-check-input" type="radio" name="employment_interaction" id="employment_interaction1">
                <label class="form-check-label" for="employment_interaction1">
                    হ্যাঁ <i class="bi bi-emoji-laughing-fill"></i>
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
            <label class="mb-2" for="clarity_procedure">একটি বোর্ডিং পাস প্রদান এবং প্রয়োজনীয় নথি পূরণ করার পদ্ধতি দ্রুত এবং সহজ ছিল?<span class="text-danger">*</span></label>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('clarity_procedure') == 'Yes' ) echo 'checked' ?> value="Yes" class="form-check-input" type="radio" name="clarity_procedure" id="clarity_procedure1">
                <label class="form-check-label" for="clarity_procedure1">
                    হ্যাঁ <i class="bi bi-emoji-laughing-fill"></i>
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
            <label class="mb-2" for="employment_interaction">রোড টু মক্কা হলে প্রবেশ করা কি সহজ ছিল?<span class="text-danger">*</span></label>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('service_provided') == 'Yes' ) echo 'checked' ?> value="Yes" class="form-check-input" type="radio" name="service_provided" id="service_provided1">
                <label class="form-check-label" for="service_provided1">
                    হ্যাঁ <i class="bi bi-emoji-laughing-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('service_provided') == 'Somewhat' ) echo 'checked' ?> value="Somewhat" class="form-check-input" type="radio" name="service_provided" id="service_provided2">
                <label class="form-check-label" for="service_provided2">
                    কিছুটা <i class="bi bi-emoji-neutral-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('service_provided')== 'Not' ) echo 'checked' ?> value="Not" class="form-check-input" type="radio" name="service_provided" id="service_provided3">
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


<div class="card">
    <div class="card-header">

    </div>
    <div class="card-body">
        <div class="form-group">
            <label class="mb-2" for="makkah_hall">রোড টু মক্কা হলে প্রবেশ করলে কি আপনাকে স্বাগত জানানো হয়?<span class="text-danger">*</span></label>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('makkah_hall') == 'Yes' ) echo 'checked' ?> value="Yes" class="form-check-input" type="radio" name="makkah_hall" id="makkah_hall1">
                <label class="form-check-label" for="makkah_hall1">
                    হ্যাঁ <i class="bi bi-emoji-laughing-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('makkah_hall') == 'Somewhat' ) echo 'checked' ?> value="Somewhat" class="form-check-input" type="radio" name="makkah_hall" id="makkah_hall2">
                <label class="form-check-label" for="makkah_hall2">
                     কিছুটা <i class="bi bi-emoji-neutral-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('makkah_hall') == 'Not' ) echo 'checked' ?> value="Not" class="form-check-input" type="radio" name="makkah_hall" id="makkah_hall3">
                <label class="form-check-label" for="makkah_hall3">
                  না <i class="bi bi-emoji-angry-fill"></i>
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
            <label class="mb-2" for="awareness">যে সচেতনতামূলক ভিডিওটি দেখানো হয়েছিল তা থেকে আপনি কি উপকৃত হয়েছেন?<span class="text-danger">*</span></label>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('awareness') == 'Yes' ) echo 'checked' ?> value="Yes" class="form-check-input" type="radio" name="awareness" id="awareness1">
                <label class="form-check-label" for="awareness1">
                    হ্যাঁ <i class="bi bi-emoji-laughing-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('awareness') == 'Somewhat' ) echo 'checked' ?> value="Somewhat" class="form-check-input" type="radio" name="awareness" id="awareness2">
                <label class="form-check-label" for="awareness2">
                    কিছুটা <i class="bi bi-emoji-neutral-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('awareness') == 'Not' ) echo 'checked' ?> value="Not" class="form-check-input" type="radio" name="awareness" id="awareness3">
                <label class="form-check-label" for="awareness3">
                 না <i class="bi bi-emoji-angry-fill"></i>
                </label>
            </div>
            <?php if ($formValidator->hasError('awareness')) : ?>
                <p class="text-danger"><?php echo $formValidator->getError('awareness'); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>
<button class="btn btn-primary"><?php echo $lang('submit'); ?></button>