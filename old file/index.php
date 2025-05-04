<?php

$books = [
  [
    "name" => "book 1",
    "author" => "Jhon Doe",
    "releaseYear" => 2001,
    "purchaseUrl" => "https://google.com",
  ],

  [
    "name" => "book 2",
    "author" => "Micle J.",
    "releaseYear" => 1990,
    "purchaseUrl" => "https://facebook.com",
  ],
  [
    "name" => "book 3",
    "author" => "Jhon Doe",
    "releaseYear" => 2005,
    "purchaseUrl" => "https://google.com",
  ],

];

$filter = function ($items, $fn) {
  $filteredItems = [];

  foreach ($items as $item) {
    if ($fn($item)) {
      $filteredItems[] = $item;
    }
  }

  return $filteredItems;
};

$filterBooks = array_filter($books, function ($book) {
  return $book['releaseYear'] < 2000;
});


require "index.view.php";
