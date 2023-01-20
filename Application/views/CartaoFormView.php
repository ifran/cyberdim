<?php 
    $oCartao = new Database();
    
    $sBtnSubmit = 'Cadastrar';
    $sCartaoNumero = null;
    $sCartaoSaldo = null;
    $iOperadoraId = 0;
    $sInputHid = null;
    
    if (isset($_GET['iCartaoId']) && $_GET['iCartaoId'] != '') 
    {
        // Busca no banco de dados
        $aCartao = $oCartao->select('SELECT * FROM cartao WHERE cartao_id = ' . $_GET['iCartaoId']);
        $aCartao = $aCartao[0];
        
        // Setando as variaveis
        $sCartaoNumero = $aCartao['cartao_numero'];
        $sCartaoSaldo = $aCartao['cartao_saldo'];
        $iOperadoraId = $aCartao['operadora_id'];

        // Ajuste para casos de atualizacao
        $iCartaoId = $aCartao['cartao_id'];
        $sInputHid = '<input type="hidden" name="iCartaoId" value="' . $iCartaoId . '">';
        $sBtnSubmit = 'Atualizar';
    }

    $aCartao = $oCartao->select('SELECT * FROM operadora ORDER BY operadora_nome');
    
    $sSelectOperadora = '<option value="0">-- Selecione --</option>';
    foreach ($aCartao as $oItem)
    {
        $sSelected = ($iOperadoraId == $oItem['operadora_id'] ? 'selected' : '');
        $sSelectOperadora .= '<option ' . $sSelected . ' value="' . $oItem['operadora_id'] . '">' . $oItem['operadora_nome'] . '</option>';
    }
    
?>

<section class="content">
    <div class="container-fluid">
        
		<!-- MOSTRANDO ESTOQUE ATUAL -->
		<div class="card card-default">
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            
                            <form method="post" action="<?=HOST_PUBLIC?>registerProcess.php">
                                <div class="card-body">
                                    <!-- Campos -->
                                    <div class="form-group">
                                        <label>Operadora</label>
                                        <select class="form-control" name="iOperadoraId">
                                            <?=$sSelectOperadora?>
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label>N&uacute;mero</label>
                                        <input type="text" class="form-control" value="<?=$sCartaoNumero?>" name="sCartaoNumero" placeholder="N&uacute;mero" data-inputmask='"mask": "9999 9999 9999 9999"' data-mask>
                                    </div>

                                    <div class="form-group">
                                        <label>Saldo</label>
                                        <input type="text" class="form-control" value="<?=$sCartaoSaldo?>" name="sCartaoSaldo" placeholder="Saldo">
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <?=$sInputHid?>
                                    <input type="submit" class="btn btn-primary" name="cartao" value="<?=$sBtnSubmit?>">
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</section>