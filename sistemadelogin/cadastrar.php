<?php
    require_once 'CLASSES/usuarios.php';
	$u = new Usuario;
?>


 <html lang="pt-br">
 <head>
      <meta charset="utf-8"/>
	  <title> Projeto Illi </title>
	  <link rel="stylesheet" href="CSS/estilo.css">
 </head>
 <body>
     <div id="corpo-form-cad">
      <h1> Cadastrar </h1>
      <form method="POST"> 
	    <input type="text" name="nome" placeholder="Nome Completo" maxlength="30">
		<input type="text" name="telefone" placeholder="Telefone" maxlength="30">
		<input type="email" name="email" placeholder="Usuario" maxlength="40">
		<input type="password" name="senha" placeholder="Senha" maxlength="30">
		<input type="password" name="confsenha" placeholder="Confirmar Senha" maxlength="15">
		<input type="submit" value="CADASTRAR"> 
	    
	  </form>
 </div>
  <?php
 //verificar se clicou no botao cadastrar
 if (isset($_POST['nome']))
 {
	 $nome = addslashes($_POST['nome']);
	 $telefone = addslashes($_POST['telefone']);
	 $email = addslashes($_POST['email']);
	 $senha = addslashes($_POST['senha']);
	 $confsenha = addslashes($_POST['confsenha']);
	 //verificar se esta preenchido
	 if(!empty($nome) && !empty($telefone) &&!empty($email) && !empty($senha) && !empty($confsenha))
	 {
		 $u->conectar("projeto_illi","localhost","root", "");
		 if($u->msgErro == "") //vazio eh pq esta ok
		 {
			 if($senha == $confsenha)
			 {
				 if($u->cadastrar($nome,$telefone,$email,$senha))
				 {
					 ?>
					 <div id="msg-sucesso">
					Cadastrado com sucesso! Acesse para entrar!
					</div>
					
					<?php 
				 }
				 else
				 {
					 ?>
					 <div class="msg-erro">
					Email ja cadastrado!
					</div>
					
					 <?php
				 }
			 }
			 else
			 {
				     ?>
					 <div class="msg-erro">
					Senha e confirmar senha nao correspondem!
					</div>
					
					 <?php
			 }
		 }
		 else
		 {
			 ?>
					 <div class="msg-erro">
				<?php echo "Erro: ".$u->msgErro; ?>
					</div>
					
					 <?php
		 }
	 }else
	 {
		            ?>
					 <div class="msg-erro">
					Preencha todos os campos!
					</div>
					
					 <?php 
	 }
 }
 
 ?>
 </body>
 </html>