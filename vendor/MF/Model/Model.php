<?php 

    namespace MF\Model;

    abstract class Model{
        
        protected $db;

        public function __construct(\PDO $db){
            $this->db = $db;
        }

        public function __get($attr){
            return $this->$attr;
        }

        public function __set($attr, $value){
            $this->$attr = $value;
            return $this;
        }
        
        public function formataCPF($cpf){
            
            $cpf= preg_replace("/[^0-9]/", "", $cpf);
            
            $bloco_1 = substr($cpf,0,3);
            $bloco_2 = substr($cpf,3,3);
            $bloco_3 = substr($cpf,6,3);
            $dig_verificador = substr($cpf,-2);
            $cpf_formatado = $bloco_1.".".$bloco_2.".".$bloco_3."-".$dig_verificador;
        
                
            return $cpf_formatado;
        }
    }


?>