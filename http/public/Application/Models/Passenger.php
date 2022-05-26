<?php

namespace Application\Models;

use System\Core\Model;

class Passenger extends Model
{

    private $_table = 'passengers';

    const STATUS_CHECK_IN = 'check_in';
    const STATUS_CHECK_OUT = 'check_out';

    public function create( $data )
    {
        return $this->_db->insert($this->_table, $data);
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