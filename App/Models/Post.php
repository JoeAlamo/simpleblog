<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 20/07/2016
 * Time: 14:16
 */

namespace App\Models;


use Core\DB;

class Post
{
    /**
     * @return array
     */
    public static function getAll()
    {
        $db = DB::getPDO();
        $stmt = $db->query("SELECT * FROM posts ORDER BY date_created");

        return $stmt->fetchAll();
    }

    /**
     * Truncated post body
     * @param int $limit
     * @return array
     */
    public static function getLimitedAndTruncated($limit = 5)
    {
        $db = DB::getPDO();
        $stmt = $db->prepare("
            SELECT id, slug, title, substr(body, 0, 100), date_created FROM posts ORDER BY date_created LIMIT :limit
        ");
        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * @param $slug
     * @return mixed
     */
    public static function getBySlug($slug)
    {
        $db = DB::getPDO();
        $stmt = $db->prepare("
            SELECT * FROM posts WHERE slug = :slug
        ");
        $stmt->execute([':slug' => $slug]);

        return $stmt->fetch();
    }

    /**
     * @param $slug
     * @param $title
     * @param $body
     * @return bool
     */
    public static function add($slug, $title, $body)
    {
        $db = DB::getPDO();
        $stmt = $db->prepare("
            INSERT INTO posts (slug, title, body) VALUES (:slug, :title, :body)
        ");

        return $stmt->execute([
            ':slug' => $slug,
            ':title' => $title,
            ':body' => $body
        ]);
    }

    /**
     * @param $id
     * @param $slug
     * @param $title
     * @param $body
     * @return bool
     */
    public static function updateById($id, $slug, $title, $body)
    {
        $db = DB::getPDO();
        $stmt = $db->prepare("
            UPDATE posts SET slug = :slug, title = :title, body = :body WHERE id = :id
        ");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->bindParam(':slug', $slug);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':body', $body);

        return $stmt->execute();
    }

    /**
     * @param $id
     * @return bool
     */
    public static function deleteById($id)
    {
        $db = DB::getPDO();
        $stmt = $db->prepare("
            DELETE FROM posts WHERE id = :id
        ");
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}