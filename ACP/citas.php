<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<title>Horarios de citas</title>
</head>
<body>
   <div class="container">
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#miMenu">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="frmadmin.php" class="navbar-brand">Bienvenido Administrador
				<?php
					session_start();
					echo $_SESSION['nombre'];
					?>
				</a>
			</div>		
			<div class="collapse navbar-collapse" id="miMenu">
				<ul class="nav navbar-nav">
					<li><a href="administradores.php">Administradores</a></li>					
					<li><a href="pacientes.php">Usuarios</a></li>	
					<li class="active"><a href="citas.php">Citas</a></li>
					<li><a onclick="cambiar();" href="#">Cambiar contraseña</a></li>
					<li><a href="php/cerrarsesion.php"><span class="label label-danger">CERRAR SESION </span></a></li>										
				</ul>
			</div>
		</div>
	</nav>
</div>

<div class="container">
<div class="panel panel-default">
    <div class="panel-heading">HORARIO</div>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>ID</th>
					<th>HORAS</th>
					<th>Usuario</th>		
					<th>Cancelar cita</th>									
				</tr>
			</thead>
			<tbody>
				<?php
				     require('php/conexion.php');
				     $result=mysqli_query($conexion,'SELECT * FROM horarios');
				     while ($horarios=mysqli_fetch_array($result)){
						 $id=$horarios['usuario'];
						 $doct=$horarios['doctor'];
						 $id2=$horarios['id'];
						 $paciente=$horarios['paciente'];
					 echo "<tr><td id='id:$id' class='cam_editable'>".$horarios['id']."</td>";
				     echo "<td id='horas:$id' class='cam_editable'>".$horarios['horas']."</td>";				     
				     echo "<td id='paciente:$id' class='cam_editable' >".$horarios['paciente']."</td>";	
					 if ($horarios['paciente']<>''){
							 echo"<td id='$id' name='$paciente' button='false'><button type='button' class='btn btn-success'><span class='glyphicon glyphicon-move'></span> Mover</button></td>";
							 echo"<td id='$id2' name='$paciente' button='true'><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-remove'></span> Cancelar Cita</button></td>";
					 }else{
							 echo"<td></td>";						 
							 echo"<td></td>";						 
						 }
					  	 
				     $result2=mysqli_query($conexion,'SELECT nombre FROM usuarios where tipo="doctor"');
					 echo"<td id='id:$id''><select id='id".$doct."' name='$id2'>";					 
				     while ($doctor=mysqli_fetch_array($result2)){
						 echo"<option value='".$doctor['nombre']."'>".$doctor['nombre']."</option>";
					 }
					 echo"</td></select>";				    
					 echo"</tr>";
					 }				
				?>
			</tbody>	
					
		</table>
	</div>
	</div>
	
<!--//////////////////////////////////////////////////////////////////////////////////////////////////-->
	</div>

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Nuevo administrador</h4>
            </div>
            <form role="form"  id= "frmadministrador" name="frmadministrador" onsubmit="Registraradministrador(); return false">
              <div class="col-lg-12">               

                <div class="form-group">
                  <label>Nombre</label>
                  <input  name="nombre" class="form-control" required>
                </div>

                <div class="form-group">
                  <label>password</label>
                  <input  name="password" id="p1" class="form-control" required>
                </div>
                
                <div class="form-group">
                  <label>repita password</label>
                  <input  name="password2" id="p2" class="form-control" required>
                </div>                         
                
                <button type="submit" class="btn btn-primary btn-lg" button='agregar'>
                  <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Registrar
                </button>
              </div>
            </form>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>
	
<!--//////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////-->
 <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">cambiar contraseña</h4>
            </div>
            <form role="form"  id= "frmcambiar" name="frmcambiar" onsubmit="cambiarpassword(); return false">
              <div class="col-lg-12">               

                <div class="form-group">
                  <label>vieja contraseña</label>
                  <input  name="password0" id="p" class="form-control" type="password"required>
                </div>
                <div class="form-group">
                  <label>nueva contraseña</label>
                  <input  name="password1" id="p3" class="form-control" type="password"required>
                </div>
                
                <div class="form-group">
                  <label>repita nueva password</label>
                  <input  name="password2" id="p4" class="form-control" type="password" required>
                </div> 
                 <button type="submit" class="btn btn-primary btn-lg" button='agregar'>
                  <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Cambiar
                </button> 
              </div>
            </form>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>
<!--//////////////////////////////////////////////////-->
<script src="js/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="js/maincitaadmin.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/change.js"></script>
<script type="text/javascript">
	function cambiar(){
          $('#modal2').modal('show');

        }
        function ventananuevo(){
          $('#modal').modal('show');

        }
    </script>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////////////////////////////-->
    <script type="text/javascript">
		<?php
		$result=mysqli_query($conexion,'SELECT nombre FROM usuarios where tipo="doctor"');
	    while ($doc=mysqli_fetch_array($result)){
			?>
						 $(document).ready(function(){
							$('#id<?php echo $doc['nombre'];?> > option[value="<?php echo $doc['nombre'];?>"]').attr('selected', 'selected');
					 });
		<?php } ?>
    </script>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////-->

</body>