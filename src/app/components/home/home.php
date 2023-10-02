<!DOCTYPE html>

<?php
    require_once __DIR__ . '/../templates/navbar.php';
    require_once __DIR__ . '/../templates/sidebar.php';
    require_once __DIR__ . '/../templates/card.php';


    $dummyData = array(
       #array(link (may also be id), title, duration, image_path, created_at)
       new CardData("linkk!", "mamam", "260", "https://images.unsplash.com/photo-1514986888952-8cd320577b68?auto=format&fit=crop&w=500&q=60", "2023-01-01 00:00:00"),
       new CardData("linkk!", "mamam", "260", "https://images.unsplash.com/photo-1528712306091-ed0763094c98?auto=format&fit=crop&w=500&q=60", "2023-01-01 00:00:00"),
       new CardData("linkk!", "mamam", "260", "https://images.unsplash.com/photo-1547592180-85f173990554?auto=format&fit=crop&w=500&q=60", "2023-01-01 00:00:00"),
       new CardData("linkk!", "mamam", "260", "https://images.unsplash.com/photo-1482049016688-2d3e1b311543?auto=format&fit=crop&w=500&q=60", "2023-01-01 00:00:00"),
       new CardData("linkk!", "mamam", "260", "https://images.unsplash.com/photo-1518779578993-ec3579fee39f?auto=format&fit=crop&w=500&q=60", "2023-01-01 00:00:00"),
       new CardData("linkk!", "mamam", "260", "https://images.unsplash.com/photo-1507638940746-7b17d6b55b8f?auto=format&fit=crop&w=500&q=60", "2023-01-01 00:00:00"),
    )
?>

<head>
    <title>Cooklyst!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" type="text/css" href="/src/public/styles/styles.css">
    <link rel="stylesheet" type="text/css" href="/src/public/styles/templates/navbar.css">
    <link rel="stylesheet" type="text/css" href="/src/public/styles/templates/sidebar.css">

    <link rel="stylesheet" type="text/css" href="/src/public/styles/home/home.css">
</head>

<body>
    <?php navbar() ?>
    <div id="wrapper">
        <!-- sidebar -->
        <?php sidebar() ?>
        
        <div id="card-container">
            <?php
                foreach($dummyData as $cardItem) {
                    recipeCard($cardItem);
                }
            ?>  
        </div>
    </div>
</body>