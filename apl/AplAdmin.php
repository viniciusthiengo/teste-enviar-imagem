<?php

/*
 * Com essa classe, a classe Imagem e a classe CgdAdmin nós
 * conseguimos manter uma boa separação de conceitos no projeto,
 * assim cada classe fica com somente uma responsabilidade,
 * seguindo as regras para se ter um código limpo. A classe
 * AplAdmin é a classe responsável por permitir o acesso a
 * camada de dados do projeto.
 * */
class AplAdmin
{
    private $cgdAdmin;


    public function __construct()
    {
        $this->cgdAdmin = new CgdAdmin();
    }


    /*
     * Solicita a persistência dos dados da imagem no
     * banco de dados somente se der tudo certo no momento
     * de salva-la primeiro no diretório de imagens do projeto.
     * */
    public function saveImagem( Imagem $imagem )
    {
        $status = $imagem->saveImagemDir();

        if( $status ){
            $status = $this->cgdAdmin->saveImagem( $imagem );
        }
        return $status;
    }


    /*
     * Obtém todas as imagens para apresenta-las na interface
     * e assim sabermos se está tudo dando certo no algoritmo.
     * */
    public function getImagens()
    {
        return $this->cgdAdmin->getImagens();
    }
}