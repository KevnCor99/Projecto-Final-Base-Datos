<?php
  session_start();

  require 'databases.php';




  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>

<meta 	charset="utf-8">
   <link   href="css/bootstrap.min.css" rel="stylesheet"-->
   <script src="js/bootstrap.min.js"></script-->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <title>Administración | Residencial Danubio</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>

    <?php require 'partials/header.php' ?>
    <body background="imagenfondo.jpg">

    <?php if(!empty($user)): ?>
      <br> Inició sesión correctamente, Bienvenido: <?= $user['email']; ?>
      <br>
     <div className="botones_menu">
      <lu>
     
      <a href="adpagos.php">
      <br> Inquilinos
     
      <br>
      
      <a href="mesa.php">
      <br> Mesa Directiva
      
      <br>
     
      <a href="trabajadores.php">
      <br> Trabajadores
     
      <br>
      <a href="pagos.php">
      <br> Administracion Pagos
    
      <br>
      <a href="logout.php">
      </lu>
      <br>
      
    </div>  
      
        Salir
      </a>
    <?php else: ?>
      <h1>Inicie Sesión o Registre Nuevo Usuario</h1>

      <a href="login.php">Iniciar Sesion</a> or
      <a href="signup.php">Registrarse</a>
    <?php endif; ?>
  </body>
</html>
