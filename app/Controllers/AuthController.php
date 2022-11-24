<?php 

    namespace App\Controllers;
    use MF\Controller\Action;
    use MF\Model\Container;

    class AuthController extends Action{

        public function login(){
            session_start();

            if((isset($_SESSION['usuario']) && $_SESSION['usuario'] != "") || (isset($_COOKIE['Username']) && $_COOKIE['Username'] != "")){
                header('location: /');
            }
            $this->render('login');
        }

        public function sessao(){
            session_start();

            if(empty($_POST['username']) || empty($_POST['password'])){
                echo '<script>alert("Você deve digitar seu nome e Senha")</script>';
                echo '<script>location.href="/login.phtml"</script>';
                exit;
            }else{

                $usuario = Container::getModel('Usuario');
                $usuario->__set('username', $_POST['username']);
                $usuario->__set('password', md5($_POST['password']));
                
                $usuario->validar();
                
            }
        }

        public function forgotPassword(){
            $this->render('forgotPassword');

        }

        public function sair(){
            session_start();
            session_destroy();

            setcookie('idUser', null, -1);
            setcookie('Username', null, -1);
            setcookie('Permissao', null, -1);
            setcookie('perfil', null, -1);
            
            header('location: /login');
        }
        
        
    }

?>