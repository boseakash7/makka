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

$SUBSQL2 = " SELECT `id` FROM `flights` WHERE `sairport` IN (
    SELECT `id` FROM `airports` WHERE `city` = `cities`.`id`
) AND `status` <> '" . Flights::STATUS_INVALID . "'";

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
$SQL1 = "SELECT SUM(`working_counts`) FROM `departure_form` WHERE `flight_id` IN ( $SUBSQL2 )";
$SQL2 = "SELECT SUM(`non_working_counts`) FROM `departure_form` WHERE `flight_id` IN ( $SUBSQL2)";
$SQL3 = "SELECT SUM(`number_of_men`) FROM `departure_form` WHERE `flight_id` IN ( $SUBSQL2 )";
$SQL4 = "SELECT SUM(`number_of_women`) FROM `departure_form` WHERE `flight_id` IN ( $SUBSQL2 )";
$SQL5 = "SELECT SUM(`number_of_seats`) FROM `departure_form` WHERE `flight_id` IN ( $SUBSQL2 )";
$SQL6 = "SELECT SUM(`number_of_cases`) FROM `departure_form` WHERE `flight_id` IN ( $SUBSQL2 )";
$SQL7 = "SELECT SUM(`number_of_bags`) FROM `departure_form` WHERE `flight_id` IN ( $SUBSQL2 )";
$SQL8 = "SELECT SUM(`number_of_fingerprint`) FROM `departure_form` WHERE `flight_id` IN ( $SUBSQL2 )";
$SQL9 = "SELECT ROUND(AVG(`communication_speed`)) FROM `departure_form` WHERE `flight_id` IN ( $SUBSQL2 )";
$SQL10 = "SELECT CONCAT(ROUND(AVG(`connection_status`) / 2 * 100), '%') FROM `departure_form` WHERE `flight_id` IN ( $SUBSQL2 )";
$SQL11 = "SELECT CONCAT(ROUND(AVG(`fingerprint_status`) / 2 * 100), '%') FROM `departure_form` WHERE `flight_id` IN ( $SUBSQL2 )";
$SQL12 = "SELECT FLOOR(AVG(`check_out_time` - `check_in_time`)) as `count` FROM `passengers` WHERE `flight` IN ( $SUBSQL2 ) AND `check_out_time` - `check_in_time` >= 0";
$SQL13 = "SELECT FLOOR(AVG(`average_pilgrim_service`)) AS `count` FROM `departure_form` WHERE `flight_id` IN ( $SUBSQL2 )";

$CITYSQL = "SELECT
            `id` AS `i`,
            `en_name`,
            `ar_name`,
        ($SQL1) AS `working_counts`,
        ($SQL2) AS `non_working_counts`,
        ($SQL3) AS `number_of_men`,
        ($SQL4) AS `number_of_women`,
        ($SQL5) AS `number_of_seats`,
        ($SQL6) AS `number_of_cases`,
        ($SQL7) AS `number_of_bags`,
        ($SQL8) AS `number_of_fingerprint`,
        ($SQL9) AS `communication_speed`,
        ($SQL10) AS `connection_status`,
        ($SQL11) AS `fingerprint_status`,
        ($SQL12) AS `average_waiting_hajj`,
        ($SQL13) AS `average_pilgrim_service`
        FROM
        `cities`
        WHERE `type` = 'source'
";

if ( !empty($cityId) ) {
    $CITYSQL .= " AND `id` = :c";
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
                                <th><?php echo $lang('city') ?></th>
                                <th><?php echo $lang('number_working_counters') ?></th>
                                <th><?php echo $lang('number_non_operating_counters') ?></th>
                                <th><?php echo $lang('average_waiting_hajj') ?></th>
                                <th><?php echo $lang('average_hajj_service') ?></th>
                                <th><?php echo $lang('number_of_males') ?></th>
                                <th><?php echo $lang('number_of_women') ?></th>
                                <th><?php echo $lang('number_of_seats') ?></th>
                                <th><?php echo $lang('number_of_sick') ?></th>
                                <th><?php echo $lang('number_of_blindfolded') ?></th>
                                <th><?php echo $lang('number_of_bag_used') ?></th>
                                <th><?php echo $lang('fingerprint_status') ?></th>
                                <th><?php echo $lang('connection_status') ?></th>
                                <th><?php echo $lang('connection_speed') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ( $cities as $city ): ?>
                                <tr>
                                    <td><?php echo $city[$lang->current() . '_name'] ;?></td>
                                    <td><?php echo isset($city['working_counts']) ? $city['working_counts'] : 0 ?></td>
                                    <td><?php echo isset($city['non_working_counts']) ? $city['non_working_counts'] : 0 ?></td>
                                    <td><?php echo isset($city['average_waiting_hajj']) ? DateHelper::secToHR($city['average_waiting_hajj'] -  $city['average_pilgrim_service'])  : '00:00:00' ?></td>
                                    <td><?php echo isset($city['average_pilgrim_service']) ? DateHelper::secToHR($city['average_pilgrim_service']) : '00:00:00' ?></td>
                                    <td><?php echo isset($city['number_of_men']) ? $city['number_of_men'] : 0 ?></td>
                                    <td><?php echo isset($city['number_of_women']) ? $city['number_of_women'] : 0 ?></td>
                                    <td><?php echo isset($city['number_of_seats']) ? $city['number_of_seats'] : 0 ?></td>
                                    <td><?php echo isset($city['number_of_cases']) ? $city['number_of_cases'] : 0 ?></td>
                                    <td><?php echo isset($city['number_of_bags']) ? $city['number_of_bags'] : 0 ?></td>
                                    <td><?php echo isset($city['number_of_fingerprint']) ? $city['number_of_fingerprint'] : 0 ?></td>
                                    <td><?php echo isset($city['fingerprint_status']) ? $city['fingerprint_status'] : 0 ?></td>
                                    <td><?php echo isset($city['connection_status']) ? $city['connection_status'] : 0 ?></td>
                                    <td><?php echo isset($city['communication_speed']) ? $city['communication_speed'] : 0 ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
            </div>
            </div>
        </div>
    </div>