<?php 
    $oOperadora = new Database();
    
    $sBtnSubmit = 'Cadastrar';
    $sOperadoraNome = null;
    $sOperadoraCnpj = null;
    $sInputHid = null;

    if (isset($_GET['iOperadoraId']) && $_GET['iOperadoraId'] != '') 
    {
        // Busca no banco de dados
        $aOperadora = $oOperadora->select('SELECT * FROM operadora WHERE operadora_id = ' . $_GET['iOperadoraId']);
        $aOperadora = $aOperadora[0];
        
        // Setando as variaveis
        $sOperadoraNome = $aOperadora['operadora_nome'];
        $sOperadoraCnpj = $aOperadora['operadora_cnpj'];

        // Ajuste para casos de atualizacao
        $iOperadoraId = $aOperadora['operadora_id'];
        $sInputHid = '<input type="hidden" name="iOperadoraId" value="' . $iOperadoraId . '">';
        $sBtnSubmit = 'Atualizar';
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
                                        <label>Nome</label>
                                        <input type="text" class="form-control" value="<?=$sOperadoraNome?>" name="sOperadoraNome" placeholder="Nome">
                                    </div>

                                    <div class="form-group">
                                        <label>CNPJ</label>
                                        <input type="text" class="form-control" value="<?=$sOperadoraCnpj?>" name="sOperadoraCnpj" placeholder="CNPJ" data-inputmask='"mask": "99.999.999/0001-99"' data-mask>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <?=$sInputHid?>
                                    <input type="submit" class="btn btn-primary" name="operadora" value="<?=$sBtnSubmit?>">
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</section>