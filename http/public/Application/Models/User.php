<?php

namespace Application\Models;

use System\Models\AbstractAuth;

class User extends AbstractAuth
{
    const TYPE_ADM = 'admin';
    const TYPE_SUP = 'supervisor';
    const TYPE_EMP = 'employee';

    protected $_table = 'users';

    protected function usernameColumn()
    {
        return 'email';
    }

    protected function passwordColumn()
    {
        return 'password';
    }

    protected function uidColumn()
    {
        return 'id';
    }

    protected function verifyPassword($password, $encPassword)
    {
        return password_verify($password, $encPassword);
    }

    public function create( $data )
    {
        return $this->_db->insert($this->_table, $data);
    }

    public function update( $id, $data )
    {
        return $this->_db->update($this->_table, $id, $data);
    }

    public function isAdmin()
    {
        $user = $this->getInfo();
        return $user['type'] == self::TYPE_ADM;
    }

    public function isSup()
    {
        $user = $this->getInfo();
        return $user['type'] == self::TYPE_SUP;
    }

    public function isEmp()
    {
        $user = $this->getInfo();
        return $user['type'] == self::TYPE_EMP;
    }
}