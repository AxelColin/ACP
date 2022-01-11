<?php
if(!empty($_POST)){
	$enlace=mysql_connect('localhost','root','');
	if (!$enlace){
		die('no se pudo conectar: '.mysql_error());
	}
	mysql_select_db('hospital');
	foreach($_POST as $field_name=>$val){
		$field_id=strip_tags(trim($field_name));
		if(!empty($field_id)){
			mysql_query("DELETE FROM usuarios where nombre='$field_id'") or mysql_error();
			mysql_query("DELETE FROM datosusuario where idusuario='$field_id'") or mysql_error();
			echo"true";
		}else{
			echo"false";
		}
	}
}
?>