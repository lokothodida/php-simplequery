<?php

/**
 * Title:         PHP SimpleQuery
 * Version:       0.1
 * Description:   Perform queries on PHP arrays
 * Author:        Lawrence Okoth-Odida
 * Documentation: https://github.com/lokothodida/wiki/
 */
class SimpleQuery {
  /** properties */
  protected $items;

  /** public methods */
  // Constructor
  public function __construct($items) {
    $this->items = $items;
  }

  // Run the query
  public function query($query, $sort = array(), $limit = 0) {
    $items = $this->items;

    // ...

    return $items;
  }

  /** protected methods */
  // Get a field from an item
  protected function getField($item, $field) {
    return $item[$field];
  }

  /** private methods */
}

?>
