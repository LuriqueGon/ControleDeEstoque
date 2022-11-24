<?php 

    namespace App\Models;
    use MF\Model\Model;

    class Fabricante extends Model{
        protected $id;
        protected $nome;
        protected $cnpj;
        protected $email;
        protected $endereco;
        protected $telefone;
        protected $idUser;
        

        public function adicionarFabricantes(){
            if($this->getFabricante()){
                $query  = "INSERT INTO fabricantes VALUES (NULL,?,?,?,?,?,DEFAULT,?)";
                $stmt = $this->db->prepare($query);
                $stmt->bindValue(1, $this->__get('nome'));
                $stmt->bindValue(2, $this->__get('cnpj'));
                $stmt->bindValue(3, $this->__get('email'));
                $stmt->bindValue(4, $this->__get('endereco'));
                $stmt->bindValue(5, $this->__get('telefone'));
                $stmt->bindValue(6, $this->__get('idUser'));
                $stmt->execute();
                return true;

            }else{
                return false;
                
            }

        }

        public function getFabricante(){
            $query  = "SELECT * FROM fabricantes WHERE CNPJFabricante = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('cnpj'));
            $stmt->execute();

            if(empty($stmt->fetch(\PDO::FETCH_ASSOC))){
                return true;
            }else{
                return false;
            }

            
        }

        public function getFabricanteUsingId(){
            $query  = "SELECT * FROM fabricantes WHERE idFabricante = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('id'));
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
            
        }

        

        public function getId(){
            $query  = "SELECT idFabricante FROM fabricantes WHERE CNPJFabricante = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('cnpj'));
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC)['idFabricante'];
        }

        public function getAll($ativo = 0){
            if($ativo == 0){
                $query  = "SELECT * FROM fabricantes ";
            }else{
                $query  = "SELECT * FROM fabricantes WHERE ativo = 1";

            }
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function desativar(){
            $query  = "UPDATE fabricantes SET ativo = 0 WHERE idFabricante = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('id'));
            $stmt->execute();
        }
        
        public function ativar(){
            $query  = "UPDATE fabricantes SET ativo = 1 WHERE idFabricante = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('id'));
            $stmt->execute();
        }

        public function editar(){

            $query  = "UPDATE fabricantes SET nomeFabricante = ?, CNPJFabricante =?, EmailFabricante= ?, enderecoFabricante = ?, TelefoneFabricante = ? WHERE idFabricante = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('nome'));
            $stmt->bindValue(2, $this->__get('cnpj'));
            $stmt->bindValue(3, $this->__get('email'));
            $stmt->bindValue(4, $this->__get('endereco'));
            $stmt->bindValue(5, $this->__get('telefone'));
            $stmt->bindValue(6, $this->__get('id'));
            $stmt->execute();

            return true;
        }
    }

?>