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
     <title>Consultor - Gerenciamento de Contratos - SearchMidia - Profsa Informátda Ltda</title>
</head>

<script>
$(function() {
     $("#tel").mask("(00)0000-0000");
     $("#cel").mask("(00)00000-0000");
     $("#cgc").mask("000.000.000-00");
     $("#cep").mask("00000-000");
     $("#num").mask("999.999", {
          reverse: true
     });
});

if ($('#pes').prop("checked") == false) {
     $('#cgc').val('');
     $('#doc_c').text('Número do C.p.f.');
     $('#doc_i').text('Registro Geral (R.G.)');
     $("#cgc").mask("000.000.000-00");
} else {
     $('#cgc').val('');
     $('#doc_c').text('Número do C.n.p.j.');
     $('#doc_i').text('Inscrição Estadual');
     $("#cgc").mask("00.000.000/0000-00");
}

$(document).ready(function() {
     var alt = $(window).height();
     var lar = $(window).width();
     if (lar < 800) {
          $('nav').removeClass("fixed-top");
     }

     $('#cgc').blur(function() {
          var cgc = $('#cgc').val();
          var cgc = cgc.replace(/[^0-9]/g, '');
          if (cgc != '') {
               $.ajax({
                    url: 'https://www.receitaws.com.br/v1/cnpj/' + cgc,
                    type: 'POST',
                    dataType: 'jsonp',
                    data: cgc,
                    success: function(data) {
                         if (data.nome != "") {
                              if ($('#des').val() == "") {
                                   $('#des').val(data.nome.substring(0, 75));
                              }
                              if ($('#fan').val() == "") {
                                   $('#fan').val(data.fantasia.substring(0, 50));
                              }
                              if ($('#end').val() == "") {
                                   $('#end').val(data.logradouro.substring(0, 50));
                              }
                              if ($('#num').val() == "" || $('#num').val() == ".") {
                                   $('#num').val(data.numero);
                              }
                              if ($('#cep').val() == "" || $('#cep').val() == "-") {
                                   $('#cep').val(data.cep.replace('.', ''));
                              }
                              if ($('#bai').val() == "") {
                                   $('#bai').val(data.bairro.substring(0, 50));
                              }
                              if ($('#com').val() == "") {
                                   $('#com').val(data.complemento);
                              }
                              if ($('#cid').val() == "") {
                                   $('#cid').val(data.municipio);
                              }
                              if ($('#est').val() == "") {
                                   $('#est').val(data.uf);
                              }
                              if ($('#con').val() == "") {
                                   $('#con').val(data.qsa[0].nome);
                              }
                              if ($('#tel').val() == "") {
                                   $('#tel').val(data.telefone.substring(0, 15));
                              }
                              if ($('#ema').val() == "") {
                                   $('#ema').val(data.email);
                              }
                         }
                    }
               });
          }
     });

     $('#cep').blur(function() {
          var cep = $('#cep').val();
          var cep = cep.replace(/[^0-9]/g, '');
          if (cep != '') {
               var url = '//viacep.com.br/ws/' + cep + '/json/';
               $.getJSON(url, function(data) {
                    if ("error" in data) {
                         return;
                    }
                    if ($('#end').val() == "") {
                         $('#end').val(data.logradouro.substring(0, 50));
                    }
                    if ($('#cep').val() == "" || $('#cep').val() == "-") {
                         $('#cep').val(data.cep.replace('.', ''));
                    }
                    if ($('#bai').val() == "") {
                         $('#bai').val(data.bairro.substring(0, 50));
                    }
                    if ($('#cid').val() == "") {
                         $('#cid').val(data.localidade);
                    }
                    if ($('#est').val() == "") {
                         $('#est').val(data.uf);
                    }
               });
          }
     });

     $('#pes').click(function() {
          if ($('#pes').prop("checked") == false) {
               $('#doc_c').text('Número do C.p.f.');
               $('#doc_i').text('Registro Geral (R.G.)');
               $("#cgc").mask("000.000.000-00");
          } else {
               $('#doc_c').text('Número do C.n.p.j.');
               $('#doc_i').text('Inscrição Estadual');
               $("#cgc").mask("00.000.000/0000-00");
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
               $ret = gravar_log(6,"Entrada na página de manutenção de consultores do sistema Pallas.46 - SearchMidia");  
          }
     }
     if (isset($_SESSION['wrkopereg']) == false) { $_SESSION['wrkopereg'] = 0; }
     if (isset($_SESSION['wrkcodreg']) == false) { $_SESSION['wrkcodreg'] = 0; }
     if (isset($_SESSION['wrknumvol']) == false) { $_SESSION['wrknumvol'] = 1; }
     if (isset($_REQUEST['ope']) == true) { $_SESSION['wrkopereg'] = $_REQUEST['ope']; }
     if (isset($_REQUEST['cod']) == true) { $_SESSION['wrkcodreg'] = $_REQUEST['cod']; }
     $cod = (isset($_REQUEST['cod']) == false ? 0  : $_REQUEST['cod']);
     $sta = (isset($_REQUEST['sta']) == false ? 0  : $_REQUEST['sta']);
     $gru = (isset($_REQUEST['gru']) == false ? 0  : $_REQUEST['gru']);
     $cgc = (isset($_REQUEST['cgc']) == false ? "" : $_REQUEST['cgc']);
     $ins = (isset($_REQUEST['ins']) == false ? "" : $_REQUEST['ins']);
     $tel = (isset($_REQUEST['tel']) == false ? "" : $_REQUEST['tel']);
     $cep = (isset($_REQUEST['cep']) == false ? "" : $_REQUEST['cep']);
     $end = (isset($_REQUEST['end']) == false ? "" : $_REQUEST['end']);
     $num = (isset($_REQUEST['num']) == false ? "" : $_REQUEST['num']);
     $com = (isset($_REQUEST['com']) == false ? "" : $_REQUEST['com']);
     $bai = (isset($_REQUEST['bai']) == false ? "" : $_REQUEST['bai']);
     $cid = (isset($_REQUEST['cid']) == false ? "" : $_REQUEST['cid']);
     $est = (isset($_REQUEST['est']) == false ? "" : $_REQUEST['est']);
     $cel = (isset($_REQUEST['cel']) == false ? '' : $_REQUEST['cel']);
     $ema = (isset($_REQUEST['ema']) == false ? '' : $_REQUEST['ema']);
     $pes = (isset($_REQUEST['pes']) == false ? 0 : $_REQUEST['pes']);
     $des = (isset($_REQUEST['des']) == false ? '' : str_replace("'", "´", $_REQUEST['des']));
     $fan = (isset($_REQUEST['fan']) == false ? '' : str_replace("'", "´", $_REQUEST['fan']));
     $obs = (isset($_REQUEST['obs']) == false ? '' : str_replace("'", "´", $_REQUEST['obs']));
 
     if ($_SESSION['wrkopereg'] == 1) { 
          $_SESSION['wrkcodreg'] = ultimo_cod();
          $_SESSION['wrkmostel'] = 1;
     }
     if ($_SESSION['wrkopereg'] == 3) { 
          $bot = 'Deletar'; 
          $del = "cor-2";
          $per = ' onclick="return confirm(\'Confirma exclusão de consultor informado em tela ?\')" ';
     }  
     if ($_SESSION['wrkopereg'] >= 2) {
          if (isset($_REQUEST['salvar']) == false) { 
               $cha = $_SESSION['wrkcodreg']; $_SESSION['wrknumcha'] = $_SESSION['wrkcodreg']; $_SESSION['wrkmostel'] = 1;
               $ret = ler_consultor($_SESSION['wrkcodreg'], $cgc, $des, $fan, $ema, $sta, $tel, $cep, $end, $num, $com, $bai, $cid, $est, $ins, $cel, $pes, $obs); 
          }
     }
     if (isset($_REQUEST['salvar']) == true) {
          $_SESSION['wrknumvol'] = $_SESSION['wrknumvol'] + 1;
          if ($_SESSION['wrkopereg'] == 1) {
               $ret = consiste_con();
               if ($ret == 0) {
                    $ret = incluir_con();
                    $ret = gravar_log(11,"Inclusão de novo consultor para venda: " . $des);
                    $des = ''; $ema = ''; $sta = 00; $cgc = ''; $tel = ''; $cel = ''; $obs = ''; $cep = ''; $end = ''; $num = ''; $com = ''; $bai = ''; $cid = ''; $est = ''; $reg = ''; $obs = ''; $pes = 0; $fan = ''; 
               }
          }
          if ($_SESSION['wrkopereg'] == 2) {
               $ret = consiste_con();
               if ($ret == 0) {
                    $ret = alterar_con();
                    $ret = gravar_log(12,"Alteração de consultor existente: " . $des); $_SESSION['wrkmostel'] = 0;
                    $des = ''; $ema = ''; $sta = 00; $cgc = ''; $tel = ''; $cel = ''; $obs = ''; $cep = ''; $end = ''; $num = ''; $com = ''; $bai = ''; $cid = ''; $est = ''; $reg = ''; $obs = ''; $pes = 0; $fan = ''; 
                    echo '<script>history.go(-' . $_SESSION['wrknumvol'] . ');</script>'; $_SESSION['wrknumvol'] = 1;
               }
          }
          if ($_SESSION['wrkopereg'] == 3) {
               $ret = excluir_con();
               $ret = gravar_log(13,"Exclusão de consultor existente: " . $des); $_SESSION['wrkmostel'] = 0;
               $des = ''; $ema = ''; $sta = 00; $cgc = ''; $tel = ''; $cel = ''; $obs = ''; $cep = ''; $end = ''; $num = ''; $com = ''; $bai = ''; $cid = ''; $est = ''; $reg = ''; $obs = ''; $pes = 0; $fan = ''; 
               echo '<script>history.go(-' . $_SESSION['wrknumvol'] . ');</script>'; $_SESSION['wrknumvol'] = 1;
          }
     }

?>

<body id="box00">
     <h1 class="cab-0">Manutenção de Consultores - SearchMidia - Profsa Informática</h1>
     <div class="row">
          <div class="col-12">
               <?php include_once "cabecalho-1.php"; ?>
          </div>
     </div>
     <div class="container">
          <div class="qua-0">
               <div class="row qua-2">
                    <div class="col-md-10 text-left">
                         <span>Manutenção de Consultores</span>
                    </div>
                    <div class="col-md-2">
                         <form name="frmTelNov" action="man-consultor.php?ope=1&cod=0" method="POST">
                              <div class="text-center">
                                   <button type="submit" class="bot-4" id="nov" name="novo"
                                        title="Mostra campos para criar novo consultor no sistema">Adicionar</button>
                              </div>
                         </form>
                    </div>
               </div>
               <form class="tel-1" name="frmTelMan" action="" method="POST">
                    <div class="row">
                         <div class="col-md-2">
                              <label>Código</label>
                              <input type="text" class="form-control text-center" maxlength="6" id="cod" name="cod"
                                   value="<?php echo $_SESSION['wrkcodreg']; ?>" disabled />
                         </div>
                         <div class="lit-1 col-md-2 text-center">
                              <span>Pessoa Jurídica</span> &nbsp; <br />
                              <input type="checkbox" id="pes" name="pes" value="1"
                                   <?php echo ($pes == 0 ? '': 'checked' ) ?> />
                         </div>
                         <div class="col-md-3">
                              <label id="doc_c">Número do C.p.f.</label>
                              <input type="text" class="form-control text-center" maxlength="20" id="cgc" name="cgc"
                                   value="<?php echo $cgc; ?>" />
                         </div>
                         <div class="col-md-2"></div>
                         <div class="col-md-3">
                              <label id="doc_i">Registro Geral (R.G.)</label>
                              <input type="text" class="form-control text-center" maxlength="15" id="ins" name="ins"
                                   value="<?php echo $ins; ?>" />
                         </div>
                    </div>
                    <div class="row">
                         <div class="col-md-7">
                              <label>Nome do Consultor</label>
                              <input type="text" class="form-control" maxlength="75" id="des" name="des"
                                   value="<?php echo $des; ?>" required />
                         </div>
                         <div class="col-md-5">
                              <label>Apelido</label>
                              <input type="text" class="form-control" maxlength="60" id="fan" name="fan"
                                   value="<?php echo $fan; ?>" />
                         </div>
                    </div>
                    <div class="row">
                         <div class="col-md-2">
                              <label>C.e.p.</label>
                              <input type="text" class="form-control" maxlength="9" id="cep" name="cep"
                                   value="<?php echo $cep; ?>" />
                         </div>
                         <div class="col-md-6"></div>
                         <div class="col-md-4">
                              <label>E-Mail</label>
                              <input type="email" class="form-control" maxlength="75" id="ema" name="ema"
                                   value="<?php echo $ema; ?>" required />
                         </div>
                    </div>
                    <div class="row">
                         <div class="col-md-10">
                              <label>Endereço</label>
                              <input type="text" class="form-control" maxlength="50" id="end" name="end"
                                   value="<?php echo $end; ?>" />
                         </div>
                         <div class="col-md-2">
                              <label>Número</label>
                              <input type="text" class="form-control" maxlength="6" id="num" name="num"
                                   value="<?php echo $num; ?>" />
                         </div>
                    </div>
                    <div class="row">
                         <div class="col-md-10">
                              <label>Complemento</label>
                              <input type="text" class="form-control" maxlength="50" id="com" name="com"
                                   value="<?php echo $com; ?>" />
                         </div>
                         <div class="col-md-2"></div>
                    </div>
                    <div class="row">
                         <div class="col-md-6">
                              <label>Bairro</label>
                              <input type="text" class="form-control" maxlength="50" id="bai" name="bai"
                                   value="<?php echo $bai; ?>" />
                         </div>
                         <div class="col-md-5">
                              <label>Cidade</label>
                              <input type="text" class="form-control" maxlength="50" id="cid" name="cid"
                                   value="<?php echo $cid; ?>" />
                         </div>
                         <div class="col-md-1">
                              <label>Estado</label>
                              <input type="text" class="form-control" maxlength="2" id="est" name="est"
                                   value="<?php echo $est; ?>" />
                         </div>
                    </div>
                    <div class="row">
                         <div class="col-md-4">
                              <label>Telefone</label>
                              <input type="text" class="form-control" maxlength="15" id="tel" name="tel"
                                   value="<?php echo $tel; ?>" />
                         </div>
                         <div class="col-md-4">
                              <label>Celular</label>
                              <input type="text" class="form-control" maxlength="15" id="cel" name="cel"
                                   value="<?php echo $cel; ?>" required />
                         </div>
                         <div class="col-md-4">
                              <label>Status</label>
                              <select name="sta" class="form-control">
                                   <option value="0" <?php echo ($sta != 0 ? '' : 'selected="selected"'); ?>>Normal
                                   </option>
                                   <option value="1" <?php echo ($sta != 1 ? '' : 'selected="selected"'); ?>>
                                        Bloqueado</option>
                                   <option value="2" <?php echo ($sta != 2 ? '' : 'selected="selected"'); ?>>
                                        Suspenso</option>
                                   <option value="3" <?php echo ($sta != 3 ? '' : 'selected="selected"'); ?>>
                                        Cancelado</option>
                              </select>
                         </div>
                    </div>
                    <div class="row">
                         <div class="col-md-12">
                              <label>Observação</label>
                              <textarea class="form-control" rows="3" id="obs" name="obs"><?php echo $obs ?></textarea>
                         </div>
                    </div>
                    <br />
                    <div class="row text-center">
                         <div class="col-md-4"></div>
                         <div class="col-md-2">
                              <button type="submit" name="salvar" <?php echo $per; ?>
                                   class="bot-4 <?php echo $del; ?>"><?php echo $bot; ?></button>
                         </div>
                         <div class="col-md-2">
                              <?php
                                   echo '<div class="bot-1" ><a href="' . $_SESSION['wrkproant'] . '.php" title="Volta a página anterior deste processamento.">Voltar</a></div>'
                              ?>
                         </div>
                         <div class="col-md-4"></div>
                    </div>
                    <br />
               </form>
          </div>
          <br /><br />
          <div id="box10">
               <img class="subir" src="img/subir.png" title="Volta a página para o seu topo." />
          </div>
     </div>
</body>

<?php
function ultimo_cod() {
     $cod = 1;
     include_once "dados.php";
     $nro = acessa_reg('Select idconsultor from tb_consultor order by idconsultor desc Limit 1', $reg);
     if ($nro == 1) {
          $cod = $reg['idconsultor'] + 1;
     }        
     return $cod;
}

function carrega_gru($gru) {
     $sta = 0;
     include_once "dados.php";    
     if ($gru == 0) {
          echo '<option value="0" selected="selected">Selecione grupo desejado ...</option>';
     }
     $com = "Select idgrupo, grudescricao from tb_grupo where grustatus = 0 and grutiporeg = 1 and gruempresa = " . $_SESSION['wrkcodemp'] . " order by grudescricao, idgrupo";
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

function ler_consultor(&$cha, &$cgc, &$des, &$fan, &$ema, &$sta, &$tel, &$cep, &$end, &$num, &$com, &$bai, &$cid, &$est, &$ins, &$cel, &$pes, &$obs) {
     include_once "dados.php";
     $nro = acessa_reg('Select * from tb_consultor where idconsultor = ' . $cha, $reg);
     if ($nro == 0 || $reg == false) {
          echo '<script>alert("Código da consultor informada não cadastrada");</script>';
          $nro = 1;
     }else{
          $cha = $reg['idconsultor'];
          $des = $reg['connome'];
          $fan = $reg['conapelido'];
          $sta = $reg['constatus'];
          $cgc = $reg['concpf'];
          $ins = $reg['conregistro'];
          $ema = $reg['conemail'];
          $tel = $reg['contelefone'];
          $cel = $reg['concelular'];
          $cep = $reg['concep'];
          $end = $reg['conendereco'];
          $num = $reg['connumeroend'];
          $com = $reg['concomplemento'];
          $bai = $reg['conbairro'];
          $cid = $reg['concidade'];
          $est = $reg['conestado'];
          $pes = $reg['conpessoa'];
          $obs = $reg['conobservacao'];
          $_SESSION['wrkcodreg'] = $reg['idconsultor'];
     }
     return $cha;
}  

function consiste_con() {
     $sta = 0;
     if (trim($_REQUEST['des']) == "") {
          echo '<script>alert("Nome do consultor não pode estar em branco");</script>';
          return 1;
     }
     if (trim($_REQUEST['ema']) == "") {
          echo '<script>alert("E-mail da consultor não pode estar em branco");</script>';
          return 3;
     }
     if (trim($_REQUEST['cgc']) == "" || trim($_REQUEST['cgc']) == "../-") {
          echo '<script>alert("Número do C.n.p.j. da consultor pode estar em branco");</script>';
          return 7;
     }
     if (strlen($_REQUEST['obs']) > 500) {
          echo '<script>alert("Observação do consultor não pode ter mais de 500 caracteres");</script>';
          $sta = 1;
     }       
     if ($_REQUEST['est'] != "") {
          if (valida_est(strtoupper($_REQUEST['est'])) == 0) {
               echo '<script>alert("Estado da Federação da consultor informado não é válido");</script>';
               return 8;
          }
     }
     if ($_REQUEST['cgc'] != "") {
          if (isset($_REQUEST['pes']) == true) {
               $sta = valida_cgc($_REQUEST['cgc']);
               if ($sta != 0) {
                    echo '<script>alert("Dígito de controle do C.n.p.j. não está correto");</script>';
                    return 8;
               }
          } else {
               $sta = valida_cpf($_REQUEST['cgc']);
               if ($sta != 0) {
                    echo '<script>alert("Dígito de controle do C.p.f. não está correto");</script>';
                    return 8;
               }
          }
     }    
     return $sta;
}    

function incluir_con() {
     $ret = 0;
     include_once "dados.php";
     $sql  = "insert into tb_consultor (";
     $sql .= "conempresa, ";
     $sql .= "concpf, ";
     $sql .= "constatus, ";
     $sql .= "conregistro, ";
     $sql .= "connome, ";
     $sql .= "conapelido, ";
     $sql .= "concep, ";
     $sql .= "conendereco, ";
     $sql .= "connumeroend, ";
     $sql .= "concomplemento, ";
     $sql .= "conbairro, ";
     $sql .= "concidade, ";
     $sql .= "conestado, ";
     $sql .= "concelular, ";
     $sql .= "contelefone, ";
     $sql .= "conemail, ";
     $sql .= "conpessoa, ";
     $sql .= "conobservacao, ";
     $sql .= "keyinc, ";
     $sql .= "datinc ";
     $sql .= ") value ( ";
     $sql .= "'" . $_SESSION['wrkcodemp'] . "',";
     $sql .= "'" . limpa_nro($_REQUEST['cgc']) . "',";
     $sql .= "'" . $_REQUEST['sta'] . "',";
     $sql .= "'" . $_REQUEST['ins'] . "',";
     $sql .= "'" . $_REQUEST['des'] . "',";
     $sql .= "'" . $_REQUEST['fan'] . "',";
     $sql .= "'" . limpa_nro($_REQUEST['cep']) . "',";
     $sql .= "'" . $_REQUEST['end'] . "',";
     $sql .= "'" . limpa_nro($_REQUEST['num']) . "',";
     $sql .= "'" . $_REQUEST['com'] . "',";
     $sql .= "'" . $_REQUEST['bai'] . "',";
     $sql .= "'" . $_REQUEST['cid'] . "',";
     $sql .= "'" . $_REQUEST['est'] . "',";
     $sql .= "'" . $_REQUEST['cel'] . "',";
     $sql .= "'" . $_REQUEST['tel'] . "',";
     $sql .= "'" . $_REQUEST['ema'] . "',";
     $sql .= "'" . (isset($_REQUEST['pes']) == false ? 0 : 1 ) . "',";
     $sql .= "'" . $_REQUEST['obs'] . "',";
     $sql .= "'" . $_SESSION['wrkideusu'] . "',";
     $sql .= "'" . date("Y/m/d H:i:s") . "')";
     $ret = comando_tab($sql, $nro, $ult, $men);
     if ($ret == true) {
          echo '<script>alert("Registro incluído no sistema com Sucesso !");</script>';
     }else{
          print_r($sql);
          echo '<script>alert("Erro na gravação do registro solicitado !");</script>';
     }
     return $ret;
 }
 
 function alterar_con() {
     $ret = 0;
     include_once "dados.php";
     $sql  = "update tb_consultor set ";
     $sql .= "concpf = '". limpa_nro($_REQUEST['cgc']) . "', ";
     $sql .= "constatus = '". $_REQUEST['sta'] . "', ";
     $sql .= "conregistro = '". $_REQUEST['ins'] . "', ";
     $sql .= "connome = '". $_REQUEST['des'] . "', ";
     $sql .= "conapelido = '". $_REQUEST['fan'] . "', ";
     $sql .= "concep = '". limpa_nro($_REQUEST['cep']) . "', ";
     $sql .= "conendereco = '". $_REQUEST['end'] . "', ";
     $sql .= "connumeroend = '". limpa_nro($_REQUEST['num']) . "', ";
     $sql .= "concomplemento = '". $_REQUEST['com'] . "', ";
     $sql .= "conbairro = '". $_REQUEST['bai'] . "', ";
     $sql .= "concidade = '". $_REQUEST['cid'] . "', ";
     $sql .= "conestado = '". $_REQUEST['est'] . "', ";
     $sql .= "contelefone = '". $_REQUEST['tel'] . "', ";
     $sql .= "concelular = '". $_REQUEST['cel'] . "', ";
     $sql .= "conemail = '". $_REQUEST['ema'] . "', ";
     $sql .= "conpessoa = '". (isset($_REQUEST['pes']) == false ? 0 : 1 ) . "', ";
     $sql .= "conobservacao = '". $_REQUEST['obs'] . "', ";
     $sql .= "keyalt = '" . $_SESSION['wrkideusu'] . "', ";
     $sql .= "datalt = '" . date("Y/m/d H:i:s") . "' ";
     $sql .= "where idconsultor = " . $_SESSION['wrkcodreg'];
     $ret = comando_tab($sql, $nro, $ult, $men);
     if ($ret == true) {
          echo '<script>alert("Registro alterado no sistema com Sucesso !");</script>';
     }else{
          print_r($sql);
          echo '<script>alert("Erro na regravação do registro solicitado !");</script>';
     }
     return $ret;
}

function excluir_con() {
     $ret = 0;
     include_once "dados.php";
     $sql  = "delete from tb_consultor where idconsultor = " . $_SESSION['wrkcodreg'] ;
     $ret = comando_tab($sql, $nro, $cha, $men);
     if ($ret == true) {
          echo '<script>alert("Registro excluído no sistema com Sucesso !");</script>';
     }else{
          print_r($sql);
          echo '<script>alert("Erro na exclusão do registro solicitado !");</script>';
     }
     return $ret;
 }

?>

</html>