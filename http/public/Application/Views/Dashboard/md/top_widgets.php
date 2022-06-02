<?php

use Application\Helpers\Number;
use System\Core\Database;
use System\Core\Model;
use System\Models\Language;

$lang = Model::get(Language::class);

/**
 * @var Database
 */
$db = Database::get();

$SUBSQL1 = " SELECT `id` FROM `flights` ";

// PREPARE SUB SQL
$dbValues1 = [];
$WHERE1 = [];

if (!empty($cityId)) {
    $WHERE1[] = " `sairport` IN (
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

$SUBSQL1 .= !empty($WHERE1) ?  "WHERE " . implode(" AND ", $WHERE1) : "";
// END PREPARE FILTER SQL

$SQL1 = "SELECT COUNT(*) as `count` FROM `flights` WHERE `id` IN ( $SUBSQL1 )";
$SQL2 = "SELECT SUM(`passengers`) as `count` FROM `departure_form` WHERE `flight_id` IN ( $SUBSQL1 )";
$SQL3 = "SELECT SEC_TO_TIME(FLOOR(AVG(`check_out_time` - `check_in_time`))) as `count` FROM `passengers` WHERE `flight` IN ( $SUBSQL1 )";
$SQL4 = "SELECT
            SEC_TO_TIME(FLOOR(AVG(`x2`.`closed_at` - `x1`.`opened_at`))) as `count`
            FROM (
                SELECT
                    `date`, MIN(`time`) as `opened_at`
                FROM `counter_timing`
                WHERE `type` = 'open' AND `flight` IN ( $SUBSQL1 ) GROUP BY `date`
            ) AS `x1`
            INNER JOIN (
                SELECT `date`, MAX(`time`) AS `closed_at`
                FROM `counter_timing`
                WHERE `type` = 'close' AND `flight` IN ( $SUBSQL1 ) GROUP BY `date`
            ) AS `x2`
            ON (`x2`.`date` = `x1`.`date`)
        ";

$SQL5 = "SELECT AVG(`avg_score`) as `count` FROM `departure_assesment` WHERE `flight_id` IN ( $SUBSQL1 )";

$flightsTotal = $db->query($SQL1, $dbValues1)->get();
$flightsTotal = $flightsTotal['count'];

$passengersTotal = $db->query($SQL2, $dbValues1)->get();
$passengersTotal = $passengersTotal['count'];

$serviceTime = $db->query($SQL3, $dbValues1)->get();
$serviceTime = $serviceTime['count'];


$counterTiming = $db->query($SQL4, array_merge($dbValues1, $dbValues1))->get();
$counterTiming = $counterTiming['count'];

$score = $db->query($SQL5, $dbValues1)->get();
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
                <h3 class="text-center"><?php echo $lang('avg_service_time') ?></h3>
            </div>
            <div class="card-body">
                <div class="number text-center h1 text-primary"><?php echo isset($serviceTime) ? $serviceTime : "00:00:00"; ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center"><?php echo $lang('counter_working_time') ?></h3>
            </div>
            <div class="card-body">
                <div class="number text-center h1 text-primary"><?php echo isset($counterTiming) ? $counterTiming : "00:00:00"; ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center"><?php echo $lang('hajj_satisfaction_rate') ?></h3>
            </div>
            <div class="card-body">
                <div class="number text-center h1 text-primary"><?php echo $score; ?></div>
            </div>
        </div>
    </div>

</div>