<?php
$postData = $uploadedFile = $statusMsg = '';
$msgClass = 'errordiv';
if(isset($_POST['submit'])){
    // Get the submitted form data
    $postData = $_POST;
    $email = $_POST['email'];
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    
    // Check whether submitted data is not empty
    if(!empty($email) && !empty($name) && !empty($subject) && !empty($message)){
        
        // Validate email
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            $statusMsg = 'Please enter your valid email.';
        }else{
            $uploadStatus = 1;
            
            // Upload attachment file
            if(!empty($_FILES["attachment"]["name"])){
                
                // File path config
                $targetDir = "uploads/";
                $fileName = basename($_FILES["attachment"]["name"]);
                $targetFilePath = $targetDir . $fileName;
                $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                
                // Allow certain file formats
                $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg');
                if(in_array($fileType, $allowTypes)){
                    // Upload file to the server
                    if(move_uploaded_file($_FILES["attachment"]["tmp_name"], $targetFilePath)){
                        $uploadedFile = $targetFilePath;
                    }else{
                        $uploadStatus = 0;
                        $statusMsg = "Sorry, there was an error uploading your file.";
                    }
                }else{
                    $uploadStatus = 0;
                    $statusMsg = 'Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.';
                }
            } 
            if($uploadStatus == 1){
                
                // Recipient
                $toEmail = $_POST['email'];

                // Sender
                $from = 'pooja.dazonn@gmail.com';
                $fromName = 'Payment Order';
                
                // Subject
                $emailSubject = ' Request Submitted by '.$name;
                
                // Message 
                $htmlContent = '<h2>Contact Request Submitted</h2>
                    <p><b>Name:</b> '.$name.'</p>
                    <p><b>Email:</b> '.$email.'</p>
                    <p><b>Subject:</b> '.$subject.'</p>
                    <p><b>Message:</b><br/>'.$message.'</p>';
                
                // Header for sender info
                $headers = "From: $fromName"." <".$from.">";

                if(!empty($uploadedFile) && file_exists($uploadedFile)){
                    
                    // Boundary 
                    $semi_rand = md5(time()); 
                    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
                    
                    // Headers for attachment 
                    $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
                    
                    // Multipart boundary 
                    $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
                    "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n"; 
                    
                    // Preparing attachment
                    if(is_file($uploadedFile)){
                        $message .= "--{$mime_boundary}\n";
                        $fp =    @fopen($uploadedFile,"rb");
                        $data =  @fread($fp,filesize($uploadedFile));
                        @fclose($fp);
                        $data = chunk_split(base64_encode($data));
                        $message .= "Content-Type: application/octet-stream; name=\"".basename($uploadedFile)."\"\n" . 
                        "Content-Description: ".basename($uploadedFile)."\n" .
                        "Content-Disposition: attachment;\n" . " filename=\"".basename($uploadedFile)."\"; size=".filesize($uploadedFile).";\n" . 
                        "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
                    }
                    
                    $message .= "--{$mime_boundary}--";
                    $returnpath = "-f" . $email;
                    
                    // Send email
                    $mail = mail($toEmail, $emailSubject, $message, $headers, $returnpath);
                    
                    // Delete attachment file from the server
                    @unlink($uploadedFile);
                }else{
                     // Set content-type header for sending HTML email
                    $headers .= "\r\n". "MIME-Version: 1.0";
                    $headers .= "\r\n". "Content-type:text/html;charset=UTF-8";
                    
                    // Send email
                    $mail = mail($toEmail, $emailSubject, $htmlContent, $headers); 
                }
                
                // If mail sent
                if($mail){
                    $statusMsg = 'Your Mail send successfully !!!!';
                    $msgClass = 'succdiv';
                    
                    $postData = '';
                }else{
                    $statusMsg = 'Your Mail Send failed, please try again !!!';
                }
            }
        }
    }else{
        $statusMsg = 'Please fill all the fields.';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    
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
    


<!-- Display contact form -->
<div class=" container">
    <div class="email">
<form method="post" action="" enctype="multipart/form-data">
<br>
<?php if(!empty($statusMsg)){ ?>
    <p class="statusMsg <?php echo !empty($msgClass)?$msgClass:''; ?>"><?php echo $statusMsg; ?></p>
<?php } ?>
<div class="form-group">
    <label><h1>SEND MAIL</h1></label>
</div>
    <div class="form-group">
    <label>NAME </label>    <input type="text" name="name" class="form-control" value="<?php echo !empty($postData['name'])?$postData['name']:''; ?>" placeholder="Name" required="">
    </div><br><br>
    <div class="form-group">
      <label>EMAIL</label>  <input type="email" name="email" class="form-control" value="<?php echo !empty($postData['email'])?$postData['email']:''; ?>" placeholder="Email address" required="">
    </div><br><br>
    <div class="form-group">
     <label>SUBJECT</label>   <input type="text" name="subject" class="form-control" value="<?php echo !empty($postData['subject'])?$postData['subject']:''; ?>" placeholder="Subject" required="">
    </div><br><br>
    <div class="form-group">
    <label>MASSAGE</label>   <textarea name="message" class="form-control" placeholder="Write your message here" required=""><?php echo !empty($postData['message'])?$postData['message']:''; ?></textarea>
    </div><br><Br>
    <div class="form-group">
      <input type="file" name="attachment" class="form-control">
    </div><br><br>
    <div class="submit">
        <input type="submit" name="submit" class="btn" value="SEND">
    </div><br><br>
   
</form>
</div>
</div>
</body>
</html>