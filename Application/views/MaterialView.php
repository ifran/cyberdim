<?php 
    $oMaterial = new Database();
    $aMaterial = $oMaterial->select('SELECT * 
                                    FROM material c 
                                    ORDER BY material_nome');

    $sMaterial = '';
    foreach ($aMaterial as $oItem) 
    {
        $sMaterial .= '<tr>
                            <td>' . $oItem['material_nome'] . '</td>
                            <td>' . $oItem['material_valor'] . '</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                <a href="MaterialForm/' . $oItem['material_id'] . '" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                <a href="registerProcess.php?bDel=1&iMaterialId=' . $oItem['material_id'] . '" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>';
    }
?>

<section class="content">
    <div class="container-fluid">

		<!-- MOSTRANDO ESTOQUE ATUAL -->
		<div class="card card-default">
            <div class="card-body ">
                <div class="callout callout-info">
                    <a href="MaterialForm/"><button class="col-3 form-control"><h5><i class="i-plus"></i>Adicionar Material</h5></button></a>
                </div>

                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Material</th>
                                    <th>Valor</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?=$sMaterial?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
	</div>
</section>