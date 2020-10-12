<?php

	class AdminController
	{
		public function index()
		{


			$loader = new \Twig\Loader\FilesystemLoader('app/View');
			$twig = new \Twig\Environment($loader);
			$template = $twig->load('admin.html');

			$objPostagens = Postagem::selecionaTodos();

			$parametros = array();
			$parametros['postagens'] = $objPostagens;
			
			$conteudo = $template->render($parametros);

			echo $conteudo;	

		}

		public function create(){

			$loader = new \Twig\Loader\FilesystemLoader('app/View');
			$twig = new \Twig\Environment($loader);
			$template = $twig->load('create.html');

			$parametros = array();
			
			$conteudo = $template->render($parametros);

			echo $conteudo;	
		}

		public function insert()
		{
			try{

				Postagem::insert($_POST);
				echo '<script>alert("Publicação Inserida com Sucesso!")</script>';
				echo '<script>location.href="http://192.168.100.138/projeto_php/?pagina=admin&metodo=index"</script>';

			}catch(Exception $e){
				echo '<script>alert("'.$e->getMessage().'")</script>';
				echo '<script>location.href="http://192.168.100.138/projeto_php/?pagina=admin&metodo=create"</script>';
			}
			
		}

		public function change($paramId){

			$loader = new \Twig\Loader\FilesystemLoader('app/View');
			$twig = new \Twig\Environment($loader);
			$template = $twig->load('update.html');

			$post = Postagem::selecionaPorID($paramId);			

			$parametros = array();
			$parametros['id'] = $post->id;
			$parametros['titulo'] = $post->titulo;
			$parametros['conteudo'] = $post->conteudo;
			
			$conteudo = $template->render($parametros);

			echo $conteudo;	
		}

		public function update()
		{
			try{
				Postagem::update($_POST);
				echo '<script>alert("Publicação Atualizada com Sucesso!")</script>';
				echo '<script>location.href="http://192.168.100.138/projeto_php/?pagina=admin&metodo=index"</script>';
			}catch(Exception $e){
				echo '<script>alert("'.$e->getMessage().'")</script>';
				echo '<script>location.href="http://192.168.100.138/projeto_php/?pagina=admin&metodo=change&id='.$_POST['id'].'</script>';
			}
			
		}

		public function delete($paramId)
		{
			try{
				Postagem::delete($paramId);
				echo '<script>alert("Publicação Excluída com Sucesso!")</script>';
				echo '<script>location.href="http://192.168.100.138/projeto_php/?pagina=admin&metodo=index"</script>';
			}catch(Exception $e){
				echo '<script>alert("'.$e->getMessage().'")</script>';
				echo '<script>location.href="http://192.168.100.138/projeto_php/?pagina=admin&metodo=index"</script>';
			}
		}
	}