<?php  
class contact{

	//DB Stuff
	private $conn;
	private $table = "blog_contact";

	//Blog Categories Properties
	public $n_contact_id;
	public $v_fullname;
	public $v_email;
	public $v_phone;
	public $v_message;
	public $f_contact_status;
	public $d_date_created;
	public $d_time_created;

	//Constructor with DB
	public function __construct($db){
		$this->conn = $db;
	}

	//Read multi records
	public function read(){
		$sql = "SELECT * FROM $this->table";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute();

		return $stmt;
	}

	//Read one record
	public function read_single(){
		$sql = "SELECT * FROM $this->table WHERE n_category_id = :get_id";

		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':get_id',$this->n_category_id);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		//Set Properties
		$this->n_contact_id = $row['n_contact_id'];
		$this->v_fullname = $row['v_fullname'];
		$this->v_email = $row['v_email'];
		$this->v_phone = $row['v_phone'];
		$this->f_contact_status = $row['f_contact_status'];
		$this->d_date_created = $row['d_date_created'];
		$this->d_time_created = $row['v_date_created'];
		
	}

	//Create category
	public function create(){
		//Create query
		$query = "INSERT INTO $this->table
		          SET n_contact_id = :contact_id,
		          	  v_fullname = :fullname,
		          	  v_email = :email,
		          	   v_phone = :phone,
		          	  f_contact_status = :contact_status,
		          	  d_date_created = :date_created,
		          	  d_time_created = :time_created";		
		//Prepare statement
		$stmt = $this->conn->prepare($query);

		//Clean data
		$this->n_contact_id = htmlspecialchars(strip_tags($this->n_contact_id));
		$this->v_fullname = htmlspecialchars(strip_tags($this->v_fullname));
		$this->v_email = htmlspecialchars(strip_tags($this->v_email));

		//Bind data
		$stmt->bindParam(':contact_id',$this->n_contact_id);
		$stmt->bindParam(':fullname',$this->v_fullname);
		$stmt->bindParam(':email',$this->v_email);
		$stmt->bindParam(':phone',$this->v_phone);
		$stmt->bindParam(':contact_status',$this->f_contact_status);
		$stmt->bindParam(':date_created',$this->d_date_created);
		$stmt->bindParam(':time_created',$this->d_time_created);

		//Execute query
		if($stmt->execute()){
			return true;
		}
		//Print error if something goes wrong
		printf("Error: %s. \n", $stmt->error);
		return false;
	}

	//Update category
	public function update(){
		//Create query
		$query = "UPDATE $this->table
		          SET n_contact_id = :contact_id,
		          	  v_fullname = :fullname,
		          	  v_email = :email,
		          	   v_phone = :phone,
		          	    f_contact_status = :contact_status,
		          	  d_date_created = :date_created,
		          	  d_time_created = :time_created
		          WHERE 
		          	  n_category_id = :get_id";
		//Prepare statement
		$stmt = $this->conn->prepare($query);
		//Clean data
		$this->v_category_title = htmlspecialchars(strip_tags($this->v_category_title));
		$this->v_category_meta_title = htmlspecialchars(strip_tags($this->v_category_meta_title));
		$this->v_category_path = htmlspecialchars(strip_tags($this->v_category_path));
		//Bind data
		$stmt->bindParam(':contact_id',$this->n_contact_id);
		$stmt->bindParam(':fullname',$this->v_fullname);
		$stmt->bindParam(':email',$this->v_email);
		$stmt->bindParam(':phone',$this->v_phone);
		$stmt->bindParam(':contact_status',$this->f_contact_status);
		$stmt->bindParam(':date_created',$this->d_date_created);
		$stmt->bindParam(':time_created',$this->d_time_created);
		//Execute query
		if($stmt->execute()){
			return true;
		}
		//Print error if something goes wrong
		printf("Error: %s. \n", $stmt->error);
		return false;
	}

	//Delete category
	public function delete(){

		//Create query
		$query = "DELETE FROM $this->table
		          WHERE n_contact_id = :get_id";
		
		//Prepare statement
		$stmt = $this->conn->prepare($query);

		//Clean data
		$this->n_contact_id = htmlspecialchars(strip_tags($this->n_contact_id));

		//Bind data
		$stmt->bindParam(':get_id',$this->n_contact_id);

		//Execute query
		if($stmt->execute()){
			return true;
		}

		//Print error if something goes wrong
		printf("Error: %s. \n", $stmt->error);
		return false;

	}
}
?>

