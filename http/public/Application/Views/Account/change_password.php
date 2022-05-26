<?php

use System\Core\Model;
use System\Helpers\URL;
use System\Libs\FormValidator;
use System\Models\Language;

$lang = Model::get(Language::class);

$formValidator = FormValidator::instance("password");

?>
<define title>
    Change Password
</define>
<define page_desc>
    Change your password
</define>
<section class="section">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">
                    <form action="<?php echo URL::current() ?>" method="POST">
                        <div class="form-group">
                            <label for="password1"><?php echo $lang('new_password') ?></label>
                            <input type="text" class="form-control" name="password1" id="password1" />
                            <?php if ( $formValidator->hasError('password1') ): ?>
                                <p><?php echo $formValidator->getError('password1'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="password2"><?php echo $lang('retype_password') ?></label>
                            <input type="text" class="form-control" name="password2" id="password2"/>
                            <?php if ( $formValidator->hasError('password2') ): ?>
                                <p><?php echo $formValidator->getError('password2'); ?></p>
                            <?php endif; ?>                            
                        </div>                        
                        <button type="submit" class="btn btn-primary"><?php echo $lang('submit'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>