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
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (2, 'dashboard', '主页', 1, 'icon-home', '/dashboard.html', '/dcassets/templateurl/dashboard', '                            ''/js/controllers/GeneralPageController.js''', '1991-05-16 20:15:46', '2011-07-13 22:06:19');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (79, 'dc-analysis', '统计分析', 1, 'icon-bar-chart', '/dc-analysis.html', '/dcassets/templateurl/dc-analysis', '''/views/dc-analysis/dc-analysis.css'',
''/views/dc-analysis/dc-analysis.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 09:26:35', '2015-09-04 09:26:35');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (84, 'dc-analysis-lsvfx', '流失率分析', 1, 'icon-direction', '/dc-analysis-lsvfx.html', '/dcassets/templateurl/dc-analysis-lsvfx', '''/views/dc-analysis-lsvfx/dc-analysis-lsvfx.css'',
''/views/dc-analysis-lsvfx/dc-analysis-lsvfx.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 09:30:40', '2015-09-04 09:30:40');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (82, 'dc-analysis-lsxbl', '老生续班率', 1, 'icon-bar-chart', '/dc-analysis-lsxbl.html', '/dcassets/templateurl/dc-analysis-lsxbl', '''/views/dc-analysis-lsxbl/dc-analysis-lsxbl.css'',
''/views/dc-analysis-lsxbl/dc-analysis-lsxbl.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 09:28:35', '2015-09-04 09:28:35');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (85, 'dc-analysis-lyfx', '来源分析', 1, 'icon-size-fullscreen', '/dc-analysis-lyfx.html', '/dcassets/templateurl/dc-analysis-lyfx', '''/views/dc-analysis-lyfx/dc-analysis-lyfx.css'',
''/views/dc-analysis-lyfx/dc-analysis-lyfx.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 09:31:33', '2015-09-04 09:31:33');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (83, 'dc-analysis-xssjfx', '销售数据分析', 1, 'icon-equalizer', '/dc-analysis-xssjfx.html', '/dcassets/templateurl/dc-analysis-xssjfx', '''/views/dc-analysis-xssjfx/dc-analysis-xssjfx.css'',
''/views/dc-analysis-xssjfx/dc-analysis-xssjfx.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 09:29:25', '2015-09-04 09:29:25');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (81, 'dc-analysis-xxzzl', '新生增长量', 1, 'icon-graph', '/dc-analysis-xxzzl.html', '/dcassets/templateurl/dc-analysis-xxzzl', '''/views/dc-analysis-xxzzl/dc-analysis-xxzzl.css'',
''/views/dc-analysis-xxzzl/dc-analysis-xxzzl.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 09:28:05', '2015-09-04 09:28:05');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (80, 'dc-analysis-yye', '营业额分析', 1, 'icon-pie-chart', '/dc-analysis-yye.html', '/dcassets/templateurl/dc-analysis-yye', '''/views/dc-analysis-yye/dc-analysis-yye.css'',
''/views/dc-analysis-yye/dc-analysis-yye.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 09:27:15', '2015-09-04 09:27:15');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (35, 'dc-charge', '收费管理', 1, 'icon-calculator', '/dc-charge.html', '/dcassets/templateurl/dc-charge', '''/views/dc-charge/dc-charge.css'',
''/views/dc-charge/dc-charge.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 07:24:42', '2015-09-04 07:24:42');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (36, 'dc-charge-add', '收费记录', 1, 'icon-action-redo', '/dc-charge-add.html', '/dcassets/templateurl/dc-charge-add', '''/views/dc-charge-add/dc-charge-add.css'',
''/views/dc-charge-add/dc-charge-add.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 07:25:55', '2015-09-04 07:25:55');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (41, 'dc-charge-bz', '费用标准', 1, 'icon-paper-clip', '/dc-charge-bz.html', '/dcassets/templateurl/dc-charge-bz', '''/views/dc-charge-bz/dc-charge-bz.css'',
''/views/dc-charge-bz/dc-charge-bz.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 07:32:39', '2015-09-04 07:32:39');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (39, 'dc-charge-sf', '剩费查询', 1, 'icon-magnifier', '/dc-charge-sf.html', '/dcassets/templateurl/dc-charge-sf', '''/views/dc-charge-sf/dc-charge-sf.css'',
''/views/dc-charge-sf/dc-charge-sf.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 07:29:47', '2015-09-04 08:10:20');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (37, 'dc-charge-tf', '退费记录', 1, 'icon-action-undo', '/dc-charge-tf.html', '/dcassets/templateurl/dc-charge-tf', '''/views/dc-charge-tf/dc-charge-tf.css'',
''/views/dc-charge-tf/dc-charge-tf.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 07:26:57', '2015-09-04 07:26:57');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (40, 'dc-charge-xm', '费用项目', 1, 'icon-list', '/dc-charge-xm.html', '/dcassets/templateurl/dc-charge-xm', '''/views/dc-charge-xm/dc-charge-xm.css'',
''/views/dc-charge-xm/dc-charge-xm.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 07:31:21', '2015-09-04 07:31:21');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (38, 'dc-charge-zf', '转费记录', 1, 'icon-cursor', '/dc-charge-zf.html', '/dcassets/templateurl/dc-charge-zf', '''/views/dc-charge-zf/dc-charge-zf.css'',
''/views/dc-charge-zf/dc-charge-zf.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 07:28:14', '2015-09-04 07:28:14');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (21, 'dc-consultation', '咨询管理', 1, 'icon-badge', '/dc-consultation.html', '/dcassets/templateurl/dc-consultation', '''/views/dc-consultation/dc-consultation.css'',
''/views/dc-consultation/dc-consultation.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 06:35:45', '2015-09-04 06:35:45');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (28, 'dc-consultation-gkk', '公开课列表', 1, 'icon-docs', '/dc-consultation-gkk.html', '/dcassets/templateurl/dc-consultation-gkk', '''/views/dc-consultation-gkk/dc-consultation-gkk.css'',
''/views/dc-consultation-gkk/dc-consultation-gkk.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 06:45:53', '2015-09-04 06:45:53');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (22, 'dc-consultation-kh', '客户管理', 1, 'icon-notebook', '/dc-consultation-kh.html', '/dcassets/templateurl/dc-consultation-kh', '''/views/dc-consultation-kh/dc-consultation-kh.css'',
''/views/dc-consultation-kh/dc-consultation-kh.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 06:38:08', '2015-09-04 06:38:08');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (23, 'dc-consultation-lx', '联系记录', 1, 'icon-call-end', '/dc-consultation-lx.html', '/dcassets/templateurl/dc-consultation-lx', '''/views/dc-consultation-lx/dc-consultation-lx.css'',
''/views/dc-consultation-lx/dc-consultation-lx.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 06:39:14', '2015-09-04 06:39:14');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (25, 'dc-consultation-yj', '我的业绩', 1, 'icon-list', '/dc-consultation-yj.html', '/dcassets/templateurl/dc-consultation-yj', '''/views/dc-consultation-yj/dc-consultation-yj.css'',
''/views/dc-consultation-yj/dc-consultation-yj.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 06:42:30', '2015-09-04 06:42:30');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (24, 'dc-consultation-yy', '邀约记录', 1, 'icon-cup', '/dc-consultation-yy.html', '/dcassets/templateurl/dc-consultation-yy', '''/views/dc-consultation-yy/dc-consultation-yy.css'',
''/views/dc-consultation-yy/dc-consultation-yy.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 06:40:32', '2015-09-04 06:40:32');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (48, 'dc-educational', '教务管理', 1, 'icon-puzzle', '/dc-educational.html', '/dcassets/templateurl/dc-educational', '''/views/dc-educational/dc-educational.css'',
''/views/dc-educational/dc-educational.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 07:50:03', '2015-09-04 07:50:03');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (51, 'dc-educational-ap', '课程安排', 1, 'icon-directions', '/dc-educational-ap.html', '/dcassets/templateurl/dc-educational-ap', '''/views/dc-educational-ap/dc-educational-ap.css'',
''/views/dc-educational-ap/dc-educational-ap.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 07:52:15', '2015-09-04 07:52:15');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (54, 'dc-educational-kb', '课表查询', 1, 'icon-magnifier', '/dc-educational-kb.html', '/dcassets/templateurl/dc-educational-kb', '''/views/dc-educational-kb/dc-educational-kb.css'',
''/views/dc-educational-kb/dc-educational-kb.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 07:55:13', '2015-09-04 08:09:42');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (50, 'dc-educational-kk', '开课列表', 1, 'icon-list', '/dc-educational-kk.html', '/dcassets/templateurl/dc-educational-kk', '''/views/dc-educational-kk/dc-educational-kk.css'',
''/views/dc-educational-kk/dc-educational-kk.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 07:51:34', '2015-09-04 07:51:34');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (53, 'dc-educational-kq', '考勤记录', 1, 'icon-anchor', '/dc-educational-kq.html', '/dcassets/templateurl/dc-educational-kq', '''/views/dc-educational-kq/dc-educational-kq.css'',
''/views/dc-educational-kq/dc-educational-kq.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 07:53:56', '2015-09-04 07:53:56');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (49, 'dc-educational-lb', '课程列表', 1, 'icon-notebook', '/dc-educational-lb.html', '/dcassets/templateurl/dc-educational-lb', '''/views/dc-educational-lb/dc-educational-lb.css'',
''/views/dc-educational-lb/dc-educational-lb.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 07:50:51', '2015-09-04 07:50:51');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (52, 'dc-educational-tz', '课程调整', 1, 'icon-shuffle', '/dc-educational-tz.html', '/dcassets/templateurl/dc-educational-tz', '''/views/dc-educational-tz/dc-educational-tz.css'',
''/views/dc-educational-tz/dc-educational-tz.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 07:53:03', '2015-09-04 07:53:03');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (72, 'dc-finance', '财务管理', 1, 'icon-wallet', '/dc-finance.html', '/dcassets/templateurl/dc-finance', '''/views/dc-finance/dc-finance.css'',
''/views/dc-finance/dc-finance.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 09:06:14', '2015-09-04 09:06:14');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (74, 'dc-finance-bz', '课酬标准', 1, 'icon-tag', '/dc-finance-bz.html', '/dcassets/templateurl/dc-finance-bz', '''/views/dc-finance-bz/dc-finance-bz.css'',
''/views/dc-finance-bz/dc-finance-bz.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 09:08:05', '2015-09-04 09:08:05');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (73, 'dc-finance-js', '课酬结算', 1, 'icon-folder-alt', '/dc-finance-js.html', '/dcassets/templateurl/dc-finance-js', '''/views/dc-finance-js/dc-finance-js.css'',
''/views/dc-finance-js/dc-finance-js.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 09:07:09', '2015-09-04 09:07:09');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (76, 'dc-finance-qtzc', '其他支出', 1, 'icon-share-alt', '/dc-finance-qtzc.html', '/dcassets/templateurl/dc-finance-qtzc', '''/views/dc-finance-qtzc/dc-finance-qtzc.css'',
''/views/dc-finance-qtzc/dc-finance-qtzc.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 09:09:43', '2015-09-04 09:09:43');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (75, 'dc-finance-sr', '收入汇总', 1, 'icon-cloud-download', '/dc-finance-sr.html', '/dcassets/templateurl/dc-finance-sr', '''/views/dc-finance-sr/dc-finance-sr.css'',
''/views/dc-finance-sr/dc-finance-sr.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 09:08:59', '2015-09-04 09:08:59');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (77, 'dc-finance-zc', '支出汇总', 1, 'icon-cloud-upload', '/dc-finance-zc.html', '/dcassets/templateurl/dc-finance-zc', '''/views/dc-finance-zc/dc-finance-zc.css'',
''/views/dc-finance-zc/dc-finance-zc.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 09:10:24', '2015-09-04 09:10:24');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (78, 'dc-finance-zclx', '支出类型', 1, 'icon-tag', '/dc-finance-zclx.html', '/dcassets/templateurl/dc-finance-zclx', '''/views/dc-finance-zclx/dc-finance-zclx.css'',
''/views/dc-finance-zclx/dc-finance-zclx.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 09:10:54', '2015-09-04 09:10:54');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (16, 'dc-market', '市场管理', 1, 'icon-grid', '/dc-market.html', '/dcassets/templateurl/dc-market', '''/views/dc-market/dc-market.css'',
''/views/dc-market/dc-market.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 06:13:32', '2015-09-04 06:22:53');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (17, 'dc-market-data', '数据管理', 1, 'icon-notebook', '/dc-market-data.html', '/dcassets/templateurl/dc-market-data', '''/views/dc-market-data/dc-market-data.css'',
''/views/dc-market-data/dc-market-data.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 06:18:23', '2015-09-04 06:56:35');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (18, 'dc-market-fp', '数据分配', 1, 'icon-crop', '/dc-market-fp.html', '/dcassets/templateurl/dc-market-fp', '''/views/dc-market-fp/dc-market-fp.css'',
''/views/dc-market-fp/dc-market-fp.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 06:21:36', '2015-09-04 06:22:29');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (20, 'dc-market-hb', '合作伙伴', 1, 'icon-bubbles', '/dc-market-hb.html', '/dcassets/templateurl/dc-market-hb', '''/views/dc-market-hb/dc-market-hb.css'',
''/views/dc-market-hb/dc-market-hb.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 06:26:04', '2015-09-04 06:26:04');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (19, 'dc-market-jh', '市场计划', 1, 'icon-compass', '/dc-market-jh.html', '/dcassets/templateurl/dc-market-jh', '''/views/dc-market-jh/dc-market-jh.css'',
''/views/dc-market-jh/dc-market-jh.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 06:24:28', '2015-09-04 06:24:28');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (67, 'dc-personnel', '人事管理', 1, 'icon-support', '/dc-personnel.html', '/dcassets/templateurl/dc-personnel', '''/views/dc-personnel/dc-personnel.css'',
''/views/dc-personnel/dc-personnel.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 08:59:25', '2015-09-04 08:59:25');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (71, 'dc-personnel-ht', '职员合同管理', 1, 'icon-login', '/dc-personnel-ht.html', '/dcassets/templateurl/dc-personnel-ht', '''/views/dc-personnel-ht/dc-personnel-ht.css'',
''/views/dc-personnel-ht/dc-personnel-ht.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 09:03:34', '2015-09-10 07:36:22');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (70, 'dc-personnel-jz', '兼职管理', 1, 'icon-user-unfollow', '/dc-personnel-jz.html', '/dcassets/templateurl/dc-personnel-jz', '''/views/dc-personnel-jz/dc-personnel-jz.css'',
''/views/dc-personnel-jz/dc-personnel-jz.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 09:02:53', '2015-09-04 09:02:53');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (69, 'dc-personnel-yg', '职员管理', 1, 'icon-user-following', '/dc-personnel-yg.html', '/dcassets/templateurl/dc-personnel-yg', '''/views/dc-personnel-yg/dc-personnel-yg.css'',
''/views/dc-personnel-yg/dc-personnel-yg.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 09:02:19', '2015-09-10 07:36:15');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (56, 'dc-standard-xx', '组织结构设置', 1, 'icon-flag', '/dc-standard-xx.html', '/dcassets/templateurl/dc-standard-xx', '                            ''/assets/global/plugins/select2/select2.css'',
                            ''/assets/global/plugins/jstree/dist/themes/default/style.min.css'',
                            ''/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css'',
                            ''/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css'',
                            ''/assets/global/plugins/typeahead/typeahead.css'',
														''/views/dc-standard-xx/dc-standard-xx.css'',

                            ''/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js'',
                            ''/assets/global/plugins/select2/select2.min.js'',
                            ''/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js'',
                            ''/assets/global/plugins/jstree/dist/jstree.min.js'',
                            ''/assets/global/plugins/jquery.sparkline.min.js'',
                            ''/assets/global/plugins/typeahead/typeahead.bundle.min.js'',
                            ''/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js'',
                            ''/views/dc-standard-xx/dc-standard-xx.js'',
                            ''/js/controllers/GeneralPageController.js''', '2015-09-04 07:59:10', '2015-09-10 10:47:21');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (60, 'dc-standard-zj', '职级设置', 1, 'icon-vector', '/dc-standard-zj.html', '/dcassets/templateurl/dc-standard-zj', '''/views/dc-standard-zj/dc-standard-zj.css'',
''/views/dc-standard-zj/dc-standard-zj.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 08:02:24', '2015-09-04 08:02:24');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (59, 'dc-standard-zw', '职位设置', 1, 'icon-chemistry', '/dc-standard-zw.html', '/dcassets/templateurl/dc-standard-zw', '''/views/dc-standard-zw/dc-standard-zw.css'',
''/views/dc-standard-zw/dc-standard-zw.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 08:01:45', '2015-09-04 08:01:45');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (29, 'dc-student', '学员管理', 1, 'icon-users', '/dc-student.html', '/dcassets/templateurl/dc-student', '''/views/dc-student/dc-student.css'',
''/views/dc-student/dc-student.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 06:54:26', '2015-09-04 06:54:26');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (31, 'dc-student-bb', '报班记录', 1, 'icon-user-follow', '/dc-student-bb.html', '/dcassets/templateurl/dc-student-bb', '''/views/dc-student-bb/dc-student-bb.css'',
''/views/dc-student-bb/dc-student-bb.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 07:13:11', '2015-09-04 07:13:11');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (33, 'dc-student-bd', '变动记录', 1, 'icon-equalizer', '/dc-student-bd.html', '/dcassets/templateurl/dc-student-bd', '''/views/dc-student-bd/dc-student-bd.css'',
''/views/dc-student-bd/dc-student-bd.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 07:17:10', '2015-09-04 07:17:10');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (34, 'dc-student-gt', '沟通记录', 1, 'icon-call-end', '/dc-student-gt.html', '/dcassets/templateurl/dc-student-gt', '''/views/dc-student-gt/dc-student-gt.css'',
''/views/dc-student-gt/dc-student-gt.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 07:18:10', '2015-09-04 07:18:10');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (30, 'dc-student-lb', '学员列表', 1, 'icon-notebook', '/dc-student-lb.html', '/dcassets/templateurl/dc-student-lb', '''/views/dc-student-lb/dc-student-lb.css'',
''/views/dc-student-lb/dc-student-lb.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 06:56:02', '2015-09-04 06:56:02');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (42, 'dc-textbook', '教材管理', 1, 'icon-layers', '/dc-textbook.html', '/dcassets/templateurl/dc-textbook', '''/views/dc-textbook/dc-textbook.css'',
''/views/dc-textbook/dc-textbook.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 07:38:33', '2015-09-04 07:38:33');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (45, 'dc-textbook-cg', '采购记录', 1, 'icon-note', '/dc-textbook-cg.html', '/dcassets/templateurl/dc-textbook-cg', '''/views/dc-textbook-cg/dc-textbook-cg.css'',
''/views/dc-textbook-cg/dc-textbook-cg.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 07:41:28', '2015-09-04 07:41:28');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (43, 'dc-textbook-cs', '出售管理', 1, 'icon-map', '/dc-textbook-cs.html', '/dcassets/templateurl/dc-textbook-cs', '''/views/dc-textbook-cs/dc-textbook-cs.css'',
''/views/dc-textbook-cs/dc-textbook-cs.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 07:39:25', '2015-09-04 07:39:25');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (44, 'dc-textbook-ff', '教材发放', 1, 'icon-tag', '/dc-textbook-ff.html', '/dcassets/templateurl/dc-textbook-ff', '''/views/dc-textbook-ff/dc-textbook-ff.css'',
''/views/dc-textbook-ff/dc-textbook-ff.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 07:40:42', '2015-09-04 07:40:42');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (46, 'dc-textbook-kc', '教材库存', 1, 'icon-check', '/dc-textbook-kc.html', '/dcassets/templateurl/dc-textbook-kc', '''/views/dc-textbook-kc/dc-textbook-kc.css'',
''/views/dc-textbook-kc/dc-textbook-kc.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 07:42:26', '2015-09-04 07:42:26');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (47, 'dc-textbook-lb', '教材列表', 1, 'icon-notebook', '/dc-textbook-lb.html', '/dcassets/templateurl/dc-textbook-lb', '''/views/dc-textbook-lb/dc-textbook-lb.css'',
''/views/dc-textbook-lb/dc-textbook-lb.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 07:43:01', '2015-09-04 07:43:01');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (6, 'sys-addmodel', '模块编辑', 0, 'icon-direction', '/sys-addmodel.html', '/dcassets/templateurl/sys-addmodel', '                            ''/assets/global/plugins/select2/select2.css'',
                            ''/assets/global/plugins/bootstrap-select/bootstrap-select.min.css'',
                            ''/assets/global/plugins/jquery-multi-select/css/multi-select.css'',
                            ''/views/sys-addmodel/sys-addmodel.css'',

                            ''/assets/global/plugins/jquery-validation/js/jquery.validate.min.js'',
                            ''/assets/global/plugins/jquery-validation/js/additional-methods.min.js'',
                            ''/assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js'',
                            ''/assets/global/plugins/select2/select2.min.js'',
                            ''/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js'',
                            ''/views/sys-addmodel/sys-addmodel.js'',
                            ''/js/controllers/GeneralPageController.js''', '1974-11-23 00:17:10', '2015-03-29 02:53:37');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (7, 'sys-model', '模块管理', 1, 'icon-puzzle', '/sys-model.html', '/dcassets/templateurl/sys-model', '                            ''/assets/global/plugins/select2/select2.css'',
                            ''/assets/global/plugins/jstree/dist/themes/default/style.min.css'',
                            ''/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css'',
                            ''/views/sys-model/sys-model.css'',

                            ''/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js'',
                            ''/assets/global/plugins/select2/select2.min.js'',
                            ''/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js'',
                            ''/assets/global/plugins/jstree/dist/jstree.min.js'',
                            ''/views/sys-model/sys-model.js'',
                            ''/js/controllers/GeneralPageController.js''', '2002-12-15 20:25:38', '1978-11-19 13:00:49');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (15, 'sys-news', '系统公告', 1, 'icon-bell', '/sys-news.html', '/dcassets/templateurl/sys-news', '''/views/sys-news/sys-news.css'',
''/views/sys-news/sys-news.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-03 12:03:11', '2015-09-03 12:03:11');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (5, 'sys-role', '角色管理', 1, 'icon-globe', '/sys-role.html', '/dcassets/templateurl/sys-role', '                            ''/assets/global/plugins/jstree/dist/themes/default/style.min.css'',

                            ''/assets/global/plugins/jstree/dist/jstree.min.js'',
                            ''/assets/admin/pages/scripts/ui-tree.js'',
                            ''/views/sys-role/sys-role.js'',
                            ''/js/controllers/GeneralPageController.js''', '1989-04-28 02:26:40', '2004-03-02 14:47:52');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (9, 'sys-msg', '消息管理', 1, 'icon-envelope-open', '/sys-msg.html', '/dcassets/templateurl/sys-msg', '                    ''/assets/admin/pages/css/timeline.css'',
                    ''/assets/global/plugins/bootstrap-select/bootstrap-select.min.css'',
                    ''/assets/global/plugins/select2/select2.css'',
                    ''/assets/global/plugins/jquery-multi-select/css/multi-select.css'',
                    ''/views/sys-msg/sys-msg.css'',

                    ''/assets/global/plugins/bootstrap-select/bootstrap-select.min.js'',
                    ''/assets/global/plugins/select2/select2.min.js'',
                    ''/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js'',
                    ''/views/sys-msg/sys-msg.js'',
                    ''/js/controllers/GeneralPageController.js'',', '1999-09-26 08:41:30', '1996-03-04 03:23:24');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (4, 'sys-users', '用户管理', 1, 'icon-users', '/sys-users.html', '/dcassets/templateurl/sys-users', '                            ''/assets/global/plugins/select2/select2.css'',
                            ''/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css'',
                            ''/views/sys-users/sys-users.css'',

                            ''/js/controllers/GeneralPageController.js'',
                            ''/views/sys-users/sys-users.js'',', '1995-05-11 02:20:06', '2010-12-29 11:58:31');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (3, 'sys-setting', '系统设置', 1, 'icon-settings', null, null, '', '1975-01-03 21:45:55', '1980-04-24 22:26:43');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (62, 'dc-standard-xj', '课程安排设置', 1, 'icon-equalizer', '/dc-standard-xj.html', '/dcassets/templateurl/dc-standard-xj', '''/views/dc-standard-xj/dc-standard-xj.css'',
''/views/dc-standard-xj/dc-standard-xj.js'',
''/js/controllers/GeneralPageController.js'',', '2015-09-04 08:04:34', '2015-09-15 07:14:14');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (13, 'sys-profile', '个人信息', 1, 'icon-user-following', '/sys-profile.html', '/dcassets/templateurl/sys-profile', '                            ''/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css'',
                            ''/assets/global/plugins/typeahead/typeahead.css'',
                            ''/assets/global/plugins/clockface/css/clockface.css'',
                            ''/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css'',
                            ''/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css'',
                            ''/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css'',
														''/views/sys-profile/sys-profile.css'',

                            ''/assets/global/plugins/jquery.sparkline.min.js'',
                            ''/assets/global/plugins/typeahead/typeahead.bundle.min.js'',
                            ''/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js'',
                            ''/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'',
                            ''/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js'',
                            ''/views/sys-profile/sys-profile.js'',
                            ''/js/controllers/GeneralPageController.js''', '2015-09-01 01:19:17', '2015-09-01 12:08:01');
INSERT INTO public.dcmodels (id, name, title, ismenu, icon, url, templateurl, files, created_at, updated_at) VALUES (10, 'sys-memo', '个人便签', 1, 'icon-book-open', '/sys-memo.html', '/dcassets/templateurl/sys-memo', '                            ''/assets/global/plugins/clockface/css/clockface.css'',
                            ''/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css'',
                            ''/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css'',
                            ''/assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css'',
                            ''/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css'',
                            ''/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css'',
                            ''/views/sys-memo/sys-memo.css'',

                            ''/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'',
                            ''/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js'',
                            ''/assets/global/plugins/clockface/js/clockface.js'',
                            ''/assets/global/plugins/bootstrap-daterangepicker/moment.min.js'',
                            ''/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js'',
                            ''/assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js'',
                            ''/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js'',
                            ''/views/sys-memo/sys-memo.js'',
                            ''/js/controllers/GeneralPageController.js''', '1986-01-12 03:45:56', '1983-05-08 01:02:03');


INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (2, 1, 2, 3, 1, 2, '2015-08-23 06:03:39', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (15, 10, 5, 6, 2, 13, '2015-09-01 01:19:17', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (11, 10, 7, 8, 2, 10, '2015-08-23 06:16:30', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (5, 10, 9, 10, 2, 9, '2015-08-23 06:10:14', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (10, 1, 4, 11, 1, 8, '2015-08-23 06:14:41', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (4, 1, 12, 31, 1, 3, '2015-08-23 06:10:09', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (19, 18, 33, 34, 2, 17, '2015-09-04 06:18:24', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (20, 18, 35, 36, 2, 18, '2015-09-04 06:21:36', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (21, 18, 37, 38, 2, 19, '2015-09-04 06:24:28', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (22, 18, 39, 40, 2, 20, '2015-09-04 06:26:04', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (18, 1, 32, 41, 1, 16, '2015-09-04 06:13:33', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (24, 23, 43, 44, 2, 22, '2015-09-04 06:38:09', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (26, 23, 45, 46, 2, 24, '2015-09-04 06:40:32', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (25, 23, 47, 48, 2, 23, '2015-09-04 06:39:15', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (27, 23, 49, 50, 2, 25, '2015-09-04 06:42:30', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (28, 23, 51, 52, 2, 28, '2015-09-04 06:45:53', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (23, 1, 42, 53, 1, 21, '2015-09-04 06:35:45', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (30, 29, 55, 56, 2, 30, '2015-09-04 06:56:03', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (31, 29, 57, 58, 2, 31, '2015-09-04 07:13:12', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (32, 29, 59, 60, 2, 33, '2015-09-04 07:17:10', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (33, 29, 61, 62, 2, 34, '2015-09-04 07:18:10', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (29, 1, 54, 63, 1, 29, '2015-09-04 06:54:26', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (35, 34, 65, 66, 2, 36, '2015-09-04 07:25:55', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (37, 34, 67, 68, 2, 38, '2015-09-04 07:28:15', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (36, 34, 69, 70, 2, 37, '2015-09-04 07:26:57', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (38, 34, 71, 72, 2, 39, '2015-09-04 07:29:47', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (79, 78, 129, 130, 2, 80, '2015-09-04 09:27:15', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (80, 78, 131, 132, 2, 81, '2015-09-04 09:28:05', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (17, 4, 13, 14, 2, 15, '2015-09-03 12:03:11', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (6, 4, 15, 16, 2, 4, '2015-08-23 06:13:42', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (58, 4, 17, 18, 2, 59, '2015-09-04 08:01:45', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (59, 4, 19, 20, 2, 60, '2015-09-04 08:02:24', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (7, 4, 21, 22, 2, 5, '2015-08-23 06:13:47', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (9, 4, 23, 24, 2, 7, '2015-08-23 06:14:39', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (8, 4, 25, 26, 2, 6, '2015-08-23 06:13:52', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (61, 4, 27, 28, 2, 62, '2015-09-04 08:04:34', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (55, 4, 29, 30, 2, 56, '2015-09-04 07:59:11', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (39, 34, 73, 74, 2, 40, '2015-09-04 07:31:21', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (40, 34, 75, 76, 2, 41, '2015-09-04 07:32:39', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (34, 1, 64, 77, 1, 35, '2015-09-04 07:24:43', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (46, 41, 79, 80, 2, 47, '2015-09-04 07:43:02', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (43, 41, 81, 82, 2, 44, '2015-09-04 07:40:42', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (42, 41, 83, 84, 2, 43, '2015-09-04 07:39:25', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (44, 41, 85, 86, 2, 45, '2015-09-04 07:41:28', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (45, 41, 87, 88, 2, 46, '2015-09-04 07:42:27', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (41, 1, 78, 89, 1, 42, '2015-09-04 07:38:33', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (48, 47, 91, 92, 2, 49, '2015-09-04 07:50:51', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (49, 47, 93, 94, 2, 50, '2015-09-04 07:51:34', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (51, 47, 95, 96, 2, 52, '2015-09-04 07:53:03', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (50, 47, 97, 98, 2, 51, '2015-09-04 07:52:15', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (52, 47, 99, 100, 2, 53, '2015-09-04 07:53:56', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (53, 47, 101, 102, 2, 54, '2015-09-04 07:55:13', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (47, 1, 90, 103, 1, 48, '2015-09-04 07:50:03', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (68, 66, 105, 106, 2, 69, '2015-09-04 09:02:19', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (69, 66, 107, 108, 2, 70, '2015-09-04 09:02:53', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (70, 66, 109, 110, 2, 71, '2015-09-04 09:03:34', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (66, 1, 104, 111, 1, 67, '2015-09-04 08:59:26', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (73, 71, 113, 114, 2, 74, '2015-09-04 09:08:05', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (72, 71, 115, 116, 2, 73, '2015-09-04 09:07:09', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (75, 71, 117, 118, 2, 76, '2015-09-04 09:09:43', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (74, 71, 119, 120, 2, 75, '2015-09-04 09:08:59', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (76, 71, 121, 122, 2, 77, '2015-09-04 09:10:24', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (77, 71, 123, 124, 2, 78, '2015-09-04 09:10:54', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (71, 1, 112, 125, 1, 72, '2015-09-04 09:06:14', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (84, 78, 127, 128, 2, 85, '2015-09-04 09:31:34', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (81, 78, 133, 134, 2, 82, '2015-09-04 09:28:35', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (83, 78, 135, 136, 2, 84, '2015-09-04 09:30:41', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (82, 78, 137, 138, 2, 83, '2015-09-04 09:29:25', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (78, 1, 126, 139, 1, 79, '2015-09-04 09:26:36', '2015-09-15 07:15:31');
INSERT INTO public.dcmdgrps (id, parent_id, lft, rgt, depth, dcmodel_id, created_at, updated_at) VALUES (1, null, 1, 140, 0, 1, '2015-08-23 06:01:37', '2015-09-15 07:15:31');

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
