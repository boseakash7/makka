<?php

use Application\Models\Airport;
use System\Core\Model;
use System\Helpers\URL;
use System\Libs\FormValidator;
use System\Models\Language;

$lang = Model::get(Language::class);

$formValidator = FormValidator::instance("airport");

?>
<define title>
    Edit Airports
</define>
<define page_desc>
    Edit an existing airport from here.
</define>
<define right_header>
    <a href="<?php echo URL::full('airports') ?>">
        < Back</a>
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
                            <label for="name">En Name</label>
                            <input type="text" class="form-control" name="en_name" id="en_name" value="<?php echo $formValidator->getValue('en_name', $airport['en_name']); ?>"/>
                            <?php if ( $formValidator->hasError('en_name') ): ?>
                                <p><?php echo $formValidator->getError('en_name'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="name">Ar Name</label>
                            <input type="text" class="form-control" name="ar_name" id="ar_name" value="<?php echo $formValidator->getValue('ar_name', $airport['ar_name']); ?>"/>
                            <?php if ( $formValidator->hasError('ar_name') ): ?>
                                <p><?php echo $formValidator->getError('ar_name'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="city"><?php echo $lang('city'); ?></label>
                            <select name="city" class="form-control">
                                <option value=""><?php echo $lang('select_city'); ?></option>
                                <?php foreach ( $cities as $city ): ?>
                                    <option value="<?php echo $city['id'] ?>" <?php echo $formValidator->getValue('city', $airport['city']) == $city['id'] ? 'selected' : ''; ?>><?php echo $city[$lang->current() . '_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php if ( $formValidator->hasError('city') ): ?>
                                <p><?php echo $formValidator->getError('city'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="type"><?php echo $lang('type'); ?></label>
                            <select name="type" class="form-control">
                                <option value=""><?php echo $lang('select_type'); ?></option>                                
                                <option value="<?php echo Airport::TYPE_SOURCE ?>" <?php echo $formValidator->getValue('type', $airport['type']) == Airport::TYPE_SOURCE ? 'selected' : ''; ?>><?php echo $lang(Airport::TYPE_SOURCE); ?></option>
                                <option value="<?php echo Airport::TYPE_DESTINATION ?>" <?php echo $formValidator->getValue('type', $airport['type']) == Airport::TYPE_DESTINATION ? 'selected' : ''; ?>><?php echo $lang(Airport::TYPE_DESTINATION); ?></option>
                            </select>
                            <?php if ( $formValidator->hasError('type') ): ?>
                                <p><?php echo $formValidator->getError('type'); ?></p>
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="btn btn-primary"><?php echo $lang('submit'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>