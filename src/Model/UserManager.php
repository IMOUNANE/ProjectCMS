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
     /**
     * @param string $email
     * @return User|bool
     */
    public function getUserByEmail(string $email = null)
    {
        $query = $this->db->prepare('SELECT * FROM users WHERE email = :email');
        $query->bindValue(':email', $email, \PDO::PARAM_STR);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Entity\User');
        return $query->fetch();
    }
     /**
     * Checks if user exists in DB
     * @param string $email
     * @return bool
     */
    public function userExists(string $email): bool
    {
        return $this->getUserByEmail($email) instanceof User;
    }
    
    /**
     * @param User $newUser
     * @return User
     */
    public function addUser(User $newUser): User
    {
        $insert = $this->db->prepare('INSERT INTO users (firstName, lastName, email, password) VALUES (:firstName, :lastName, :email, :password)');
        $insert->bindValue(':firstName', $newUser->getFirstName(), \PDO::PARAM_STR);
        $insert->bindValue(':lastName', $newUser->getLastName(), \PDO::PARAM_STR);
        $insert->bindValue(':email', $newUser->getEmail(), \PDO::PARAM_STR);
        $insert->bindValue(':password', $newUser->getPassword(), \PDO::PARAM_STR);
        $insert->execute();

        return $this->getUserByEmail($newUser->getEmail());
    }
    /**
     * Checks if a users exists in DB
     * and its password matches the one in DB
     * @param User $user
     * @return bool
     */
    public function userMatches(User $user): bool
    {
        return $this->getUserByEmail($user->getEmail())->getPassword() === $user->getPassword();
    }

        /**
     * @param null $login
     * @param null $password
     * @return User|bool
     */
    public function checkCredentials($login = null, $password = null)
    {
        if ( !is_string($login) || !is_string($password)) {
            return false;
        }

        $user = $this->getUserByEmail($login);

        if ($user !== false && password_verify($password, $user->getPassword())) {
            return $user;
        }
        return false;
    }
}