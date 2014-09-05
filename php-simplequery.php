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
  protected $items,
            $query,
            $sort,
            $limit,
            $results = array();

  /** public methods */
  // Constructor
  public function __construct($items) {
    $this->items = $items;
  }

  // Run the query
  public function query($query, $sort = array(), $limit = 0) {
    // reset the results
    $this->results = array();

    // ensure that the default elements of the query are set
    $this->query = $this->setUpQueryDefaults($query);
    $this->sort  = $this->setUpSortingDefaults($sort);
    $this->limit = $limit;

    // filter out items according to the query
    foreach ($this->items as $item) {
      $this->filterItem($item);
    }

    // sort the results
    $this->sortResults();

    // limit the results
    $this->limitResults();

    return $this->results;
  }

  /** protected methods */
  // Get a field from an item
  protected function getField($item, $field) {
    return $item[$field];
  }

  /** private methods */
  // Set up defaults for query
  private function setUpQueryDefaults($query) {
    foreach ($query as $field => $settings) {
      // format into an array if it isn't one
      if (!is_array($settings)) {
        $query[$field] = array('$eq' => $settings);
      }
    }

    return $query;
  }

  // Set up defaults for sorting
  private function setUpSortingDefaults($sort) {
    // ...
    return $sort;
  }

  // Filter out an item
  private function filterItem($item) {
    $success = true;

    // Check each field
    foreach ($this->query as $field => $settings) {
      $value = $this->getField($item, $field);

      // Validate against each setting
      foreach ($settings as $setting => $properties) {

        $success = $success && $this->validate($value, $setting, $properties);
      }
    }

    if ($success) {
      $this->results[] = $item;
    }
  }

  // Validate
  private function validate($value, $setting, $properties) {
    $success = false;

    switch ($setting) {
      // greater than
      case '$gt':
        $success = $value > $properties;
        break;
      // greater than or equal to
      case '$gt=':
        $success = $value >= $properties;
        break;
      // less than
      case '$lt':
        $success = $value < $properties;
        break;
      // less than or equal to
      case '$lt=':
        $success = $value <= $properties;
        break;
      // strict equality
      case '$eq=':
        $success = $value === $properties;
        break;
      // has
      case '$has':
        // ...
        break;
      // in
      case '$in':
        $success = in_array($value, $properties);
        break;
      // normal equality
      default:
        $success = $value == $properties;
        break;
    }

    return $success;
  }

  // Sort the results
  private function sortResults() {
    // ...
  }

  // Sorting implementation
  private function sortResultsImplementation() {
    // ...
  }

  // Limit the results
  private function limitResults() {
    if ($this->limit) {
      $this->results = array_slice($this->results, 0, $this->limit);
    }
  }
}

?>
