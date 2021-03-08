<?php
     $cod = 0;
     $ser = 0;
     $tot = 0;
     $nro = 0;
     $ord = 0;
     $tab = array();
     session_start();
     $tab['tta'] = 0;
     $tab['men'] = '';
     date_default_timezone_set("America/Sao_Paulo");
     if (isset($_REQUEST['cod']) == true) { $cod = $_REQUEST['cod']; }
     if (isset($_REQUEST['ser']) == true) { $ser = $_REQUEST['ser']; }
     if (isset($_REQUEST['ord']) == true) { $ord = $_REQUEST['ord']; }
     include_once "../dados.php";
     include_once "../profsa.php";
     if ($cod > 0) {
          $nro = acessa_reg("Select * from tb_servico where idservico = " . $cod, $reg);            
     } else{
          $ser = retorna_dad('serdescricao', 'tb_servico', 'idservico', $ser);
          $nro = acessa_reg("Select * from tb_servico where serdescricao = '" . $ser . "'", $reg);            
     }
     if ($nro > 1) {
          $tab['men'] = "Existem [" . $nro . "] serviços cadastrados com a mesma solicitação efetuada";
     }
     if ($nro == 0) {
          $tab['men'] = 'Serviço informado no contrato não cadastrado no sistema !';
     } else if ($nro == 1) {
          $tab['cod'] = $reg['idservico'];
          $tab['des'] = $reg['serdescricao'];
          $tab['vig'] = $reg['servigencia'];
          $tab['pre'] = $reg['serpreco'];
          $tab['tta'] = $reg['serpreco'];
          $tab['uni'] = 'R$ ' . number_format($reg['serpreco'], 2, ",", ".");
     }
     
     echo json_encode($tab);     

?>