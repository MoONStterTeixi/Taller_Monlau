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
    <style>
        textarea { resize: none; }
    </style>
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
              <ul class="sidebar-menu" id="nav-accordion">
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
      <section id="main-content">
          <section class="wrapper">
              <h3><i class="fa fa-angle-right"></i> <?php echo $_GET['type']; ?> </h3>
                <form action="functions/functions.php" method="post" class="form-inline" role="form">
                    <input type="hidden" name="action" value="getcsv">
                    <input type="hidden" name="value" value="<?php echo $_GET['type']; ?>">
                    <button type="submit" class="btn btn-success">Descargar</button>
                </form>
              <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                          <table class="table table-striped table-advance table-hover">
	                  	  	  <h4><i class="fa fa-angle-right"></i> Advanced Table</h4>
	                  	  	  <hr>
                              <thead>
                              <tr>
                                  <th><i class="fa fa-bullhorn"></i> Referencia</th>
                                  <th><i class="fa fa-bookmark"></i> Marca / Modelo</th>
                                  <th class="hidden-phone"><i class="fa fa-question-circle"></i> Ultima Revisión</th>
                                  <th><i class=" fa fa-edit"></i> Status</th>
                                  <th><i class=" fa fa-edit"></i> Comentario</th>
                                  <th></th>
                              </tr>
                              </thead>
                              <tbody>
                                  <?php
                                  $var1 = $_GET['type'];
                                  $conexion = new conexiondb();
                                  $query = "SELECT * FROM `material` WHERE `type` = '$var1';";
                                  $result = $conexion->query($query);
                                  $i =0;
                                  while ($row = $result->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . $row['ref'] . '</td>';
                                echo '<td>' . $row['marca'] . ' - ' . $row['modelo'] . '</td>';
                                echo '<td>'. $row['lastupdate'] . '</td>';
                                switch($row['estado']){
                                    case 'Malo':
                                        echo '<td> <div id="Estado'.$i.'" style="visibility: visible;"> <span class="label label-warning label-mini">'. $row['estado'] .'</span> </div> <div id="Estado_Edit'.$i.'" style="visibility: hidden;"><select id="Select'.$i.'" class="form-control" name="type"><option>Bueno</option><option>Malo</option><option>Revisar</option></Select></div></td>';
                                    break;
                                    case 'Bueno':
                                        echo '<td> <div id="Estado'.$i.'" style="visibility: visible;"> <span class="label label-success label-mini">'. $row['estado'] .'</span> </div> <div id="Estado_Edit'.$i.'" style="visibility: hidden;"><select id="Select'.$i.'" class="form-control" name="type"><option>Bueno</option><option>Malo</option><option>Revisar</option></Select></div> </td>';
                                    break;
                                    default:
                                        echo '<td> <div id="Estado'.$i.'" style="visibility: visible;"> <span class="label label-info label-mini">'. $row['estado'] .'</span> </div>  <div id="Estado_Edit'.$i.'" style="visibility: hidden;"><select id="Select'.$i.'" class="form-control" name="type"><option>Bueno</option><option>Malo</option><option>Revisar</option></Select></div> </td>';
                                    break;
                                }
                                echo '<td> <textarea id="textarea'.$i.'" style"resize: none;" rows="4" cols="50" disabled>' . $row['comment'] . '</textarea> </td>';
                                if($_SESSION['admin']){
                                    echo '<td>';
                                    $tconfirm = $i . ",'" . $var1 . "','" . $row['ref'] . "'";
                                    echo '<button onclick="onclickconfirm(' . $tconfirm . ')" class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>';
                                    echo '<br>';
                                    echo '<button onclick="onlickedit(' . $i . ')" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>';
                                    echo '<form action="functions/functions.php" method="post">';
                                    echo '<input type="hidden" id="action" name="action" value="deletematerial">';
                                    echo '<input type="hidden" id="action" name="value" value="'. $row['ref'] .'">';
                                    echo '<input type="hidden" id="action" name="type" value="'. $var1 .'">';
                                    echo '<button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>';
                                    echo '</form>';
                                    echo '</td>';
                                  
                                    }
                                    $i++;
                                }
                                ?>
                              </tr>
                              </tbody>
                          </table>
                      </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->

		</section> <!--/wrapper -->
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->
    
  <script type="text/javascript">
      function onlickedit(num){
          document.getElementById("Estado"+num).style.visibility = 'hidden';
          document.getElementById("Estado_Edit"+num).style.visibility = 'visible';
          document.getElementById("textarea"+num).disabled = false;          
      }
      function onclickconfirm(num,var1,id){
        var t = document.getElementById("Select"+num);
        var tav = document.getElementById("textarea"+num).value;
        var selectedText = t.options[t.selectedIndex].text;
        window.location.replace("functions/functions.php?action=editmaterial"+"&type="+var1+"&value="+selectedText+"&id="+id+"&comentario="+tav);
      }
      function test(){
          alert("HOLA");
      }

  </script>

  </body>
</html>