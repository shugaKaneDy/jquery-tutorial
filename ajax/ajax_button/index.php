<?php
  session_start();
  // $_SESSION['favorites'] = [];
  if (!isset($_SESSION["favorites"])) {
    $_SESSION['favorites'] = [];
  }

  function is_favorite($id) {
    return in_array($id, $_SESSION['favorites']);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <style>

    .heart-icon {
      display: block;
    }
    .heart-icon-fill {
      display: none;
    }
    .favorite .heart-icon {
      display: none;
    }
    .favorite .heart-icon-fill {
      display: block;
    }

    .favorite-button {
      display: inline;
    }
    .favorite .favorite-button {
      display: none;
    }

    .unfavorite-button {
      display: none !important;
    }
    .favorite .unfavorite-button {
      display: inline !important;
    }
  </style>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
  <?php /* join(', ', $_SESSION['favorites']); */ ?>
  <div id="blog-posts" class="container mx-auto">
    <div id="blog-post-101" class="container border border rounded my-2 <?= (is_favorite(101)) ? "favorite" : ""; ?>">
      <i class="heart-icon bi bi-heart float-end"></i>
      <i class="heart-icon-fill bi bi-heart-fill float-end"></i>
      <h3>Blog Post 101</h3>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, harum. Temporibus laboriosam, nostrum rerum praesentium dolores aspernatur aut quibusdam neque libero earum ipsam perferendis facilis cupiditate quo fuga placeat nobis.</p>
      <button class="btn btn-success favorite-button mb-2">Favorite</button>
      <button class="btn btn-light unfavorite-button mb-2">Unfavorite</button>
    </div>
    <div id="blog-post-102" class="container border border rounded my-2 <?= (is_favorite(102)) ? "favorite" : ""; ?>">
      <i class="heart-icon bi bi-heart float-end"></i>
      <i class="heart-icon-fill bi bi-heart-fill float-end"></i>
      <h3>Blog Post 102</h3>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, harum. Temporibus laboriosam, nostrum rerum praesentium dolores aspernatur aut quibusdam neque libero earum ipsam perferendis facilis cupiditate quo fuga placeat nobis.</p>
      <button class="btn btn-success favorite-button mb-2">Favorite</button>
      <button class="btn btn-light unfavorite-button mb-2">Unfavorite</button>
    </div>
    <div id="blog-post-103" class="container border border rounded my-2 <?= (is_favorite(103)) ? "favorite" : ""; ?>">
      <i class="heart-icon bi bi-heart float-end"></i>
      <i class="heart-icon-fill bi bi-heart-fill float-end"></i>
      <h3>Blog Post 103</h3>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, harum. Temporibus laboriosam, nostrum rerum praesentium dolores aspernatur aut quibusdam neque libero earum ipsam perferendis facilis cupiditate quo fuga placeat nobis.</p>
      <button class="btn btn-success favorite-button mb-2">Favorite</button>
      <button class="btn btn-light unfavorite-button mb-2">Unfavorite</button>
    </div>
  </div>
  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  function favorite() {
    var parent = $(this).parent();
    $.ajax({
      url: 'favorite.php',
      type: 'POST',
      data: { id: parent.attr('id') },
      success: function(response) {
        console.log('Result: ' + response);
        if(response == 'true') {
          parent.addClass('favorite');
        }
      },
      error: function(xhr, status, error) {
        console.error('Error: ' + error);
      }
    });
  }

  $('.favorite-button').on('click', favorite);

  function unfavorite() {
    var parent = $(this).parent();
    $.ajax({
      url: 'unfavorite.php',
      type: 'POST',
      data: { id: parent.attr('id') },
      success: function(response) {
        console.log('Result: ' + response);
        if(response == 'true') {
          parent.removeClass('favorite');
        }
      },
      error: function(xhr, status, error) {
        console.error('Error: ' + error);
      }
    });
  }

  $('.unfavorite-button').on('click', unfavorite);
</script>
</body>
</html>
