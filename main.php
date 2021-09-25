<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="" />
  <link rel="stylesheet" href="dist/style.css" />
</head>
<body>
  <div class="all-wrapper">
    <main class="main">
      <div class="header-wrapper wrapper">
        <header class="header">
          <span class="header__bscs">BSCS</span>
          <span class="header__forum">forum</span>
        </header>
      </div>
      <div class="form-wrapper wrapper">
        <form class="form" action="dist/php/insert.php" method="POST">
          <textarea class="form__comment" name="comment" placeholder="Join the discussion..."></textarea>
          <input type="text" class="form__username" name="username" placeholder="Username..." autocomplete="off" required/>
          <button type="submit" name="submit" class="form__post-button">Post</button>
        </form>
      </div>
    </main>
    <div class="comment-section-wrapper wrapper">
      <section class="comment-section">
        <?php
          include "dist/php/show_data.php" ;
        ?>
      </section>
    </div>
  </div>

</body>
</html>
