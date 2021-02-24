<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'nic' => $faker->randomNumber($nbDigits = 9, $strict = true),
        'email' => $faker->email,
        'gender' => $faker->randomElement(['male', 'female']),
        'bday' =>  $faker->date('1990-01-01', '2000-01-01')
    ];
});
