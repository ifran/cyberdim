<?php 
    $oCartao = new Database();
    $aCartao = $oCartao->select('SELECT * FROM cartao c INNER JOIN operadora p ON (p.operadora_id = c.operadora_id) ORDER BY operadora_nome');

    $sCartao = '';
    foreach ($aCartao as $oItem) 
    {
        $sCartao .= '<tr>
                            <td>' . $oItem['operadora_nome'] . '</td>
                            <td>' . $oItem['cartao_numero'] . '</td>
                            <td>' . $oItem['cartao_saldo'] . '</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                <a href="CartaoForm/' . $oItem['cartao_id'] . '" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                <a href="registerProcess.php?bDel=1&iCartaoId=' . $oItem['cartao_id'] . '" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
                    <a href="CartaoForm/"><button class="col-3 form-control"><h5><i class="i-plus"></i>Adicionar Cart&atilde;o</h5></button></a>
                </div>

                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Operadora</th>
                                    <th>N&uacute;mero</th>
                                    <th>Saldo</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?=$sCartao?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
	</div>
</section>