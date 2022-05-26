<?php

namespace Application\Models;

use System\Core\Model;

class DepartureForm extends Model
{

    private $_table = 'departure_form';

    public function create( $data )
    {
        return $this->_db->insert($this->_table, $data);
    }
}