<?php
    try 
    {
        include('Application/core/Inc.php');

        if (isset($_GET['sLogout']) AND $_GET['sLogout'] == 1)
        {
            unset($_SESSION['bLogin']);
        }

        if (!empty($_POST['email']) AND !empty($_POST['password']))
        {
            $sNome = $_POST['email'];
            $sSenha = md5($_POST['password']);

            $sSql = "SELECT * FROM usuario WHERE usuario_email = '" . $sNome . "' AND usuario_senha = '" . $sSenha . "'";
            $oCon = new Database();
            $aReturn = $oCon->select($sSql);
            
            if (count($aReturn) > 0)
            {
                $aReturn = $aReturn[0];
                $_SESSION['bLogin'] = $aReturn['usuario_id'];
            }
            else 
            {
                alert('E-mail ou senha incorretos');
            }
        }
        
        headerLocation('Home');
    }
    catch(Exception $oExcepction)
    {
        echo $oExcepction;
    }
?>