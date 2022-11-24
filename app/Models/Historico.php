<?php 

namespace App\Models;
    use MF\Model\Model;

    class Historico extends Model{
        protected $date;
        protected $produtos;
        protected $valorPago;
        protected $MDP;
        protected $cpf = '00000000000';

        
        public function adicionarHistorico(){
            if($this->existeNoHistorico()){
                $data = $this->getHistorico()['primeira_compra'];
                $query = 'INSERT INTO historico (cpf,produtos,primeira_compra,ultima_compra,valorPago,MDP,idUser) VALUES (?,?,?,?,?,?,?)';
                $stmt = $this->db->prepare($query);
                $stmt->bindValue(1, $this->cpf);
                $stmt->bindValue(2, $this->produtos);
                $stmt->bindValue(3, $data);
                $stmt->bindValue(4, $this->date);
                $stmt->bindValue(5, $this->valorPago);
                $stmt->bindValue(6, $this->MDP);
                $stmt->bindValue(7, $_SESSION['idUsuario']);
            }else{
                echo 1;
                $query = 'INSERT INTO historico (cpf,produtos,ultima_compra,valorPago, MDP, idUser) VALUES (?,?,?,?,?,?)';
                $stmt = $this->db->prepare($query);

                $stmt->bindValue(1, $this->cpf);
                $stmt->bindValue(2, $this->produtos);
                $stmt->bindValue(3, $this->date);
                $stmt->bindValue(4, $this->valorPago);
                $stmt->bindValue(5, $this->MDP);
                $stmt->bindValue(6, $_SESSION['idUsuario']);
            }
            

            $stmt->execute();
        }

        private function existeNoHistorico(){
            $query = "SELECT * FROM historico WHERE cpf = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->cpf);
            $stmt->execute();

            if(!empty($stmt->fetch())){
                return true;
            }else{
                return false;
            }   
        }

        public function getHistorico(){
            $query = "SELECT * FROM historico WHERE cpf = ? ORDER BY primeira_compra limit 1";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->cpf);
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        public function getAllHistorico(){
            $query = "SELECT *, (SELECT count(cpf) FROM historico) as compras FROM historico ORDER BY totalCompras DESC";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getCpf() {
            $query = "SELECT cpf FROM historico GROUP BY cpf";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getItemHistorico(){
            $query = "SELECT * FROM historico LEFT JOIN usuarios ON historico.idUser = usuarios.idUser WHERE cpf = ? ORDER BY ultima_compra DESC";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->cpf);
            $stmt->execute();
            $produtos = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            foreach ($produtos as $key => $produto){
                 $produtos[$key]['produtos'] = unserialize($produtos[$key]['produtos']);
            }
            

            return $produtos;
        }

        public function getItemHistoricoToday(){
            $query = "SELECT * FROM historico WHERE cpf = ? AND ultima_compra like ? ORDER BY ultima_compra DESC";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->cpf);
            $stmt->bindValue(2, $this->date.'%');
            $stmt->execute();
            $produtos = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            foreach ($produtos as $key => $produto){
                 $produtos[$key]['produtos'] = unserialize($produtos[$key]['produtos']);
            }
            

            return $produtos;
        }

        

    }
        

?>

