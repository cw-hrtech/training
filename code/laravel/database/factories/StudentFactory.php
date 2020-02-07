<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    $studentCode = '';
    while (\Illuminate\Support\Str::length($studentCode) < 8) {
        $studentCode .= $faker->randomLetter;
    }
    $gender = $faker->randomElement([true, false]);
    return [
        'code' => \Illuminate\Support\Str::upper($studentCode),
        'name' => $faker->name,
        'gender' => $gender,
        'age' => random_int(18, 35),
        'email' => $faker->email,
        'address' => $faker->address
    ];
});
