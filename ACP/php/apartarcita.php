<?php
if(!empty($_POST)){
	$enlace=mysql_connect('localhost','root','');
	if (!$enlace){
		die('no se pudo conectar: '.mysql_error());
	}
	mysql_select_db('hospital');	
	foreach($_POST as $field_name=>$val){
		$field_id=strip_tags(trim($field_name));
		$val=strip_tags(trim(mysql_real_escape_string($val)));
		$split_data=explode(':',$field_id);
		$field_name=$split_data[0];
		if(!empty($field_name)&&!empty($val)){			
			mysql_query("UPDATE datosusuario set cita='$field_name' where idusuario='$val'") or mysql_error();
			mysql_query("UPDATE horarios set paciente='$val' where id='$field_name'") or mysql_error();
			echo"true";
		}else{
			echo"false";
		}
	}
}
?>