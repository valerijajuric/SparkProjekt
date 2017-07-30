<?php
include_once("classes/crud.php");
class Reservation
{    
    public $_idGuest;
	public $_dateFrom;
	public $_dateTo;
	public $_idApartment;

    
    protected $connection;
    
    public function __construct($_idGuest,$_dateFrom,$_dateTo,$_idApartment)
    {
      $this->_idGuest=$_idGuest;
	  $this->_dateFrom=$_dateFrom;
	  $this->_dateTo=$_dateTo;
	  $this->_idApartment=$_idApartment;
    }

	
}
?>