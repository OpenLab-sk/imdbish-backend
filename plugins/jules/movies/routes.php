<?php

use Jules\Movies\Models\Movie;

Route::get('/movies', function () {
  return  Movie::all();
});

Route::get('/movie/{id}', function ($id) {
  return  Movie::where(['id' => $id])->first();
});

Route::post('/movies', function () {
  $movie = new Movie;

  $movie->name  = Input::get('name');
  $movie->description = Input::get('description');
  $movie->director = Input::get('director');
  $movie->year = Input::get('year');

  $movie->save();
});

Route::patch('/movie/{id}', function ($id) {
  $movie =  Movie::where(['id' => $id])->first();

  $movie->update([
    'name'  => Input::get('name', $movie->name),
    'description' => Input::get('description', $movie->description),
    'director' => Input::get('director', $movie->director),
    'year' => Input::get('year', $movie->year),
  ]);
});

Route::delete('/movie/{id}', function ($id) {
  return  Movie::where(['id' => $id])->delete();
});
