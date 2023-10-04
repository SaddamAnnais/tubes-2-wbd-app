<?php

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
            'image_path' => ,
            'duration' =>
        ]
        */

        $query = 'INSERT INTO recipe (title, `desc`, tag, difficulty, video_path, image_path, duration) VALUES (:title, :desc, :tag, :difficulty, :video_path, :image_path, :duration)';

        $this->db->query($query);
        $this->db->bind('title', $data['title']);
        $this->db->bind('desc', $data['desc']);
        $this->db->bind('tag', $data['tag']);
        $this->db->bind('difficulty', $data['difficulty']);
        $this->db->bind('video_path', $data['video_path']);
        $this->db->bind('image_path', $data['image_path']);
        $this->db->bind('duration', $data['duration']);

        $this->db->exec();

        return $this->db->rowCount();
    }

    public function getRecipeById($recipe_id)
    {
        $query = 'SELECT * FROM recipe WHERE recipe_id = :recipe_id';

        $this->db->query($query);
        $this->db->bind('recipe_id', $recipe_id);
        $recipe = $this->db->fetch();

        return $recipe;
    }

    public function getAllRecipe()
    {
        $query = 'SELECT * FROM recipe';

        $this->db->query($query);
        $recipe = $this->db->fetchAll();

        return $recipe;
    }

    public function getPagesCount($search_query) {
        /*
        $search_query = [
            $search => , search by title / created_at, default no search
            $filter_by_tag => , filter by tag value default no filter. possible values: appetizer, main course, dessert, full course
            $filter_by_diff => , filter by difficulty value default no filter. possible values: easy, medium, hard
            $sort_by => , sort by title / created_at, default by created_at descending
            $sort_dir => , possible values: ASC or DESC
            $page => , [1 .. pages_count], default 1
        ]

        default means not isset($data[''])
        kalo getAll berarti pake semua nya default
        */

        $query = 'SELECT COUNT(*) FROM recipe';
        $whered = false;

        if (isset($search_query['search'])) {
            $query .= ' WHERE (title LIKE :search or created_at LIKE :search)';
            $whered = true;
        }

        if (isset($search_query['filter_by_tag'])) {
            if ($whered) {
                $query .= ' AND tag = :filter_by_tag';
            } else {
                $query .= ' WHERE tag = :filter_by_tag';
                $whered = true;
            }
        }

        if (isset($search_query['filter_by_diff'])) {
            if ($whered) {
                $query .= ' AND difficulty = :filter_by_diff';
            } else {
                $query .= ' WHERE difficulty = :filter_by_diff';
                $whered = true;
            }
        }

        if (isset($search_query['sort_by'])) {
            $query .= ' ORDER BY :sort_by';
            if (isset($search_query['sort_dir'])) {
                $query .= ' :sort_dir';
            }
            // else default ASC
        } else {
            $query .= ' ORDER BY created_at';
            if (isset($search_query['sort_dir'])) {
                $query .= ' :sort_dir';
            } else {
                $query .= ' DESC';
            }
        }

        $query .= 'LIMIT :limit OFFSET :offset';

        $this->db->query($query);

        if (isset($search_query['search'])) {
            $this->db->bind('search', $search_query['search']);
        }

        if (isset($search_query['filter_by_tag'])) {
            $this->db->bind('filter_by_tag', $search_query['filter_by_tag']);
        }

        if (isset($search_query['filter_by_diff'])) {
            $this->db->bind('filter_by_diff', $search_query['filter_by_diff']);
        }

        if (isset($search_query['sort_by'])) {
            $this->db->bind('sort_by', $search_query['sort_by']);
            if (isset($search_query['sort_dir'])) {
                $this->db->bind('sort_dir', $search_query['sort_dir']);
            }
            // else default ASC
        } else {
            if (isset($search_query['sort_dir'])) {
                $this->db->bind('sort_dir', $search_query['sort_dir']);
            }
            // else default DESC
        }

        $count = $this->db->fetch();
        $pages_count = ceil($count->count_result / PAGE_ROWS);
        return $pages_count;
    }

    // untuk getAll pake ini juga karena harus ada pagination
    public function getBySearchQuery($search_query)
    {
        /*
        $search_query = [
            $search => , search by title / created_at, default no search
            $filter_by_tag => , filter by tag value default no filter. possible values: appetizer, main course, dessert, full course
            $filter_by_diff => , filter by difficulty value default no filter. possible values: easy, medium, hard
            $sort_by => , sort by title / created_at, default by created_at descending
            $sort_dir => , possible values: ASC or DESC
            $page => , [1 .. pages_count], default 1
        ]

        default means not isset($data[''])
        kalo getAll berarti pake semua nya default
        */

        $query = 'SELECT * FROM recipe';
        $whered = false;

        if (isset($search_query['search'])) {
            $query .= ' WHERE (title LIKE :search or created_at LIKE :search)';
            $whered = true;
        }

        if (isset($search_query['filter_by_tag'])) {
            if ($whered) {
                $query .= ' AND tag = :filter_by_tag';
            } else {
                $query .= ' WHERE tag = :filter_by_tag';
                $whered = true;
            }
        }

        if (isset($search_query['filter_by_diff'])) {
            if ($whered) {
                $query .= ' AND difficulty = :filter_by_diff';
            } else {
                $query .= ' WHERE difficulty = :filter_by_diff';
                $whered = true;
            }
        }

        if (isset($search_query['sort_by'])) {
            $query .= ' ORDER BY :sort_by';
            if (isset($search_query['sort_dir'])) {
                $query .= ' :sort_dir';
            }
            // else default ASC
        } else {
            $query .= ' ORDER BY created_at';
            if (isset($search_query['sort_dir'])) {
                $query .= ' :sort_dir';
            } else {
                $query .= ' DESC';
            }
        }

        $query .= 'LIMIT :limit OFFSET :offset';

        $this->db->query($query);

        if (isset($search_query['search'])) {
            $this->db->bind('search', $search_query['search']);
        }

        if (isset($search_query['filter_by_tag'])) {
            $this->db->bind('filter_by_tag', $search_query['filter_by_tag']);
        }

        if (isset($search_query['filter_by_diff'])) {
            $this->db->bind('filter_by_diff', $search_query['filter_by_diff']);
        }

        if (isset($search_query['sort_by'])) {
            $this->db->bind('sort_by', $search_query['sort_by']);
            if (isset($search_query['sort_dir'])) {
                $this->db->bind('sort_dir', $search_query['sort_dir']);
            }
            // else default ASC
        } else {
            if (isset($search_query['sort_dir'])) {
                $this->db->bind('sort_dir', $search_query['sort_dir']);
            }
            // else default DESC
        }

        $this->db->bind('limit', PAGE_ROWS);

        if (isset($search_query['page'])) {
            $this->db->bind('offset', ($search_query['page'] - 1) * PAGE_ROWS);
        } else {
            $this->db->bind('offset', 0);
        }

        $recipes = $this->db->fetchAll();

        $pages_count = $this->getPagesCount($search_query);
        $ret = ["recipes" => $recipes, "pages" => $pages_count];

        return $ret;
    }

    public function getLatestRecipe()
    {
        $query = 'SELECT * FROM recipe ORDER BY created_at DESC LIMIT 10';

        $this->db->query($query);
        $recipe = $this->db->fetchAll();

        return $recipe;
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
            'image_path' => ,
            'duration' =>
        ]
        */

        $query = 'UPDATE recipe SET title = :title, `desc` = :desc, tag = :tag, difficulty = :difficulty, video_path = :video_path, image_path = :image_path, duration = :duration WHERE recipe_id = :recipe_id';

        $this->db->query($query);
        $this->db->bind('title', $data['title']);
        $this->db->bind('desc', $data['desc']);
        $this->db->bind('tag', $data['tag']);
        $this->db->bind('difficulty', $data['difficulty']);
        $this->db->bind('video_path', $data['video_path']);
        $this->db->bind('image_path', $data['image_path']);
        $this->db->bind('duration', $data['duration']);
        $this->db->bind('recipe_id', $recipe_id);

        $this->db->exec();
    }

    public function deleteRecipe($recipe_id) {
        $query = 'DELETE FROM recipe WHERE recipe_id = :recipe_id';

        $this->db->query($query);
        $this->db->bind('recipe_id', $recipe_id);
        $this->db->exec();
    }

    // WARNING: for seeding purposes only
    public function hardReset()
    {
      $query = 'DELETE FROM recipe';
      $this->db->query($query);
      $this->db->exec();
    }
}
