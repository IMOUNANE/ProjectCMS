<?php

namespace Model;

use Entity\User;

class UserManager extends DbConnexion
{
/**
     * @param int $id
     * @return User|bool
     */
    public function getUserById(int $id)
    {
        $query = $this->db->prepare('SELECT * FROM users WHERE id = :id');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Entity\User');
        return $query->fetch();
    }
}