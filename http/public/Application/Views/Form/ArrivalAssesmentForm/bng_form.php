<?php

use System\Libs\FormValidator;

$formValidator = FormValidator::instance("arrival-assesment");

?>
<div class="card">
    <div class="card-header">

    </div>
    <div class="card-body">
        <div class="form-group">
            <label class="mb-2" for="employment_interaction">تعامل الموظفين ؟?<span class="text-danger">*</span></label>
            <div class="form-check">
                <input value="Satisfactory" class="form-check-input" type="radio" name="employment_interaction" id="employment_interaction1">
                <label class="form-check-label" for="employment_interaction1">
                    راضي    
                </label>
            </div>
            <div class="form-check">
                <input value="Unsatisfactory" class="form-check-input" type="radio" name="employment_interaction" id="employment_interaction2">
                <label class="form-check-label" for="employment_interaction2">
                    راضينوعاً ما     
                </label>
            </div>
            <div class="form-check">
                <input value="Less Satisfying" class="form-check-input" type="radio" name="employment_interaction" id="employment_interaction3">
                <label class="form-check-label" for="employment_interaction3">
                غير راضي    
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
            <label class="mb-2" for="employment_interaction">Clarity of work procedures and lines?<span class="text-danger">*</span></label>
            <div class="form-check">
                <input value="Satisfactory" class="form-check-input" type="radio" name="clarity_procedure" id="clarity_procedure1">
                <label class="form-check-label" for="clarity_procedure1">
                    Satisfactory
                </label>
            </div>
            <div class="form-check">
                <input value="Unsatisfactory" class="form-check-input" type="radio" name="clarity_procedure" id="clarity_procedure2">
                <label class="form-check-label" for="clarity_procedure2">
                    Unsatisfactory
                </label>
            </div>
            <div class="form-check">
                <input value="Less Satisfying" class="form-check-input" type="radio" name="clarity_procedure" id="clarity_procedure3">
                <label class="form-check-label" for="clarity_procedure3">
                    Less Satisfying
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
            <label class="mb-2" for="employment_interaction">Services Provided?<span class="text-danger">*</span></label>
            <div class="form-check">
                <input value="Satisfactory" class="form-check-input" type="radio" name="service_provided" id="service_provided1">
                <label class="form-check-label" for="service_provided1">
                    Satisfactory
                </label>
            </div>
            <div class="form-check">
                <input value="Unsatisfactory" class="form-check-input" type="radio" name="service_provided" id="service_provided2">
                <label class="form-check-label" for="service_provided2">
                    Unsatisfactory
                </label>
            </div>
            <div class="form-check">
                <input value="Less Satisfying" class="form-check-input" type="radio" name="service_provided" id="service_provided3">
                <label class="form-check-label" for="service_provided3">
                    Less Satisfying
                </label>
            </div>
            <?php if ($formValidator->hasError('service_provided')) : ?>
                <p class="text-danger"><?php echo $formValidator->getError('service_provided'); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>
<button class="btn btn-primary">Submit</button>