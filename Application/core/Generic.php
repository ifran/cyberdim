<?php
    function validateSession($sPage = null)
    {
        if (!isset($_SESSION['bLogin']) AND $sPage != 'Login' AND $sPage != 'Register')
        {
            header('location:Login');
        }
    }

    function pre($sObj) 
    {
        $sRet  = '<pre>';
        $sRet .= print_r($sObj, true);
        $sRet .= '</pre>';
        echo $sRet;
    }

    function headerLocation($sPage)
    {
        echo "<script>window.location.href = '" . HOST_PUBLIC . $sPage . "' </script>";
        die();
    }
    
    function alert($sMsg)
    {
        echo "<script>alert('" . $sMsg . "');</script>";
    }
    
    function fmt2Show($fFloat, $iPrecision = 2) 
    {
        if (empty($fFloat)) {
            $fFloat = 0.0;
        }

        $sFormFloat = number_format($fFloat, $iPrecision, ',', '.');

        return $sFormFloat;
    }

    function fmt2Calc($sFloat) 
    {
        $fFloat = str_replace('.', '', $sFloat);
        $fFloat = str_replace(',', '.', $fFloat);
    
        return (float) $fFloat;
    }  
?>