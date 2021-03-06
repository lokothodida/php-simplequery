# PHP SimpleQuery
Perform queries on PHP arrays.

## Features
* Perform queries on:
  * Associative arrays
  * Custom objects
* Sort by multiple criteria

```php
// instantiate SimpleQuery
$sq = new SimpleQuery($items = array( /* your collection of data */ ));

// Set up the $query parameter, dictating the filtering
$query = array(
  'gender'     => 'm',                                // querying for men
  'age'        => array( '$gt=' => 18, '$lt' => 25 ), // aged between 18 and 25
  'blood-type' => array( '$in' => array('A', 'B') ),  // with blood type A or B
);

// Sorting (youngest to oldest, in alphabetical order of surname)
$sort = array( 'age' => 'desc', 'surname' => 'asc' );

// Run the query method to get your results
$results = $sq->query($query, $sort);

foreach ($results as $result) { /* do as you want with each result */ }
```

## Getting started
Check out the [wiki](//github.com/lokothodida/php-simplequery/wiki/) for information on starting up *PHP SimpleQuery*.

## API
Full API and examples are available on the [wiki](//github.com/lokothodida/php-simplequery/wiki/API).

## License
*PHP SimpleQuery* is licensed under [MIT](http://www.opensource.org/licenses/MIT).

## Copright
&copy; Lawrence Okoth-Odida. All rights reserved. Inspired by [MongoDB](http://www.mongodb.org/).
