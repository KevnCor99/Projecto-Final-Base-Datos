<?php

	require 'database.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}

	if ( null==$id ) {
		header("Location: mesa.php");
	}

	if ( !empty($_POST)) {
		// keep track validation errors
		$ID_mesa_directivaError = null;
		$ID_mesaError = null;
		$ID_encargado_mesaError = null;

		// keep track post values
		$ID_mesa_directiva = $_POST['ID_mesa_directiva'];
		$ID_mesa = $_POST['ID_mesa'];
		$ID_encargado_mesa  = $_POST['ID_encargado_mesa'];

		/// validate input
		$valid = true;

		if (empty($ID_mesa_directiva)) {
			$ID_mesa_directivaError = 'Porfavor escribe el numero de casa';
			$valid = false;
		}
		if (empty($ID_mesa)) {
			$ID_mesaError = 'Porfavor escribe un nombre';
			$valid = false;
		}
		if (empty($ID_encargado_mesa)) {
			$ID_encargado_mesaError = 'Porfavor escribe apellido paterno';
			$valid = false;
		}

		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = 'UPDATE mesa_directiva  set ID_mesa = ?, ID_encargado_mesa= ? WHERE ID_mesa_directiva = ?';
			$q = $pdo->prepare($sql);
			$q->execute(array($ID_mesa,$ID_encargado_mesa,$id));
			Database::disconnect();
			header("Location: mesa.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM mesa_directiva where ID_mesa_directiva = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$ID_mesa_directiva = $data['ID_mesa_directiva'];
		$ID_mesa = $data['ID_mesa'];
		$ID_encargado_mesa = $data['ID_encargado_mesa'];
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
		    		<h3>Actualizar datos de la mesa directiva</h3>
		    	</div>

	    			<form class="form-horizontal" action="updatemesa.php?id=<?php echo $id?>" method="post">

					  <div class="control-group <?php echo !empty($ID_mesa_directivaError)?'error':'';?>">

					    <label class="control-label">ID_mesa_directiva</label>
					    <div class="controls">
					      	<input name="ID_mesa_directiva" type="text" readonly placeholder="ID_mesa_directiva" value="<?php echo !empty($ID_mesa_directiva)?$ID_mesa_directiva:''; ?>">
					      	<?php if (!empty($ID_mesa_directivaError)): ?>
					      		<span class="help-inline"><?php echo $ID_mesa_directivaError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>

						<div class="control-group <?php echo !empty($ID_mesaError)?'error':'';?>">

					    <label class="control-label">ID_mesa</label>
					    <div class="controls">
					      	<input name="ID_mesa" type="text" placeholder="ID_mesa" value="<?php echo !empty($ID_mesa)?$ID_mesa:'';?>">
					      	<?php if (!empty($ID_mesaError)): ?>
					      		<span class="help-inline"><?php echo $ID_mesaError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

					  <div class="control-group <?php echo !empty($ID_encargado_mesaError)?'error':'';?>">

					    <label class="control-label">ID_encargado_mesa</label>
					    <div class="controls">
					      	<input name="ID_encargado_mesa" type="text" placeholder="ID_encargado_mesa" value="<?php echo !empty($ID_encargado_mesa)?$ID_encargado_mesa:'';?>">
					      	<?php if (!empty($ID_encargado_mesaError)): ?>
					      		<span class="help-inline"><?php echo $ID_encargado_mesaError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>


					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Actualizar</button>
						  <a class="btn" href="mesa.php">Regresar</a>
						</div>
					</form>
				</div>

    </div> <!-- /container -->
  </body>
</html>
