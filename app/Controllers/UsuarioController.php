<?php 

    namespace App\Controllers;
    use MF\Controller\Action;
    use MF\Model\Container;

    class UsuarioController extends Action{

        public function register(){
            
            $arquivo = $_FILES['perfil'];
            var_dump($arquivo);

            $arquivoExplode = explode('.',$arquivo['name']);
            if($arquivoExplode[sizeof($arquivoExplode)-1] == 'jpg' || $arquivoExplode[sizeof($arquivoExplode)-1] == 'png'){
                mkdir(__DIR__.'../../../public/dist/img/'.$_POST['usuario'], 0777, true);
                move_uploaded_file($arquivo['tmp_name'], "dist/img/".$_POST['usuario']."/".$arquivo['name']);

                $usuario = Container::getModel('usuario');
            
                $usuario->__set('username', $_POST['usuario']);
                $usuario->__set('email', $_POST['email']);
                $usuario->__set('password', md5($_POST['senha']));
                $usuario->__set('permissao', $_POST['permissao']);
                $usuario->__set('perfil', $_POST['usuario']."/".$arquivo['name']);

                if($usuario->cadastrar()){
                    header('location: /?content=visualizar/usuarios&action=1');
                }else{
                    header('location: /?content=visualizar/usuarios&action=2');
                }

            }else{
                header('location: /?content=visualizar/usuarios&action=4');
            }



            
        }

        public function desativar(){
            $user = Container::getModel('usuario');
            $user->__set('id', $_GET['id']);
            $user->desativar();
        }

        public function ativar(){
            $user = Container::getModel('usuario');
            $user->__set('id', $_GET['id']);
            $user->ativar();
        }

        public function editar(){
            // var_dump($_POST);
            var_dump($_FILES);

            $user = Container::getModel('usuario');
            $user->__set('id',$_POST['idUser']);
            $user->__set('username',$_POST['usuario']);
            $user->__set('email',$_POST['email']);
            $user->__set('permissao',$_POST['permissao']);

            $arquivo = $_FILES['perfil'];
            if(empty($arquivo['name'])){
                $user->__set('perfil',$user->getPerfil());
            }else{
                $arquivoExplode = explode('.',$arquivo['name']);
                if($arquivoExplode[sizeof($arquivoExplode)-1] == 'jpg' || $arquivoExplode[sizeof($arquivoExplode)-1] == 'png'){
                    mkdir(__DIR__.'../../../public/dist/img/'.$_POST['usuario'], 0777, true);
                    move_uploaded_file($arquivo['tmp_name'], "dist/img/".$_POST['usuario']."/".$arquivo['name']);
                    $user->__set('perfil',$_POST['usuario']."/".$arquivo['name']);
                }
            }

            if($user->editar()){
                header('location: /?content=visualizar/usuarios&action=3');
            }else{
                header('location: /?content=visualizar/usuarios&action=2');
            }
        }

        public function editarMinhaConta(){
            session_start();
            var_dump($_POST);

            $user = Container::getModel('usuario');
            $user->__set('id',$_SESSION['idUsuario']);
            $user->__set('username',$_POST['nome']);
            $user->__set('email',$_POST['email']);
            $user->__set('password', md5($_POST['senha']));

            if($user->editarMeuPerfil()){
                header('location: /sair');
            }else{
                header('location: /');
            }
        }
        

        
        
    }

?>