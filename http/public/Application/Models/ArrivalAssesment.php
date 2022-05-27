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
}