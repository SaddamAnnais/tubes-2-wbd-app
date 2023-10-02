<?php

require_once '../../config/config.php';
require_once '../core/db.php';

class RecipeModel {
    private $db;

    public function __construct() {
        $this->db = new DB();
    }

    public function addRecipe($data)
    {
        /*
        $data = [
            'title' => ,
            'desc' => ,
            'tag' => ,
            'difficulty' => ,
            'video_path' => ,
            'image_path' =>
        ]
        */

        $query = 'INSERT INTO recipe (title, `desc`, tag, difficulty, video_path, image_path) VALUES (:title, :desc, :tag, :difficulty, :video_path, :image_path)';

        $this->db->query($query);
        $this->db->bind('title', $data['title']);
        $this->db->bind('desc', $data['desc']);
        $this->db->bind('tag', $data['tag']);
        $this->db->bind('difficulty', $data['difficulty']);
        $this->db->bind('video_path', $data['video_path']);
        $this->db->bind('image_path', $data['image_path']);

        $this->db->exec();

        return $this->db->rowCount();
    }

    public function getRecipeById($recipe_id)
    {
        $query = 'SELECT * FROM recipe WHERE recipe_id = :recipe_id';

        $this->db->query($query);
        $this->db->bind('recipe_id', $recipe_id);
        $song = $this->db->fetch();

        return $song;
    }

    public function getAllRecipe()
    {
        $query = 'SELECT * FROM recipe';

        $this->db->query($query);
        $recipe = $this->db->fetchAll();

        return $recipe;
    }

    public function getLatestRecipe()
    {
        $query = 'SELECT * FROM recipe ORDER BY created_at DESC LIMIT 10';

        $this->db->query($query);
        $recipe = $this->db->fetchAll();

        return $recipe;
    }

    public function getTags() {
        $query = 'SELECT DISTINCT tag FROM recipe';

        $this->db->query($query);
        $tags = $this->db->fetchAll();

        return $tags;
    }

    public function getDifficulties() {
        $query = 'SELECT DISTINCT difficulty FROM recipe';

        $this->db->query($query);
        $difficulties = $this->db->fetchAll();

        return $difficulties;
    }

    public function updateRecipeById($recipe_id, $data)
    {
        /*
        $data = [
            'title' => ,
            'desc' => ,
            'tag' => ,
            'difficulty' => ,
            'video_path' => ,
            'image_path' =>
        ]
        */

        $query = 'UPDATE recipe SET title = :title, `desc` = :desc, tag = :tag, difficulty = :difficulty, video_path = :video_path, image_path = :image_path WHERE recipe_id = :recipe_id';

        $this->db->query($query);
        $this->db->bind('title', $data['title']);
        $this->db->bind('desc', $data['desc']);
        $this->db->bind('tag', $data['tag']);
        $this->db->bind('difficulty', $data['difficulty']);
        $this->db->bind('video_path', $data['video_path']);
        $this->db->bind('image_path', $data['image_path']);
        $this->db->bind('recipe_id', $recipe_id);

        $this->db->exec();
    }

    public function deleteRecipe($recipe_id) {
        $query = 'DELETE FROM recipe WHERE recipe_id = :recipe_id';

        $this->db->query($query);
        $this->db->bind('recipe_id', $recipe_id);
        $this->db->exec();
    }
}
