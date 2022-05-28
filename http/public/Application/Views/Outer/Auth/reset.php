<?php

use System\Core\Model;
use System\Helpers\URL;
use System\Libs\FormValidator;
use System\Models\Language;

$lang = Model::get(Language::class);
$formValidator = FormValidator::instance("reset");
?>
<div class="col-lg-5 col-12">
    <div id="auth-left">
        <div class="auth-logo">
            <a href="<?php echo URL::siteUrl(); ?>"><img src="<?php echo URL::full('Application/Assets/images/logo/logo-png.png'); ?>" alt="Logo"></a>
        </div>
        <h1 class="auth-title"><?php echo $lang('forgot_password') ?></h1>
        <p class="auth-subtitle mb-5"><?php echo $lang('forgot_password_desc') ?></p>

        <?php if ( ! $isSuccess ): ?>

        <form action="<?php echo URL::current() ?>" method="POST">
            <div class="form-group position-relative has-icon-left mb-4">
                <input type="email" class="form-control form-control-xl" placeholder="<?php echo $lang('email') ?>" name="email">
                <div class="form-control-icon">
                    <i class="bi bi-envelope"></i>
                </div>
            </div>
            <?php if ( $formValidator->hasError('email') ): ?>
                                <p class="mb-4"><?php echo $formValidator->getError('email'); ?></p>
                        <?php endif; ?>
            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5"><?php echo $lang('submit') ?></button>
        </form>
        <div class="text-center mt-5 text-lg fs-4">
            <p class='text-gray-600'><?php echo $lang('remember_password') ?> <a href="<?php echo URL::full('/') ?>" class="font-bold"><?php echo $lang('login'); ?></a>.
            </p>
        </div>
        <?php else: ?>
            <p class="text-center"><?php echo $lang('email_sent_for_reset_password', [ 'email' => $formValidator->getValue('email') ]); ?></p>
        <?php endif; ?>
    </div>
</div>