<?php

use System\Core\Model;
use System\Helpers\URL;
use System\Libs\FormValidator;
use System\Models\Language;

$lang = Model::get(Language::class);

$formValidator = FormValidator::instance("employee");

?>
<define title>
    <?php echo $lang('edit_employee') ?>
</define>
<define page_desc>
    <?php echo $lang('edit_new_employee_from_here') ?>
</define>
<define right_header>
    <a href="<?php echo URL::full('employee') ?>">
        < <?php echo $lang('back') ?></a>
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
                            <label for="name"><?php echo $lang('name') ?></label>
                            <input type="text" class="form-control" name="name" id="name" value="<?php echo $formValidator->getValue('name', $user['name']); ?>"/>
                            <?php if ( $formValidator->hasError('name') ): ?>
                                <p><?php echo $formValidator->getError('name'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="name"><?php echo $lang('email') ?></label>
                            <input type="text" class="form-control" name="email" id="email" value="<?php echo $formValidator->getValue('email', $user['email']); ?>"/>
                            <?php if ( $formValidator->hasError('email') ): ?>
                                <p><?php echo $formValidator->getError('email'); ?></p>
                            <?php endif; ?>
                        </div>   
                        <div class="form-group">
                            <label for="airport"><?php echo $lang('destination_airport'); ?></label>
                            <select name="airport" class="form-control">
                                <option value=""><?php echo $lang('select_airport'); ?></option>
                                <?php foreach ( $airports as $item ): ?>
                                    <option value="<?php echo $item['id'] ?>" <?php echo $formValidator->getValue('airport', $user['airport']) == $item['id'] ? 'selected' : ''; ?>><?php echo $item[$lang->current() . '_name'] . ' (' . $lang($item['type']) . ')'; ?> </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if ( $formValidator->hasError('airport') ): ?>
                                <p><?php echo $formValidator->getError('airport'); ?></p>
                            <?php endif; ?>
                        </div>         
                        <div class="form-group">
                            <label for="password"><?php echo $lang('password') ?></label>
                            <input type="password" class="form-control" name="password" id="password" value="<?php echo $formValidator->getValue('password'); ?>"/>
                            <?php if ( $formValidator->hasError('password') ): ?>
                                <p><?php echo $formValidator->getError('password'); ?></p>
                            <?php endif; ?>
                        </div>                                                                                                   
                        <button type="submit" class="btn btn-primary"><?php echo $lang('submit'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>