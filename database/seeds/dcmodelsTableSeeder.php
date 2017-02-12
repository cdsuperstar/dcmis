<?php

use Illuminate\Database\Seeder;

class dcmodelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dcmodels')->delete();

        DB::connection()->getPdo()->exec("
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (1, 'root', 'System', 0, '', '', '', '', '2015-01-15 06:17:09', '1972-09-12 10:06:59');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (7, 'sys-model', '模块管理', 1, 'icon-puzzle', '/sys-model.html', 'dcviews/sys-model', '../assets/global/plugins/jstree/dist/themes/default/style.min.css,views/sys-model/sys-model.css,../assets/global/plugins/jstree/dist/jstree.min.js,views/sys-model/sys-model.js,js/controllers/GeneralPageController.js', '2002-12-15 20:25:38', '1978-11-19 13:00:49');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (3, 'sys-setting', '系统设置', 1, 'icon-settings', null, null, '', '1975-01-03 21:45:55', '1980-04-24 22:26:43');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (5, 'sys-role', '角色管理', 1, 'icon-globe', '/sys-role.html', 'dcviews/sys-role', 'views/sys-role/sys-role.css,views/sys-role/sys-role.js,js/controllers/GeneralPageController.js', '1989-04-28 02:26:40', '2017-01-22 08:22:51');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (26, 'icon-basket-loaded-list', '采购管理列表', 1, 'icon-book-open', '/icon-basket-loaded-list.html', 'dcviews/icon-basket-loaded-list', 'views/icon-basket-loaded-list/icon-basket-loaded-list.css,views/icon-basket-loaded-list/icon-basket-loaded-list.js,js/controllers/GeneralPageController.js,', '2017-01-22 09:14:14', '2017-01-22 09:14:14');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (17, 'am-budget', '预算管理', 1, 'icon-credit-card', '/am-budget.html', 'dcviews/am-budget', 'views/am-budget/am-budget.css,views/am-budget/am-budget.js,js/controllers/GeneralPageController.js,', '2017-01-22 08:40:12', '2017-01-22 08:55:08');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (19, 'am-budget-list', '预算申报管理', 1, 'icon-notebook', '/am-budget-list.html', 'dcviews/am-budget-list', 'views/am-budget-list/am-budget-list.css,views/am-budget-list/am-budget-list.js,js/controllers/GeneralPageController.js,', '2017-01-22 08:43:57', '2017-01-22 08:55:08');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (22, 'am-assets-management-add', '登记固定资产', 1, 'icon-note', '/am-assets-management-add.html', 'dcviews/am-assets-management-add', 'views/am-assets-management-add/am-assets-management-add.css,views/am-assets-management-add/am-assets-management-add.js,js/controllers/GeneralPageController.js,', '2017-01-22 09:01:04', '2017-01-22 09:01:04');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (23, 'am-assets-management-list', '固定资产列表', 1, 'icon-equalizer', '/am-assets-management-list.html', 'dcviews/am-assets-management-list', 'views/am-assets-management-list/am-assets-management-list.css,views/am-assets-management-list/am-assets-management-list.js,js/controllers/GeneralPageController.js,', '2017-01-22 09:01:50', '2017-01-22 09:01:50');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (24, 'am-purchasing-management', '采购管理', 1, 'icon-basket-loaded', '/am-purchasing-management.html', 'dcviews/am-purchasing-management', 'views/am-purchasing-management/am-purchasing-management.css,views/am-purchasing-management/am-purchasing-management.js,js/controllers/GeneralPageController.js,', '2017-01-22 09:12:07', '2017-01-22 09:12:07');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (2, 'dashboard', '仪表盘', 1, 'icon-home', '/dashboard.html', 'dcviews/dashboard', 'js/controllers/GeneralPageController.js', '1991-05-16 20:15:46', '2017-01-22 12:21:52');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (21, 'am-assets-management', '资产管理', 1, 'icon-briefcase', '/am-assets-management.html', 'dcviews/am-assets-management', 'views/am-assets-management/am-assets-management.css,views/am-assets-management/am-assets-management.js,js/controllers/GeneralPageController.js,', '2017-01-22 08:59:10', '2017-01-22 08:59:10');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (25, 'icon-basket-loaded-add', '发起采购申请', 1, 'icon-basket', '/icon-basket-loaded-add.html', 'dcviews/icon-basket-loaded-add', 'views/icon-basket-loaded-add/icon-basket-loaded-add.css,views/icon-basket-loaded-add/icon-basket-loaded-add.js,js/controllers/GeneralPageController.js,', '2017-01-22 09:12:39', '2017-01-22 09:12:39');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (15, 'user-management', '用户管理', 1, 'icon-users', '/user-management.html', 'dcviews/user-management', 'views/user-management/user-management.css,views/user-management/user-management.js,js/controllers/GeneralPageController.js,', '2017-01-22 08:15:04', '2017-01-24 05:25:43');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (18, 'am-budget-management', '发起预算申报', 1, 'icon-screen-tablet', '/am-budget-management.html', 'dcviews/am-budget-management', 'views/am-budget-management/am-budget-management.css,views/am-budget-management/am-budget-management.js,js/controllers/GeneralPageController.js,', '2017-01-22 08:43:00', '2017-01-23 09:46:59');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (28, 'sys-privilege-management', '权限管理', 1, 'icon-star', '/sys-privilege-management.html', 'dcviews/sys-privilege-management', 'views/sys-privilege-management/sys-privilege-management.css,views/sys-privilege-management/sys-privilege-management.js,js/controllers/GeneralPageController.js,', '2017-01-24 02:48:22', '2017-01-24 02:48:22');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (30, 'sys-usersown', '个人信息', 1, 'icon-user', '/sys-usersown.html', 'dcviews/sys-usersown', 'views/sys-usersown/sys-usersown.css,views/sys-usersown/sys-usersown.js,js/controllers/GeneralPageController.js,', '2017-01-24 05:33:28', '2017-01-31 09:23:34');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (4, 'sys-users', '系统用户', 1, 'icon-user-follow', '/sys-users.html', 'dcviews/sys-users', 'views/sys-users/sys-users.css,views/sys-users/sys-users.js,js/controllers/GeneralPageController.js,', '1995-05-11 02:20:06', '2017-01-31 09:23:34');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (16, 'user-profile', '人员信息', 1, 'icon-user-following', '/user-profile.html', 'dcviews/user-profile', 'views/user-profile/user-profile.css,views/user-profile/user-profile.js,js/controllers/GeneralPageController.js,', '2017-01-22 08:16:28', '2017-01-31 09:26:16');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (20, 'user-department', '机构设置', 1, 'fa fa-sitemap', '/user-department.html', 'dcviews/user-department', '../assets/global/plugins/jstree/dist/themes/default/style.min.css, views/user-department/user-department.css, ../assets/global/plugins/jstree/dist/jstree.min.js, views/user-department/user-department.js, js/controllers/GeneralPageController.js,', '2017-01-22 08:48:46', '2017-02-09 13:29:36');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (9, 'sys-msg', '消息管理', 1, 'icon-envelope-open', '/sys-msg.html', 'dcviews/sys-msg', '/js/common/jquery.qqFace.js,views/sys-msg/sys-msg.css,views/sys-msg/sys-msg.js,js/controllers/GeneralPageController.js', '1999-09-26 08:41:30', '2017-02-10 14:10:55');

INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (2, 1, 2, 3, 1, 2, '2015-08-23 06:03:39', '2017-02-06 10:21:08');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (9, 4, 5, 6, 2, 7, '2015-08-23 06:14:39', '2017-02-06 10:21:08');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (5, 4, 7, 8, 2, 9, '2015-08-23 06:10:14', '2017-02-06 10:21:08');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (7, 4, 9, 10, 2, 5, '2015-08-23 06:13:47', '2017-02-06 10:21:08');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (24, 4, 11, 12, 2, 28, '2017-01-24 02:48:22', '2017-02-06 10:21:08');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (4, 1, 4, 13, 1, 3, '2015-08-23 06:10:09', '2017-02-06 10:21:08');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (26, 11, 15, 16, 2, 30, '2017-01-24 05:33:29', '2017-02-06 10:21:08');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (6, 11, 17, 18, 2, 4, '2015-08-23 06:13:42', '2017-02-06 10:21:08');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (12, 11, 19, 20, 2, 16, '2017-01-22 08:16:28', '2017-02-06 10:21:08');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (16, 11, 21, 22, 2, 20, '2017-01-22 08:48:46', '2017-02-06 10:21:08');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (11, 1, 14, 23, 1, 15, '2017-01-22 08:15:04', '2017-02-06 10:21:08');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (14, 13, 25, 26, 2, 18, '2017-01-22 08:43:01', '2017-02-06 10:21:08');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (15, 13, 27, 28, 2, 19, '2017-01-22 08:43:57', '2017-02-06 10:21:08');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (13, 1, 24, 29, 1, 17, '2017-01-22 08:40:13', '2017-02-06 10:21:08');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (18, 17, 31, 32, 2, 22, '2017-01-22 09:01:04', '2017-02-06 10:21:08');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (19, 17, 33, 34, 2, 23, '2017-01-22 09:01:50', '2017-02-06 10:21:08');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (17, 1, 30, 35, 1, 21, '2017-01-22 08:59:10', '2017-02-06 10:21:08');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (21, 20, 37, 38, 2, 25, '2017-01-22 09:12:39', '2017-02-06 10:21:08');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (22, 20, 39, 40, 2, 26, '2017-01-22 09:14:14', '2017-02-06 10:21:08');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (20, 1, 36, 41, 1, 24, '2017-01-22 09:12:07', '2017-02-06 10:21:08');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (1, null, 1, 42, 0, 1, '2015-08-23 06:01:37', '2017-02-06 10:21:08');

INSERT INTO public.unitgrps (id, parent_id, lft, rgt, depth, name, brief, created_at, updated_at) VALUES (1, null, 1, 2, 0, 'root', '系统根机构', '2017-02-09 14:16:27', '2017-02-09 14:16:37');
INSERT INTO public.unitgrps (id, parent_id, lft, rgt, depth, name, brief, created_at, updated_at) VALUES (3, 1, 2, 3, 1, '理工大资产经营有限公司', null, '2017-02-11 18:02:57', '2017-02-11 18:06:31');
INSERT INTO public.unitgrps (id, parent_id, lft, rgt, depth, name, brief, created_at, updated_at) VALUES (4, 1, 4, 5, 1, '办公室', null, '2017-02-11 18:03:22', '2017-02-11 18:06:32');
INSERT INTO public.unitgrps (id, parent_id, lft, rgt, depth, name, brief, created_at, updated_at) VALUES (5, 1, 6, 7, 1, '采购科', null, '2017-02-11 18:03:34', '2017-02-11 18:06:32');
INSERT INTO public.unitgrps (id, parent_id, lft, rgt, depth, name, brief, created_at, updated_at) VALUES (6, 1, 8, 9, 1, '云乐购办公室', null, '2017-02-11 18:04:00', '2017-02-11 18:06:32');
INSERT INTO public.unitgrps (id, parent_id, lft, rgt, depth, name, brief, created_at, updated_at) VALUES (7, 1, 10, 11, 1, '理工宾馆', null, '2017-02-11 18:04:18', '2017-02-11 18:06:32');
INSERT INTO public.unitgrps (id, parent_id, lft, rgt, depth, name, brief, created_at, updated_at) VALUES (8, 1, 12, 13, 1, '理工超市', null, '2017-02-11 18:04:30', '2017-02-11 18:06:32');
INSERT INTO public.unitgrps (id, parent_id, lft, rgt, depth, name, brief, created_at, updated_at) VALUES (9, 1, 14, 15, 1, '中兴物业管理有限公司', null, '2017-02-11 18:04:46', '2017-02-11 18:06:32');
INSERT INTO public.unitgrps (id, parent_id, lft, rgt, depth, name, brief, created_at, updated_at) VALUES (10, 1, 16, 17, 1, '物业管理中心', null, '2017-02-11 18:04:56', '2017-02-11 18:06:32');
INSERT INTO public.unitgrps (id, parent_id, lft, rgt, depth, name, brief, created_at, updated_at) VALUES (11, 1, 18, 19, 1, '物业管理办公室', null, '2017-02-11 18:05:07', '2017-02-11 18:06:32');
INSERT INTO public.unitgrps (id, parent_id, lft, rgt, depth, name, brief, created_at, updated_at) VALUES (12, 1, 20, 21, 1, '物业管理工程科', null, '2017-02-11 18:05:20', '2017-02-11 18:06:32');
INSERT INTO public.unitgrps (id, parent_id, lft, rgt, depth, name, brief, created_at, updated_at) VALUES (13, 1, 22, 23, 1, '商贸中心', null, '2017-02-11 18:05:38', '2017-02-11 18:06:32');

select setval('dcmdgrps_id_seq', (select max(id) + 1 from dcmdgrps));
select setval('dcmodels_id_seq', (select max(id) + 1 from dcmodels));
select setval('unitgrps_id_seq', (select max(id) + 1 from unitgrps));

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
