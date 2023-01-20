<?php
    class Database extends PDO
    {
        public function __construct() 
        {
            parent::__construct(DB_SGBD . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
        }

        public function executeQuery($sSql)
        {
            $this->exec($sSql);
        }

        public function select($sSql)
        {
            $oReturn = $this->query($sSql);
            
            $aRetorno = array();
            while ($linha = $oReturn->fetch(PDO::FETCH_ASSOC)) {
                $aRetorno[] = $linha;
            }

            return $aRetorno;
        }
        
        public function insert($sSql)
        {
            $this->executeQuery($sSql);
            $iId = $this->lastInsertId();
            return $iId;
        }
    }
?>