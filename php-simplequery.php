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
    // ...
    return $query;
  }

  // Set up defaults for sorting
  private function setUpSortingDefaults($sort) {
    // ...
    return $sort;
  }

  // Filter out an item
  private function filterItem($item) {
    $success = false;

    // Check each field
    foreach ($this->query as $field => $settings) {
      $value = $this->getField($item, $field);

      // Validate against each setting
      // ...
    }

    if ($success) {
      $this->results[] = $item;
    }
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
    $this->results = array_slice($this->results, 0, $this->limit);
  }
}

?>
