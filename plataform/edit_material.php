<?php
    session_start();
    if(isset($_SESSION['Login'])){

    }else{
        header("Location: index.html");
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Taller Monlau</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.html" class="logo"><b>Taller Monlau</b></a>
            <div class="top-menu">
            <form action="functions/login.php" method="post">
            	<ul class="nav pull-right top-menu">
                        <input type="hidden" id="action" name="a" value="Logout">
                        <li><button type="submit" class="logout">Logout</button></li>
                </ul>
                </form>
            </div>
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <              <ul class="sidebar-menu" id="nav-accordion">
              <li class="mt">
                  <a href="dashboard.php">
                      <i class="fa fa-dashboard"></i>
                      <span>Dashboard</span>
                  </a>
              </li>
              <?php
              include('functions/conexiondb.class.php');
              $conexion = new conexiondb();
              $query = "SELECT * FROM `type`;";
              $result = $conexion->query($query);
              while ($row = $result->fetch_assoc()) {
              echo '<li class="sub-menu">';
              echo '<a href="material.php?type='.$row['name'].'" >';
              echo '<i class="fa fa-desktop"></i>';
              echo '<span>' . $row['name'] . '</span>';
              echo '</a>';
              echo '</li>';
          }
          if($_SESSION['admin']){
            echo'<li class="sub-menu">';
            echo'<a href="edit_type.php">';
            echo'<i class="fa fa-edit"></i>';
            echo'<span>Configurar Tipos</span>';
            echo'</a>';
            echo'</li>';
            echo'<li class="sub-menu">';
            echo'<a href="edit_material.php">';
            echo'<i class="fa fa-edit"></i>';
            echo'<span>Connfigurar Material</span>';
            echo'</a>';
            echo'</li>';
            echo'<li class="sub-menu">';
            echo'<a href="add_user.php">';
            echo'<i class="fa fa-users"></i>';
            echo'<span>Agregar Usuario</span>';
            echo'</a>';
            echo'</li>';
        }
          ?>
        </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i>Agregar Material</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
                  <form action="functions/functions.php" method="post" class="form-inline" role="form">
                        <div class="form-group">
                            <div class="col-sm-10">
                                <input type="text" name="Referencia" placeholder="Referencia" class="form-control">
                                <br>
                                <input type="text" name="Modelo" placeholder="Modelo" class="form-control">
                                <br>
                                <input type="text" name="Marca" placeholder="Marca" class="form-control">
                                <br>
                                <select class="form-control" name="type">
                                    <?php
                                    $conexion = new conexiondb();
                                    $query = "SELECT * FROM `type`;";
                                    $result = $conexion->query($query);
                                    while ($row = $result->fetch_assoc()) {
                                    echo '<option>' . $row['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                                <br>
                                <select class="form-control" name="Estado">
                                    <option>Bueno</option>
                                    <option>Malo</option>
                                    <option>Revisar</option>
                                </select>
                            </div>
                        </div>
                        <br><br>
                        <input type="hidden" name="action" value="addmaterial">
                        <button type="submit" class="btn btn-success">Agregar</button>
                    </form>
                </div>
          	</div>
			
		</section>
      </section><!-- /MAIN CONTENT -->
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="assets/js/jquery.ui.touch-punch.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->
    
  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>
</html>
