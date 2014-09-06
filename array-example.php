<!doctype html>
<html>
<head>
  <title>PHP SimpleQuery Array Example</title>
</head>
<body>
<?php

/** PHP SimpleQuery Array Example */
include('php-simplequery.php');

// data
$items = array(
  array('id' => 0, 'fname' => 'John',    'lname' => 'Doe', 'married' => true),
  array('id' => 1, 'fname' => 'Jane',    'lname' => 'Doe', 'married' => true),
  array('id' => 2, 'fname' => 'Karina',  'lname' => 'Jones', 'children' => 0.5),
  array('id' => 3, 'fname' => 'Michael', 'lname' => 'Nixon', 'married' => true),
  array('id' => 4, 'fname' => 'Jason',   'lname' => 'Freidback', 'children' => -4),
  array('id' => 5, 'fname' => 'Tracey',   'lname' => 'DuMonde', 'children' => 3),
  array('id' => 6, 'fname' => 'Daniel',   'lname' => 'Baxtor', 'race' => '#NA'),
  array('id' => 7, 'fname' => 'Delina',   'lname' => 'Milford', 'postcode' => '356787'),
  array('id' => 8, 'fname' => 'Samuel',   'lname' => 'Freeman', 'race' => '#NA'),
);

// set up query
// (in this example, we have multiple queries to display)
$queries = array();
$queries[] = array(
  'lname' => array(
    '$eq'  => 'Doe',
    '$has' => array('D', 'o', 'e'),
  ),
);

$queries[] = array(
  'postcode' => array(
    '$set'  => true,
  ),
);

$queries[] = array(
  'id' => array(
    '$gt='  => 3,
    '$lt'   => 6
  ),
);

$queries[] = array(
  'lname' => array(
    '$cs'  => false,
    '$has'   => 'fre',
  ),
);

$sort = array(
  'lname' => 'desc',
);

$limit = 5;

// output the query (or queries)
$sq = new SimpleQuery($items);

foreach ($queries as $query) {
  var_dump($sq->query($query, $sort, $limit));

  echo '<br><br>';
}

?>
</body>
</html>
