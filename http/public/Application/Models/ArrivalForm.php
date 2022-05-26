<?php

namespace Application\Models;

use System\Core\Model;

class ArrivalForm extends Model
{

    private $_table = 'arrival_form';

    public function create( $data )
    {
        return $this->_db->insert($this->_table, $data);
    }
}