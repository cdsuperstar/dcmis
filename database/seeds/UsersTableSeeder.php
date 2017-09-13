<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $faker->seed(3453);

        //seed users
        DB::table('users')->delete();
        DB::table('users')->insert(
            [
                'name' => 'Homer',
                'email' => '10835142@qq.com',
                'password' => bcrypt('aaaaaa'),
                'created_at' => '2015-08-14 21:47:12',
                'updated_at' => '2015-08-14 21:47:12',
            ]
        );

//        DB::table('users')->insert(TestDummy::times(20)->create(App\User::class)->toArray());
        //factory(App\User::class, 5)->create();

        //seed roles
//        DB::table('roles')->delete();
//        factory(App\models\Role::class, 20)->create();
//
//        //seed permissions
//        DB::table('permissions')->delete();
//        factory(App\models\Permission::class, 40)->create();

        //seed roles_user
//        DB::table('role_user')->delete();
//        $usersId = App\User::all()->pluck('id')->toArray();
//        $rolesId = App\models\Role::all()->pluck('id')->toArray();
//        foreach (range(1, 10) as $index) {
//            $a = $faker->randomElement($rolesId);
//            $b = $faker->randomElement($usersId);
//            DB::table('role_user')->where('role_id', '=', $a, 'and')->where('user_id', '=', $b)->delete();
//            DB::table('role_user')->insert([
//                'role_id' => $a,
//                'user_id' => $b,
//            ]);
//        }

        //seed permission_role
//        DB::table('permission_role')->delete();
//        $permission_id = App\models\Permission::all()->pluck('id')->toArray();
//        foreach (range(1, 20) as $index) {
//            $a = $faker->randomElement($rolesId);
//            $b = $faker->randomElement($permission_id);
//            DB::table('permission_role')->where('role_id', '=', $a, 'and')->where('permission_id', '=', $b)->delete();
//            DB::table('permission_role')->insert([
//                'role_id' => $a,
//                'permission_id' => $b,
//            ]);
//        }

//        DB::table('sysmsgs')->delete();
//        foreach (range(1, 300) as $index) {
//            DB::table('sysmsgs')->insert([
//                'user_id' => $faker->randomElement($usersId),
//                'friend_id' => $faker->randomElement($usersId),
//                'sender' => $faker->boolean(),
//                'content' => $faker->text,
//                'readed' => $faker->boolean(),
//                'created_at' => $faker->dateTime,
//                'updated_at' => $faker->dateTime,
//            ]);
//        }

//        foreach(range(1, 50) as $index)
//        {
//            $category = Category::find($faker->randomElement($categoryIds));
//            $category->posts()->sync(array($faker->randomElement($postIDs)));
//        }

    }
}
