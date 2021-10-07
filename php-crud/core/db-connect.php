<?php

/*ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);*/
	class DB {
		private $data = array();
		//variavel da classe Base
		protected $pdo = null;

		public function __set($name, $value){
			$this->data[$name] = $value;
		}

		public function __get($name){
			if (array_key_exists($name, $this->data)) {
				return $this->data[$name];
			}

			$trace = debug_backtrace();
			trigger_error(
				'Undefined property via __get(): ' . $name .
				' in ' . $trace[0]['file'] .
				' on line ' . $trace[0]['line'],
				E_USER_NOTICE);
			return null;
		}
		//método que retorna a variável $pdo
		public function getPdo() {
			return $this->pdo;
		}

		//método construtor da classe
		function __construct($pdo = null) {
			$this->pdo = $pdo;
			if ($this->pdo == null)
				$this->conectar();
		}

		//método que conecta com o banco de dados
		public function conectar() {
			$_servidor ="localhost";// $_SERVER['SERVER_NAME'];
			if ($_servidor == 'localhost'){
				$local = "localhost";
				$user = "root";
				$pass = "Ap****##";
				$basename = "crud";
			}else{
				$local = "seu-servidor-web";
				$user = "user-web";
				$pass = "pass-web";
				$basename = "base-web";
			}
			try {
				$this->pdo = new PDO("mysql:host=$local;dbname=$basename",
								"$user",
								"$pass",
								array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			} catch (PDOException $e) {
				print "Error!: " . $e->getMessage() . "<br/>";
				die();
			}
		}

		//método que desconecta
		public function desconectar() {
			$this->pdo = null;
		}

		public function select($sql){
		$stmt = $this->pdo->prepare("SELECT * FROM {$sql}");
			$stmt->execute();
			return $stmt->fetchAll();
		}
		public function query($sql){
			$stmt = $this->pdo->prepare($sql);
				$stmt->execute();
				return $stmt->fetchAll();
			}
		public function findBy($tabela,$value=null,$param=null){
			if($param !=null)
			{$stmt = $this->pdo->prepare("SELECT * FROM {$tabela} WHERE {$param}='$value'");}

		else	{$stmt = $this->pdo->prepare("SELECT * FROM {$tabela} WHERE id='$value'");}
				$stmt->execute();
				return $stmt->fetch(PDO::FETCH_ASSOC);
			}
		public function select_filter($sql,$where){
			$stmt = $this->pdo->prepare($sql);
			//$stmt->bindParam(':idcategoria',;
			$stmt->execute($where);
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		public function btrasation(){
			$this->pdo->setAttribute(PDO::ATTR_AUTOCOMMIT,0);
			$this->pdo->beginTransaction();
			
		}
		public function comit(){
			$this->pdo->commit();
			
		}
		public function rollback(){
			$stmt = $this->pdo->rollBack();
			
		}

		public function selectObj($sql){
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute();
			$this->total = count($stmt);
			$arr = array();
			// percorre o resultado inserindo os dados no array
			while ($obj = $stmt->fetchObject()) {
				$arr[] = $obj;
			}
			return $arr;
		}

		public function delete( $tabela,$param, $where ){
			$stmt = $this->pdo->prepare( "DELETE FROM {$tabela} WHERE $param=:$param" );
			$stmt->execute($where);
			//return $stmt->fetchAll(PDO::FETCH_ASSOC);
			return "Eliminado com sucesso!";
		}

		public function insert( array $dados, $tabela ){
			$campos  = implode(", ", array_keys($dados) );
			$valores = "'" . implode( "', '", array_values($dados) ) . "'";
			
			$stmt = $this->pdo->prepare( "INSERT INTO {$tabela} ({$campos}) VALUES ({$valores})" );
			
		
			if($stmt->execute()){
				$this->erro= $this->pdo->lastInsertId();
		//		return true;
	
		//$this->pdo->setAttribute(PDO::ATTR_AUTOCOMMIT,1);
		
			}else{
			$this->erro = "<br/>Erro ao Cadastrar {$tabela}!!!";
				//echo "INSERT INTO {$tabela} ({$campos}) VALUES ({$valores})";
			
				//s$this->pdo->setAttribute(PDO::ATTR_AUTOCOMMIT,1);
				return 	$this->erro ;
			}
      return 	$this->erro ;
		}

		public function update( array $dados, $tabela, $param,$array ){
			//$this->pdo->setAttribute(PDO::ATTR_AUTOCOMMIT,);
			 
			foreach( $dados as $indice => $valor ){
				$campos[] = "{$indice} = '{$valor}'";
			}

			$campos  = implode(', ', $campos);
			$stmt = $this->pdo->prepare( "UPDATE {$tabela} SET {$campos} WHERE $param=:$param" );
			if($stmt->execute($array)){
				//echo "UPDATE {$tabela} SET {$campos} WHERE {$where} <br/><hr/>";
				return true;
			}else{
				$this->erro = "<br/>Erro ao atualizar {$tabela}!!!";
				//echo "UPDATE {$tabela} SET {$campos} WHERE {$where}";
				return false;
			}
		}

		/* função para salvar o(s) erro(s), caso haja */
		function SalvarErro($erro) {
			/* se não houver erros retornamos */
			if (error_reporting() == 0)
				return;
			/* queremos que não passe os erros na tela, nós trataremos eles do nosso modo */
			/* setamos os métodos de exibição de erros */
			$exec = func_get_arg(0);
			$errc = $exec->getCode();
			$errm = $exec->getMessage();
			$errf = $exec->getFile();
			$errl = $exec->getLine();
			/* definimos o nome do erro */
			$errn = 'CAUGHT EXCEPTION';
			/* preparamos o erro para salvar no txt */
			$strError = 'erro: ' . $errn . ' no arquivo ' . $errf . ' na linha(' . $errl . ') com o IP(' . $_SERVER['REMOTE_ADDR'] . ')';
			$strError .= ' na data ' . date('d/m/y H:i:s') . "\n";
			/* abrimos, gravamos os erros e fechamos o txt */
			$arquivo = fopen('errosGiga.txt', 'a');
			fwrite($arquivo, $strError);
			fclose($arquivo);
		}


function login($username, $password) {

	$erro['err']=0;
	$erro['id']=0;

    try{
		
        $stmt =  $this->pdo->prepare("SELECT * FROM `users` WHERE user_name=:user or user_email=:user");
        $stmt->bindParam(':user', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }catch(PDOException $exception){ 
       return 2;
    }


    if ($stmt->rowCount() > 0) {
       if($this->checkIfLockedOut($result['user_id'],$this->pdo)>=5){
		
	
		$erro['err']=5;
		$erro['id']=$result['user_id'];
		  return $erro; //bloquado
	 
         } else {
			
			  $hash=$result['user_password'];
    
		if ($password==$hash) {
										 
			 $user_browser = $_SERVER['HTTP_USER_AGENT'];
			 if($result['estado']==0){
				$erro['err']=5; 
				return $erro;
			 }
			else{ $_SESSION['userId']=$result['user_id'];
				$_SESSION['username']=encrypt($result['user_name']);
				$_SESSION['login_string']=hash('sha512', $hash . $user_browser);}
	
		   //  $currTime = time();
	  
	
			 return "1";
	
		 }else{
		 
		   //  invlidLoginAttempt($result['uid'], $conn);
		   $erro['err']=2;
		   $erro['id']=$result['user_id'];
			 return $erro; //Invalid Password
			
		 }
        }
  } else {
      //  logme($result['uid'],time(),"Login","N/A","Error", "Username not found", "Not found");
	  $erro['err']=2;
		   $erro['id']=$username;
        return $erro['err']; //Username not found
    }
	}



	function checkIfLockedOut($uid) {

		try{
		
			$stmt =  $this->pdo->prepare("SELECT COUNT(iduser) FROM `erros_login` WHERE iduser=:user AND bloqueado=1");
			$stmt->bindParam(':user', $uid);
			$stmt->execute();
			$result = $stmt->fetchColumn();
		}catch(PDOException $exception){ 
		   return 2;
		}
		return $result;

			}



	function select_Normal($sql,$where) {

		try{
		
			$stmt =  $this->pdo->prepare($sql);
		//	$stmt->bindParam(':user', $uid);"SELECT COUNT(iduser) FROM `erros_login` WHERE iduser=:user AND bloqueado=1"
			$stmt->execute($where);
			$result = $stmt->fetchColumn();
		}catch(PDOException $exception){ 
		   return 2;
		}
		return $result;

			}
public function redirect($url=null){
	echo "<script>
	window.location.href='$url'
	</script>";
}
			
	}


	

?>