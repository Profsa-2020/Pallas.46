<?php 
     $ret = 00;
     include_once "profsa.php";
     $_SESSION['wrknompro'] = __FILE__;
     date_default_timezone_set("America/Sao_Paulo");

     if (isset($_SESSION['wrknomusu']) == false) {
          exit('<script>location.href = "index.php"</script>');   
     } elseif ($_SESSION['wrknomusu'] == "") {
          exit('<script>location.href = "index.php"</script>');   
     } elseif ($_SESSION['wrknomusu'] == "*") {
          exit('<script>location.href = "index.php"</script>');   
     } elseif ($_SESSION['wrknomusu'] == "#") {
          exit('<script>location.href = "index.php"</script>');   
     }   
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação do menu principal">
          <span class="navbar-toggler-icon"></span>
     </button>
     <a class="navbar-brand" href="menu01.php">
          <?php
          if ($_SESSION['wrklogemp'] == "") {
               echo '<img class="log-1" src="img/logo-05.png">';
          } else {
               echo '<img class="log-1" src="' . $_SESSION['wrklogemp'] . '">';
          }
          ?>

     </a>
     <div class="collapse navbar-collapse align-self-center" id="navbarNav">
          <ul class="navbar-nav mr-auto text-center">
               <li class="nav-item">
                    <a class="nav-link" href="con-empresa.php"><i class="fa fa-building fa-1g"
                              aria-hidden="true"></i><br /> Empresas </a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="man-pagto.php?ope=1&cod=0"><i class="fa fa-credit-card fa-1g" aria-hidden="true"></i><br />
                         Formas de Pagto </a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="con-consultor.php"><i class="fa fa-users fa-1g" aria-hidden="true"></i><br />
                         Consultores </a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="grupo-cli.php?ope=1&cod=0"><i class="fa fa-filter fa-1g" aria-hidden="true"></i><br />
                         Grupo de Cliente </a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="con-cliente.php"><i class="fa fa-handshake-o fa-1g" aria-hidden="true"></i><br />
                         Clientes </a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="grupo-ser.php?ope=1&cod=0"><i class="fa fa-filter fa-1g" aria-hidden="true"></i><br />
                         Grupo de Serviço </a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="man-servico.php?ope=1&cod=0"> <i class="fa fa-desktop fa-1g"
                              aria-hidden="true"></i><br /> Serviços </a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="con-contrato.php?ope=1&cod=0"> <i class="fa fa-money fa-1g"
                              aria-hidden="true"></i><br /> Contratos </a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="consulta-con.php"><i class="fa fa-search fa-1g"
                              aria-hidden="true"></i><br /> Consulta </a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="con-usuario.php"><i class="fa fa-user-circle-o fa-1g"
                              aria-hidden="true"></i><br /> Usuários </a>
               </li>
          </ul>
          <span class="navbar-text text-center">
               <?php 
                    echo '<div>';
                    echo '<a class="nav-link" href="log-acesso.php" title="Abre página com consulta de Log de usuários, somente o administrador"><strong class="lit-1">' . primeiro_nom($_SESSION['wrknomusu']) . '</strong></a>';
                    echo '<a class="nav-link" href="saida.php"><i class="fa fa-sign-out fa-1g" aria-hidden="true"></i><br /></a>';
                    echo '</div>';
               ?>
          </span>
     </div>
</nav>
<br /><br /><br /><br /><br /><br />
