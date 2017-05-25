<?php

class Imagem
{
    const DIR_IMAGENS = '../img/';

    public $tmpName;
    public $name;
    public $type;
    public $size;


    /*
     * Encapsulando no construtor todo o código de obtenção
     * de imagem no superglobal $_FILES.
     * */
    public function getImagem_FILES()
    {
        $imagem = $_FILES['imagem'];

        $this->tmpName = $imagem['tmp_name'];
        $this->name = $this->novoNome( $imagem['name'] );
        $this->type = $imagem['type'];
        $this->size = $imagem['size'];
    }


    /*
     * Com esse método estamos evitando que as imagens tenham
     * o mesmo nome e acabem por sobrescrever uma a outra.
     * Mas como estratégia de SEO, para ajudar nas buscas do
     * Google, estamos mantendo o nome original como sufixo
     * do nome completo da imagem.
     * */
    private function novoNome( $nomeOriginal )
    {
        $arrayNome = explode('.', $nomeOriginal);
        $sufix = $arrayNome[ count($arrayNome) - 1 ]; // Guardando o tipo da imagem (jpg, jpeg, png ou gif) antes de remove-lo do array
        array_pop( $arrayNome ); // Removendo a última posição do array, aqui será o tipo da imagem (jpg, jpeg, png ou gif)
        $novoNome = implode('.', $arrayNome);
        $novoNome = $novoNome . '_' . sha1( microtime(true) );
        $novoNome = $novoNome . '.' . $sufix;
        return $novoNome;
    }


    /*
     * Com esse método conseguimos salvar a imagem no diretório
     * que quisermos, aqui o dir /img, e então podemos informar ao
     * restante do algoritmo, na classe AplAdmin, se deu tudo
     * certo e, caso sim, continuar para salvar os dados da imagem
     * também no banco de dados. Note que somente os dados String
     * e Inteiro, pois o binário da imagem já está no diretório,
     * não utilizaremos BLOB aqui.
     * */
    public function saveImagemDir()
    {
        $status = false;

        if( substr_count($this->type, 'image') > 0 ){
            $status = move_uploaded_file(
                $this->tmpName,
                self::DIR_IMAGENS . $this->name );
        }

        return $status;
    }


    /*
     * Quando formos apresentar a imagem também apresentaremos o
     * tamanho dela em Kbytes, esse método faz isso para nós,
     * formata o dado size corretamente.
     * */
    public function size()
    {
        $kb = sprintf('%.2f', $this->size / 1024);
        return $kb.' kb';
    }
}