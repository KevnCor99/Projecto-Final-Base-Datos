<?php

require 'database.php';
require 'databasepsql.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	if ( !empty($_POST)) {
		$id = $_POST['n_numcasa'];
	}

	if ( null==$id ) {
		header("Location: pagos.php");
	}

	if ( !empty($_POST)) {
		//var_dump($_POST);
		$MontoPagoError = null;
		//$N_NumCasa = $_POST['n_numcasa'];
		$MontoPago = $_POST['MontoPago'];
		$valid = true;

		if (empty($MontoPago)) {
			$MontoPagoError = 'Por favor escribe el Monto del Pago';
			$valid = false;
		}

		if ($valid) {
			$pdo = DatabasePg::connect();
			$sql = 'call sp_procesarPago(?,?)';
			$q = $pdo->prepare($sql);
			$q->bindValue(1, $id, PDO::PARAM_INT);
			$q->bindValue(2, $MontoPago, PDO::PARAM_STR);
			$q->execute();
			DatabasePg::disconnect();
			header("Location: pagos.php");
		}
	} else {
		$pdo = DatabasePg::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT id_pago, n_numcasa, monto, montopagado, estado from pagosp where id_pago = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$N_NumCasa = $data['n_numcasa'];
		$Monto = $data['monto'];
		$MontoPagado = $data['montopagado'];
		DatabasePg::disconnect();
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT NumCasa, Nombre, Apellido_Paterno from inquilinos where NumCasa = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($N_NumCasa));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		//$N_NumCasa = $data['NumCasa'];
		$Nombre = $data['Nombre'];
		$Apellido_Paterno = $data['Apellido_Paterno'];
		DatabasePg::disconnect();
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
		   			<h3>Agregar Pago realizado</h3>
		   		</div>

				<form class="form-horizontal" action="createpagor.php" method="post">

				<div class="control-group">
						<label class="control-label">Numero de Casa</label>
					    <div class="controls">
					      	<?php echo !empty($N_NumCasa)?$N_NumCasa:'';?>
					    </div>
					</div>

					<div class="control-group">
						<label class="control-label">Nombre</label>
					    <div class="controls">
							<?php echo !empty($Nombre)?$Nombre:'';?>
					    </div>
					</div>

					<div class="control-group">
						<label class="control-label">Apellido Paterno</label>
					    <div class="controls">
					      	<?php echo !empty($Apellido_Paterno)?$Apellido_Paterno:'';?>
					    </div>
					</div>

					<div class="control-group">
						<label class="control-label">Monto de Deuda</label>
					    <div class="controls">
					      	<?php echo !empty($Monto)?$Monto:'';?>
					    </div>
					</div>

					<div class="control-group <?php echo !empty($MontoPagoError)?'error':'';?>">
						<label class="control-label">Monto del Pago</label>
					    <div class="controls">
					      	<input name="MontoPago" type="text"  placeholder="Monto de Pago"
									value="<?php echo !empty($MontoPago)?$MontoPago:'';?>">
					      	<?php if (!empty($MontoPagoError)){ ?>
					      		<span class="help-inline"><?php echo $MontoPagoError;?></span>
							<?php } ?>
					    </div>
					</div>

					<div class="form-actions">
						<input type="hidden" name="n_numcasa" value="<?php echo !empty($id)?$id:'';?>">
						<button type="submit" class="btn btn-success">Agregar</button>
						<a class="btn-secondary" href="pagos.php">Regresar</a>
					</div>

				</form>
			</div>
	    </div> <!-- /container -->
	</body>
</html>
