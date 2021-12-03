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
    
    /**
     * Returns an array of Post Objects
     * @param int $authorId
     * @return array
     */
    public function getPostsByAuthorId(int $authorId): array
    {
        $query = $this->db->prepare('SELECT * FROM posts WHERE authorId = :authorId');
        $query->bindValue(':authorId', $authorId, PDO::PARAM_INT);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Entity\Post');
        return $query->fetchAll();
    }
    
    /**
     * @param int|null $number
     * @return array
     */
    public function getPosts(int $number = null, bool $array = false): array
    {
        if ($number) {
            $query = $this->db->prepare('SELECT * FROM posts ORDER BY id DESC LIMIT :limit');
            $query->bindValue(':limit', $number, \PDO::PARAM_INT);
            $query->execute();
        } else {
            $query = $this->db->query('SELECT * FROM posts ORDER BY id DESC');
        }

        if ($array) {
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        }

        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Entity\Post');

        return $query->fetchAll();
    }
}