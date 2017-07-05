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
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, syscfg, usercfg, templateurl, files, created_at, updated_at) VALUES (7, 'sys-model', '模块管理', 1, 'icon-puzzle', '/sys-model.html', null, null, 'dcviews/sys-model', '../assets/global/plugins/jstree/dist/themes/default/style.min.css,views/sys-model/sys-model.css,../assets/global/plugins/jstree/dist/jstree.min.js,views/sys-model/sys-model.js,js/controllers/GeneralPageController.js', '2002-12-15 20:25:38', '1978-11-19 13:00:49');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, syscfg, usercfg, templateurl, files, created_at, updated_at) VALUES (3, 'sys-setting', '系统设置', 1, 'icon-settings', null, null, null, null, '', '1975-01-03 21:45:55', '1980-04-24 22:26:43');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, syscfg, usercfg, templateurl, files, created_at, updated_at) VALUES (17, 'am-budget', '预算管理', 1, 'icon-credit-card', '/am-budget.html', null, null, 'dcviews/am-budget', 'views/am-budget/am-budget.css,views/am-budget/am-budget.js,js/controllers/GeneralPageController.js,', '2017-01-22 08:40:12', '2017-01-22 08:55:08');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, syscfg, usercfg, templateurl, files, created_at, updated_at) VALUES (22, 'am-assets-management-add', '登记固定资产', 1, 'icon-note', '/am-assets-management-add.html', null, null, 'dcviews/am-assets-management-add', 'views/am-assets-management-add/am-assets-management-add.css,views/am-assets-management-add/am-assets-management-add.js,js/controllers/GeneralPageController.js,', '2017-01-22 09:01:04', '2017-01-22 09:01:04');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, syscfg, usercfg, templateurl, files, created_at, updated_at) VALUES (23, 'am-assets-management-list', '固定资产列表', 1, 'icon-equalizer', '/am-assets-management-list.html', null, null, 'dcviews/am-assets-management-list', 'views/am-assets-management-list/am-assets-management-list.css,views/am-assets-management-list/am-assets-management-list.js,js/controllers/GeneralPageController.js,', '2017-01-22 09:01:50', '2017-01-22 09:01:50');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, syscfg, usercfg, templateurl, files, created_at, updated_at) VALUES (24, 'am-purchasing-management', '采购管理', 1, 'icon-basket-loaded', '/am-purchasing-management.html', null, null, 'dcviews/am-purchasing-management', 'views/am-purchasing-management/am-purchasing-management.css,views/am-purchasing-management/am-purchasing-management.js,js/controllers/GeneralPageController.js,', '2017-01-22 09:12:07', '2017-01-22 09:12:07');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, syscfg, usercfg, templateurl, files, created_at, updated_at) VALUES (21, 'am-assets-management', '资产管理', 1, 'icon-briefcase', '/am-assets-management.html', null, null, 'dcviews/am-assets-management', 'views/am-assets-management/am-assets-management.css,views/am-assets-management/am-assets-management.js,js/controllers/GeneralPageController.js,', '2017-01-22 08:59:10', '2017-01-22 08:59:10');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, syscfg, usercfg, templateurl, files, created_at, updated_at) VALUES (15, 'user-management', '用户管理', 1, 'icon-users', '/user-management.html', null, null, 'dcviews/user-management', 'views/user-management/user-management.css,views/user-management/user-management.js,js/controllers/GeneralPageController.js,', '2017-01-22 08:15:04', '2017-01-24 05:25:43');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, syscfg, usercfg, templateurl, files, created_at, updated_at) VALUES (28, 'sys-privilege-management', '权限管理', 1, 'icon-star', '/sys-privilege-management.html', null, null, 'dcviews/sys-privilege-management', 'views/sys-privilege-management/sys-privilege-management.css,views/sys-privilege-management/sys-privilege-management.js,js/controllers/GeneralPageController.js,', '2017-01-24 02:48:22', '2017-01-24 02:48:22');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, syscfg, usercfg, templateurl, files, created_at, updated_at) VALUES (30, 'sys-usersown', '个人信息', 1, 'icon-user', '/sys-usersown.html', null, null, 'dcviews/sys-usersown', 'views/sys-usersown/sys-usersown.css,views/sys-usersown/sys-usersown.js,js/controllers/GeneralPageController.js,', '2017-01-24 05:33:28', '2017-01-31 09:23:34');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, syscfg, usercfg, templateurl, files, created_at, updated_at) VALUES (4, 'sys-users', '系统用户', 1, 'icon-user-follow', '/sys-users.html', null, null, 'dcviews/sys-users', 'views/sys-users/sys-users.css,views/sys-users/sys-users.js,js/controllers/GeneralPageController.js,', '1995-05-11 02:20:06', '2017-01-31 09:23:34');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, syscfg, usercfg, templateurl, files, created_at, updated_at) VALUES (16, 'user-profile', '人员信息', 1, 'icon-user-following', '/user-profile.html', null, null, 'dcviews/user-profile', 'views/user-profile/user-profile.css,views/user-profile/user-profile.js,js/controllers/GeneralPageController.js,', '2017-01-22 08:16:28', '2017-01-31 09:26:16');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, syscfg, usercfg, templateurl, files, created_at, updated_at) VALUES (20, 'user-department', '机构设置', 1, 'fa fa-sitemap', '/user-department.html', null, null, 'dcviews/user-department', '../assets/global/plugins/jstree/dist/themes/default/style.min.css, views/user-department/user-department.css, ../assets/global/plugins/jstree/dist/jstree.min.js, views/user-department/user-department.js, js/controllers/GeneralPageController.js,', '2017-01-22 08:48:46', '2017-02-09 13:29:36');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, syscfg, usercfg, templateurl, files, created_at, updated_at) VALUES (2, 'dashboard', '主面板', 1, 'icon-home', '/dashboard.html', null, null, 'dcviews/dashboard', 'js/controllers/GeneralPageController.js', '1991-05-16 20:15:46', '2017-02-14 09:54:43');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, syscfg, usercfg, templateurl, files, created_at, updated_at) VALUES (9, 'sys-msg', '消息管理', 1, 'icon-envelope-open', '/sys-msg.html', null, null, 'dcviews/sys-msg', '../assets/apps/css/inbox.min.css, views/sys-msg/sys-msg.css, /js/common/jquery.qqFace.js, ../assets/apps/scripts/inbox.min.js, views/sys-msg/sys-msg.js, js/controllers/GeneralPageController.js', '1999-09-26 08:41:30', '2017-02-15 22:28:20');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, syscfg, usercfg, templateurl, files, created_at, updated_at) VALUES (32, 'sys-function', '系统功能', 1, 'icon-disc', '/sys-function.html', null, null, 'dcviews/sys-function', 'views/sys-function/sys-function.css,views/sys-function/sys-function.js,js/controllers/GeneralPageController.js', '2017-02-14 09:57:51', '2017-02-16 21:31:08');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, syscfg, usercfg, templateurl, files, created_at, updated_at) VALUES (34, 'sys-matters', '事项提醒', 1, 'icon-calendar', '/sys-matters.html', null, null, 'dcviews/sys-matters', 'views/sys-matters/sys-matters.css,views/sys-matters/sys-matters.js,js/controllers/GeneralPageController.js', '2017-02-14 10:02:16', '2017-02-16 21:31:08');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, syscfg, usercfg, templateurl, files, created_at, updated_at) VALUES (33, 'sys-announcement', '系统公告', 1, 'fa fa-bullhorn', '/sys-announcement.html', null, null, 'dcviews/sys-announcement', 'views/sys-announcement/sys-announcement.css, views/sys-announcement/sys-announcement.js, js/controllers/GeneralPageController.js', '2017-02-14 10:00:22', '2017-02-16 21:31:08');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, syscfg, usercfg, templateurl, files, created_at, updated_at) VALUES (1, 'root', 'System1', 0, '', '', null, null, '', '', '2015-01-15 06:17:09', '2017-02-18 19:03:15');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, syscfg, usercfg, templateurl, files, created_at, updated_at) VALUES (5, 'sys-role', '角色管理', 1, 'icon-globe', '/sys-role.html', null, null, 'dcviews/sys-role', 'views/sys-role/sys-role.css,../assets/global/plugins/jstree/dist/themes/default/style.min.css,views/sys-role/sys-role.js,../assets/global/plugins/jstree/dist/jstree.min.js,js/controllers/GeneralPageController.js', '1989-04-28 02:26:40', '2017-01-22 08:22:51');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, syscfg, usercfg, templateurl, files, created_at, updated_at) VALUES (18, 'am-budget-management', '预算设置', 1, 'icon-screen-tablet', '/am-budget-management.html', null, null, 'dcviews/am-budget-management', 'views/am-budget-management/am-budget-management.css,views/am-budget-management/am-budget-management.js,js/controllers/GeneralPageController.js,', '2017-01-22 08:43:00', '2017-03-02 10:46:28');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, syscfg, usercfg, templateurl, files, created_at, updated_at) VALUES (19, 'am-budget-list', '预算查询', 1, 'icon-notebook', '/am-budget-list.html', null, null, 'dcviews/am-budget-list', 'views/am-budget-list/am-budget-list.css,views/am-budget-list/am-budget-list.js,js/controllers/GeneralPageController.js,', '2017-01-22 08:43:57', '2017-03-02 10:46:28');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, syscfg, usercfg, templateurl, files, created_at, updated_at) VALUES (25, 'icon-basket-loaded-add', '发起采购', 1, 'icon-basket', '/icon-basket-loaded-add.html', null, null, 'dcviews/icon-basket-loaded-add', 'views/icon-basket-loaded-add/icon-basket-loaded-add.css,views/icon-basket-loaded-add/icon-basket-loaded-add.js,js/controllers/GeneralPageController.js,', '2017-01-22 09:12:39', '2017-03-10 16:59:38');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, syscfg, usercfg, templateurl, files, created_at, updated_at) VALUES (26, 'icon-basket-loaded-list', '采购列表', 1, 'icon-book-open', '/icon-basket-loaded-list.html', null, null, 'dcviews/icon-basket-loaded-list', 'views/icon-basket-loaded-list/icon-basket-loaded-list.css,views/icon-basket-loaded-list/icon-basket-loaded-list.js,js/controllers/GeneralPageController.js,', '2017-01-22 09:14:14', '2017-03-10 16:59:38');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, syscfg, usercfg, templateurl, files, created_at, updated_at) VALUES (36, 'icon-basket-loaded-plan', '采购设置', 1, 'icon-equalizer', '/icon-basket-loaded-plan.html', null, null, 'dcviews/icon-basket-loaded-plan', 'views/icon-basket-loaded-plan/icon-basket-loaded-plan.css,views/icon-basket-loaded-plan/icon-basket-loaded-plan.js,js/controllers/GeneralPageController.js,', '2017-03-10 16:23:54', '2017-03-10 16:59:38');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, syscfg, usercfg, templateurl, files, created_at, updated_at) VALUES (37, 'icon-basket-setindex', '目录设置', 1, 'icon-list', '/icon-basket-setindex.html', null, null, 'dcviews/icon-basket-setindex', 'views/icon-basket-setindex/icon-basket-setindex.css,views/icon-basket-setindex/icon-basket-setindex.js,js/controllers/GeneralPageController.js,', '2017-03-13 13:03:32', '2017-03-13 13:03:32');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, syscfg, usercfg, templateurl, files, created_at, updated_at) VALUES (38, 'am-assets-management-scrap', '报废资产列表', 1, 'icon-shuffle', '/am-assets-management-scrap.html', null, null, 'dcviews/am-assets-management-scrap', 'views/am-assets-management-scrap/am-assets-management-scrap.css,views/am-assets-management-scrap/am-assets-management-scrap.js,js/controllers/GeneralPageController.js,', '2017-03-17 10:09:53', '2017-03-17 10:09:53');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, syscfg, usercfg, templateurl, files, created_at, updated_at) VALUES (41, 'am-budget-count', '预算统计', 1, 'icon-pie-chart', '/am-budget-count.html', null, null, 'dcviews/am-budget-count', 'views/am-budget-count/am-budget-count.css,views/am-budget-count/am-budget-count.js,js/controllers/GeneralPageController.js,', '2017-06-28 14:47:43', '2017-06-28 14:47:43');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, syscfg, usercfg, templateurl, files, created_at, updated_at) VALUES (42, 'am-budget-lb', '预算类别', 1, 'icon-chemistry', '/am-budget-lb.html', null, null, 'dcviews/am-budget-lb', 'views/am-budget-lb/am-budget-lb.css,views/am-budget-lb/am-budget-lb.js,js/controllers/GeneralPageController.js,', '2017-06-30 14:08:42', '2017-06-30 14:08:42');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, syscfg, usercfg, templateurl, files, created_at, updated_at) VALUES (43, 'icon-basket-setsupplier', '供应商目录', 1, 'icon-grid', '/icon-basket-setsupplier.html', null, null, 'dcviews/icon-basket-setsupplier', 'views/icon-basket-setsupplier/icon-basket-setsupplier.css,views/icon-basket-setsupplier/icon-basket-setsupplier.js,js/controllers/GeneralPageController.js,', '2017-06-30 22:26:44', '2017-06-30 22:26:44');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, syscfg, usercfg, templateurl, files, created_at, updated_at) VALUES (44, 'query-statistics', '查询统计', 1, 'icon-pie-chart', '/query-statistics.html', null, null, 'dcviews/query-statistics', 'views/query-statistics/query-statistics.css,views/query-statistics/query-statistics.js,js/controllers/GeneralPageController.js,', '2017-07-05 13:11:31', '2017-07-05 13:11:31');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, syscfg, usercfg, templateurl, files, created_at, updated_at) VALUES (45, 'query-budget', '预算统计', 1, 'icon-bar-chart', '/query-budget.html', null, null, 'dcviews/query-budget', 'views/query-budget/query-budget.css,views/query-budget/query-budget.js,js/controllers/GeneralPageController.js,', '2017-07-05 13:15:48', '2017-07-05 13:15:48');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, syscfg, usercfg, templateurl, files, created_at, updated_at) VALUES (46, 'query-purchasing', '采购统计', 1, 'fa fa-pie-chart', '/query-purchasing.html', null, null, 'dcviews/query-purchasing', 'views/query-purchasing/query-purchasing.css,views/query-purchasing/query-purchasing.js,js/controllers/GeneralPageController.js,', '2017-07-05 13:21:40', '2017-07-05 13:21:40');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, syscfg, usercfg, templateurl, files, created_at, updated_at) VALUES (47, 'query-assets', '资产统计', 1, 'fa fa-bar-chart', '/query-assets.html', null, null, 'dcviews/query-assets', 'views/query-assets/query-assets.css,views/query-assets/query-assets.js,js/controllers/GeneralPageController.js,', '2017-07-05 13:24:49', '2017-07-05 13:24:49');

INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (33, 20, 41, 42, 2, 37, '2017-03-13 13:03:32', '2017-07-05 13:25:04');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (41, 39, 63, 64, 2, 46, '2017-07-05 13:21:40', '2017-07-05 13:25:01');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (32, 20, 43, 44, 2, 36, '2017-03-10 16:23:54', '2017-07-05 13:25:04');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (1, null, 1, 68, 0, 1, '2015-08-23 06:01:37', '2017-07-05 13:24:50');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (2, 1, 2, 3, 1, 2, '2015-08-23 06:03:39', '2017-07-05 13:25:04');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (9, 4, 5, 6, 2, 7, '2015-08-23 06:14:39', '2017-07-05 13:25:04');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (7, 4, 7, 8, 2, 5, '2015-08-23 06:13:47', '2017-07-05 13:25:04');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (24, 4, 9, 10, 2, 28, '2017-01-24 02:48:22', '2017-07-05 13:25:04');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (4, 1, 4, 11, 1, 3, '2015-08-23 06:10:09', '2017-07-05 13:25:04');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (29, 28, 13, 14, 2, 33, '2017-02-14 10:00:22', '2017-07-05 13:25:04');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (5, 28, 15, 16, 2, 9, '2015-08-23 06:10:14', '2017-07-05 13:25:04');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (30, 28, 17, 18, 2, 34, '2017-02-14 10:02:16', '2017-07-05 13:25:04');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (28, 1, 12, 19, 1, 32, '2017-02-14 09:57:51', '2017-07-05 13:25:04');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (26, 11, 21, 22, 2, 30, '2017-01-24 05:33:29', '2017-07-05 13:25:04');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (6, 11, 23, 24, 2, 4, '2015-08-23 06:13:42', '2017-07-05 13:25:04');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (12, 11, 25, 26, 2, 16, '2017-01-22 08:16:28', '2017-07-05 13:25:04');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (37, 13, 31, 32, 2, 42, '2017-06-30 14:08:42', '2017-07-05 13:25:04');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (36, 13, 33, 34, 2, 41, '2017-06-28 14:47:43', '2017-07-05 13:25:04');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (14, 13, 35, 36, 2, 18, '2017-01-22 08:43:01', '2017-07-05 13:25:04');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (15, 13, 37, 38, 2, 19, '2017-01-22 08:43:57', '2017-07-05 13:25:04');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (13, 1, 30, 39, 1, 17, '2017-01-22 08:40:13', '2017-07-05 13:25:04');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (42, 39, 65, 66, 2, 47, '2017-07-05 13:24:49', '2017-07-05 13:25:01');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (16, 11, 27, 28, 2, 20, '2017-01-22 08:48:46', '2017-07-05 13:25:04');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (11, 1, 20, 29, 1, 15, '2017-01-22 08:15:04', '2017-07-05 13:25:04');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (21, 20, 45, 46, 2, 25, '2017-01-22 09:12:39', '2017-07-05 13:25:04');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (22, 20, 47, 48, 2, 26, '2017-01-22 09:14:14', '2017-07-05 13:25:04');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (38, 20, 49, 50, 2, 43, '2017-06-30 22:26:44', '2017-07-05 13:25:04');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (20, 1, 40, 51, 1, 24, '2017-01-22 09:12:07', '2017-07-05 13:25:04');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (18, 17, 53, 54, 2, 22, '2017-01-22 09:01:04', '2017-07-05 13:25:04');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (19, 17, 55, 56, 2, 23, '2017-01-22 09:01:50', '2017-07-05 13:25:04');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (34, 17, 57, 58, 2, 38, '2017-03-17 10:09:53', '2017-07-05 13:25:04');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (17, 1, 52, 59, 1, 21, '2017-01-22 08:59:10', '2017-07-05 13:25:04');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (39, 1, 60, 67, 1, 44, '2017-07-05 13:11:31', '2017-07-05 13:25:05');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (40, 39, 61, 62, 2, 45, '2017-07-05 13:15:48', '2017-07-05 13:25:05');

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

INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (2, 'sys-model.create', '创建模块', null, '2017-02-18 14:27:35', '2017-02-18 14:27:35');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (1, 'sys-model.allmodels', '查询所有模块', null, '2017-02-18 14:25:09', '2017-02-18 14:27:48');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (3, 'sys-model.update', '更新模块', null, '2017-02-18 14:28:11', '2017-02-18 14:28:11');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (4, 'sys-model.delete', '删除模块', null, '2017-02-18 14:28:32', '2017-02-18 14:28:32');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (5, 'sys-model.gettree', '得到模块树', null, '2017-02-18 14:28:50', '2017-02-18 14:28:50');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (6, 'sys-model.movenode', '移动模块节点', null, '2017-02-18 14:29:07', '2017-02-18 14:29:07');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (7, 'sys-model.modtree', '得到菜单树', null, '2017-02-18 14:29:42', '2017-02-18 14:29:42');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (8, 'sys-model.modlist', '模块资源列表', null, '2017-02-18 14:31:53', '2017-02-18 14:31:53');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (9, 'sys-users.allusers', '得到所有用户', null, '2017-02-18 14:41:46', '2017-02-18 14:41:46');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (10, 'sys-users.unitgrporempty', '得到所在机构及空用户', null, '2017-02-18 14:42:14', '2017-02-18 14:42:14');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (11, 'sys-users.create', '建新用户', null, '2017-02-18 14:42:37', '2017-02-18 14:42:37');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (12, 'sys-users.update', '更新用户', null, '2017-02-18 14:42:54', '2017-02-18 14:42:54');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (13, 'sys-users.destroy', '删除用户', null, '2017-02-18 14:43:08', '2017-02-18 14:43:08');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (14, 'sys-users.logineduser', '得到当前登陆用户', null, '2017-02-18 14:43:50', '2017-02-18 14:43:50');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (15, 'sys-users.onlineusers', '得到在线用户', null, '2017-02-18 14:44:23', '2017-02-18 14:44:23');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (16, 'sys-usersown.selfdata', '修改个人信息', null, '2017-02-18 14:47:41', '2017-02-18 14:47:41');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (17, 'sys-role.allroles', '查询所有角色', null, '2017-02-18 14:51:38', '2017-02-18 14:51:38');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (19, 'sys-role.update', '更新角色', null, '2017-02-18 14:52:24', '2017-02-18 14:52:24');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (20, 'sys-role.destroy', '删除角色', null, '2017-02-18 14:52:54', '2017-02-18 14:52:54');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (18, 'sys-role.create', '创建角色页', null, '2017-02-18 14:52:04', '2017-02-18 14:53:04');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (21, 'sys-privilege-management.allperms', '得到所有权限', null, '2017-02-18 14:55:59', '2017-02-18 14:55:59');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (22, 'sys-privilege-management.create', '创建权限页', null, '2017-02-18 14:56:30', '2017-02-18 14:56:30');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (23, 'sys-privilege-management.update', '更新角色', null, '2017-02-18 14:56:50', '2017-02-18 14:56:50');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (24, 'sys-privilege-management.store', '保存权限', null, '2017-02-18 14:57:07', '2017-02-18 14:57:07');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (25, 'sys-privilege-management.destroy', '删除角色', null, '2017-02-18 14:57:27', '2017-02-18 14:57:27');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (27, 'user-department.create', '创建机构页', null, '2017-02-18 15:00:41', '2017-02-18 15:00:41');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (26, 'user-department.allunits', '查询所有机构', null, '2017-02-18 14:58:50', '2017-02-18 15:01:28');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (28, 'user-department.update', '更新机构', null, '2017-02-18 15:01:49', '2017-02-18 15:01:49');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (29, 'user-department.destroy', '删除机构', null, '2017-02-18 15:02:09', '2017-02-18 15:02:09');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (30, 'user-department.tree', '得到机构树', null, '2017-02-18 15:02:36', '2017-02-18 15:02:36');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (31, 'user-department.movenode', '移动机构树', null, '2017-02-18 15:02:55', '2017-02-18 15:02:55');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (32, 'user-department.setmember', '设置机构成员', null, '2017-02-18 15:04:25', '2017-02-18 15:04:25');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (33, 'sys-msg.allmsgs', '得到所有信息', null, '2017-02-18 15:11:25', '2017-02-18 15:11:25');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (34, 'sys-msg.create', '发短信', null, '2017-02-18 15:11:58', '2017-02-18 15:11:58');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (35, 'sys-msg.destroy', '删除信息', null, '2017-02-18 15:12:14', '2017-02-18 15:12:14');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (36, 'sys-msg.unreadmsgs', '得到未读信息', null, '2017-02-18 15:13:14', '2017-02-18 15:13:14');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (37, 'sys-model.store', '保存模块', null, '2017-02-18 15:17:32', '2017-02-18 15:17:32');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (38, 'sys-users.store', '保存用户', null, '2017-02-18 15:56:03', '2017-02-18 15:56:03');
INSERT INTO public.permissions (id, name, display_name, description, created_at, updated_at) VALUES (39, 'user-department.store', '保存机构', null, '2017-02-18 16:08:51', '2017-02-18 16:08:51');

INSERT INTO public.roles (id, name, display_name, description, created_at, updated_at) VALUES (1, 'root', '根用户角色', null, '2017-02-18 17:08:13', '2017-02-18 17:08:13');

INSERT INTO public.role_user (user_id, role_id) VALUES (1, 1);

INSERT INTO public.permission_role (permission_id, role_id) VALUES (2, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (1, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (3, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (4, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (5, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (6, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (7, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (8, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (9, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (10, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (11, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (12, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (13, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (14, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (15, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (16, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (17, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (19, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (20, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (18, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (21, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (22, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (23, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (24, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (25, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (27, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (26, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (28, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (29, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (30, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (31, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (32, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (33, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (34, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (35, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (36, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (37, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (38, 1);
INSERT INTO public.permission_role (permission_id, role_id) VALUES (39, 1);

select setval('dcmdgrps_id_seq', (select max(id) + 1 from dcmdgrps));
select setval('dcmodels_id_seq', (select max(id) + 1 from dcmodels));
select setval('unitgrps_id_seq', (select max(id) + 1 from unitgrps));
select setval('permissions_id_seq', (select max(id) + 1 from permissions));
select setval('roles_id_seq', (select max(id) + 1 from roles));

      ");


    }
}
