<?php
     $tip = '';
     $cod = 0;
     $tab = array();
     session_start();
     $tab['men'] = '';
     date_default_timezone_set("America/Sao_Paulo");
     if (isset($_REQUEST['tip']) == true) { $tip = $_REQUEST['tip']; }
     if (isset($_REQUEST['cod']) == true) { $cod = $_REQUEST['cod']; }
     include_once "../dados.php";
     include_once "../profsa.php";
     if ($tip == "e") {
          $sql  = "delete from tb_empresa where idempresa = " . $cod ;
     }
     if ($tip == "g") {
          $sql  = "delete from tb_grupo where idgrupo = " . $cod ;
     }
     if ($tip == "s") {
          $sql  = "delete from tb_grupoo where idgrupo = " . $cod ;
     }
     if ($tip == "c") {
          $sql  = "delete from tb_cliente where idcliente = " . $cod ;
     }
     if ($tip == "t") {
          $sql  = "delete from tb_servico where idservico = " . $cod ;
     }
     if ($tip == "o") {
          $sql  = "delete from tb_consultor where idconsultor = " . $cod ;
     }
     if ($tip == "p") {
          $sql  = "delete from tb_pagto where idpagto = " . $cod ;
     }
     if ($tip == "u") {
          $sql  = "delete from tb_usuario where idsenha = " . $cod ;
     }
     if ($tip != "") {
          $ret = comando_tab($sql, $nro, $cha, $men);
          if ($ret == true) {
               $tab['men'] = "Registro solicitado excluído com Sucesso no Sistema !";
          }else{
               print_r($sql . '<br />');
               $tab['men'] = "Erro na exclusão de registro solicitado epelo usuário !";
          }     
     }

     echo $tab['men'];     

?>