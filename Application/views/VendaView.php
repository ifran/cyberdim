<?php 
    $oCon = new Database();

    $aMaterial = $oCon->select('SELECT * FROM material');
    $sOption = '<option value="">-- Selecione --</option>';
    foreach ($aMaterial as $oItem)
    {
        $sOption .= '<option value="' . $oItem['material_id'] . '">' . $oItem['material_nome'] . '</option>';
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
                                        <label>Material</label>
                                        <select name="iMaterialId" id="iMaterialId" class="form-control">
                                            <?=$sOption?>
                                        </select>
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