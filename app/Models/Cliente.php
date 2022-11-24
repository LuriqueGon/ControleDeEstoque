<?php 

    namespace App\Models;
    use MF\Model\Model;

    class Cliente extends Model{
        protected $id;
        protected $cpf;
        protected $nome;
        protected $telefone = '0';
        protected $primeira_compra;
        protected $ultima_compra;
        protected $totalCompras;


        public function cadastrarCliente(){
            if(!empty($this->haveAccount())){
                return true;
            }else{
                $query = "INSERT INTO clientes (cpf, telefone) VALUES (?,?)";
                $stmt = $this->db->prepare($query);
                $stmt->bindValue(1, $this->__get('cpf'));
                $stmt->bindValue(2, $this->__get('telefone'));
                $stmt->execute();
                return true;
            }
        }

        public function adicionarCompra(){
            $compras = $this->getDados();
            $compras['primeira_compra'] = empty($compras['primeira_compra']) ? $this->__get('primeira_compra') : $compras['primeira_compra'];

            $compras['totalCompras'] += 1; 

            $query = "UPDATE clientes SET primeira_compra =? , ultima_compra=?, totalCompras=? WHERE cpf =?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $compras['primeira_compra']);
            $stmt->bindValue(2, $this->__get('ultima_compra'));
            $stmt->bindValue(3, $compras['totalCompras']);
            $stmt->bindValue(4, $this->__get('cpf'));
            $stmt->execute();
            return true;
        }

        public function getAll(){
            $query = "SELECT * FROM clientes ORDER BY totalCompras DESC";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        
        public function setTelefone(){
            $query = "UPDATE clientes SET telefone = ? WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('telefone'));
            $stmt->bindValue(2, $this->__get('id'));
            $stmt->execute();
        
        }

        public function setNome(){
            $query = "UPDATE clientes SET nome = ? WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('nome'));
            $stmt->bindValue(2, $this->__get('id'));
            $stmt->execute();
        
        }

        

        private function haveAccount(){
            $query = "SELECT * FROM clientes WHERE cpf = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('cpf'));
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        private function getDados(){
            $query = "SELECT primeira_compra,ultima_compra,totalCompras FROM clientes WHERE cpf = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('cpf'));
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }





        
    }

?>