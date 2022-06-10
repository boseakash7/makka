<?php

namespace Application\Models;

use System\Core\Model;

class DepartureForm extends Model
{

    private $_table = 'departure_form';

    public function create( $data )
    {
        return $this->_db->insert($this->_table, $data, true);
    }

    public function update( $id, $data )
    {
        return $this->_db->update($this->_table, $id, $data);
    }

    public function getByFlightId( $id )
    {
        $SQL = "SELECT * FROM `{$this->_table}` WHERE `flight_id` = ?";
        return $this->_db->query($SQL, [$id])->get();
    }

    public function getByFlightIdALL( $id )
    {
        $SQL = "SELECT * FROM `{$this->_table}` WHERE `flight_id` = ?";
        return $this->_db->query($SQL, [$id])->getAll();
    }
}