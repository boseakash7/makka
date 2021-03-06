<?php

namespace Application\Models;

use System\Core\Model;

class Passenger extends Model
{

    private $_table = 'passengers';

    public function create( $data )
    {
        return $this->_db->insert($this->_table, $data, true);
    }

    public function update( $id, $data )
    {
        return $this->_db->update($this->_table, $id, $data);
    }

    public function firstCheckInTime( $flightId )
    {
        $SQL = "SELECT MIN(`check_in_time`) AS `time` FROM `{$this->_table}` WHERE `flight` = ?";

        $result = $this->_db->query($SQL, [ $flightId ])->get();

        return $result ? $result['time'] : 0;
    }

    public function lastCheckOutTime( $flightId )
    {
        $SQL = "SELECT MAX(`check_out_time`) AS `time` FROM `{$this->_table}` WHERE `flight` = ?";

        $result = $this->_db->query($SQL, [ $flightId ])->get();

        return $result ? $result['time'] : 0;
    }

    public function find( array $with )
    {
        return $this->_prepareFind($with, function($result) {
            return $result->get();
        });
    }

    public function findAll( array $with )
    {
        return $this->_prepareFind($with, function($result) {
            return $result->getAll();
        });
    }

    public function _prepareFind( array $with, $closure )
    {
        $dbValues = [];
        $where = [];
        foreach ( $with as $key => $value )
        {
            $where[] = " `{$key}` = ? ";
            $dbValues[] = $value;
        }

        $SQL = "SELECT * FROM
                `{$this->_table}`
                WHERE " . implode(" AND ", $where);

        $result = $this->_db->query($SQL, $dbValues);
        return $closure($result);
    }
}