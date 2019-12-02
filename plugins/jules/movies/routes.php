<?php

Route::get('/movies', function () {
  $movies = [
    [
      'id' => 1,
      'name' => "Pulp Fiction",
      'director' => "Quentin Tarantino",
      'year' => "1993",
      'ratings' => [],
      'description' =>
      "Excepteur tempor id aliqua ut eu enim quis id dolor sit dolore. Excepteur incididunt eu non esse deserunt. Laborum proident elit proident amet ullamco aute. Sunt ut elit officia aliquip officia veniam irure enim reprehenderit. Duis aliqua officia in dolore ullamco enim aute mollit est sunt cupidatat sit deserunt. Irure ea minim ipsum ut excepteur labore sunt id exercitation officia anim nisi deserunt reprehenderit."
    ],
  ];

  return  $movies;
});
