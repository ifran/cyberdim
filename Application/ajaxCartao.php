<?php
    include('core/Inc.php');

    $iCartaoCont = $_GET['iCartaoCont'];

    $oCartao = new Database();
    $aCartao = $oCartao->select('SELECT * FROM cartao c INNER JOIN operadora p ON (p.operadora_id = c.operadora_id) ORDER BY operadora_nome');
    
    $sSelectCartao = '<option value="0">-- Selecione --</option>';
    foreach ($aCartao as $oItem)
    {
        $sSelectCartao .= '<option value="' . $oItem['cartao_id'] . '">' . $oItem['operadora_nome'] . ' | ' . $oItem['cartao_numero'] . ' | R$ ' . $oItem['cartao_saldo'] . '</option>';
    }
?>

<div id="iCartaoDiv<?=$iCartaoCont?>">
    <div class="float-right" style="margin-bottom:5px"> 
        <button class="btn btn-secondary btn-sm" type="button" onclick="removerFuncionarioCartao(<?=$iCartaoCont?>);" >Remover</button>
    </div>

    <div class="form-group">
        <label>Cart&atilde;o</label>
        <select class="form-control" name="iCartaoId<?=$iCartaoCont?>">
            <?=$sSelectCartao?>
        </select>
    </div>
    
    <hr style="border-top: 2px solid black;">
</div>