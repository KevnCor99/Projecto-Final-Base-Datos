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
	    			<h3>Trabajadores </h3>
	    		</div>
				<div class="row">
					<p>
						<a href="createtrabajador.php" class="btn btn-success">Agregar trabajador</a>
					</p>
                                        <hr>

                                        <p>
						<a href="index.php" class="btn btn-success ">Regresar</a>
					</p>

					<table class="table table-striped table-bordered">
			            <thead>
			                <tr>
			                	<th>ID_personal</th>
			                	<th>Nombre</th>
	                      <th>Apellido_Paterno</th>
												<th>Area</th>

			                </tr>
			            </thead>
			            <tbody>
			              	<?php
						   	include 'database.php';
						   	$pdo = Database::connect();
						   	$sql = 'SELECT * from encargados_areap';
		 				   	foreach ($pdo->query($sql) as $row) {
								  echo '<tr>';
	    					   	echo '<td>'. $row['ID_personal'] . '</td>';
	    					  	echo '<td>'. $row['Nombre'] . '</td>';
										echo '<td>'. $row['Apellido_Paterno'] . '</td>';
	                  echo '<td>'. $row['Area'] . '</td>';
										echo '</td>';
										echo '<td width=150>';
										echo '<a class="btn btn-info"
                    href="readtrabajador.php?id='.$row['ID_personal'].'">Detalles</a>';
                    echo '&nbsp;';
	    					    echo '<a class="btn btn-success"
										href="updatetrabajador.php?id='.$row['ID_personal'].'">Actualizar</a>';
	    					    echo '&nbsp;';
	    					   	echo '<a class="btn btn-danger"
										href="deletetrabajador.php?id='.$row['ID_personal'].'">Eliminar</a>';
	    					    echo '</td>';
							   echo '</tr>';
						    }
						   	Database::disconnect();
						  	?>
					    </tbody>
		          </table>
	    	</div>
	    </div> <!-- /container -->
	</body>
</html>
