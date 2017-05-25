<?php
    /*
     * O arquivo autoload.php permiti o carregamento de classes que estão
     * sendo utilizadas no código atual, isso para que nós não precisemos
     * colocar vários include() ou require() no projeto.
     * */
    include('autoload.php');


    $apl = new AplAdmin();
    $imagens = $apl->getImagens();


    $htmlImagensSalvas = '';
    foreach( $imagens as $imagem ){
        $htmlImagensSalvas .= <<<HTML
            <div style="display: inline-block; margin: 10px;">

                <img width="250" height="250" src="img/{$imagem->name}" />
                <br>
                Tamanho: {$imagem->size()}
            </div>

HTML;
    }

?>
<!doctype html>
<html lang="pt-br">
    <head>
        <title>
            Teste Envio de Imagem
        </title>
    </head>


    <body>
        <h1>
            Teste Envio de Imagem
        </h1>


        <form method="post" action="ctrl/CtrlAdmin.php" enctype="multipart/form-data">

            <label>
                Escolher imagem
            </label>
            <br>

            <input name="imagem" type="file" />
            <br><br>

            <input name="metodo" type="hidden" value="envio-imagem" />

            <button type="submit">Enviar</button>
        </form>
        <br><br>


        <?php
            echo $htmlImagensSalvas;
        ?>
    </body>
</html>