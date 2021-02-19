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
     <title>Serviço - Gerenciamento de Contratos - SearchMidia - Profsa Informátda Ltda</title>
</head>

<script>
$(function() {
     $("#pre").mask("000.000,00", {
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
               "infoEmpty": "Sem registros de Serviços ...",
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
     date_default_timezone_set("America/Sao_Paulo");
     $_SESSION['wrkdatide'] = date ("d/m/Y H:i:s", getlastmod());
     $_SESSION['wrknomide'] = get_current_user();
     if (isset($_SERVER['HTTP_REFERER']) == true) {
          if (limpa_pro($_SESSION['wrknompro']) != limpa_pro($_SERVER['HTTP_REFERER'])) {
               $_SESSION['wrkproant'] = limpa_pro($_SERVER['HTTP_REFERER']);
               $ret = gravar_log(6,"Entrada na página de manutenção de serviços do sistema Pallas.46 - SearchMidia");  
          }
     }
     if (isset($_SESSION['wrkopereg']) == false) { $_SESSION['wrkopereg'] = 0; }
     if (isset($_SESSION['wrkcodreg']) == false) { $_SESSION['wrkcodreg'] = 0; }
     if (isset($_REQUEST['ope']) == true) { $_SESSION['wrkopereg'] = $_REQUEST['ope']; }
     if (isset($_REQUEST['cod']) == true) { $_SESSION['wrkcodreg'] = $_REQUEST['cod']; }
     $cod = (isset($_REQUEST['cod']) == false ? 0 : $_REQUEST['cod']);
     $sta = (isset($_REQUEST['sta']) == false ? 0 : $_REQUEST['sta']);
     $gru = (isset($_REQUEST['gru']) == false ? '' : $_REQUEST['gru']);
     $pre = (isset($_REQUEST['pre']) == false ? '' : $_REQUEST['pre']);
     $vig = (isset($_REQUEST['vig']) == false ? 0 : $_REQUEST['vig']);
     $des = (isset($_REQUEST['des']) == false ? '' : str_replace("'", "´", $_REQUEST['des']));
     $obs = (isset($_REQUEST['obs']) == false ? '' : str_replace("'", "´", $_REQUEST['obs']));
     if ($_SESSION['wrkopereg'] == 1) { 
          $cod = ultimo_cod();
     }
     if ($_SESSION['wrkopereg'] >= 2) {
          if (isset($_REQUEST['salvar']) == false) { 
               $cha = $_SESSION['wrkcodreg']; 
               $ret = ler_pagto($cha, $des, $sta, $gru, $pre, $vig, $obs); 
          }
     }
     if ($_SESSION['wrkopereg'] == 3) { 
          $bot = 'Deletar'; 
          $del = "cor-2";
          $per = ' onclick="return confirm(\'Confirma exclusão de Serviço informado em tela ?\')" ';
     }

 if (isset($_REQUEST['salvar']) == true) {
      if ($_SESSION['wrkopereg'] == 1) {
           $sta = consiste_ser();
           if ($sta == 0) {
                $ret = incluir_ser();
                $cod = ultimo_cod();
                $ret = gravar_log(11,"Inclusão de novo Serviço de campo: " . $des); 
                $des = ''; $obs = ''; $gru = 0; $pre = ''; $vig = ''; $sta = 00; $_SESSION['wrkopereg'] = 1; $_SESSION['wrkcodreg'] = 0;
           }
      }
      if ($_SESSION['wrkopereg'] == 2) {
           $sta = consiste_ser();
           if ($sta == 0) {
                $ret = alterar_ser();
                $cod = ultimo_cod(); 
                $ret = gravar_log(12,"Alteração de Serviço cadastrado: " . $des); 
                $des = ''; $obs = ''; $gru = 0; $pre = ''; $vig = ''; $sta = 00; $_SESSION['wrkopereg'] = 1; $_SESSION['wrkcodreg'] = 0;
           }
      }
      if ($_SESSION['wrkopereg'] == 3) {
           $ret = excluir_ser(); $bot = 'Salvar'; $per = '';
           $cod = ultimo_cod(); 
           $ret = gravar_log(13,"Exclusão de Serviço cadastrado: " . $des); 
           $des = ''; $obs = ''; $gru = 0; $pre = ''; $vig = ''; $sta = 00; $_SESSION['wrkopereg'] = 1; $_SESSION['wrkcodreg'] = 0;
          }
}
?>

<body id="box00">
     <h1 class="cab-0">Manutenção de Serviço - SearchMidia - Profsa Informática</h1>
     <div class="row">
          <div class="col-md-12">
               <?php include_once "cabecalho-1.php"; ?>
          </div>
     </div>
     <div class="container">
          <div class="qua-0">
               <div class="row qua-2">
                    <div class="col-md-11 text-left">
                         <span>Manutenção de Serviço</span>
                    </div>
                    <div class="col-md-1 text-center">
                         <form name="frmTelNov" action="man-servico.php?ope=1&cod=0" method="POST">
                              <div class="text-center">
                                   <button type="submit" class="bot-2" id="nov" name="novo"
                                        title="Mostra campos para criar novo Serviço no sistema"><i
                                             class="fa fa-plus-circle fa-1g" aria-hidden="true"></i></button>
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
                              <label>Descrição do Serviço</label>
                              <input type="text" class="form-control" maxlength="75" id="des" name="des"
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
                         <div class="col-md-2"></div>
                         <div class="col-md-8">
                              <label>Grupo de Serviço</label>
                              <select id="gru" name="gru" class="form-control">
                                   <?php $ret = carrega_gru($gru); ?>
                              </select>
                         </div>
                         <div class="col-md-2"></div>
                    </div>
                    <div class="row">
                         <div class="col-md-3"></div>
                         <div class="col-md-3">
                              <label>Preço</label>
                              <input type="text" class="form-control text-center" maxlength="10" id="pre" name="pre"
                                   value="<?php echo $pre; ?>" />
                         </div>
                         <div class="col-md-3">
                              <label>Vigência</label><br />
                              <select name="vig" class="form-control">
                                   <option value="0" <?php echo ($vig != 0 ? '' : 'selected="selected"'); ?>>
                                        Esporárido
                                   </option>
                                   <option value="1" <?php echo ($vig != 1 ? '' : 'selected="selected"'); ?>>
                                        Mensal
                                   </option>
                                   <option value="2" <?php echo ($vig != 2 ? '' : 'selected="selected"'); ?>>
                                        Bimestral
                                   </option>
                                   <option value="3" <?php echo ($vig != 3 ? '' : 'selected="selected"'); ?>>
                                        Trimestral
                                   </option>
                                   <option value="4" <?php echo ($vig != 4 ? '' : 'selected="selected"'); ?>>
                                        Semestral
                                   </option>
                                   <option value="5" <?php echo ($vig != 5 ? '' : 'selected="selected"'); ?>>
                                        Anual
                                   </option>
                                   <option value="6" <?php echo ($vig != 6 ? '' : 'selected="selected"'); ?>>
                                        Bianual
                                   </option>
                                   <option value="7" <?php echo ($vig != 7 ? '' : 'selected="selected"'); ?>>
                                        Trianual
                                   </option>
                              </select>
                         </div>
                         <div class="col-md-3"></div>
                    </div>
                    <div class="row">
                         <div class="col-md-12">
                              <label>Observação para o Serviço</label>
                              <textarea class="form-control" rows="3" id="obs" name="obs"><?php echo $obs; ?></textarea>
                         </div>
                    </div>
                    <br />
                    <div class="row text-center">
                         <div class="col-md-3"></div>
                         <div class="col-md-6 text-center">
                              <button type="submit" name="salvar" <?php echo $per; ?>
                                   class="bot-1 <?php echo $del; ?> "><?php echo $bot; ?></button>
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
                                        <th>Grupo de Serviço</th>
                                        <th>Descrição do Serviço</th>
                                        <th>Preço</th>
                                        <th>Vigêncdia</th>
                                        <th>Observação para o Serviço</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php $ret = carrega_ser();  ?>
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
     exit('<script>location.href = "man-servico.php?ope=1&cod=0"</script>');
}

function ultimo_cod() {
     $cod = 1;
     include_once "dados.php";
     $nro = acessa_reg('Select idservico from tb_servico order by idservico desc Limit 1', $reg);
     if ($nro == 1) {
          $cod = $reg['idservico'] + 1;
     }        
     return $cod;
}
function carrega_gru($gru) {
     $sta = 0;
     include_once "dados.php";    
     if ($gru == 0) {
          echo '<option value="0" selected="selected">Selecione grupo desejado ...</option>';
     }
     $com = "Select idgrupo, grudescricao from tb_grupo where grustatus = 0 and grutiporeg = 2 and gruempresa = " . $_SESSION['wrkcodemp'] . " order by grudescricao, idgrupo";
     $nro = leitura_reg($com, $reg);
     foreach ($reg as $lin) {
          if ($lin['idgrupo'] != $gru) {
               echo  '<option value ="' . $lin['idgrupo'] . '">' . $lin['grudescricao'] . '</option>'; 
          } else {
               echo  '<option value ="' . $lin['idgrupo'] . '" selected="selected">' . $lin['grudescricao'] . '</option>';
          }
     }
     return $sta;
}

function consiste_ser() {
     $sta = 0;
     if (trim($_REQUEST['des']) == "") {
          echo '<script>alert("Descrição do Serviço não pode estar em branco");</script>';
          return 1;
     }
     if (trim($_REQUEST['pre']) == "" || trim($_REQUEST['pre']) == "0") {
          echo '<script>alert("Preço do Serviço informado não pode estar em branco");</script>';
          return 1;
     }
     if (strlen($_REQUEST['obs']) > 500) {
          echo '<script>alert("Observação para serviço não pode ter mais de 500 caracteres");</script>';
          $sta = 1;
     }       
     return $sta;
 }

function carrega_ser() {
     include_once "dados.php";
     $com = "Select S.*, G.grudescricao from (tb_servico S left join tb_grupo G on S.sergrupo = G.idgrupo) where serempresa = " . $_SESSION['wrkcodemp'] . " order by serdescricao, idservico";
     $nro = leitura_reg($com, $reg);
     foreach ($reg as $lin) {
          $txt =  '<tr>';
          $txt .= '<td class="text-center"><a href="man-servico.php?ope=2&cod=' . $lin['idservico'] . '" title="Efetua alteração do registro informado na linha"><i class="large material-icons">healing</i></a></td>';
          $txt .= '<td class="lit-d text-center"><a href="man-servico.php?ope=3&cod=' . $lin['idservico'] . '" title="Efetua exclusão do registro informado na linha"><i class="cor-1 large material-icons">delete_forever</i></a></td>';
          $txt .= '<td class="text-center">' . $lin['idservico'] . '</td>';
          if ($lin['serstatus'] == 0) {$txt .= "<td>" . "Normal" . "</td>";}
          if ($lin['serstatus'] == 1) {$txt .= "<td>" . "Bloqueado" . "</td>";}
          if ($lin['serstatus'] == 2) {$txt .= "<td>" . "Suspenso" . "</td>";}
          if ($lin['serstatus'] == 3) {$txt .= "<td>" . "Cancelado" . "</td>";}
          $txt .= '<td class="text-left">' . $lin['grudescricao'] . "</td>";
          $txt .= '<td class="text-left">' . $lin['serdescricao'] . "</td>";
          $txt .= '<td class="text-center">' . number_format($lin['serpreco'], 2, ",", ".") . "</td>";
          if ($lin['servigencia'] == 0) {$txt .= "<td>" . "Esporárido" . "</td>";}
          if ($lin['servigencia'] == 1) {$txt .= "<td>" . "Mensal" . "</td>";}
          if ($lin['servigencia'] == 2) {$txt .= "<td>" . "Bimestral" . "</td>";}
          if ($lin['servigencia'] == 3) {$txt .= "<td>" . "Trimestral" . "</td>";}
          if ($lin['servigencia'] == 4) {$txt .= "<td>" . "Semestral" . "</td>";}
          if ($lin['servigencia'] == 5) {$txt .= "<td>" . "Anual" . "</td>";}
          if ($lin['servigencia'] == 6) {$txt .= "<td>" . "Bianual" . "</td>";}
          if ($lin['servigencia'] == 7) {$txt .= "<td>" . "Trianual" . "</td>";}
          $txt .= '<td class="text-left">' . $lin['serobservacao'] . "</td>";
          $txt .= "</tr>";
          echo $txt;
     }
}

function incluir_ser() {
     $ret = 0;
     $pre = str_replace(".", "", $_REQUEST['pre']); $pre = str_replace(",", ".", $pre);
     include_once "dados.php";
     $sql  = "insert into tb_servico (";
     $sql .= "serstatus, ";
     $sql .= "serempresa, ";
     $sql .= "serdescricao, ";
     $sql .= "serpreco, ";
     $sql .= "sergrupo, ";
     $sql .= "servigencia, ";
     $sql .= "serobservacao, ";
     $sql .= "keyinc, ";
     $sql .= "datinc ";
     $sql .= ") value ( ";
     $sql .= "'" . $_REQUEST['sta'] . "',";
     $sql .= "'" . $_SESSION['wrkcodemp'] . "',";
     $sql .= "'" . str_replace("'", "´", $_REQUEST['des']) . "',";
     $sql .= "'" . $pre . "',";
     $sql .= "'" . $_REQUEST['gru'] . "',";
     $sql .= "'" . $_REQUEST['vig'] . "',";
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

function ler_pagto(&$cha, &$des, &$sta, &$gru, &$pre, &$vig, &$obs) {
     include_once "dados.php";
     $nro = acessa_reg("Select * from tb_servico where idservico = " . $cha, $reg);            
     if ($nro == 0) {
          echo '<script>alert("Código do Serviço informado não cadastrado no sistema");</script>';
     } else {
          $cha = $reg['idservico'];
          $des = $reg['serdescricao'];
          $obs = $reg['serobservacao'];
          $sta = $reg['serstatus'];
          $vig = $reg['servigencia'];
          $gru = $reg['sergrupo'];
          $pre = number_format($reg['serpreco'], 2, ",", ".");
     }
     return $cha;
 }

 function alterar_ser() {
     $ret = 0;
     $pre = str_replace(".", "", $_REQUEST['pre']); $pre = str_replace(",", ".", $pre);
     include_once "dados.php";
     $sql  = "update tb_servico set ";
     $sql .= "serstatus = '". $_REQUEST['sta'] . "', ";
     $sql .= "serdescricao = '". $_REQUEST['des'] . "', ";
     $sql .= "serpreco = '". $pre . "', ";
     $sql .= "servigencia = '". $_REQUEST['vig'] . "', ";
     $sql .= "sergrupo = '". $_REQUEST['gru'] . "', ";
     $sql .= "serobservacao = '". $_REQUEST['obs'] . "', ";
     $sql .= "keyalt = '" . $_SESSION['wrkideusu'] . "', ";
     $sql .= "datalt = '" . date("Y/m/d H:i:s") . "' ";
     $sql .= "where idservico = " . $_SESSION['wrkcodreg'];
     $ret = comando_tab($sql, $nro, $ult, $men);
     if ($ret == false) {
          print_r($sql);
          echo '<script>alert("Erro na regravação do registro solicitado !");</script>';
     }
     return $ret;
 } 

 function excluir_ser() {
     $ret = 0;
     include_once "dados.php";
     $sql  = "delete from tb_servico where idservico = " . $_SESSION['wrkcodreg'] ;
     $ret = comando_tab($sql, $nro, $ult, $men);
     if ($ret == false) {
          print_r($sql);
          echo '<script>alert("Erro na exclusão do registro solicitado !");</script>';
     }
     return $ret;
 }


?>

</html>
