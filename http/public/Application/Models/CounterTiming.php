<?php

namespace Application\Models;

use System\Core\Model;

class CounterTiming extends Model
{
    private $_table = 'counter_timing';

    const TYPE_OPEN = 'open';
    const TYPE_CLOSE = 'close';

    public function create( $data ) {
        return $this->_db->insert($this->_table, $data);
    }
}