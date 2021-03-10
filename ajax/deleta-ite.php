<?php
     $cha = 0;
     $qtd = 0;
     $tot = 0;
     $txt = "";
     $tab = array();
     session_start();
     $tab['men'] = '';
     date_default_timezone_set("America/Sao_Paulo");
     if (isset($_REQUEST['cha']) == true) { $cha = $_REQUEST['cha']; }
     include_once "../dados.php";
     include_once "../profsa.php";
     if ($cha > 0){
          $_SESSION['wrklisser']['sta'][$cha] = 3;
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
          if ($_SESSION['wrklisser']['sta'][$lin] != 1) {
               $txt .= '<tr class="cor-1 del-1">';
          } else {
               $tot = $tot +  $_SESSION['wrklisser']['pre'][$lin];
               $txt .= '<tr>';
          }
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
     $_SESSION['wrkvalcon'] = $tot;
     $tab['ger'] = $_SESSION['wrkvalcon'];
     $tab['tot'] = 'R$ ' . number_format($tot, 2, ",", ".");

     echo json_encode($tab);     

?>