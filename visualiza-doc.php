<?php 
     session_start(); $pro = 0;
     if (isset($_REQUEST['pro']) == true) { $pro = $_REQUEST['pro']; }
?>
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

     <script type="text/javascript" src="js/datepicker-pt-BR.js"></script>

     <script type="text/javascript" src="js/jquery.mask.min.js"></script>

     <link href="css/pallas46.css" rel="stylesheet" type="text/css" media="screen" />
     <link href="css/pallas46p.css" rel="stylesheet" type="text/css" media="print" />

     <title><?php echo ($pro == 1 ? "Proposta SearchMidia" : "Contrato SearchMidia") ?></title>
</head>

<script>

$(document).ready(function() {

     let alt = $(window).height();
     let lar = $(window).width();

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
     $ope = 0;
     $cod = 0;
     include_once "dados.php";
     include_once "profsa.php";
     $_SESSION['wrknompro'] = __FILE__;
     date_default_timezone_set("America/Sao_Paulo");
     if (isset($_SESSION['wrknomusu']) == false) {
          exit('<script>location.href = "index.php"</script>');   
     } elseif ($_SESSION['wrknomusu'] == "") {
          exit('<script>location.href = "index.php"</script>');   
     } elseif ($_SESSION['wrknomusu'] == "*") {
          exit('<script>location.href = "index.php"</script>');   
     } elseif ($_SESSION['wrknomusu'] == "#") {
          exit('<script>location.href = "index.php"</script>');   
     }   
     $_SESSION['wrkdatide'] = date ("d/m/Y H:i:s", getlastmod());
     $_SESSION['wrknomide'] = get_current_user();
     if (isset($_SERVER['HTTP_REFERER']) == true) {
          if (limpa_pro($_SESSION['wrknompro']) != limpa_pro($_SERVER['HTTP_REFERER'])) {
               $_SESSION['wrkproant'] = limpa_pro($_SERVER['HTTP_REFERER']);
               $ret = gravar_log(8,"Entrada na página de visualização de contratos do sistema Pallas.46 - SearchMidia");  
          }
     }
     if (isset($_SESSION['wrkopereg']) == false) { $_SESSION['wrkopereg'] = 0; }
     if (isset($_SESSION['wrkcodreg']) == false) { $_SESSION['wrkcodreg'] = 0; }
     if (isset($_REQUEST['cod']) == true) { $cod = $_REQUEST['cod']; }

     if ($pro == 0) {
          $txt = carrega_con($cod);
     } else {
          $txt = carrega_pro($cod);
     }
?>

<body id="box00">
     <h1 class="cab-0">Proposta SearchMidia - <?php echo date('d/m/Y H:i:s'); ?></h1>
     <div class="row">
          <div class="col-12">
               <?php echo $txt; ?>
          </div>
     </div>

</body>

<?php
function carrega_pro($cod) {
     $txt = ""; $qtd = 0;
     include_once "dados.php";
     $com  = "Select C.*, X.*, Y.*, Z.emprazao, Z.empfantasia, Z.emptelefone, Z.empcelular, Z.empemail, Z.empendereco, Z.empnumeroend, Z.empnumeroend, Z.empcomplemento, Z.empwebsite, Z.empcidade, Z.empestado from ((((tb_contrato C left join tb_consultor X on C.conconsultor = X.idconsultor) ";
     $com .= " left join tb_empresa Z on C.conempresa = Z.idempresa) ";
     $com .= " left join tb_cliente Y on C.concliente = Y.idcliente) ";
     $com .= " left join tb_pagto W on C.conpagto = W.idpagto) ";
     $com .= " where idcontrato = " . $cod;
     $nro = acessa_reg($com, $reg);
     if ($nro == 0 || $reg == false) {
          echo '<script>alert("Número do documento informado não cadastrado");</script>'; return 9;
     }

     $txt .= '<!DOCTYPE html>';
     $txt .= '<html lang="pt_br">';
     $txt .= '<head>';
     $txt .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
     $txt .= '<meta name="description" content="Profsa Informática - Gerenciamento de Contratos - SearchMidia" />';
     $txt .= '<meta name="author" content="Paulo Rogério Souza" />';
     $txt .= '<style type="text/css">';
     $txt .= 'body { font-family: Lato}';
     $txt .= '.corpo { width: 1000px; height: auto; margin: 10px auto; border: 0.25px solid #bab8b8; }';
     $txt .= '.tit-a { width: 1000px; margin: 10px auto; padding: 10px; border: 0.25px solid #bab8b8; }';
     $txt .= '.tit-a h3 { float: right; }';

     $txt .= '.con-a { width: 100%;  text-align: center; color: #ffffff;  background-color: #405d9b; font-size: 28px;  font-weight: bold; }';
    
     $txt .= '.con-b { width: 1000px; }';
     $txt .= '.con-b td { padding: 5px; font-size: 22px; }';
     $txt .= '.con-b span { font-weight: bold; }';

     $txt .= '.inf-a { font-size: 22px; text-align: justify; padding: 0px 10px; }';

     $txt .= '.ser-a { margin: 0px 10px; font-size: 20px;  font-weight: bold; }';

     $txt .= '.lit-a { font-weight: bold; }';
     $txt .= '.ima-a { margin: 10px 0px; }';

     $txt .= '.rod-a { text-align: center; font-size: 18px; }';

     $txt .= '.tab-a { margin: 0px 10px; }';
     $txt .= '.tab-a table { width: 100%; margin: 0px auto; }';
     $txt .= '.tab-a th { border: 0.5px solid #000000; }';
     $txt .= '.tab-a td { border-right: 0.5px solid #000000; padding: 0px 5px; }';
 
     $txt .= '.col-a { text-align: right; }';
     $txt .= '.col-b { text-align: center; }';

     $txt .= '</style>';

     $txt .= '</head>';

     $txt .= '<body>';

     $txt .= '<div class="tit-a">';
     if ($_SESSION['wrklogemp'] == "") {
          $txt .= '<img class="ima-a" src="img/logo-12.png">';
     } else {
          $txt .= '<img class="ima-a" src="' . $_SESSION['wrklogemp'] . '">';
     }
     $txt .= '<h3><strong><br />' . 'Proposta de Prestação de Serviços - Nº ' . str_pad($reg['idcontrato'], 6, "0", STR_PAD_LEFT) . '</strong></h3>';
     $txt .= '</div>';

     $txt .= '<div class="corpo">';
     $txt .= '<div class="con-a">';
     $txt .= '<span>CONSULTOR</span>';
     $txt .= '</div>';

     $txt .= '<table class="con-b">';
     $txt .= '<tbody>';
     $txt .= '<tr>';
     $txt .= '<td width="50%"><span>Nome: </span>' . $reg['connome'] . '</td>';
     $txt .= '<td><span>Celular: </span>' . $reg['concelular'] . '</td>';
     $txt .= '</tr>';
     $txt .= '<tr>';
     $txt .= '<td>' . '</td>';
     $txt .= '<td><span>E-Mail: </span>' . $reg['conemail'] . '</td>';
     $txt .= '</tr>';    
     $txt .= '</tbody>';
     $txt .= '</table>';
    
     $txt .= '<div class="con-a">';
     $txt .= '<span>CLIENTE</span>';
     $txt .= '</div>';
     $txt .= '<table class="con-b">';
     $txt .= '<tbody>';
     $txt .= '<tr>';
     $txt .= '<td width="50%"><span>Empresa: </span>' . $reg['clifantasia'] . '</td>';
     if ($reg['clipessoa'] == 0) {
          $txt .= '<td><span>CPF: </span>' . mascara_cpo($reg['clicnpj'], "   .   .   /  ") . '</td>';
     } else {
          $txt .= '<td><span>CNPJ: </span>' . mascara_cpo($reg['clicnpj'], "  .   .   /    -  ") . '</td>';
     }
     $txt .= '</tr>';
     $txt .= '<tr>';
     $txt .= '<td><span>Telefone: </span>' . $reg['clitelefone'] . '</td>';
     $txt .= '<td><span>E-Mail: </span>' . $reg['cliemail'] . '</td>';
     $txt .= '</tr>';    
     $txt .= '</tbody>';
     $txt .= '</table>';

     $txt .= '<div class="con-a">';
     $txt .= '<span>INFORMAÇÕES</span>';
     $txt .= '</div>';
     $txt .= '<span class="inf-a">Essa proposta tem o objetivo de informar os serviços que podemos realizar, visando a divulgação de sua empresa ou produtos. Foi elaborada após análise feita com base na concorrência e no seu mercado de atuação. Os serviços propostos podem ser alterados de acordo com a verba disponível.</span>';    
    
     $txt .= '<div class="con-a">';
     $txt .= '<span>SERVIÇOS E VALORES</span>';
     $txt .= '</div>';
     $txt .= '<div class="tab-a">';
     $txt .= '<table>';
     $txt .= '<thead>';
     $txt .= '<tr>';
     $txt .= '<th width="40%">&nbsp; Produtos / Serviços / Anúncios</th>';
     $txt .= '<th width="10%">&nbsp; Vigência</th>';
     $txt .= '<th class="col-b">Preço</th>';
     $txt .= '<th class="col-b">Parcelas</th>';
     $txt .= '<th class="col-b">Desconto</th>';
     $txt .= '<th class="col-b">Valor</th>';
     $txt .= '</tr>';
     $txt .= '</thead>';
     $com  = "Select I.*, S.serdescricao from (tb_contrato_s I left join tb_servico S on I.iteservico = S.idservico)  where I.iteempresa = " .  $_SESSION['wrkcodemp'] . " and I.itecontrato = " . $cod . " order by I.iditem";
     $nro = leitura_reg($com, $ser);
     $txt .= '<tbody>';
     foreach ($ser as $lin) {
          $qtd = $qtd + 1;
          $txt .=  '<tr>';
          $txt .= '<td>&nbsp; ' . $lin['serdescricao'] . '</td>';
          if ($lin['itevigencia'] == 0) { $txt .= '<td>' . "S/ Vigência" . '</td>'; }
          if ($lin['itevigencia'] == 1) { $txt .= '<td>' . "Mensal" . '</td>';  }
          if ($lin['itevigencia'] == 2) { $txt .= '<td>' . "Bimestral" . '</td>';  }
          if ($lin['itevigencia'] == 3) { $txt .= '<td>' . "Trimestral" . '</td>'; }
          if ($lin['itevigencia'] == 4) { $txt .= '<td>' . "Semestral" . '</td>';  }
          if ($lin['itevigencia'] == 5) { $txt .= '<td>' . "Anual" . '</td>';  }
          if ($lin['itevigencia'] == 6) { $txt .= '<td>' . "Bianual" . '</td>';  }
          if ($lin['itevigencia'] == 7) { $txt .= '<td>' . "Trianual" . '</td>';  }
          $txt .= '<td class="col-a">R$ ' . number_format($lin['itepreco'], 2, ",", ".") . '</td>';
          $txt .= '<td class="col-b">' . $lin['iteparcela'] . '</td>';
          $txt .= '<td class="col-b">' . number_format($lin['itedesconto'], 2, ",", ".") . '%</td>';
          $txt .= '<td class="col-a">R$ ' . number_format($lin['itepreco'] * (1 - $lin['itedesconto'] / 100) / $lin['iteparcela'], 2, ",", ".") . '</td>';
          $txt .=  '</tr>';
     }
     for ($ind = 0; $ind < 2; $ind++) {
          $qtd = $qtd + 1;
          $txt .=  '<tr>';
          $txt .=  '<td>&nbsp; </td><td>&nbsp; </td><td>&nbsp; </td><td>&nbsp; </td><td>&nbsp; </td><td>&nbsp; </td>';
          $txt .=  '</tr>';
     }    
     $txt .= '</tbody>';
     $txt .= '</table>';
     $txt .= '</div>';

     $txt .= '<div class="con-a">';
     $txt .= '<span>' . date('d/m/Y') . ' - PROPOSTA VÁLIDA POR 15 DIAS</span>';
     $txt .= '</div>';

     $txt .= '<div class="rod-a">';
     $txt .= '<span>' . $reg['emptelefone'] . " / " . $reg['empcelular'] . '</span><br/>';
     $txt .= '<span>' . $reg['empendereco'] . ", " . $reg['empnumeroend'] . " " . $reg['empcomplemento'] . " " . $reg['empcidade']. "-" . $reg['empestado']. '</span><br />';
     $txt .= '<span>' . $reg['empwebsite'] . " / " . $reg['empemail'] . '</span>';
     $txt .= '</div>';

     $txt .= '</div>';
     $txt .= '</body>';
     $txt .= "</html>";

     $pas = "emp_" . str_pad($_SESSION['wrkcodemp'], 3, "0", STR_PAD_LEFT); 
     if (file_exists($pas) == false) {  mkdir($pas); }
     $cam = strtolower($pas . "/" . "con_" . str_pad($_SESSION['wrkcodreg'], 6, "0", STR_PAD_LEFT) . "." . "html");
     file_put_contents($cam, $txt);

     return $txt;
}

function carrega_con($cod) {
     $txt = ""; $qtd = 0;
     include_once "dados.php";
     $com  = "Select C.*, X.*, Y.*, Z.emprazao, Z.empfantasia, Z.emptelefone, Z.empcelular, Z.empemail, Z.empendereco, Z.empnumeroend, Z.empnumeroend, Z.empcomplemento, Z.empwebsite, Z.empcidade, Z.empestado from ((((tb_contrato C left join tb_consultor X on C.conconsultor = X.idconsultor) ";
     $com .= " left join tb_empresa Z on C.conempresa = Z.idempresa) ";
     $com .= " left join tb_cliente Y on C.concliente = Y.idcliente) ";
     $com .= " left join tb_pagto W on C.conpagto = W.idpagto) ";
     $com .= " where idcontrato = " . $cod;
     $nro = acessa_reg($com, $reg);
     if ($nro == 0 || $reg == false) {
          echo '<script>alert("Número do documento informado não cadastrado");</script>'; return 9;
     }

     $txt .= '<!DOCTYPE html>';
     $txt .= '<html lang="pt_br">';
     $txt .= '<head>';
     $txt .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
     $txt .= '<meta name="description" content="Profsa Informática - Gerenciamento de Contratos - SearchMidia" />';
     $txt .= '<meta name="author" content="Paulo Rogério Souza" />';
     $txt .= '<style type="text/css">';
     $txt .= 'body { font-family: Lato}';
     $txt .= '.corpo { width: 1000px; height: auto; margin: 10px auto; border: 0.25px solid #bab8b8; }';
     $txt .= '.tit-a { width: 1000px; margin: 10px auto; padding: 10px; border: 0.25px solid #bab8b8; }';
     $txt .= '.tit-a h3 { float: right; }';

     $txt .= '.con-a { width: 100%;  text-align: center; color: #ffffff;  background-color: #405d9b; font-size: 28px;  font-weight: bold; }';
    
     $txt .= '.con-b { width: 1000px; }';
     $txt .= '.con-b td { padding: 5px; font-size: 22px; }';
     $txt .= '.con-b span { font-weight: bold; }';

     $txt .= '.inf-a { font-size: 22px; text-align: justify; padding: 0px 10px; }';

     $txt .= '.ser-a { margin: 0px 10px; font-size: 20px;  font-weight: bold; }';

     $txt .= '.lit-a { font-weight: bold; }';
     $txt .= '.ima-a { margin: 10px 0px; }';

     $txt .= '.rod-a { text-align: center; font-size: 18px; }';

     $txt .= '.tab-a { margin: 0px 10px; }';
     $txt .= '.tab-a table { width: 100%; margin: 0px auto; }';
     $txt .= '.tab-a th { border: 0.5px solid #000000; }';
     $txt .= '.tab-a td { border-right: 0.5px solid #000000; padding: 0px 5px; }';
 
     $txt .= '.col-a { text-align: right; }';
     $txt .= '.col-b { text-align: center; }';

     $txt .= '</style>';

     $txt .= '</head>';

     $txt .= '<body>';

     $txt .= '<div class="tit-a">';
     if ($_SESSION['wrklogemp'] == "") {
          $txt .= '<img class="ima-a" src="img/logo-12.png">';
     } else {
          $txt .= '<img class="ima-a" src="' . $_SESSION['wrklogemp'] . '">';
     }
     $txt .= '<h3><strong><br />' . 'Contrato de Prestação de Serviços - Nº ' . str_pad($reg['idcontrato'], 6, "0", STR_PAD_LEFT) . '</strong></h3>';
     $txt .= '</div>';

     $txt .= '<div class="corpo">';
     $txt .= '<div class="con-a">';
     $txt .= '<span>CONSULTOR</span>';
     $txt .= '</div>';

     $txt .= '<table class="con-b">';
     $txt .= '<tbody>';
     $txt .= '<tr>';
     $txt .= '<td width="50%"><span>Nome: </span>' . $reg['connome'] . '</td>';
     $txt .= '<td><span>Celular: </span>' . $reg['concelular'] . '</td>';
     $txt .= '</tr>';
     $txt .= '<tr>';
     $txt .= '<td>' . '</td>';
     $txt .= '<td><span>E-Mail: </span>' . $reg['conemail'] . '</td>';
     $txt .= '</tr>';    
     $txt .= '</tbody>';
     $txt .= '</table>';
    
     $txt .= '<div class="con-a">';
     $txt .= '<span>CLIENTE</span>';
     $txt .= '</div>';
     $txt .= '<table class="con-b">';
     $txt .= '<tbody>';
     $txt .= '<tr>';
     $txt .= '<td width="50%"><span>Empresa: </span>' . $reg['clifantasia'] . '</td>';
     if ($reg['clipessoa'] == 0) {
          $txt .= '<td><span>CPF: </span>' . mascara_cpo($reg['clicnpj'], "   .   .   /  ") . '</td>';
     } else {
          $txt .= '<td><span>CNPJ: </span>' . mascara_cpo($reg['clicnpj'], "  .   .   /    -  ") . '</td>';
     }
     $txt .= '</tr>';
     $txt .= '<tr>';
     $txt .= '<td><span>Telefone: </span>' . $reg['clitelefone'] . '</td>';
     $txt .= '<td><span>E-Mail: </span>' . $reg['cliemail'] . '</td>';
     $txt .= '</tr>';    
     $txt .= '</tbody>';
     $txt .= '</table>';

     $txt .= '<div class="con-a">';
     $txt .= '<span>INFORMAÇÕES</span>';
     $txt .= '</div>';
     $txt .= '<span class="inf-a">Este contrato tem o objetivo de informar os serviços que podemos realizar, visando a divulgação de sua empresa ou produtos. Foi elaborada após análise feita com base na concorrência e no seu mercado de atuação. Os serviços propostos podem ser alterados de acordo com a verba disponível.</span>';    
    
     $txt .= '<div class="con-a">';
     $txt .= '<span>SERVIÇOS E VALORES</span>';
     $txt .= '</div>';
     $txt .= '<div class="tab-a">';
     $txt .= '<table>';
     $txt .= '<thead>';
     $txt .= '<tr>';
     $txt .= '<th width="40%">&nbsp; Produtos / Serviços / Anúncios</th>';
     $txt .= '<th width="10%">&nbsp; Vigência</th>';
     $txt .= '<th class="col-b">Preço</th>';
     $txt .= '<th class="col-b">Parcelas</th>';
     $txt .= '<th class="col-b">Desconto</th>';
     $txt .= '<th class="col-b">Valor</th>';
     $txt .= '</tr>';
     $txt .= '</thead>';
     $com  = "Select I.*, S.serdescricao from (tb_contrato_s I left join tb_servico S on I.iteservico = S.idservico)  where I.iteempresa = " .  $_SESSION['wrkcodemp'] . " and I.itecontrato = " . $cod . " order by I.iditem";
     $nro = leitura_reg($com, $ser);
     $txt .= '<tbody>';
     foreach ($ser as $lin) {
          $qtd = $qtd + 1;
          $txt .=  '<tr>';
          $txt .= '<td>&nbsp; ' . $lin['serdescricao'] . '</td>';
          if ($lin['itevigencia'] == 0) { $txt .= '<td>' . "S/ Vigência" . '</td>'; }
          if ($lin['itevigencia'] == 1) { $txt .= '<td>' . "Mensal" . '</td>';  }
          if ($lin['itevigencia'] == 2) { $txt .= '<td>' . "Bimestral" . '</td>';  }
          if ($lin['itevigencia'] == 3) { $txt .= '<td>' . "Trimestral" . '</td>'; }
          if ($lin['itevigencia'] == 4) { $txt .= '<td>' . "Semestral" . '</td>';  }
          if ($lin['itevigencia'] == 5) { $txt .= '<td>' . "Anual" . '</td>';  }
          if ($lin['itevigencia'] == 6) { $txt .= '<td>' . "Bianual" . '</td>';  }
          if ($lin['itevigencia'] == 7) { $txt .= '<td>' . "Trianual" . '</td>';  }
          $txt .= '<td class="col-a">R$ ' . number_format($lin['itepreco'], 2, ",", ".") . '</td>';
          $txt .= '<td class="col-b">' . $lin['iteparcela'] . '</td>';
          $txt .= '<td class="col-b">' . number_format($lin['itedesconto'], 2, ",", ".") . '%</td>';
          $txt .= '<td class="col-a">R$ ' . number_format($lin['itepreco'] * (1 - $lin['itedesconto'] / 100) / $lin['iteparcela'], 2, ",", ".") . '</td>';
          $txt .=  '</tr>';
     }
     for ($ind = 0; $ind < 2; $ind++) {
          $qtd = $qtd + 1;
          $txt .=  '<tr>';
          $txt .=  '<td>&nbsp; </td><td>&nbsp; </td><td>&nbsp; </td><td>&nbsp; </td><td>&nbsp; </td><td>&nbsp; </td>';
          $txt .=  '</tr>';
     }    
     $txt .= '</tbody>';
     $txt .= '</table>';
     $txt .= '</div>';

     $txt .= '<div class="con-a">';
     $txt .= '<span>' . date('d/m/Y') . ' - CONTRATO VÁLIDO POR 15 DIAS</span>';
     $txt .= '</div>';

     $txt .= '<div class="rod-a">';
     $txt .= '<span>' . $reg['emptelefone'] . " / " . $reg['empcelular'] . '</span><br/>';
     $txt .= '<span>' . $reg['empendereco'] . ", " . $reg['empnumeroend'] . " " . $reg['empcomplemento'] . " " . $reg['empcidade']. "-" . $reg['empestado']. '</span><br />';
     $txt .= '<span>' . $reg['empwebsite'] . " / " . $reg['empemail'] . '</span>';
     $txt .= '</div>';

     $txt .= '</div>';
     $txt .= '</body>';
     $txt .= "</html>";

     $pas = "emp_" . str_pad($_SESSION['wrkcodemp'], 3, "0", STR_PAD_LEFT); 
     if (file_exists($pas) == false) {  mkdir($pas); }
     $cam = strtolower($pas . "/" . "con_" . str_pad($_SESSION['wrkcodreg'], 6, "0", STR_PAD_LEFT) . "." . "html");
     file_put_contents($cam, $txt);

     return $txt;
}

?>

</html>
