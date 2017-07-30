<?php
include_once("reservations2.php");
include_once("classes/crud.php");
include_once("json.php");
class Guest 
{   
    private $guest_id;
	private $username;
	private $password;
	public function __construct($username, $password){
		$this->username = $username;
		$this->password = $password;
	} 
	
	
?>