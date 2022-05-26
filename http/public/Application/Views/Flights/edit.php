<?php

use System\Core\Model;
use System\Helpers\URL;
use System\Libs\FormValidator;
use System\Models\Language;

$lang = Model::get(Language::class);

$formValidator = FormValidator::instance("flight");

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
                            <label for="number"><?php echo $lang('flight_number') ?></label>
                            <input type="text" class="form-control" name="number" id="number" value="<?php echo $formValidator->getValue('number', $flight['number']); ?>"/>
                            <?php if ( $formValidator->hasError('number') ): ?>
                                <p><?php echo $formValidator->getError('number'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="airlines"><?php echo $lang('airlines'); ?></label>
                            <select name="airlines" class="form-control">
                                <option value=""><?php echo $lang('select_airlines'); ?></option>
                                <?php foreach ( $airlines as $item ): ?>
                                    <option value="<?php echo $item['id'] ?>" <?php echo $formValidator->getValue('city', $flight['airline']) == $item['id'] ? 'selected' : ''; ?>><?php echo $item[$lang->current() . '_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php if ( $formValidator->hasError('city') ): ?>
                                <p><?php echo $formValidator->getError('city'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="date"><?php echo $lang('take_off_date') ?></label>
                            <input type="date" class="form-control" name="date" id="date" value="<?php echo $formValidator->getValue('date', $flight['tdate']); ?>"/>
                            <?php if ( $formValidator->hasError('date') ): ?>
                                <p><?php echo $formValidator->getError('date'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="time"><?php echo $lang('take_off_time') ?></label>
                            <input type="time" class="form-control" name="time" id="time" value="<?php echo $formValidator->getValue('time', $flight['ttime']); ?>"/>
                            <?php if ( $formValidator->hasError('time') ): ?>
                                <p><?php echo $formValidator->getError('time'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="passengers"><?php echo $lang('number_of_passengers') ?></label>
                            <input type="text" class="form-control" name="passengers" id="passengers" value="<?php echo $formValidator->getValue('passengers', $flight['passengers']); ?>"/>
                            <?php if ( $formValidator->hasError('passengers') ): ?>
                                <p><?php echo $formValidator->getError('passengers'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="sairport"><?php echo $lang('source_airport'); ?></label>
                            <select name="sairport" class="form-control">
                                <option value=""><?php echo $lang('select_airport'); ?></option>
                                <?php foreach ( $sAirports as $item ): ?>
                                    <option value="<?php echo $item['id'] ?>" <?php echo $formValidator->getValue('sairport', $flight['sairport']) == $item['id'] ? 'selected' : ''; ?>><?php echo $item[$lang->current() . '_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php if ( $formValidator->hasError('sairport') ): ?>
                                <p><?php echo $formValidator->getError('sairport'); ?></p>
                            <?php endif; ?>
                        </div>   
                        <?php /**
                        <div class="form-group">
                            <label for="dairport"><?php echo $lang('destination_airport'); ?></label>
                            <select name="dairport" class="form-control">
                                <option value=""><?php echo $lang('select_airport'); ?></option>
                                <?php foreach ( $dAirports as $item ): ?>
                                    <option value="<?php echo $item['id'] ?>" <?php echo $formValidator->getValue('dairport', $flight['dairport']) == $item['id'] ? 'selected' : ''; ?>><?php echo $item[$lang->current() . '_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php if ( $formValidator->hasError('dairport') ): ?>
                                <p><?php echo $formValidator->getError('dairport'); ?></p>
                            <?php endif; ?>
                        </div>      
                        ?*/ ?>
                        <button type="submit" class="btn btn-primary"><?php echo $lang('submit'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>