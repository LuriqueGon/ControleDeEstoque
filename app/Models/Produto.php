<?php 

    namespace App\Models;
    use MF\Model\Model;

    class Produto extends Model{
        protected $nomeProduto;
        protected $idUsuario;
        protected $ref;

        public function adicionarProduto(){
            if($this->getProduto()){
                $query  = "INSERT INTO produtos (NomeProduto,usuarios_idUser) VALUES (?,?)";
                $stmt = $this->db->prepare($query);
                $stmt->bindValue(1, $this->__get('nomeProduto'));
                $stmt->bindValue(2, $this->__get('idUsuario'));
                $stmt->execute();
                return true;

            }else{
                return false;
            }

        }

        public function getProduto(){
            $query  = "SELECT * FROM produtos WHERE nomeProduto = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('nomeProduto'));
            $stmt->execute();

            if(empty($stmt->fetch(\PDO::FETCH_ASSOC))){
                return true;
            }else{
                return false;
            }

            
        }

        public function getProdutoUsingId(){
            $query  = "SELECT * FROM produtos WHERE CodRefProduto  = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('ref'));
            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
            
        }

        

        public function getAll($ativo = 0){
            
            if($ativo == 0){
                $query  = "SELECT * FROM produtos";
            }else{
                $query  = "SELECT * FROM produtos WHERE ativo = 1";
            }
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);

            
        }

        public function desativar(){
            $query  = "UPDATE produtos SET ativo = 0 WHERE CodRefProduto = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('ref'));
            $stmt->execute();
        }
        
        public function ativar(){
            $query  = "UPDATE produtos SET ativo = 1 WHERE CodRefProduto = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('ref'));
            $stmt->execute();
        }

        public function editar(){
            $query  = "UPDATE produtos SET NomeProduto = ?, usuarios_idUser  =? WHERE CodRefProduto  = ?" ;
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('nomeProduto'));
            $stmt->bindValue(2, $this->__get('idUsuario'));
            $stmt->bindValue(3, $this->__get('ref'));
            
            $stmt->execute();

            return true;
        }
        
        
        
    }

?>