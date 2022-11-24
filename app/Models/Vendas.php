<?php 


namespace App\Models;
    session_start();
    use MF\Model\Model;

    class Vendas extends Model{
        protected $id;
        protected $cdb;
        protected $quantidade;


        public function insertVendas(){
            if(empty($this->getItemVendas())){
                if($this->itemIsActive()){
                    $item = $this->getItem();
                    $estoque = $item['quantItens'] - $item['quantItensVend'];
                    if($estoque >= $this->__get('quantidade')){

                        $query = "INSERT INTO vendas VALUES (NULL, ?, ?, ?)" ;
                        $stmt = $this->db->prepare($query); 
                        $stmt->bindValue(1, $this->__get('cdb'));
                        $stmt->bindValue(2, $this->__get('quantidade'));
                        $stmt->bindValue(3, $_SESSION['idUsuario']);
                        $stmt->execute();

                        return true;
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }else{
                $item = $this->getItemVendas();

                var_dump($item);

                $estoque = $item['quantItens'] - $item['quantItensVend'] - $item['quantidade'];

                if($estoque >= $this->__get('quantidade')){
                    $quantidade = $item['quantidade'] + $this->__get('quantidade');
                    $query = "UPDATE vendas SET quantidade = ? WHERE cdb = ? AND idUser = ?" ;
                    $stmt = $this->db->prepare($query); 
                    $stmt->bindValue(1, $quantidade);
                    $stmt->bindValue(2, $this->__get('cdb'));
                    $stmt->bindValue(3, $_SESSION['idUsuario']);
                    $stmt->execute();

                    $item = $this->getItemVendas();

                    if($item['quantidade'] <= 0){
                        $query = "DELETE FROM vendas WHERE cdb = ? AND idUser = ?" ;
                        $stmt = $this->db->prepare($query); 
                        $stmt->bindValue(1, $this->__get('cdb'));
                        $stmt->bindValue(2, $_SESSION['idUsuario']);
                        $stmt->execute();
                        return true;
                    }
    
                    return true;
                }else{
                    return false;
                }

                
            }
        }

        public function getAll(){
            $query  = "SELECT * FROM vendas as v LEFT JOIN itens as i ON v.cdb = i.cdb WHERE idUser = ?";
            $stmt = $this->db->prepare($query); 
            $stmt->bindValue(1, $_SESSION['idUsuario']);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getItemVendas(){
            $query  = "SELECT * FROM vendas as v LEFT JOIN itens as i ON v.cdb = i.cdb WHERE v.cdb = ? AND i.ativo = 1 AND v.idUser = ?";
            $stmt = $this->db->prepare($query); 
            $stmt->bindValue(1, $this->__get('cdb'));
            $stmt->bindValue(2, $_SESSION['idUsuario']);
            $stmt->execute();
            $item = $stmt->fetch(\PDO::FETCH_ASSOC);


            return $item;

        }

        public function getConsumidorId(){
            $query = "SELECT id FROM historico ORDER BY id DESC limit 1";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        public function getItem(){
            $query  = "SELECT * FROM itens WHERE cdb = ? AND ativo = 1 ";
            $stmt = $this->db->prepare($query); 
            $stmt->bindValue(1, $this->__get('cdb'));
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        public function apagarVendas(){
            $query = "DELETE FROM vendas WHERE idUser = ?" ;
            $stmt = $this->db->prepare($query); 
            $stmt->bindValue(1, $_SESSION['idUsuario']);
            $stmt->execute();
            return true;
        }

        private function itemIsActive(){
            $query = "SELECT ativo FROM itens WHERE cdb = ?";
            $stmt = $this->db->prepare($query); 
            $stmt->bindValue(1, $this->__get('cdb'));
            $stmt->execute();

            if($stmt->fetch(\PDO::FETCH_ASSOC)['ativo'] == 1){
                return true;
            }else{
                return false;
            }
        }

    
    }

?>