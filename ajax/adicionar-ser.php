<?php
     $cod = 0;
     $qtd = 0;
     $tot = 0;
     $txt = "";
     $tab = array();
     session_start();
     $tab['men'] = '';
     $tab['num'] = 1;
     include_once "../dados.php";
     include_once "../profsa.php";
     date_default_timezone_set("America/Sao_Paulo");
     if (isset($_REQUEST['cod_s']) == true) { $cod = $_REQUEST['cod_s']; }
     if ($_REQUEST['cod_s'] == "" || $_REQUEST['cod_s'] == "0") {
          $tab['men'] = 'Não pode ser adicionado serviço sem informação de código';
     }
     if ($_REQUEST['des_s'] == "" || $_REQUEST['des_s'] == "0") {
          $tab['men'] = 'Não pode ser adicionado serviço sem informação de descrição';
     }
     if ($_REQUEST['par_s'] == "" || $_REQUEST['par_s'] == "0") {
          $tab['men'] = 'Não pode ser adicionado serviço sem informação de parcelas';
     }
     if ($tab['men'] == "") {
          $_SESSION['wrklisser']['sta'][$cod] = 1;
          $_SESSION['wrklisser']['cod'][$cod] = $_REQUEST['cod_s'];
          $_SESSION['wrklisser']['vig'][$cod] = $_REQUEST['vig_s'];
          $_SESSION['wrklisser']['par'][$cod] = $_REQUEST['par_s'];
          $_SESSION['wrklisser']['pre'][$cod] = $_REQUEST['ser_t'];
          $_SESSION['wrklisser']['obs'][$cod] = $_REQUEST['obs_s'];
     }
     $txt .= '<div class="tab-2 table-responsive">';
     $txt .= '<table class="table table-sm">';
     $txt .= '<thead>';
     $txt .= '<tr>';
     $txt .= '<th>Nº</th>';
     $txt .= '<th width="35%">Descrição do Serviço</th>';
     $txt .= '<th>Vigência</th>';
     $txt .= '<th>Preço</th>';
     $txt .= '<th>Parcelas</th>';
     $txt .= '<th>Valor</th>';
     $txt .= '<th class="text-center">Excluir</th>';
     $txt .= '</tr>';
     $txt .= '</thead>';
     $txt .= '<tbody>';
     foreach ($_SESSION['wrklisser']['cod'] as $key => $lin) {
          $qtd = $qtd + 1;
          $tot = $tot +  $_SESSION['wrklisser']['pre'][$lin];
          $txt .= '<tr>';
          $txt .= '<td>' . $qtd . '</td>';
          $txt .= '<td>' . retorna_dad('serdescricao', 'tb_servico', 'idservico', $key) . '</td>';
          if ($_SESSION['wrklisser']['vig'][$lin] == 0) { $txt .= '<td>' . "Esporádico" . '</td>'; }
          if ($_SESSION['wrklisser']['vig'][$lin] == 1) { $txt .= '<td>' . "Mensal" . '</td>'; }
          if ($_SESSION['wrklisser']['vig'][$lin] == 2) { $txt .= '<td>' . "Bimestral" . '</td>'; }
          if ($_SESSION['wrklisser']['vig'][$lin] == 3) { $txt .= '<td>' . "Trimestral" . '</td>'; }
          if ($_SESSION['wrklisser']['vig'][$lin] == 4) { $txt .= '<td>' . "Semestral" . '</td>'; }
          if ($_SESSION['wrklisser']['vig'][$lin] == 5) { $txt .= '<td>' . "Anual" . '</td>'; }
          if ($_SESSION['wrklisser']['vig'][$lin] == 6) { $txt .= '<td>' . "Bianual" . '</td>'; }
          if ($_SESSION['wrklisser']['vig'][$lin] == 7) { $txt .= '<td>' . "Trianual" . '</td>'; }
          $txt .= '<td class="text-right">' . number_format($_SESSION['wrklisser']['pre'][$lin], 2, ",", ".") . '</td>';
          $txt .= '<td class="text-center">' . $_SESSION['wrklisser']['par'][$lin] . '</td>';
          $txt .= '<td class="text-right">' . number_format($_SESSION['wrklisser']['pre'][$lin] / $_SESSION['wrklisser']['par'][$lin], 2, ",", ".") . '</td>';
          $txt .= '<td class="lit-d text-center" cha_s="' . $key . '"><i class="cor-1 cur-1 fa fa-trash-o" aria-hidden="true" title="Efetua exclusão do serviço informado na linha para o contrato"></i></td>';
          $txt .= '</tr>';     
     }
     $txt .= '</tbody>';
     $txt .= '</table>';
     $txt .= '</div>';

     $tab['lis'] = $txt;
     $tab['num'] = ($qtd + 1) . ' º ';
     $tab['tot'] = 'R$ ' . number_format($tot, 2, ",", ".");

     echo json_encode($tab);     

?>