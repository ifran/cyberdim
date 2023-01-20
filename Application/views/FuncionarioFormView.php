<?php 
    $oFuncionario = new Database();
    
    $sBtnSubmit = 'Cadastrar';
    $sFuncionarioNome = null;
    $sFuncionarioDocumento = null;
    
    $sInputHid = null;
    $iFuncionarioId = null;
    $aFuncionarioCartao = array();

    if (isset($_GET['iFuncionarioId']) && $_GET['iFuncionarioId'] != '')
    {
        $aFuncionario = $oFuncionario->select('SELECT * FROM funcionario WHERE funcionario_id = ' . $_GET['iFuncionarioId']);
        $aFuncionario = $aFuncionario[0];        

        $sFuncionarioNome = $aFuncionario['funcionario_nome'];
        $sFuncionarioDocumento = $aFuncionario['funcionario_documento'];
        
        $iFuncionarioId = $aFuncionario['funcionario_id'];
        $sInputHid = '<input type="hidden" name="iFuncionarioId" value="' . $iFuncionarioId . '">';
        $sBtnSubmit = 'Atualizar';

        $aFuncionarioCartao = $oFuncionario->select('SELECT * 
                                                    FROM funcionario_cartao fc 
                                                    INNER JOIN cartao c ON (c.cartao_id = fc.cartao_id)
                                                    INNER JOIN operadora o ON (o.operadora_id = c.operadora_id)
                                                    WHERE fc.funcionario_id = ' . $iFuncionarioId . '
                                                    GROUP BY fc.cartao_id
        ');
    }

    /*************************************
    * Buscando os cartoes do funcinoario
    *************************************/
    $iCartaoCont = 0;
    $iCartaoTotal = 0;
    
    $sCartoes = '';
    foreach ($aFuncionarioCartao as $oCartoes)
    {
        $iCartaoCont++;
        $iCartaoTotal++;
        $aCartao = $oFuncionario->select('SELECT * 
                                        FROM cartao c 
                                        INNER JOIN operadora p ON (p.operadora_id = c.operadora_id) ORDER BY operadora_nome');
        
        $sSelectCartao = '<option value="0">-- Selecione --</option>';
        foreach ($aCartao as $oItem)
        {
            $sSelected = ($oItem['cartao_id'] == $oCartoes['cartao_id'] ? 'selected' : '');
            $sSelectCartao .= '<option ' . $sSelected . ' value="' . $oItem['cartao_id'] . '">' . $oItem['operadora_nome'] . ' | ' . $oItem['cartao_numero'] . ' | R$ ' . $oItem['cartao_saldo'] . '</option>';
        }

        $sCartoes .= '
        <div id="iCartaoDiv' . $iCartaoCont . '">
            <div class="float-right" style="margin-bottom:5px"> 
                <button class="btn btn-secondary btn-sm" type="button" onclick="removerFuncionarioCartao(' . $iCartaoCont . ');" >Remover</button>
            </div>

            <div class="form-group">
                <label>Cart&atilde;o</label>
                <select class="form-control" name="iCartaoId' . $iCartaoCont . '">
                    ' . $sSelectCartao . '
                </select>
            </div>

            <hr style="border-top: 2px solid black;">
        </div>';
    }
?>

<section class="content">
    <div class="container-fluid">
        
		<!-- MOSTRANDO ESTOQUE ATUAL -->
		<div class="card card-default">
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" action="<?=HOST_PUBLIC?>registerProcess.php">
                            <div class="card card-primary">
                            
                                <div class="card-body">
                                    <!-- Campos -->
                                    <div class="form-group">
                                        <label>Nome</label>
                                        <input type="text" class="form-control" value="<?=$sFuncionarioNome?>" name="sFuncionarioNome" placeholder="Nome">
                                    </div>

                                    <div class="form-group">
                                        <label>Documento</label>
                                        <input type="text" class="form-control" value="<?=$sFuncionarioDocumento?>" name="sFuncionarioDocumento" placeholder="Documento">
                                    </div>
                                    
                                </div>

                                <div class="card-footer">
                                    <?=$sInputHid?>
                                    <button class="btn btn-primary" type="button" onclick="adicionarFuncionarioCartao();" >Adicionar Cartao</button>
                                </div>

                            </div>
                            
                            <!-- CARD DOS DESCONTOS -->
                            <div class="card card-primary">

                                <div class="card-body" id="oDivCartao">
                                    <?=$sCartoes?>
                                </div>

                                <input type="hidden" name="iCartaoCont" id="iCartaoCont" value="<?=$iCartaoCont?>">
                                <input type="hidden" name="iCartaoTotal" id="iCartaoTotal" value="<?=$iCartaoTotal?>">
                            </div>

                            <div class="card-footer">
                                <?=$sInputHid?>
                                <input type="submit" class="btn btn-primary" name="funcionario" value="<?=$sBtnSubmit?>">
                            </div>
                            
                        </form>

                    </div>
                </div>
            </div>
        </div>
	</div>
</section>

<script>
    function adicionarFuncionarioCartao()
    {
        iCartaoCont = _$('iCartaoCont').value;
        iCartaoTotal = _$('iCartaoTotal').value;

        iCartaoCont++;
        iCartaoTotal++;

        _$('iCartaoCont').value = iCartaoCont;
        _$('iCartaoTotal').value = iCartaoTotal;

        sUrl = 'ajaxCartao.php?iCartaoCont=' + iCartaoCont;
        ajaxRequestAppend(sUrl, 'oDivCartao');
    }

    function removerFuncionarioCartao(iCartaoCont)
    {
        $('#iCartaoDiv' + iCartaoCont).remove();
        iCartaoTotal = _$('iCartaoTotal').value;
        iCartaoTotal--;
        _$('iCartaoTotal').value = iCartaoTotal;
    }


</script>