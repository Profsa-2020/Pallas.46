<?php     // Valida senha para ver se tem números, maísculas, minúculas e caracteres especiais
     $sen = "";
     $nro_g = 0;
     $nro_p = 0;
     $nro_e = 0;
     $nro_n = 0;
     $tab = array();
     session_start();
     $tab['men'] = '';
     if (isset($_REQUEST['sen']) == true) { $sen = $_REQUEST['sen']; }
     include_once "../dados.php";
     include_once "../profsa.php";
     if ($sen  != "") {
          for ($ind = 0; $ind < strlen($sen); $ind++) {
               $cod = ord(substr($sen, $ind, 1));
               if ($cod >= 48 && $cod <= 57) { $nro_n += 1; }
               if ($cod >= 65 && $cod <= 90) { $nro_g += 1; }
               if ($cod >= 97 && $cod <= 122) { $nro_p += 1; }
               if ($cod >= 33 && $cod <= 47) { $nro_e += 1; }
               if ($cod >= 58 && $cod <= 64) { $nro_e += 1; }
               if ($cod >= 91 && $cod <= 96) { $nro_e += 1; }
               if ($cod >= 123 && $cod <= 126) { $nro_e += 1; }
          }
          if ($nro_n == 0) {
               $tab['men'] = 'Não há números informados na senha para cadastro do usuário';
          }
          if ($nro_g == 0) {
               $tab['men'] = 'Não há letras maísculas informadas na senha para o usuário';
          }
          if ($nro_p == 0) {
               $tab['men'] = 'Não há letras miísculas informadas na senha para o usuário';
          }
          if ($nro_e == 0) {
               $tab['men'] = 'Não há caracteres especiais informados na senha para o usuário';
          }
     }

     echo $tab['men'];     

?>