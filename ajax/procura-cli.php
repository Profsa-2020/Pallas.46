<?php   
     $sta = 0;
     $nom = "";
     $tab_w = array();
     include_once "../profsa.php";
     include_once "../dados.php";
     if (isset($_REQUEST['term']) == true) { $nom = $_REQUEST['term']; }    // term é o nome fixo
     if (strlen($nom) >= 3) { 
          $com = "Select idcliente, clirazao, clifantasia from tb_cliente where clifantasia like '%" . $nom . "%' order by clifantasia Limit 25";
          $nro = leitura_reg($com, $reg);
          foreach ($reg as $lin) {
               $tab_w[] = array ("label" => limpa_cpo(utf8_encode(trim($lin['clifantasia']))), "id" => $lin['idcliente']);   
          }
     }
     echo json_encode($tab_w);     
?>    
