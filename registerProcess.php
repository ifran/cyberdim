<?php
    include('Application/core/Inc.php');
    
    /***************
    * Operadora 
    ***************/
    if (isset($_POST['material']) || isset($_GET['bDel']))
    {
        $oCon = new Database();
        
        if (isset($_POST['material']))
        {
            if ($_POST['material'] == 'Cadastrar')
            {
                $sSql = 'INSERT INTO material  (
                                      material_nome
                                    , material_altura
                                    , material_largura
                                    , material_valor
                )
                VALUES 
                (
                    "' . $_POST['sMaterialNome'] . '"
                    , "' . $_POST['sMaterialAltura'] . '"
                    , "' . $_POST['sMaterialLargura'] . '"
                    , "' . $_POST['sMaterialValor'] . '"
                )';

                echo $sSql;

                $oCon->insert($sSql);
            }
            else if ($_POST['material'] == 'Atualizar') 
            {
                $sSql = 'UPDATE material 
                        SET  material_nome = "' . $_POST['sMaterialNome'] . '"
                            , material_altura = "' . $_POST['sMaterialAltura'] . '"
                            , material_largura = "' . $_POST['sMaterialLargura'] . '"
                            , material_valor = "' . $_POST['sMaterialValor'] . '"
                        WHERE material_id = "' . $_POST['iId'] . '"
                    ';

                $oCon->executeQuery($sSql);
            }
        }
        else if ($_GET['bDel'] == 1 && $_GET['iMaterialId'] != '')
        {
            $sSql = 'DELETE FROM material WHERE material_id = "' . $_GET['iMaterialId'] . '"';
            $oCon->executeQuery($sSql);
        }
        
        headerLocation('Material');
    }
?>