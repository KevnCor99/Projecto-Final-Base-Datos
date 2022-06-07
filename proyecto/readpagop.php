<?php
	require 'database.php';
	require 'databasepsql.php';
	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	if ( $id==null) {
		header("Location: pagos.php");
	} else {
		$pdo = DatabasePg::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = 'SELECT n_numcasa, monto, estado from pagosp where id_pago = ?';
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
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
		    		<h3>Detalles de Pago pendiente</h3>
		    	</div>

	    		<div class="form-horizontal" >

					<div class="control-group">
						<label class="control-label">Numero Casa</label>
					    <div class="controls">
							<label class="checkbox">
								<?php echo $data['n_numcasa'];?>
							</label>
					    </div>
					</div>
					<?php
						$pdomy = Database::connect();
						$pdomy->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$sqlmy = 'SELECT * from inquilinos where NumCasa=' . $data['n_numcasa'];
						$stmt=$pdomy->query($sqlmy);
						$rows = $stmt->fetchAll();
						$row = $rows[0];

					?>

					<div class="control-group">
					    <label class="control-label">Nombre</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $row['Nombre'];?>
						    </label>
					    </div>
					</div>

					<div class="control-group">
					    <label class="control-label">Apellido_Paterno</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $row['Apellido_Paterno'];?>
						    </label>
					    </div>
					</div>
					<div class="control-group">
						<label class="control-label">Monto</label>
						<div class="controls">
							<label class="checkbox">
								<?php echo $data['monto'];?>
							</label>
						</div>
					</div>
				    <div class="form-actions">
						<a class="btn-dar" href="pagos.php">Regresar</a>
					</div>

				</div>
			</div>
		</div> <!-- /container -->
  	</body>
</html>
