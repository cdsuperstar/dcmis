<?php
/**
 * Created by PhpStorm.
 * User: lucifer
 * Date: 15-8-21
 * Time: 下午8:32
 * @var Closure $factory
 */

$factory('App\models\dcmodel', [
        'name' => $faker->unique()->name,
        'title' => $faker->name,
        'ismenu' => $faker->randomNumber(1),
        'icon' => $faker->name,
        'url' => $faker->text,
        'templateUrl' => $faker->text,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime
    ]
);



