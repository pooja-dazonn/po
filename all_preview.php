<?php

include('./conn/config.php');  //connection



 ?>

      <html>

        <head> 

          <title>Manager preview Page</title>

             <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>

             <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
            <link rel="stylesheet" type="text/css" href="style.css"> 

             <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

             <meta name="viewport" content="width=device-width, initial-scale=1.0">

            </head>

        <body>
        <div class="w3-sidebar w3-bar-block w3-border-right" style="display:none" id="mySidebar">
    <button onclick="w3_close()" class="w3-bar-item w3-large">Close &times;</button>
  <a href="insert_po.php" class="w3-bar-item w3-button">CREATE PO</a>
  <a href="all_preview.php" class="w3-bar-item w3-button"> PREVIEW ALL PO's</a>
 
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
     
<form action="" method="POST">
        <div class="pay" style=" margin-left: 11%;">    

      <table class="display" id="userTable" style="width:100%" >

                   <thead>  

                            <th>PO.NO</th>

                            <th>Order DATE</th>

                            <th>Delivery Date</th>

                            <th>Destination</th>

                            <th>Pricing terms</th>

                            <th>Payment Terms</th>

                            <th>Supplier name</th>

                            <th>Category</th>

                            <th>action</th>

</thead>

                    <?php

                            $qr=("SELECT * from  create_po")

                            or die('Invalid query: ' . mysql_error());;

                            $re=mysqli_query($link,$qr);

                            while($user=mysqli_fetch_array($re))

                            {

                    ?>

                    <tr>

                            <td><?php echo $user['PO']; ?></td>

                            <td><?php echo $user['o_date']; ?></td>

                            <td><?php echo $user['d_date']; ?></td>

                            <td><?php echo $user['destination']; ?></td>

                            <td><?php echo $user['price_term']; ?></td>

                            <td><?php echo $user['pay_term']; ?></td>

                            <td><?php echo $user['supplier']?></td>

                            <td><?php echo $user['category']?></td>

                           <td><a href="pdf_download_A.php?PO=<?php echo $user['PO']; ?>">Download Now</a></td>

                    </tr>

                <?php

                           }

                ?>

      </table>  




                          


   

      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

      <script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

      <script>

      $(document).ready(function() {

      $('#userTable').DataTable();

      });

      </script>

      </div>

     
      </form>


</body>

</html>