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
<title>Redis实时信息</title>
</head>
<?php
function getredisinfo(){
		set_include_path(get_include_path() . ':' . "../dockermg/");
		include_once("dkconfig.php");
		//global $MysqlHost;
		//global $MysqlPass;
		//global $MysqlUser;
		//global $dkdb;
		$conn=mysql_connect($MysqlHost,$MysqlUser,$MysqlPass)	or die("无法连接数据库，请重来");
		mysql_select_db('moninfo',$conn);
        mysql_query("SET NAMES UTF8");
		$type=$_GET['type'];
        $sql = "select * from moninfo.redisinfo ";

        $res=mysql_query($sql,$conn);
        $rows=mysql_affected_rows($conn);//获取行数
        $colums=mysql_num_fields($res);//获取列数
		echo "<table class='table table-border table-bordered table-bg'>";
		echo "<thead>";
		echo "<tr>";
		echo "<th colspan='7' scope='col'>redis信息</th>";
		echo "</tr>";
		echo "<tr class='text-c'>";

        for($i=0; $i < $colums; $i++){
            $field_name=mysql_field_name($res,$i);
  	          echo "<th>".$field_name."</a></th>\n";
        }				
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";

        while($row=mysql_fetch_array($res)){
			echo "<tr class='text-c' >\n";
            for($i=0; $i<$colums; $i++){
				echo "<td>".$row[$i]."</td>\n";
			}
            echo "</tr>\n";
        }
		echo "</tbody>";
		echo "</table>\n";
}
?>
<body >
<div class="page-container">
	<!--<p class="f-20 text-success">欢迎使用迅合云服务管理系统 <span class="f-14">v2.0</span></p>
	<p>登录次数：18 </p>
	<p>上次登录IP：222.35.131.79.1  上次登录时间：2014-6-14 11:19:55</p>
	-->

		<?php
				getredisinfo();
		?>


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