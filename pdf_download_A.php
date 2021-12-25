<?php

require('fpdf183/fpdf.php');

include('./conn/config.php');



$pdf= new FPDF();	

$pdf->AddPage();
$pdf->rect(5,5,200,287,'D');
$pdf->SetFont('Arial','B',8);//set font

$pdf->cell(189 ,5,'PURCHASE ORDER',1,0,"C");

$pdf->cell(59 ,5,'',0,1);//end of line



$pdf->cell(130 ,5,'',0,0);

$pdf->cell(59 ,5,'',0,1);//end of line

$pdf->setFont("Arial","B",9);

$link= new PDO("mysql:host=localhost; dbname=i7_po","i7_poadmin","admin");

if(isset($_GET['PO']))

{

  $PO= $_GET['PO'];

$query="select * from create_po WHERE PO='$PO' ";

$result=$link->prepare($query);

$result->execute();

if($result->rowCount()!=0)

{

while($user=$result->fetch())

{
  $pdf->rect(5,5,200,287,'D');
  $pdf->cell(4,5,'',0,0);
    $pdf->multicell(35 ,9,'supplier name:',0,0);
    $pdf->cell(10,5,'',0,0);
    $pdf->multicell(90 ,5,$user['supplier'],1,1);
  
    $pdf->cell(130 ,5,'',0,0);
    $pdf->cell(28 ,5,"PO:",0,0);
    $pdf->cell(34 ,5,$user['PO'],1,0 );
    $pdf->cell(59 ,5,'',0,1);
    $pdf->cell(59 ,5,'',0,1);
    $pdf->cell(130 ,5,'',0,0);
    $pdf->cell(28 ,5,'Order Date:',0,0);
    $pdf->cell(34 ,5,$user['o_date'],1,0);
    $pdf->cell(59 ,5,'',0,1);
    $pdf->cell(59 ,5,'',0,1);

    

    $pdf->cell(130 ,5,'',0,0);

    $pdf->cell(28 ,5,'D_date:',0,0);

    $pdf->cell(34 ,5,$user['d_date'],1,0);

    $pdf->cell(59 ,5,'',0,1);

    $pdf->cell(59 ,5,'',0,1);



    $pdf->cell(130 ,5,'',0,0);

    $pdf->cell(28 ,5,'Destination:',0,0);

    $pdf->cell(35 ,5,$user['destination'],1,0);

    $pdf->cell(59 ,5,'',0,1);

    $pdf->cell(59 ,5,'',0,1);



    $pdf->cell(130 ,5,'',0,0);

    $pdf->cell(28 ,5,'price_term:',0,0);

    $pdf->cell(34 ,5,$user['price_term'],1,0);

    $pdf->cell(59 ,5,'',0,1);

    $pdf->cell(59 ,5,'',0,1);



    $pdf->cell(130 ,5,'',0,0);

    $pdf->cell(28 ,5,'pay_term:',0,0);

    $pdf->cell(34 ,5,$user['pay_term'],1,0);

    $pdf->cell(59 ,5,'',0,1);

    $pdf->cell(59 ,5,'',0,1);



    $pdf->cell(130 ,5,'',0,0);

    $pdf->cell(28 ,5,'Category:',0,0);

    $pdf->cell(34 ,5,$user['category'],1,0);

    $pdf->cell(59 ,5,'',0,1);

    $pdf->cell(59 ,5,'',0,1);

}

}

} 
$pdf->rect(5,5,200,287,'D');
$pdf->SetFont('Arial','B',8);

//$pdf->Cell(10,8,'No.',1);

$pdf->Cell(15,8,'CODE',1);

$pdf->Cell(15,8,'W(MM)',1);

$pdf->Cell(15,8,'D(MM) ',1);

$pdf->Cell(15,8,'T(MM) ',1);

$pdf->Cell(20,8,'TYPE ',1);

$pdf->Cell(20,8,'FINISH',1);

$pdf->Cell(15,8,'QTY',1);

$pdf->Cell(20,8,'COLOUR',1);

$pdf->Cell(15,8,'SQM',1);

$pdf->Cell(15,8,'KGS',1);

$pdf->Cell(15,8,'RATE',1);

$pdf->Cell(15,8,'TOTAL',1);

$link= new PDO("mysql:host=localhost; dbname=i7_po","i7_poadmin","admin");

$query1="SELECT CODE,WM,TM,DM,TYPE,FINISH,COLOUR,QTY,SQM,KGS,RATE,(QTY*SQM) as sqm,(QTY*KGS)as kgs,(QTY*RATE) as TOTAL from po ";

$result2=$link->prepare($query1);

$result2->execute();

if($result2->rowCount()!=0)

{

while($row=$result2->fetch())

{

	$pdf->Ln(8);
  $pdf->rect(5,5,200,287,'D');

	$pdf->SetFont('Arial','',10);

	$pdf->Cell(15,8,$row['CODE'],1);

	$pdf->Cell(15,8,$row['WM'],1);

	$pdf->Cell(15,8,$row['DM'],1);

	$pdf->Cell(15,8,$row['TM'],1);

	$pdf->Cell(20,8,$row['TYPE'],1);

	$pdf->Cell(20,8,$row['FINISH'],1);

	$pdf->Cell(15,8,$row['QTY'],1);

	$pdf->Cell(20,8,$row['COLOUR'],1);

	$pdf->Cell(15,8,$row['sqm'],1);

	$pdf->Cell(15,8,$row['kgs'],1);

	$pdf->Cell(15,8,$row['RATE'],1);

  $pdf->Cell(15,8,$row['TOTAL'],1);

}

$sql = "SELECT  SUM(QTY) from po";
$result = $link->query($sql);
//display data on web page
while($user=$result->fetch()){
  $pdf->Ln(8);
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(100,8,'QTY TOTAL',1);
 $pdf->Cell(15,8,$user['SUM(QTY)'],1);
    }

    
$sql1="Select Sum(QTY*RATE) as grandtotal from po";
$result2 = $link->query($sql1);

 
while($user1=$result2->fetch()){


  $pdf->Cell(65,8,'GRAND TOTAL',1);
 $pdf->Cell(15,8,$user1['grandtotal'],1);
    
}
$pdf->Ln( 16 );
$pdf->SetFont( 'Arial', '', 12 );
$pdf->Write( 6, "ORDER SPECIFICATIONS:
                As per Suppliers Agreement.
                Order Comliance with item Code Drawings for Panels
                Order Size Tolerance, Plus or Minus 0.3MM
                Surface Protector on Panels to protect them during transport
                Packing on Pallets with corner protectors
                QC check certificate with Order Lot No/Date/Name of QC supervisor
               " );
$pdf->Ln( 12 );
$pdf->Write( 6, "1: As supplier, you acknowledge that orders are placed and payments will be made in accordance with requirements under our standard contract terms & conditions and State/National statutory legislation, as applicable and our company shall be held indeminified in the contrary.

2: As Supplier, you warrant that you are the owner of the Goods and that our Company will acquire goods and valid title to the goods, upon payment.

3: Any items supplied which are found to be defective,shall be replaced / repaired as necessary at the supplier's cost and with delivery dates acceptable to our company.ln the event if the said delivery is not effected within the agreed due date,our company shall, without any further reference to you shall cancel the order in respect of all or any of the items specified and any advances paid will be returned to our company on or before seven days.

4:  For unsigned pro -forma Invoice/ delivery notes from suppliers, our company is not entitled to accepted goods / services and honour any payments due; Any disputes subject to Chennai jurisdiction and arbitration.

5:  Our company and its customers have the right to review the ordered material,and for that purpose,is granted access to the supplier's premises,including sub contractors premises,when required.

6:  The supplier will supply all relevant material certificates,test certificates and delivery challans,when required.


                                                                                                    Authorised Signatory
                                                                                                   (Proposed LLP company)               " );
                 $pdf->rect(5,5,200,287,'D');
                $pdf->output();
}
?>