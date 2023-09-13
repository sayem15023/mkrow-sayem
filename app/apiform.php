
<?php

function techno_bulk_sms($sender_id,$apiKey,$mobileNo,$message){
$url = 'https://24smsbd.com/api/bulkSmsApi';
$data = array('sender_id' => $sender_id,
 'apiKey' => $apiKey,
 'mobileNo' => $mobileNo,
 'message' =>$message	
 );

 $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);     
    $output = curl_exec($curl);
    curl_close($curl);

    echo $output;
}
 
$sender_id='90';
$apiKey='TUtyb3c6TUtyb3cxMjM='; 
$mobileNo='01745830123';
$message='This is test SMS 1';
techno_bulk_sms($sender_id,$apiKey,$mobileNo,$message);

?>

<form action="sendsms.php" method = "GET">
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" id="email" name="email">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" id="pwd">
  </div>
  <div class="checkbox">
    <label><input type="checkbox"> Remember me</label>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>