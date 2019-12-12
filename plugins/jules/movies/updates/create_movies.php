<?php

namespace Jules\Movies\Updates;

use Seeder;
use Jules\Movies\Models\Movie;

class SeedUsersTable extends Seeder
{
  public function run()
  {
    $movies = [
      [
        'id' => 1,

        'created_at' => "2019-07-02 10:00:22",
        'updated_at' => "2019-07-02 10:00:22",

        'name' => "Pulp Fiction",
        'director' => "Quentin Tarantino",
        'year' => "1993",
        'description' =>
        "Excepteur tempor id aliqua ut eu enim quis ."
      ],
      [
        'id' => 2,

        'created_at' => "2019-07-02 10:34:22",
        'updated_at' => "2019-07-02 10:34:22",

        'name' => "Inglorious Basterds",
        'director' => "Quentin Tarantino",
        'year' => "2009",
        'description' =>
        "Aliqua pariatur dolore dolore tempor "

      ],
      [
        'id' => 3,

        'created_at' => "2019-07-02 10:34:22",
        'updated_at' => "2019-07-02 10:34:22",

        'name' => "Inception",
        'director' => "Christopher Nolan",
        'year' => "2012",
        'description' =>
        "Aliqua pariatur dolore dolore tempor "

      ]
    ];

    Movie::insert($movies);
  }
}
