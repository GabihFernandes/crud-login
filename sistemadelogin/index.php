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
     <div id="corpo-form">
      <h1> Entrar </h1>
      <form method="POST"> 
	    <input type="email" placeholder="Usuario" name="email">
		<input type="password" placeholder="Senha" name="senha">
		<input type="submit" value="ACESSAR"> 
	    <a href="cadastrar.php"> Ainda nao eh inscrito? <strong>Cadastre-se!</strong> </a>
	  </form>
 </div>
 <?php
 if (isset($_POST['email']))
 {
	 $email = addslashes($_POST['email']);
	 $senha = addslashes($_POST['senha']);
	 
	 if(!empty($email) && !empty($senha))
	 {
		 $u->conectar("projeto_illi","localhost","root", "");
		 if($u->msgErro =="")
		 {
			if($u->logar($email,$senha))
			{
				header ("location: http://localhost/CRUD-PESSOA/index.php");
			}
			else
			{
				?>
				<div class="msg-erro">
					Email e/ou senha estao incorretos!
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