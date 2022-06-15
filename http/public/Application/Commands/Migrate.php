<?php

namespace Application\Commands;

use Application\Helpers\DateHelper;
use System\Core\CLICommand;
use System\Core\Database;

class Migrate extends CLICommand
{
    public function run( $params = null )
    {
        /**
         * @var Database
         */
        $db = Database::get();
        $result = $db->query("SELECT * FROM `departure_form`")->getAll();

        foreach ( $result as $row )
        {
            $arr = json_decode($row['json'], true);

            
            $arr['average_pilgrim_waiting'] = DateHelper::secToHR($arr['average_pilgrim_waiting'] * 60);            
            $arr['average_pilgrim_service'] = DateHelper::secToHR($arr['average_pilgrim_service'] * 60);            

            $db->update('departure_form', $row['id'], [
                'json' => json_encode($arr)
            ]);
        }
    }
}