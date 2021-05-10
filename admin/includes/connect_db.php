<?php  
error_reporting(1);
class Database
{

    // used to connect to the default database
    private $host = "localhost";
    private $db_name = "rampup";
    private $username = "root";
    private $password = "";
    public $db_conn;

    // get the database default connection
    public function getConnection()
    {
        $this->db_conn = null;
        try {
            $this->db_conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        } catch (PDOException $exception) {
            echo "Database Connection Error: " . $exception->getMessage();
        }
        return $this->db_conn;
    } 
}


    

    define(IMAGE_URL,"admin/images/");
	$access_key = 'befa6045ae310149d355fbe47da3413a';


?>