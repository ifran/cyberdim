<?php
    include('Application/core/Inc.php');
    
    /***************
    * Operadora 
    ***************/
    if (isset($_POST['operadora']) || isset($_GET['bDel']) && isset($_GET['iOperadoraId']))
    {
        $oOperadora = new Database();
        
        if (isset($_POST['operadora']))
        {
            if ($_POST['operadora'] == 'Cadastrar')
            {
                $sSql = 'INSERT INTO operadora  (
                    operadora_nome
                    , operadora_cnpj 
                )
                VALUES 
                (    
                    "' . $_POST['sOperadoraNome'] . '"
                    , "' . $_POST['sOperadoraCnpj'] . '"
                )';

                $oOperadora->insert($sSql);
            }
            else if ($_POST['operadora'] == 'Atualizar') 
            {
                $sSql = 'UPDATE operadora 
                        SET   operadora_nome = "' . $_POST['sOperadoraNome'] . '"
                            , operadora_cnpj = "' . $_POST['sOperadoraCnpj'] . '"
                        WHERE operadora_id = "' . $_POST['iOperadoraId'] . '"
                    ';

                $oOperadora->executeQuery($sSql);
            }
        }
        else if ($_GET['bDel'] == 1 && $_GET['iOperadoraId'] != '')
        {
            $iOperadoraId = $_GET['iOperadoraId'];
            $sSql = 'SELECT * FROM cartao WHERE operadora_id = ' . $iOperadoraId;
            $aOperadora = $oOperadora->select($sSql);
            
            $aOperadoraId =  array();
            foreach ($aOperadora as $oItem) 
            {
                $aOperadoraId[] = $oItem['cartao_id'];
            }

            $sIds =  '(' . implode(',', $aOperadoraId) . ')';
            
            $sSql = 'DELETE FROM funcionario_cartao WHERE cartao_id IN ' . $sIds;
            $oOperadora->executeQuery($sSql);

            $sSql = 'DELETE FROM cartao WHERE cartao_id IN ' . $sIds;
            $oOperadora->executeQuery($sSql);

            $sSql = 'DELETE FROM operadora WHERE operadora_id = "' . $_GET['iOperadoraId'] . '"';
            $oOperadora->executeQuery($sSql);
        }
        
        headerLocation('Operadora');
    }
    /***************
    * Cartao
    ***************/
    else if (isset($_POST['cartao']) || isset($_GET['bDel']) && isset($_GET['iCartaoId']))
    {
        $oProduto = new Database();
        
        if (isset($_POST['cartao']))
        {
            if ($_POST['cartao'] == 'Cadastrar')
            {
                $sSql = 'INSERT INTO cartao  (
                        operadora_id 
                    , cartao_numero
                    , cartao_saldo
                )
                VALUES 
                (    
                    "' . $_POST['iOperadoraId'] . '"
                    , "' . $_POST['sCartaoNumero'] . '"
                    , "' . $_POST['sCartaoSaldo'] . '"
                )';
                
                $oProduto->insert($sSql);
            }
            else if ($_POST['cartao'] == 'Atualizar')
            {
                $iCartaoId = $_POST['iCartaoId'];
                
                $sSql = 'UPDATE cartao
                        SET   operadora_id = "' . $_POST['iOperadoraId'] . '"
                            , cartao_numero = "' . $_POST['sCartaoNumero'] . '"
                            , cartao_saldo = "' . $_POST['sCartaoSaldo'] . '"
                        WHERE cartao_id = "' . $iCartaoId . '"
                    ';

                $oProduto->executeQuery($sSql);
            }
        }
        else if ($_GET['bDel'] == 1 && $_GET['iCartaoId'] != '')
        {
            $sSql = 'DELETE FROM funcionario_cartao WHERE cartao_id = ' . $_GET['iCartaoId'];
            $oOperadora->executeQuery($sSql);

            $sSql = 'DELETE FROM cartao WHERE cartao_id = "' . $_GET['iCartaoId'] . '"';
            $oProduto->executeQuery($sSql);
        }

        headerLocation('Cartao');
    }
    /***************
    * Funcionario
    ***************/
    else if (isset($_POST['funcionario']) || isset($_GET['bDel']) && isset($_GET['iFuncionarioId']))
    {
        $oFuncionario = new Database();
        
        if (isset($_POST['funcionario']))
        {
            if ($_POST['funcionario'] == 'Cadastrar')
            {
                $sSql = 'INSERT INTO funcionario  (
                     funcionario_nome
                    , funcionario_documento
                )
                VALUES 
                (    
                     "' . $_POST['sFuncionarioNome'] . '"
                    , "' . $_POST['sFuncionarioDocumento'] . '"
                    )';
                
                $iFuncionarioId = $oFuncionario->insert($sSql);
            }
            else if ($_POST['funcionario'] == 'Atualizar')
            {
                $iFuncionarioId = $_POST['iFuncionarioId'];
                
                $sSql = 'UPDATE funcionario
                        SET   funcionario_nome = "' . $_POST['sFuncionarioNome'] . '"
                            , funcionario_documento = "' . $_POST['sFuncionarioDocumento'] . '"
                        WHERE funcionario_id = "' . $iFuncionarioId . '"
                    ';

                $oFuncionario->executeQuery($sSql);
            }
        }
        else if ($_GET['bDel'] == 1 && $_GET['iFuncionarioId'] != '')
        {
            $sSql = 'DELETE FROM funcionario_cartao WHERE funcionario_id = "' . $_GET['iFuncionarioId'] . '"';
            $oFuncionario->executeQuery($sSql);
            
            $sSql = 'DELETE FROM funcionario WHERE funcionario_id = "' . $_GET['iFuncionarioId'] . '"';
            $oFuncionario->executeQuery($sSql);
        }

        /*********************************
            Linkar Cartao com Funcionario 
        *********************************/
        if ($iFuncionarioId != '') 
        {
            $oFuncionario->executeQuery('DELETE FROM funcionario_cartao WHERE funcionario_id = ' . $iFuncionarioId);

            $iCartaoTotal = $_POST['iCartaoCont'];

            for ($i = 1; $i <= $iCartaoTotal; $i++)
            {
                if (isset($_POST['iCartaoId' . $i]) && $_POST['iCartaoId' . $i] <> '0')
                {
                    $sSql = 'INSERT INTO funcionario_cartao (
                              funcionario_id
                            , cartao_id
                    )
                    VALUES 
                    (
                         ' . $iFuncionarioId . '
                        , ' . $_POST['iCartaoId' . $i] . '
                    )';

                    echo $sSql . '<br>';
                    
                    $oFuncionario->executeQuery($sSql);

                }
            }
        }

        headerLocation('Funcionario');
    }
?>