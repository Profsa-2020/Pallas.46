<?php
     $par = 0;
     $tab = array();
     session_start();
     $tab['men'] = '';
     date_default_timezone_set("America/Sao_Paulo");
     if (isset($_REQUEST['par']) == true) { $par = $_REQUEST['par']; }
     if (isset($_REQUEST['ser']) == true) { $ser = $_REQUEST['ser']; }
     include_once "../dados.php";
     include_once "../profsa.php";
     if ($par > 0) {
          $max = retorna_dad('empparcelas', 'tb_empresa', 'idempresa', $_SESSION['wrkcodemp']);
          if ($par > $max) {
               $tab['men'] = "Número máximo de parcelas deve ser: " . $max . ", parcelas inválida ! ";
          }
}

echo $tab['men'];     

?>