<?php	
     $cod = 0;
     session_start();
     include_once "../dados.php";
     include_once "../profsa.php";
     $tab_w = array(array());
     if (isset($_REQUEST['cod']) == true) { $cod = $_REQUEST['cod']; }     
     $dti = date('Y')  . "-" . "01" . "-" . "01" . " 00:00:00";
     $dtf = date('Y')  . "-" . "12" . "-" . "31" . " 23:59:59";
     for ($ind = 0; $ind <= 12; $ind++) {
          $tab_w['qtd'][$ind] = 0;
          $tab_w['val'][$ind] = 0;
          $tab_w['tit'][$ind] = mes_ano($ind); 
          $cor_r = rand(0,254);
          $cor_g = rand(0,254);
          $cor_b = rand(0,254);
          $tab_w['cor'][$ind] = 'rgb(' . $cor_r . ',' . $cor_g . ',' . $cor_b . ')';  
     }
     if ($_SESSION['wrktipusu'] > 2) {
          $com  = "Select idcontrato, condataemi, (convaltotal - convaldesconto) as conliquido from tb_contrato where conempresa = " .  $_SESSION['wrkcodemp'] . " and condataemi between '" . $dti . "' and '" . $dtf . "' ";
     } else {
          $com  = "Select idcontrato, condataemi, (convaltotal - convaldesconto) as conliquido from tb_contrato where conempresa = " .  $_SESSION['wrkcodemp'] . " and conconsultor = " . $_SESSION['wrkcodcon'] . " and condataemi between '" . $dti . "' and '" . $dtf . "' ";
     }
     $nro = leitura_reg($com, $reg);
     foreach ($reg as $lin) {
          $mes = (int) date('m', strtotime($lin['condataemi']));
          $tab_w['qtd'][$mes] += 1;
          $tab_w['val'][$mes] += round($lin['conliquido'], 0);
     }

     echo json_encode($tab_w);

?>
