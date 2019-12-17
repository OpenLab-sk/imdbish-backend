<?php

use Jules\Movies\Models\Movie;

$auth = '\Tymon\JWTAuth\Middleware\GetUserFromToken';

Route::get('/movies', function () {
  return Movie::all();
});

Route::get('/movies/{id}', function ($id) {
  return Movie::where(['id' => $id])->first();
});

Route::post('/movies', function () {

  $movie = new Movie;

  $movie->name = Input::get('name');
  $movie->director = Input::get('director');
  $movie->year = Input::get('year');
  $movie->description = Input::get('description');

  $movie->save();
})->middleware($auth);

Route::patch('/movies/{id}', function ($id) {
  // Find movie to update
  $movie = Movie::where(['id' => $id])->first();

  // Update the fields
  $movie->name = Input::get('name', $movie->name);
  $movie->director = Input::get('director', $movie->director);
  $movie->year = Input::get('year', $movie->year);
  $movie->description = Input::get('description', $movie->description);

  // Save updated movie
  $movie->save();
});

Route::delete('/movies/{id}', function ($id) {
  $movie = Movie::where('id', $id)->first();
  $movie->delete();
});
