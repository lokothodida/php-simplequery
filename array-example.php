<!doctype html>
<html>
<head>
  <title>PHP SimpleQuery Array Example</title>
</head>
<body>
<?php

/** PHP SimpleQuery Array Example */
include('php-simplequery.php');
include('data-example.php');

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
    '!$has'   => 'fre',
  ),
);

$sort = array(
  'lname' => 'desc',
);

$limit = 5;

// output the queries
$sq = new SimpleQuery($items);

foreach ($queries as $query) {
  var_dump($sq->query($query, $sort, $limit));

  echo '<br><br>';
}

?>
</body>
</html>
