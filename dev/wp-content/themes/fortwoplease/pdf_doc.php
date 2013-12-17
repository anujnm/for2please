<?php
/*
Template Name: pdf
*/
?>
<?php
require('pdf_gen/fpdf.php');

class PDF extends FPDF {
	var $B;
	var $I;
	var $U;
	var $HREF;
	
	// Page header
	function Header() {
	    // Logo
	    $this->Image(ABSPATH.'wp-content/themes/images/voucher_logo.png',0,3);
	    // Arial bold 15
	    //$this->SetFont('Arial','B',15);
	    // Move to the right
	    //$this->Cell(80);
	    // Title
	    //$this->Cell(30,40,'Title',1,0,'C');
	    // Line break
	    $this->Ln(20);
	}

	// Page footer
	function Footer() {
	    // Position at 1.5 cm from bottom
	    $this->SetY(-15);
	    // Arial italic 8
	    $this->SetFont('Arial','',8);
	    // Page number
		$this->Cell(0,10,''.$this->PageNo().' of {nb}',0,0,'C');
		$this->SetY(-15);
		$this->Cell(0,10,'ForTwoPlease Customer Date Package',0,0,'L');
		$this->SetY(-15);
		$this->Cell(0,10, date("d/m/Y"),0,0,'R');
	}
	
	function WriteHTML($html) {
	    // HTML parser
	    $html = str_replace("\n",' ',$html);
	    $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
	    foreach($a as $i=>$e) {
	        if($i%2==0) {
	            // Text
	            if($this->HREF)
	                $this->PutLink($this->HREF,$e);
	            else
	                $this->Write(5,$e);
	        } else {
	            // Tag
	            if($e[0]=='/')
	                $this->CloseTag(strtoupper(substr($e,1)));
	            else {
	                // Extract attributes
	                $a2 = explode(' ',$e);
	                $tag = strtoupper(array_shift($a2));
	                $attr = array();
	                foreach($a2 as $v) {
	                    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
	                        $attr[strtoupper($a3[1])] = $a3[2];
	                }
	                $this->OpenTag($tag,$attr);
	            }
	        }
	    }
	}
	
	function OpenTag($tag, $attr) {
	    // Opening tag
	    if($tag=='B' || $tag=='I' || $tag=='U')
	        $this->SetStyle($tag,true);
	    if($tag=='A')
	        $this->HREF = $attr['HREF'];
	    if($tag=='BR')
	        $this->Ln(5);
		if($tag=='P')
			$this->ALIGN=$prop['ALIGN'];
		if($tag=='HR') {
			if( $prop['WIDTH'] != '' )
				$Width = $prop['WIDTH'];
			else
				$Width = $this->w - $this->lMargin-$this->rMargin;
			$this->Ln(2);
			$x = $this->GetX();
			$y = $this->GetY();
			$this->SetLineWidth(0.4);
			$this->Line($x, $y, $x+$Width, $y);
			$this->SetLineWidth(0.2);
			$this->Ln(2);
		}
	}
	
	function PutLink($URL, $txt) {
	    // Put a hyperlink
	    $this->SetTextColor(0,0,255);
	    $this->SetStyle('U',true);
	    $this->Write(5,$txt,$URL);
	    $this->SetStyle('U',false);
	    $this->SetTextColor(0);
	}
	
	function SetStyle($tag, $enable) {
	    // Modify style and select corresponding font
	    $this->$tag += ($enable ? 1 : -1);
	    $style = '';
	    foreach(array('B', 'I', 'U') as $s) {
	        if($this->$s>0)
	            $style .= $s;
	    }
	    $this->SetFont('',$style);
	}
	
	function CloseTag($tag) {
	    // Closing tag
	    if($tag=='B' || $tag=='I' || $tag=='U')
	        $this->SetStyle($tag,false);
	    if($tag=='A')
	        $this->HREF = '';
	}
}

$pid = $_GET["pid"];
$data = get_post_meta($pid);
$name = $data['package_name'];
$expiry_date = $data['end_date'];
$price = ($data['price'][0] + $data['taxes'][0] + $data['fees'][0]);
$fine_print = $data['fine_print'][0];
// $fine_print = explode(". ", $data['fine_print'][0]);

$guid = $_GET['guid'];
$uid = $_GET['uid'];
$fname = get_user_meta($uid, $guid.'_for_fname', false);
$lname = get_user_meta($uid, $guid.'_for_lname', false);
$transID = get_user_meta($uid, $guid.'_transID', false);

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Helvetica','B',14);
$pdf->Cell(0, 6, 'Date Package Voucher', 0, 1);

$pdf->SetFont('Helvetica','B',18);
$pdf->Cell(0, 6, $name[0], 0, 1);
// $pdf->WriteHTML(get_the_title($pid));
$pdf->Cell(0, 6, $data['business_name'][0], 0, 1);
$pdf->Ln(2);
$pdf->WriteHTML("<hr></hr>");
$pdf->Ln(2);

$pdf->SetFont('Helvetica','B',12);
$pdf->WriteHTML("<b>Recipient: </b> $fname[0] $lname[0]");
$pdf->Ln(5);
// $pdf->Cell(0, 5,'Recipient: '.$fname[0].' '.$lname[0], 0, 1);
$pdf->WriteHTML("<b>Expires On: </b> $expiry_date[0]");
$pdf->Ln(5);
// $pdf->Cell(0, 5,'Expires On: ' . $expiry_date[0], 0, 1);
//if ($transID[0])
//	$pdf->WriteHTML("<b>Voucher Code: $transID[0]</b>");
//else
$pdf->WriteHTML("<b>Voucher Code: $guid</b>");
$pdf->Ln(5);
// $pdf->Cell(0, 5,'Voucher Code: '.$guid, 0, 1);
$pdf->WriteHTML("<b>Price Paid: </b> $$price");
$pdf->Ln(5);
// $pdf->Cell(0, 5,'Price Paid: $' . $price[0], 0, 1);
$pdf->SetFont('Helvetica','',10);
$pdf->Cell(0, 5,'*All applicable taxes have been paid for this voucher.', 0, 1);
$pdf->Cell(0, 5,'*This Date Package Voucher is valid for two people.', 0, 1);
$pdf->Ln(2);
$pdf->WriteHTML("<hr></hr>");
$pdf->Ln(2);

$pdf->SetFont('Helvetica','B',12);
$pdf->Cell(0,6,'Fine Print:',0,1);
$pdf->SetFont('Helvetica','',12);
$pdf->MultiCell(0, 5, $fine_print, 0, 1);

$pdf->Ln(4);

$pdf->SetFont('Helvetica','B',12);
$pdf->Cell(0,6,'How to use this Voucher:',0,1);
$pdf->SetFont('Helvetica','',12);
$pdf->MultiCell(0,5,'1. Make your reservation now by calling '.$data['business_name'][0].' at '.$data['phone_number'][0].'.',0,1);
$pdf->MultiCell(0,5,'2. Print & bring this ForTwoPlease Voucher. (Reservations are required for all ForTwoPlease Date Packages)',0,1);

$pdf->Ln(4);

$pdf->SetFont('Helvetica','B',12);
$pdf->Cell(0,6,'Redeem at:',0,1);
$pdf->SetFont('Helvetica','',12);
$pdf->Cell(0, 5, $data['business_name'][0].', '.$data['phone_number'][0],0,1);
$pdf->Cell(0, 5, $data['mailing_address'][0], 0, 1);
$pdf->Cell(0, 5, $data['city'][0], 0, 1);
//$link = $pdf->AddLink();
//$pdf->Link(0,6, $link, 0, 1);
// $link = $pdf->AddLink();  
// $pdf->SetLink($link, 0, 2);  
// $pdf->Cell(0, 6, "http://www.tokofoods.com/nav_restaurant.asp", 0, 0, "", 0, $link);
// $pdf->Ln(5);
$url = $data['web_address'][0];
$pdf->WriteHTML("<a href='$url' target='_blank'>$url</a>");

$pdf->Ln(8);
$pdf->WriteHTML("<hr></hr>");
$pdf->Ln(2);

$pdf->SetFont('Helvetica','BI',12);
$pdf->WriteHTML("Need some help?");
$pdf->SetFont('Helvetica','',10);
$pdf->WriteHTML("  Email us at support@fortwoplease.com or call us anytime 604.600.8441.");
// $pdf->Cell(0,6,'Need some help?',0,1);
// $pdf->SetFont('Helvetica','',10);
// $pdf->Cell(0,6,'Email us at support@fortwoplease.com or call us anytime 604.600.8441.',0,1);


$pdf->Ln(8);

$pdf->SetFont('Helvetica','BU',12);
$pdf->Cell(0,6,'This Date Package Voucher expires on '.$expiry_date[0],0,1);
$pdf->SetFont('Helvetica','',12);
$policy1 = "*Partial Redemptions: If you redeem the Voucher for less than the total face value, you will not be entitled to receive any credit or cash for the difference between the face value and the amount you redeemed, unless otherwise required by law. You will only be entitled to a redemption value equal to the amount you paid for the Voucher less the amount actually redeemed.";
$policy2 = '*Redemption Value: If not redeemed by the discount voucher expiration date, this Voucher will continue to have a redemption value equal to the amount you paid at the named merchant for the period specified by applicable law. The redemption value will be reduced by the amount of purchases made. This Voucher can only be used for making purchases at the named merchant. It cannot be redeemed for cash or applied as pay ment to any account unless required by law.';
$policy3 = '*Neither ForTwoPlease nor the named merchant shall be responsible for Vouchers that are lost or damaged.';
$policy4 = '<b><u>Universal Fine Print:</u></b> Not valid for cash back (unless required by law). Must use in one visit. Doesn\'t cover gratuity. Can\'t be combined with other offers.';
$pdf->MultiCell(0,5,$policy1,0,1);
$pdf->Ln(2);
$pdf->MultiCell(0,5,$policy2,0,1);
$pdf->Ln(2);
$pdf->MultiCell(0,5,$policy3,0,1);
$pdf->Ln(4);
// $pdf->MultiCell(0,5,$policy4,0,1);
$pdf->WriteHTML($policy4);
$pdf->Ln(2);

$pdf->Output();



/*
$json_url = 'http://opentable.heroku.com/api/restaurants/81169';
// jSON String for request
// $json_string = '[:city=>"Vancouver"]';
 
// Initializing curl
$ch = curl_init( $json_url );

// Configuring curl options
$options = array(
CURLOPT_RETURNTRANSFER => true,
CURLOPT_HTTPHEADER => array('Content-type: application/json')
//CURLOPT_POSTFIELDS => $json_string
);
 
// Setting curl options
curl_setopt_array( $ch, $options );
 
// Getting results
$result =  curl_exec($ch); // Getting jSON result string

echo print_r($result);
*/
?>

