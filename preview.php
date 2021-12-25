<?php
include('./conn/config.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
          <link rel="stylesheet" type="text/css" href="style.css"> 
    <title>Document</title>
</head>


<div class="w3-sidebar w3-bar-block w3-border-right" style="display:none" id="mySidebar">
                <button onclick="w3_close()" class="w3-bar-item w3-large">Close &times;</button>
              <a href="insert_po.php" class="w3-bar-item w3-button">CREATE PO</a>
              <a href="all_preview.php" class="w3-bar-item w3-button"> PREVIEW ALL PO's</a>
              <a href="supplier.php" class="w3-bar-item w3-button"> SUPPLIER</a>
              <a href="index.php" class="w3-bar-item w3-button">LOGOUT</a>
        </div>
        <div class="w3-teal">
          <button class="w3-button w3-teal w3-xlarge" onclick="w3_open()">☰</button> &nbsp;&nbsp;
          
        </div>
        <script>
            function w3_open() {
              document.getElementById("mySidebar").style.display = "block";
            }
            function w3_close() {
              document.getElementById("mySidebar").style.display = "none";
            }
        </script>
       <br>

       <body>
<div class="border">

       <div class="send">
       <a href="Savedownload.php"> SAVE</a> &nbsp;&nbsp;&nbsp;&nbsp; <a href="mail.php"> SEND MAIL</a>
        </div>
  
        <div class="order">
        <h2> <b>PAYMENT  ORDER </b> </h2> 
 </div><br><Br>

<form action="" method="POST">


<?php
                            $qr=("SELECT * from  create_po ORDER BY PO DESC limit 1");
                          
                            $re=mysqli_query($link,$qr);
                            while($user=mysqli_fetch_array($re))
                            {
                    ?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="title">
                <div class="suppl">
                        <?php echo $user['supplier']; ?><br>       
            </div>
        </div>
    </div>
</div>
<div class="row">
        <div class="col-md-6">
            
               <div class="form1-a">

            
                        <label> <b>PO No. :</b></label>
                        <input type="text" name="t1" value="<?php echo $user['PO']; ?>" size="15" readonly  /><br><br>

                        <label> <b>Order Date:</b></label>
                        <input type="date" name="t2"  value="<?php echo $user['o_date']; ?>"  size="15" readonly/><br><br>

                        <label><b>Delivery Date:</b></label>
                        <input type="date" name="t3"  value="<?php echo $user['d_date']; ?>"  size="15"readonly/><br><br>
                        
                        <label for="desti"><b>Destination:  &nbsp;</b></label>
                        <input type="text" name="t5"  value="<?php echo $user['destination']; ?>" size="15"readonly/><br><br>

                        <label><b>Pricing terms:</b></label>
                        <input type="text"  name="t6"  value="<?php echo $user['price_term']; ?>" size="15" readonly><br><br>
                          
                        <label ><b>Payment Terms:</b></label>
                        <input type="text"  name="t7"  value="<?php echo $user['pay_term']; ?>" size="15" readonly><br><Br>
                           
                   <label><b> category:</b></label>
                         <input type="text" name="t8"  value="<?php echo $user['category']; ?>" size="15" readonly><br>
   
        
                            </div>
            <?php
                           }
                ?>
          <br><br>
            </form>    
            </div>
        </div> 
                              </div>
        <div style="overflow-x:auto;">
           <table class="display" id="userTable" style="width:20%"   >
              <the>
            <th>CODE</th>
            <th>W(MM)</th>
            <th>D(MM)</th>
            <th>T(MM)</th>
            <th>TYPE</th>
            <th>FINISH</th>
            <th>QUANTITY</th>
            <th>COLOUR</th>
            <th>SQM</th>
            <th>KGS</th>
            <th>RATE</th>
            <th>TOTAL</th> 
</thead>  
             <?php
          $sql = "SELECT CODE,WM,TM,DM,TYPE,FINISH,COLOUR,QTY,SQM,KGS,RATE,ROUND(QTY*SQM,4) as sqm,ROUND(QTY*KGS,4)as kgs,(QTY*RATE) as TOTAL  from po   ";
$result =mysqli_query($link, $sql);
while($user=mysqli_fetch_array($result))
{
?>
            <tr>       
            <td><?php echo $user['CODE'];?></td>
                <td><?php echo $user['WM'];?></td>
                <td><?php echo $user['DM'];?></td>
                <td><?php echo $user['TM'];?></td>
                <td><?php echo $user['TYPE'];?></td>
                <td><?php echo $user['FINISH'];?></td>
                <td><?php echo $user['QTY'];?></td>
                <td><?php echo $user['COLOUR'];?></td>
                <td><?php echo $user['sqm'];?></td>
                <td><?php echo $user['kgs'];?></td>
                <td><?php echo $user['RATE'];?></td>
                <td><?php echo $user['TOTAL'];?></td>
          </tr>
           <?php } ?>
      </table><br> <br>
      
        <h6>
                ORDER SPECIFICATIONS:<br>
                As per Suppliers Agreement.<br>
                Order Comliance with item Code Drawings for Panels<br>
                Order Size Tolerance, Plus or Minus 0.3MM<br>
                Surface Protector on Panels to protect them during transport<br>
                Packing on Pallets with corner protectors<br>
                QC check certificate with Order Lot No ,Date,Name of QC supervisor<br></h6><br>
                <label>
          <br>      1: As supplier, you acknowledge that orders are placed and payments will be made in accordance with requirements under our standard contract terms & conditions and State/National statutory legislation, as applicable and our company shall be held indeminified in the contrary.
<br><br>2: As Supplier, you warrant that you are the owner of the Goods and that our Company will acquire goods and valid title to the goods, upon payment.

<br><br>3: Any items supplied which are found to be defective,shall be replaced / repaired as necessary at the supplier's cost and with delivery dates acceptable to our company.ln the event if the said delivery is not effected within the agreed due date,our company shall, without any further reference to you shall cancel the order in respect of all or any of the items specified and any advances paid will be returned to our company on or before seven days.

<br><br>4:  For unsigned pro -forma Invoice/ delivery notes from suppliers, our company is not entitled to accepted goods / services and honour any payments due; Any disputes subject to Chennai jurisdiction and arbitration.

<br><br>5:  Our company and its customers have the right to review the ordered material,and for that purpose,is granted access to the supplier's premises,including sub contractors premises,when required.

<br><br>6:  The supplier will supply all relevant material certificates,test certificates and delivery challans,when required.
</label>
<h5>
 <br>     <br>                                                                                              Authorised Signatory
                                                                                                    
                                                                                                    
 <br>                                                                                               (Proposed LLP company) 
</h5>   

         
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script>
        $(document).ready(function() {
        $('#userTable').DataTable();
        });
        </script><br><br>
         </div>
     </body>

</html>

