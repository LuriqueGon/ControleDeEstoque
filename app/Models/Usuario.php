<?php 

    namespace App\Models;
    use MF\Model\Model;

    class Usuario extends Model{
        protected $id;
        protected $username;
        protected $email;
        protected $password;
        protected $permissao;
        protected $perfil = "perfilLurique001.png";

        public function validar(){

            $user = $this->getUser();

            

            if($user){

                if($this->password == $user['Senha']){

                    $_SESSION['idUsuario'] = $user['idUser'];
                    $_SESSION['usuario']   = $user['Username'];
                    $_SESSION['perm']      = $user['Permissao'];
                    $_SESSION['perfil']    = $user['perfil'];

                    setcookie('idUser', $user['idUser'], time() + 3600);
                    setcookie('Username', $user['Username'], time() + 3600);
                    setcookie('Permissao', $user['Permissao'], time() + 3600);
                    setcookie('perfil', $user['perfil'], time() + 3600);
                    
                    header("Location: /");
                }else{
                    header("Location: /login?alert=2");
                }
            }else{
                header("Location: /login?alert=1");
            
            }

        }

        public function getUser(){
            $query  = "SELECT * FROM usuarios WHERE `Username` = ? AND ativo = 1";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('username'));
            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        public function getAll($ativo = 0){
            if($ativo == 0){
                $query  = "SELECT idUser,Username,Email,perfil,DataRegistro,Permissao,ativo FROM usuarios";
            }else{
                $query  = "SELECT * FROM usuarios ORDER BY quantVendas DESC";
            }
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        

        public function cadastrar(){
            if($this->getName()){

                if($this->getEmail()){

                    $query  = "INSERT INTO usuarios VALUES (NULL,?,?,?,DEFAULT,?,DEFAULT,?,DEFAULT)";
                    $stmt = $this->db->prepare($query);
                    $stmt->bindValue(1, $this->__get('username'));
                    $stmt->bindValue(2, $this->__get('email'));
                    $stmt->bindValue(3, $this->__get('password'));
                    $stmt->bindValue(4, $this->__get('permissao'));
                    $stmt->bindValue(5, $this->__get('perfil'));
                    $stmt->execute();

                    return true;
                }
            }
            return false;
        }

        public function setVendas(){
            $query  = "UPDATE usuarios SET quantVendas = ? WHERE idUser = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->getVendas() +1);
            $stmt->bindValue(2, $this->__get('id'));
            $stmt->execute();
        }

        public function getVendas(){
            $query  = "SELECT quantVendas FROM usuarios WHERE idUser = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('id'));
            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC)['quantVendas'];
        }
        
        public function getThis(){
            $query  = "SELECT * FROM usuarios WHERE Username = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('username'));
            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        


        private function getName(){
            $query  = "SELECT * FROM usuarios WHERE Username = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('username'));
            $stmt->execute();

            if(empty($stmt->fetch(\PDO::FETCH_ASSOC))){
                return true;
            }else{
                return false;
            }
        }
        
        private function getEmail(){
            $query  = "SELECT * FROM usuarios WHERE `Email` = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('email'));
            $stmt->execute();

            if(empty($stmt->fetch(\PDO::FETCH_ASSOC))){
                return true;
            }else{
                return false;
            }
        }

        public function desativar(){
            $query = "UPDATE usuarios SET ativo = 0 WHERE idUser = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('id'));
            $stmt->execute();

            return true;
        }
        
        public function ativar(){
            $query = "UPDATE usuarios SET ativo = 1 WHERE idUser = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('id'));
            $stmt->execute();

            return true;
        }
        
        public function editar(){
            $query = "UPDATE usuarios SET Username=?, Email=?, Permissao=?, perfil =? WHERE idUser = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('username'));
            $stmt->bindValue(2, $this->__get('email'));
            $stmt->bindValue(3, $this->__get('permissao'));
            $stmt->bindValue(4, $this->__get('perfil'));
            $stmt->bindValue(5, $this->__get('id'));
            $stmt->execute();

            return true;
        }

        public function editarMeuPerfil(){
            $query = "UPDATE usuarios SET Username=?, Email=?, Senha=? WHERE idUser = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('username'));
            $stmt->bindValue(2, $this->__get('email'));
            $stmt->bindValue(3, $this->__get('password'));
            $stmt->bindValue(4, $this->__get('id'));
            $stmt->execute();

            return true;
        }

        

        public function getPerfil(){
            $query  = "SELECT perfil FROM usuarios WHERE `idUser` = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('id'));
            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC)['perfil'];
        }
        
        
        
    }

?>