<?php 

    namespace App\Models;
    use MF\Model\Model;

    class Representante extends Model{
        protected $id;
        protected $nome;
        protected $email;
        protected $telefone;
        protected $idUser;
        protected $idFabricante;

        
        public function adicionarRepresentantes(){
            $query  = "INSERT INTO representantes VALUES (NULL,?,?,?, DEFAULT,?,?)";
            $stmt = $this->db->prepare($query);

            $stmt->bindValue(1, $this->__get('nome'));
            $stmt->bindValue(2, $this->__get('telefone'));
            $stmt->bindValue(3, $this->__get('email'));
            $stmt->bindValue(4, $this->__get('idFabricante'));
            $stmt->bindValue(5, $this->__get('idUser'));
            $stmt->execute();
            return true;

        }

        public function getAll($ativo = 0){
            if($ativo == 0){
                $query  = "
                SELECT 
                    r.idRepresentante, r.nomeRepresentante, r.telefoneRepresentante, r.emailRepresentante, r.ativo, r.fabricantes_idFabricante, f.nomeFabricante 
                FROM 
                    representantes as r LEFT JOIN fabricantes as f ON r.fabricantes_idFabricante = f.idFabricante ";
            }else{
                $query  = "
                SELECT 
                    r.idRepresentante, r.nomeRepresentante, r.telefoneRepresentante, r.emailRepresentante, r.ativo, r.fabricantes_idFabricante, f.nomeFabricante 
                FROM 
                    representantes as r LEFT JOIN fabricantes as f ON r.fabricantes_idFabricante = f.idFabricante 
                WHERE r.ativo = 1";
            }
            
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function desativar(){
            $query  = "UPDATE representantes SET ativo = 0 WHERE idRepresentante = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('id'));
            $stmt->execute();
        }
        
        public function ativar(){
            $query  = "UPDATE representantes SET ativo = 1 WHERE idRepresentante = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('id'));
            $stmt->execute();
        }

        public function editar(){
            $query  = "UPDATE representantes SET nomeRepresentante=?, telefoneRepresentante=?, emailRepresentante=?, usuarios_idUser =? WHERE idRepresentante = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('nome'));
            $stmt->bindValue(2, $this->__get('telefone'));
            $stmt->bindValue(3, $this->__get('email'));
            $stmt->bindValue(4, $this->__get('idUser'));
            $stmt->bindValue(5, $this->__get('id'));
            $stmt->execute();

            return true;
        }

        
    }

?>