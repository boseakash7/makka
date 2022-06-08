<?php

namespace Application\Models;

use System\Core\Model;

class Flights extends Model
{
    const STATUS_NOT_OPENED = 'not_opened';
    const STATUS_OPENED = 'opened';
    const STATUS_CHECK_IN = 'check_in';
    const STATUS_CHECK_OUT = 'check_out';
    const STATUS_CLOSED = 'closed';
    const STATUS_ON_AIR = 'on_air';
    const STATUS_ARRIVED = 'arrived';
    const STATUS_COMPLETE = 'complete';
    const STATUS_INVALID = 'invalid';

    private $_table = 'flights';

    public function create( $data )
    {
        return $this->_db->insert($this->_table, $data);
    }

    public function update( $id, $data )
    {
        return $this->_db->update($this->_table, $id, $data);
    }

    public function all()
    {
        $SQL = "SELECT * FROM `{$this->_table}` ";
        return $this->_db->query($SQL)->getAll();
    }

    public function getById( $id )
    {
        $SQL = "SELECT * FROM `{$this->_table}` WHERE `id` = ?";
        return $this->_db->query($SQL, [$id])->get();
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
            if ( !is_array($value) ) {
                $where[] = " `{$key}` = ? ";
                $dbValues[] = $value;
                continue;
            }

            $placeholders = array_fill(0, count($value), '?');            
            $placeholders = implode(", ", $placeholders);
            $values = array_values($value);

            $where[] = " `{$key}` IN (" . $placeholders . ") ";

            $dbValues = array_merge($dbValues, $values);
        }

        $SQL = "SELECT * FROM
                `{$this->_table}`
                WHERE " . implode(" AND ", $where);

        $result = $this->_db->query($SQL, $dbValues);
        return $closure($result);
    }
}