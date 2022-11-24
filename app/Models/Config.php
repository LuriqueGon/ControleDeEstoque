<?php 

    namespace App\Models;
    use MF\Model\Model;

    class Config extends Model{
        protected $meta;
        protected $base;
        
        public function setMeta(){
            $query  = "UPDATE configs SET meta = ? ";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1,$this->__get('meta'));
            $stmt->execute();
        }
        public function getMeta(){
            $query  = "SELECT meta FROM configs ";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC)['meta'];
        }
        public function setBase(){
            $query  = "UPDATE configs SET base = ? ";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1,$this->__get('base'));
            $stmt->execute();
        }
        public function getBase(){
            $query  = "SELECT base FROM configs ";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC)['base'];
        }
        
        
    }

?>