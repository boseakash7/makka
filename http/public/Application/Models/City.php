<?php

namespace Application\Models;

use System\Core\Model;

class City extends Model
{

    const TYPE_SOURCE = 'source';
    const TYPE_DESTINATION = 'destination';

    private $_table = 'cities';

    public function all()
    {
        $SQL = "SELECT * FROM `{$this->_table}` ";
        return $this->_db->query($SQL)->getAll();
    }

    public function getByIds( $ids )
    {
        if ( empty($ids) ) return [];

        $ids = (array) $ids;
        $SQL = "SELECT * FROM `{$this->_table}` 
            WHERE `id` IN ";
        
        $placeholder = array_fill(0, count($ids), '?');
        $values = array_values($ids);

        $SQL .= " (" . implode(', ', $placeholder) . ")";

        $result = $this->_db->query($SQL, $values)->getAll();
        
        if ( !$result ) return [];

        $output = [];
        foreach ( $result as $row )
        {
            $output[$row['id']] = $row;
        }

        return $output;
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