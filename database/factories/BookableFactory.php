<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Bookable;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$suffixes = [
    'Rooms',
    'Cottage',
    'Fancy',
    'Cheap House',
    'Villa',
    'Luxury Rooms',
    'Fancy Rooms',
    'Cheap Rooms',
    'Luxury Villas',
    'Luxury Cottage',
    'Fancy Cottage',
    'Cheap Villa',
    'Cheap Cottage',
    'Fancy Villa',
];

$factory->define(Bookable::class, function (Faker $faker) use($suffixes) {
    return [
        'title' => $faker->city.' '.Arr::random($suffixes),
        'description' => $faker->text(),
        'price' => random_int(15,650)
    ];
});
