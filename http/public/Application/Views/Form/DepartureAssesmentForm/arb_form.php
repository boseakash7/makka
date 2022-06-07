<?php

use System\Libs\FormValidator;

$formValidator = FormValidator::instance("departure-assesment");

?>
<div class="card">
    <div class="card-body">
        مرحبا بكم .. من خالل تجربتك، نرجو منك التقييم فيما يتعلق "بتهيئة الحجاج" قبل المغادرة إلى المملكة العربية السعودية.
    </div>
</div>
<div class="card">
    <div class="card-header">

    </div>
    <div class="card-body">
        <div class="form-group">
            <label class="mb-2" for="employment_interaction">مقر سكن هيئة الحج مهيأ ومناسب ..<span class="text-danger">*</span></label>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('employment_interaction') == 'Yes' ) echo 'checked' ?> value="Yes" class="form-check-input" type="radio" name="employment_interaction" id="employment_interaction1">
                <label class="form-check-label" for="employment_interaction1">
                أوافق    <i class="bi bi-emoji-laughing-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('employment_interaction')  == 'Somewhat' ) echo 'checked' ?> value="Somewhat" class="form-check-input" type="radio" name="employment_interaction" id="employment_interaction2">
                <label class="form-check-label" for="employment_interaction2">
                نوعاً ما   <i class="bi bi-emoji-neutral-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('employment_interaction') == 'Not' ) echo 'checked' ?> value="Not" class="form-check-input" type="radio" name="employment_interaction" id="employment_interaction3">
                <label class="form-check-label" for="employment_interaction3">
                الأوافق    <i class="bi bi-emoji-angry-fill"></i>
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
            <label class="mb-2" for="employment_interaction">لعمل على اجراءات إصدار بطاقة صعود الطائره واستكمال المستندات الالزمه كانت سريعه وميسره..<span class="text-danger">*</span></label>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('clarity_procedure') == 'Yes' ) echo 'checked' ?> value="Yes" class="form-check-input" type="radio" name="clarity_procedure" id="clarity_procedure1">
                <label class="form-check-label" for="clarity_procedure1">
                أوافق    <i class="bi bi-emoji-laughing-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('clarity_procedure')  == 'Somewhat' ) echo 'checked' ?> value="Somewhat" class="form-check-input" type="radio" name="clarity_procedure" id="clarity_procedure2">
                <label class="form-check-label" for="clarity_procedure2">
                    نوعاً ما   <i class="bi bi-emoji-neutral-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('clarity_procedure') == 'Not' ) echo 'checked' ?> value="Not" class="form-check-input" type="radio" name="clarity_procedure" id="clarity_procedure3">
                <label class="form-check-label" for="clarity_procedure3">
                    الأوافق    <i class="bi bi-emoji-angry-fill"></i>
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
            <label class="mb-2" for="employment_interaction">سهولة الدخول لصالة طريق مكه ..<span class="text-danger">*</span></label>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('service_provided') == 'Yes' ) echo 'checked' ?> value="Yes" class="form-check-input" type="radio" name="service_provided" id="service_provided1">
                <label class="form-check-label" for="service_provided1">
                    أوافق    <i class="bi bi-emoji-laughing-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('service_provided')  == 'Somewhat' ) echo 'checked' ?> value="Somewhat" class="form-check-input" type="radio" name="service_provided" id="service_provided2">
                <label class="form-check-label" for="service_provided2">
                    نوعاً ما   <i class="bi bi-emoji-neutral-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('service_provided') == 'Not' ) echo 'checked' ?> value="Not" class="form-check-input" type="radio" name="service_provided" id="service_provided3">
                <label class="form-check-label" for="service_provided3">
                    الأوافق    <i class="bi bi-emoji-angry-fill"></i>
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
            <label class="mb-2" for="employment_interaction">تم االستقبال والترحيب عند الدخول لصالة طريق مكه<span class="text-danger">*</span></label>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('makkah_hall') == 'Yes' ) echo 'checked' ?> value="Yes" class="form-check-input" type="radio" name="makkah_hall" id="makkah_hall1">
                <label class="form-check-label" for="makkah_hall1">
                    أوافق    <i class="bi bi-emoji-laughing-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('makkah_hall')  == 'Somewhat' ) echo 'checked' ?> value="Somewhat" class="form-check-input" type="radio" name="makkah_hall" id="makkah_hall2">
                <label class="form-check-label" for="makkah_hall2">
                    نوعاً ما   <i class="bi bi-emoji-neutral-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('makkah_hall') == 'Not' ) echo 'checked' ?> value="Not" class="form-check-input" type="radio" name="makkah_hall" id="makkah_hall3">
                <label class="form-check-label" for="makkah_hall3">
                    الأوافق    <i class="bi bi-emoji-angry-fill"></i>
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
            <label class="mb-2" for="employment_interaction">استفدت من الفيديو التوعوي الذي تم عرضه<span class="text-danger">*</span></label>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('awareness') == 'Yes' ) echo 'checked' ?> value="Yes" class="form-check-input" type="radio" name="awareness" id="awareness1">
                <label class="form-check-label" for="awareness1">
                    أوافق    <i class="bi bi-emoji-laughing-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('awareness')  == 'Somewhat' ) echo 'checked' ?> value="Somewhat" class="form-check-input" type="radio" name="awareness" id="awareness2">
                <label class="form-check-label" for="awareness2">
                    نوعاً ما   <i class="bi bi-emoji-neutral-fill"></i>
                </label>
            </div>
            <div class="form-check">
                <input <?php if( $formValidator->getValue('awareness') == 'Not' ) echo 'checked' ?> value="Not" class="form-check-input" type="radio" name="awareness" id="awareness3">
                <label class="form-check-label" for="awareness3">
                    الأوافق    <i class="bi bi-emoji-angry-fill"></i>
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
        شكرا لكم..<br />
        حج مبرور وسعي مشكور..
    </div>
</div>
<button class="btn btn-primary"><?php echo $lang('submit'); ?></button>