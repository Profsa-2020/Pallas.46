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

     <script type="text/javascript" src="js/datepicker-pt-BR.js"></script>

     <script type="text/javascript" src="js/jquery.mask.min.js"></script>

     <link href="css/pallas46.css" rel="stylesheet" type="text/css" media="screen" />
     <title>Forma de Pagto - Gerenciamento de Contratos - SearchMidia - Profsa Informátda Ltda</title>
</head>

<script>
$(function() {
     $("#par").mask("00");
     $("#ven").mask("00");
     $("#tax").mask("00,00", {
          reverse: true
     });
});

$(document).ready(function() {
     var alt = $(window).height();
     var lar = $(window).width();
     if (lar < 800) {
          $('nav').removeClass("fixed-top");
     }

     $('#tab-0').DataTable({
          "pageLength": 25,
          "aaSorting": [
               [4, 'asc'],
               [2, 'asc']
          ],
          "language": {
               "lengthMenu": "Demonstrar _MENU_ linhas por páginas",
               "zeroRecords": "Não existe registros a demonstar ...",
               "info": "Mostrada página _PAGE_ de _PAGES_",
               "infoEmpty": "Sem registros de Formas de Pagamento ...",
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
     $per = "";
     $del = "";
     $bot = "Salvar";
     include_once "dados.php";
     include_once "profsa.php";
     $_SESSION['wrknompro'] = __FILE__;
     if ($_SESSION['wrktipusu'] <= 1) {
          echo '<script>alert("Nível de usuário não permite acesso a esta opção do sistema");</script>';
          echo '<script>history.go(-1);</script>';
     }
     date_default_timezone_set("America/Sao_Paulo");
     $_SESSION['wrkdatide'] = date ("d/m/Y H:i:s", getlastmod());
     $_SESSION['wrknomide'] = get_current_user();
     if (isset($_SERVER['HTTP_REFERER']) == true) {
          if (limpa_pro($_SESSION['wrknompro']) != limpa_pro($_SERVER['HTTP_REFERER'])) {
               $_SESSION['wrkproant'] = limpa_pro($_SERVER['HTTP_REFERER']);
               $ret = gravar_log(6,"Entrada na página de manutenção de forma de pagto do sistema Pallas.46 - SearchMidia");  
          }
     }
     if (isset($_SESSION['wrkopereg']) == false) { $_SESSION['wrkopereg'] = 0; }
     if (isset($_SESSION['wrkcodreg']) == false) { $_SESSION['wrkcodreg'] = 0; }
     if (isset($_REQUEST['ope']) == true) { $_SESSION['wrkopereg'] = $_REQUEST['ope']; }
     if (isset($_REQUEST['cod']) == true) { $_SESSION['wrkcodreg'] = $_REQUEST['cod']; }
     $cod = (isset($_REQUEST['cod']) == false ? 0 : $_REQUEST['cod']);
     $sta = (isset($_REQUEST['sta']) == false ? 0 : $_REQUEST['sta']);
     $par = (isset($_REQUEST['par']) == false ? '' : $_REQUEST['par']);
     $ven = (isset($_REQUEST['ven']) == false ? '' : $_REQUEST['ven']);
     $tax = (isset($_REQUEST['tax']) == false ? '' : $_REQUEST['tax']);

     $des = (isset($_REQUEST['des']) == false ? '' : str_replace("'", "´", $_REQUEST['des']));
     $obs = (isset($_REQUEST['obs']) == false ? '' : str_replace("'", "´", $_REQUEST['obs']));
     if ($_SESSION['wrkopereg'] == 1) { 
          $cod = ultimo_cod();
     }
     if ($_SESSION['wrkopereg'] >= 2) {
          if (isset($_REQUEST['salvar']) == false) { 
               $cha = $_SESSION['wrkcodreg']; 
               $ret = ler_pagto($cha, $des, $sta, $par, $ven, $tax, $obs); 
          }
     }
     if ($_SESSION['wrkopereg'] == 3) { 
          $bot = 'Deletar'; 
          $del = "cor-2";
          $per = ' onclick="return confirm(\'Confirma exclusão de Forma de Pagto informado em tela ?\')" ';
     }

 if (isset($_REQUEST['salvar']) == true) {
      if ($_SESSION['wrkopereg'] == 1) {
           $sta = consiste_pag();
           if ($sta == 0) {
                $ret = incluir_pag();
                $cod = ultimo_cod();
                $ret = gravar_log(11,"Inclusão de novo Forma de Pagto de campo: " . $des); 
                $des = ''; $obs = ''; $par = ''; $ven = ''; $tax = ''; $sta = 00; $_SESSION['wrkopereg'] = 1; $_SESSION['wrkcodreg'] = 0;
           }
      }
      if ($_SESSION['wrkopereg'] == 2) {
           $sta = consiste_pag();
           if ($sta == 0) {
                $ret = alterar_pag();
                $cod = ultimo_cod(); 
                $ret = gravar_log(12,"Alteração de Forma de Pagto cadastrado: " . $des); 
                $des = ''; $obs = ''; $par = ''; $ven = ''; $tax = ''; $sta = 00;  $_SESSION['wrkopereg'] = 1; $_SESSION['wrkcodreg'] = 0;
           }
      }
      if ($_SESSION['wrkopereg'] == 3) {
           $ret = excluir_pag(); $bot = 'Salvar'; $per = '';
           $cod = ultimo_cod(); 
           $ret = gravar_log(13,"Exclusão de Forma de Pagto cadastrado: " . $des); 
           $des = ''; $obs = ''; $par = ''; $ven = ''; $tax = ''; $sta = 00;  $_SESSION['wrkopereg'] = 1; $_SESSION['wrkcodreg'] = 0;
      }
}
?>

<body id="box00">
     <h1 class="cab-0">Manutenção de Forma de Pagto - SearchMidia - Profsa Informática</h1>
     <div class="row">
          <div class="col-md-12">
               <?php include_once "cabecalho-1.php"; ?>
          </div>
     </div>
     <div class="container">
          <div class="qua-0">
               <div class="row qua-2">
                    <div class="col-md-10 text-left">
                         <span>Manutenção de Forma de Pagto</span>
                    </div>
                    <div class="col-md-2 text-center">
                         <form name="frmTelNov" action="man-pagto.php?ope=1&cod=0" method="POST">
                              <div class="text-center">
                                   <button type="submit" class="bot-4" id="nov" name="novo"
                                        title="Mostra campos para criar novo Forma de Pagto no sistema">Adicionar</button>
                              </div>
                         </form>
                    </div>
               </div>
               <form class="tel-1" name="frmTelMan" action="" method="POST">
                    <div class="row">
                         <div class="col-md-2">
                              <label>Número</label>
                              <input type="text" class="form-control text-center" maxlength="6" id="cod" name="cod"
                                   value="<?php echo $cod; ?>" disabled />
                         </div>
                         <div class="col-md-8">
                              <label>Condição de Pagamento</label>
                              <input type="text" class="form-control" maxlength="50" id="des" name="des"
                                   value="<?php echo $des; ?>" required />
                         </div>
                         <div class="col-md-2">
                              <label>Situação</label><br />
                              <select name="sta" class="form-control">
                                   <option value="0" <?php echo ($sta != 0 ? '' : 'selected="selected"'); ?>>
                                        Normal
                                   </option>
                                   <option value="1" <?php echo ($sta != 1 ? '' : 'selected="selected"'); ?>>
                                        Bloqueado
                                   </option>
                                   <option value="2" <?php echo ($sta != 2 ? '' : 'selected="selected"'); ?>>
                                        Suspenso
                                   </option>
                                   <option value="3" <?php echo ($sta != 3 ? '' : 'selected="selected"'); ?>>
                                        Cancelado
                                   </option>
                              </select>
                         </div>
                    </div>
                    <div class="row">
                         <div class="col-md-3"></div>
                         <div class="col-md-2">
                              <label>Nº de Parcelas</label>
                              <input type="text" class="form-control text-center" maxlength="2" id="par" name="par"
                                   value="<?php echo $par; ?>" />
                         </div>
                         <div class="col-md-2">
                              <label>Dia de Vecto</label>
                              <input type="text" class="form-control text-center" maxlength="2" id="ven" name="ven"
                                   value="<?php echo $ven; ?>" />
                         </div>
                         <div class="col-md-2">
                              <label>Taxa</label>
                              <input type="text" class="form-control text-center" maxlength="5" id="tax" name="tax"
                                   value="<?php echo $tax; ?>" />
                         </div>
                         <div class="col-md-3"></div>
                    </div>
                    <div class="row">
                         <div class="col-md-12">
                              <label>Observação para o Pagamento</label>
                              <textarea class="form-control" rows="3" id="obs" name="obs"><?php echo $obs; ?></textarea>
                         </div>
                    </div>
                    <br />
                    <div class="row text-center">
                         <div class="col-md-3"></div>
                         <div class="col-md-6 text-center">
                              <button type="submit" name="salvar" <?php echo $per; ?>
                                   class="bot-4 <?php echo $del; ?> "><?php echo $bot; ?></button>
                         </div>
                         <div class="col-md-3"></div>
                    </div>
               </form>
               <br /><hr /><br />
               <div class="col-md-12 text-center">
                    <div class="tab-1 table-responsive">
                         <table id="tab-0" class="table table-sm table-striped">
                              <thead>
                                   <tr>
                                        <th width="5%">Alterar</th>
                                        <th width="5%">Excluir</th>
                                        <th width="5%">Número</th>
                                        <th>Status</th>
                                        <th>Condição de Pagamento</th>
                                        <th>Parcelas</th>
                                        <th>Vecto</th>
                                        <th>Taxa</th>
                                        <th>Observação para o Pagto</th>
                                        <th>Inclusão</th>
                                        <th>Alteração</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php $ret = carrega_pag();  ?>
                              </tbody>
                         </table>
                    </div>
                    <br />
               </div>
          </div>
          <div id="box10">
               <img class="subir" src="img/subir.png" title="Volta a página para o seu topo." />
          </div>
     </div>
</body>

<?php
if ($_SESSION['wrkopereg'] == 1 && $_SESSION['wrkcodreg'] == $cod) {
     exit('<script>location.href = "man-pagto.php?ope=1&cod=0"</script>');
}

function ultimo_cod() {
     $cod = 1;
     include_once "dados.php";
     $nro = acessa_reg('Select idpagto from tb_pagto order by idpagto desc Limit 1', $reg);
     if ($nro == 1) {
          $cod = $reg['idpagto'] + 1;
     }        
     return $cod;
}

function consiste_pag() {
     $sta = 0;
     if (trim($_REQUEST['des']) == "") {
          echo '<script>alert("Descrição do Forma de Pagto não pode estar em branco");</script>';
          return 1;
     }
     if (strlen($_REQUEST['ven']) > 31) {
          echo '<script>alert("Dia para o vencimento não pode ser superior a 31 dias");</script>';
          $sta = 1;
     }       
     if (strlen($_REQUEST['par']) > 24) {
          echo '<script>alert("Número de parcelas não pode ser superior a 24 parcelas");</script>';
          $sta = 1;
     }       
     if (strlen($_REQUEST['obs']) > 500) {
          echo '<script>alert("Observação para pagto não pode ter mais de 500 caracteres");</script>';
          $sta = 1;
     }       
     return $sta;
 }

function carrega_pag() {
     include_once "dados.php";
     $com = "Select * from tb_pagto where pagempresa = " . $_SESSION['wrkcodemp'] . " order by pagdescricao, idpagto";
     $nro = leitura_reg($com, $reg);
     foreach ($reg as $lin) {
          $txt =  '<tr>';
          $txt .= '<td class="text-center"><a href="man-pagto.php?ope=2&cod=' . $lin['idpagto'] . '" title="Efetua alteração do registro informado na linha"><i class="large material-icons">create</i></a></td>';
          $txt .= '<td class="lit-d text-center"><a href="man-pagto.php?ope=3&cod=' . $lin['idpagto'] . '" title="Efetua exclusão do registro informado na linha"><i class="cor-1 large material-icons">delete_forever</i></a></td>';
          $txt .= '<td class="text-center">' . $lin['idpagto'] . '</td>';
          if ($lin['pagstatus'] == 0) {$txt .= "<td>" . "Normal" . "</td>";}
          if ($lin['pagstatus'] == 1) {$txt .= "<td>" . "Bloqueado" . "</td>";}
          if ($lin['pagstatus'] == 2) {$txt .= "<td>" . "Suspenso" . "</td>";}
          if ($lin['pagstatus'] == 3) {$txt .= "<td>" . "Cancelado" . "</td>";}
          $txt .= '<td class="text-left">' . $lin['pagdescricao'] . "</td>";
          $txt .= '<td class="text-center">' . $lin['pagparcelas'] . "</td>";
          $txt .= '<td class="text-center">' . $lin['pagdiavecto'] . "</td>";
          $txt .= '<td class="text-center">' . number_format($lin['pagtaxa'], 2, ",", ".") . "</td>";
          $txt .= '<td class="text-left">' . $lin['pagobservacao'] . "</td>";
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

function incluir_pag() {
     $ret = 0;
     include_once "dados.php";
     $sql  = "insert into tb_pagto (";
     $sql .= "pagstatus, ";
     $sql .= "pagempresa, ";
     $sql .= "pagdescricao, ";
     $sql .= "pagparcelas, ";
     $sql .= "pagdiavecto, ";
     $sql .= "pagtaxa, ";
     $sql .= "pagobservacao, ";
     $sql .= "keyinc, ";
     $sql .= "datinc ";
     $sql .= ") value ( ";
     $sql .= "'" . $_REQUEST['sta'] . "',";
     $sql .= "'" . $_SESSION['wrkcodemp'] . "',";
     $sql .= "'" . str_replace("'", "´", $_REQUEST['des']) . "',";
     $sql .= "'" . ($_REQUEST['par'] == "" ? 0 : $_REQUEST['par']) . "',";
     $sql .= "'" . ($_REQUEST['ven'] == "" ? 0 : $_REQUEST['ven']) . "',";
     $sql .= "'" . ($_REQUEST['tax'] == "" ? 0 : str_replace(",",".", $_REQUEST['tax'])) . "',";
     $sql .= "'" . str_replace("'", "´", $_REQUEST['obs']) . "',";
     $sql .= "'" . $_SESSION['wrkideusu'] . "',";
     $sql .= "'" . date("Y/m/d H:i:s") . "')";
     $ret = comando_tab($sql, $nro, $ult, $men);
     if ($ret == false) {
          print_r($sql);
          echo '<script>alert("Erro na gravação do registro solicitado !");</script>';
     }
     return $ret;
}

function ler_pagto(&$cha, &$des, &$sta, &$par, &$ven, &$tax, &$obs) {
     include_once "dados.php";
     $nro = acessa_reg("Select * from tb_pagto where idpagto = " . $cha, $reg);            
     if ($nro == 0) {
          echo '<script>alert("Código do Forma de Pagto informado não cadastrado no sistema");</script>';
     } else {
          $cha = $reg['idpagto'];
          $des = $reg['pagdescricao'];
          $obs = $reg['pagobservacao'];
          $sta = $reg['pagstatus'];
          $par = $reg['pagparcelas'];
          $ven = $reg['pagdiavecto'];
          $tax = $reg['pagtaxa'];
     }
     return $cha;
 }

 function alterar_pag() {
     $ret = 0;
     include_once "dados.php";
     $sql  = "update tb_pagto set ";
     $sql .= "pagstatus = '". $_REQUEST['sta'] . "', ";
     $sql .= "pagdescricao = '". $_REQUEST['des'] . "', ";
     $sql .= "pagparcelas = '". ($_REQUEST['par'] == "" ? 0 : $_REQUEST['par']) . "', ";
     $sql .= "pagdiavecto = '". ($_REQUEST['ven'] == "" ? 0 :$_REQUEST['ven']) . "', ";
     $sql .= "pagtaxa = '". ($_REQUEST['tax'] == "" ? 0 :str_replace(",",".",$_REQUEST['tax'])) . "', ";
     $sql .= "pagobservacao = '". $_REQUEST['obs'] . "', ";
     $sql .= "keyalt = '" . $_SESSION['wrkideusu'] . "', ";
     $sql .= "datalt = '" . date("Y/m/d H:i:s") . "' ";
     $sql .= "where idpagto = " . $_SESSION['wrkcodreg'];
     $ret = comando_tab($sql, $nro, $ult, $men);
     if ($ret == false) {
          print_r($sql);
          echo '<script>alert("Erro na regravação do registro solicitado !");</script>';
     }
     return $ret;
 } 

 function excluir_pag() {
     $ret = 0;
     include_once "dados.php";
     $sql  = "delete from tb_pagto where idpagto = " . $_SESSION['wrkcodreg'] ;
     $ret = comando_tab($sql, $nro, $ult, $men);
     if ($ret == false) {
          print_r($sql);
          echo '<script>alert("Erro na exclusão do registro solicitado !");</script>';
     }
     return $ret;
 }


?>

</html>
