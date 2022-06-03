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

$SUBSQL2 = " SELECT `id` FROM `flights` WHERE `dairport` IN (
    SELECT `id` FROM `airports` WHERE `city` = `cities`.`id`
) ";

// PREPARE SUB SQL
$dbValues2 = [];
$WHERE2 = [];

if (!empty($from)) {
    $WHERE2[] = " `tdate` >= :from ";
    $dbValues2[':from'] = $from;
}

if (!empty($to)) {
    $WHERE2[] = " `tdate` <= :to ";
    $dbValues2[':to'] = $to;
}

$SUBSQL2 .= !empty($WHERE2) ?  " AND " . implode(" AND ", $WHERE2) : "";
// $SUBSQL3 .= !empty($WHERE2) ?  " AND " . implode(" AND ", $WHERE2) : "";

$SQL1 = "SELECT COUNT(*) as `count` FROM `flights` WHERE `id` IN ( $SUBSQL2 )";
$SQL2 = "SELECT SUM(`passengers`) as `count` FROM `arrival_form` WHERE `flight_id` IN ( $SUBSQL2 )";
$SQL3 = "SELECT SEC_TO_TIME(FLOOR(AVG(`average_waiting_to_sterile`))) as `count` FROM `arrival_form` WHERE `flight_id` IN ( $SUBSQL2 )";
$SQL4 = "SELECT SEC_TO_TIME(FLOOR(AVG(`average_waiting_inspection`))) as `count` FROM `arrival_form` WHERE `flight_id` IN ( $SUBSQL2 )";
$SQL5 = "SELECT SEC_TO_TIME(FLOOR(AVG(`average_luggage_arrive`))) as `count` FROM `arrival_form` WHERE `flight_id` IN ( $SUBSQL2 )";
$SQL6 = "SELECT SEC_TO_TIME(FLOOR(AVG(`average_bus_ride`))) as `count` FROM `arrival_form` WHERE `flight_id` IN ( $SUBSQL2 )";
$SQL7 = "SELECT SEC_TO_TIME(FLOOR(AVG(`duration_pilgrims`))) as `count` FROM `arrival_form` WHERE `flight_id` IN ( $SUBSQL2 )";
$SQL8 = "SELECT FLOOR(AVG(`avg_score`)) as `count` FROM `arrival_assesment` WHERE `flight_id` IN ( $SUBSQL2 )";


$CITYSQL = "SELECT
            `id` AS `i`,
            `en_name`,
            `ar_name`,
        ($SQL1) AS `totalFlights`,
        ($SQL2) AS `passengers`,
        ($SQL3) AS `avgWaitingTime`,
        ($SQL4) AS `inspectionTime`,
        ($SQL5) AS `luggageArrive`,
        ($SQL6) AS `busRide`,
        ($SQL7) AS `pilgrims`,
        ($SQL8) AS `avg_core`
        FROM
        `cities`
";

if ( !empty($cityId) ) {
    $CITYSQL .= " WHERE `id` = :c";
    $dbValues2[':c'] = $cityId;
}

$cities = $db->query($CITYSQL, $dbValues2)->getAll();

?>


<div class="row">
        <div class="col-md-12">
            <h3 class="details"><?php echo $lang('details'); ?></h3>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <td><?php echo $lang('city') ?></td>
                                <td><?php echo $lang('number_of_flights') ?></td>
                                <td><?php echo $lang('passengers') ?></td>
                                <td><?php echo $lang('average_waiting_time_unitil_access') ?></td>
                                <td><?php echo $lang('average_waiting_time_unitil_end_of_inspection') ?></td>
                                <td><?php echo $lang('average_waiting_until_sorting_system') ?></td>
                                <td><?php echo $lang('baggage_arrival_time_to_accommodation') ?></td>
                                <td><?php echo $lang('duration_of_arrival_pilgrims') ?></td>
                                <td><?php echo $lang('hajj_satisfaction_rate') ?></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ( $cities as $city ): ?>
                                <tr>
                                    <td><?php echo $city[$lang->current() . '_name']; ?></td>                        
                                    <td><?php echo $city['totalFlights']; ?></td>
                                    <td><?php echo isset($city['passengers']) ? $city['passengers'] : "0"; ?></td>
                                    <td><?php echo isset($city['avgWaitingTime']) ? $city['avgWaitingTime'] : "00:00:00"; ?></td>
                                    <td><?php echo isset($city['inspectionTime']) ? $city['inspectionTime'] : "00:00:00"; ?></td>
                                    <td><?php echo isset($city['luggageArrive']) ? $city['luggageArrive'] : "00:00:00"; ?></td>
                                    <td><?php echo isset($city['busRide']) ? $city['busRide'] : "00:00:00"; ?></td>
                                    <td><?php echo isset($city['pilgrims']) ? $city['pilgrims'] : "00:00:00"; ?></td>
                                    <td><?php echo isset($city['avg_core']) ? $city['avg_core'] . '%' : "0%"; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
            </div>
            </div>
        </div>
    </div>