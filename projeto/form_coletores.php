<?php
session_start();
	$codusuario = $_SESSION["codusuario"];
	$mensagem = $_SESSION["mensagem"];
			
	include('altoriza.php');
	
	include('conecta.php');
	
	if ( $_SESSION[altoriza] == "ok" ){
		include("index.php");
	
	}
?>
						
<html>
<head>
<link href="estilo.css" rel="stylesheet" type="text/css">
</head>
</head>
<body onLoad="document.form_home.matricula.focus()"> 
<script language="javascript" src="script/ajax.js"></script> 
<script language="javascript" src="script/fmenu.js"></script>
<script language="javascript" src="script/fcampo.js"></script>

<!---------------------------------------------------------------------------------->
<script language="javascript">
<!-- chama a função (buscar) -->
function valida_dados (buscar)
{
    if (buscar.identificador.value=="")
    {
        alert ("Por favor digite o usuario para buscar !");
        return false;
    }
return true;
}
</script>

<!---------------------------------------------------------------------------------->

<h2 align="center"> <font color="336699"> Buscar Coletor </font></h2>	

<table cellpadding="0" border="1" width="80%" align="center">
<tr>
	<form action="form_coletores.php" method="post" name="buscar" align="center" onSubmit="return valida_dados(this)">
	<td	align="center"> 
		<br>	
		
		&nbsp; &nbsp; &nbsp;
		<label> <font color="336699"> Identificador: </label> &nbsp;
		<label> <input name="identificador" value="<?php echo $_POST["identificador"]; ?>" type="text" size="6" maxlength="6" </label> &nbsp; 
		<input type="submit" name="buscar" value="buscar"> &nbsp; &nbsp; &nbsp;
		
		<br> <br>
	</td>
	</form>
	
	<?php 
		
		$identificador = $_POST['identificador'];
 
		$consulta = mysql_query("select * from coletores where identificador = '$identificador'");
		$linha = mysql_num_rows($consulta);
 
		if(($_POST[identificador]) or ($_POST[identificador] <> "") or ($_POST[identificador] <> 0)){
			
			if($linha == 1)
			{
				// o usuário existe;
				include("form_alterar_deletar_coletor.php");
			}
			else
			{
				// o usuário não existe;
				echo "<script>window.alert('Coletor nao existe, cadastre e salve !')</script>";
				include("form_cad_coletor.php");
			}
		}
		
		?>
</tr>
</table> 


</body>
</html>