<?php
    $content = file_get_contents('https://www.vtsolucoes.com.br/blog/');

    preg_match_all('/<div class="blogPost">(.*?)<div class="blocoImg">(.*?)<\/div><\/div>/s', $content, $matches);

    $oReturn = $matches[0];

    $sBlog = $oReturn[0];

    $bTexto = false;
    $sTexto = '';
    for ($i = 0; $i < strlen($sBlog); $i++)
    {
        if (isset($sBlog[$i+8])) {
        $sLeiaMais = ($sBlog[$i] . $sBlog[$i+1] . $sBlog[$i+2] . $sBlog[$i+3] . $sBlog[$i+4]. $sBlog[$i+5]. $sBlog[$i+6]. $sBlog[$i+7]. $sBlog[$i+8]);
        }

        if ($sLeiaMais == 'Leia mais') {
        $bTexto = true;
        }

        if ($bTexto) {
        continue;
        }

        $sTexto .= $sBlog[$i];
    }
?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="form-group">
                <form action="#" method="post">
                    <?=$sTexto?>
                </form>
            </div>
        </div>
    </div>
</section>