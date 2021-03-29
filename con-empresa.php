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

     <script type="text/javascript" src="js/jquery.mask.min.js"></script>

     <link href="css/pallas46.css" rel="stylesheet" type="text/css" media="screen" />
     <title>Empresa - Gerenciamento de Contratos - SearchMidia - Profsa Informátda Ltda</title>
</head>

<script>
$(document).ready(function() {

     let alt = $(window).height();
     let lar = $(window).width();
     if (lar < 800) {
          $('nav').removeClass("fixed-top");
     }

     $('#tab-0').DataTable({
          "pageLength": 25,
          "aaSorting": [
               [3, 'asc'],
               [2, 'asc']
          ],
          "language": {
               "lengthMenu": "Demonstrar _MENU_ linhas por páginas",
               "zeroRecords": "Não existe registros a demonstrar ...",
               "info": "Mostrada página _PAGE_ de _PAGES_",
               "infoEmpty": "Sem registros de empresas ...",
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

     $(".exc").click(function() {
          let tip = "e";
          let cod = $(this).attr("cod");
          let res = confirm('Confirma exclusão da empresa informada em opção ?');
          if (res == true) {
               $.get("ajax/deleta-reg.php", {
                    tip: tip,
                    cod: cod
               })
               .done(function(data) {
                    if (data != "") {
                         alert(data);
                         document.location.reload(true); }   // Recarrega página inteira em JavaScript
               });
          }
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
     $per = "";
     $bot = "Salvar";
     include_once "dados.php";
     include_once "profsa.php";
     $_SESSION['wrknompro'] = __FILE__;
     date_default_timezone_set("America/Sao_Paulo");
     if ($_SESSION['wrktipusu'] <= 1) {
          echo '<script>alert("Nível de usuário não permite acesso a está opção do sistema");</script>';
          echo '<script>history.go(-1);</script>';
     }
     $_SESSION['wrkdatide'] = date ("d/m/Y H:i:s", getlastmod());
     $_SESSION['wrknomide'] = get_current_user();
     if (isset($_SERVER['HTTP_REFERER']) == true) {
          if (limpa_pro($_SESSION['wrknompro']) != limpa_pro($_SERVER['HTTP_REFERER'])) {
               $_SESSION['wrkproant'] = limpa_pro($_SERVER['HTTP_REFERER']);
               $ret = gravar_log(4, "Entrada na página de consulta de empresas - Pallas.46");  
          }
     }
     if (isset($_SESSION['wrkopereg']) == false) { $_SESSION['wrkopereg'] = 0; }
     if (isset($_SESSION['wrkcodreg']) == false) { $_SESSION['wrkcodreg'] = 0; }
     if (isset($_REQUEST['ope']) == true) { $_SESSION['wrkopereg'] = $_REQUEST['ope']; }
     if (isset($_REQUEST['cod']) == true) { $_SESSION['wrkcodreg'] = $_REQUEST['cod']; }
     $_SESSION['wrkmosavi']= 0; $_SESSION['wrkmenavi'] = "";     
?>

<body id="box00">
<h1 class="cab-0">Consulta de Empresas - SearchMidia - Profsa Informática</h1>
     <div class="row">
          <div class="col-md-12">
               <?php include_once "cabecalho-1.php"; ?>
          </div>
     </div>
     <div class="container">
          <div class="row qua-2">
               <div class="col-md-10 text-left">
                    <span>Lista de Empresas</span>
               </div>
               <?php if ($_SESSION['wrktipusu'] >= 3) { ?>
                    <div class="col-md-2 text-center">
                         <form name="frmTelNov" action="man-empresa.php?ope=1&cod=0" method="POST">
                              <div class="text-center">
                                   <button type="submit" class="bot-4" id="nov" name="novo"
                                        title="Mostra campos para criar nova empresa no sistema">Adicionar</button>
                              </div>
                         </form>
                    </div>
               <?php } ?>
          </div>
     </div>
     <div class="container">
          <div class="row">
               <div class="col-md-12">
                    <br />
                    <div class="tab-1 table-responsive">
                         <table id="tab-0" class="table table-sm table-striped">
                              <thead>
                                   <tr>
                                        <th width="5%">Alterar</th>
                                        <th width="5%">Excluir</th>
                                        <th>Status</th>
                                        <th>Razão Social do Destinatário</th>
                                        <th>CNPJ</th>
                                        <th>Cidade - UF</th>
                                        <th>Telefone</th>
                                        <th>E-Mail</th>
                                        <th>Celular</th>
                                        <th>Nome do Contato</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php $ret = carrega_emp();  ?>
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
function carrega_emp() {
     include_once "dados.php";
     if ($_SESSION['wrktipusu'] >= 3) {
          $com = "Select * from tb_empresa order by emprazao, idempresa";
     } else {
          $com = "Select * from tb_empresa where idempresa = " .  $_SESSION['wrkcodemp'] . " order by emprazao, idempresa";
     }
     $nro = leitura_reg($com, $reg);
     foreach ($reg as $lin) {
          $txt =  '<tr>';
          $txt .= '<td class="text-center"><a href="man-empresa.php?ope=2&cod=' . $lin['idempresa'] . '" title="Efetua alteração do registro informado na linha"><i class="large material-icons">create</i></a></td>';
          if ($_SESSION['wrktipusu'] <= 2) { 
               $txt .= "<td>" . "" . "</td>";
          } else {
               $txt .= '<td>' . '<button type="button" class="exc bot-2 cor-1" name="exc" cod="' . $lin['idempresa'] . '" title="Efetua exclusão do registro informado na linha"><i class="cor-1 large material-icons">delete_forever</i></button>' . '</td>';
          }
          if ($lin['empstatus'] == 0) {$txt .= "<td>" . "Ativo" . "</td>";}
          if ($lin['empstatus'] == 1) {$txt .= "<td>" . "Inativo" . "</td>";}
          if ($lin['empstatus'] == 2) {$txt .= "<td>" . "Suspenso" . "</td>";}
          if ($lin['empstatus'] == 3) {$txt .= "<td>" . "Cancelado" . "</td>";}
          $txt .= "<td>" . $lin['emprazao'] . "</td>";
          $txt .= "<td>" . mascara_cpo($lin['empcnpj'], "  .   .   /    -  ") . "</td>";
          $txt .= "<td>" . $lin['empcidade'] . '-' . $lin['empestado'] . "</td>";
          $txt .= "<td>" . $lin['emptelefone'] . "</td>";
          $txt .= "<td>" . $lin['empemail'] . "</td>";
          $txt .= "<td>" . $lin['empcelular'] . "</td>";
          $txt .= "<td>" . $lin['empcontato'] . "</td>";
          $txt .= "</tr>";
          echo $txt; 
     }
}

?>

</html>