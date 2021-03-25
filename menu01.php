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

     <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.min.js"></script> <!-- 2.9.4 / 2.7.0 -->

     <link href="css/pallas46.css" rel="stylesheet" type="text/css" media="screen" />
     <title>Menu - Gerenciamento de Contratos - SearchMidia - Profsa Informátda Ltda</title>
</head>

<script>
$(document).ready(function() {
     var alt = $(window).height();
     var lar = $(window).width();
     if (lar < 800) {
          $('nav').removeClass("fixed-top");
     }

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
     $ret = 0; $ima = ''; 
     include_once "profsa.php";
     $_SESSION['wrknumvol'] = 0;
     $_SESSION['wrknompro'] = __FILE__; 
     date_default_timezone_set("America/Sao_Paulo");
     $_SESSION['wrkdatide'] = date ("d/m/Y H:i:s", getlastmod());
     $_SESSION['wrknomide'] = get_current_user();
     $_SESSION['wrknumusu'] = getmypid();
     if (isset($_SESSION['wrknomusu']) == false) {
          exit('<script>location.href = "index.php"</script>');   
     } elseif ($_SESSION['wrknomusu'] == "") {
          exit('<script>location.href = "index.php"</script>');   
     } elseif ($_SESSION['wrknomusu'] == "*") {
          exit('<script>location.href = "index.php"</script>');   
     } elseif ($_SESSION['wrknomusu'] == "#") {
          exit('<script>location.href = "index.php"</script>');   
     }
     
     $_SESSION['wrkopereg'] = 0; $_SESSION['wrkcodreg'] = 0; $_SESSION['wrklogemp'] = ''; 
     if (isset($_SESSION['wrkendser']) == false) { $_SESSION['wrkendser'] = getenv("REMOTE_ADDR"); }

     if (isset($_REQUEST['ope']) == true) { $_SESSION['wrkopereg'] = $_REQUEST['ope']; }
     if (isset($_REQUEST['cod']) == true) { $_SESSION['wrkcodemp'] = $_REQUEST['cod']; }
     if ($_SESSION['wrkcodemp'] > 0) {
          $cam = "emp_" . str_pad($_SESSION['wrkcodemp'], 3, "0", STR_PAD_LEFT) . "/" . "log_" . str_pad($_SESSION['wrkcodemp'], 3, "0", STR_PAD_LEFT);
          if (file_exists($cam . '.png') == true) { $_SESSION['wrklogemp'] = $cam . '.png'; }
          if (file_exists($cam . '.jpg') == true) { $_SESSION['wrklogemp'] = $cam . '.jpg'; }
          if (file_exists($cam . '.jpeg') == true) { $_SESSION['wrklogemp'] = $cam . '.jpeg'; }
     }
     $tab = array(); 
     $ret = carrega_dash($tab);

?>

<body id="box00">
     <h1 class="cab-0">Menu Principal - SearchMidia Marketing de Resultado - Profsa Informática</h1>
     <div class="row">
          <div class="col-md-12">
               <?php include_once "cabecalho-1.php"; ?>
          </div>
     </div>
     <div class="container-fluid">
          <div class="row text-center">
               <div class="col-md-12">
                    <h2><span><strong><i class="fa fa-tachometer fa-1g" aria-hidden="true"></i>
                                   DashBoard</strong></span></h2>
               </div>
          </div>
          <br /><hr />
          <div class="form-row">
               <div class="col-md-3">
                    <h4>Serviços Mensais</h4>
                    <?php echo $tab['men']; ?>
               </div>
               <div class="col-md-3">
                    <h4>Serviços Trimestrais</h4>
                    <?php echo $tab['tri']; ?>
               </div>
               <div class="col-md-3">
               <h4>Serviços Semestrais</h4>
                    <?php echo $tab['sem']; ?>
               </div>
               <div class="col-md-3">
               <h4>Serviços Anuais</h4>
                    <?php echo $tab['anu']; ?>
               </div>
          </div>
          <br /><hr />
          <div class="row">
               <div class="col-md-6">
                    <h4><strong>Últimos Clientes</strong></h4>
                    <?php echo $tab['cli']; ?>
               </div>
               <div class="col-md-6">
                    <h4><strong>Últimos Contratos</strong></h4>
                    <?php echo $tab['con']; ?>
               </div>
          </div>
          <br />
     </div>
     <br />
     <div id="box10">
          <img class="subir" src="img/subir.png" title="Volta a página para o seu topo." />
     </div>
</body>

<?php
function carrega_dash(&$tab) {
     $sta = 0;
     include_once "dados.php";
     $tab['men'] = '<table id="tab-0" class="tab-1 tab-3 table table-sm table-striped">
     <thead>
          <tr>
               <th>Contrato</th>
               <th>Cliente</th>
               <th>Serviço</th>
               <th>Início</th>
               <th>Vencto</th>
          </tr>
     </thead>
     <tbody>';
     $com  = "Select I.*, C.*, X.connome, Y.clifantasia, S.serdescricao from ((((tb_contrato_s I left join tb_contrato C on I.itecontrato = C.idcontrato) ";
     $com .= " left join tb_consultor X on C.conconsultor = X.idconsultor) ";
     $com .= " left join tb_cliente Y on C.concliente = Y.idcliente) ";
     $com .= " left join tb_servico S on I.iteservico = S.idservico) ";
     $com .= " where I.iteempresa = " .  $_SESSION['wrkcodemp'] . " and I.itevigencia = 1 ";
     if ($_SESSION['wrktipusu'] <= 2)  { $com .= " and C.conconsultor = " .  $_SESSION['wrkcodcon'] . " "; }
     $com .= " order by C.idcontrato Limit 15";
     $nro = leitura_reg($com, $reg);
     foreach ($reg as $lin) {
          $tab['men'] .=  '<tr>';
          $tab['men'] .= '<td class="text-center">' . str_pad($lin['idcontrato'], 6, "0", STR_PAD_LEFT)  . '</td>';
          $tab['men'] .= '<td>' . limpa_cpo($lin['clifantasia']) . '</td>';
          $tab['men'] .= '<td>' . limpa_cpo($lin['serdescricao']) . '</td>';
          $tab['men'] .= '<td>' . date('d/m/Y',strtotime($lin['itedataini'])) . '</td>';
          $tab['men'] .= '<td>' . date('d/m/Y',strtotime($lin['itedatafim'])) . '</td>';
          $tab['men'] .= '</tr>';
     }
     $tab['men'] .=  '</tbody></table>';

// *************************************************************************************************************************************************
     $tab['tri'] = '<table id="tab-0" class="tab-1 tab-3 table table-sm table-striped">
     <thead>
          <tr>
               <th>Contrato</th>
               <th>Cliente</th>
               <th>Serviço</th>
               <th>Início</th>
               <th>Vencto</th>
          </tr>
     </thead>
     <tbody>';
     $com  = "Select I.*, C.*, X.connome, Y.clifantasia, S.serdescricao from ((((tb_contrato_s I left join tb_contrato C on I.itecontrato = C.idcontrato) ";
     $com .= " left join tb_consultor X on C.conconsultor = X.idconsultor) ";
     $com .= " left join tb_cliente Y on C.concliente = Y.idcliente) ";
     $com .= " left join tb_servico S on I.iteservico = S.idservico) ";
     $com .= " where I.iteempresa = " .  $_SESSION['wrkcodemp'] . " and I.itevigencia = 3 ";
     if ($_SESSION['wrktipusu'] <= 2)  { $com .= " and C.conconsultor = " .  $_SESSION['wrkcodcon'] . " "; }
     $com .= " order by C.idcontrato Limit 15";
     $nro = leitura_reg($com, $reg);
     foreach ($reg as $lin) {
          $tab['tri'] .=  '<tr>';
          $tab['tri'] .= '<td class="text-center">' . str_pad($lin['idcontrato'], 6, "0", STR_PAD_LEFT)  . '</td>';
          $tab['tri'] .= '<td>' . limpa_cpo($lin['clifantasia']) . '</td>';
          $tab['tri'] .= '<td>' . limpa_cpo($lin['serdescricao']) . '</td>';
          $tab['tri'] .= '<td>' . date('d/m/Y',strtotime($lin['itedataini'])) . '</td>';
          $tab['tri'] .= '<td>' . date('d/m/Y',strtotime($lin['itedatafim'])) . '</td>';
          $tab['tri'] .= '</tr>';
     }
     $tab['tri'] .=  '</tbody></table>';
// *************************************************************************************************************************************************
     $tab['sem'] = '<table id="tab-0" class="tab-1 tab-3 table table-sm table-striped">
     <thead>
          <tr>
               <th>Contrato</th>
               <th>Cliente</th>
               <th>Serviço</th>
               <th>Início</th>
               <th>Vencto</th>
          </tr>
     </thead>
     <tbody>';
     $com  = "Select I.*, C.*, X.connome, Y.clifantasia, S.serdescricao from ((((tb_contrato_s I left join tb_contrato C on I.itecontrato = C.idcontrato) ";
     $com .= " left join tb_consultor X on C.conconsultor = X.idconsultor) ";
     $com .= " left join tb_cliente Y on C.concliente = Y.idcliente) ";
     $com .= " left join tb_servico S on I.iteservico = S.idservico) ";
     $com .= " where I.iteempresa = " .  $_SESSION['wrkcodemp'] . " and I.itevigencia = 4 ";
     if ($_SESSION['wrktipusu'] <= 2)  { $com .= " and C.conconsultor = " .  $_SESSION['wrkcodcon'] . " "; }
     $com .= " order by C.idcontrato Limit 15";
     $nro = leitura_reg($com, $reg);
     foreach ($reg as $lin) {
          $tab['sem'] .=  '<tr>';
          $tab['sem'] .= '<td class="text-center">' . str_pad($lin['idcontrato'], 6, "0", STR_PAD_LEFT)  . '</td>';
          $tab['sem'] .= '<td>' . limpa_cpo($lin['clifantasia']) . '</td>';
          $tab['sem'] .= '<td>' . limpa_cpo($lin['serdescricao']) . '</td>';
          $tab['sem'] .= '<td>' . date('d/m/Y',strtotime($lin['itedataini'])) . '</td>';
          $tab['sem'] .= '<td>' . date('d/m/Y',strtotime($lin['itedatafim'])) . '</td>';
          $tab['sem'] .= '</tr>';
     }
     $tab['sem'] .=  '</tbody></table>';

// *************************************************************************************************************************************************
     $tab['anu'] = '<table id="tab-0" class="tab-1 tab-3 table table-sm table-striped">
     <thead>
          <tr>
               <th>Contrato</th>
               <th>Cliente</th>
               <th>Serviço</th>
               <th>Início</th>
               <th>Vencto</th>
          </tr>
     </thead>
     <tbody>';
     $com  = "Select I.*, C.*, X.connome, Y.clifantasia, S.serdescricao from ((((tb_contrato_s I left join tb_contrato C on I.itecontrato = C.idcontrato) ";
     $com .= " left join tb_consultor X on C.conconsultor = X.idconsultor) ";
     $com .= " left join tb_cliente Y on C.concliente = Y.idcliente) ";
     $com .= " left join tb_servico S on I.iteservico = S.idservico) ";
     $com .= " where I.iteempresa = " .  $_SESSION['wrkcodemp'] . " and I.itevigencia = 5 ";
     if ($_SESSION['wrktipusu'] <= 2)  { $com .= " and C.conconsultor = " .  $_SESSION['wrkcodcon'] . " "; }
     $com .= " order by C.idcontrato Limit 15";
     $nro = leitura_reg($com, $reg);
     foreach ($reg as $lin) {
          $tab['anu'] .=  '<tr>';
          $tab['anu'] .= '<td class="text-center">' . str_pad($lin['idcontrato'], 6, "0", STR_PAD_LEFT)  . '</td>';
          $tab['anu'] .= '<td>' . limpa_cpo($lin['clifantasia']) . '</td>';
          $tab['anu'] .= '<td>' . limpa_cpo($lin['serdescricao']) . '</td>';
          $tab['anu'] .= '<td>' . date('d/m/Y',strtotime($lin['itedataini'])) . '</td>';
          $tab['anu'] .= '<td>' . date('d/m/Y',strtotime($lin['itedatafim'])) . '</td>';
          $tab['anu'] .= '</tr>';
     }
     $tab['anu'] .=  '</tbody></table>';

// *************************************************************************************************************************************************
$tab['cli'] = '<table id="tab-0" class="tab-1 table table-sm table-striped">
     <thead>
          <tr>
               <th>Status</th>
               <th>Nome Fantasia</th>
               <th>Celular</th>
               <th>E-Mail</th>
               <th>Nome do Contato</th>
          </tr>
     </thead>
     <tbody>';
     if ($_SESSION['wrktipusu'] > 2)  { 
          $com = "Select * from tb_cliente where cliempresa = " .  $_SESSION['wrkcodemp'] . " order by idcliente Limit 15";
     } else {
          $com = "Select * from tb_cliente where cliempresa = " .  $_SESSION['wrkcodemp'] . " and cliconsultor = " . $_SESSION['wrkcodcon']  . " order by idcliente Limit 15";
     }
     $nro = leitura_reg($com, $reg);
     foreach ($reg as $lin) {
          $tab['cli'] .=  '<tr>';
          if ($lin['clistatus'] == 0) {$tab['cli'] .= "<td>" . "Ativo" . "</td>";}
          if ($lin['clistatus'] == 1) {$tab['cli'] .= "<td>" . "Inativo" . "</td>";}
          if ($lin['clistatus'] == 2) {$tab['cli'] .= "<td>" . "Suspenso" . "</td>";}
          if ($lin['clistatus'] == 3) {$tab['cli'] .= "<td>" . "Cancelado" . "</td>";}
          $tab['cli'] .= "<td>" . $lin['clifantasia'] . "</td>";
          $tab['cli'] .= '<td class="cel-w cur-1">' . $lin['clicelular'] . '</td>';
          $tab['cli'] .= "<td>" . $lin['cliemail'] . "</td>";
          $tab['cli'] .= "<td>" . $lin['clicontato'] . "</td>";
          $tab['cli'] .= "</tr>";
     }
     $tab['cli'] .=  '</tbody></table>';

// *************************************************************************************************************************************************
     $tab['con'] = '<table id="tab-0" class="tab-1 table table-sm table-striped">
     <thead>
          <tr>
               <th>Contrato</th>
               <th>Status</th>
               <th>Cliente</th>
               <th class="text-center">Proposta</th>
               <th>Serviço</th>
               <th>Início</th>
               <th>Vencto</th>
               <th class="text-center">Dias</th>
          </tr>
     </thead>
     <tbody>';
     $avi1 = retorna_dad("empaviso1", "tb_empresa", "idempresa", $_SESSION['wrkcodemp']);
     $avi2 = retorna_dad("empaviso2", "tb_empresa", "idempresa", $_SESSION['wrkcodemp']);
     $com  = "Select I.*, C.*, X.connome, Y.clifantasia, S.serdescricao from ((((tb_contrato_s I left join tb_contrato C on I.itecontrato = C.idcontrato) ";
     $com .= " left join tb_consultor X on C.conconsultor = X.idconsultor) ";
     $com .= " left join tb_cliente Y on C.concliente = Y.idcliente) ";
     $com .= " left join tb_servico S on I.iteservico = S.idservico) ";
     $com .= " where I.iteempresa = " .  $_SESSION['wrkcodemp'] . " ";
     if ($_SESSION['wrktipusu'] <= 2)  { $com .= " and C.conconsultor = " .  $_SESSION['wrkcodcon'] . " "; }
     $com .= " order by C.idcontrato Limit 15";
     $nro = leitura_reg($com, $reg);
     foreach ($reg as $lin) {
          $dia = diferenca_dat("", $lin['itedatafim']);
          if ($dia < $avi1 && $dia > 0) {
               $tab['con'] .=  '<tr class="cor-1">';
          } else if ($dia >= $avi1 && $dia < $avi2) {
               $tab['con'] .=  '<tr class="cor-3">';
          } else if ($dia >= $avi2 && $lin['constatus'] != 5) {
               $tab['con'] .=  '<tr>';
          } else if ($lin['constatus'] == 5) {
               $tab['con'] .=  '<tr class="cor-5">';
          } else if ($lin['constatus'] != 6 && $dia < 0) {
               $tab['con'] .=  '<tr class="cor-4">';
          } else {
               $tab['con'] .=  '<tr>';
          }
          $tab['con'] .= '<td class="text-center">' . str_pad($lin['idcontrato'], 6, "0", STR_PAD_LEFT)  . '</td>';
          if ($lin['itestatus'] == 0) {$tab['con'] .= '<td>' . "Normal" . '</td>';}
          if ($lin['itestatus'] == 1) {$tab['con'] .= '<td>' . "Proposta" . '</td>';}
          if ($lin['itestatus'] == 2) {$tab['con'] .= '<td>' . "Não Aceita" . '</td>';}
          if ($lin['itestatus'] == 3) {$tab['con'] .= '<td>' . "Em Aberto" . '</td>';}
          if ($lin['itestatus'] == 4) {$tab['con'] .= '<td>' . "Cancelado" . '</td>';}
          if ($lin['itestatus'] == 5) {$tab['con'] .= '<td>' . "Suspenso" . '</td>';}
          if ($lin['itestatus'] == 6) {$tab['con'] .= '<td>' . "Finalizado" . '</td>';}
          $tab['con'] .= '<td>' . limpa_cpo($lin['clifantasia']) . '</td>';
          $tab['con'] .= '<td class="text-center">' . ($lin['conproposta'] == 0 ? 'Nao' : 'Sim') . '</td>';
          $tab['con'] .= '<td>' . limpa_cpo($lin['serdescricao']) . '</td>';
          $tab['con'] .= '<td>' . date('d/m/Y',strtotime($lin['itedataini'])) . '</td>';
          $tab['con'] .= '<td>' . date('d/m/Y',strtotime($lin['itedatafim'])) . '</td>';
          $tab['con'] .= '<td class="text-center">' . $dia . '</td>';
          $tab['con'] .= '</tr>';
     }
     $tab['con'] .=  '</tbody></table>';

     return $sta;
}

?>

</html>