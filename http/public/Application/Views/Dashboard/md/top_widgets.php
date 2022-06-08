<?php

use Application\Helpers\Number;
use Application\Models\Flights;
use System\Core\Database;
use System\Core\Model;
use System\Models\Language;

$lang = Model::get(Language::class);

/**
 * @var Database
 */
$db = Database::get();

$SUBSQL1 = " SELECT `id` FROM `flights` WHERE `dairport` IS NOT NULL AND `status` <> '" . Flights::STATUS_INVALID . "'";

// PREPARE SUB SQL
$dbValues1 = [];
$WHERE1 = [];

if (!empty($cityId)) {
    $WHERE1[] = " `dairport` IN (
        SELECT `id` FROM `airports` WHERE `city` = ?
    ) ";
    $dbValues1[] = $cityId;
}

if (!empty($from)) {
    $WHERE1[] = " `tdate` >= ? ";
    $dbValues1[] = $from;
}

if (!empty($to)) {
    $WHERE1[] = " `tdate` <= ? ";
    $dbValues1[] = $to;
}

$SUBSQL1 .= !empty($WHERE1) ?  " AND " . implode(" AND ", $WHERE1) : "";
// END PREPARE FILTER SQL

$SQL1 = "SELECT COUNT(*) as `count` FROM `flights` WHERE `id` IN ( $SUBSQL1 )";
$SQL2 = "SELECT SUM(`passengers`) as `count` FROM `arrival_form` WHERE `flight_id` IN ( $SUBSQL1 )";
$SQL3 = "SELECT SEC_TO_TIME(FLOOR(AVG(`average_waiting_to_sterile`))) as `count` FROM `arrival_form` WHERE `flight_id` IN ( $SUBSQL1 )";
$SQL4 = "SELECT SEC_TO_TIME(FLOOR(AVG(`average_waiting_inspection`))) as `count` FROM `arrival_form` WHERE `flight_id` IN ( $SUBSQL1 )";
$SQL5 = "SELECT SEC_TO_TIME(FLOOR(AVG(`average_luggage_arrive`))) as `count` FROM `arrival_form` WHERE `flight_id` IN ( $SUBSQL1 )";
$SQL6 = "SELECT SEC_TO_TIME(FLOOR(AVG(`average_bus_ride`))) as `count` FROM `arrival_form` WHERE `flight_id` IN ( $SUBSQL1 )";
$SQL7 = "SELECT SEC_TO_TIME(FLOOR(AVG(`duration_pilgrims`))) as `count` FROM `arrival_form` WHERE `flight_id` IN ( $SUBSQL1 )";
$SQL8 = "SELECT AVG(`avg_score`) as `count` FROM `arrival_assesment` WHERE `flight_id` IN ( $SUBSQL1 )";

$flightsTotal = $db->query($SQL1, $dbValues1)->get();
$flightsTotal = $flightsTotal['count'];

$passengersTotal = $db->query($SQL2, $dbValues1)->get();
$passengersTotal = $passengersTotal['count'];

$avgWaitingTime = $db->query($SQL3, $dbValues1)->get();
$avgWaitingTime = $avgWaitingTime['count'];

$inspectionTime = $db->query($SQL4, $dbValues1)->get();
$inspectionTime = $inspectionTime['count'];

$luggageArrive = $db->query($SQL5, $dbValues1)->get();
$luggageArrive = $luggageArrive['count'];

$busRide = $db->query($SQL6, $dbValues1)->get();
$busRide = $busRide['count'];

$pilgrims = $db->query($SQL7, $dbValues1)->get();
$pilgrims = $pilgrims['count'];

$score = $db->query($SQL8, $dbValues1)->get();
$score = round($score['count']);



?>
<div class="row">

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center"><?php echo $lang('number_of_flights') ?></h3>
            </div>
            <div class="card-body">
                <div class="number text-center h1 text-primary"><?php echo Number::pretty($flightsTotal) ?></div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center"><?php echo $lang('passengers') ?></h3>
            </div>
            <div class="card-body">
                <div class="number text-center h1 text-primary"><?php echo Number::pretty($passengersTotal) ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center h5"><?php echo $lang('average_waiting_time_unitil_access') ?></h3>
            </div>
            <div class="card-body">
                <div class="number text-center h1 text-primary"><?php echo isset($avgWaitingTime) ? $avgWaitingTime : "00:00:00"; ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center h5"><?php echo $lang('average_waiting_time_unitil_end_of_inspection') ?></h3>
            </div>
            <div class="card-body">
                <div class="number text-center h1 text-primary"><?php echo isset($inspectionTime) ? $inspectionTime : "00:00:00"; ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center h5"><?php echo $lang('average_waiting_until_sorting_system') ?></h3>
            </div>
            <div class="card-body">
                <div class="number text-center h1 text-primary"><?php echo isset($busRide) ? $busRide : "00:00:00"; ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center h5"><?php echo $lang('duration_of_arrival_pilgrims') ?></h3>
            </div>
            <div class="card-body">
                <div class="number text-center h1 text-primary"><?php echo isset($pilgrims) ? $pilgrims : "00:00:00"; ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center h5"><?php echo $lang('baggage_arrival_time_to_accommodation') ?></h3>
            </div>
            <div class="card-body">
                <div class="number text-center h1 text-primary"><?php echo isset($luggageArrive) ? $luggageArrive : "00:00:00"; ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center h5"><?php echo $lang('hajj_satisfaction_rate') ?></h3>
            </div>
            <div class="card-body">
                <div class="number text-center h1 text-primary"><?php echo $score . '%'; ?></div>
            </div>
        </div>
    </div>

</div>