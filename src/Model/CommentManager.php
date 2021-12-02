<?php


namespace Model;


use Entity\Comment;

class CommentManager extends DbConnexion
{

    
    /**
     * @param int $authorId
     * @return Comment|array
     */
    public function getCommentsByAuthorId(int $authorId): array
    {
        $query = $this->db->prepare('SELECT * FROM comments WHERE authorId = :authorId');
        $query->bindValue(':authorId', $authorId, PDO::PARAM_INT);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Entity\Comment');

        return $query->fetchAll();
    }
}