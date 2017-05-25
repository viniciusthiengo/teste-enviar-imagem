<?php
/*
 * Nesta classe estamos utilizando a API PDO para trabalho com o banco de dados.
 * No PHP é mais simples utilizar a API PDO, pois não precisamos limpar os dados
 * de entrada, a própria API fa isso para nós, evitando principalmente o
 * SQL-Injection.
 * */
class Database {
	private $pdo;


	public function __destruct()
	{
		$this->pdo = null;
	}


	public function getConn()
	{
		if( is_object($this->pdo) ){
			return($this->pdo);
		}

		try{
			$this->pdo = new PDO(
				sprintf(
					'%s:host=%s;dbname=%s;port=%s;charset=%s',
					'mysql', // tipo banco de dados
					'127.0.0.1', // host, coloque o seu aqui. 127.0.0.1 é equivalente a localhost
					'galeria_imagem', // nome do banco de dados
					'8889', // porta de conexão
					'utf8'), // tipo da codificação dos dados do banco, quase sempre é UTF-8
				'root',
				'root' );
		}
		catch(PDOException $e){}
		return($this->pdo);
	}
}
