<?php
require_once 'dompdf/autoload.inc.php'; 
use Dompdf\Dompdf; 
$data='';

$data="<table style='width:100%;' border='1'><thead><tr>
    <th>Event Name</th>
    <th>Event Description</th>
  </tr></thead>";
	// echo "<pre>";
	// print_r($_POST);
	// exit();
foreach($_POST as $key=>$value){
if ($value=='undefined'||$value=='') {

}else{
	if ($key == "candy_table_custom") {
		$_key=ucwords(str_replace('_',' ',$key));
		$counter = count($value) +1 ;

		$data .="<tr><td style='padding: 7px 20px' rowspan='".$counter."'>$_key</td></tr>";
		foreach ($value as $keto => $val) {
			$_key=ucwords(str_replace('_',' ',$key));
    		$data.="<tr><td style='padding: 7px 20px'>$val</td></tr>";
		}
	}elseif($key == "food_menu"){
		$_key=ucwords(str_replace('_',' ',$key));
		$counter = count($value) +1 ;
		$data .="<tr><td style='padding: 7px 20px' rowspan='".$counter."'>$_key</td></tr>";
		foreach ($value as $keto => $val) {
			$_key=ucwords(str_replace('_',' ',$key));
    		$data.="<tr><td style='padding: 7px 20px'>$val</td></tr>";
		}
	}elseif($key == "grand_total"){
		$_key=ucwords(str_replace('_',' ',$key));
		$data .="<tr><td style='padding: 7px 20px'>$_key</td>";
		$data.="<td style='padding: 7px 20px'>$$value</td></tr>";
	}else{
		$_key=ucwords(str_replace('_',' ',$key));
    	$data.="<tr><td style='padding: 7px 20px'>$_key</td><td style='padding: 7px 20px'>$value</td></tr>";
	}
	
}
   
}

$data.='</table>';

// echo $data;
// exit();

// $data = htmlentities($data);
// print_r($data);
// exit();
$dompdf = new Dompdf();
// Load HTML content 
// $dompdf->loadHtml("<table style='width:100%;' border='1'><thead><tr> <th>Event Name</th> <th>Event Description</th> </tr></thead><tr><td style='padding: 7px 20px'>Bouncy House</td><td style='padding: 7px 20px'>Bouncy House-1 hr Rental</td></tr><tr><td style='padding: 7px 20px'>Characters</td><td style='padding: 7px 20px'>Characters-2 hr Rental</td></tr><tr><td style='padding: 7px 20px'>Back Drops</td><td style='padding: 7px 20px'>Back Drops-2 hr Rental</td></tr><tr><td style='padding: 7px 20px'>Candy Table</td><td style='padding: 7px 20px'>Candy Table_Customized</td></tr><tr><td style='padding: 7px 20px' rowspan='5'>Candy Table Custom</td></tr><tr><td style='padding: 7px 20px'>Candy Table Customized-Hot dog bar includes chips</td></tr><tr><td style='padding: 7px 20px'>Candy Table Customized-Polish bar</td></tr><tr><td style='padding: 7px 20px'>Candy Table Customized-Chocolate bar</td></tr><tr><td style='padding: 7px 20px'>Candy Table Customized-Dipper box</td></tr><tr><td style='padding: 7px 20px' rowspan='3'>Food Menu</td></tr><tr><td style='padding: 7px 20px'>Food Menu - Package 3</td></tr><tr><td style='padding: 7px 20px'>Food Menu - Package 4</td></tr><tr><td style='padding: 7px 20px'>Grand Total</td><td style='padding: 7px 20px'>$754.5</td></tr></table>"); 

$dompdf->loadHtml($data);

 
// (Optional) Setup the paper size and orientation 
$dompdf->setPaper('A4', 'landscape'); 
 
// Render the HTML as PDF 
$dompdf->render(); 
 
// Output the generated PDF to Browser 
$dompdf->stream();

	echo "<pre>";
	print_r($dompdf);
	exit();
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$subject='Birthday Inquiry Form';

//$mailSent=mail("m.i.c.r.e.a.t.i.v.e.w.o.r.d.s@gmail.com",$subject,$data,$headers);


if($mailSent){
    echo json_encode(['status'=>'1','data'=>'Mail Sent']);
} else {
    echo json_encode(['status'=>'0','data'=>'Some error occured']);
}
?>

