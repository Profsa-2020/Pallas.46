<?php
     $des = 0;
     $tab = array();
     session_start();
     $tab['men'] = '';
     date_default_timezone_set("America/Sao_Paulo");
     if (isset($_REQUEST['des']) == true) { $des = str_replace(",", ".", $_REQUEST['des']); }
     include_once "../dados.php";
     include_once "../profsa.php";
     if ($des > 0) {
          $lim = retorna_dad('empfaixa1', 'tb_empresa', 'idempresa', $_SESSION['wrkcodemp']);
          if ($des > $lim) {
               $tab['men'] = "Número máximo de desconto deve ser: " . number_format($lim, 2, ",", ".") . "%, desconto inválido ! ";
          }
}

echo $tab['men'];     

?>