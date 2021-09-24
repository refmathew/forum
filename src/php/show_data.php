<?php

function time_elapsed_string($datetime, $full = false) {
    date_default_timezone_set('Asia/Manila');
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

require_once 'db.php';
$querySelect = "SELECT * FROM discussion ORDER BY post_id DESC;";
$result = mysqli_query($conn, $querySelect);

if ( $result = $conn->query($querySelect) ){
  while($row = $result->fetch_assoc()){
    $post_id = $row["post_id"];
    $user_name = $row["user_name"];
    $post = $row["post"];

    $date = time_elapsed_string( $row["date"] );

    echo '
              <div class="comment-section__comment">
                <div class="comment-section__comment__info">
                  <div class="comment-section__comment__info__username">'.$user_name.'</div>
                  <div class="comment-section__comment__info__date">
                    <span class="comment-section__comment__info__date__bullet">•</span>
                    '.$date.'
                  </div>
                </div>
                <div class="comment-section__comment__post">'.$post.'</div>
              </div>
      ';
  }
} else {
  echo 'No result found';
}
