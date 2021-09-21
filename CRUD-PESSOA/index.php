<?php
require_once 'classe-pessoa.php';
$p = new Pessoa("crudpdo","localhost","root","");

?>

<html lang="pt-br">
 <head>
      <meta charset="utf-8"/>
	  <title> Projeto Illi </title>
	  <link rel="stylesheet" href="CSS/estilo.css">
 </head>
 <body>

	<?php
	if(isset($_POST['nome']))
		//se clicou no botao cadastrar ou editar
	{
		//------------EDITAR------------------
		if(isset($_GET['id_up']) && !empty($_GET['id_up']))
		{
			$id_upd = addslashes($_GET['id_up']);
			$nome = addslashes($_POST['nome']);
			$telefone = addslashes($_POST['telefone']);
			$email = addslashes($_POST['email']);
			if (!empty($nome) && !empty($telefone) && !empty($email))
			{
			//EDITAR OU ATUALIZAR
			$p->atualizarDados($id_upd, $nome, $telefone, $email);
			header("location:index.php");
			}
			else
			{
				?>
					<div class="aviso">
						<img src="IMAGENS/aviso.png">
						<h4>Preencha todos os campos!</h4>
					</div>
				<?php
			}
		}
		//-----------CADASTRAR-----------------
		else
		{
			$nome = addslashes($_POST['nome']);
			$telefone = addslashes($_POST['telefone']);
			$email = addslashes($_POST['email']);
			if (!empty($nome) && !empty($telefone) && !empty($email))
			{
			if(!$p->cadastrarPessoa($nome, $telefone, $email))
			{
				?>
					<div class="aviso">
						<img src="IMAGENS/aviso.png">
						<h4>Email ja esta cadastrado!</h4>
					</div>
				<?php
			}
			}
			else
			{
				?>
					<div class="aviso">
						<img src="IMAGENS/aviso.png">
						<h4>Preencha todos os campos!</h4>
					</div>
				<?php
			}
		}
	}
	
	
	?>
	<?php
		if(isset($_GET['id_up']))
		{
			$id_update = addslashes($_GET['id_up']);
			$res = $p->buscarDadosPessoa($id_update);
		}
	
	?>
	
	<section id="superior">
		<form method="POST">
			<h2> CADASTRAR CLIENTE</h2>
		
			<input type="text" placeholder="Nome" name="nome" id="nome" 
			value="<?php if(isset($res)){echo $res['nome'];}?>"
			>
			<input type="text" placeholder="Telefone" name="telefone" id="telefone"
			value="<?php if(isset($res)){echo $res['telefone'];}?>"
			>
			<input type="email" placeholder="E-mail" name="email"id="email"
			value="<?php if(isset($res)){echo $res['email'];}?>"
			>
			<input type="submit" 
			value="<?php if(isset($res)){echo "ATUALIZAR";}else{
				echo "CADASTRAR";}?>"
			> 
		</form>
	</section>		
	<section id="inferior">
		<table>
			<tr id="titulo">
				<td>NOME</td>
				<td>TELEFONE</td>
				<td colspan="2">E-MAIL</td> 
			</tr>
	<?php
		$dados = $p->buscarDados();
		if(count($dados)>0)// tem pessoas cadastradas no banco
		{
			for($i=0; $i < count($dados); $i++)
			{
				echo "<tr>";
				foreach ($dados[$i] as $k => $v)
				{
					if($k != "id")
					{
						echo "<td>".$v."</td>";
					}
				}
	?>
				<td>
					<a href="index.php?id_up=<?php echo $dados[$i]['id']; ?>">Editar</a>
					<a href="index.php?id=<?php echo $dados[$i]['id']; ?>">Excluir</a>
				</td>
	<?php
				echo "</tr>";
			}
		}
	else
	{
		  ?>
	    </table>
			<div class="aviso">
				<h4>Sem nenhum cadastro!</h4>
			</div>
		<?php
	}
	    ?>
	</section>	

 </body>
</html>


<?php

	if(isset($_GET['id']))
	{
		$id_pessoa = addslashes($_GET['id']);
		$p->excluirPessoa($id_pessoa);
		header("location: index.php");
	}

?>