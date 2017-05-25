<?php

// Camada de dados do projeto.
class CgdAdmin
{
    public function saveImagem( Imagem $imagem )
    {
        $query = <<<SQL
            INSERT INTO
                gi_imagem(
                  name,
                  type,
                  size
                )
              VALUES(
                :name,
                :type,
                :size
              )
SQL;
        $database = (new Database($this))->getConn();
        $statement = $database->prepare($query);
        $statement->bindValue(':name', $imagem->name, PDO::PARAM_STR);
        $statement->bindValue(':type', $imagem->type, PDO::PARAM_STR);
        $statement->bindValue(':size', $imagem->size, PDO::PARAM_INT);

        $statement->execute();
        $database = null;
        return( $statement->rowCount() > 0 );
    }


    public function getImagens()
    {
        $query = <<<SQL
            SELECT
                name,
                size
              FROM
                gi_imagem
SQL;
        $database = (new Database($this))->getConn();
        $statement = $database->prepare($query);
        $statement->execute();
        $database = null;

        $imagens = array();
        while( ($imagem = $statement->fetchObject('Imagem')) !== false ){
            $imagens[] = $imagem;
        }

        return( $imagens );
    }
}
