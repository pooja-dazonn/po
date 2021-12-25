<?php
 //connection
 include('./conn/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
          <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
          <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
          <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">


		<!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->

          <link rel="stylesheet" type="text/css" href="style.css"> 
    <title>Document</title>
</head>

<body>
<div class="w3-sidebar w3-bar-block w3-border-right" style="display:none" id="mySidebar">
                <button onclick="w3_close()" class="w3-bar-item w3-large">Close &times;</button>
              <a href="insert_po.php" class="w3-bar-item w3-button">CREATE PO</a>
              <a href="all_preview.php" class="w3-bar-item w3-button"> PREVIEW ALL PO's</a>
              <a href="supplier.php" class="w3-bar-item w3-button"> SUPPLIER </a>
              <a href="index.php" class="w3-bar-item w3-button">LOGOUT</a>
        </div>
        <div class="w3-teal">
          <button class="w3-button w3-teal w3-xlarge" onclick="w3_open()">☰</button> 
        </div>
        <script>
            function w3_open() {
              document.getElementById("mySidebar").style.display = "block";
            }
            function w3_close() {
              document.getElementById("mySidebar").style.display = "none";
            }
        </script>
        <div class="send">
       <a href="preview.php"> PREVIEW</a>
        </div>
        <div class="order">
        <h2> <b>PAYMENT  ORDER </b> </h2> 
 </div><br><Br>
        <div class=" container">
             <form class="well form-horizontal" action=" " method="post"  id="contact_form">
            
<?php
                            $qr=("SELECT * from  create_po ORDER BY PO DESC limit 1");
                          
                            $re=mysqli_query($link,$qr);
                            while($user=mysqli_fetch_array($re))
                            {
                    ?>
<!-- Text input -->
    <div class="group">
       <div class="form-group">
         <label class="col-md-4 control-label">PO NO.</label>  
           <div class="col-md-4 inputGroupContainer">   
             <div class="input-group">  
             <input type="text" name="t1" value="<?php echo $user['PO']; ?>" size="15" readonly  /><br><br>
              </div>
           </div>
      </div>  
<!-- Text input-->
     <div class="form-group">
        <label class="col-md-4 control-label" >ORDER DATE</label> 
           <div class="col-md-4 inputGroupContainer">
             <div class="input-group">
             <input type="date" name="t2"  value="<?php echo $user['o_date']; ?>"  size="15" readonly/><br><br>

             </div>
           </div>
      </div>
<!-- Text input-->
       <div class="form-group">
          <label class="col-md-4 control-label">DELIVERY DATE</label>  
             <div class="col-md-4 inputGroupContainer">
               <div class="input-group">
               <input type="date" name="t3"  value="<?php echo $user['d_date']; ?>"  size="15"readonly/><br><br>
                        
               </div>
              </div>
          </div>
   <!-- Text input-->
        <div class="form-group">
           <label class="col-md-4 control-label">DESTINATION</label>  
              <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                <input type="text" name="t5"  value="<?php echo $user['destination']; ?>" size="15"readonly/><br><br>
                  </select>
                </div>
             </div>
         </div>
<!-- Text input-->    
        <div class="form-group">
          <label class="col-md-4 control-label"  >PRICE TERM</label>  
             <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                <input type="text" name="t6"  value="<?php echo $user['price_term']; ?>"size="15" readonly> <br><br>
                </div>
               </div>
             </div>
             <!-- Text input-->    
         <div class="form-group">
            <label class="col-md-4 control-label"  >PAYMENT TERM</label>  
              <div class="col-md-4 inputGroupContainer">
                  <div class="input-group">
                  <input type="text"  name="t7"  value="<?php echo $user['pay_term']; ?>" size="15"  readonly><br><br>
          </div>
              </div>
         </div>
         <div class="category">
             <div class="form-group">
               <label class="col-md-4 control-label">CATEGORY </label>  
                 <div class="col-md-4 inputGroupContainer">
                   <div class="input-group">
                   <input type="text" name="t8"  value="<?php echo $user['category']; ?>" size="15" readonly><br><br>
                      <br><br>  
                      <button type="submit" name="btn" onclick="myfun()">INSERT PO</button><br><br>
                   </div>
                </div>
             </div>   
          </form>
         </div>    
         </div>  
         <?php
                            }
                            ?>
         <div style=overflow-x:auto;>
	

	<div class="well" style="margin:auto; ">
	

		<div style="height:50px;"></div>
		<table class="table table-striped table-bordered table-hover">
    
		<thead>
   
    <th>ID</th>
			<th>CODE</th>
                        <th>WM</th>
					            	<th>DM</th>
                        <th>TM</th>
                        <th>TYPE</th>
                        <th>FINISH</th>
                        <th>QTY</th>
					             	<th>COLOUR</th>
                        <th>SQM</th>
                        <th>KGS</th>
                        <th>RATE</th>
                        <th>TOTAL</th>
                        <th>ACTION</th>

						</thead>
			<tbody>
			
<?php
            
                $query="SELECT id, CODE,WM,TM,DM,TYPE,FINISH,COLOUR,QTY,SQM,KGS,RATE, ROUND(QTY*SQM,4) as sqm,ROUND(QTY*KGS,4)as kgs,(QTY*RATE) as TOTAL from po ";
                    $result=mysqli_query($link,$query) or die( mysqli_error($link));
                    while($row=mysqli_fetch_array($result))
                    {
       ?>
             <tr>
             <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['CODE']; ?></td>
                        <td><?php echo $row['WM']; ?></td>
                        <td><?php echo $row['DM']; ?></td>
                        <td><?php echo $row['TM']; ?></td>
                        <td><?php echo $row['TYPE']; ?></td>
                        <td><?php echo $row['FINISH']; ?></td>
                        <td><?php echo $row['QTY']; ?></td>
                        <td><?php echo $row['COLOUR']; ?></td>
                        <td><?php echo $row['sqm']; ?></td>
                        <td><?php echo $row['kgs']; ?></td>
                        <td><?php echo $row['RATE']; ?></td>
                        <td><?php echo $row['TOTAL']; ?></td>
						<td>
							<a href="#edit<?php echo $row['CODE']; ?>" data-toggle="modal" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Edit</a> 
						
							<?php include('button.php'); ?>
						</td>
                     
            </tr>
            <?php
                }
             
       
               ?>  
             
                  
</table>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
      <script>
       $( function() {
  var from = $( "#fromDate" )
      .datepicker({
        dateFormat: "yy-mm-dd",
		minDate: new Date()
      })
      .on( "change", function() {
        to.datepicker( "option", "minDate", getDate( this ) );
      }),
    to = $( "#toDate" ).datepicker({
      dateFormat: "yy-mm-dd",
     
    })
    .on( "change", function() {
      from.datepicker( "option", "maxDate", getDate( this ) );
    });

  function getDate( element ) {
    var date;
    var dateFormat = "yy-mm-dd";
    try {
      date = $.datepicker.parseDate( dateFormat, element.value );
    } catch( error ) {
      date = null;
    }
    return date;
  }
});
    </script>
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</div>
</div>
</body>
</html>

