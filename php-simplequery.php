<?php

/**
 * Title:         PHP SimpleQuery
 * Version:       0.1
 * Description:   Perform queries on PHP arrays
 * Author:        Lawrence Okoth-Odida
 * Documentation: https://github.com/lokothodida/wiki/
 */
class SimpleQuery {
  /** constants*/
  const NOEXIST = 'NO_EXIST';

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
    return isset($item[$field]) ? $item[$field] : self::NOEXIST;
  }

  /** private methods */
  // Set up defaults for query
  private function setUpQueryDefaults($query) {
    foreach ($query as $field => $settings) {
      if (!is_array($settings)) {
        // format into an array if it isn't one
        $query[$field] = array('$eq' => $settings);
      } else {
        // if an array is provided ...
        // ...
      }

      // has
      if (isset($query[$field]['$has']) && !is_array($query[$field]['$has'])) {
        $query[$field]['$has'] = array($query[$field]['$has']);
      }

      // case sensitivity
      if (!isset($query[$field]['$cs'])) {
        $query[$field]['$cs'] = true;
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
      $caseSensitive = $settings['$cs'];

      foreach ($settings as $setting => $properties) {
        $success = $success && $this->validate($value, $caseSensitive, $setting, $properties);
      }
    }

    if ($success) {
      $this->results[] = $item;
    }
  }

  // Validate
  private function validate($value, $cs, $setting, $properties) {
    $success = false;

    // Case-sensitive switch
    if (!$cs) {
      if (is_array($value)) {
        $value = array_map($value, 'strtolower');
      } else {
        $value = strtolower($value);
      }
    }

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
        $success = true;

        // Check if each $property occurs in $value (be it an array or a string)
        $isValueAnArray = is_array($value);
        foreach ($properties as $property) {
          $pos     = $isValueAnArray ? in_array($property, $value) : strpos($value, $property);
          $success = $success && $pos !== false;
        }

        break;
      // in
      case '$in':
        $success = in_array($value, $properties);
        break;
      // check if value exists
      case '$set':
        $noExist = $value == self::NOEXIST;
        $success = $properties ? !$noExist : $noExist;
        break;
      // case sensitivity (not an actual operator)
      case '$cs':
        $success = true;
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
    uasort($this->results, array($this, 'sortResultsImplementation'));
  }

  // Sorting implementation
  private function sortResultsImplementation($itemA, $itemB) {
    $score = 0;

    // run through each sorting field, aggregating the score
    foreach ($this->sort as $field => $order) {
      // check field values
      $itemAValue = $this->getField($itemA, $field);
      $itemBValue = $this->getField($itemB, $field);

      if (in_array($order, array('asc,' 'desc'))) {
        // Check regular ascending/descending order
        // If the values are arrays, check the array lengths instead
        $itemAValue = is_array($itemAValue) ? count($itemAValue) : $itemAValue;
        $itemBValue = is_array($itemBValue) ? count($itemBValue) : $itemBValue;

        // compare numbers if the values are numeric; strings otherwise
        $comparison = (is_numeric($itemAValue) && is_numeric($itemBValue)) ? cmp($itemAValue, $itemBValue) : strcmp($itemAValue, $itemBValue);
        $score += ($order == 'asc' ? $comparison : -$comparison);
      } else {
        // custom user callback
        $score += call_user_func_array($order, array($itemAValue, $itemBValue));
      }
    }

    return $score;
  }

  // Limit the results
  private function limitResults() {
    if ($this->limit) {
      $this->results = array_slice($this->results, 0, $this->limit);
    }
  }
}

?>
