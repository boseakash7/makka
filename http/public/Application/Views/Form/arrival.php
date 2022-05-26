<?php

use System\Core\Model;
use System\Helpers\URL;
use System\Libs\FormValidator;
use System\Models\Language;

$lang = Model::get(Language::class);

$formValidator = FormValidator::instance("arrival-form");

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
                                <label for="city"><?php echo $lang('arrival_city') ?><span class="text-danger">*</span></label>
                                <select name="arrival_city" id="arrival_city" class="form-control">
                                    <?php foreach ($cities as $city) : ?>
                                        <option value="<?php echo $city['id'] ?>"><?php echo $city[$lang->current() . '_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if ($formValidator->hasError('arrival_city')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('arrival_city'); ?></p>
                                <?php endif; ?>
                            </div>
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
                                <label for="number_of_staffs"><?php echo $lang('number_of_staffs') ?><span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="number_of_staffs" id="number_of_staffs" value="<?php echo $formValidator->getValue('number_of_staffs'); ?>" />
                                <?php if ($formValidator->hasError('number_of_staffs')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('number_of_staffs'); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="col form-group">
                                <label for="number_of_counter_custom_staffs"><?php echo $lang('number_of_counter_custom_staffs') ?><span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="number_of_counter_custom_staffs" id="number_of_counter_custom_staffs" value="<?php echo $formValidator->getValue('number_of_counter_custom_staffs'); ?>" />
                                <?php if ($formValidator->hasError('number_of_counter_custom_staffs')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('number_of_counter_custom_staffs'); ?></p>
                                <?php endif; ?>
                            </div>
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
                                <label for="arrival_time"><?php echo $lang('arrival_time') ?><span class="text-danger">*</span></label>
                                <input type="time" class="form-control" name="arrival_time" id="arrival_time" value="<?php echo $formValidator->getValue('arrival_time'); ?>" />
                                <?php if ($formValidator->hasError('arrival_time')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('arrival_time'); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="take_off_place"><?php echo $lang('take_off_place') ?><span class="text-danger">*</span></label>
                                <select name="take_off_place" id="take_off_place" class="form-control">
                                    <?php foreach ($cities as $city) : ?>
                                        <option value="<?php echo $city['id'] ?>"><?php echo $city[$lang->current() . '_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if ($formValidator->hasError('take_off_place')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('take_off_place'); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="col form-group">
                                <label for="expected_arrival_time"><?php echo $lang('expected_arrival_time') ?><span class="text-danger">*</span></label>
                                <input type="time" class="form-control" name="expected_arrival_time" id="expected_arrival_time" value="<?php echo $formValidator->getValue('expected_arrival_time'); ?>" />
                                <?php if ($formValidator->hasError('expected_arrival_time')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('expected_arrival_time'); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="average_waiting_time_unitil_access"><?php echo $lang('average_waiting_time_unitil_access') ?><span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="average_waiting_time_unitil_access" id="average_waiting_time_unitil_access" value="<?php echo $formValidator->getValue('average_waiting_time_unitil_access'); ?>" />
                            <?php if ($formValidator->hasError('average_waiting_time_unitil_access')) : ?>
                                <p class="text-danger"><?php echo $formValidator->getError('average_waiting_time_unitil_access'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="average_waiting_time_unitil_end_of_inspection"><?php echo $lang('average_waiting_time_unitil_end_of_inspection') ?><span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="average_waiting_time_unitil_end_of_inspection" id="average_waiting_time_unitil_end_of_inspection" value="<?php echo $formValidator->getValue('average_waiting_time_unitil_end_of_inspection'); ?>" />
                            <?php if ($formValidator->hasError('average_waiting_time_unitil_end_of_inspection')) : ?>
                                <p class="text-danger"><?php echo $formValidator->getError('average_waiting_time_unitil_end_of_inspection'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="average_waiting_until_sorting_system"><?php echo $lang('average_waiting_until_sorting_system') ?><span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="average_waiting_until_sorting_system" id="average_waiting_until_sorting_system" value="<?php echo $formValidator->getValue('average_waiting_until_sorting_system'); ?>" />
                            <?php if ($formValidator->hasError('average_waiting_until_sorting_system')) : ?>
                                <p class="text-danger"><?php echo $formValidator->getError('average_waiting_until_sorting_system'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="how_long_does_luggage_arrive_at"><?php echo $lang('how_long_does_luggage_arrive_at') ?><span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="how_long_does_luggage_arrive_at" id="how_long_does_luggage_arrive_at" value="<?php echo $formValidator->getValue('how_long_does_luggage_arrive_at'); ?>" />
                            <?php if ($formValidator->hasError('how_long_does_luggage_arrive_at')) : ?>
                                <p class="text-danger"><?php echo $formValidator->getError('how_long_does_luggage_arrive_at'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="duration_of_arrival_pilgrims"><?php echo $lang('duration_of_arrival_pilgrims') ?><span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="duration_of_arrival_pilgrims" id="duration_of_arrival_pilgrims" value="<?php echo $formValidator->getValue('duration_of_arrival_pilgrims'); ?>" />
                            <?php if ($formValidator->hasError('duration_of_arrival_pilgrims')) : ?>
                                <p class="text-danger"><?php echo $formValidator->getError('duration_of_arrival_pilgrims'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="flight_delay"><?php echo $lang('flight_delay') ?><span class="text-danger">*</span></label>
                            <select name="flight_delay" id="flight_delay" class="form-control">
                                <option >There is no delay</option>
                                <option >There is delay</option>
                            </select>
                            <?php if ($formValidator->hasError('flight_delay')) : ?>
                                <p class="text-danger"><?php echo $formValidator->getError('flight_delay'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="number_of_buses_operated_to_transport_pilgrims"><?php echo $lang('number_of_buses_operated_to_transport_pilgrims') ?><span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="number_of_buses_operated_to_transport_pilgrims" id="number_of_buses_operated_to_transport_pilgrims" value="<?php echo $formValidator->getValue('number_of_buses_operated_to_transport_pilgrims'); ?>" />
                            <?php if ($formValidator->hasError('number_of_buses_operated_to_transport_pilgrims')) : ?>
                                <p class="text-danger"><?php echo $formValidator->getError('number_of_buses_operated_to_transport_pilgrims'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="number_of_buses_operating_with_mecca_logo"><?php echo $lang('number_of_buses_operating_with_mecca_logo') ?><span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="number_of_buses_operating_with_mecca_logo" id="number_of_buses_operating_with_mecca_logo" value="<?php echo $formValidator->getValue('number_of_buses_operating_with_mecca_logo'); ?>" />
                            <?php if ($formValidator->hasError('number_of_buses_operating_with_mecca_logo')) : ?>
                                <p class="text-danger"><?php echo $formValidator->getError('number_of_buses_operating_with_mecca_logo'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for=""><?php echo $lang('are_there_unmarked_buses') ?><span class="text-danger">*</span></label>
                                <select name="are_there_unmarked_buses" class="form-control" id="are_there_unmarked_buses">
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                                <?php if ($formValidator->hasError('are_there_unmarked_buses')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('are_there_unmarked_buses'); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="col form-group">
                                <label for=""><?php echo $lang('are_there_any_accidents') ?><span class="text-danger">*</span></label>
                                <select name="are_there_any_accidents" class="form-control" id="are_there_any_accidents">
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                                <?php if ($formValidator->hasError('are_there_any_accidents')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('are_there_any_accidents'); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class=" form-group">
                                <label for="number_of_cases"><?php echo $lang('number_of_cases') ?><span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="number_of_cases" id="number_of_cases" value="<?php echo $formValidator->getValue('number_of_cases'); ?>" />
                                <?php if ($formValidator->hasError('number_of_cases')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('number_of_cases'); ?></p>
                                <?php endif; ?>
                            </div>
                            
                        </div>
                            <div class="form-group">
                                <label for="challenges"><?php echo $lang('challenges') ?></label>
                                <textarea name="challenges" class="form-control" id="" cols="30" rows="3"><?php echo $formValidator->getValue('challenges'); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="treatment"><?php echo $lang('solutions') ?></label>
                                <textarea name="treatment" class="form-control" id="" cols="30" rows="3"><?php echo $formValidator->getValue('solutions'); ?></textarea>
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