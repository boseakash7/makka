<?php

use System\Core\Model;
use System\Helpers\URL;
use System\Libs\FormValidator;
use System\Models\Language;

$lang = Model::get(Language::class);

$formValidator = FormValidator::instance("departure-form");

?>
<define title>
    Departure Form
</define>
<define page_desc>
    Complete the form
</define>
<define right_header>
    <a href="<?php echo URL::full('flights') ?>">
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
                        <div class="row">
                            <div class="col form-group">
                                <label for="date"><?php echo $lang('date') ?><span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="date" id="date" value="<?php echo $formValidator->getValue('date'); ?>" />
                                <?php if ($formValidator->hasError('date')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('date'); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="col form-group">
                                <label for="city"><?php echo $lang('departure_city') ?><span class="text-danger">*</span></label>
                                <select name="departure_city" id="departure_city" class="form-control">
                                    <?php foreach ($cities as $city) : ?>
                                        <option value="<?php echo $city['id'] ?>"><?php echo $city[$lang->current() . '_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if ($formValidator->hasError('departure_city')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('departure_city'); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="departure_airport"><?php echo $lang('departure_airport') ?><span class="text-danger">*</span></label>
                            <select name="departure_airport" id="departure_airport" class="form-control">
                                <?php foreach ($airports as $airport) : ?>
                                    <option value="<?php echo $airport['id'] ?>"><?php echo $airport[$lang->current() . '_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php if ($formValidator->hasError('departure_airport')) : ?>
                                <p class="text-danger"><?php echo $formValidator->getError('departure_airport'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="flight_number"><?php echo $lang('flight_number') ?><span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="flight_number" id="flight_number" value="<?php echo $formValidator->getValue('flight_number'); ?>" />
                            <?php if ($formValidator->hasError('flight_number')) : ?>
                                <p class="text-danger"><?php echo $formValidator->getError('flight_number'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="passengers"><?php echo $lang('passengers') ?><span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="passengers" id="passengers" value="<?php echo $formValidator->getValue('passengers'); ?>" />
                                <?php if ($formValidator->hasError('passengers')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('passengers'); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="col form-group">
                                <label for="departure_time"><?php echo $lang('departure_time') ?><span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="departure_time" id="departure_time" value="<?php echo $formValidator->getValue('departure_time'); ?>" />
                                <?php if ($formValidator->hasError('departure_time')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('departure_time'); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="arrival_city"><?php echo $lang('arrival_city') ?><span class="text-danger">*</span></label>
                                <select name="arrival_city" id="arrival_city" class="form-control">
                                    <?php foreach ($cities as $city) : ?>
                                        <option value="<?php echo $city['id'] ?>"><?php echo $city[$lang->current() . '_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if ($formValidator->hasError('arrival_city')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('arrival_city'); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="col form-group">
                                <label for="arrival_time"><?php echo $lang('arrival_time') ?><span class="text-danger">*</span></label>
                                <input type="time" class="form-control" name="arrival_time" id="date" value="<?php echo $formValidator->getValue('arrival_time'); ?>" />
                                <?php if ($formValidator->hasError('arrival_time')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('arrival_time'); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="working_counts"><?php echo $lang('working_counts') ?><span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="working_counts" id="working_counts" value="<?php echo $formValidator->getValue('working_counts'); ?>" />
                                <?php if ($formValidator->hasError('working_counts')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('working_counts'); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="col form-group">
                                <label for="non_working_counts"><?php echo $lang('non_working_counts') ?><span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="non_working_counts" id="non_working_counts" value="<?php echo $formValidator->getValue('non_working_counts'); ?>" />
                                <?php if ($formValidator->hasError('non_working_counts')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('non_working_counts'); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="average_pilgrim_waiting"><?php echo $lang('average_pilgrim_waiting') ?><span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="average_pilgrim_waiting" id="average_pilgrim_waiting" value="<?php echo $formValidator->getValue('average_pilgrim_waiting'); ?>" />
                                <?php if ($formValidator->hasError('average_pilgrim_waiting')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('average_pilgrim_waiting'); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="col form-group">
                                <label for="average_pilgrim_service"><?php echo $lang('average_pilgrim_service') ?><span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="average_pilgrim_service" id="average_pilgrim_service" value="<?php echo $formValidator->getValue('average_pilgrim_service'); ?>" />
                                <?php if ($formValidator->hasError('average_pilgrim_service')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('average_pilgrim_service'); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="counters_working_start_time"><?php echo $lang('counters_working_start_time') ?><span class="text-danger">*</span></label>
                                <input type="time" class="form-control" name="counters_working_start_time" id="counters_working_start_time" value="<?php echo $formValidator->getValue('counters_working_start_time'); ?>" />
                                <?php if ($formValidator->hasError('counters_working_start_time')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('counters_working_start_time'); ?></p>
                                <?php endif; ?>
                            </div>
                            
                            <div class="col form-group">
                                <label for="counters_working_end_time"><?php echo $lang('counters_working_end_time') ?><span class="text-danger">*</span></label>
                                <input type="time" class="form-control" name="counters_working_end_time" id="counters_working_end_time" value="<?php echo $formValidator->getValue('counters_working_end_time'); ?>" />
                                <?php if ($formValidator->hasError('counters_working_end_time')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('counters_working_end_time'); ?></p>
                                <?php endif; ?>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="number_of_men"><?php echo $lang('number_of_men') ?><span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="number_of_men" id="number_of_men" value="<?php echo $formValidator->getValue('number_of_men'); ?>" />
                                <?php if ($formValidator->hasError('number_of_men')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('number_of_men'); ?></p>
                                <?php endif; ?>
                            </div>
                            
                            <div class="col form-group">
                                <label for="number_of_women"><?php echo $lang('number_of_women') ?><span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="number_of_women" id="number_of_women" value="<?php echo $formValidator->getValue('number_of_women'); ?>" />
                                <?php if ($formValidator->hasError('number_of_women')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('number_of_women'); ?></p>
                                <?php endif; ?>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="number_of_seats"><?php echo $lang('number_of_seats') ?><span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="number_of_seats" id="number_of_seats" value="<?php echo $formValidator->getValue('number_of_seats'); ?>" />
                                <?php if ($formValidator->hasError('number_of_seats')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('number_of_seats'); ?></p>
                                <?php endif; ?>
                            </div>
                            
                            <div class="col form-group">
                                <label for="number_of_cases"><?php echo $lang('number_of_cases') ?><span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="number_of_cases" id="number_of_cases" value="<?php echo $formValidator->getValue('number_of_cases'); ?>" />
                                <?php if ($formValidator->hasError('number_of_cases')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('number_of_cases'); ?></p>
                                <?php endif; ?>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="number_of_people_fingerprinted"><?php echo $lang('number_of_people_fingerprinted') ?><span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="number_of_people_fingerprinted" id="number_of_people_fingerprinted" value="<?php echo $formValidator->getValue('number_of_people_fingerprinted'); ?>" />
                                <?php if ($formValidator->hasError('number_of_people_fingerprinted')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('number_of_people_fingerprinted'); ?></p>
                                <?php endif; ?>
                            </div>
                            
                            <div class="col form-group">
                                <label for="number_of_bags"><?php echo $lang('number_of_bags') ?></label>
                                <input type="number" class="form-control" name="number_of_bags" id="number_of_bags" value="<?php echo $formValidator->getValue('number_of_bags'); ?>" />
                                <?php if ($formValidator->hasError('number_of_bags')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('number_of_bags'); ?></p>
                                <?php endif; ?>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="fingerprint_status"><?php echo $lang('fingerprint_status') ?><span class="text-danger">*</span></label>
                                <select name="fingerprint_status" class="form-control" id="fingerprint_status">
                                    <option value="excellent">excellent</option>
                                    <option value="good">good</option>
                                    <option value="weak">weak</option>
                                </select>
                                <?php if ($formValidator->hasError('fingerprint_status')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('fingerprint_status'); ?></p>
                                <?php endif; ?>
                            </div>
                            
                            <div class="col form-group">
                                <label for="connection_status"><?php echo $lang('connection_status') ?><span class="text-danger">*</span></label>
                                <select name="connection_status" class="form-control" id="connection_status">
                                    <option value="excellent">excellent</option>
                                    <option value="good">good</option>
                                    <option value="weak">weak</option>
                                </select>
                                <?php if ($formValidator->hasError('connection_status')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('connection_status'); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="speed_of_communication"><?php echo $lang('speed_of_communication') ?><span class="text-danger">*</span></label>
                                <textarea name="speed_of_communication" class="form-control" id="" cols="30" rows="3"><?php echo $formValidator->getValue('speed_of_communication'); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="challenges"><?php echo $lang('challenges') ?></label>
                                <textarea name="challenges" class="form-control" id="" cols="30" rows="3"><?php echo $formValidator->getValue('challenges'); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="treatment"><?php echo $lang('treatment') ?></label>
                                <textarea name="treatment" class="form-control" id="" cols="30" rows="3"><?php echo $formValidator->getValue('treatment'); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="recommendations"><?php echo $lang('recommendations') ?></label>
                                <textarea name="recommendations" class="form-control" id="" cols="30" rows="3"><?php echo $formValidator->getValue('recommendations'); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="reviews"><?php echo $lang('reviews') ?></label>
                                <textarea name="reviews" class="form-control" id="" cols="30" rows="3"><?php echo $formValidator->getValue('reviews'); ?></textarea>
                            </div>
                            
                        </div>
                        <button type="submit" class="btn btn-primary"><?php echo $lang('submit'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>