<?php
/**
 * Created by PhpStorm.
 * User: lucifer
 * Date: 15-8-21
 * Time: 下午8:32
 * @var $factory Closure
 */

$factory('App\User', [
        'name' => $faker->name,
        'email' => $faker->unique()->email,
        'password' => bcrypt('aaaaaa'),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime
    ]
);

$factory('App\models\Role', [
        'name' => $faker->unique()->name,
        'display_name' => $faker->name,
        'description' => $faker->name,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime
    ]
);

$factory('App\models\Permission', [
        'name' => $faker->unique()->name,
        'display_name' => $faker->name,
        'description' => $faker->name,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime
    ]
);

//$factory('role_user',[
//        'user_id' => $faker->unique()->name,
//        'role_id' => $faker->name,
//        'description'=>$faker->name,
//        'created_at' =>$faker->dateTime,
//        'updated_at'=>$faker->dateTime
//    ]
//);



