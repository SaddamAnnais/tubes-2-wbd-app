<?php
require(__DIR__.'/../app/models/UserModel.php');
require(__DIR__.'/../app/models/RecipeModel.php');
require(__DIR__.'/../app/models/PlaylistModel.php');
require(__DIR__.'/../app/core/Database.php');
require(__DIR__.'/../app/core/Storage.php');
require(__DIR__.'/../app/config/config.php');
require(__DIR__.'/../app/Exception/DisplayedException.php');

// LOAD CLASSES
$user_model = new UserModel();
$recipe_model = new RecipeModel();
$playlist_model = new PlaylistModel();
$video_storage = new Storage('video');
$image_storage = new Storage('image');

// RESET ALL
$user_model->hardReset();
$recipe_model->hardReset();
$playlist_model->hardReset();
$video_storage->hardReset();
$image_storage->hardReset();

// USER
// admin
$data_admins = [
    [
        'username' => 'admin1',
        'name' => 'admin1',
        'password' => 'password1'
    ],
    [
        'username' => 'admin2',
        'name' => 'admin2',
        'password' => 'password2'
    ],
    [
        'username' => 'admin3',
        'name' => 'admin3',
        'password' => 'password3'
    ]
];

foreach ($data_admins as $admin) {
    try {
        $user_model->registerAdmin($admin);
    } catch (Exception $e) {
        print_r('ERROR: Register admin' . PHP_EOL);
        print_r($admin);
        print_r('' . PHP_EOL);
    }
}

// user
$data_users = [
    [
        'username' => 'user1',
        'name' => 'user1',
        'password' => 'password1'
    ], [
        'username' => 'user2',
        'name' => 'user2',
        'password' => 'password2'
    ], [
        'username' => 'user3',
        'name' => 'user3',
        'password' => 'password3'
    ]
];

foreach ($data_users as $user) {
    try {
        $user_model->register($user);
        $user_ids[] = $user_model->getUserByUsername($user['username'])->user_id;
    } catch (Exception $e) {
        print_r('ERROR: Register user' . PHP_EOL);
        print_r($user);
        print_r(PHP_EOL);
    }
}

$all_user = $user_model->getUsers();
$all_user_ids = [];

foreach ($all_user as $user) {
    $all_user_ids[] = $user->user_id;
}

// RECIPE
// video
$seed_video_titles = [
    'recipe1.mp4',
    'recipe2.mp4',
    'recipe3.mp4',
];

$video_titles = [];
$durations = [];
foreach ($seed_video_titles as $title) {
    try {
        $video_title = $video_storage->copyVideo(__DIR__ . '/video/' . $title);
        $video_titles[] = $video_title;
        $durations[] = $video_storage->getVideoDurationSeconds($video_title);
    } catch (Exception $e) {
        print_r('ERROR: Upload video' . PHP_EOL);
        print_r($title);
        print_r('' . PHP_EOL);
    }
}

// image
$seed_image_titles = [
    'recipe1.jpg',
    'recipe2.jpg',
    'recipe3.jpg',
];

$image_titles = [];
foreach ($seed_image_titles as $title) {
    try {
        $image_title = $image_storage->copyImage(__DIR__ . '/image/' . $title);
        $image_titles[] = $image_title;
    } catch (Exception $e) {
        print_r('ERROR: Upload image' . PHP_EOL);
        print_r($title);
        print_r('' . PHP_EOL);
    }
}

// recipe
$data_recipes = [
    [
        'title' => 'recipe1',
        'desc' => 'desc recipe 1',
        'tag' => 'dessert',
        'difficulty' => 'easy',
        'video_path' => $video_titles[0],
        'image_path' => $image_titles[0],
        'duration' => $durations[0]
    ],
    [
        'title' => 'recipe2',
        'desc' => 'desc recipe 2',
        'tag' => 'main course',
        'difficulty' => 'medium',
        'video_path' => $video_titles[1],
        'image_path' => $image_titles[1],
        'duration' => $durations[1]
    ],
    [
        'title' => 'recipe3',
        'desc' => 'desc recipe 3',
        'tag' => 'appetizer',
        'difficulty' => 'hard',
        'video_path' => $video_titles[2],
        'image_path' => $image_titles[2],
        'duration' => $durations[2]
    ]
];

foreach ($data_recipes as $recipe) {
    try {
        $recipe_model->addRecipe($recipe);
    } catch (Exception $e) {
        print_r('ERROR: Add recipe' . PHP_EOL);
        print_r($recipe);
        print_r('' . PHP_EOL);
    }
}

$all_recipe = $recipe_model->getAllRecipe();
$recipe_ids = [];

foreach ($all_recipe as $recipe) {
    $recipe_ids[] = $recipe->recipe_id;
}

// 10K RECIPES
$tags = ['appetizer', 'main course', 'dessert', 'full course'];
$diffs = ['easy', 'medium', 'hard'];
for ($i = 1; $i <= 10000; $i++) {
    $random_idx = rand(0,2);
    $random_recipe = [
        'title' => 'random recipe ' . $i,
        'desc' => 'random recipe ' . $i,
        'tag' => $tags[rand(0,3)],
        'difficulty' => $diffs[rand(0,2)],
        'video_path' => $video_titles[$random_idx],
        'image_path' => $image_titles[$random_idx],
        'duration' => $durations[$random_idx]
    ];

    try {
        $recipe_model->addRecipe($random_recipe);
    } catch (Exception $e) {
        print_r('ERROR: Add random recipe ' . $i . PHP_EOL);
        print_r($random_recipe);
        print_r('' . PHP_EOL);
    }
}

// PLAYLIST
$data_playlist = [
    [
        'title' => '0 video',
        'content' => []
    ],
    [
        'title' => '1 video',
        'content' => [
            $recipe_ids[0]
        ]
    ],
    [
        'title' => '2 video',
        'content' => [
            $recipe_ids[0],
            $recipe_ids[1]
        ]
    ],
    [
        'title' => '3 video',
        'content' => [
            $recipe_ids[0],
            $recipe_ids[1],
            $recipe_ids[2]
        ]
    ],
];

$data_user_playlist = [
    [
        'user_id' => $all_user_ids[0],
        'playlists' => []
    ],
    [
        'user_id' => $all_user_ids[1],
        'playlists' => [
            $data_playlist[0]
        ]
    ],
    [
        'user_id' => $all_user_ids[2],
        'playlists' => [
            $data_playlist[1],
            $data_playlist[2],
        ]
    ],
    [
        'user_id' => $all_user_ids[3],
        'playlists' => [
            $data_playlist[0],
            $data_playlist[2],
        ]
    ],
    [
        'user_id' => $all_user_ids[4],
        'playlists' => [
            $data_playlist[0],
            $data_playlist[1],
            $data_playlist[2],
            $data_playlist[3],
        ]
    ],
    [
        'user_id' => $all_user_ids[5],
        'playlists' => [
            $data_playlist[0],
            $data_playlist[3],
        ]
    ]
    ];

foreach ($data_user_playlist as $user_playlists) {
    foreach ($user_playlists['playlists'] as $playlist) {
        $playlist_model->createPlaylist(['title' => $playlist['title'], 'user_id' => $user_playlists['user_id']]);
    }
}

foreach ($all_user_ids as $user_id) {
    $curr_playlists = $playlist_model->getPlaylistsByOwner($user_id);
    foreach ($curr_playlists as $playlist) {
        $curr_playlist_id = $playlist->playlist_id;
        $curr_recipes = $data_playlist[intval($playlist->title[0])]['content'];

        foreach ($curr_recipes as $recipe) {
            $playlist_model->addToPlaylist($curr_playlist_id, $recipe);
        }
    }
}
