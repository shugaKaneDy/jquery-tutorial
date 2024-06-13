<?php
  // You can simulate a slow server with sleep
  // sleep(2);

  function is_ajax_request() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
      $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
  }

  // Debugging: Log incoming POST data
  error_log(print_r($_POST, true));

  $length = isset($_POST['length']) ? trim($_POST['length']) : '';
  $width = isset($_POST['width']) ? trim($_POST['width']) : '';
  $height = isset($_POST['height']) ? trim($_POST['height']) : '';

  // Debugging: Log received values
  error_log("Length: $length, Width: $width, Height: $height");

  $errors = [];
  if($length === '') {
    $errors[] = 'length';
  }
  if($width === '') {
    $errors[] = 'width';
  }
  if($height === '') {
    $errors[] = 'height';
  }

  // Debugging: Log errors if any
  error_log("Errors: " . print_r($errors, true));

  if(!empty($errors)) {
    if(is_ajax_request()) {
      $result_array = ['errors' => $errors];
      echo json_encode($result_array);
    } else {
      ?>
      <p>There were errors on : <?= implode(', ', $errors) ?></p>
      <p><a href="index.php">Back</a></p>
      <?php
    }
    exit;
  }

  $volume = (int)$length * (int)$width * (int)$height;

  if(is_ajax_request()) {
    echo json_encode(['volume' => $volume]);
  } else {
    ?>
    <p>The total volume is: <?= $volume ?></p>
    <p><a href="index.php">Back</a></p>
    <?php
  }
?>
