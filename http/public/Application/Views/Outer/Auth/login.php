<?php

use System\Core\Model;
use System\Helpers\URL;
use System\Libs\FormValidator;
use System\Models\Language;

$lang = Model::get(Language::class);

$formValidator = FormValidator::instance("login");

?>
<div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="<?php echo URL::siteUrl(); ?>"><img src="<?php echo URL::full('Application/Assets/images/logo/logo-png.png'); ?>" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title"><?php echo $lang('login'); ?></h1>
                    <p class="auth-subtitle mb-5"><?php echo $lang('login_desc') ?></p>

                    <form action="<?php echo URL::current(); ?>" method="POST">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl"  name="email" placeholder="<?php echo $lang('email') ?>">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>                            
                        </div>
                        <?php if ( $formValidator->hasError('email') ): ?>
                                <p class="mb-4"><?php echo $formValidator->getError('email'); ?></p>
                        <?php endif; ?>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" name="password"  placeholder="<?php echo $lang('password') ?>">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>                            
                        </div>    
                            <?php if ( $formValidator->hasError('password') ): ?>
                                <p class="mb-4"><?php echo $formValidator->getError('password'); ?></p>
                            <?php endif; ?>
                        <p class="text-danger"><?php  echo $lang('login_password_generate') ?></p>                    
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5"><?php echo $lang('login') ?></button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <!-- <p class="text-gray-600">Don't have an account? <a href="auth-register.html"
                                class="font-bold">Sign
                                up</a>.</p> -->
                        <p><a class="font-bold" href="<?php echo URL::full('reset-password') ?>"><?php echo $lang('forgot_password') ?></a></p>
                    </div>
                </div>
            </div>