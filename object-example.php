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

// Class for object
class Item {
  private $item;

  public function __construct($item) {
    $this->item = $item;
  }

  public function get($field) {
    return isset($this->item[$field]) ? $this->item[$field] : null;
  }
}

// Class for query
class ObjectSimpleQuery extends SimpleQuery {
  protected function getField($item, $field) {
    return $item->get($field) !== null ? $item->get($field) : self::NOEXIST;
  }
}

// For this example, convert the array items to Item class
foreach ($items as $i => $item) {
  $items[$i] = new Item($item);
}

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
$sq = new ObjectSimpleQuery($items);

foreach ($queries as $query) {
  var_dump($sq->query($query, $sort, $limit));

  echo '<br><br>';
}

?>
</body>
</html>
