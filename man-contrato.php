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
     <title>Contrato - Gerenciamento de Contratos - SearchMidia - Profsa Informátda Ltda</title>
</head>

<script>
$(function() {
     $("#par_s").mask("00");
     $("#cod_s").mask("000.000");
     $("#dti").mask("00/00/0000");
     $("#dtf").mask("00/00/0000");
     $("#dte").mask("00/00/0000");
     $("#cep").mask("00000-000");
     $("#ent").mask("000.000,00", {
          reverse: true
     });
     $("#per_s").mask("00,00", {
          reverse: true
     });
     $("#dte").datepicker($.datepicker.regional["pt-BR"]);
     $("#dti").datepicker($.datepicker.regional["pt-BR"]);
     $("#dtf").datepicker($.datepicker.regional["pt-BR"]);
});

$(document).ready(function() {

     let alt = $(window).height();
     let lar = $(window).width();
     if (lar < 800) {
          $('nav').removeClass("fixed-top");
     }

     $("#frmTelMan").submit(function() {
          var dat = "";
          var val = $('#tot_g').val();
          var ent = $('#ent').val();
          var dte = $('#dte').val();
          var cli = $('#cli').val();
          var con = $('#con').val();
          var pag = $('#pag').val();
          var dti = $('#dti').val();
          var dtf = $('#dtf').val();
          var obs = $('#obs').val();
          if (cli == "" || cli == "0") {
               alert("Deve ser informado o cliente para este contrato, obrigatoriamente !");
               return false;
          } else if (con == "" || con == "0") {
               alert("Deve ser informado consultor para este contrato, obrigatoriamente !");
               return false;
          } else if (pag == "" || pag == "0") {
               alert("Deve ser informado forma de pagamento para o contrato solicitado !");
               return false;
          } else if (dti == "") {
               alert("Deve ser informado a data de início do contrato, obrigatoriamente !");
               return false;
          } else if (dtf == "") {
               alert("Deve ser informado a data de fim do contrato, obrigatoriamente !");
               return false;
          } else if (obs.lenght > 500) {
               alert("Número de caracteres da observação do contrato maior que 500 !");
               return false;
          } else if (parseFloat(val, 10) == 0) {
               alert("Valor total do contrato solicitado não pode ser igual a ZERO !");
               return false;
          } else if (ent.trim() != "") {
               var ent = ent.replace('.', '').replace(',', '.');
               if (parseFloat(ent, 10) > parseFloat(val, 10)) {
                    alert("Valor da entrada não pode ser maior que o valor do contrato !");
                    return false;
               }
          }
          var dti = $('#dti').val().split("/");
          var dtf = $('#dtf').val().split("/");
          dti = dti[2] + dti[1] + dti[0];
          dtf = dtf[2] + dtf[1] + dtf[0];
          if (dti > dtf) {
               alert("Data de inicio do contrato não pode ser maior que a final !");
               return false;
          }

     });

     $("#dti").change(function() {
          if ($('#dti').val() != "") {
               var dti = $('#dti').val().split("/");
               if (parseInt(dti[0], 10) < 1 || parseInt(dti[0], 10) > 31) {
                    $('#dti').val("");
                    alert("Dia informado para a data deve ser entre 01 e 31  !");
               } else if (parseInt(dti[1], 10) < 1 || parseInt(dti[1], 10) > 12) {
                    $('#dti').val("");
                    alert("Mês informado para a data deve ser entre 01 e 12  !");
               } else if (parseInt(dti[2], 10) < 2020 || parseInt(dti[2], 10) > 2026) {
                    $('#dti').val("");
                    alert("Ano informado para a data deve ser entre 2001 e 2026 !");
               }
          }
     });

     $("#dtf").change(function() {
          if ($('#dtf').val() != "") {
               var dtf = $('#dtf').val().split("/");
               if (parseInt(dtf[0], 10) < 1 || parseInt(dtf[0], 10) > 31) {
                    $('#dtf').val("");
                    alert("Dia informado para a data deve ser entre 01 e 31  !");
               } else if (parseInt(dtf[1], 10) < 1 || parseInt(dtf[1], 10) > 12) {
                    $('#dtf').val("");
                    alert("Mês informado para a data deve ser entre 01 e 12  !");
               } else if (parseInt(dtf[2], 10) < 2020 || parseInt(dtf[2], 10) > 2026) {
                    $('#dtf').val("");
                    alert("Ano informado para a data deve ser entre 2001 e 2026 !");
               }
          }
     });

     $("#dtf").blur(function() {
          if ($('#dtf').val() == "") {
               $('#dtf').val($('#dti').val());
          }
     });

     $("#per_s").blur(function() {
          var per = $('#per_s').val();
          $.get("ajax/valida-des.php", {
                    des: per
               })
               .done(function(data) {
                    if (data != "") {
                         alert(data);
                         $('#per_s').val(0);
                    }
               });
     });

     $("#cod_s").change(function() {
          var cli = $('#cli').val();
          var pag = $('#pag').val();
          var cod = $('#cod_s').val();
          var ser = $('#des_s').val();
          var ord = $('#num_s').val();
          var per = $('#per_s').val();
          if (cod != "") {
               $.getJSON("ajax/leitura-ser.php", {
                         ord: ord,
                         cli: cli,
                         pag: pag,
                         cod: cod,
                         ser: ser
                    })
                    .done(function(data) {
                         if (data.men != "") {
                              alert(data.men);
                              $('#cod_s').val('');
                              $('#des_s').val(0);
                         } else {
                              $('#cod_s').val(data.cod);
                              $('#des_s').val(data.cod);
                              $('#vig_s').val(data.vig);
                              $('#pre_s').val(data.uni);
                              $('#ser_t').val(data.tta);
                              $('#val_s').val(data.uni);
                              $('#val_t').val(data.tta);
                         }
                    }).fail(function(data) {
                         console.log('Erro: ' + JSON.stringify(data));
                         alert(
                              "Erro ocorrido no processamento do item de serviço do contrato"
                         );
                    });
          }
     });

     $("#des_s").change(function() {
          var cod = 0;
          var cli = $('#cli').val();
          var pag = $('#pag').val();
          var ser = $('#des_s').val();
          var ord = $('#num_s').val();
          var per = $('#per_s').val();
          if (ser != 0) {
               $.getJSON("ajax/leitura-ser.php", {
                         ord: ord,
                         cli: cli,
                         pag: pag,
                         cod: cod,
                         ser: ser
                    })
                    .done(function(data) {
                         if (data.men != "") {
                              alert(data.men);
                              $('#cod_s').val('');
                              $('#des_s').val(0);
                         } else {
                              $('#cod_s').val(data.cod);
                              $('#des_s').val(data.cod);
                              $('#vig_s').val(data.vig);
                              $('#pre_s').val(data.uni);
                              $('#val_s').val(data.uni);
                              $('#val_t').val(data.tta);
                              $('#ser_t').val(data.tta);
                         }
                    }).fail(function(data) {
                         console.log('Erro: ' + JSON.stringify(data));
                         alert(
                              "Erro ocorrido no processamento do serviço informado no contrato"
                         );
                    });
          }
     });

     $("#par_s").blur(function() {
          var pag = $('#pag').val();
          var par = $('#par_s').val();
          var ser = $('#ser_t').val();
          $.get("ajax/valida-par.php", {
                    par: par,
                    ser: ser
               })
               .done(function(data) {
                    if (data != "") {
                         par = 1;
                         alert(data);
                         $('#par_s').val(1);
                         $('#val_s').val($('#pre_s').val());
                    }
               });
          if (isNaN(par) == false) {
               var val = 0;
               if (par == 0) {
                    val = parseFloat(ser, 10);
               } else {
                    val = ser / parseInt(par, 10);
               }
               val = val.toLocaleString("pt-BR", {
                    style: "currency",
                    currency: "BRL"
               });
               $('#val_s').val(val);
          }
     });

     $("form").on("click", ".lit-d", function() {
          var cha = $(this).attr("cha_s");
          $.getJSON("ajax/deleta-ite.php", {
                    cha: cha
               })
               .done(function(data) {
                    if (data.men != "") {
                         alert(data.men);
                    } else {
                         $('#tot_g').val(data.ger);
                         $('#tot_c').text(data.tot);
                         $('#lis_s').html(data.lis);
                    }
               }).fail(function(data) {
                    console.log('Erro: ' + JSON.stringify(data));
                    alert(
                         "Erro ocorrido no processamento do exclusão do serviço informado"
                    );
               });
     });

     $("#gra_s").click(function() {
          var dti = $('#dti').val();
          var dtf = $('#dtf').val();
          var dad = $('#frmMosSer').serialize();
          $.post("ajax/adicionar-ser.php", dad + '&dti=' + dti + '&dtf=' + dtf, function(data) {
               if (data.men != "") {
                    alert(data.men);
               } else {
                    $('#num_s').val(data.num);
                    $('#cod_s').val('');
                    $('#des_s').val(0);
                    $('#vig_s').val(0);
                    $('#pre_s').val('');
                    $('#obs_s').val('');
                    $('#val_s').val('');
                    $('#par_s').val(1);
                    $('#val_t').val(0);
                    $('#ser_t').val(0);
                    $('#per_s').val(0);
                    $('#dtf').val(data.dtf);
                    $('#tot_g').val(data.ger);
                    $('#tot_c').text(data.tot);
                    $('#lis_s').html(data.lis);
               }
          }, "json");
     });

     $("#itens").click(function() {
          var cli = $('#cli').val();
          var con = $('#con').val();
          var pag = $('#pag').val();
          var dti = $('#dti').val();
          if (cli == "" || cli == "0") {
               alert("Não foi informado ainda cliente para este contrato !");
          } else if (con == "" || con == "0") {
               alert("Não foi informado ainda consultor para este contrato !");
          } else if (pag == "" || pag == "0") {
               alert("Não foi informado ainda forma de pagamento para o contrato !");
          } else if (dti == "") {
               alert("Não foi informado ainda data de início do contrato !");
          } else {
               $('#ser-con').modal('show');
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
     $ite_c = "";
     $con_l = "";
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
     if (isset($_SESSION['wrkvalcon']) == false) { $_SESSION['wrkvalcon'] = 0; }
     if (isset($_SESSION['wrklisser']) == false) { $_SESSION['wrklisser'] = array(); }
     if (isset($_REQUEST['ope']) == true) { $_SESSION['wrkopereg'] = $_REQUEST['ope']; }
     if (isset($_REQUEST['cod']) == true) { $_SESSION['wrkcodreg'] = $_REQUEST['cod']; }
     if ($_SESSION['wrktipusu'] <= 1) { // 0-Visitante, 1-Consultor
          $con_l = " disabled ";
     }
     $cod = (isset($_REQUEST['cod']) == false ? 0 : $_REQUEST['cod']);
     $sta = (isset($_REQUEST['sta']) == false ? 1 : $_REQUEST['sta']);
     $cli = (isset($_REQUEST['cli']) == false ? 0 : $_REQUEST['cli']);
     $pag = (isset($_REQUEST['pag']) == false ? 0  : $_REQUEST['pag']);
     $pro = (isset($_REQUEST['pro']) == false ? 1 : $_REQUEST['pro']);
     $dti = (isset($_REQUEST['dti']) == false ? date('d/m/Y')  : $_REQUEST['dti']);
     $dtf = (isset($_REQUEST['dtf']) == false ? '' : $_REQUEST['dtf']);
     $ent = (isset($_REQUEST['ent']) == false ? ''  : $_REQUEST['ent']);
     $dte = (isset($_REQUEST['dte']) == false ? ''  : $_REQUEST['dte']);
     $obs = (isset($_REQUEST['obs']) == false ? ''  : $_REQUEST['obs']);
     $con = (isset($_REQUEST['con']) == false ? $_SESSION['wrkcodcon'] : $_REQUEST['con']);
     if ($_SESSION['wrkopereg'] == 1) { 
          if (isset($_REQUEST['salvar']) == false) {
               $_SESSION['wrkcodreg'] = ultimo_cod(); $_SESSION['wrknumvol'] = 1;
               $_SESSION['wrkmostel'] = 1; $_SESSION['wrkvalcon'] = 0; $_SESSION['wrklisser'] = array();
          }
     }
     if ($_SESSION['wrkopereg'] == 3) { 
          $bot = 'Deletar'; 
          $del = "cor-2";
          $per = ' onclick="return confirm(\'Confirma exclusão de contrato informado em tela ?\')" ';
     }  
     if ($_SESSION['wrkopereg'] >= 2) {
          if (isset($_REQUEST['salvar']) == false) { 
               $cha = $_SESSION['wrkcodreg']; $_SESSION['wrknumcha'] = $_SESSION['wrkcodreg']; $_SESSION['wrkmostel'] = 1; $_SESSION['wrknumvol'] = 1;
               $ret = ler_contrato($_SESSION['wrkcodreg'], $sta, $cli, $pag, $pro, $dti, $dtf, $dte, $ent, $obs, $con); 
               $ite_c = carrega_ite($dti, $dtf);
          }
     }
     if (isset($_REQUEST['salvar']) == true) {
          $_SESSION['wrknumvol'] = $_SESSION['wrknumvol'] + 1;
          if ($_SESSION['wrkopereg'] == 1) {
               $ret = consiste_cto();
               if ($ret == 0) {
                    $ret = incluir_cto();
                    $ret = gravar_ser();
                    $ret = atualiza_des($val_t, $val_d, $per_d);
                    $nom = retorna_dad('clirazao', 'tb_cliente', 'idcliente', $cli);
                    $ret = gravar_log(11,"Inclusão de novo contrato para venda: " . $nom); $_SESSION['wrkvalcon'] = 0; $_SESSION['wrklisser'] = array();
                    $sta = 0; $cli = 0; $pag = 0; $pro = 0; $dti = date('d/m/Y'); $dtf = ''; $dte = ''; $ent = ''; $obs = ''; $con = $_SESSION['wrkcodcon']; $_SESSION['wrknumvol'] = 1;
               }
          }
          if ($_SESSION['wrkopereg'] == 2) {
               $ret = consiste_cto();
               if ($ret == 0) {
                    $ret = alterar_cto();
                    $ret = gravar_ser();
                    $ret = atualiza_des($val_t, $val_d, $per_d);
                    $nom = retorna_dad('clirazao', 'tb_cliente', 'idcliente', $cli);
                    $ret = gravar_log(12,"Alteração de contrato existente: " . $nom); $_SESSION['wrkmostel'] = 0;
                    $sta = 0; $cli = 0; $pag = 0; $pro = 0; $dti = date('d/m/Y'); $dtf = ''; $dte = ''; $ent = ''; $obs = ''; $con = $_SESSION['wrkcodcon']; $_SESSION['wrkvalcon'] = 0; $_SESSION['wrklisser'] = array();
                    echo '<script>history.go(-' . $_SESSION['wrknumvol'] . ');</script>'; $_SESSION['wrknumvol'] = 1;
               }
          }
          if ($_SESSION['wrkopereg'] == 3) {
               $ret = excluir_cto();
               $nom = retorna_dad('clirazao', 'tb_cliente', 'idcliente', $cli);
               $ret = gravar_log(13,"Exclusão de contrato existente: " . $nom); $_SESSION['wrkmostel'] = 0;
               $sta = 0; $cli = 0; $pag = 0; $pro = 0; $dti = date('d/m/Y'); $dtf = ''; $dte = ''; $ent = ''; $obs = ''; $con = $_SESSION['wrkcodcon']; $_SESSION['wrkvalcon'] = 0; $_SESSION['wrklisser'] = array();
               echo '<script>history.go(-' . $_SESSION['wrknumvol'] . ');</script>'; $_SESSION['wrknumvol'] = 1;
          }
     }

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
                         <form id="frmTelNov" name="frmTelNov" action="man-contrato.php?ope=1&cod=0" method="POST">
                              <div class="text-center">
                                   <button type="submit" class="bot-4" id="nov" name="novo"
                                        title="Mostra campos para criar novo contrato no sistema">Adicionar</button>
                              </div>
                         </form>
                    </div>
               </div>
               <form class="tel-1" id="frmTelMan" name="frmTelMan" action="" method="POST">
                    <div class="row">
                         <div class="col-md-2"></div>
                         <div class="col-md-8">
                              <label>Nome do Consultor</label>
                              <select id="con" name="con" class="form-control" <?php echo $con_l; ?> >
                                   <?php $ret = carrega_csu($con); ?>
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
                                        Finalizado
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
                         <div class="col-md-1"></div>
                         <div class="col-md-2">
                              <label>Data Inicial</label>
                              <input type="text" class="form-control text-center" maxlength="10" id="dti" name="dti"
                                   value="<?php echo $dti; ?>" required />
                         </div>
                         <div class="col-md-2">
                              <label>Data Entrada</label>
                              <input type="text" class="form-control text-center" maxlength="10" id="dte" name="dte"
                                   value="<?php echo $dte; ?>" />
                         </div>
                         <div class="col-md-2">
                              <label>Entrada - R$</label>
                              <input type="text" class="form-control text-center" maxlength="10" id="ent" name="ent"
                                   value="<?php echo $ent; ?>" />
                         </div>
                         <div class="col-md-2">
                              <label>Data Final</label>
                              <input type="text" class="form-control text-center" maxlength="10" id="dtf" name="dtf"
                                   value="<?php echo $dtf; ?>" required />
                         </div>
                         <div class="col-md-2 text-center"><br />
                              <button type="button" id="itens" name="itens" class="bot-4">+ Serviços</button>
                         </div>
                         <div class="col-md-1"></div>
                    </div>
                    <div class="row">
                         <div class="col-md-2"></div>
                         <div class="col-md-8">
                              <label>Briefing do Contrato</label>
                              <textarea class="form-control" rows="3" id="obs" name="obs"><?php echo $obs; ?></textarea>
                         </div>
                         <div class="col-md-2 text-center"><br />
                              <h5><strong>
                                        <?php
                                   echo '<span id="tot_c" class="bg-primary text-white">';
                                   echo '&nbsp; R$ ' . number_format($_SESSION['wrkvalcon'], 2, ",", ".") . ' &nbsp; ';
                                   echo '</span>';
                              ?>
                                   </strong></h5>
                         </div>
                    </div>
                    <br />
                    <div class="row">
                         <div class="col-sm-4"></div>
                         <div class="col-sm-2 text-center">
                              <button type="submit" name="salvar" <?php echo $per; ?>
                                   class="bot-4 <?php echo $del; ?>"><?php echo $bot; ?></button>
                         </div>
                         <div class="col-sm-2 text-center">
                              <button type="button" class="bot-1" id="volta" name="volta"
                                   onclick="location.href='<?php echo $_SESSION['wrkproant'] . ".php"; ?>'">Voltar</button>
                         </div>
                         <div class="col-sm-4"></div>
                    </div>
                    <br />
                    <input type="hidden" id="tot_g" name="tot_g" value="<?php echo $_SESSION['wrkvalcon']; ?>" />
               </form>
          </div>
     </div>

     <!----------------------------------------------------------------------------------->
     <div class="modal fade" id="ser-con" tabindex="-1" role="dialog" aria-labelledby="tel-con" aria-hidden="true"
          data-backdrop="static">
          <div class="modal-dialog  modal-lg" role="document">
               <!-- modal-sm modal-lg modal-xl -->
               <form id="frmMosSer" name="frmMosSer" action="man-contrato.php" method="POST">
                    <div class="modal-content">
                         <div class="modal-header  bg-primary text-white">
                              <h5 class="modal-title" id="tel-con">Serviços do Contrato</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                   <span aria-hidden="true">&times;</span>
                              </button>
                         </div>
                         <div class="tel-1 modal-body">
                              <div class="row">
                                   <div class="col-md-5"></div>
                                   <div class="col-md-2 text-center">
                                        <label>Número</label>
                                        <strong><input type="text" class="form-control text-center" maxlength="7"
                                                  id="num_s" name="num_s" value="1 º " disabled /></strong>
                                   </div>
                                   <div class="col-md-5"></div>
                              </div>
                              <div class="row">
                                   <div class="col-md-5"></div>
                                   <div class="col-md-2 text-center">
                                        <label>Código do Serviço</label>
                                        <strong><input type="text" class="form-control text-center" maxlength="7"
                                                  id="cod_s" name="cod_s" value="" riquered /></strong>
                                   </div>
                                   <div class="col-md-5"></div>
                              </div>
                              <div class="row">
                                   <div class="col-md-12">
                                        <label>Serviço</label>
                                        <select id="des_s" name="des_s" class="form-control">
                                             <?php echo carrega_ser(); ?>
                                        </select>
                                   </div>
                              </div>
                              <div class="row">
                                   <div class="col-md-3 text-center"></div>
                                   <div class="col-md-3">
                                        <label>Vigência</label>
                                        <select id="vig_s" name="vig_s" class="form-control">
                                             <?php echo carrega_vig(); ?>
                                        </select>
                                   </div>
                                   <div class="col-md-3">
                                        <label>Desconto - %</label>
                                        <input type="text" class="form-control text-center" maxlength="5" id="per_s"
                                             name="per_s" value="0,00" riquered />
                                   </div>
                                   <div class="col-md-3"></div>
                              </div>
                              <div class="row">
                                   <div class="col-md-4">
                                        <label>Preço</label>
                                        <input type="text" class="form-control text-center" maxlength="10" id="pre_s"
                                             name="pre_s" value="" disabled />
                                   </div>
                                   <div class="col-md-1"></div>
                                   <div class="col-md-2">
                                        <label>Nº de Parcelas</label>
                                        <input type="text" class="form-control text-center" maxlength="2" id="par_s"
                                             name="par_s" value="1" required />
                                   </div>
                                   <div class="col-md-1"></div>
                                   <div class="col-md-4">
                                        <label>Valor da Parcela</label>
                                        <input type="text" class="form-control text-center" maxlength="10" id="val_s"
                                             name="val_s" value="" disabled />
                                   </div>
                              </div>
                              <div class="row">
                                   <div class="col-md-12">
                                        <label>BRIEFING</label>
                                        <textarea class="form-control" rows="3" id="obs_s" name="obs_s"></textarea>
                                   </div>
                              </div>
                              <br />
                         </div>
                         <div class="row">
                              <div class="col-md-12">
                                   <div id="lis_s"><?php echo $ite_c; ?></div>
                              </div>
                         </div>
                         <div class="modal-footer">
                              <button type="button" id="gra_s" name="salvar"
                                   class="btn btn-outline-success">Adicionar</button>
                              <button type="button" id="fec_s" name="fechar" class="btn btn-outline-danger"
                                   data-dismiss="modal">Fechar</button>
                         </div>
                    </div>
                    <input type="hidden" id="ser_t" name="ser_t" value="0" />
                    <input type="hidden" id="val_t" name="val_t" value="0" />
               </form>
          </div>
     </div>
     <!----------------------------------------------------------------------------------->


</body>
<?php
function ultimo_cod() {
     $cod = 1;
     include_once "dados.php";
     $nro = acessa_reg('Select idcontrato from tb_contrato order by idcontrato desc Limit 1', $reg);
     if ($nro == 1) {
          $cod = $reg['idcontrato'] + 1;
     }        
     return $cod;
}

function carrega_cli($cli) {
     $sta = 0;
     include_once "dados.php";    
     if ($cli == 0) {
          echo '<option value="0" selected="selected">Selecione cliente desejado ...</option>';
     }
     $com = "Select idcliente, clifantasia from tb_cliente where clistatus = 0 and cliempresa = " . $_SESSION['wrkcodemp'] . " order by clirazao, idcliente";
     $nro = leitura_reg($com, $reg);
     foreach ($reg as $lin) {
          if ($lin['idcliente'] != $cli) {
               echo  '<option value ="' . $lin['idcliente'] . '">' . $lin['clifantasia'] . '</option>'; 
          } else {
               echo  '<option value ="' . $lin['idcliente'] . '" selected="selected">' . $lin['clifantasia'] . '</option>';
          }
     }
     return $sta;
}

function carrega_csu($con) {
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

function carrega_ser() {
     $txt = "";
     include_once "dados.php";    
     $txt .= '<option value="0" selected="selected">Selecione serviço desejado ...</option>';
     $com = "Select idservico, serdescricao from tb_servico where serstatus = 0 and serempresa = " . $_SESSION['wrkcodemp'] . " order by serdescricao, idservico";
     $nro = leitura_reg($com, $reg);
     foreach ($reg as $lin) {
          $txt .=  '<option value ="' . $lin['idservico'] . '">' . $lin['serdescricao'] . '</option>'; 
     }
     return $txt;
}

function carrega_vig() {
     $txt = "";
     $txt .= '<option value="0">S/ Vigência</option>';
     $txt .= '<option value="1">Mensal</option>';
     $txt .= '<option value="2">Bimestral</option>';
     $txt .= '<option value="3">Trimestral</option>';
     $txt .= '<option value="4">Semestral</option>';
     $txt .= '<option value="5">Anual</option>';
     $txt .= '<option value="6">Bienal</option>';
     $txt .= '<option value="7">Trianual</option>';
     return $txt;
}


function ler_contrato(&$cha, &$sta, &$cli, &$pag, &$pro, &$dti, &$dtf, &$dte, &$ent, &$obs, &$con) {
     include_once "dados.php";
     $nro = acessa_reg('Select * from tb_contrato where idcontrato = ' . $cha, $reg);
     if ($nro == 0 || $reg == false) {
          echo '<script>alert("Número do contrato informado não cadastrado");</script>';
          $nro = 1;
     }else{
          $cha = $reg['idcontrato'];
          $cli = $reg['concliente'];
          $pag = $reg['conpagto'];
          $sta = $reg['constatus'];
          $pro = $reg['conproposta'];
          $dti = date('d/m/Y',strtotime($reg['condataemi']));
          $con = $reg['conconsultor'];
          $dtf = date('d/m/Y',strtotime($reg['condatafim']));
          $obs = $reg['conobservacao'];
          if ($reg['condataent'] == null) {
               $dte = "";
          } else {
               $dte = date('d/m/Y',strtotime($reg['condataent']));
          }
          $ent = number_format($reg['convalentrada'], 2, ",", ".");
          $_SESSION['wrkcodreg'] = $reg['idcontrato'];
          $_SESSION['wrkvalcon'] = $reg['convaltotal'];
     }
     return $cha;
}      

function consiste_cto() {
     $sta = 0;
     if (trim($_REQUEST['cli']) == "" || trim($_REQUEST['cli']) == "0") {
          echo '<script>alert("Razão Social da cliente não pode estar em branco");</script>';
          return 1;
     }
     if (isset($_REQUEST['con']) == true) {
          if (trim($_REQUEST['con']) == "" || trim($_REQUEST['con']) == "0") {
               echo '<script>alert("Nome do Consultor do contrato não pode estar em branco");</script>';
               return 1;
          }
     }
     if (trim($_REQUEST['pag']) == "" || trim($_REQUEST['pag']) == "0") {
          echo '<script>alert("Forma de Pagamento do contrato não pode estar em branco");</script>';
          return 1;
     }
     if ($_SESSION['wrkvalcon'] == 0) {
          echo '<script>alert("Valor total do contrato informado não pode ser igual a ZERO");</script>';
          $sta = 1;
     }       
     if (strlen($_REQUEST['obs']) > 500) {
          echo '<script>alert("Observação do contrato não pode ter mais de 500 caracteres");</script>';
          $sta = 1;
     }       
     if (trim($_REQUEST['dti']) == "" || trim($_REQUEST['dti']) == "/  /") {
          echo '<script>alert("Data inicial do contrato não pode ser em branco");</script>';
          $sta = 1;
     }       
     if (trim($_REQUEST['dtf']) == "" || trim($_REQUEST['dtf']) == "/  /") {
          echo '<script>alert("Data final do contrato não pode ser em branco");</script>';
          $sta = 1;
     }       
     return $sta;
}    

function incluir_cto() {
     $ret = 0;
     include_once "dados.php";
     $sql  = "insert into tb_contrato (";
     $sql .= "conempresa, ";
     $sql .= "conproposta, ";
     $sql .= "constatus, ";
     $sql .= "concliente, ";
     $sql .= "conconsultor, ";
     $sql .= "conpagto, ";
     $sql .= "condataemi, ";
     $sql .= "condatafim, ";
     $sql .= "condataent, ";
     $sql .= "convaltotal, ";
     $sql .= "convaldesconto, ";
     $sql .= "convalentrada, ";
     $sql .= "conobservacao, ";
     $sql .= "keyinc, ";
     $sql .= "datinc ";
     $sql .= ") value ( ";
     $sql .= "'" . $_SESSION['wrkcodemp'] . "',";
     $sql .= "'" . (isset($_REQUEST['pro']) == false ? '0' : '1') . "',";
     $sql .= "'" . $_REQUEST['sta'] . "',";
     $sql .= "'" . $_REQUEST['cli'] . "',";
     if (isset($_REQUEST['con']) == true) {
          $sql .= "'" . $_REQUEST['con'] . "',";
     } else {
          $sql .= "'" . $_SESSION['wrkcodcon'] . "',";
     }     
     $sql .= "'" . $_REQUEST['pag'] . "',";
     $sql .= "'" . inverte_dat(1, $_REQUEST['dti']) . "',";
     $sql .= "'" . inverte_dat(1, $_REQUEST['dtf']) . "',";
     $sql .= " " . ($_REQUEST['dte'] == "" ? "NULL" : "'" . inverte_dat(1, $_REQUEST['dte']) . "'") . " ,";
     $sql .= "'" . $_SESSION['wrkvalcon'] . "',";
     $sql .= "'" . '0' . "',";
     $sql .= "'" . ($_REQUEST['ent'] == "" ? '0' : str_replace(",", ".", str_replace(".", "", $_REQUEST['ent']))) . "',";
     $sql .= "'" . $_REQUEST['obs'] . "',";
     $sql .= "'" . $_SESSION['wrkideusu'] . "',";
     $sql .= "'" . date("Y/m/d H:i:s") . "')";
     $ret = comando_tab($sql, $nro, $ult, $men);
     $_SESSION['wrkcodreg'] = $ult;
     if ($ret == true) {
          echo '<script>alert("Registro incluído no sistema com Sucesso !");</script>';
     }else{
          print_r($sql);
          echo '<script>alert("Erro na gravação do registro solicitado !");</script>';
     }
     return $ret;
 }
 
 function alterar_cto() {
     $ret = 0;
     include_once "dados.php";
     $sql  = "update tb_contrato set ";
     $sql .= "conproposta = '". (isset($_REQUEST['pro']) == false ? '0' : '1') . "', ";
     $sql .= "constatus = '". $_REQUEST['sta'] . "', ";
     $sql .= "concliente = '". $_REQUEST['cli'] . "', ";
     if (isset($_REQUEST['con']) == true) {
          $sql .= "conconsultor = '". $_REQUEST['con'] . "', ";
     }
     $sql .= "conpagto = '". $_REQUEST['pag'] . "', ";
     $sql .= "condataemi = '". inverte_dat(1, $_REQUEST['dti']) . "', ";
     $sql .= "condatafim = '". inverte_dat(1, $_REQUEST['dtf']) . "', ";
     if ($_REQUEST['dte'] != "") {
          $sql .= "condataent = '". inverte_dat(1, $_REQUEST['dte']) . "', ";
     }
     $sql .= "convaltotal = '". $_SESSION['wrkvalcon'] . "', ";
     $sql .= "convalentrada = '". str_replace(",", ".", str_replace(".", "", $_REQUEST['ent'])) . "', ";
     $sql .= "convaldesconto = '". '0' . "', ";
     $sql .= "conobservacao = '". $_REQUEST['obs'] . "', ";
     $sql .= "keyalt = '" . $_SESSION['wrkideusu'] . "', ";
     $sql .= "datalt = '" . date("Y/m/d H:i:s") . "' ";
     $sql .= "where idcontrato = " . $_SESSION['wrkcodreg'];
     $ret = comando_tab($sql, $nro, $ult, $men);
     if ($ret == true) {
          echo '<script>alert("Registro alterado no sistema com Sucesso !");</script>';
     }else{
          print_r($sql);
          echo '<script>alert("Erro na regravação do registro solicitado !");</script>';
     }
     return $ret;
}

function excluir_cto() {
     $ret = 0;
     include_once "dados.php";
     $sql  = "delete from tb_contrato_s where itecontrato = " . $_SESSION['wrkcodreg'] ;
     $ret = comando_tab($sql, $nro, $cha, $men);
     $sql  = "delete from tb_contrato where idcontrato = " . $_SESSION['wrkcodreg'] ;
     $ret = comando_tab($sql, $nro, $cha, $men);
     if ($ret == true) {
          echo '<script>alert("Registro excluído no sistema com Sucesso !");</script>';
     }else{
          print_r($sql);
          echo '<script>alert("Erro na exclusão do registro solicitado !");</script>';
     }
     return $ret;
}

function carrega_ite($dti, &$dtf) {
     $txt = ""; $qtd = 0; $_SESSION['wrklisser'] = array();
     $com  = "Select I.*, S.serdescricao from (tb_contrato_s I left join tb_servico S on I.iteservico = S.idservico)  where I.iteempresa = " .  $_SESSION['wrkcodemp'] . " and I.itecontrato = " . $_SESSION['wrkcodreg'] . " order by I.iditem";
     $nro = leitura_reg($com, $reg);
     if ($nro > 0) {
          $txt .= '<div class="tab-2 table-responsive">';
          $txt .= '<table class="table table-sm">';
          $txt .= '<thead>';
          $txt .= '<tr>';
          $txt .= '<th>Nº</th>';
          $txt .= '<th width="35%">Descrição do Serviço</th>';
          $txt .= '<th>Vigência</th>';
          $txt .= '<th>Data Final</th>';
          $txt .= '<th>Preço</th>';
          $txt .= '<th>Desconto</th>';
          $txt .= '<th>Parcelas</th>';
          $txt .= '<th>Valor</th>';
          $txt .= '<th class="text-center">Excluir</th>';
          $txt .= '</tr>';
          $txt .= '</thead>';
          $txt .= '<tbody>';     
     }
     $ant = 0; $mes = 0; $dtf = ""; $dti = str_replace("/", "-", $dti);
     foreach ($reg as $lin) {
          $qtd = $qtd + 1;
          $txt .= '<tr>';     
          $txt .= '<td>' . $qtd . '</td>';
          $txt .= '<td>' . $lin['serdescricao'] . '</td>';
          if ($lin['itevigencia'] == 0) { $txt .= '<td>' . "S/ Vigência" . '</td>'; $mes = 0; }
          if ($lin['itevigencia'] == 1) { $txt .= '<td>' . "Mensal" . '</td>';  $mes = 1; }
          if ($lin['itevigencia'] == 2) { $txt .= '<td>' . "Bimestral" . '</td>';  $mes = 2; }
          if ($lin['itevigencia'] == 3) { $txt .= '<td>' . "Trimestral" . '</td>';  $mes = 3; }
          if ($lin['itevigencia'] == 4) { $txt .= '<td>' . "Semestral" . '</td>';  $mes = 6; }
          if ($lin['itevigencia'] == 5) { $txt .= '<td>' . "Anual" . '</td>';  $mes = 12; }
          if ($lin['itevigencia'] == 6) { $txt .= '<td>' . "Bianual" . '</td>';  $mes = 24; }
          if ($lin['itevigencia'] == 7) { $txt .= '<td>' . "Trianual" . '</td>';  $mes = 36; }
          $txt .= '<td>' . date('d/m/Y',strtotime($lin['itedatafim'])) . '</td>';
          $txt .= '<td class="text-right">' . number_format($lin['itepreco'], 2, ",", ".") . '</td>';
          $txt .= '<td class="text-right">' . number_format($lin['itedesconto'], 2, ",", ".") . '</td>';
          $txt .= '<td class="text-center">' . $lin['iteparcela'] . '</td>';
          $txt .= '<td class="text-right">' . number_format(($lin['itepreco'] * (1 - $lin['itedesconto'] / 100)) / $lin['iteparcela'], 2, ",", ".") . '</td>';
          $txt .= '<td class="lit-d text-center" cha_s="' . $lin['iteservico'] . '"><i class="cor-1 cur-1 fa fa-trash-o" aria-hidden="true" title="Efetua exclusão do serviço informado na linha para o contrato"></i></td>';
          $txt .= '</tr>';    
          $cod = $lin['iteservico'];
          $_SESSION['wrklisser']['sta'][$cod] = 1;
          $_SESSION['wrklisser']['cod'][$cod] = $lin['iteservico'];
          $_SESSION['wrklisser']['vig'][$cod] = $lin['itevigencia'];
          $_SESSION['wrklisser']['par'][$cod] = $lin['iteparcela'];
          $_SESSION['wrklisser']['pre'][$cod] = $lin['itepreco'];
          $_SESSION['wrklisser']['per'][$cod] = $lin['itedesconto'];
          $_SESSION['wrklisser']['mes'][$cod] = $lin['itemeses'];
          $_SESSION['wrklisser']['dtf'][$cod] = $lin['itedatafim'];
          $_SESSION['wrklisser']['obs'][$cod] = $lin['iteobservacao'];
          if ($mes >= $ant) {
               $ant = $mes;
               $dtf = date('d/m/Y', strtotime('+' . $mes . ' months', strtotime($dti)));
          }
     }
     if ($nro > 0) {
          $txt .= '</tbody>';
          $txt .= '</table>';
          $txt .= '</div>';     
     }
     return $txt;
}

function gravar_ser() {
     $ret = 0; $qtd = 1;
     include_once "dados.php";
     $sql  = "delete from tb_contrato_s where itecontrato = " . $_SESSION['wrkcodreg'] ;
     $ret = comando_tab($sql, $nro, $cha, $men);
     if ($ret == false) {
          print_r($sql);
          echo '<script>alert("Erro na exclusão do serviços solicitados !!");</script>';
     }
     foreach ($_SESSION['wrklisser']['cod'] as $key => $lin) {
          if ($_SESSION['wrklisser']['sta'][$lin] == 1) {
               $sql  = "insert into tb_contrato_s (";
               $sql .= "iteempresa, ";
               $sql .= "itecontrato, ";
               $sql .= "itestatus, ";
               $sql .= "itesequencia, ";
               $sql .= "iteservico, ";
               $sql .= "iteparcela, ";
               $sql .= "itevigencia, ";
               $sql .= "itedataini, ";
               $sql .= "itedatafim, ";
               $sql .= "itequantidade, ";
               $sql .= "itepreco, ";
               $sql .= "itedesconto, ";
               $sql .= "itemeses, ";
               $sql .= "iteobservacao, ";
               $sql .= "keyinc, ";
               $sql .= "datinc ";
               $sql .= ") value ( ";
               $sql .= "'" . $_SESSION['wrkcodemp'] . "',";
               $sql .= "'" . $_SESSION['wrkcodreg'] . "',";
               $sql .= "'" . $_REQUEST['sta'] . "',";
               $sql .= "'" . $qtd . "',"; $qtd += 1;
               $sql .= "'" . $lin . "',";
               $sql .= "'" . $_SESSION['wrklisser']['par'][$lin] . "',";
               $sql .= "'" . $_SESSION['wrklisser']['vig'][$lin] . "',";
               $sql .= "'" . inverte_dat(1, $_REQUEST['dti']) . "',";
               $sql .= "'" . $_SESSION['wrklisser']['dtf'][$lin] . "',";
               $sql .= "'" . '1' . "',";
               $sql .= "'" . $_SESSION['wrklisser']['pre'][$lin] . "',";
               $sql .= "'" . $_SESSION['wrklisser']['per'][$lin] . "',";
               $sql .= "'" . $_SESSION['wrklisser']['mes'][$lin] . "',";
               $sql .= "'" . 'Cadastro efetuado: ' . date("d/m/Y/ H:i:s") . "',";
               $sql .= "'" . $_SESSION['wrkideusu'] . "',";
               $sql .= "'" . date("Y-m-d H:i:s") . "')";
               $ret = comando_tab($sql, $nro, $ult, $men);
               if ($ret == false) {
                    print_r($sql);
                    echo '<script>alert("Erro na gravação do serviço solicitado !!");</script>';
               }     
          }
     }
     return $ret;
}

function atualiza_des(&$val_t, &$val_d, &$per_d) {
     $ret = 0; $val_d = 0; $val_t = 0; $per_d = 0;
     $com  = "Select Sum(itepreco) as convalor from tb_contrato_s where iteempresa = " .  $_SESSION['wrkcodemp'] . " and itecontrato = " . $_SESSION['wrkcodreg'];
     $nro = leitura_reg($com, $reg);
     foreach ($reg as $lin) {
          $val_t = $lin['convalor'];
     }
     if ($val_t > 0) {
          $com  = "Select * from tb_contrato_s where itedesconto > 0 and iteempresa = " .  $_SESSION['wrkcodemp'] . " and itecontrato = " . $_SESSION['wrkcodreg'];
          $nro = leitura_reg($com, $reg);
          foreach ($reg as $lin) {               
               $val_d = $val_d + $lin['itepreco'] * $lin['itedesconto'] / 100;
          }
          $per_d = $val_d / $val_t * 100;
          $sql  = "update tb_contrato set ";
          $sql .= "conperdesconto = '". round($per_d, 4) . "', ";
          $sql .= "convaldesconto = '". $val_d . "', ";
          $sql .= "keyalt = '" . $_SESSION['wrkideusu'] . "', ";
          $sql .= "datalt = '" . date("Y/m/d H:i:s") . "' ";
          $sql .= "where idcontrato = " . $_SESSION['wrkcodreg'];
          $ret = comando_tab($sql, $nro, $ult, $men);
          if ($ret == false) {
               print_r($sql);
               echo '<script>alert("Erro na regravação do desconto do contrato !");</script>';
          }
     }
     return $ret;
}
?>

</html>