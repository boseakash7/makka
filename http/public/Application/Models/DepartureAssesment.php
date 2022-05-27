<?php

namespace Application\Models;

use System\Core\Model;

class DepartureAssesment extends Model
{

    private $_table = 'departure_assesment';

    public function create( $data )
    {
        return $this->_db->insert($this->_table, $data);
    }
}