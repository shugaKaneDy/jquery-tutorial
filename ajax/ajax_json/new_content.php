<?php

$content = [
  'short' => 'New content',
  'regular' => 'This is a new content which has been loaded by AJAX',
  'long' => 'This content is the result of making an AJAX query to a PHP page which dynamically loads'
];

echo json_encode($content);