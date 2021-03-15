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

     <script type="text/javascript" src="js/datepicker-pt-BR.js"></script>

     <script type="text/javascript" src="js/jquery.mask.min.js"></script>

     <link href="css/pallas46.css" rel="stylesheet" type="text/css" media="screen" />
     <link href="css/pallas46p.css" rel="stylesheet" type="text/css" media="print" />

     <title>Proposta SearchMidia</title>
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
     if (isset($_REQUEST['ope']) == true) { $ope = $_REQUEST['ope']; }
     if (isset($_REQUEST['cod']) == true) { $cod = $_REQUEST['cod']; }

     if (isset($_SESSION['wrknomusu']) == false) {
          exit('<script>location.href = "index.php"</script>');   
     } elseif ($_SESSION['wrknomusu'] == "") {
          exit('<script>location.href = "index.php"</script>');   
     } elseif ($_SESSION['wrknomusu'] == "*") {
          exit('<script>location.href = "index.php"</script>');   
     } elseif ($_SESSION['wrknomusu'] == "#") {
          exit('<script>location.href = "index.php"</script>');   
     }   

     $txt = carrega_con($cod);

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
function carrega_con($cod) {
     $txt = ""; $qtd = 0;
     include_once "dados.php";
     $com  = "Select C.*, X.*, Y.*, Z.emprazao, Z.empfantasia, Z.emptelefone, Z.empcelular, Z.empemail, W.pagdescricao  from ((((tb_contrato C left join tb_consultor X on C.conconsultor = X.idconsultor) ";
     $com .= " left join tb_empresa Z on C.conempresa = Z.idempresa) ";
     $com .= " left join tb_cliente Y on C.concliente = Y.idcliente) ";
     $com .= " left join tb_pagto W on C.conpagto = W.idpagto) ";
     $com .= " where idcontrato = " . $cod;
     $nro = acessa_reg($com, $reg);
     if ($nro == 0 || $reg == false) {
          echo '<script>alert("Número do contrato informado não cadastrado");</script>'; return 9;
     }

     $txt .= '<!DOCTYPE html>';
     $txt .= '<html lang="pt_br">';
     $txt .= '<head>';
     $txt .= '<style type="text/css">';
     $txt .= 'body { font-family: Lato}';
     $txt .= '.corpo { width: 1000px; height: auto; margin: 10px auto; border: 0.25px solid #bab8b8; }';
     $txt .= '.tit-a { width: 100%;  text-align: center; display: grid; grid-template-columns: auto auto; justify-items: center; }';

     $txt .= '.con-a {margin: 0px 10px; display: grid; grid-template-columns: auto auto; }';
     $txt .= '.con-a span:nth-child(1) { font-size: 20px;  font-weight: bold; }';
     $txt .= '.con-a span:nth-child(2) { font-size: 18px;  font-weight: bold; }';

     $txt .= '.ser-a { margin: 0px 10px; font-size: 20px;  font-weight: bold; }';
     $txt .= '.ser-b {margin: 0px 10px; width: 100%;  display: grid; grid-template-columns: 500px auto auto auto auto; }';
     $txt .= '.ser-b span:nth-child(1) { font-weight: bold; }';
     $txt .= '.ser-b span:nth-child(2) { font-weight: bold; }';
     $txt .= '.ser-b span:nth-child(3) { font-weight: bold; }';
     $txt .= '.ser-b span:nth-child(4) { font-weight: bold; }';
     $txt .= '.ser-b span:nth-child(5) { font-weight: bold; }';
     $txt .= '.ser-b .col-3 { text-align: right; }';
     $txt .= '.ser-b .col-4 { text-align: center; }';

     $txt .= '.lit-a { font-weight: bold; }';
     $txt .= '.ima-a { margin: 10px 0px; }';

     $txt .= '.rod-a { text-align: right; font-size: 14px; }';

     $txt .= '</style>';

     $txt .= '</head>';

     $txt .= '<body>';
     $txt .= '<div class="corpo">';

     $txt .= '<div class="tit-a">';
     if ($_SESSION['wrklogemp'] == "") {
          $txt .= '<img class="ima-a" src="img/logo-06.png">';
     } else {
          $txt .= '<img class="ima-a" src="' . $_SESSION['wrklogemp'] . '">';
     }
     $txt .= '<h3><strong><br />' . 'Proposta de Prestação de Serviços - Nº ' . str_pad($reg['idcontrato'], 6, "0", STR_PAD_LEFT) . '</strong></h3>';
     $txt .= '</div>';
     $txt .= '<hr />';

     $txt .= '<div class="con-a">';
     $txt .= '<span>Dados para Contato</span><br />';
     $txt .= '<span>Consultor: ' . $reg['connome'] . '</span>';
     $txt .= '<span> Celular: ' . $reg['concelular'] . '</span>';
     $txt .= '<span> Telefone: ' . $reg['contelefone'] . '</span>';
     $txt .= '<span> E-Mail: ' . $reg['conemail'] . '</span>';
     $txt .= '</div>';
     $txt .= '<hr />';

     $txt .= '<div class="con-a">';
     $txt .= '<span>Dados do Cliente</span><br />';
     $txt .= '<span>Razão Social: ' . $reg['clirazao'] . '</span>';
     if ($reg['clipessoa'] == 0) {
          $txt .= '<span> CPF: ' . mascara_cpo($reg['clicnpj'], "   .   .   -  ") . ' - RG.: ' . $reg['cliinscricao'] . '</span>';
     } else {
          $txt .= '<span> CNPJ: ' . mascara_cpo($reg['clicnpj'], "  .   .   /    -  ") . ' - IE: ' . $reg['cliinscricao'] . '</span>';
     }
     $txt .= '<span> Endereço: ' . $reg['cliendereco'] . ',  ' . $reg['clinumeroend']  . ' ' . $reg['clicomplemento'] . '</span>';
     $txt .= '<span> Cep: ' . $reg['clicep'] . ' - Bairro: ' . $reg['clibairro']  . ' - Cidade/UF: ' . $reg['clicidade'] . ' / '. $reg['cliestado'] . '</span>';
     $txt .= '<span> Celular: ' . $reg['clicelular'] . '</span>';
     $txt .= '<span> Telefone: ' . $reg['clitelefone'] . '</span>';
     $txt .= '<span> Site: ' . $reg['clisite'] . '</span>';
     $txt .= '<span> E-Mail: ' . $reg['cliemail'] . '</span>';
     $txt .= '</div>';
     $txt .= '<hr />';

     $txt .= '<div class="con-a">';
     $txt .= '<span>Dados de Pagamento</span><br />';
     $txt .= '<span> Data da Entrada: ' . ($reg['condataent'] == null ? "" : date('d/m/Y',strtotime($reg['condataent']))) . '</span>';
     $txt .= '<span> Valor da Entrada: R$ ' . number_format($reg['convalentrada'], 2, ",", ".") . '</span>';
     $txt .= '<span> Forrma de Pagamento: ' . $reg['pagdescricao'] . '</span>';
     $txt .= '<span> Desconto: R$ ' . number_format($reg['convaldesconto'], 2, ",", ".") . '</span>';
     $txt .= '<span>' . ' ' . '</span>';
     $txt .= '<span class="lit-a"> VALOR TOTAL: R$ ' . number_format($reg['convaltotal'], 2, ",", ".") . '</span>';
     $txt .= '</div>';
     $txt .= '<hr />';

     $txt .= '<div class="ser-a">';
     $txt .= '<span>Dados e Valores (em R$) dos serviços</span>';
     $txt .= '</div>';
     $txt .= '<div class="ser-b">';
     $txt .= '<span>Produtos / Serviços / Anúncios' . '</span>';
     $txt .= '<span>Vigência' . '</span>';
     $txt .= '<span>Preço' . '</span>';
     $txt .= '<span>Parcelas' . '</span>';
     $txt .= '<span>Valor' . '</span>';
     $com  = "Select I.*, S.serdescricao from (tb_contrato_s I left join tb_servico S on I.iteservico = S.idservico)  where I.iteempresa = " .  $_SESSION['wrkcodemp'] . " and I.itecontrato = " . $cod . " order by I.iditem";
     $nro = leitura_reg($com, $ser);
     foreach ($ser as $lin) {
          $qtd = $qtd + 1;
          $txt .= '<span>' . $lin['serdescricao'] . '</span>';
          if ($lin['itevigencia'] == 0) { $txt .= '<span>' . "Esporádico" . '</span>'; }
          if ($lin['itevigencia'] == 1) { $txt .= '<span>' . "Mensal" . '</span>';  }
          if ($lin['itevigencia'] == 2) { $txt .= '<span>' . "Bimestral" . '</span>';  }
          if ($lin['itevigencia'] == 3) { $txt .= '<span>' . "Trimestral" . '</span>'; }
          if ($lin['itevigencia'] == 4) { $txt .= '<span>' . "Semestral" . '</span>';  }
          if ($lin['itevigencia'] == 5) { $txt .= '<span>' . "Anual" . '</span>';  }
          if ($lin['itevigencia'] == 6) { $txt .= '<span>' . "Bianual" . '</span>';  }
          if ($lin['itevigencia'] == 7) { $txt .= '<span>' . "Trianual" . '</span>';  }
          $txt .= '<span class="col-3">' . number_format($lin['itepreco'], 2, ",", ".") . '</span>';
          $txt .= '<span class="col-4">' . $lin['iteparcela'] . '</span>';
          $txt .= '<span class="col-3">' . number_format($lin['itepreco'] / $lin['iteparcela'], 2, ",", ".") . '</span>';
     }
     $txt .= '</div>';
     $txt .= '<hr />';



     $txt .= '<div class="rod-a">';
     $txt .= '<span>' . $reg['empfantasia'] . ' </span>';
     $txt .= '<span> - ' . $reg['empcelular'] . ' </span>';
     $txt .= '<span> - ' . $reg['empemail'] . ' </span>';
     $txt .= '</div>';

     $txt .= '</div>';
     $txt .= '</body>';
     $txt .= "</html>";
     return $txt;
}

?>

</html>
