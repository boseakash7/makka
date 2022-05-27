<?php

use System\Core\Model;
use System\Helpers\URL;
use System\Libs\FormValidator;
use System\Models\Language;

$lang = Model::get(Language::class);
$formValidator = FormValidator::instance("create");

?>
<div class="col-lg-5 col-12">
    <div id="auth-left">
        <div class="auth-logo">
            <a href="<?php echo URL::siteUrl(); ?>"><img src="<?php echo URL::full('Application/Assets/images/logo/logo-png.png'); ?>" alt="Logo"></a>
        </div>
        <h1 class="auth-title"><?php echo $lang('create_password') ?></h1>
        <p class="auth-subtitle mb-5"><?php echo $lang('create_password_desc') ?></p>

        <?php if ( ! $isSuccess ): ?>

        <form action="<?php echo URL::current() ?>" method="POST">
            <div class="form-group position-relative has-icon-left mb-4">
                <input type="password" class="form-control form-control-xl" placeholder="<?php echo $lang('new_password') ?>" name="password1">
                <div class="form-control-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>
            </div>
            <?php if ( $formValidator->hasError('password1') ): ?>
                <p class="mb-4"><?php echo $formValidator->getError('password1'); ?></p>
            <?php endif; ?>
            <div class="form-group position-relative has-icon-left mb-4">
                <input type="password" class="form-control form-control-xl" placeholder="<?php echo $lang('retype_password') ?>" name="password2">
                <div class="form-control-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>
            </div>
            <?php if ( $formValidator->hasError('password2') ): ?>
                <p class="mb-4"><?php echo $formValidator->getError('password2'); ?></p>
            <?php endif; ?>
            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5"><?php echo $lang('submit') ?></button>
        </form>
        <div class="text-center mt-5 text-lg fs-4">
            <p class='text-gray-600'><?php echo $lang('remember_password') ?> <a href="<?php echo URL::full('/') ?>" class="font-bold"><?php echo $lang('login'); ?></a>.
            </p>
        </div>
        <?php else: ?>
            <p class="text-center"><?php echo $lang('password_reset_successful', [ 'email' => $formValidator->getValue('email') ]); ?> <a href="<?php echo URL::full('/') ?>" class=""><?php echo $lang('login'); ?></a></p>
        <?php endif; ?>
    </div>
</div>