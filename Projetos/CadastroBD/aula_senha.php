<html>
<head>
	<meta charset="UTF-8" />
	<title>Alterar Senha</title>
	<link rel="stylesheet" href="form.css" />
</head>
<body>
	<div id=interface>
	<?php
	$erro = null;
	$valido = false;
		try
		{
			$connection = new PDO("mysql:host=localhost;dbname=banco_jessica_yasmim", "root", "root");
			$connection->exec("set names utf8");
		}
		catch(PDOException $e)
		{
			echo "Falha: " . $e->getMessage();
			exit();
		}
		
		if(isset($_REQUEST["validar"]) && $_REQUEST["validar"] == true)
		{
			if($_POST["senha"] != $_POST["senhaRepete"])
			{
				$erro = "Senha digitadas diferentes";
				$erro .= "<br /><a href='?id".$_POST["id"]."'>Tentar novamente</a>";
				echo $erro;
				exit();
			}
			else
			{
				$valido = true;
				
				$sql = "UPDATE usuarios SET
						senha = ?
						WHERE id = ?";
					
				$stmt = $connection->prepare($sql);
			
				$passwordHash = md5($_POST["senha"]);
				$stmt->bindParam(1, $passwordHash);
				$stmt->bindParam(2, $_POST["id"]);
			
				$stmt->execute();
			
				if($stmt->errorCode() != "00000")
				{
					$valido = false;
					$erro = "Erro código " . $stmt->errorCode() . ": ";
					$erro .= implode(", " . $stmt->errorCode());
				}
			}
		}
		else
		{
			$rs = $connection->prepare("SELECT nome, email FROM usuarios WHERE id = ?");
			$rs->bindParam(1, $_REQUEST["id"]);
				
			if($rs->execute())
			{
				if($registro = $rs->fetch(PDO::FETCH_OBJ))
				{
					$_POST["nome"] = $registro->nome;
					$_POST["email"] = $registro->email;
				}
				else
				{
					$erro = "Registro não encontrado";
				}
			}
			else
			{
				$erro = "Falha na captura do registro";
			}
		}
		
	?>
	
	<?php
		if($valido == true)
		{
			echo "Senha alterada com sucesso!";
			echo "<br /><br />";
			echo "<A href='aula_lista.php'>Visualizar registros</A>";
		}
		else
		{
			
			if(isset($erro))
			{
				echo $erro . "<br /><br />";
			}
			
	?>
	<form method=POST action="?validar=true">
		<fieldset>
			<legend>alterar Senha do Usuário</legend>
			
			<?php
				echo "Usuário: " .$_POST["nome"]. "<br />";
				echo "Email: " .$_POST["email"]."<br />";
			?>
			
			<p>Digite a senha: <input type=password name=senha></p>
			
			<p>Digite a senha novamente: <input type=password name=senhaRepete></p>
			
			<input type=hidden name=id value="<?php echo $_REQUEST["id"]; ?>">
			<p><input type=submit value="Alterar Senha"></p>
		</fieldset>
	</form>
	
	<?php
	}
	?>
	</div>
</body>
<html>