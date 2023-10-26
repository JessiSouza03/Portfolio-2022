<?php
	$erro = null;
	$valido = false;
	
		if(isset($_REQUEST["validar"]) && $_REQUEST["validar"]==true)
	{
		if(strlen(utf8_decode($_POST["nome"]))<5)
		{
			$erro = "Preencha o campo nome corretamente(5 ou mais caracteres)";
		}
		else if(strlen(utf8_decode($_POST["email"]))<5)
		{
			$erro = "E-mail inválido, preencha o campo email corretamente";
		}
		else if(is_numeric($_POST["idade"])==false)
		{
			$erro = "O campo idade deve ser numérico";
		}
		else if($_POST["sexo"] != "M" && $_POST["sexo"] != "F")
		{
			$erro = "Selecione o campo sexo corretamente";
		}
		else if($_POST["estadocivil"] != "Solteiro(a)" &&
		$_POST["estadocivil"] != "Casado(a)" &&
		$_POST["estadocivil"] != "Divorciado(a)" &&
		$_POST["estadocivil"] != "Viúvo(a)")
		{
			$erro = "Selecione o campo estado civil corretamente";
		}
		else
		{
				$valido = true;
				/*inicio do codigo de conexão*/
				try
		{
			$connection = new PDO("mysql:host=localhost;dbname=banco_funk", "root", "root");
			$connection->exec("set names utf8");
		}
		catch(PDOException $e)
		{
			echo "Falha: " . $e->getMessage();
			exit();
		}
			$sql = "UPDATE usuarios SET
					nome = ?, email = ?, idade = ?, sexo = ?, 
					estadocivil = ?, exatas = ?, humanas = ?, biologicas = ? 
					WHERE id = ?";
					
			$stmt = $connection->prepare($sql);
			
			$stmt->bindParam(1, $_POST["nome"]);
			$stmt->bindParam(2, $_POST["email"]);
			$stmt->bindParam(3, $_POST["idade"]);
			$stmt->bindParam(4, $_POST["sexo"]);
			$stmt->bindParam(5, $_POST["estadocivil"]);
			
			$checkHumanas = isset($_POST["humanas"]) ? 1 : 0;
			$stmt->bindParam(6, $checkHumanas);
			
			$checkExatas = isset($_POST["exatas"]) ? 1 : 0;
			$stmt->bindParam(7, $checkExatas);
			
			$checkBiologicas = isset($_POST["biologicas"]) ? 1 : 0;
			$stmt->bindParam(8, $checkBiologicas);
			
			$stmt->bindParam(9, $_POST["id"]);

			$stmt->execute();
			if($stmt->errorCode() != "00000")
			{
				$valido = false;
				$erro = "Erro código " . $stmt->errorCode() . ": ";
				$erro .= implode(", ", $stmt->errorInfo());
			}
	/*fim do codigo de conexão*/
			
	/*inicio do codigo de alteração*/
	else
	{
		$rs = $connection->prepare("SELECT * FROM usuarios WHERE id = ?");
		$rs->bindParam(1, $_REQUEST["id"]);
		
		if($rs->execute())
		{
			if($registro = $rs->fetch(PDO::FETCH_OBJ))
			{
				$_POST["nome"] = $registro->nome;
				$_POST["email"] = $registro->email;
				$_POST["idade"] = $registro->idade;
				$_POST["sexo"] = $registro->sexo;
				$_POST["estadocivil"] = $registro->estadocivil;
				$_POST["humanas"] = $registro->humanas;
				$_POST["exatas"] = $registro->exatas;
				$_POST["biologicas"] = $registro->biologicas;
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
}
}
	
	/*fim do codigo de alteração*/
?>
<html>
	<head>
		<meta charset="UTF-8" /> 
		<title>Exemplo Avançado</title>
	</head>
	<body>
			<?php
			if($valido == true)
			{
				echo "Dados enviados com sucesso !!!";
			}
			else
			{
			
			if(isset($erro))
			{
				echo $erro . "<br /><br />";
			}
			?>
			<form method=POST action="?validar=true">
			<p>Nome: <input type=text name=nome
			<?php if(isset($_POST["nome"])) {echo "value= '" . $_POST["nome"] . "'";} ?>
			></p>
			<p>E-mail: <input type=text name=email
			<?php if(isset($_POST["email"])) {echo "value= '" . $_POST["email"] . "'";} ?>
			></p>
			<p>Idade: <input type=text name=idade
			<?php if(isset($_POST["idade"])) {echo "value= '" . $_POST["idade"] . "'";} ?>
			></p>
			<p>Sexo: <input type=radio name=sexo value="M"
			<?php if(isset($_POST["sexo"]) && $_POST["sexo"] == "M") {echo "checked";} ?>
			>Masculino 
			<input type=radio name=sexo value="F"
			<?php if(isset($_POST["sexo"]) && $_POST["sexo"] == "F") {echo "checked";} ?>
			>Feminino</p>
			<p>Interesses: <input type=checkbox name=humanas
			<?php if(isset($_POST["humanas"])) {echo "checked";} ?>
			>Ciências Humanas 
			<input type=checkbox name=exatas
			<?php if(isset($_POST["exatas"])) {echo "checked";} ?>
			>Ciências Exatas 
			<input type=checkbox name=biologicas
			<?php if(isset($_POST["biologicas"])) {echo "checked";} ?>
			>Ciências Biológicas
			</p>
			<p>Estado Civil:  
			<select name=estadocivil>
			<option>Selecione</option>
			<option
			<?php if(isset($_POST["estadocivil"]) && $_POST["estadocivil"] == "Solteiro(a)") {echo "selected";} ?>
			>Solteiro(a)</option>
			<option
			<?php if(isset($_POST["estadocivil"]) && $_POST["estadocivil"] == "Casado(a)") {echo "selected";} ?>
			>Casado(a)</option>
			<option
			<?php if(isset($_POST["estadocivil"]) && $_POST["estadocivil"] == "Divorciado(a)") {echo "selected";} ?>
			>Divorciado(a)</option>
			<option
			<?php if(isset($_POST["estadocivil"]) && $_POST["estadocivil"] == "Viúvo(a)") {echo "selected";} ?>
			>Viúvo(a)</option>
			</select>
			</p>
			
			<input type=hidden name=id value="<?php echo $_REQUEST["id"]; ?>">
		
		<p><input type=reset value="Limpar"> <input type=submit value="Alterar"></p>
		</legend>
		</form>
		<?php
		}
		?>
	</body>
</html>
