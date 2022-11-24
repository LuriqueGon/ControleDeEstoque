<?php 

    namespace App\Models;
    use MF\Model\Model;

    class Item extends Model{
        protected $codProduto;
        protected $idFabricante;
        protected $CDB;
        protected $Descricao;
        protected $QuantItens;
        protected $QuantItensVend;
        protected $ValCompItens;
        protected $ValVendItens;
        protected $DataCompraItens;
        protected $DataVenci_Itens = "0000/00/00";
        protected $iduser;

        public function adicionarItem(){
            if($this->getItem()){
                $query  = "INSERT INTO itens VALUES (NULL,?,?,?,0,?,?,?,?,DEFAULT,?,?,?)";
                $stmt = $this->db->prepare($query);
                $stmt->bindValue(1, $this->__get('CDB'));
                $stmt->bindValue(2, $this->__get('Descricao'));
                $stmt->bindValue(3, $this->__get('QuantItens'));
                $stmt->bindValue(4, $this->__get('ValCompItens'));
                $stmt->bindValue(5, $this->__get('ValVendItens'));
                $stmt->bindValue(6, $this->__get('DataCompraItens'));
                $stmt->bindValue(7, $this->__get('DataVenci_Itens'));
                $stmt->bindValue(8, $this->__get('codProduto'));
                $stmt->bindValue(9, $this->__get('idFabricante'));
                $stmt->bindValue(10, $this->__get('iduser'));
                
                $stmt->execute();

                return true;

            }else{
                return false;
            }

        }

        public function getItem(){
            $query  = "SELECT * FROM itens WHERE cdb = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('CDB'));
            $stmt->execute();

            if(empty($stmt->fetch(\PDO::FETCH_ASSOC))){
                return true;
            }else{
                return false;
            }

            
        }

        public function getItemValues(){
            $query  = "SELECT * FROM itens WHERE cdb = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('CDB'));
            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
            
        }

        

        public function consultarItem(){
            $query  = "SELECT * FROM itens WHERE cdb = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('CDB'));
            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        public function getAll($ativo = 0){
            if($ativo == 0){
                $query  = "
                SELECT
                    i.idItens, i.cdb, i.descricao, i.quantItens, i.quantItensVend, i.valCompItem, i.valVendItem ,i.dataCompra ,i.dataVencItem, i.ativo, i.fabricantes_idFabricante, i.produtos_CodRefProduto, f.nomeFabricante
                FROM 
                    itens as i LEFT JOIN produtos as p ON i.produtos_CodRefProduto  = p.CodRefProduto LEFT JOIN fabricantes as f ON  i.fabricantes_idFabricante   = f.idFabricante";

            }else{
                $query  = "
                SELECT
                    i.idItens, i.cdb, i.descricao, i.quantItens, i.quantItensVend, i.valCompItem, i.valVendItem ,i.dataCompra ,i.dataVencItem, i.ativo, i.fabricantes_idFabricante, i.produtos_CodRefProduto, f.nomeFabricante
                FROM 
                    itens as i LEFT JOIN produtos as p ON i.produtos_CodRefProduto  = p.CodRefProduto LEFT JOIN fabricantes as f ON  i.fabricantes_idFabricante   = f.idFabricante
                WHERE i.ativo = 1";
                
            }
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);

            
        }

        public function getQuantItem(){
            $query  = "SELECT quantItens FROM itens WHERE cdb = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('CDB'));
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC)['quantItens'];
        }

        public function getQuantItemVendas(){
            $query  = "SELECT quantItensVend FROM itens WHERE cdb = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('CDB'));
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC)['quantItensVend'];
        }

        public function getQuantItens(){
            $query  = "SELECT quantItens FROM itens WHERE cdb = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('CDB'));
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC)['quantItens'];
        }

        

        public function adicionarEstoque(){
            $query  = "UPDATE itens SET quantItens = ?, dataCompra = ? WHERE cdb = ?";
            $stmt = $this->db->prepare($query);
            echo $this->__get('DataCompraItens');
            $stmt->bindValue(1, ($this->__get('QuantItens') + $this->getQuantItens()));
            $stmt->bindValue(2, $this->__get('DataCompraItens'));
            $stmt->bindValue(3, $this->__get('CDB'));
            $stmt->execute();
        }

        

        public function debitarItem(){
            $query  = "UPDATE itens SET quantItensVend = ? WHERE cdb = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('QuantItens') + $this->getQuantItemVendas());
            $stmt->bindValue(2, $this->__get('CDB'));
            $stmt->execute();
            return true;
        }

        public function desativar(){
            $query  = "UPDATE itens SET ativo = 0 WHERE cdb = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('CDB'));
            $stmt->execute();
        }
        
        public function ativar(){
            $query  = "UPDATE itens SET ativo = 1 WHERE cdb = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('CDB'));
            $stmt->execute();
        }
        
        public function editar(){
            $query  = "UPDATE itens SET descricao =?, quantItens =?, valCompItem=?, valVendItem=?, dataCompra=?, dataVencItem=? WHERE cdb=?";
            $stmt = $this->db->prepare($query);

            $stmt->bindValue(1, $this->__get('Descricao'));
            $stmt->bindValue(2, $this->__get('QuantItens'));
            $stmt->bindValue(3, $this->__get('ValCompItens'));
            $stmt->bindValue(4, $this->__get('ValVendItens'));
            $stmt->bindValue(5, $this->__get('DataCompraItens'));
            $stmt->bindValue(6, $this->__get('DataVenci_Itens'));
            $stmt->bindValue(7, $this->__get('CDB'));
            $stmt->execute();
            return true;
        }

        public function removerEstoque(){

            $item = $this->getItemValues($this->__get('CDB'));
            $this->debitarItem();
            
        }
        
        
    }

?>