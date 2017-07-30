<?php
include_once("reservations2.php");
include_once("classes/crud.php");
include_once("json.php");
class Api 
{    
	private $crud;
	private $json;
	public function __construct(){
		$this->crud=new Crud();
		$this->json=new Json();
	}
   public function createReservation($_idGuest,$_dateFrom,$_dateTo,$_idApartment){
	    $res=new Reservation($_idGuest,$_dateFrom,$_dateTo,$_idApartment);
	     return $this->reserve($res);
   }
   public function isReserved(Reservation $reservation){
      $reservations = "SELECT * FROM `reservation` WHERE  `apartment_id` = $reservation->_idApartment
	  AND (('$reservation->_dateFrom' BETWEEN `date_from` AND `date_to`) OR 
	       ('$reservation->_dateTo' BETWEEN `date_from` AND `date_to`) OR 
		   ('$reservation->_dateFrom' < `date_from` AND  '$reservation->_dateTo' > `date_to`))";
	  $result = $this->crud->getData($reservations);
	  $returnValue=false;
	  if($result){
		$returnValue=true;
		}
		return $returnValue;
	  
   }
   public function reserve(Reservation $reservation){
		if($this->isReserved($reservation)){
			$this->json->status="Pogreska";
	        $this->json->message= "apartman je vec zauzet";	 
		 }
		 else{
			  $crud->execute("INSERT INTO reservation(date_from,date_to,guest_id,apartment_id) 
			  VALUES('$reservation->_dateFrom','$reservation->_dateTo',1,$reservation->_idApartment)");
			$this->json->message = "uspjeh";
			$this->json->message = "Uspjesno rezerviran";
		 }
		 return $this->json;
}
   public function getHistory($guest_id){
	   $query = "SELECT * FROM reservation WHERE guest_id = " . $guest_id;
	   $result = $this->crud->getData($query);  
       foreach ($result as $key => $res) {
	      $this->json->data["date_from"][] = $res['date_from'];
    }	   
	return $this->json;
   }
   public function cancelReservation($_reservationId){
	   $t=time();
       $date = (date("Y-m-d",$t));
	   $reservation = "SELECT * FROM reservation WHERE reservation_id = " . $_reservationId;
       $result = $this->crud->getData($reservation);
	   //$res = mysqli_fetch_array($result);
	   if($result){
	   foreach ($result as $key => $res) {
             $date_from = $res['date_from'];
    }
	       
	   
	   if(strtotime($date) < strtotime($date_from) ){
		    $this->crud->delete($_reservationId, 'reservation','reservation_id');
			$this->json->message="Pobrisana rezervacija";
			$this->json->status="uspjeh";
	   }
	   }
	   else $this->json->status="pogreska";
	   return $this->json;
	   
   }
   public function editReservation($_reservationId,$_dateFrom,$_dateTo){
	      if((strtotime($_dateFrom)>strtotime($_dateTo))||strtotime(date("Y-m-d",time()))>strtotime($_dateFrom)){
			  $this->json->status="pogreska";
			  $this->json->message="Datum ne smije biti manji od trenutnog datuma ";
		  }
		  else{
			$reservations = "UPDATE `reservation` SET `date_from` = '$_dateFrom', `date_to` = '$_dateTo'
			WHERE `reservation_id` = $_reservationId";
	         $this->crud->execute($reservations);
			 $this->json->status = "uspjeh";
			 $this->json->message = "Uspjesno uredjena rezervacija";
		     $this->json->data["_reservationId"]=$_reservationId;
			 $this->json->data["_dateFrom"]=$_dateFrom;
			 $this->json->data["_dateTo"]=$_dateTo;
   }
   return $this->json;
   }
}
?>