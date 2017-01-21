<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class dcmodelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        DB::table('dcmodels')->delete();

        DB::connection()->getPdo()->exec("
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (1, 'root', 'System', 0, '', '', '', '', '2015-01-15 06:17:09', '1972-09-12 10:06:59');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (8, 'user-console', '个人中心', 1, 'icon-user', '', '', '', '1971-10-28 05:06:47', '2015-09-01 12:08:19');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (2, 'dashboard', '仪表盘', 1, 'icon-home', '/dashboard.html', 'dcviews/dashboard', '                            ''js/controllers/GeneralPageController.js''', '1991-05-16 20:15:46', '2011-07-13 22:06:19');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (6, 'sys-addmodel', '模块编辑', 0, 'icon-direction', '/sys-addmodel.html', 'dcviews/sys-addmodel', '                            ''../assets/global/plugins/select2/select2.css'',
                            ''../assets/global/plugins/bootstrap-select/bootstrap-select.min.css'',
                            ''../assets/global/plugins/jquery-multi-select/css/multi-select.css'',
                            ''views/sys-addmodel/sys-addmodel.css'',

                            ''../assets/global/plugins/jquery-validation/js/jquery.validate.min.js'',
                            ''../assets/global/plugins/jquery-validation/js/additional-methods.min.js'',
                            ''../assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js'',
                            ''../assets/global/plugins/select2/select2.min.js'',
                            ''../assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js'',
                            ''views/sys-addmodel/sys-addmodel.js'',
                            ''js/controllers/GeneralPageController.js''', '1974-11-23 00:17:10', '2015-03-29 02:53:37');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (7, 'sys-model', '模块管理', 1, 'icon-puzzle', '/sys-model.html', 'dcviews/sys-model', '
                            ''../assets/global/plugins/jstree/dist/themes/default/style.min.css'',
                            ''views/sys-model/sys-model.css'',

                            ''../assets/global/plugins/jstree/dist/jstree.min.js'',
                            ''views/sys-model/sys-model.js'',
                            ''js/controllers/GeneralPageController.js''
                            ', '2002-12-15 20:25:38', '1978-11-19 13:00:49');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (5, 'sys-role', '角色管理', 1, 'icon-globe', '/sys-role.html', 'dcviews/sys-role', '                            ''../assets/global/plugins/jstree/dist/themes/default/style.min.css'',

                            ''../assets/global/plugins/jstree/dist/jstree.min.js'',
                            ''../assets/admin/pages/scripts/ui-tree.js'',
                            ''views/sys-role/sys-role.js'',
                            ''js/controllers/GeneralPageController.js''', '1989-04-28 02:26:40', '2004-03-02 14:47:52');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (9, 'sys-msg', '消息管理', 1, 'icon-envelope-open', '/sys-msg.html', 'dcviews/sys-msg', '
                    ''../assets/admin/pages/css/timeline.css'',
                    ''../assets/global/plugins/bootstrap-select/bootstrap-select.min.css'',
                    ''../assets/global/plugins/select2/select2.css'',
                    ''../assets/global/plugins/jquery-multi-select/css/multi-select.css'',
                    ''views/sys-msg/sys-msg.css'',

                    ''../assets/global/plugins/bootstrap-select/bootstrap-select.min.js'',
                    ''../assets/global/plugins/select2/select2.min.js'',
                    ''../assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js'',
                    ''views/sys-msg/sys-msg.js'',
                    ''js/controllers/GeneralPageController.js'',', '1999-09-26 08:41:30', '1996-03-04 03:23:24');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (4, 'sys-users', '用户管理', 1, 'icon-users', '/sys-users.html', 'dcviews/sys-users', '
                            ''views/sys-users/sys-users.css'',

                            ''views/sys-users/sys-users.js'',
                            ''js/controllers/GeneralPageController.js'',
                            ', '1995-05-11 02:20:06', '2010-12-29 11:58:31');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (3, 'sys-setting', '系统设置', 1, 'icon-settings', null, null, '', '1975-01-03 21:45:55', '1980-04-24 22:26:43');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (13, 'sys-profile', '个人信息', 1, 'icon-user-following', '/sys-profile.html', 'dcviews/sys-profile', '                            ''../assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css'',
                            ''../assets/global/plugins/typeahead/typeahead.css'',
                            ''../assets/global/plugins/clockface/css/clockface.css'',
                            ''../assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css'',
                            ''../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css'',
                            ''../assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css'',
														''views/sys-profile/sys-profile.css'',

                            ''../assets/global/plugins/jquery.sparkline.min.js'',
                            ''../assets/global/plugins/typeahead/typeahead.bundle.min.js'',
                            ''../assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js'',
                            ''../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'',
                            ''../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js'',
                            ''views/sys-profile/sys-profile.js'',
                            ''js/controllers/GeneralPageController.js''', '2015-09-01 01:19:17', '2015-09-01 12:08:01');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (2, 1, 2, 3, 1, 2, '2015-08-23 06:03:39', '2017-01-15 16:14:44');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (4, 1, 4, 5, 1, 3, '2015-08-23 06:10:09', '2017-01-15 16:14:44');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (6, 1, 6, 7, 1, 4, '2015-08-23 06:13:42', '2017-01-15 16:14:44');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (7, 1, 8, 9, 1, 5, '2015-08-23 06:13:47', '2017-01-15 16:14:44');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (5, 1, 10, 11, 1, 9, '2015-08-23 06:10:14', '2017-01-15 16:14:44');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (9, 1, 12, 13, 1, 7, '2015-08-23 06:14:39', '2017-01-15 16:14:44');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (8, 1, 14, 15, 1, 6, '2015-08-23 06:13:52', '2017-01-15 16:14:44');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (1, null, 1, 16, 0, 1, '2015-08-23 06:01:37', '2017-01-15 16:14:44');

select setval('dcmdgrps_id_seq', (select max(id) + 1 from dcmdgrps));
select setval('dcmodels_id_seq', (select max(id) + 1 from dcmodels));


      ");

//-INSERT INTO public.pxunits (id, name, logo, phone, web, created_at, updated_at) VALUES (1, 'CloudSchool', 'Cloud', 'Cloud', 'Cloud', '2015-09-10 15:14:20', '2015-09-10 15:14:20');
//-INSERT INTO public.pxunitgrps (id, parent_id, lft, rgt, depth, pxunit_id, created_at, updated_at) VALUES (1, null, 1, 2, 0, 1, '2015-09-10 15:15:33', '2015-09-10 15:15:39');
//-select setval('pxunitgrps_id_seq', (select max(id) + 1 from pxunitgrps));
//-select setval('pxunits_id_seq', (select max(id) + 1 from pxunits));
//        DB::table('users')->insert(TestDummy::times(20)->create('App\User')->toArray());
//        TestDummy::times(10)->save('App\User');
//
//        //seed roles
//        DB::table('roles')->delete();
//        TestDummy::times(20)->create('App\models\Role');
//
//        //seed roles_user
//        $usersId = App\User::all()->lists('id')->toArray();
//        $rolesId = App\models\Role::all()->lists('id')->toArray();
//        foreach (range(1, 10) as $index) {
//            DB::table('role_user')->insert([
//                'role_id' => $faker->randomElement($rolesId),
//                'user_id' => $faker->randomElement($usersId),
//            ]);
//        }

//        $categoryIds = Category::lists('id');
//        $postIds = Post::lists('id');
//
//        foreach(range(1, 50) as $index)
//        {
//            $category = Category::find($faker->randomElement($categoryIds));
//            $category->posts()->sync(array($faker->randomElement($postIDs)));
//        }


        //
    }
}
