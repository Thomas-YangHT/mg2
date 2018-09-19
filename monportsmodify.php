<?php
session_start(); 
if(!isset($_SESSION['login_status']))    
	header('Location:/dockermg/login.html');
?>
<?php
$sqlSVR       = "localhost";
$sqlUSER      = "root";
$sqlPASS      = "";

monportsrela();

function  monportsrela(){
         if(isset($_POST['addmonports'])){     
             addmonports();
         }
         if(isset($_POST['modmonports'])){  
             mysqlgetmonports();   
             updatemonports();
         }
         if(isset($_POST['delmonports'])){     
             mysqlgetmonports();
             delmonports();
         }
         mysqlgetmonports();
         show_part0();
         show_monports_part1();
} 

function mysqlgetmonports(){
  global $sqlSVR;
  global $sqlPASS;
  global $sqlUSER;

  $con=mysql_pconnect($sqlSVR, $sqlUSER, $sqlPASS);
  if (!$con) { die('Could not connect: ' . mysql_error());  }
  mysql_select_db("moninfo");
  mysql_query("SET NAMES UTF8");
  $SQL = "SELECT * from monports order by id";
  $res=mysql_query($SQL);
  global $monportss;
    
  $id=array();
  $monportss=array();
  while($row=mysql_fetch_array($res))  {
       array_push($id,$row['id']);
       $monportss[]=$row;
   }
   array_multisort($id, SORT_ASC, $monportss);

   mysql_free_result($res);
   mysql_close($con);
} 

function addmonports(){ 
  global $sqlSVR;
  global $sqlPASS;
  global $sqlUSER;
  
  $con=mysql_pconnect($sqlSVR, $sqlUSER, $sqlPASS);
  if (!$con) { die('Could not connect: ' . mysql_error());  }
  mysql_select_db("moninfo");

  $SQL = "insert into  monports(id,portsnames,ports,protocols,remark) values('','','','','')";
  writelog(date("Y.m.d H:i:sa l")." user: ".$_SESSION['user']." from ".$_SERVER['REMOTE_ADDR']." addmonports sql:".$SQL);
  $res=mysql_query($SQL)  or die("$SQL执行失败".mysql_error());

  mysql_free_result($res);
  mysql_close($con); 
}
   
function updatemonports(){ 
  global $sqlSVR;
  global $sqlPASS;
  global $sqlUSER;

  $con=mysql_pconnect($sqlSVR, $sqlUSER, $sqlPASS);
  if (!$con) { die('Could not connect: ' . mysql_error());  }
  mysql_select_db("moninfo");
  $SQL = "";
  global $monportss;

  for ($i=0; $i<count($monportss); $i++) {
      if( !empty($_REQUEST["id".$monportss[$i]['Idd']]) ){
           $SQL = "update monports set ";
           $SQL.= " portsnames=\"".$_POST[id.$monportss[$i]['Idd'].'portsnames']."\",";
           $SQL.= " ports=\"".$_POST[id.$monportss[$i]['Idd'].'ports']."\",";
           $SQL.= " protocols=\"".$_POST[id.$monportss[$i]['Idd'].'protocols']."\""; 
           $SQL.= " remark=\"".$_POST[id.$monportss[$i]['Idd'].'remark']."\""; 
		   $SQL.= " id=\"".$_POST[id.$monportss[$i]['Idd'].'id']."\""; 
           $SQL.= " where Idd=\"".$monportss[$i]['Idd']."\"";
           writelog(date("Y.m.d H:i:sa l")." user: ".$_SESSION['user']." from ".$_SERVER['REMOTE_ADDR']." updatemonports sql:".$SQL);
           $res=mysql_query($SQL) or die("update执行失败".mysql_error());
      }
  } 

   mysql_free_result($res);
   mysql_close($con);
}
   
function delmonports(){ 
  global $sqlSVR;
  global $sqlPASS;
  global $sqlUSER;

  $con=mysql_pconnect($sqlSVR, $sqlUSER, $sqlPASS);
  if (!$con) { die('Could not connect: ' . mysql_error());  }
  mysql_select_db("moninfo");
  $SQL = "";
  global $monportss;

  for ($i=0; $i<count($monportss); $i++) {
      if( !empty($_REQUEST["id".$monportss[$i]['Idd']]) ){
           $SQL = "delete from monports where Idd=\"".$monportss[$i]['Idd']."\"";
           writelog(date("Y.m.d H:i:sa l")." user: ".$_SESSION['user']." from ".$_SERVER['REMOTE_ADDR']." delmonports sql:".$SQL);
           $res=mysql_query($SQL) or die("delete执行失败".mysql_error());
      }
  } 

   mysql_free_result($res);
   mysql_close($con);
}

 
function  show_part0(){
 echo "<html> \n";
 echo "<head> \n";
 echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>\n";
 global $freshtime;
 echo "<meta http-equiv='refresh' content='$freshtime'>\n";
 echo "<title>right</title>\n";
 
 echo '<style type="text/css">'."\n";
 echo "body { \n";
 echo "	 margin:0;  \n";
 echo "	 padding:0;		  \n";
 echo "	 text-align:left; \n";
 echo "/*	 background:#33c26a; */\n";
 echo "	 font-size: 12px; \n";
 echo "	/* font-family:Arial, Helvetica, sans-serif;	*/\n";
 echo "}	\n";
 echo "div#first{\n";
 echo "   color: #0000ff;\n";
 //echo "   border:0; \n";
 //echo "   border-top:1px solid #aaa; \n";
 //echo "   border-bottom:1px solid #aaa; \n";
 echo "   } \n";
 echo "div#second{ \n";
 echo "   color: #767D2D;  \n";
 echo "   text-align:left;\n";
 //echo "   border:0; \n";
 //echo "   border-top:1px solid #aaa; \n";
 //echo "/*   border-bottom:1px solid #aaa; */\n";
 echo "   } \n";
 echo "div#third{ \n";
 echo "   color: #342D7E;  \n";
 echo "   text-align:left;\n";
 //echo "   border:0; \n";
 //echo "   border-top:1px solid #aaa; \n";
 //echo "/*   border-bottom:1px solid #aaa; */\n";
 echo "} \n";
 echo "  div#crontabfour{  \n";
 echo "   color: #342D7E;  \n";
 echo "   text-align:left; \n";
 echo "   border:0;    \n";
 echo "   border-top:1px solid #aaa;  \n";
 echo "/*   border-bottom:1px solid #aaa; */ \n";
 echo "}    \n";
 echo "div#green{ \n";
 echo "   color: green;  \n";
 echo "   text-align:left;\n";
 echo "   border:0; \n";
 echo "   border-top:1px solid #aaa; \n";
 echo "   border-bottom:1px solid #aaa; \n";
 echo "   cursor:hand; \n";  
 echo "} \n";
 echo "div#red{ \n";
 echo "   color: red;  \n";
 echo "   text-align:left;\n";
 echo "   border:0; \n";
 echo "   border-top:1px solid #aaa; \n";
 echo "   border-bottom:1px solid #aaa; \n";
 echo "   cursor:hand; \n";  
 echo "} \n";
 echo "div#blue{ \n";
 echo "   color: blue;  \n";
 echo "   text-align:left;\n";
 echo "   border:0; \n";
 echo "   border-top:1px solid #aaa; \n";
 echo "   border-bottom:1px solid #aaa; \n";
 echo "   cursor:hand; \n";  
 echo "} \n";
 echo "div#blueno{ \n";
 #echo "   color: blue;  \n";
 echo "   text-align:left;\n";
 echo "   border:0; \n";
 echo "   border-top:1px solid #aaa; \n";
 echo "   border-bottom:1px solid #aaa; \n";
 #echo "   cursor:hand; \n";  
 echo "} \n";
 echo "div#rkey{ \n";
 echo "    color: blue;  \n";
 echo "    float:left;\n";
 echo "} \n";
 echo "div#rvalue{ \n";
 echo "    color:#996600;  \n";
 echo "    float:left;\n";
 echo "} \n";
 echo "div#groupfirst{\n";
 echo "   color: #0000ff;\n";
 //echo "   border:0; \n";
 //echo "   border-top:1px solid #aaa; \n";
 //echo "/*   border-bottom:1px solid #aaa; */\n";
 echo "   } \n";
 echo "/* div#first ul{list-style-type:none; margin:0;width:100%; } */\n";
 echo "div#first ul{list-style-type:none; margin:0;width:1100; }\n";
 echo "div#first ul li{ width:20%; float:left;} \n";
 echo "div#second ul{list-style-type:none; margin:0;width:100%; }\n";
 echo "div#second ul li{ width:45%; float:left;} \n";
 echo "div#third ul{list-style-type:none; margin:0;width:100%; }\n";
 echo "div#third ul li{ width:45%; float:left;} \n";
 echo "div#crontabfour ul{list-style-type:none; margin:0;width:100%; } \n";
 echo "div#crontabfour ul li{ width:50%; float:left;}   \n";
 echo "div#groupfirst ul{list-style-type:none; margin:0;width:100%; }\n";
 echo "div#groupfirst ul li{ width:12%; float:left;} \n";
 echo "div#uncheckedfirst ul{list-style-type:none; margin:0;width:100%; }\n";
 echo "div#uncheckedfirst ul li{ width:8%; float:left;} \n";
 echo "div#serverrolefirst ul{list-style-type:none; margin:0;width:100%; }\n";
 echo "div#serverrolefirst ul li{ width:14%; float:left;} \n";
 echo "div#hostfirst ul{list-style-type:none; margin:0;width:100%; }\n";
 echo "div#hostfirst ul li{ width:14%; float:left;} \n";
  
 /* shiny blue (inspired by rdio iphone interface)
*******************************************************************************/
 echo ".shiny-blue {\n";  
 echo "  background-color: #759ae9;\n";  
 echo "  background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #759ae9), color-stop(50%, #376fe0), color-stop(50%, #1a5ad9), color-stop(100%, #2463de));\n";
 echo "  background-image: -webkit-linear-gradient(top, #759ae9 0%, #376fe0 50%, #1a5ad9 50%, #2463de 100%);\n";
 echo "  background-image: -moz-linear-gradient(top, #759ae9 0%, #376fe0 50%, #1a5ad9 50%, #2463de 100%);\n";
 echo "  background-image: -ms-linear-gradient(top, #759ae9 0%, #376fe0 50%, #1a5ad9 50%, #2463de 100%); \n";
 echo "  background-image: -o-linear-gradient(top, #759ae9 0%, #376fe0 50%, #1a5ad9 50%, #2463de 100%);\n";
 echo "  background-image: linear-gradient(top, #759ae9 0%, #376fe0 50%, #1a5ad9 50%, #2463de 100%);\n";
 echo "  border-top: 1px solid #1f58cc;\n";
 echo "  border-right: 1px solid #1b4db3;\n";
 echo "  border-bottom: 1px solid #174299; \n";
 echo "  border-left: 1px solid #1b4db3; \n";
 echo "  border-radius: 4px; \n";
 echo "  -webkit-box-shadow: inset 0 0 2px 0 rgba(57, 140, 255, 0.8);\n";
 echo "  box-shadow: inset 0 0 2px 0 rgba(57, 140, 255, 0.8); \n";
 echo "  color: #fff; \n";
 echo "  font: bold 12px/1 \"helvetica neue\", helvetica, arial, sans-serif;\n";
 echo "  padding: 7px 0; \n";
 echo "  text-shadow: 0 -1px 1px #1a5ad9;\n";
 echo "  width: 80px; } \n";
 echo ".shiny-blue:hover { \n";
 echo "    background-color: #5d89e8;\n";
 echo "    background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #5d89e8), color-stop(50%, #2261e0), color-stop(50%, #044bd9), color-stop(100%, #0d53de));\n";
 echo "    background-image: -webkit-linear-gradient(top, #5d89e8 0%, #2261e0 50%, #044bd9 50%, #0d53de 100%); \n";
 echo "    background-image: -moz-linear-gradient(top, #5d89e8 0%, #2261e0 50%, #044bd9 50%, #0d53de 100%); \n";
 echo "    background-image: -ms-linear-gradient(top, #5d89e8 0%, #2261e0 50%, #044bd9 50%, #0d53de 100%); \n";
 echo "    background-image: -o-linear-gradient(top, #5d89e8 0%, #2261e0 50%, #044bd9 50%, #0d53de 100%); \n";
 echo "    background-image: linear-gradient(top, #5d89e8 0%, #2261e0 50%, #044bd9 50%, #0d53de 100%); \n";
 echo "    cursor: pointer; } \n";
 echo ".shiny-blue:active { \n";
 echo "    border-top: 1px solid #1b4db3;\n";
 echo "    border-right: 1px solid #174299; \n";
 echo "    border-bottom: 1px solid #133780; \n";
 echo "    border-left: 1px solid #174299; \n";
 echo "    -webkit-box-shadow: inset 0 0 5px 2px #1a47a0, 0 1px 0 #eeeeee;\n";
 echo "    box-shadow: inset 0 0 5px 2px #1a47a0, 0 1px 0 #eeeeee; } \n";
 echo ".navPoint {COLOR: white; CURSOR: hand; FONT-FAMILY: Webdings; FONT-SIZE: 9pt}  \n";
 echo " table.table1{\n";
 echo "    font-family: 'Trebuchet MS', sans-serif;\n";
 echo "    font-size: 12px;  \n";
 echo "    font-weight: bold; \n";
 echo "    line-height: 1.4em; \n";
 echo "    font-style: normal;  \n";
 echo "    border-collapse:separate;  \n";
 echo "}  \n";
 echo ".table1 thead th{ \n";
 echo "    padding:1px;  \n";
 echo "    color:#fff;  \n";
 echo "    text-shadow:1px 1px 1px #568F23; \n";
 echo "    border:1px solid #93CE37;  \n";
 echo "    border-bottom:3px solid #9ED929; \n";
 echo "    background-color:#9DD929;  \n";
 echo "    background:-webkit-gradient(  \n";
 echo "        linear,  \n";
 echo "        left bottom,  \n";
 echo "        left top,  \n";
 echo "        right bottom,  \n";
 echo "        right top,  \n";
 echo "        color-stop(0.02, rgb(123,192,67)), \n";
 echo "        color-stop(0.51, rgb(139,198,66)),  \n";
 echo "        color-stop(0.87, rgb(158,217,41))  \n";
 echo "        );  \n";
 echo "    background: -moz-linear-gradient( \n";
 echo "        center bottom,  \n";
 echo "        rgb(123,192,67) 2%,  \n";
 echo "        rgb(139,198,66) 51%,  \n";
 echo "        rgb(158,217,41) 87%  \n";
 echo "        );  \n";
 echo "    -webkit-border-top-left-radius:5px; \n";
 echo "    -webkit-border-top-right-radius:5px;  \n";
 echo "    -webkit-border-bottom-left-radius:5px;  \n";
 echo "    -webkit-border-bottom-right-radius:5px;  \n";
 echo "    -moz-border-radius:5px 5px 0px 0px;  \n";
 echo "    border-top-left-radius:5px;  \n";
 echo "    border-top-right-radius:5px;  \n";
 echo "    border-bottom-left-radius:5px;  \n";
 echo "    border-bottom-right-radius:5px;      \n";
 echo "}  \n";
 echo "</style> \n"; 
 
 echo "<SCRIPT LANGUAGE='JavaScript'>\n";
 echo " function switchSysBar(t,m){ \n";
 echo "   if (t.innerText==5){  \n";
 echo "         t.innerText=6  \n";
 echo "         m.style.display='none' \n";
 echo "   }else{  \n";
 echo "         t.innerText=5 \n";
 echo "         m.style.display='' \n";
 echo "}}  \n";
 echo " function selectall(t){  \n";
 echo "    for(var i=0;i<document.form3.length;i++){   \n";
 echo "       var element=document.form3[i];    \n";
 echo "       if(element.type=='checkbox' && t.checked==true){    \n";
 echo "          element.checked=true;    \n";
 echo "       }    \n";
 echo "       if(element.type=='checkbox' && t.checked==false){    \n";
 echo "          element.checked=false;    \n";
 echo "       }    \n";
 echo "    }    \n";
 echo " }  \n";

 echo "  function Mcheck() { \n";
 echo '     var confirmstr="确定要继续吗?"; '."\n";
 echo '     if(document.getElementByid("box3").checked == true){  '."\n";
 echo '        confirmstr="   执行命令："+document.form1.cmdtestname.value+"\n\n\n                     确定要继续吗?" ;'."\n";
 echo '     }else  if(document.getElementByid("box1").checked == true){ '."\n";
 echo '        confirmstr="   执行命令："+document.form1.selectcmd.value+"\n\n\n                     确定要继续吗?" ;  '."\n";
 echo '     }else  if(document.getElementByid("box2").checked == true){ '."\n";
 echo '        confirmstr="   执行命令："+document.form1.selectcmd2.value+"\n\n\n                     确定要继续吗?" ;  '."\n";
 echo "     } \n";
 echo "        if(!window.confirm(confirmstr))  {\n";
 echo "           return(false);\n";
 echo "	      }else  { \n";
 echo "	 				 document.form1.submit.disabled=true;\n";
 echo "	 				 return(true);\n";
 echo "				}	\n";
 echo "  }\n";

 echo "  function review(t) { \n";
 echo '       var confirmstr="确定继续吗？";'."\n";
 echo "       if(t.name=='submit31'){"."\n";
 echo '             confirmstr="    审核会将选择的主机提交到相应项目中使用\n\n\n                    确定要继续吗?";'."}\n";
 echo "       if(t.name=='submit32'){"."\n";
 echo '             confirmstr="    删除会将选择的主机从数据库中删除！！！\n\n\n                    确定要继续吗?";'."}\n";
 echo "       if(t.name=='submit33'){"."\n";
 echo '             confirmstr="    审核会将选择的主机提交到相应项目中使用\n\n\n                    确定要继续吗?";'."}\n";
 echo "       if(t.name=='submitremove'){ \n";
 echo '             confirmstr="    移除是将选择的主机从项目组移到待审核主机列表\n\n\n                    确定要继续吗?";'."}\n";
 echo "       if(!window.confirm(confirmstr))  {\n";
 echo "           return(false);\n";
 echo "	      }else  { \n";
 echo "	 				 return(true);\n";
 echo "				}	\n";
 echo "  }\n";
  
 echo "function ShowHidden(obj1){\n";
 echo '	//alert("obj1"+obj1);'."\n";
 echo '    if(obj1.style.display==""){'."\n";
 echo '	        obj1.style.display = "none";'."\n";
 echo "    }else{\n";
 echo '	        obj1.style.display = "";'."\n";
 echo "    }\n";
 echo "} \n"; 
 
 echo " function   Run(strPath)   {\n";
 echo "   try   { \n";
 echo '     var   objShell   =   new   ActiveXObject("wscript.shell");'."\n";
 echo "     objShell.Run(strPath); \n";
 echo "     objShell   =   null;\n";
 echo "   } \n";
 echo "   catch   (e){alert('找不到文件\"'+strPath+'\"(或它的组件之一)。请确定路径和文件名是否正确，而且所需的库文件均可用。请更改你的IE的安全级别：开始->设置->控制面板->Internet选项->安全->自定义级别->对没有标记为安全的ActiveX控件进行初始化和脚本运行->启用')\n";
 echo "   }\n";
 echo "}\n";
 echo " function   valuechange(t,m)   {\n";
 echo "   m.value=t.value; \n";
 echo "}\n";
 echo " function   valuechange2(t,m,n,l)   {\n";
 echo "   t.value=m+\"_\"+l.value+\"_\"+n.value+\".sh\"; \n";
 echo "}\n"; 
 echo "</SCRIPT>\n";
 echo "</head>\n";
 echo "<body  >\n";

}

function  show_monports_part1(){
     global $monportss;

     echo "<TABLE class='table1' width='100%'>  \n"; 
     echo "<thead ><TR ><Th width='100%' style='BACKGROUND-COLOR:rgb(71, 193, 168); border-bottom:3px solid rgb(71, 193, 168)'  onClick='switchSysBar(switchPoint1,hostfirst);'>\n";
     echo "<font style='FONT-SIZE: 10pt; CURSOR: default; COLOR: #ffffff;float:left;'>   \n";
     echo "<span class='navPoint' id='switchPoint1' title='关闭/打开'>5</span>端口信息编辑：</font>\n";
		 echo "</Th> </TR> </thead> </TABLE> \n";
     echo "<div id='hostfirst'> \n ";
     echo "<h3><input type='checkbox' name='allunchecked' onclick='selectall(this)' />全选/取消</h3>\n";
     echo "<ul> \n";  
     echo "<form name='form3' action='$PHP_SELF' method='post' > \n";   
	 echo "	<li style='width:2%'>&nbsp&nbsp</li><li style='width:3%'><div id='rkey'>id:</div></li>\n";
	 echo "	<li style='width:35%'><div id='rkey'>portsnames:</div></li>\n";
     echo "	<li style='width:40%'><div id='rkey'>ports:</div></li> \n";		
     echo "	<li style='width:10%'><div id='rkey'>protocols:</div></li> \n";
     echo "	<li style='width:10%'><div id='rkey'>remark:</div></li> \n";
	 echo " </br>\n";

     for ($i=0; $i<count($monportss); $i++) {
            echo " <input type='checkbox' style='float:left' name='id".$monportss[$i]['Idd']."' />\n";
            echo "	<li style='width:3%'><div id='rvalue'><input style='width:350%' type='text' name='id".$monportss[$i]['Idd']."id' value='".$monportss[$i]['id']."'/></div></li>\n";
            echo "	<li style='width:35%'><div id='rvalue'><input style='width:350%' type='text' name='id".$monportss[$i]['Idd']."portsnames' value='".$monportss[$i]['portsnames']."'/></div></li>\n";
         	echo "	<li style='width:40%'><div id='rvalue'><input style='width:400%' type='text' name='id".$monportss[$i]['Idd']."ports' value='".$monportss[$i]['ports']."'/></div></li> \n";		
         	echo "	<li style='width:10%'><div id='rvalue'><input style='width:300%' type='text' name='id".$monportss[$i]['Idd']."protocols' value='".$monportss[$i]['protocols']."' /></div></li> \n";
         	echo "	<li style='width:10%'><div id='rvalue'><input style='width:300%' type='text' name='id".$monportss[$i]['Idd']."remark' value='".$monportss[$i]['remark']."' /></div></li> \n";		
		    echo " </br>\n";
     } 
     echo " <li style='width:100%'>&nbsp&nbsp</li>\n";
	 echo "<li style='width:100%'> &nbsp&nbsp说明：id表示分组号；protocols中T表示TCP端口，U表示UDP端口，与portsnames、ports列，以及IP端口设置页的monif列，都是一一对应关系，合起来表示设定某个IP的哪个协议的端口需要监控，</li>";
	 echo " <li style='width:100%'>&nbsp&nbsp</li>\n";
     echo "<input name='addmonports' class='shiny-blue' type='submit' value='增加' onclick=''/> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp\n";
     echo "<input name='modmonports' class='shiny-blue' type='submit' value='修改' onclick=''/> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp\n";
     echo "<input name='delmonports' class='shiny-blue' type='submit' value='删除' onclick=''/> \n";     
     echo "</form>\n"; 
     echo "</ul> \n";
     echo "</div> \n";
     echo "<br><br><br><br><br><br>\n";

} 

function  writelog($logstr){
         $fp = fopen("/root/dk.log", "a");      
          if($fp) {                              
            fwrite($fp,$logstr."\n");                              
          }else {                                 
            echo "打开文件失败:/root/dk.log";
          }
          fclose($fp);
}
 
?>