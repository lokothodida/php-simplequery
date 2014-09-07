# PHP SimpleQuery
Perform queries on PHP arrays

## Features
* Perform queries on:
  * Associative arrays
  * Custom objects
* Sort by multiple criteria

```php
// instantiate SimpleQuery using your $items array
$sq = new SimpleQuery($items = array(/* your collection of data */));

// Set up the $query parameter, dictating the filtering
$query = array(
  'gender'     => 'm',                                     // querying for men...
  'age'        => array( '$gt=' => 18, '$lt' => 25 ),      // ...aged between 18 and 25...
  'blood-type' => array( '$in' => array('A', 'B', 'AB') ), // ...with blood type A, B or AB
);

// Sorting
$sort = array(
  'age' => 'desc',    // youngest to oldest...
  'surname' => 'asc', // ...in alphabetical order of surname
);

// Run the query method to get your results
$results = $sq->query($query, $sort);

// Do with your result what you want
foreach ($results as $result) {
  // ...
}
```

## Getting started
Check out the [wiki](//github.com/lokothodida/php-simplequery/wiki) for information on starting up *PHP SimpleQuery*.

## API
Full API and examples are available on the [wiki](//github.com/lokothodida/php-simplequery/wiki).

## License
*PHP SimpleQuery* is licensed under [MIT](http://www.opensource.org/licenses/MIT).

## Copright
All rights reserved.
