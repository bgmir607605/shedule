<?php
class connect {
	public $qr_res;//Возврат результата
	public $qr_text;//Передача строки запроса
	private $host = 'localhost';
    private $name = 'bpt';
    private $username = 'bpt';
    private $password = '0000';
	private $connect_to_db;

	
	//Конструктор класса
	public function __construct() {
		$this->connect_to_db = mysql_connect($this->host, $this->username, $this->password)
		or die("Could not connect: " . mysql_error());
		mysql_select_db($this->name, $this->connect_to_db)
		or die("Could not select DB: " . mysql_error());
		mysql_query("SET NAMES 'utf8'");
		mysql_query("SET CHARACTER SET 'utf8'");
		mysql_query("SET SESSION collation_connection = 'utf8_general_ci'");
		}
		
		
	//Деструктор класса
	public function __destruct() {
		mysql_close($this->connect_to_db);
		}
		
		
	//Обработка запросов	
	public function qr($qr_text) {
		$this->qr_text = $qr_text;		
		$this->qr_res = mysql_query($this->qr_text)
		or die(mysql_error());
		}
	}
?>
