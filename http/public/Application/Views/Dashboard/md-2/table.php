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

$SUBSQL2 = " SELECT `id` FROM `flights` WHERE `dairport` IN (
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
$SQL1 = "SELECT CONCAT( COUNT(*) - SUM(`flight_delay`), '/', COUNT(*)) AS `count` FROM `arrival_form` WHERE `flight_id` IN ( $SUBSQL2 )";
$SQL2 = "SELECT CONCAT(ROUND(AVG(`unmarked_buses`) / COUNT(*) * 100), '%') AS `count` FROM `arrival_form` WHERE `flight_id` IN ( $SUBSQL2)";
$SQL3 = "SELECT CONCAT(SUM(`accidents`), '/', COUNT(*)) AS `count` FROM `arrival_form` WHERE `flight_id` IN ( $SUBSQL2 )";
$SQL4 = "SELECT SUM(`buses_ready_to_pilgrims`) AS `count` FROM `arrival_form` WHERE `flight_id` IN ( $SUBSQL2 )";
$SQL5 = "SELECT SUM(`buses_with_mecca_logo`) AS `count` FROM `arrival_form` WHERE `flight_id` IN ( $SUBSQL2 )";
$SQL6 = "SELECT SUM(`sick_cases`) AS `count` FROM `arrival_form` WHERE `flight_id` IN ( $SUBSQL2 )";

$CITYSQL = "SELECT
            `id` AS `i`,
            `en_name`,
            `ar_name`,
        ($SQL1) AS `flight_delay`,
        ($SQL2) AS `unmarked_buses`,
        ($SQL3) AS `accidents`,
        ($SQL4) AS `buses_ready_to_pilgrims`,
        ($SQL5) AS `buses_with_mecca_logo`,
        ($SQL6) AS `sick_cases`
        FROM
        `cities`
        WHERE `type` = 'destination'
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
                                <th><?php echo $lang('flight_delay') ?></th>
                                <th><?php echo $lang('number_of_buses_operated_to_transport_pilgrims') ?></th>
                                <th><?php echo $lang('number_of_buses_operating_with_mecca_logo') ?></th>
                                <th><?php echo $lang('are_there_unmarked_buses') ?></th>
                                <th><?php echo $lang('are_there_any_accidents') ?></th>
                                <th><?php echo $lang('number_of_cases') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ( $cities as $city ): ?>
                                <tr>
                                    <td><?php echo $city[$lang->current() . '_name'] ;?></td>
                                    <td><?php echo isset($city['flight_delay']) ? $city['flight_delay'] : '0/0' ?></td>
                                    <td><?php echo isset($city['unmarked_buses']) ? $city['unmarked_buses'] : 0 . '%' ?></td>
                                    <td><?php echo isset($city['accidents']) ? $city['accidents'] : '0/0' ?></td>
                                    <td><?php echo isset($city['buses_ready_to_pilgrims']) ? $city['buses_ready_to_pilgrims'] : 0 ?></td>
                                    <td><?php echo isset($city['buses_with_mecca_logo']) ? $city['buses_with_mecca_logo'] : 0 ?></td>
                                    <td><?php echo isset($city['sick_cases']) ? $city['sick_cases'] : 0 ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
            </div>
            </div>
        </div>
    </div>