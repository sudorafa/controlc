<?php

session_start();

include('conecta.php');
include('libera.php');

$ident_post1			=	$_POST["ident_post"];
$situacao1				= 	$_POST["situacao"];
$data_atualizacao1		= 	$_POST["data_atualizacao"];
$rma1					= 	$_POST["rma"];
$nfe1					= 	$_POST["nfe"];
$defeito1				= 	$_POST["defeito"];
$data_almox1			= 	$_POST["data_almox"];
$situacao_banco1		=	$_POST["situacao_banco"];
$id1					=	$_POST["id"];

$idusuario = $_SESSION["idusuario"];
$dados_usuario_logado = mysql_fetch_array(mysql_query("select * from usuariosc where idusuario = '$idusuario'"));
$filial_usuario_logado = $dados_usuario_logado[filial];


if($situacao1 == "filial")
			{
				if($situacao1 == $situacao_banco1)
				{
					echo "<script>window.alert('Status do Coletor ( filial ) Nada Salvo !')</script>";
					include("form_controles.php"); 
				}
				else
				{
					
					$query = "insert into consertoc (identificador, situacao, filial) values ('$ident_post1', 'filial', '$filial_usuario_logado')";
					if( mysql_query($query)) {}
					else
					{
						echo "<script>window.alert('Algo Errado no Query ! ')</script>";
						include("form_controles.php"); 
						
					}
					$query1 = "update consertoc set situacao = 'chegada', atualizacao = '$data_atualizacao1', rma = '$rma1',  nfe = '$nfe1',  defeito = '$defeito1', almox = '$data_almox1' where identificador = '$ident_post1' and situacao = 'conserto' and filial = '$filial_usuario_logado'"; 
					if( mysql_query($query1)){}
					else
					{
							echo "<script>window.alert('Algo Errado no Query 1 ! ')</script>";
							include("form_controles.php"); 
						
					}
					
					$query2 = "update coletores set status = 'CPD' where identificador = '$ident_post1' and filial = '$filial_usuario_logado'"; 
				
					if( mysql_query($query2)){
						echo "<script>window.alert('Finalizado Atualizacao de Status nos Registros deste Conserto !')</script>";
						include("form_controles.php"); 
					}
					else
					{
							echo "<script>window.alert('Algo Errado no Query 2 ! ')</script>";
							include("form_controles.php"); 
						
					}
				}
			}
			else
			{
				$query = "update consertoc set situacao = '$situacao1',  atualizacao = '$data_atualizacao1', rma = '$rma1',  nfe = '$nfe1',  defeito = '$defeito1', almox = '$data_almox1' where identificador = '$ident_post1' and filial = '$filial_usuario_logado'"; 
				
				if( mysql_query($query))
				{
					echo "<script>window.alert('Status Conserto Atualizados com Sucesso !')</script>";
					include("form_controles.php"); 
					
				}
				else
				{
						echo "<script>window.alert('Algo Errado no Query ! ')</script>";
						include("form_controles.php"); 
					
				}
				
				$query1 = "update coletores set status = 'CONSERTO' where identificador = '$ident_post1' and filial = '$filial_usuario_logado'"; 
				
				if( mysql_query($query1))
				{
										
				}
				else
				{
						echo "<script>window.alert('Algo Errado no Query ! ')</script>";
						include("form_controles.php"); 
					
				}
			}




?>

