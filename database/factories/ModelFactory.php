<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\models\dcmodel::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->unique()->name,
        'title' => $faker->name,
        'ismenu' => $faker->randomNumber(1),
        'icon' => $faker->name,
        'url' => $faker->text,
        'templateUrl' => $faker->text,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime
    ];
}
);

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('aaaaaa'),
//        'remember_token' => str_random(10),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime
    ];

}
);

$factory->define(App\models\Role::class,function(Faker\Generator $faker ){
  return [
      'name' => $faker->unique()->name,
      'display_name' => $faker->name,
      'description' => $faker->name,
      'created_at' => $faker->dateTime,
      'updated_at' => $faker->dateTime
  ];
}
);

$factory->define(App\models\Permission::class, function(Faker\Generator $faker){
    return [
        'name' => $faker->unique()->name,
        'display_name' => $faker->name,
        'description' => $faker->name,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime
    ];
}
);
