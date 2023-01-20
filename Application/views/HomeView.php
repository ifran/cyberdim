<?php 
    $sLinks = '';
    if (isset($_POST['btnBusca']) && isset($_POST['busca']) && $_POST['btnBusca'] != '')
    {
        require 'google-search-results.php';
        require 'restclient.php';

        $client = new GoogleSearch('50fdaa34aa04f363d6e7d3c3f225ce18ae72c800a3126236f0741fc909ff413e');

        $query = ["q" => $_POST['busca']];

        $response = $client->get_json($query);

        $oValor = $response;
        if (isset($oValor->{'knowledge_graph'}))
        {
            $aValor = $oValor->{'knowledge_graph'};
            
            $sLinks .= '<div class="row">
                                <div class="form-group">
                                    <label>Info Principal</label>
                                    <div> 
                                    ' . $aValor->{'title'} . '
                                    </div>
                                    <div> 
                                    ' . $aValor->{'address'} . '
                                    </div>
                                    <div> 
                                    ' . $aValor->{'phone'} . '
                                    </div>
                                </div>
                            </div>';
        }
        
        $oValor = $response;
        $aValor = $oValor->{'organic_results'};
        foreach ($aValor as $oItem)
        {
            $sLinks .= '<div class="row">
                            <div class="form-group">
                                <label>Resultado</label>
                                <a href="' . $oItem->{'link'} . '">' . $oItem->{'title'} . '</a>
                                <div> 
                                ' . $oItem->{'snippet'} . '
                                </div> 
                            </div>
                        </div>';
        }
    }

?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="form-group">
                <form action="#" method="post">
                    <input type="text" name="busca">
                    <input type="submit" value="Buscar" name="btnBusca">
                </form>
            </div>
        </div>
        <?=$sLinks?>
    </div>
</section>