<?php

	require 'databasepsql.php';

	if ( !empty($_POST)) {

		$N_NumCasaError = null;
		$MontoError = null;

		$N_NumCasa = $_POST['N_NumCasa'];
		$Monto = $_POST['Monto'];

		$valid = true;

		if (empty($N_NumCasa)) {
			$N_NumCasaError = 'Por favor selecciona el numero de casa';
			$valid = false;
		}
		if (empty($Monto)) {
			$MontoError = 'Por favor escribe el Monto';
			$valid = false;
		}

		if ($valid) {
			$pdo = DatabasePg::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = 'INSERT INTO pagosp (n_numcasa, monto, estado) values(?,?,0)';
			$q = $pdo->prepare($sql);
			$q->execute(array($N_NumCasa,$Monto));
			DatabasePg::disconnect();
			header("Location: pagos.php");
		}
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
		   			<h3>Agregar Pago Pendiente</h3>
		   		</div>

				<form class="form-horizontal" action="createpagop.php" method="post">

					<div class="control-group <?php echo !empty($N_NumCasaError)?'error':'';?>">
						<label class="control-label">Numero de Casa</label>
					    <div class="controls">
					      	<input name="N_NumCasa" type="text"  placeholder="Numero de Casa"
									value="<?php echo !empty($N_NumCasa)?$N_NumCasa:'';?>">
					      	<?php if (!empty($N_NumCasaError)) { ?>
					      		<span class="help-inline"><?php echo $N_NumCasaError;?></span>
									<?php } ?>
					    </div>
					</div>

					<div class="control-group <?php echo !empty($MontoError)?'error':'';?>">
						<label class="control-label">Monto</label>
					    <div class="controls">
					      	<input name="Monto" type="text"  placeholder="Monto"
									value="<?php echo !empty($Monto)?$Monto:'';?>">
					      	<?php if (!empty($MontoError)){ ?>
					      		<span class="help-inline"><?php echo $MontoError;?></span>
							<?php } ?>
					    </div>
					</div>

					<div class="form-actions">
						<button type="submit" class="btn btn-success">Agregar</button>
						<a class="btn-secondary" href="pagos.php">Regresar</a>
					</div>

				</form>
			</div>
	    </div> <!-- /container -->
	</body>
</html>
