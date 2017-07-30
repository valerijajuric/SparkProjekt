<?php
include_once("api.php");
header('content-type:application/json');
$a=new Api();
$ruta=$_GET["ruta"];
if($ruta=="rezerviraj"){
	 $_idGuest=$_GET["_idGuest"];
	 $_dateFrom=$_GET["_dateFrom"];;
	 $_dateTo=$_GET["_dateTo"];;
	 $_idApartment=$_GET["_idApartment"];
	 $json=$a->createReservation( $_idGuest,$_dateFrom,$_dateTo,$_idApartment);
}
else if($ruta=="cancelReservation"){
       $_reservationId=$_GET["reservationId"];
	   $json=$a->cancelReservation($_reservationId);
	 }
else if($ruta=="history"){
		 $_idGuest=$_GET["_idGuest"];
		 $json=$a->getHistory($_idGuest);
}
else if($ruta=="edit"){
	$_reservationId=$_GET["reservationId"];
	$_dateFrom=$_GET["dateFrom"];
	$_dateTo=$_GET["dateTo"];
	$json=$a->editReservation($_reservationId,$_dateFrom,$_dateTo);
	
}
else{
	$json->status="error";
	$json->message="pogresna metoda";
}
	 echo json_encode($json);

