<?php

	require 'database.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}

	if ( null==$id ) {
		header("Location: adpagos.php");
	}

	if ( !empty($_POST)) {
		// keep track validation errors
		$NumCasaError = null;
		$NombreError = null;
		$Apellido_PaternoError = null;
		$PagadoError = null;

		// keep track post values
		$NumCasa = $_POST['NumCasa'];
		$Nombre= $_POST['Nombre'];
		$Apellido_Paterno = $_POST['Apellido_Paterno'];
		$Pagado = $_POST['Pagado'];

		/// validate input
		$valid = true;

		if (empty($NumCasa)) {
			$NumCasaError = 'Porfavor escribe el numero de casa';
			$valid = false;
		}

		if (empty($Nombre)) {
			$NombreError = 'Porfavor escribe nombre';
			$valid = false;
		}
		if (empty($Apellido_Paterno)) {
			$Apellido_PaternoError = 'Porfavor escribe el apellido paterno';
			$valid = false;
		}

	    if (empty($Pagado)) {
		   $PagadoError = 'Porfavor Seleccione si el recidente pago';
	    	$valid = false;
	   }

		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = 'UPDATE inquilinosp  set NumCasa = ?, Nombre = ?, Apellido_Paterno =?, Pagado= ? WHERE NumCasa = ?';
			$q = $pdo->prepare($sql);
			$Pagadoq = ($Pagado=="S")?1:0;
			$q->execute(array($NumCasa,$Nombre,$Apellido_Paterno,$Pagadoq,$id));
			Database::disconnect();
			header("Location: adpagos.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM inquilinosp where NumCasa = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$NumCasa = $data['NumCasa'];
		$Nombre = $data['Nombre'];
		$Apellido_Paterno = $data['Apellido_Paterno'];
		$Pagado  = ($data['Pagado'])?"S":"N";
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
		    		<h3>Actualizar datos del inquilino</h3>
		    	</div>

	    			<form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">

					  <div class="control-group <?php echo !empty($NumCasaError)?'error':'';?>">

					    <label class="control-label">NumCasa</label>
					    <div class="controls">
					      	<input name="NumCasa" type="text" readonly placeholder="NumCasa" value="<?php echo !empty($NumCasa)?$NumCasa:''; ?>">
					      	<?php if (!empty($NumCasaError)): ?>
					      		<span class="help-inline"><?php echo $NumCasaError;?></span>
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

					    <label class="control-label">Apellido</label>
					    <div class="controls">
					      	<input name="Apellido_Paterno" type="text" placeholder="Apellido" value="<?php echo !empty($Apellido_Paterno)?$Apellido_Paterno:'';?>">
					      	<?php if (!empty($Apellido_PaternoError)): ?>
					      		<span class="help-inline"><?php echo $Apellido_PaternoError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>


					  	<div class="control-group <?php echo !empty($PagadoError)?'error':'';?>">
						    <label class="control-label">EL inquilino pago ?</label>
						    <div class="controls">
	                                                <input name="Pagado" type="radio" value="S"
	                                                	<?php echo ($Pagado == "S")?'checked':'';?> >Si</input> &nbsp;&nbsp;
	                                                <input name="Pagado" type="radio" value="N"
	                                                	<?php echo ($Pagado == "N")?'checked':'';?> >No</input>

						      	<?php if (!empty($PagadoError)): ?>
						      		<span class="help-inline"><?php echo $PagadoError;?></span>
						      	<?php endif;?>
						    </div>
					  	</div>



					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Actualizar</button>
						  <a class="btn" href="adpagos.php">Regresar</a>
						</div>
					</form>
				</div>

    </div> <!-- /container -->
  </body>
</html>
