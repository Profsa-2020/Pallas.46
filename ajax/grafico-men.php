<?php	
     $cod = 0;
     session_start();
     include_once "../dados.php";
     include_once "../profsa.php";
     $tab_w = array(array());
     if (isset($_REQUEST['cod']) == true) { $cod = $_REQUEST['cod']; }     
     if ($_SESSION['wrktipusu'] > 2) {
          $com = "Select itevigencia, count(*) as qtde from tb_contrato_s where itestatus < 6 and iteempresa = " . $_SESSION['wrkcodemp'] . " group by itevigencia";
     } else {
          $com = "Select S.itevigencia, count(*) as qtde from (tb_contrato_s S left join tb_contrato C on S.itecontrato = C.idcontrato) where itestatus < 6 and C.conconsultor = " . $_SESSION['wrkcodcon'] . " and iteempresa = " . $_SESSION['wrkcodemp'] . " group by itevigencia";
     }
     $nro = leitura_reg($com, $reg);
     foreach ($reg as $lin) {
          $tab_w['qtd'][] = $lin['qtde'];
          if ($lin['itevigencia'] == 0) {$tab_w['tit'][]  = 'Esporádico'; }
          if ($lin['itevigencia'] == 1) {$tab_w['tit'][]  = 'Mensal'; }
          if ($lin['itevigencia'] == 2) {$tab_w['tit'][]  = 'Bimestral'; }
          if ($lin['itevigencia'] == 3) {$tab_w['tit'][]  = 'Trimestral'; }
          if ($lin['itevigencia'] == 4) {$tab_w['tit'][]  = 'Semestral'; }
          if ($lin['itevigencia'] == 5) {$tab_w['tit'][]  = 'Anual'; }
          if ($lin['itevigencia'] == 6) {$tab_w['tit'][]  = 'Bianual'; }
          if ($lin['itevigencia'] == 7) {$tab_w['tit'][]  = 'Trianual'; }
          $cor_r = rand(0,254);
          $cor_g = rand(0,254);
          $cor_b = rand(0,254);
          $tab_w['cor'][] = 'rgb(' . $cor_r . ',' . $cor_g . ',' . $cor_b . ')';  
     }

     echo json_encode($tab_w);

?>
