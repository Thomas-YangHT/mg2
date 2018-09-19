<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>迅和云项目监控管理系统</title>
<meta name="keywords" content="H-ui.admin v3.0,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.0，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<header class="navbar-wrapper">
	<div class="navbar navbar-fixed-top">
		<div class="container-fluid cl"> <a class="logo navbar-logo f-l mr-10 hidden-xs" href="/aboutHui.shtml">迅合云服务管理系统</a> <a class="logo navbar-logo-m f-l mr-10 visible-xs" href="/aboutHui.shtml">H-ui</a> <span class="logo navbar-slogan f-l mr-10 hidden-xs">v2.0</span> <a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
			<nav class="nav navbar-nav">
		<!--
				<ul class="cl">
					<li class="dropDown dropDown_hover"><a href="javascript:;" class="dropDown_A"><i class="Hui-iconfont">&#xe600;</i> 新增 <i class="Hui-iconfont">&#xe6d5;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="javascript:;" onclick="article_add('添加资讯','article-add.html')"><i class="Hui-iconfont">&#xe616;</i> 资讯</a></li>
							<li><a href="javascript:;" onclick="picture_add('添加资讯','picture-add.html')"><i class="Hui-iconfont">&#xe613;</i> 图片</a></li>
							<li><a href="javascript:;" onclick="product_add('添加资讯','product-add.html')"><i class="Hui-iconfont">&#xe620;</i> 产品</a></li>
							<li><a href="javascript:;" onclick="member_add('添加用户','member-add.html','','510')"><i class="Hui-iconfont">&#xe60d;</i> 用户</a></li>
						</ul>
					</li>
				</ul>
		-->
			</nav>
			<nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
				<ul class="cl">
					<!--<li>超级管理员</li>
					<li class="dropDown dropDown_hover"> <a href="#" class="dropDown_A">admin <i class="Hui-iconfont">&#xe6d5;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="#">个人信息</a></li>
							<li><a href="#">切换账户</a></li>
							<li><a href="#">退出</a></li>
						</ul>
					</li>
					<li id="Hui-msg"> <a href="#" title="消息"><span class="badge badge-danger">1</span><i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i></a> </li>
					-->
					<li id="Hui-skin" class="dropDown right dropDown_hover"> <a href="javascript:;" class="dropDown_A" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="javascript:;" data-val="blue" title="默认（蓝色）">默认（蓝色）</a></li>
							<li><a href="javascript:;" data-val="default" title="黑色">黑色</a></li>
							<li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
							<li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
							<li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
							<li><a href="javascript:;" data-val="orange" title="绿色">橙色</a></li>
						</ul>
					</li>
				</ul>
			</nav>
		</div>
	</div>
</header>
<aside class="Hui-aside">
	<input runat="server" id="divScrollValue" type="hidden" value="" />
  <?php
    set_include_path(get_include_path() . ':' . "../dockermg/");
    include_once("dkconfig.php");
	include_once("dkcommon.php");
	include_once("proj.inc.php");
	GetProjData();
  ?>
	<div class="menu_dropdown bk_2">
		<dl id="menu-article">
			<dt><i class="Hui-iconfont">&#xe616;</i> 监控管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					  <li><a data-href='welcome.php'     data-title="[总览]"           href="javascript:void(0)" >[总览]</a></li>
					  <li><a data-href='/qinmonitor/portstatus.php'  data-title="[端口状态]"       href="javascript:void(0)" >[端口状态]</a></li>
					  <li><a data-href='/qinmonitor/moninfo.php'     data-title="[服务器负载]"     href="javascript:void(0)" >[服务器负载]</a></li>
					  <li><a data-href='/ichart/loadichart.php'      data-title="[24小时负载图形]" href="javascript:void(0)" >[24小时负载图形]</a></li>
					  <li><a data-href='/qinmonitor/portinfo.php'    data-title="[服务器进程]"     href="javascript:void(0)" >[服务器进程]</a></li>
					  <li><a data-href='redisinfo.php'              data-title="[redis状态]"       href="javascript:void(0)" >[redis状态]</a></li>
					  <li><a data-href='http://172.16.30.2/smokeping/sm.cgi?target=Other'    data-title="[到各地网络状况]"     href="javascript:void(0)" >[到各地网络状况]</a></li>
					  <li><a data-href='monportsmodify.php'    data-title="[端口信息修改]"       href="javascript:void(0)" >[端口信息修改]</a></li>
					  <li><a data-href='pstatussetmodify.php'  data-title="[端口IP修改]"         href="javascript:void(0)" >[端口IP修改]</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-article">
			<dt><i class="Hui-iconfont">&#xe616;</i> 测试版程序启停<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
			      <li><a data-href='/dockermg/dkopproj.php'         data-title="[所有项目]"  href="javascript:void(0)" >[所有项目]</a></li>
				  <?php
					for($i=0;$i<count($projnames);$i++){
						echo    "<li><a data-href='/dockermg/dkopproj.php?projname=".$projnames[$i]."'   data-title='测启".$projnames[$i]."'  href=\"javascript:void(0)\"  >[测启".$projnames[$i]."]</a></li>";
					}   
				  ?>
				</ul>
			</dd>
		</dl>		
		<dl id="menu-article">
			<dt><i class="Hui-iconfont">&#xe616;</i> 测试版发布管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
				  <?php
					for($i=0;$i<count($projnames);$i++){
    					echo    "<li><a data-href='/dockermg/projframe.php?projname=".$projnames[$i]."'  data-title='测发".$projnames[$i]."'  href=\"javascript:void(0)\"  >[测发".$projnames[$i]."]</a></li>";
					}   
				  ?>
				</ul>
			</dd>
		</dl>
		<dl id="menu-article">
			<dt><i class="Hui-iconfont">&#xe616;</i> 在线版程序启停<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
			  <ul>
				<?php
					GetProcIPSetting();
					echo    "<li><a data-href='/qinmonitor/procoper.php'   data-title='正启所有程序'  href=\"javascript:void(0)\"  >[正启所有程序]</a></li>";
					for($i=0;$i<count($procipres);$i++){
						echo    "<li><a data-href='/qinmonitor/procoper.php?procip=".$procipres[$i]."'   data-title='正启".$procipres[$i]."'  href=\"javascript:void(0)\"  >[正启".$procipres[$i]."]</a></li>";
					}   
				?>  			   
				</ul>
			</dd>
		</dl>		
		<dl id="menu-article">
			<dt><i class="Hui-iconfont">&#xe616;</i> 在线版发布管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
				  <?php
					for($i=0;$i<count($projnames_online);$i++){ 
						echo    "<li><a data-href='/dockermg/projframe.php?projname=".$projnames_online[$i]."&dk=no'   data-title='正发".$projnames_online[$i]."'  href=\"javascript:void(0)\"  >[正发".$projnames_online[$i]."]</a></li>";
					}   
				  ?>
				</ul>
			</dd>
		</dl>		
		<dl id="menu-article">
			<dt><i class="Hui-iconfont">&#xe616;</i> 主机管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
				      <li><a data-href='hostip.php'                data-title="[所有资源]"      href="javascript:void(0)" >[所有资源]</a></li>
					  <li><a data-href='hostip.php?type=host'      data-title="[主机列表]"      href="javascript:void(0)" >[主机列表]</a></li>
					  <li><a data-href='hostip.php?type=mysql'     data-title="[数据库列表]"    href="javascript:void(0)" >[数据库列表]</a></li>
					  <li><a data-href='hostip.php?type=redis'     data-title="[缓存列表]"      href="javascript:void(0)" >[缓存列表]</a></li>
					  <li><a data-href='hostipmodify.php'          data-title="[主机增删改]"    href="javascript:void(0)" >[主机增删改]</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-article">
			<dt><i class="Hui-iconfont">&#xe616;</i> 容器管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					  <li><a data-href='/dockermg/dockerstatus.php'     data-title="[容器状态]"       href="javascript:void(0)" >[容器状态]</a></li>
					  <li><a data-href='/dockermg/dockercreate.php'     data-title="[容器创建]"       href="javascript:void(0)" >[容器创建]</a></li>
					  <li><a data-href='/dockermg/dkopcont.php'         data-title="[容器启停]"       href="javascript:void(0)" >[容器启停]</a></li>
					  <li><a data-href='dkhostmodify.php'               data-title="[Docker主机管理]" href="javascript:void(0)" >[Docker主机管理]</a></li>					  
				</ul>
			</dd>
		</dl>
		<dl id="menu-article">
			<dt><i class="Hui-iconfont">&#xe616;</i> 项目增减<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
				      <li><a data-href='svnmodify.php'                data-title="[SVN项目管理]"     href="javascript:void(0)" >[SVN项目管理]</a></li>
					  <li><a data-href='dkprojmodify.php'             data-title="[测试项目管理]"    href="javascript:void(0)" >[测试项目管理]</a></li>
					  <li><a data-href='procsettingmodify.php'        data-title="[在线项目管理]"    href="javascript:void(0)" >[在线项目管理]</a></li>		  

				</ul>
			</dd>
		</dl>		
		<dl id="menu-article">
			<dt><i class="Hui-iconfont">&#xe616;</i> 报警管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					  <li><a data-href='unnormal.php'          data-title="[报警信息]"      href="javascript:void(0)" >[报警信息]</a></li>
					  <li><a data-href='alarmitem.php'         data-title="[报警项]"        href="javascript:void(0)" >[报警项]</a></li>
					  <li><a data-href='dutyassign.php'        data-title="[报警人员]"      href="javascript:void(0)" >[报警人员]</a></li>
					  <li><a data-href='alarmitemmodify.php'   data-title="[监控项管理]"    href="javascript:void(0)" >[监控项管理]</a></li>
					  <li><a data-href='dutyassignmodify.php'  data-title="[监控人员管理]"  href="javascript:void(0)" >[监控人员管理]</a></li>
				</ul>
			</dd>
		</dl>	
		<dl id="menu-article">
			<dt><i class="Hui-iconfont">&#xe616;</i> 操作日志<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					  <li><a data-href='/dockermg/tailffile.php'   data-title="[查询日志]"              href="javascript:void(0)" >[查询日志]</a></li>
					  <li><a data-href='/dockermg/mtailffile.php'  data-title="[查询多IP项目日志]"     href="javascript:void(0)" >[查询多IP项目日志]</a></li>
					  <li><a data-href='showoplog.php'             data-title="[查询本系统操作日志]"   href="javascript:void(0)" >[本系统操作日志]</a></li>
					 <!-- <li><a data-href='/dockermg/mtailffile.php'  data-title="[分析TOMCAT日志]"        href="javascript:void(0)" >[分析TOMCAT日志]</a></li> -->
					  <li><a data-href='http://172.16.30.2:5601'      data-title="[kibana示例]"         href="javascript:void(0)" >[kibana示例]</a></li>
					  <li><a data-href='http://172.16.30.2:9090'      data-title="[cockpit示例]"        href="javascript:void(0)" >[cockpit示例]</a></li>
					  <li><a data-href='http://172.16.30.2:18080/ui'  data-title="[kubernetes示例]"     href="javascript:void(0)" >[kubernetes示例]</a></li>
				</ul>
			</dd>
		</dl>			
		<!--
		<dl id="menu-article">
			<dt><i class="Hui-iconfont">&#xe616;</i> 资讯管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="article-list.html" data-title="资讯管理" href="javascript:void(0)">资讯管理</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-picture">
			<dt><i class="Hui-iconfont">&#xe613;</i> 图片管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="picture-list.html" data-title="图片管理" href="javascript:void(0)">图片管理</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-product">
			<dt><i class="Hui-iconfont">&#xe620;</i> 产品管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="product-brand.html" data-title="品牌管理" href="javascript:void(0)">品牌管理</a></li>
					<li><a data-href="product-category.html" data-title="分类管理" href="javascript:void(0)">分类管理</a></li>
					<li><a data-href="product-list.html" data-title="产品管理" href="javascript:void(0)">产品管理</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-comments">
			<dt><i class="Hui-iconfont">&#xe622;</i> 评论管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="http://h-ui.duoshuo.com/admin/" data-title="评论列表" href="javascript:;">评论列表</a></li>
					<li><a data-href="feedback-list.html" data-title="意见反馈" href="javascript:void(0)">意见反馈</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-member">
			<dt><i class="Hui-iconfont">&#xe60d;</i> 会员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="member-list.html" data-title="会员列表" href="javascript:;">会员列表</a></li>
					<li><a data-href="member-del.html" data-title="删除的会员" href="javascript:;">删除的会员</a></li>
					<li><a data-href="member-level.html" data-title="等级管理" href="javascript:;">等级管理</a></li>
					<li><a data-href="member-scoreoperation.html" data-title="积分管理" href="javascript:;">积分管理</a></li>
					<li><a data-href="member-record-browse.html" data-title="浏览记录" href="javascript:void(0)">浏览记录</a></li>
					<li><a data-href="member-record-download.html" data-title="下载记录" href="javascript:void(0)">下载记录</a></li>
					<li><a data-href="member-record-share.html" data-title="分享记录" href="javascript:void(0)">分享记录</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-admin">
			<dt><i class="Hui-iconfont">&#xe62d;</i> 管理员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="admin-role.html" data-title="角色管理" href="javascript:void(0)">角色管理</a></li>
					<li><a data-href="admin-permission.html" data-title="权限管理" href="javascript:void(0)">权限管理</a></li>
					<li><a data-href="admin-list.html" data-title="管理员列表" href="javascript:void(0)">管理员列表</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-tongji">
			<dt><i class="Hui-iconfont">&#xe61a;</i> 系统统计<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="charts-1.html" data-title="折线图" href="javascript:void(0)">折线图</a></li>
					<li><a data-href="charts-2.html" data-title="时间轴折线图" href="javascript:void(0)">时间轴折线图</a></li>
					<li><a data-href="charts-3.html" data-title="区域图" href="javascript:void(0)">区域图</a></li>
					<li><a data-href="charts-4.html" data-title="柱状图" href="javascript:void(0)">柱状图</a></li>
					<li><a data-href="charts-5.html" data-title="饼状图" href="javascript:void(0)">饼状图</a></li>
					<li><a data-href="charts-6.html" data-title="3D柱状图" href="javascript:void(0)">3D柱状图</a></li>
					<li><a data-href="charts-7.html" data-title="3D饼状图" href="javascript:void(0)">3D饼状图</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-system">
			<dt><i class="Hui-iconfont">&#xe62e;</i> 系统管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="system-base.html" data-title="系统设置" href="javascript:void(0)">系统设置</a></li>
					<li><a data-href="system-category.html" data-title="栏目管理" href="javascript:void(0)">栏目管理</a></li>
					<li><a data-href="system-data.html" data-title="数据字典" href="javascript:void(0)">数据字典</a></li>
					<li><a data-href="system-shielding.html" data-title="屏蔽词" href="javascript:void(0)">屏蔽词</a></li>
					<li><a data-href="system-log.html" data-title="系统日志" href="javascript:void(0)">系统日志</a></li>
				</ul>
			</dd>
		</dl>
-->
	</div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<section class="Hui-article-box">
	<div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
		<div class="Hui-tabNav-wp">
			<ul id="min_title_list" class="acrossTab cl">
				<li class="active"><span title="总览" data-href="welcome.php">总览</span><em></em></li>
			</ul>
		</div>
		<div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a></div>
	</div>
	<div id="iframe_box" class="Hui-article">
		<div class="show_iframe">
			<div style="display:none" class="loading"></div>
			<iframe scrolling="yes" frameborder="0" src="welcome.php"></iframe>
		</div>
	</div>
</section>

<div class="contextMenu" id="Huiadminmenu">
	<ul>
		<li id="closethis">关闭当前 </li>
		<li id="closeall">关闭全部 </li>
	</ul>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="static/h-ui.admin/js/H-ui.admin.js"></script>
<!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="lib/jquery.contextmenu/jquery.contextmenu.r2.js"></script>
<script type="text/javascript">
$(function(){
	/*$("#min_title_list li").contextMenu('Huiadminmenu', {
		bindings: {
			'closethis': function(t) {
				console.log(t);
				if(t.find("i")){
					t.find("i").trigger("click");
				}		
			},
			'closeall': function(t) {
				alert('Trigger was '+t.id+'\nAction was Email');
			},
		}
	});*/
});

</script> 


</body>
</html>