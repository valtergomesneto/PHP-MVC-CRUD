<?php

	class PostController
	{
		public function index($params)
		{
			try{

				$postagem = Postagem::selecionaPorId($params);

				$loader = new \Twig\Loader\FilesystemLoader('app/View');
				$twig = new \Twig\Environment($loader);
				$template = $twig->load('single.html');

				$parametros = array();
				$parametros['id'] = $postagem->id;
				$parametros['titulo'] = $postagem->titulo;
				$parametros['conteudo'] = $postagem->conteudo;
				$parametros['comentarios'] = $postagem->comentarios;
				$conteudo = $template->render($parametros);

				echo $conteudo;	

			}catch (Exception $e){
				echo $e->getMessage();
			}

		}

		public function addComent()
		{
			try{
				comentario::inserir($_POST);
				echo '<script>alert("Comentário inserido com Sucesso!")</script>';
				header('Location: http://192.168.100.138/projeto_php/?pagina=post&id='.$_POST['id']);
			}catch (Exception $e){
				echo '<script>alert("'.$e->getMessage().'")</script>';
				echo '<script>location.href="http://192.168.100.138/projeto_php/?pagina=post&id='.$_POST['id'].'"</script>';
			}
		}
	}