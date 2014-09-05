<?php

/** PHP SimpleQuery Array Example */
include('php-simplequery.php');

// data
$items = array(
  // ...
);

// set up query
$query = array(
  // ...
);

$sort = array(
  // ...
);

$limit = 5;

// output the query
$sq = new SimpleQuery($items);

var_dump($sq->query($query, $sort, $limit));

?>
