<?php

    namespace App\Models;
    use MF\Model\Model;


    class Loja extends Model{
        protected $info;


        public function getInfo(){
            $query = "SELECT * FROM info_loja";
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        public function formataCJNP($cnpj){
            $cnpj = preg_replace("/[^0-9]/", "", $cnpj);

            $bloco_1 = substr($cnpj,0,2);
            $bloco_2 = substr($cnpj,2,3);
            $bloco_3 = substr($cnpj,5,3);
            $bloco_4 = substr($cnpj,8,4);
            $digito_verificador = substr($cnpj,-2);
            $cnpj_formatado = $bloco_1.".".$bloco_2.".".$bloco_3."/".$bloco_4."-".$digito_verificador;

            return $cnpj_formatado;
        }

        
    }

    