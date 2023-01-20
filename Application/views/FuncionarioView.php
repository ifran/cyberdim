<?php 
    $oFuncionario = new Database();
    $aFuncionario = $oFuncionario->select('SELECT * FROM funcionario ORDER BY funcionario_nome');

    $sFuncionario = '';
    foreach ($aFuncionario as $oItem) 
    {
        $sFuncionario .= '<tr>
                            <td>' . $oItem['funcionario_nome'] . '</td>
                            <td>' . $oItem['funcionario_documento'] . '</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                <a href="FuncionarioForm/' . $oItem['funcionario_id'] . '" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                <a href="registerProcess.php?bDel=1&iFuncionarioId=' . $oItem['funcionario_id'] . '" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
                    <a href="FuncionarioForm/"><button class="col-3 form-control"><h5><i class="i-plus"></i>Adicionar Funcion&aacute;rio</h5></button></a>
                </div>

                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Documento</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?=$sFuncionario?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
	</div>
</section>