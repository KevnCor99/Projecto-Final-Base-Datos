<?php

	require 'database.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}

	if ( null==$id ) {
		header("Location: trabajadores.php");
	}

	if ( !empty($_POST)) {

		$ID_personalError = null;
		$NombreError = null;
		$Apellido_PaternoError = null;
		$AreaError = null;


		// keep track post values
		$ID_personal = $_POST['ID_personal'];
		$Nombre = $_POST['Nombre'];
		$Apellido_Paterno  = $_POST['Apellido_Paterno'];
		$Area = $_POST['Area'];

		/// validate input
		$valid = true;

		if (empty($ID_personal)) {
			$ID_personalError = 'Porfavor escribe el numero de ID';
			$valid = false;
		}
		if (empty($Nombre)) {
			$NombreError = 'Porfavor escribe un nombre';
			$valid = false;
		}
		if (empty($Apellido_Paterno)) {
			$Apellido_PaternoError = 'Porfavor escribe apellido paterno';
			$valid = false;
		}

		if (empty($Area)) {
			$AreaError = 'Porfavor escribe Area del trabajador';
			$valid = false;
		}

		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = 'UPDATE encargados_areap set ID_personal = ?, Nombre = ?, Apellido_Paterno = ?, Area = ? WHERE ID_personal = ?';
			$q = $pdo->prepare($sql);
			$q->execute(array($ID_personal,$Nombre,$Apellido_Paterno,$Area,$id));
			Database::disconnect();
			header("Location: trabajadores.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = 'SELECT ID_personal, Nombre, Apellido_Paterno, Area from encargados_areap where ID_personal = ?';
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$ID_personal = $data['ID_personal'];
		$Nombre = $data['Nombre'];
		$Apellido_Paterno = $data['Apellido_Paterno'];
		$Area = $data['Area'];
		Database::disconnect();
	}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
			<meta 	charset="utf-8">
			<link   href="css/bootstrap.min.css" rel="stylesheet"-->
			<script src="js/bootstrap.min.js"></script-->
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
			<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</head>


	<body>
    	<div class="container">
    		<div class="span10 offset1">
    			<div class="row">
		    		<h3>Actualizar datos del trabajador</h3>
		    	</div>

	    			<form class="form-horizontal" action="updatetrabajador.php?id=<?php echo $id?>" method="post">

					  <div class="control-group <?php echo !empty($ID_personalError)?'error':'';?>">

					    <label class="control-label">ID_personal</label>
					    <div class="controls">
					      	<input name="ID_personal" type="text" readonly placeholder="ID_personal" value="<?php echo !empty($ID_personal)?$ID_personal:''; ?>">
					      	<?php if (!empty($ID_personalError)): ?>
					      		<span class="help-inline"><?php echo $ID_personalError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>

						<div class="control-group <?php echo !empty($NombreError)?'error':'';?>">

					    <label class="control-label">Nombre</label>
					    <div class="controls">
					      	<input name="Nombre" type="text" placeholder="Nombre" value="<?php echo !empty($Nombre)?$Nombre:'';?>">
					      	<?php if (!empty($NombreError)): ?>
					      		<span class="help-inline"><?php echo $NombreError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

					  <div class="control-group <?php echo !empty($Apellido_PaternoError)?'error':'';?>">

					    <label class="control-label">Apellido_Paterno</label>
					    <div class="controls">
					      	<input name="Apellido_Paterno" type="text" placeholder="Apellido_Paterno" value="<?php echo !empty($Apellido_Paterno)?$Apellido_Paterno:'';?>">
					      	<?php if (!empty($Apellido_PaternoError)): ?>
					      		<span class="help-inline"><?php echo $Apellido_PaternoError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

						<div class="control-group <?php echo !empty($AreaError)?'error':'';?>">

							<label class="control-label">Area</label>
							<div class="controls">
									<input name="Area" type="text" placeholder="Area" value="<?php echo !empty($Area)?$Area:'';?>">
									<?php if (!empty($AreaError)): ?>
										<span class="help-inline"><?php echo $AreaError;?></span>
									<?php endif;?>
							</div>
						</div>


					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Actualizar</button>
						  <a class="btn" href="trabajadores.php">Regresar</a>
						</div>
					</form>
				</div>

    </div> <!-- /container -->
  </body>
</html>
