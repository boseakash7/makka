<?php

use Application\Models\Airport;
use Application\Models\City;
use System\Core\Model;
use System\Helpers\URL;
use System\Libs\FormValidator;
use System\Models\Language;

$lang = Model::get(Language::class);

$formValidator = FormValidator::instance("edit-arrival-form");

?>

<define title>
    <?php echo $lang('arrival_form_title') ?>
</define>
<define page_desc>
    <?php echo $lang('complete_the_form') ?>
</define>
<define right_header>
    <a href="<?php echo URL::full('flights') ?>">
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
                        <div class="row">

                            <div class="col form-group">
                                <label for="date"><?php echo $lang('date') ?><span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="date" id="date" value="<?php echo $formValidator->getValue('date', $arrivalInfo['arr']['date']); ?>" />
                                <?php if ($formValidator->hasError('date')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('date'); ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="col form-group">
                                <label for="city"><?php echo $lang('arrival_city') ?><span class="text-danger">*</span></label>
                                <select name="arrival_city" id="arrival_city" class="form-control">
                                    <?php foreach ($cities as $city) : ?>
                                        <?php if ( $city['type'] != City::TYPE_DESTINATION ) continue; ?>
                                        <option value="<?php echo $city['id'] ?>" <?php echo $formValidator->getValue('arrival_city', $flightInfo['dairport']['city']) == $city['id'] ? 'selected' : ''; ?>><?php echo $city[$lang->current() . '_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if ($formValidator->hasError('arrival_city')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('arrival_city'); ?></p>
                                <?php endif; ?>
                            </div>

                        </div>
                        <div class="form-group">

                            <label for="flight_number"><?php echo $lang('flight_number') ?><span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="flight_number" id="flight_number" readonly value="<?php echo $formValidator->getValue('flight_number', $flightInfo['number']); ?>" />
                            <?php if ($formValidator->hasError('flight_number')) : ?>
                                <p class="text-danger"><?php echo $formValidator->getError('flight_number'); ?></p>
                            <?php endif; ?>

                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="number_of_staffs"><?php echo $lang('number_of_staffs') ?><span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="number_of_staffs" id="number_of_staffs" value="<?php echo $formValidator->getValue('number_of_staffs', $arrivalInfo['arr']['number_of_staffs']); ?>" />
                                <?php if ($formValidator->hasError('number_of_staffs')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('number_of_staffs'); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="col form-group">
                                <label for="number_of_counter_custom_staffs"><?php echo $lang('number_of_counter_custom_staffs') ?><span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="number_of_counter_custom_staffs" id="number_of_counter_custom_staffs" value="<?php echo $formValidator->getValue('number_of_counter_custom_staffs', $arrivalInfo['arr']['number_of_counter_custom_staffs']); ?>" />
                                <?php if ($formValidator->hasError('number_of_counter_custom_staffs')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('number_of_counter_custom_staffs'); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="passengers"><?php echo $lang('passengers') ?><span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="passengers" id="passengers" value="<?php echo $formValidator->getValue('passengers', $arrivalInfo['arr']['passengers']); ?>" />
                                <?php if ($formValidator->hasError('passengers')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('passengers'); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="col form-group">
                                <label for="arrival_time"><?php echo $lang('arrival_time') ?><span class="text-danger">*</span></label>
                                <input type="time" class="form-control" name="arrival_time" id="arrival_time" value="<?php echo $formValidator->getValue('arrival_time', $arrivalInfo['arr']['arrival_time']); ?>" />
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
                                        <?php if ( $city['type'] != City::TYPE_SOURCE ) continue; ?>
                                        <option value="<?php echo $city['id'] ?>" <?php echo $formValidator->getValue('take_off_place', $flightInfo['sairport']['city']) == $city['id'] ? 'selected' : ''; ?>><?php echo $city[$lang->current() . '_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if ($formValidator->hasError('take_off_place')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('take_off_place'); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="col form-group">
                                <label for="expected_arrival_time"><?php echo $lang('expected_arrival_time') ?><span class="text-danger">*</span></label>
                                <input type="time" class="form-control" name="expected_arrival_time" id="expected_arrival_time" value="<?php echo $formValidator->getValue('expected_arrival_time', $arrivalInfo['arr']['expected_arrival_time']); ?>" />
                                <?php if ($formValidator->hasError('expected_arrival_time')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('expected_arrival_time'); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="average_waiting_time_unitil_access"><?php echo $lang('average_waiting_time_unitil_access') ?><span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="average_waiting_time_unitil_access" id="average_waiting_time_unitil_access" value="<?php echo $formValidator->getValue('average_waiting_time_unitil_access', $arrivalInfo['arr']['average_waiting_time_unitil_access']); ?>" placeholder="<?php echo $lang('in_minutes') ?>"/>
                            <?php if ($formValidator->hasError('average_waiting_time_unitil_access')) : ?>
                                <p class="text-danger"><?php echo $formValidator->getError('average_waiting_time_unitil_access'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="average_waiting_time_unitil_end_of_inspection"><?php echo $lang('average_waiting_time_unitil_end_of_inspection') ?><span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="average_waiting_time_unitil_end_of_inspection" id="average_waiting_time_unitil_end_of_inspection" value="<?php echo $formValidator->getValue('average_waiting_time_unitil_end_of_inspection', $arrivalInfo['arr']['average_waiting_time_unitil_end_of_inspection']); ?>" placeholder="<?php echo $lang('in_minutes') ?>"/>
                            <?php if ($formValidator->hasError('average_waiting_time_unitil_end_of_inspection')) : ?>
                                <p class="text-danger"><?php echo $formValidator->getError('average_waiting_time_unitil_end_of_inspection'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="average_waiting_until_sorting_system"><?php echo $lang('average_waiting_until_sorting_system') ?><span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="average_waiting_until_sorting_system" id="average_waiting_until_sorting_system" value="<?php echo $formValidator->getValue('average_waiting_until_sorting_system', $arrivalInfo['arr']['average_waiting_until_sorting_system']); ?>" placeholder="<?php echo $lang('in_minutes') ?>"/>
                            <?php if ($formValidator->hasError('average_waiting_until_sorting_system')) : ?>
                                <p class="text-danger"><?php echo $formValidator->getError('average_waiting_until_sorting_system'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="how_long_does_luggage_arrive_at"><?php echo $lang('how_long_does_luggage_arrive_at') ?><span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="how_long_does_luggage_arrive_at" id="how_long_does_luggage_arrive_at" value="<?php echo $formValidator->getValue('how_long_does_luggage_arrive_at', $arrivalInfo['arr']['how_long_does_luggage_arrive_at']); ?>" placeholder="<?php echo $lang('in_minutes') ?>"/>
                            <?php if ($formValidator->hasError('how_long_does_luggage_arrive_at')) : ?>
                                <p class="text-danger"><?php echo $formValidator->getError('how_long_does_luggage_arrive_at'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="first_hajji_arrived_time"><?php echo $lang('first_hajji_arrived_time') ?><span class="text-danger">*</span></label>
                            <input type="time" class="form-control" name="first_hajji_arrived_time" id="first_hajji_arrived_time" value="<?php echo $formValidator->getValue('first_hajji_arrived_time', $arrivalInfo['arr']['first_hajji_arrived_time']); ?>" />
                            <?php if ($formValidator->hasError('first_hajji_arrived_time')) : ?>
                                <p class="text-danger"><?php echo $formValidator->getError('first_hajji_arrived_time'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="last_hajji_arrived_time"><?php echo $lang('last_hajji_arrived_time') ?><span class="text-danger">*</span></label>
                            <input type="time" class="form-control" name="last_hajji_arrived_time" id="last_hajji_arrived_time" value="<?php echo $formValidator->getValue('last_hajji_arrived_time', $arrivalInfo['arr']['last_hajji_arrived_time']); ?>" />
                            <?php if ($formValidator->hasError('last_hajji_arrived_time')) : ?>
                                <p class="text-danger"><?php echo $formValidator->getError('last_hajji_arrived_time'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="first_bus_leave_time"><?php echo $lang('first_bus_leave_time') ?><span class="text-danger">*</span></label>
                            <input type="time" class="form-control" name="first_bus_leave_time" id="first_bus_leave_time" value="<?php echo $formValidator->getValue('first_bus_leave_time', $arrivalInfo['arr']['first_bus_leave_time']); ?>" />
                            <?php if ($formValidator->hasError('first_bus_leave_time')) : ?>
                                <p class="text-danger"><?php echo $formValidator->getError('first_bus_leave_time'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="flight_delay"><?php echo $lang('flight_delay') ?><span class="text-danger">*</span></label>
                            <select name="flight_delay" id="flight_delay" class="form-control">
                                <option value="no_delay" <?php echo $formValidator->getValue('flight_delay', $arrivalInfo['arr']['flight_delay']) == 'no_delay' ? 'selected' : '' ?>><?php echo $lang('no_delay'); ?></option>
                                <option value="delay" <?php echo $formValidator->getValue('flight_delay', $arrivalInfo['arr']['flight_delay']) == 'delay' ? 'selected' : '' ?>><?php echo $lang('delay'); ?></option>
                            </select>
                            <?php if ($formValidator->hasError('flight_delay')) : ?>
                                <p class="text-danger"><?php echo $formValidator->getError('flight_delay'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="number_of_buses_operated_to_transport_pilgrims"><?php echo $lang('number_of_buses_operated_to_transport_pilgrims') ?><span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="number_of_buses_operated_to_transport_pilgrims" id="number_of_buses_operated_to_transport_pilgrims" value="<?php echo $formValidator->getValue('number_of_buses_operated_to_transport_pilgrims', $arrivalInfo['arr']['number_of_buses_operated_to_transport_pilgrims']); ?>" />
                            <?php if ($formValidator->hasError('number_of_buses_operated_to_transport_pilgrims')) : ?>
                                <p class="text-danger"><?php echo $formValidator->getError('number_of_buses_operated_to_transport_pilgrims'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="number_of_buses_operating_with_mecca_logo"><?php echo $lang('number_of_buses_operating_with_mecca_logo') ?><span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="number_of_buses_operating_with_mecca_logo" id="number_of_buses_operating_with_mecca_logo" value="<?php echo $formValidator->getValue('number_of_buses_operating_with_mecca_logo', $arrivalInfo['arr']['number_of_buses_operating_with_mecca_logo']); ?>" />
                            <?php if ($formValidator->hasError('number_of_buses_operating_with_mecca_logo')) : ?>
                                <p class="text-danger"><?php echo $formValidator->getError('number_of_buses_operating_with_mecca_logo'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for=""><?php echo $lang('are_there_unmarked_buses') ?><span class="text-danger">*</span></label>
                                <select name="are_there_unmarked_buses" class="form-control" id="are_there_unmarked_buses">
                                    <option value="yes" <?php echo $formValidator->getValue('are_there_unmarked_buses', $arrivalInfo['arr']['are_there_unmarked_buses']) == 'yes' ? 'selected' : '' ?>><?php echo $lang('yes') ?></option>
                                    <option value="no" <?php echo $formValidator->getValue('are_there_unmarked_buses', $arrivalInfo['arr']['are_there_unmarked_buses']) == 'no' ? 'selected' : '' ?>><?php echo $lang('no') ?></option>
                                </select>
                                <?php if ($formValidator->hasError('are_there_unmarked_buses')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('are_there_unmarked_buses'); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="col form-group">
                                <label for=""><?php echo $lang('are_there_any_accidents') ?><span class="text-danger">*</span></label>                                
                                <select name="are_there_any_accidents" class="form-control" id="are_there_any_accidents">
                                    <option value="yes" <?php echo $formValidator->getValue('are_there_any_accidents', $arrivalInfo['arr']['are_there_any_accidents']) == 'yes' ? 'selected' : '' ?>><?php echo $lang('yes') ?></option>
                                    <option value="no" <?php echo $formValidator->getValue('are_there_any_accidents', $arrivalInfo['arr']['are_there_any_accidents']) == 'no' ? 'selected' : '' ?>><?php echo $lang('no') ?></option>
                                </select>
                                <?php if ($formValidator->hasError('are_there_any_accidents')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('are_there_any_accidents'); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class=" form-group">
                                <label for="number_of_cases"><?php echo $lang('number_of_cases') ?><span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="number_of_cases" id="number_of_cases" value="<?php echo $formValidator->getValue('number_of_cases', $arrivalInfo['arr']['number_of_cases']); ?>" />
                                <?php if ($formValidator->hasError('number_of_cases')) : ?>
                                    <p class="text-danger"><?php echo $formValidator->getError('number_of_cases'); ?></p>
                                <?php endif; ?>
                            </div>
                            
                        </div>
                            <div class="form-group">
                                <label for="challenges"><?php echo $lang('challenges') ?></label>
                                <textarea name="challenges" class="form-control" id="" cols="30" rows="3"><?php echo $formValidator->getValue('challenges', $arrivalInfo['arr']['challenges']); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="solutions"><?php echo $lang('solutions') ?></label>
                                <textarea name="solutions" class="form-control" id="solutions" cols="30" rows="3"><?php echo $formValidator->getValue('solutions', $arrivalInfo['arr']['solutions']); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="recommendations"><?php echo $lang('recommendations') ?></label>
                                <textarea name="recommendations" class="form-control" id="" cols="30" rows="3"><?php echo $formValidator->getValue('recommendations', $arrivalInfo['arr']['recommendations']); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="reviews"><?php echo $lang('reviews') ?></label>
                                <textarea name="reviews" class="form-control" id="" cols="30" rows="3"><?php echo $formValidator->getValue('reviews', $arrivalInfo['arr']['reviews']); ?></textarea>
                            </div>
                            
                        </div>
                        <button type="submit" class="btn btn-primary"><?php echo $lang('submit'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <define footer_js>
        <script>
            $('#arrival_city').on('change', function() {

                var val = $(this).val().trim();
                if ( val == '' ) {
                    $('#departure_airport').html('<option value=""><?php echo $lang('select_airport') ?></option>');
                    return;
                }

                $.ajax({
                    url: '<?php echo URL::full('ajax/form/get-airports-by-city') ?>',
                    data: {
                        city: $(this).val(),
                        type: '<?php echo Airport::TYPE_DESTINATION ?>'
                    },
                    type: 'POST',
                    dataType: 'JSON',
                    accepts: 'JSON',
                    beforeSend: function() {

                    },
                    success: function( data ) {
                        var options = data.payload;
                        $('#departure_airport').html(options);
                    }
                });
            });
        </script>
    </define>