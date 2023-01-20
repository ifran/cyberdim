<?php
    class Material extends Database
    {
        public function buscarFornecedores()
        {
            $sSql = 'SELECT * FROM fornecedor ORDER BY fornecedor_name';
            
            $oReturn = parent::select($sSql);

            return $oReturn;
        }
    }
?>