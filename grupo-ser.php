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
     <title>Grupo de Serviço - Gerenciamento de Contratos - SearchMidia - Profsa Informátda Ltda</title>
</head>

<script>

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
               "infoEmpty": "Sem registros de Grupos de Serviços ...",
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
          echo '<script>alert("Nível de usuário não permite acesso a está opção do sistema");</script>';
          echo '<script>history.go(-1);</script>';
     }
     date_default_timezone_set("America/Sao_Paulo");
     $_SESSION['wrkdatide'] = date ("d/m/Y H:i:s", getlastmod());
     $_SESSION['wrknomide'] = get_current_user();
     if (isset($_SERVER['HTTP_REFERER']) == true) {
          if (limpa_pro($_SESSION['wrknompro']) != limpa_pro($_SERVER['HTTP_REFERER'])) {
               $_SESSION['wrkproant'] = limpa_pro($_SERVER['HTTP_REFERER']);
               $ret = gravar_log(6,"Entrada na página de manutenção de grupo de serviço do sistema Pallas.46 - SearchMidia");  
          }
     }
     if (isset($_SESSION['wrkopereg']) == false) { $_SESSION['wrkopereg'] = 0; }
     if (isset($_SESSION['wrkcodreg']) == false) { $_SESSION['wrkcodreg'] = 0; }
     if (isset($_REQUEST['ope']) == true) { $_SESSION['wrkopereg'] = $_REQUEST['ope']; }
     if (isset($_REQUEST['cod']) == true) { $_SESSION['wrkcodreg'] = $_REQUEST['cod']; }
     $cod = (isset($_REQUEST['cod']) == false ? 00 : $_REQUEST['cod']);
     $sta = (isset($_REQUEST['sta']) == false ? 00 : $_REQUEST['sta']);
     $des = (isset($_REQUEST['des']) == false ? '' : str_replace("'", "´", $_REQUEST['des']));
     $obs = (isset($_REQUEST['obs']) == false ? '' : str_replace("'", "´", $_REQUEST['obs']));
     if ($_SESSION['wrkopereg'] == 1) { 
          $cod = ultimo_cod();
     }
     if ($_SESSION['wrkopereg'] >= 2) {
          if (isset($_REQUEST['salvar']) == false) { 
               $cha = $_SESSION['wrkcodreg']; 
               $ret = ler_grupo($cha, $des, $sta, $obs); 
          }
     }
     if ($_SESSION['wrkopereg'] == 3) { 
          $bot = 'Deletar'; 
          $del = "cor-2";
          $per = ' onclick="return confirm(\'Confirma exclusão de Grupo de Serviço informado em tela ?\')" ';
     }

 if (isset($_REQUEST['salvar']) == true) {
      if ($_SESSION['wrkopereg'] == 1) {
           $sta = consiste_gru();
           if ($sta == 0) {
                $ret = incluir_gru();
                $cod = ultimo_cod();
                $ret = gravar_log(11,"Inclusão de novo Grupo de Serviço de campo: " . $des); 
                $des = ''; $obs = ''; $sta = 00; $_SESSION['wrkopereg'] = 1; $_SESSION['wrkcodreg'] = 0;
           }
      }
      if ($_SESSION['wrkopereg'] == 2) {
           $sta = consiste_gru();
           if ($sta == 0) {
                $ret = alterar_gru();
                $cod = ultimo_cod(); 
                $ret = gravar_log(12,"Alteração de Grupo de Serviço cadastrado: " . $des); 
                $des = ''; $obs = ''; $sta = 00;  $_SESSION['wrkopereg'] = 1; $_SESSION['wrkcodreg'] = 0;
           }
      }
      if ($_SESSION['wrkopereg'] == 3) {
           $ret = excluir_gru(); $bot = 'Salvar'; $per = '';
           $cod = ultimo_cod(); 
           $ret = gravar_log(13,"Exclusão de Grupo de Serviço cadastrado: " . $des); 
           $des = ''; $obs = ''; $sta = 00;  $_SESSION['wrkopereg'] = 1; $_SESSION['wrkcodreg'] = 0;
      }
}
?>

<body id="box00">
     <h1 class="cab-0">Manutenção de Grupo de Serviço - SearchMidia - Profsa Informática</h1>
     <div class="row">
          <div class="col-md-12">
               <?php include_once "cabecalho-1.php"; ?>
          </div>
     </div>
     <div class="container">
          <div class="qua-0">
               <div class="row qua-2">
                    <div class="col-md-10 text-left">
                         <span>Manutenção de Grupos de Serviço</span>
                    </div>
                    <div class="col-md-2 text-center">
                         <form name="frmTelNov" action="man-grupo.php?ope=1&cod=0" method="POST">
                              <div class="text-center">
                                   <button type="submit" class="bot-4" id="nov" name="novo"
                                        title="Mostra campos para criar novo Grupo de Serviço no sistema">Adicionar</button>
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
                              <label>Descrição do Grupo de Serviço</label>
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
                         <div class="col-md-12">
                              <label>Observação para o Grupo</label>
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
                                        <th>Descrição do Grupo</th>
                                        <th>Observação para o Grupo</th>
                                        <th>Inclusão</th>
                                        <th>Alteração</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php $ret = carrega_gru();  ?>
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
     exit('<script>location.href = "grupo-ser.php?ope=1&cod=0"</script>');
}

function ultimo_cod() {
     $cod = 1;
     include_once "dados.php";
     $nro = acessa_reg('Select idgrupo from tb_grupo order by idgrupo desc Limit 1', $reg);
     if ($nro == 1) {
          $cod = $reg['idgrupo'] + 1;
     }        
     return $cod;
}

function consiste_gru() {
     $sta = 0;
     if (trim($_REQUEST['des']) == "") {
          echo '<script>alert("Descrição do Grupo de Serviço não pode estar em branco");</script>';
          return 1;
     }
     if (strlen($_REQUEST['obs']) > 500) {
          echo '<script>alert("Observação para grupo não pode ter mais de 500 caracteres");</script>';
          $sta = 1;
     }       
     return $sta;
 }

function carrega_gru() {
     include_once "dados.php";
     $com = "Select * from tb_grupo where grutiporeg = 2 and gruempresa = " . $_SESSION['wrkcodemp'] . " order by grudescricao, idgrupo";
     $nro = leitura_reg($com, $reg);
     foreach ($reg as $lin) {
          $txt =  '<tr>';
          $txt .= '<td class="text-center"><a href="grupo-ser.php?ope=2&cod=' . $lin['idgrupo'] . '" title="Efetua alteração do registro informado na linha"><i class="large material-icons">healing</i></a></td>';
          $txt .= '<td class="lit-d text-center"><a href="grupo-ser.php?ope=3&cod=' . $lin['idgrupo'] . '" title="Efetua exclusão do registro informado na linha"><i class="cor-1 large material-icons">delete_forever</i></a></td>';
          $txt .= '<td class="text-center">' . $lin['idgrupo'] . '</td>';
          if ($lin['grustatus'] == 0) {$txt .= "<td>" . "Normal" . "</td>";}
          if ($lin['grustatus'] == 1) {$txt .= "<td>" . "Bloqueado" . "</td>";}
          if ($lin['grustatus'] == 2) {$txt .= "<td>" . "Suspenso" . "</td>";}
          if ($lin['grustatus'] == 3) {$txt .= "<td>" . "Cancelado" . "</td>";}
          $txt .= '<td class="text-left">' . $lin['grudescricao'] . "</td>";
          $txt .= '<td class="text-left">' . $lin['gruobservacao'] . "</td>";
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

function incluir_gru() {
     $ret = 0;
     include_once "dados.php";
     $sql  = "insert into tb_grupo (";
     $sql .= "grustatus, ";
     $sql .= "gruempresa, ";
     $sql .= "grutiporeg, ";
     $sql .= "grudescricao, ";
     $sql .= "gruobservacao, ";
     $sql .= "keyinc, ";
     $sql .= "datinc ";
     $sql .= ") value ( ";
     $sql .= "'" . $_REQUEST['sta'] . "',";
     $sql .= "'" . $_SESSION['wrkcodemp'] . "',";
     $sql .= "'" . '2' . "',";
     $sql .= "'" . str_replace("'", "´", $_REQUEST['des']) . "',";
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

function ler_grupo(&$cha, &$des, &$sta, &$obs) {
     include_once "dados.php";
     $nro = acessa_reg("Select * from tb_grupo where idgrupo = " . $cha, $reg);            
     if ($nro == 0) {
          echo '<script>alert("Código do Grupo de Serviço informado não cadastrado no sistema");</script>';
     } else {
          $cha = $reg['idgrupo'];
          $des = $reg['grudescricao'];
          $obs = $reg['gruobservacao'];
          $sta = $reg['grustatus'];
     }
     return $cha;
 }

 function alterar_gru() {
     $ret = 0;
     include_once "dados.php";
     $sql  = "update tb_grupo set ";
     $sql .= "grustatus = '". $_REQUEST['sta'] . "', ";
     $sql .= "grudescricao = '". $_REQUEST['des'] . "', ";
     $sql .= "gruobservacao = '". $_REQUEST['obs'] . "', ";
     $sql .= "keyalt = '" . $_SESSION['wrkideusu'] . "', ";
     $sql .= "datalt = '" . date("Y/m/d H:i:s") . "' ";
     $sql .= "where idgrupo = " . $_SESSION['wrkcodreg'];
     $ret = comando_tab($sql, $nro, $ult, $men);
     if ($ret == false) {
          print_r($sql);
          echo '<script>alert("Erro na regravação do registro solicitado !");</script>';
     }
     return $ret;
 } 

 function excluir_gru() {
     $ret = 0;
     include_once "dados.php";
     $sql  = "delete from tb_grupo where idgrupo = " . $_SESSION['wrkcodreg'] ;
     $ret = comando_tab($sql, $nro, $ult, $men);
     if ($ret == false) {
          print_r($sql);
          echo '<script>alert("Erro na exclusão do registro solicitado !");</script>';
     }
     return $ret;
 }


?>

</html>
