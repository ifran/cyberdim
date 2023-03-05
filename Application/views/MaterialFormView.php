<?php 
    $oMaterial = new Database();
    
    $sBtnSubmit = 'Cadastrar';

    $sMaterialNome = null;
    $sMaterialAltura = null;
    $sMaterialLargura = null;
    $sMaterialValor = null;
    $sInputHid = null;
    
    if (isset($_GET['iId']) && $_GET['iId'] != '') 
    {
        // Busca no banco de dados
        $aMaterial = $oMaterial->select('SELECT * FROM material WHERE material_id = ' . $_GET['iId']);
        $aMaterial = $aMaterial[0];

        $sMaterialNome = $aMaterial['material_nome'];
        $sMaterialAltura = $aMaterial['material_altura'];
        $sMaterialLargura = $aMaterial['material_largura'];
        $sMaterialValor = $aMaterial['material_valor'];

        // Ajuste para casos de atualizacao
        $iMaterialId = $aMaterial['material_id'];
        $sInputHid = '<input type="hidden" name="iId" value="' . $iMaterialId . '">';
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
                                        <input type="text" class="form-control" value="<?=$sMaterialNome?>" name="sMaterialNome" placeholder="Nome">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Altura</label>
                                        <input type="text" class="form-control" value="<?=$sMaterialAltura?>" name="sMaterialAltura" placeholder="Altura">
                                    </div>

                                    <div class="form-group">
                                        <label>Largura</label>
                                        <input type="text" class="form-control" value="<?=$sMaterialLargura?>" name="sMaterialLargura" placeholder="Largura">
                                    </div>

                                    <div class="form-group">
                                        <label>Valor</label>
                                        <input type="text" class="form-control" value="<?=$sMaterialValor?>" name="sMaterialValor" placeholder="Valor">
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <?=$sInputHid?>
                                    <input type="submit" class="btn btn-primary" name="material" value="<?=$sBtnSubmit?>">
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</section>