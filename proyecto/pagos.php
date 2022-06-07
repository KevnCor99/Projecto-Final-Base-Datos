<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta 	charset="utf-8">
	    <!--link   href="css/bootstrap.min.css" rel="stylesheet"-->
	    <!--script src="js/bootstrap.min.js"></script-->
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
			<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</head>

	<body>
	    <div class="container">
	    		<div class="row">
	    			<h3>Pagos Pendientes</h3>
	    		</div>
				<div class="row">
					<p>
						<a href="createpagop.php" class="btn btn-success">Agregar Pago pendiente</a>
					</p>
                                        <hr>

                                        <p>
						<a href="index.php" class="btn btn-success ">Regresar</a>
					</p>

					<table class="table table-striped table-bordered">
			            <thead>
			                <tr>
			                	<th>Nombre</th>
		                    	<th>Apellido_Paterno</th>
								<th>Monto</th>
								<th>Monto Pagado</th>
								<th>Estado</th>
			                </tr>
			            </thead>
			            <tbody>
			              	<?php
						   	include 'database.php';
						   	include 'databasepsql.php';
						   	$pdo = Database::connect();
						   	$pdopg = DatabasePg::connect();
						   	$sqlpg = 'SELECT * from pagosp';
		 				   	foreach ($pdopg->query($sqlpg) as $rowpg) {
								//var_dump($rowpg);
								if($rowpg['n_numcasa']!=null) {
									$sql = 'SELECT * from inquilinos where NumCasa=' . $rowpg['n_numcasa'];
									$stmt=$pdo->query($sql);
									if($stmt!=false)
									$rows = $stmt->fetchAll();
									$row = $rows[0];
								} else $row = ["Nombre" => "", "Apellido_Paterno"=> ""];
								echo '<tr>';
	    					  	echo '<td>'. $row['Nombre'] . '</td>';
								echo '<td>'. $row['Apellido_Paterno'] . '</td>';
								echo '<td>'. $rowpg['monto'] . '</td>';
								echo '<td>'. $rowpg['montopagado'] . '</td>';
								echo '<td>'. ($rowpg['estado']==1 ? "SI" : "NO") . '</td>';
								echo '</td>';
								echo '<td width=150>';
								echo '<a class="btn btn-info"
									href="readpagop.php?id='.$rowpg['id_pago'].'">Detalles</a>';
			                    echo '&nbsp;';
	    					    echo '<a class="btn btn-success"
										href="updatepagop.php?id='.$rowpg['id_pago'].'">Actualizar</a>';
	    					    echo '&nbsp;';
	    					   	echo '<a class="btn btn-danger"
										href="deletepagop.php?id='.$rowpg['id_pago'].'">Eliminar</a>';
								echo '&nbsp;';
								echo '<a class="btn btn-success"
										href="createpagor.php?id='.$rowpg['id_pago'].'">Registrar Pago</a>';
									 echo '</td>';
							   echo '</tr>';
						    }
						   	DatabasePg::disconnect();
						  	?>
					    </tbody>
		          </table>
	    	</div>
	    </div> <!-- /container -->
	</body>
</html>
