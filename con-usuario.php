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
     <title>Usuário - Gerenciamento de Contratos - SearchMidia - Profsa Informátda Ltda</title>
</head>

<script>
$(document).ready(function() {
     $('#dti').change(function() {
          $('#tab-0 tbody').empty();
     });

     $('#dtf').change(function() {
          $('#tab-0 tbody').empty();
     });

     $('#tab-0').DataTable({
          "pageLength": 25,
          "aaSorting": [
               [0, 'desc'],
               [1, 'desc']
          ],
          "language": {
               "lengthMenu": "Demonstrar _MENU_ linhas por páginas",
               "zeroRecords": "Não existe registros a demonstar ...",
               "info": "Mostrada página _PAGE_ de _PAGES_",
               "infoEmpty": "Sem registros de Usuários ...",
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
    include_once "dados.php";
    include_once "profsa.php";
    $_SESSION['wrknompro'] = __FILE__;
    if ($_SESSION['wrktipusu'] <= 1) {
     echo '<script>alert("Nível de usuário não permite acesso a está opção do sistema");</script>';
     echo '<script>history.go(-1);</script>';
}
date_default_timezone_set("America/Sao_Paulo");
    if (isset($_SERVER['HTTP_REFERER']) == true) {
          if (limpa_pro($_SESSION['wrknompro']) != limpa_pro($_SERVER['HTTP_REFERER'])) {
               $_SESSION['wrknomant'] = limpa_pro($_SERVER['HTTP_REFERER']);
               $ret = gravar_log(10,"Entrada na página de Consulta de Usuários");  
          }
     }
?>

<body id="box00">
     <h1 class="cab-0">Consulta de Usuários - SearchMidia - Profsa Informática</h1>
     <?php include_once "cabecalho-1.php"; ?>
     <div class="container">
          <div class="row qua-2">
               <div class="col-md-10">
                    <label>Lista de Usuários</label>
               </div>
               <div class="col-md-2">
                    <form name="frmTelNov" action="man-usuario.php?ope=1&cod=0" method="POST">
                         <div class="text-center">
                              <button type="submit" class="bot-4" id="nov" name="novo"
                                   title="Mostra campos para criar novo usuário no sistema">Adicionar</button>
                         </div>
                    </form>
               </div>
          </div>
     </div>
     <div class="container-fluid">
          <div class="row">
               <div class="col-md-12">
                    <div class="row">
                         <div class="tab-1 table-responsive">
                              <table id="tab-0" class="table table-sm table-striped">
                                   <thead>
                                        <tr>
                                             <th width="5%">Alterar</th>
                                             <th width="5%">Excluir</th>
                                             <th width="5%">Código</th>
                                             <th>Usuário</th>
                                             <th>Status</th>
                                             <th>E-Mail</th>
                                             <th>Tipo</th>
                                             <th>Celular</th>
                                             <th>Validade</th>
                                             <th>Acessos</th>
                                             <th>Inclusão</th>
                                             <th>Alteração</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <?php $ret = carrega_usu();  ?>
                                   </tbody>
                              </table>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div id="box10">
          <img class="subir" src="img/subir.png" title="Volta a página para o seu topo." />
     </div>
</body>

<?php 
function carrega_usu() {
     include_once "dados.php";
     $com = "Select U.*, E.emprazao, E.empfantasia from (tb_usuario U left join tb_empresa E on U.usuempresa = E.idempresa) where U.usuempresa = " .  $_SESSION['wrkcodemp'] . " order by U.usunome, U.idsenha";
     $nro = leitura_reg($com, $reg);
     foreach ($reg as $lin) {
          $txt =  '<tr>';
          $txt .= '<td class="text-center"><a href="man-usuario.php?ope=2&cod=' . $lin['idsenha'] . '" title="Efetua alteração do registro informado na linha"><i class="large material-icons">create</i></a></td>';
          $txt .= '<td class="lit-d text-center"><a href="man-usuario.php?ope=3&cod=' . $lin['idsenha'] . '" title="Efetua exclusão do registro informado na linha"><i class="cor-1 large material-icons">delete_forever</i></a></td>';
          $txt .= '<td class="text-center">' . $lin['idsenha'] . '</td>';
          $txt .= "<td>" . $lin['usunome'] . "</td>";
          if ($lin['usustatus'] == 0) {$txt .= "<td>" . "Normal" . "</td>";}
          if ($lin['usustatus'] == 1) {$txt .= "<td>" . "Bloqueado" . "</td>";}
          if ($lin['usustatus'] == 2) {$txt .= "<td>" . "Suspenso" . "</td>";}
          if ($lin['usustatus'] == 3) {$txt .= "<td>" . "Cancelado" . "</td>";}
          $txt .= "<td>" . $lin['usuemail'] . "</td>";
          if ($lin['usutipo'] == 0) {$txt .= "<td>" . "Visitante" . "</td>";}
          if ($lin['usutipo'] == 1) {$txt .= "<td>" . "Consultor" . "</td>";}
          if ($lin['usutipo'] == 2) {$txt .= "<td>" . "Gerência" . "</td>";}
          if ($lin['usutipo'] == 3) {$txt .= "<td>" . "Suporte" . "</td>";}
          if ($lin['usutipo'] == 4) {$txt .= "<td>" . "Administrador" . "</td>";}
          $txt .= "<td>" . $lin['usucelular'] . "</td>";
          if ($lin['usuvalidade'] == null) {
               $txt .= "<td>" . '' . "</td>";
          }else{
               $txt .= "<td>" . date('d/m/Y',strtotime($lin['usuvalidade'])) . "</td>";
          }
          $txt .= '<td class="text-center">' . $lin['usuacessos'] . '</td>';
          if ($lin['datinc'] == null) {
               $txt .= "<td>" . '' . "</td>";
          }else{
               $txt .= "<td>" . date('d/m/Y H:m:s',strtotime($lin['datinc'])) . "</td>";
          }
          if ($lin['datalt'] == null) {
               $txt .= "<td>" . '' . "</td>";
          }else{
               $txt .= "<td>" . date('d/m/Y H:m:s',strtotime($lin['datalt'])) . "</td>";
          }
          $txt .= "</tr>";
          echo $txt;
     }
}

?>

</html>