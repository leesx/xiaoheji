<?php
include_once("config.php");

// $action = $_GET['action'];
// if($action=='send'){ //发表心情
// 	$id = (int)$_POST['id'];
// 	$mid = (int)$_POST['moodid'];
// 	if($mid<0 || !$id){
// 		echo "此链接不存在";exit;
// 	}

// 	$havemood = chk_mood($id);
// 	if($havemood==1){
// 		echo "您已经表达过心情了，保持平常心有益身心健康！";exit;
// 	}
// 	$field = 'mood'.$mid;
// 	$query = mysql_query("update mood set ".$field."=".$field."+1 where id=".$id);
// 	if($query){
// 		setcookie("mood".$id, $mid.$id, time()+3600);
// 		$query2 = mysql_query("select * from mood where id=$id");
// 		$rs = mysql_fetch_array($query2);
// 		$total = $rs['mood0']+$rs['mood1']+$rs['mood2']+$rs['mood3']+$rs['mood4']+$rs['mood5']+$rs['mood6']+$rs['mood7'];
// 		$height = round(($rs[$field]/$total)*$moodpicheight);
// 		echo $height;
// 	}else{
// 		echo -1;
// 	}
// }else{ //获取心情
// 	$mname = explode(',',$moodname);//心情说明
// 	$num = count($mname);
// 	$mpic = explode(',',$moodpic);//心情图标

// 	$id = (int)$_GET['id'];
// 	$query = mysql_query("select * from mood where id=$id");
// 	$rs = mysql_fetch_array($query);
// 	if($rs){
// 		$total = $rs['mood0']+$rs['mood1']+$rs['mood2']+$rs['mood3']+$rs['mood4']+$rs['mood5']+$rs['mood6']+$rs['mood7'];
// 		for($i=0;$i<$num;$i++){
// 			$field = 'mood'.$i;
// 			$m_val = intval($rs[$field]);
// 			$height = 0; //柱图高度
// 			if($total && $m_val){
// 				$height=round(($m_val/$total)*$moodpicheight); //计算高度
// 			}
			
// 			$arr[] = array(
// 				'mid' => $i,
// 				'mood_name' => $mname[$i],
// 				'mood_pic' => $mpic[$i],
// 				'mood_val' => $m_val,
// 				'height' => $height
// 			);
// 		}
// 		echo json_encode($arr);
// 	}
// }

 //print_r($_POST);
 $payitems = $_POST['payitems'][0];
 //print_r($payitems['name']);
 //$query = mysql_query("insert into todaypay values (0,{$payitems['name']},{$payitems['date']},{$payitems['price']})");
 $name = $payitems['name'];
 $date = $payitems['date'];
 $price = $payitems['price'];
 $str = "'{$date}'";
 // `` sql中的引号   注意PHP中变量名加引号
 $sql = "insert into todaypay (`name`,date,price) values ('{$name}','{$date}','{$price}')";
 $query = mysql_query($sql);
 if($query){
 	$json = "{'rs':true}"; 
 	echo json_encode($json);
 }else{
 	die('Could not enter data: ' . mysql_error());
 }
 //print_r($query);
 mysql_close();

//验证是否提交过
// function chk_mood($id){
// 	$cookie = $_COOKIE['mood'.$id];
// 	if($cookie){
// 		$doit = 1;
// 	}else{
// 		$doit = 0;
// 	}
// 	return $doit;
// }
?>