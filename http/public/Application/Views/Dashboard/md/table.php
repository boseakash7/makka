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

$SUBSQL3 = " SELECT `id` FROM `flights` WHERE `dairport` IN (
    SELECT `id` FROM `airports` WHERE `city` = :c
)";

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
$SUBSQL3 .= !empty($WHERE2) ?  " AND " . implode(" AND ", $WHERE2) : "";


$CITYSQL = "SELECT
`id` AS `i`,
`en_name`,
`ar_name`,
(
    SELECT
        SEC_TO_TIME(FLOOR(AVG(`check_out_time` - `check_in_time`))) as `count`
    FROM
        `passengers`
    WHERE
        `flight` IN (
            $SUBSQL2
        )
) AS `serviceTime`,
(
    SELECT
        SUM(`passengers`) as `count`
    FROM
        `departure_form`
    WHERE
        `flight_id` IN (
            $SUBSQL2
        )
) AS `passengers`,
(
    SELECT
        COUNT(*) as `count`
    FROM
        `flights`
    WHERE
        `id` IN (
            $SUBSQL2
        )
) AS `totalFlights`,
(
    SELECT
        AVG(`avg_score`) as `count`
    FROM
        `departure_assesment`
    WHERE
        `flight_id` IN (
            $SUBSQL2
        )
) AS `avg_score`
FROM
`cities`";

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
                <div class="card-body">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <td><?php echo $lang('city') ?></td>
                                <td><?php echo $lang('number_of_flights') ?></td>
                                <td><?php echo $lang('passengers') ?></td>
                                <td><?php echo $lang('avg_service_time') ?></td>
                                <td><?php echo $lang('counter_working_time') ?></td>
                                <td><?php echo $lang('hajj_satisfaction_rate') ?></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ( $cities as $city ): ?>
                                <tr>
                                    <td><?php echo $city[$lang->current() . '_name']; ?></td>                        
                                    <td><?php echo $city['totalFlights']; ?></td>                        
                                    <td><?php echo isset($city['passengers']) ? $city['passengers'] : '0'; ?></td>                                                    
                                    <td><?php echo isset($city['serviceTime']) ? $city['serviceTime'] : '00:00:00'; ?></td>
                                    <?php                                        
                                        $SQL = "SELECT
                                                    SEC_TO_TIME(FLOOR(AVG(`x2`.`closed_at` - `x1`.`opened_at`))) as `count`
                                                    FROM (
                                                        SELECT
                                                            `date`, MIN(`time`) as `opened_at`
                                                        FROM `counter_timing`
                                                        WHERE `type` = 'open' AND `flight` IN ( $SUBSQL3 ) GROUP BY `date`
                                                    ) AS `x1`
                                                    INNER JOIN (
                                                        SELECT `date`, MAX(`time`) AS `closed_at`
                                                        FROM `counter_timing`
                                                        WHERE `type` = 'close' AND `flight` IN ( $SUBSQL3 ) GROUP BY `date`
                                                    ) AS `x2`
                                                ON (`x2`.`date` = `x1`.`date`)";        
                                                $dbValues2[":c"] = $city['i'];                                                
                                        $counter = $db->query($SQL, $dbValues2)->get();                                        
                                        $counter = $counter['count'];
                                    ?>
                                    <td><?php echo isset($counter) ? $counter : '00:00:00'; ?></td>
                                    <td><?php echo isset($city['avg_score']) ? round($city['avg_score']) : '0' ; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
            </div>
            </div>
        </div>
    </div>