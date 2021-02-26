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
     <title>Contrato - Gerenciamento de Contratos - SearchMidia - Profsa Informátda Ltda</title>
</head>

<script>
$(function() {
     $("#dti").mask("00/00/0000");
     $("#dtf").mask("00/00/0000");
     $("#cep").mask("00000-000");
     $("#ent").mask("000.000,00", {
          reverse: true
     });
     $("#des").mask("99,99", {
          reverse: true
     });
     $("#dti").datepicker($.datepicker.regional["pt-BR"]);
     $("#dtf").datepicker($.datepicker.regional["pt-BR"]);
});

$(document).ready(function() {

     let alt = $(window).height();
     let lar = $(window).width();
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
               $ret = gravar_log(6,"Entrada na página de manutenção de contratos do sistema Pallas.46 - SearchMidia");  
          }
     }
     if (isset($_SESSION['wrkopereg']) == false) { $_SESSION['wrkopereg'] = 0; }
     if (isset($_SESSION['wrkcodreg']) == false) { $_SESSION['wrkcodreg'] = 0; }
     if (isset($_SESSION['wrknumvol']) == false) { $_SESSION['wrknumvol'] = 1; }
     if (isset($_REQUEST['ope']) == true) { $_SESSION['wrkopereg'] = $_REQUEST['ope']; }
     if (isset($_REQUEST['cod']) == true) { $_SESSION['wrkcodreg'] = $_REQUEST['cod']; }
     $cod = (isset($_REQUEST['cod']) == false ? 0  : $_REQUEST['cod']);
     $sta = (isset($_REQUEST['sta']) == false ? 0  : $_REQUEST['sta']);
     $cli = (isset($_REQUEST['cli']) == false ? 0  : $_REQUEST['cli']);
     $con = (isset($_REQUEST['con']) == false ? 0  : $_REQUEST['con']);
     $pag = (isset($_REQUEST['pag']) == false ? 0  : $_REQUEST['pag']);
     $pro = (isset($_REQUEST['pro']) == false ? 0  : $_REQUEST['pro']);
     $sta = (isset($_REQUEST['sta']) == false ? 0  : $_REQUEST['sta']);
     $dti = (isset($_REQUEST['dti']) == false ? date('d/m/Y')  : $_REQUEST['dti']);
     $dtf = (isset($_REQUEST['dtf']) == false ? '' : $_REQUEST['dtf']);
     $ent = (isset($_REQUEST['ent']) == false ? ''  : $_REQUEST['ent']);
     $des = (isset($_REQUEST['des']) == false ? ''  : $_REQUEST['des']);
     $obs = (isset($_REQUEST['obs']) == false ? ''  : $_REQUEST['obs']);

?>

<body id="box00">
     <h1 class="cab-0">Manutenção de Contratos - SearchMidia - Profsa Informática</h1>
     <div class="row">
          <div class="col-12">
               <?php include_once "cabecalho-1.php"; ?>
          </div>
     </div>
     <div class="container">
          <div class="qua-0">
               <div class="row qua-2">
                    <div class="col-md-10 text-left">
                         <span>Manutenção de Contratos</span>
                    </div>
                    <div class="col-md-2">
                         <form name="frmTelNov" action="man-contrato.php?ope=1&cod=0" method="POST">
                              <div class="text-center">
                                   <button type="submit" class="bot-4" id="nov" name="novo"
                                        title="Mostra campos para criar novo contrato no sistema">Adicionar</button>
                              </div>
                         </form>
                    </div>
               </div>
               <form class="tel-1" name="frmTelMan" action="" method="POST">
                    <div class="row">
                         <div class="col-md-2"></div>
                         <div class="col-md-8">
                              <label>Nome do Consultor</label>
                              <select id="con" name="con" class="form-control">
                                   <?php $ret = carrega_con($con); ?>
                              </select>
                         </div>
                         <div class="col-md-2">
                              <label>Status</label><br />
                              <select id="sta" name="sta" class="form-control">
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
                    </div>
                    <div class="row">
                         <div class="col-md-2"></div>
                         <div class="col-md-8">
                              <label>Nome do Cliente</label>
                              <select id="cli" name="cli" class="form-control">
                                   <?php $ret = carrega_cli($cli); ?>
                              </select>
                         </div>
                         <div class="lit-1 col-md-2 text-center">
                              <span>Proposta ?</span> &nbsp; <br />
                              <input type="checkbox" id="pro" name="pro" value="1"
                                   <?php echo ($pro == 0 ? '': 'checked' ) ?> />
                         </div>
                    </div>
                    <div class="row">
                         <div class="col-md-2"></div>
                         <div class="col-md-8">
                              <label>Forma de Pagamento</label>
                              <select id="pag" name="pag" class="form-control">
                                   <?php $ret = carrega_pag($pag); ?>
                              </select>
                         </div>
                         <div class="col-md-2"></div>
                    </div>
                    <div class="row">
                         <div class="col-md-2"></div>
                         <div class="col-md-2">
                              <label>Data Inicial</label>
                              <input type="text" class="form-control text-center" maxlength="10" id="dti" name="dti"
                                   value="<?php echo $dti; ?>" required />
                         </div>
                         <div class="col-md-2">
                              <label>Data Final</label>
                              <input type="text" class="form-control text-center" maxlength="10" id="dtf" name="dtf"
                                   value="<?php echo $dtf; ?>" required />
                         </div>
                         <div class="col-md-2">
                              <label>Entrada - R$</label>
                              <input type="text" class="form-control text-center" maxlength="10" id="ent" name="ent"
                                   value="<?php echo $ent; ?>" />
                         </div>
                         <div class="col-md-2">
                              <label>Desconto - %</label>
                              <input type="text" class="form-control text-center" maxlength="5" id="des" name="des"
                                   value="<?php echo $des; ?>" />
                         </div>
                         <div class="col-md-2"></div>
                    </div>
                    <div class="row">
                         <div class="col-md-2"></div>
                         <div class="col-md-8">
                              <label>Observação para o Contrato</label>
                              <textarea class="form-control" rows="5" id="obs" name="obs"><?php echo $obs; ?></textarea>
                         </div>
                         <div class="col-md-2"></div>
                    </div>
                    <br />
                    <div class="row">
                         <div class="col-6 text-right">
                              <button type="submit" name="salvar" <?php echo $per; ?>
                                   class="bot-4 <?php echo $del; ?>"><?php echo $bot; ?></button>
                         </div>
                         <div class="col-6 text-center">
                              <?php
                                   echo '<div class="bot-1 text-center" ><a href="' . $_SESSION['wrkproant'] . '.php" title="Volta a página anterior deste processamento.">Voltar</a></div>'
                              ?>
                         </div>
                    </div>
                    <br />
               </form>
          </div>
     </div>
</body>
<?php
function ultimo_cod() {
     $cod = 1;
     include_once "dados.php";
     $nro = acessa_reg('Select idcontrato from tb_contrato order by idcontrato desc Limit 1', $reg);
     if ($nro == 1) {
          $cod = $reg['idcliente'] + 1;
     }        
     return $cod;
}

function carrega_cli($cli) {
     $sta = 0;
     include_once "dados.php";    
     if ($cli == 0) {
          echo '<option value="0" selected="selected">Selecione cliente desejado ...</option>';
     }
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

function carrega_con($con) {
     $sta = 0;
     include_once "dados.php";    
     if ($con == 0) {
          echo '<option value="0" selected="selected">Selecione consultor desejado ...</option>';
     }
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

function carrega_pag($pag) {
     $sta = 0;
     include_once "dados.php";    
     if ($pag == 0) {
          echo '<option value="0" selected="selected">Selecione forma de pagamento ...</option>';
     }
     $com = "Select idpagto, pagdescricao from tb_pagto where pagstatus = 0 and pagempresa = " . $_SESSION['wrkcodemp'] . " order by pagdescricao, idpagto";
     $nro = leitura_reg($com, $reg);
     foreach ($reg as $lin) {
          if ($lin['idpagto'] != $pag) {
               echo  '<option value ="' . $lin['idpagto'] . '">' . $lin['pagdescricao'] . '</option>'; 
          } else {
               echo  '<option value ="' . $lin['idpagto'] . '" selected="selected">' . $lin['pagdescricao'] . '</option>';
          }
     }
     return $sta;
}



?>

</html>