<?php


namespace Model;


use Entity\Post;

class PostManager extends DbConnexion
{
    /**
     * @param int $id
     * @return Post|bool|array
     */
    public function getPostById(int $id, bool $array = false)
    {
        $query = $this->db->prepare('SELECT * FROM posts WHERE id = :id');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();

        if ($array) {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        $query->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Entity\Post');
        return $query->fetch();
    }
}