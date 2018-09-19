<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="refresh" content="300" />
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
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
<title>DashBoard</title>
</head>
<?php
function gettotalinfo(){
		set_include_path(get_include_path() . ':' . "../dockermg/");
		include_once("dkconfig.php");
		//global $MysqlHost;
		//global $MysqlPass;
		//global $MysqlUser;
		//global $dkdb;
		$conn=mysql_connect($MysqlHost,$MysqlUser,$MysqlPass)	or die("无法连接数据库，请重来");
		mysql_select_db($dkdb,$conn);
        mysql_query("SET NAMES UTF8");
		//按类型分组查出总数、异常数（去掉close状态的）
        $sql = "select a.*,b.ecnt from (select type,count(*) as total from moninfo.hostip where status!='close' or status is null group by type ) as a ";
        $sql.= " left join (select count(*) as ecnt,type from moninfo.hostip where status!='running' and status!='close' group by type ) as b on a.type=b.type ";        
		//查docker总数、异常数
		$sql.= " union all select 'docker' as `type`,count(*) as total, 0 as ecnt from dockercontainers where cid<>'' and cid is not null";
		//查测试环境项目总数、异常数
		$sql.= " union all select p1.type,p1.total,p2.ecnt from ( select 'test' as type,count(p.pid) as total from  (";
		$sql.= " select a.ip,a.cid,a.cname,a.image,a.createtime,a.status, c.projname,c.progdir,c.startscript,c.stopscript,d.pid from dockercontainers as a inner join dkcreated as b on";
		$sql.= " a.cname=b.cname inner join dockerproject as c on b.project=c.projname left join dkprojstatus as d on d.cid=a.cid)as p)as p1";
        $sql.= " left join(select 'test' as `type`,count(p.pid) as ecnt from  (";
        $sql.= " select a.ip,a.cid,a.cname,a.image,a.createtime,a.status, c.projname,c.progdir,c.startscript,c.stopscript,d.pid from dockercontainers as a inner join dkcreated as b on";
		$sql.= " a.cname=b.cname inner join dockerproject as c on b.project=c.projname left join dkprojstatus as d on d.cid=a.cid";
        $sql.= " )as p where p.pid='' or p.pid is null )as p2 on p1.type=p2.type";
        //查正式环境项目总数、异常数
		$sql.= " union all select p1.type,p1.total,p2.ecnt from";
		$sql.= " (select 'online' as type,count(distinct projname) as total from moninfo.procsetting";
		$sql.= " where projname<>'' ";
		$sql.= " )as p1";
		$sql.= " left join ";
        $sql.= " (select 'online' as type,count(distinct projname) as ecnt from moninfo.procsetting";
        $sql.= " where projname<>'' and status=''";
		$sql.= " )as p2";
        $sql.= " on p1.type=p2.type";

        $res=mysql_query($sql,$conn);
        $rows=mysql_affected_rows($conn);//获取行数
        $colums=mysql_num_fields($res);//获取列数
        while($row=mysql_fetch_array($res)){
			if( empty($row['ecnt']) ){ $row['ecnt']=0; }
			echo "<tr class='text-c'>\n";
			if($row['type']=='host'){
				echo "<td>主机</td>\n"; 
			//	echo "<td><a data-href='hostip.php'     data-title='[所有资源]'      href='javascript:void(0)' >".$row['total']."</a></td>";
				echo "<td><a href='hostip.php?type=host'    title='' >".$row['total']."</a></td>\n";
				echo "<td><a href='unnormal.php'  title='' >".$row['ecnt']."</a></td>\n";
			}elseif($row['type']=='mysql'){ 
				echo "<td>数据库</td>\n"; 
				echo "<td><a href='hostip.php?type=mysql'    title='' >".$row['total']."</a></td>\n";
				echo "<td><a href='unnormal.php'  title='' >".$row['ecnt']."</a></td>\n"; 
			}elseif($row['type']=='redis'){ 
				echo "<td>缓存</td>\n"; 
				echo "<td><a href='hostip.php?type=redis'    title='' >".$row['total']."</a></td>\n";
				echo "<td><a href='unnormal.php'  title='' >".$row['ecnt']."</a></td>\n"; 				
			}elseif($row['type']=='docker'){ 
				echo "<td>容器</td>\n"; 
				echo "<td ><a href='/dockermg/dkopcont.php'  title='' >".$row['total']."</a></td>\n";
				echo "<td ><a href='/dockermg/dkopcont.php'  title='' >".$row['ecnt']."</a></td>\n";
			}elseif($row['type']=='test'){ 
				echo "<td>测试版项目</td>\n"; 
				echo "<td ><a href='/dockermg/dkopproj.php'  title='' >".$row['total']."</a></td>\n";
				echo "<td ><a href='/dockermg/dkopproj.php?status=error'  title='' >".$row['ecnt']."</a></td>\n";
			}elseif($row['type']=='online'){ 
				echo "<td>在线版项目</td>\n"; 
				echo "<td ><a href='/qinmonitor/procoper.php'  title='' >".$row['total']."</a></td>\n";
				echo "<td ><a href='/qinmonitor/procoper.php?status=error'  title='' >".$row['ecnt']."</a></td>\n";
			}else{ 
				echo "<td>".$row['type']."</td>\n"; 
				echo "<td><a href='hostip.php?type=".$row['type']."'  title='' >".$row['total']."</a></td>\n";
				echo "<td><a href='hostip.php?type=".$row['type']."'  title='' >".$row['ecnt']."</a></td>\n";
			}		
            echo "</tr>\n";
        }
}
?>
<body >
<div class="page-container">
	<p class="f-20 text-success">欢迎使用迅合云服务管理系统 <span class="f-14">v2.0</span></p>
	<!--<p>登录次数：18 </p>
	<p>上次登录IP：222.35.131.79.1  上次登录时间：2014-6-14 11:19:55</p>
	-->
	<table class="table table-border table-bordered table-bg">
		<thead>
			<tr>
				<th colspan="7" scope="col">资源信息统计</th>
			</tr>
			<tr class="text-c">
				<th>类别</th>
				<th>总数</th>
				<th>异常数</th>
			</tr>
		</thead>
		<tbody>
		<?php
				gettotalinfo();
		?>
		</tbody>
	</table>

</div>
<footer class="footer mt-20">
	<div class="container">
		<p>感谢:Wucj、Thomas<br>
			Copyright &copy;2015-2017 迅合云服务管理系统 v2.0 All Rights Reserved.<br>
			本后台系统由<a href="http://www.xunheyun.com/" target="_blank" title="迅合云">迅合云</a>提供技术支持</p>
	</div>
</footer>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="static/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="lib/jquery.contextmenu/jquery.contextmenu.r2.js"></script>
<!--_footer 作为公共模版分离出去-->

<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript">
$(function(){
});
</script>
</body>
</html>