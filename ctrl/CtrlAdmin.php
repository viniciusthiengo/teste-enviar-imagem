<?php
    require_once('../autoload.php');

    /*
     * Caso queira encontrar alguns erros em sua aplicação backend,
     * descomente a linha abaixo.
     * */
    //ini_set('display_errors', 1);


    if( strcasecmp( $_POST['metodo'], 'envio-imagem' ) == 0 ){

        $imagem = new Imagem();
        $imagem->getImagem_FILES();

        $apl = new AplAdmin();
        $resultado = $apl->saveImagem( $imagem );

        /*
         * Voltando para a página que contém o formulário
         * e a lista de imagens já salvas no banco de dados
         * e em nosso diretório de imagens.
         * */
        header('Location: ../index.php');
    }



