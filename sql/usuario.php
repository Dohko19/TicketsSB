<?php
include("acciones.php");
class Usuario{
	private $id=null;
	private $nombre=null;
	public $username=null;
	private $pwd=null;
	protected $mail=null;
	public $estatus=null;
	private $db = null;
	public $error = "algo salio mal";

	function __construct($id=null){
		include ("conexion.php");
		$this->db = new Database($host,$username,$password,$db);

		if($id){
			$this->create($id);
		}
	}
private function create($id){
	$sql = $this->db->conn->query("SELECT login FROM usuarios WHERE id_usuario = $id");
	if($sql)
	{
		if($sql ->num_rows>0)
		{
			while ($rows = $sql ->fetch_assoc()) {
				$this->createSession($id,$rows["login"]);
			}
			return true;
		}
		else{
			$this->error.="no hay datos";
		}

	}
	else{
		$this->error.="Hola ;)";
	}

}
	public function login($data){
		$sql = "SELECT id_usuario, password FROM usuarios WHERE login = '".$data["username"]."'";
		$dato = $this->db->conn->query($sql);
		if($dato)
		{
			if($dato->num_rows)
			{
				while ($rows = $dato->fetch_assoc()) 
				{
					$user = $rows;
		
				}
			}
		}
		if(isset($user)){

		if($user)
		{
			if($this->validatePassword($data["pwd"],$user["password"]))
			{
				if($this->create($user["id_usuario"])){
					//var_dump($user);
				return true;
				}
			}
		}
		}
		echo "<script>alert('Contraseña y/o usuario incorrectos')</script>";
		return false;

	}

	private function validatePassword($pwd,$pw)
	{	
		$pwd = md5($pwd);
		echo "<br>".$pwd;
		echo "<br>".$pw;
		if ($pwd == $pw) {
		return $pwd;
		}else
		{
			return false;
		}
	}

	private function makePwd($pwd){
		$pwd = md5($pwd);
		return $pwd;
	}

	public function add($data){
	$sql = "INSERT INTO usuarios(nombre, apaterno, amaterno, login, password)".
		"VALUES ('".$data["nombre"]."','".$data["a_paterno"]."','".$data["a_materno"]."','".$data["email"]."','".$this->makePwd($data["password"])."')";
		echo "<br>".$sql;
		$query = $this->db->conn->query($sql);
		
			if($this->db->conn->query($sql)){
				if($this->create($this->db->conn->insert_id)){
					$this->error.="exito";
				return true;
				}
				else
					$this->error.="fallo";
				
			}
			else{
				$this->error.="algo fallo";
			}
			return false;
	}

	private function createSession($id, $username){
		//session_start();
		$sql = "SELECT * FROM usuarios WHERE login = '$username' and id_usuario='$id'";
		
		$dato = $this->db->conn->query($sql);
		$admin = $dato->fetch_assoc();

		$_SESSION['nombre'] = $admin['nombre']." ".$admin['apaterno'];
		$_SESSION['id_puesto'] = $admin['id_puesto']; 
		$_SESSION["id_usuario"] = $id;
		$_SESSION["username"] = $username;
		$_SESSION["token"] = base64_encode($id.strtotime("now").rand(0,100).$username);
	}
	public function killSession(){
		session_start();
		session_unset();
		session_destroy();
	}


}
?>