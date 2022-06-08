<?php

use Application\Helpers\DateHelper;
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

$SUBSQL1 = " SELECT `id` FROM `flights` ";

// PREPARE SUB SQL
$dbValues1 = [];
$WHERE1 = [ " `status` <> '" . Flights::STATUS_INVALID . "'" ];

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

$SUBSQL1 .= !empty($WHERE1) ?  " WHERE " . implode(" AND ", $WHERE1) : "";
// END PREPARE FILTER SQL

$SQL1 = "SELECT SUM(`working_counts`) AS `count` FROM `departure_form` WHERE `flight_id` IN ( $SUBSQL1 )";
$SQL2 = "SELECT SUM(`non_working_counts`) AS `count` FROM `departure_form` WHERE `flight_id` IN ( $SUBSQL1)";
$SQL3 = "SELECT SUM(`number_of_men`) AS `count` FROM `departure_form` WHERE `flight_id` IN ( $SUBSQL1 )";
$SQL4 = "SELECT SUM(`number_of_women`) AS `count` FROM `departure_form` WHERE `flight_id` IN ( $SUBSQL1 )";
$SQL5 = "SELECT SUM(`number_of_seats`) AS `count` FROM `departure_form` WHERE `flight_id` IN ( $SUBSQL1 )";
$SQL6 = "SELECT SUM(`number_of_cases`) AS `count` FROM `departure_form` WHERE `flight_id` IN ( $SUBSQL1 )";
$SQL7 = "SELECT SUM(`number_of_bags`) AS `count` FROM `departure_form` WHERE `flight_id` IN ( $SUBSQL1 )";
$SQL8 = "SELECT SUM(`number_of_fingerprint`) AS `count` FROM `departure_form` WHERE `flight_id` IN ( $SUBSQL1 )";
$SQL9 = "SELECT CONCAT(ROUND(AVG(`communication_speed`) / 2 * 100), '%') AS `count` FROM `departure_form` WHERE `flight_id` IN ( $SUBSQL1 )";
$SQL10 = "SELECT CONCAT(ROUND(AVG(`connection_status`) / 2 * 100), '%') AS `count` FROM `departure_form` WHERE `flight_id` IN ( $SUBSQL1 )";
$SQL11 = "SELECT CONCAT(ROUND(AVG(`fingerprint_status`) / 2 * 100), '%') AS `count` FROM `departure_form` WHERE `flight_id` IN ( $SUBSQL1 )";
$SQL12 = "SELECT FLOOR(AVG(`check_out_time` - `check_in_time`)) as `count` FROM `passengers` WHERE `flight` IN ( $SUBSQL1 ) AND `check_out_time` - `check_in_time` >= 0";
$SQL13 = "SELECT FLOOR(AVG(`average_pilgrim_service`)) AS `count` FROM `departure_form` WHERE `flight_id` IN ( $SUBSQL1 )";

$workingCounts = $db->query($SQL1, $dbValues1)->get();
$workingCounts = $workingCounts['count'];

$nonWorkingCounts = $db->query($SQL2, $dbValues1)->get();
$nonWorkingCounts = $nonWorkingCounts['count'];

$numberOfMen = $db->query($SQL3, $dbValues1)->get();
$numberOfMen = $numberOfMen['count'];

$numberOfWomen = $db->query($SQL4, $dbValues1)->get();
$numberOfWomen = $numberOfWomen['count'];

$numberOfSeats = $db->query($SQL5, $dbValues1)->get();
$numberOfSeats = $numberOfSeats['count'];

$numberOfCases = $db->query($SQL6, $dbValues1)->get();
$numberOfCases = $numberOfCases['count'];

$numberOfBags = $db->query($SQL7, $dbValues1)->get();
$numberOfBags = $numberOfBags['count'];

$numberOfFinger = $db->query($SQL8, $dbValues1)->get();
$numberOfFinger = $numberOfFinger['count'];

$conSpeed = $db->query($SQL9, $dbValues1)->get();
$conSpeed = $conSpeed['count'];

$comSpeed = $db->query($SQL10, $dbValues1)->get();
$comSpeed = $comSpeed['count'];

$fingerSpeed = $db->query($SQL11, $dbValues1)->get();
$fingerSpeed = $fingerSpeed['count'];

$waitingTime = $db->query($SQL12, $dbValues1)->get();
$waitingTime = $waitingTime['count'];

$avgService = $db->query($SQL13, $dbValues1)->get();
$avgService = $avgService['count'];


?>
<div class="row">

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center"><?php echo $lang('number_working_counters') ?></h3>
            </div>
            <div class="card-body">
                <div class="number text-center h1 text-primary"><?php echo isset($workingCounts) ? $workingCounts : 0; ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center"><?php echo $lang('number_non_operating_counters') ?></h3>
            </div>
            <div class="card-body">
                <div class="number text-center h1 text-primary"><?php echo isset($nonWorkingCounts) ? $nonWorkingCounts : 0; ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center"><?php echo $lang('average_waiting_hajj') ?></h3>
            </div>
            <div class="card-body">
                <div class="number text-center h1 text-primary"><?php echo isset($waitingTime) ? DateHelper::secToHR($waitingTime - $avgService) : '00:00:00';  ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center"><?php echo $lang('average_hajj_service') ?></h3>
            </div>
            <div class="card-body">
                <div class="number text-center h1 text-primary"><?php echo isset($avgService) ? DateHelper::secToHR($avgService) : '00:00:00' ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center"><?php echo $lang('number_of_males') ?></h3>
            </div>
            <div class="card-body">
                <div class="number text-center h1 text-primary"><?php echo isset($numberOfMen) ? $numberOfMen : 0; ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center"><?php echo $lang('number_of_women') ?></h3>
            </div>
            <div class="card-body">
                <div class="number text-center h1 text-primary"><?php echo isset($numberOfWomen) ? $numberOfWomen : 0; ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center"><?php echo $lang('number_of_seats') ?></h3>
            </div>
            <div class="card-body">
                <div class="number text-center h1 text-primary"><?php echo isset($numberOfSeats) ? $numberOfSeats : 0; ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center"><?php echo $lang('number_of_sick') ?></h3>
            </div>
            <div class="card-body">
                <div class="number text-center h1 text-primary"><?php echo isset($numberOfCases) ? $numberOfCases : 0; ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center"><?php echo $lang('number_of_blindfolded') ?></h3>
            </div>
            <div class="card-body">
                <div class="number text-center h1 text-primary"><?php echo isset($numberOfFinger) ? $numberOfFinger : 0 ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center"><?php echo $lang('number_of_bag_used') ?></h3>
            </div>
            <div class="card-body">
                <div class="number text-center h1 text-primary"><?php echo isset($numberOfBags) ? $numberOfBags : 0; ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center"><?php echo $lang('fingerprint_status') ?></h3>
            </div>
            <div class="card-body">
                <div class="number text-center h1 text-primary"><?php echo isset($fingerSpeed) ? $fingerSpeed : '0%'; ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center"><?php echo $lang('connection_status') ?></h3>
            </div>
            <div class="card-body">
                <div class="number text-center h1 text-primary"><?php echo isset($conSpeed) ? $conSpeed : '0%'; ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center"><?php echo $lang('connection_speed') ?></h3>
            </div>
            <div class="card-body">
                <div class="number text-center h1 text-primary"><?php echo isset($comSpeed) ? $comSpeed : '0%' ?></div>
            </div>
        </div>
    </div>

</div>