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

$SUBSQL1 = " SELECT `id` FROM `flights` WHERE `dairport` IS NOT NULL ";

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

$SUBSQL1 .= !empty($WHERE1) ?  " AND " . implode(" AND ", $WHERE1) : "";
// END PREPARE FILTER SQL

$SQL1 = "SELECT CONCAT( COUNT(*) - SUM(`flight_delay`), '/', COUNT(*)) AS `count` FROM `arrival_form` WHERE `flight_id` IN ( $SUBSQL1 )";
$SQL2 = "SELECT CONCAT(ROUND(SUM(`unmarked_buses`) / COUNT(*) * 100), '%') AS `count` FROM `arrival_form` WHERE `flight_id` IN ( $SUBSQL1)";
$SQL3 = "SELECT CONCAT(SUM(`accidents`), '/', COUNT(*)) AS `count` FROM `arrival_form` WHERE `flight_id` IN ( $SUBSQL1 )";
$SQL4 = "SELECT SUM(`buses_ready_to_pilgrims`) AS `count` FROM `arrival_form` WHERE `flight_id` IN ( $SUBSQL1 )";
$SQL5 = "SELECT SUM(`buses_with_mecca_logo`) AS `count` FROM `arrival_form` WHERE `flight_id` IN ( $SUBSQL1 )";
$SQL6 = "SELECT SUM(`sick_cases`) AS `count` FROM `arrival_form` WHERE `flight_id` IN ( $SUBSQL1 )";

$flightDelay = $db->query($SQL1, $dbValues1)->get();
$flightDelay = $flightDelay['count'];

$unmarkedBuses = $db->query($SQL2, $dbValues1)->get();
$unmarkedBuses = $unmarkedBuses['count'];

$accidents = $db->query($SQL3, $dbValues1)->get();
$accidents = $accidents['count'];

$pilgrims = $db->query($SQL4, $dbValues1)->get();
$pilgrims = $pilgrims['count'];

$meccaLogo = $db->query($SQL5, $dbValues1)->get();
$meccaLogo = $meccaLogo['count'];

$sickCases = $db->query($SQL6, $dbValues1)->get();
$sickCases = $sickCases['count'];

?>
<div class="row">

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center"><?php echo $lang('flight_delay') ?></h3>
            </div>
            <div class="card-body">
                <div class="number text-center h1 text-primary"><?php echo isset($flightDelay) ? $flightDelay : '0/0'; ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center"><?php echo $lang('number_of_buses_operated_to_transport_pilgrims') ?></h3>
            </div>
            <div class="card-body">
                <div class="number text-center h1 text-primary"><?php echo isset($pilgrims) ? $pilgrims : 0; ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center"><?php echo $lang('number_of_buses_operating_with_mecca_logo') ?></h3>
            </div>
            <div class="card-body">
                <div class="number text-center h1 text-primary"><?php echo isset($meccaLogo) ? $meccaLogo : 0; ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center"><?php echo $lang('are_there_unmarked_buses') ?></h3>
            </div>
            <div class="card-body">
                <div class="number text-center h1 text-primary"><?php echo isset($unmarkedBuses) ? $unmarkedBuses : '0%' ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center"><?php echo $lang('are_there_any_accidents') ?></h3>
            </div>
            <div class="card-body">
                <div class="number text-center h1 text-primary"><?php echo isset($accidents) ? $accidents : '0/0'; ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center"><?php echo $lang('number_of_cases') ?></h3>
            </div>
            <div class="card-body">
                <div class="number text-center h1 text-primary"><?php echo isset($sickCases) ? $sickCases : 0; ?></div>
            </div>
        </div>
    </div>


</div>