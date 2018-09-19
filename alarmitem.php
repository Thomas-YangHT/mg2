<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
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
<title>报警项</title>
</head>
<?php
function getalarmiteminfo(){
		set_include_path(get_include_path() . ':' . "../dockermg/");
		include_once("dkconfig.php");
		//global $MysqlHost;
		//global $MysqlPass;
		//global $MysqlUser;
		//global $dkdb;
		$conn=mysql_connect($MysqlHost,$MysqlUser,$MysqlPass)	or die("无法连接数据库，请重来");
		mysql_select_db($dkdb,$conn);
        mysql_query("SET NAMES UTF8");
        $sql = "select * from moninfo.alarmitem ";
        $res=mysql_query($sql,$conn);
        $rows=mysql_affected_rows($conn);//获取行数
        $colums=mysql_num_fields($res);//获取列数
        while($row=mysql_fetch_array($res)){
			echo "<tr class='text-c' >\n";
            echo "<td>".$row['item']."</td>\n"; 
			echo "<td>".$row['value']."</td>\n";
			echo "<td>".$row['explain']."</td>\n";
            echo "</tr>\n";
        }
}
?>
<body >
<div class="page-container">
	<!--<p class="f-20 text-success">欢迎使用迅合云服务管理系统 <span class="f-14">v2.0</span></p>
	<p>登录次数：18 </p>
	<p>上次登录IP：222.35.131.79.1  上次登录时间：2014-6-14 11:19:55</p>
	-->
	<table class="table table-border table-bordered table-bg">
		<thead>
			<tr>
				<th colspan="7" scope="col">报警项列表</th>
			</tr>
			<tr class="text-c">
				<th>报警项</th>
				<th>设定值</th>
				<th>说明</th>
			</tr>
		</thead>
		<tbody>
		<?php
				getalarmiteminfo();
		?>
		</tbody>
	</table>

</div>
<footer class="footer mt-20">
	<div class="container">
		<p><br></p>
	</div>
</footer>
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="static/h-ui/js/H-ui.min.js"></script> 

</body>
</html>