<?php

namespace Application\Models;

use System\Core\Model;

class ArrivalAssesment extends Model
{

    private $_table = 'arrival_assesment';

    public function create( $data )
    {
        return $this->_db->insert($this->_table, $data);
    }

    public function getByFlightId( $id )
    {
        $SQL = "SELECT * FROM `{$this->_table}` WHERE `flight_id` = ?";
        return $this->_db->query($SQL, [$id])->get();
    }
    
    public function getByFlightIdAll( $id )
    {
        $SQL = "SELECT * FROM `{$this->_table}` WHERE `flight_id` = ?";
        return $this->_db->query($SQL, [$id])->getAll();
    }
}