<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt_br">

<head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
     <meta name="description" content="Profsa Informática - Gerenciamento de Contratos - SearchMidia" />
     <meta name="author" content="Paulo Rogério Souza" />
     <meta name="viewport" content="width=device-width, initial-scale=1" />

     <link href="https://fonts.googleapis.com/css?family=Lato:300,400" rel="stylesheet" type="text/css" />
     <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet" type="text/css" />

     <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css">

     <link rel="icon"
          href="https://cdn.shortpixel.ai/client/q_glossy,ret_img,w_32,h_32/https://www.searchmidia.com.br/wp-content/uploads/2017/07/Favicon.png"
          sizes="32x32" />
     <link rel="icon"
          href="https://cdn.shortpixel.ai/client/q_glossy,ret_img,w_192,h_192/https://www.searchmidia.com.br/wp-content/uploads/2017/07/Favicon.png"
          sizes="192x192" />
     <link rel="apple-touch-icon"
          href="https://cdn.shortpixel.ai/client/q_glossy,ret_img,w_180,h_180/https://www.searchmidia.com.br/wp-content/uploads/2017/07/Favicon.png" />

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

     <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
          integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
     </script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
          integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
     </script>

     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
     <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

     <script type="text/javascript" language="javascript"
          src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
     <link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

     <script type="text/javascript" language="javascript"
          src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
     <script type="text/javascript" language="javascript"
          src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>

     <script type="text/javascript" src="js/datepicker-pt-BR.js"></script>

     <script type="text/javascript" src="js/jquery.mask.min.js"></script>

     <link href="css/pallas46.css" rel="stylesheet" type="text/css" media="screen" />
     <title>Análise de Contratos - SearchMidia</title>
</head>

<script>
$(function() {
     $("#dti").mask("99/99/9999");
     $("#dtf").mask("99/99/9999");
     $("#dti").datepicker($.datepicker.regional["pt-BR"]);
     $("#dtf").datepicker($.datepicker.regional["pt-BR"]);
});

$(document).ready(function() {

     let alt = $(window).height();
     let lar = $(window).width();
     if (lar < 800) {
          $('nav').removeClass("fixed-top");
     }

     $('#tab-0').DataTable({
          "pageLength": 25,
          "aaSorting": [
               [2, 'asc'],
               [0, 'asc']
          ],
          "dom": 'Bfrtip',
          "buttons": [{
               "extend": 'csv',
               "text": ' Gerar .csv ',
               "fieldSeparator": ';'
          }],
          "language": {
               "lengthMenu": "Demonstrar _MENU_ linhas por páginas",
               "zeroRecords": "Não existe registros a demonstrar ...",
               "info": "Mostrada página _PAGE_ de _PAGES_",
               "infoEmpty": "Sem registros de contratos ...",
               "sSearch": "Buscar:",
               "infoFiltered": "(Consulta de _MAX_ total de linhas)",
               "oPaginate": {
                    sFirst: "Primeiro",
                    sLast: "Último",
                    sNext: "Próximo",
                    sPrevious: "Anterior"
               }
          }
     });

     $('#cli').change(function() {
          $('#tab-0 tbody').empty();
     });

     $('#con').change(function() {
          $('#tab-0 tbody').empty();
     });

     $('#sta').change(function() {
          $('#tab-0 tbody').empty();
     });

     $('#dti').change(function() {
          $('#tab-0 tbody').empty();
     });

     $('#dtf').change(function() {
          $('#tab-0 tbody').empty();
     });

     $(window).scroll(function() {
          if ($(this).scrollTop() > 100) {
               $(".subir").fadeIn(500);
          } else {
               $(".subir").fadeOut(250);
          }
     });

     $(".subir").click(function() {
          $topo = $("#box00").offset().top;
          $('html, body').animate({
               scrollTop: $topo
          }, 1500);
     });

});
</script>

<?php
     $ret = 00;
     $con_l = "";
     include_once "dados.php";
     include_once "profsa.php";
     $_SESSION['wrknompro'] = __FILE__;
     if ($_SESSION['wrktipusu'] <= 1) {
          echo '<script>alert("Nível de usuário não permite acesso a está opção do sistema");</script>';
          echo '<script>history.go(-1);</script>';
     }
     date_default_timezone_set("America/Sao_Paulo");
     $_SESSION['wrkdatide'] = date ("d/m/Y H:i:s", getlastmod());
     $_SESSION['wrknomide'] = get_current_user();
     if (isset($_SERVER['HTTP_REFERER']) == true) {
          if (limpa_pro($_SESSION['wrknompro']) != limpa_pro($_SERVER['HTTP_REFERER'])) {
               $_SESSION['wrkproant'] = limpa_pro($_SERVER['HTTP_REFERER']);
               $ret = gravar_log(4, "Entrada na página de verificação de contratos - Pallas.46");  
          }
     }
     if (isset($_SESSION['wrkopereg']) == false) { $_SESSION['wrkopereg'] = 0; }
     if (isset($_SESSION['wrkcodreg']) == false) { $_SESSION['wrkcodreg'] = 0; }
     if (isset($_REQUEST['ope']) == true) { $_SESSION['wrkopereg'] = $_REQUEST['ope']; }
     if (isset($_REQUEST['cod']) == true) { $_SESSION['wrkcodreg'] = $_REQUEST['cod']; }
     $dti = date('d/m/Y', strtotime('-30 days'));
     $dtf = date('d/m/Y');
     $dti = (isset($_REQUEST['dti']) == false ? $dti : $_REQUEST['dti']);
     $dtf = (isset($_REQUEST['dtf']) == false ? $dtf : $_REQUEST['dtf']);
     $sta = (isset($_REQUEST['sta']) == false ? 9 : $_REQUEST['sta']);
     $tab = array(); $ret = carrega_ger($sta, $dti, $dtf, $tab);

     $cli = (isset($_REQUEST['cli']) == false ? 0  : $_REQUEST['cli']);
     $con = (isset($_REQUEST['con']) == false ? 0 : $_REQUEST['con']);
     if ($_SESSION['wrktipusu'] <= 1) { // 0-Visitante, 1-Consultor
          $con_l = " disabled ";
          $con = $_SESSION['wrkcodcon'];
     }
     $ret = carrega_nro($sta, $dti, $dtf, $cli, $con, $com, $qtd, $val);  

 ?>

<body id="box00">
     <h1 class="cab-0">Análise de Contratos - SearchMidia - Profsa Informática</h1>
     <div class="row">
          <div class="col-md-12">
               <?php include_once "cabecalho-1.php"; ?>
          </div>
     </div>
     <div class="container">
          <div class="form-row qua-2">
               <div class="col-md-8 text-left">
                    <span>Gerenciamento de Contratos</span>
               </div>
               <div class="col-md-4 text-center">
                    <span><?php echo number_format($qtd, 0, ",", ".") . " contratos R$ " . number_format($val, 2, ",", "."); ?></span>
               </div>
          </div>
     </div>
     <div class="container-fluid">
          <form class="tel-1 text-center" name="frmTelCon" action="" method="POST">
               <div class="form-row">
                    <div class="col-sm-3">
                         <label>Nome do Cliente</label>
                         <select id="cli" name="cli" class="form-control">
                              <?php $ret = carrega_cli($cli); ?>
                         </select>
                    </div>
                    <div class="col-sm-3">
                         <label>Nome do Consultor</label>
                         <select id="con" name="con" class="form-control" <?php echo $con_l; ?>>
                              <?php $ret = carrega_csu($con); ?>
                         </select>
                    </div>
                    <div class="col-sm-1">
                         <label>Data Inicial</label>
                         <input type="text" class="form-control text-center" maxlength="10" id="dti" name="dti"
                              value="<?php echo $dti; ?>" required />
                    </div>
                    <div class="col-sm-1">
                         <label>Data Final</label>
                         <input type="text" class="form-control text-center" maxlength="10" id="dtf" name="dtf"
                              value="<?php echo $dtf; ?>" required />
                    </div>
                    <div class="col-sm-2">
                         <label>Status</label><br />
                         <select id="sta" name="sta" class="form-control">
                              <option value="9" <?php echo ($sta != 9 ? '' : 'selected="selected"'); ?>>
                                   Todos
                              </option>
                              <option value="0" <?php echo ($sta != 0 ? '' : 'selected="selected"'); ?>>
                                   Normal
                              </option>
                              <option value="1" <?php echo ($sta != 1 ? '' : 'selected="selected"'); ?>>
                                   Proposta
                              </option>
                              <option value="2" <?php echo ($sta != 2 ? '' : 'selected="selected"'); ?>>
                                   Não Aceita
                              </option>
                              <option value="3" <?php echo ($sta != 3 ? '' : 'selected="selected"'); ?>>
                                   Aberto
                              </option>
                              <option value="4" <?php echo ($sta != 4 ? '' : 'selected="selected"'); ?>>
                                   Cancelado
                              </option>
                              <option value="5" <?php echo ($sta != 5 ? '' : 'selected="selected"'); ?>>
                                   Suspenso
                              </option>
                              <option value="6" <?php echo ($sta != 6 ? '' : 'selected="selected"'); ?>>
                                   Encerrado
                              </option>
                         </select>
                    </div>
                    <div class="col-sm-2 text-center">
                         <br />
                         <button type="submit" id="con" name="consulta" class="bot-1"
                              title="Carrega ocorrências conforme periodo solicitado pelo usuário.">Pesquisar</button>
                    </div>
               </div>
               <br />
          </form>
     </div>
     <div class="container-fluid">
          <hr />
          <div class="row text-center">
               <div class="col-md-2">
                    <strong>
                         <span>Geral: R$ <?php echo number_format($tab[0] + $tab[1]  + $tab[2] + $tab[3] + $tab[5], 2, ",", "."); ?></span>
                    </strong>
               </div>
               <div class="col-md-2">
                    <strong>
                         <span>Descontos: R$ <?php echo number_format($tab[8], 2, ",", "."); ?></span>
                    </strong>
               </div>
               <div class="col-md-2">
                    <strong>
                         <span>Propostas: R$ <?php echo number_format($tab[1], 2, ",", "."); ?></span>
                    </strong>
               </div>
               <div class="col-md-2">
                    <strong>
                         <span>Contratos: R$ <?php echo number_format($tab[0] + $tab[3], 2, ",", "."); ?></span>
                    </strong>
               </div>
               <div class="col-md-2">
                    <strong>
                         <span>Suspensos: R$ <?php echo number_format($tab[5], 2, ",", "."); ?></span>
                    </strong>
               </div>
               <div class="col-md-2">
                    <strong>
                         <span>Não Aceitas: R$ <?php echo number_format($tab[2], 2, ",", "."); ?></span>
                    </strong>
               </div>
          </div>
          <hr />
          <div class="row">
               <div class="col-md-12">
                    <div class="tab-1 table-responsive">
                         <table id="tab-0" class="table table-sm table-striped">
                              <thead>
                                   <tr>
                                        <th>Contrato</th>
                                        <th>Status</th>
                                        <th>Nome do Cliente</th>
                                        <th class="text-center">Proposta</th>
                                        <th>Consultor</th>
                                        <th>Valor</th>
                                        <th>Desconto</th>
                                        <th>Liquido</th>
                                        <th>Descricao do Servico</th>
                                        <th>Vigencia</th>
                                        <th>Inicio</th>
                                        <th>Final</th>
                                        <th class="text-center">Dias</th>
                                        <th>Preco</th>
                                        <th>Desconto</th>
                                        <th>Parcela</th>
                                        <th>Liquido</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php $ret = carrega_con($sta, $dti, $dtf, $cli, $con, $com);  ?>
                              </tbody>
                         </table>
                    </div>
               </div>
          </div>
     </div>
     <div id="box10">
          <img class="subir" src="img/subir.png" title="Volta a página para o seu topo." />
     </div>
</body>

<?php
function carrega_nro($sta, $dti, $dtf, $cli, $con, &$com, &$qtd, &$val) {
     include_once "dados.php"; $ret = 0; $val = 0; $qtd = 0; $ant = 0;     
     $dti = substr($dti,6,4) . "-" . substr($dti,3,2) . "-" . substr($dti,0,2) . " 00:00:00";
     $dtf = substr($dtf,6,4) . "-" . substr($dtf,3,2) . "-" . substr($dtf,0,2) . " 23:59:59";
     $com  = "Select I.*, C.*, X.connome, Y.clirazao, S.serdescricao from ((((tb_contrato_s I left join tb_contrato C on I.itecontrato = C.idcontrato) ";
     $com .= " left join tb_consultor X on C.conconsultor = X.idconsultor) ";
     $com .= " left join tb_cliente Y on C.concliente = Y.idcliente) ";
     $com .= " left join tb_servico S on I.iteservico = S.idservico) ";
     $com .= " where C.conempresa = " .  $_SESSION['wrkcodemp'] . " ";
     $com .= " and I.itedataini between '" . $dti . "' and '" . $dtf . "' ";
     if ($sta != 9) { $com .= " and C.constatus = " . $sta; }
     if ($cli != 0) { $com .= " and C.concliente = " . $cli; }
     if ($con != 0) { $com .= " and C.conconsultor = " . $con; }
     if ($_SESSION['wrktipusu'] <= 1) { $com .= " and C.conconsultor = " . $_SESSION['wrkcodcon']; }
     $com .= " order by C.concliente";
     $nro = leitura_reg($com, $reg);
     foreach ($reg as $lin) {
          if ($ant != $lin['concliente']) {
               $qtd = $qtd + 1;
               $ant = $lin['concliente'];
          }
          $val = $val + ($lin['itepreco'] * (1 - $lin['itedesconto'] / 100));
     }
     return $ret;
}

function carrega_con($sta, $dti, $dtf, $cli, $con, $com) {
     include_once "dados.php";
     $avi1 = retorna_dad("empaviso1", "tb_empresa", "idempresa", $_SESSION['wrkcodemp']);
     $avi2 = retorna_dad("empaviso2", "tb_empresa", "idempresa", $_SESSION['wrkcodemp']);
     $nro = leitura_reg($com, $reg);
     foreach ($reg as $lin) {
          $txt = "<tr>";
          $dia = diferenca_dat("", $lin['itedatafim']);
          if ($dia < $avi1 && $dia > 0) {
               $txt =  '<tr class="cor-1">';
          } else if ($dia >= $avi1 && $dia < $avi2) {
               $txt =  '<tr class="cor-3">';
          } else if ($dia >= $avi2) {
               $txt =  '<tr>';
          } else if ($lin['constatus'] != 6 && $dia < 0) {
               $txt =  '<tr class="cor-4">';
          }
          $txt .= '<td class="text-center">' . str_pad($lin['idcontrato'], 6, "0", STR_PAD_LEFT)  . '</td>';
          if ($lin['constatus'] == 0) {$txt .= '<td>' . "Normal" . '</td>';}
          if ($lin['constatus'] == 1) {$txt .= '<td>' . "Proposta" . '</td>';}
          if ($lin['constatus'] == 2) {$txt .= '<td>' . "Não Aceita" . '</td>';}
          if ($lin['constatus'] == 3) {$txt .= '<td>' . "Em Aberto" . '</td>';}
          if ($lin['constatus'] == 4) {$txt .= '<td>' . "Cancelado" . '</td>';}
          if ($lin['constatus'] == 5) {$txt .= '<td>' . "Suspenso" . '</td>';}
          if ($lin['constatus'] == 6) {$txt .= '<td>' . "Finalizado" . '</td>';}
          $txt .= '<td>' . limpa_cpo($lin['clirazao']) . '</td>';
          $txt .= '<td class="text-center">' . ($lin['conproposta'] == 0 ? 'Nao' : 'Sim') . '</td>';
          $txt .= '<td>' . limpa_cpo($lin['connome']) . '</td>';
          $txt .= '<td class="text-right">' . number_format($lin['convaltotal'], 2, ",", ".") . '</td>';
          $txt .= '<td class="text-right">' . number_format($lin['convaldesconto'], 2, ",", ".") . '</td>';
          $txt .= '<td class="text-right">' . number_format($lin['convaltotal'] - $lin['convaldesconto'], 2, ",", ".") . '</td>';
          $txt .= '<td>' . limpa_cpo($lin['serdescricao']) . '</td>';
          if ($lin['itevigencia'] == 0) {$txt .= "<td>" . "Esporárido" . "</td>";}
          if ($lin['itevigencia'] == 1) {$txt .= "<td>" . "Mensal" . "</td>";}
          if ($lin['itevigencia'] == 2) {$txt .= "<td>" . "Bimestral" . "</td>";}
          if ($lin['itevigencia'] == 3) {$txt .= "<td>" . "Trimestral" . "</td>";}
          if ($lin['itevigencia'] == 4) {$txt .= "<td>" . "Semestral" . "</td>";}
          if ($lin['itevigencia'] == 5) {$txt .= "<td>" . "Anual" . "</td>";}
          if ($lin['itevigencia'] == 6) {$txt .= "<td>" . "Bianual" . "</td>";}
          if ($lin['itevigencia'] == 7) {$txt .= "<td>" . "Trianual" . "</td>";}
          $txt .= '<td>' . date('d/m/Y',strtotime($lin['itedataini'])) . '</td>';
          $txt .= '<td>' . date('d/m/Y',strtotime($lin['itedatafim'])) . '</td>';
          $txt .= '<td class="text-center">' . number_format($dia, 0, ",", ".") . '</td>';
          $txt .= '<td class="text-right">' . number_format($lin['itepreco'], 2, ",", ".") . '</td>';
          $txt .= '<td class="text-right">' . number_format($lin['itedesconto'], 2, ",", ".") . '</td>';
          $txt .= '<td class="text-center">' . $lin['iteparcela'] . '</td>';
          $txt .= '<td class="text-right">' . number_format(($lin['itepreco'] * (1 - $lin['itedesconto'] / 100)), 2, ",", ".") . '</td>';
          $txt .= "</tr>";
          echo $txt; 
     }
}

function carrega_ger($sta, $dti, $dtf, &$tab) {
     $qtd = 0;
     $tab[0] = 0;
     $tab[1] = 0;
     $tab[2] = 0;
     $tab[3] = 0;
     $tab[4] = 0;
     $tab[5] = 0;
     $tab[6] = 0;
     $tab[8] = 0;
     $tab[9] = 0;
     include_once "dados.php";
     date_default_timezone_set("America/Sao_Paulo");
     $dti = substr($dti,6,4) . "-" . substr($dti,3,2) . "-" . substr($dti,0,2) . " 00:00:00";
     $dtf = substr($dtf,6,4) . "-" . substr($dtf,3,2) . "-" . substr($dtf,0,2) . " 23:59:59";
     $com  = "Select * from tb_contrato where conempresa = " .  $_SESSION['wrkcodemp'] . " ";
     $com .= " and condataemi between '" . $dti . "' and '" . $dtf . "' ";
     $nro = leitura_reg($com, $reg);
     foreach ($reg as $lin) {
          $qtd = $qtd + 1;
          $tab[8] += $lin['convaldesconto'];
          $tab[9] += $lin['convaltotal'];
          $tab[$lin['constatus']] += $lin['convaltotal'];
     }
     return $qtd;
}

function carrega_cli($cli) {
     $sta = 0;
     include_once "dados.php";    
      echo '<option value="0" selected="selected">Todos os cliente cadastrados ...</option>';
     $com = "Select idcliente, clirazao from tb_cliente where clistatus = 0 and cliempresa = " . $_SESSION['wrkcodemp'] . " order by clirazao, idcliente";
     $nro = leitura_reg($com, $reg);
     foreach ($reg as $lin) {
          if ($lin['idcliente'] != $cli) {
               echo  '<option value ="' . $lin['idcliente'] . '">' . $lin['clirazao'] . '</option>'; 
          } else {
               echo  '<option value ="' . $lin['idcliente'] . '" selected="selected">' . $lin['clirazao'] . '</option>';
          }
     }
     return $sta;
}

function carrega_csu($con) {
     $sta = 0;
     include_once "dados.php";    
      echo '<option value="0" selected="selected">Todos os consultores cadastrados ...</option>';
     $com = "Select idconsultor, connome from tb_consultor where constatus = 0 and conempresa = " . $_SESSION['wrkcodemp'] . " order by connome, idconsultor";
     $nro = leitura_reg($com, $reg);
     foreach ($reg as $lin) {
          if ($lin['idconsultor'] != $con) {
               echo  '<option value ="' . $lin['idconsultor'] . '">' . $lin['connome'] . '</option>'; 
          } else {
               echo  '<option value ="' . $lin['idconsultor'] . '" selected="selected">' . $lin['connome'] . '</option>';
          }
     }
     return $sta;
}

?>

</html>