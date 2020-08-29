<?php
 // Medical Response System for Smart City
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "tracker";
 // Create connection
 $conn = new mysqli($servername, $username, $password, $dbname);
 
 // Check connection
 if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
 }
 
if(isset($_GET['email']) && isset($_GET['password'])){
   
    $sql = "SELECT * FROM users WHERE email = '".$_GET['email']."' AND password = '".$_GET['password']."'";
    if ($result = $conn -> query($sql)) {
        $rowcount = mysqli_num_rows($result);
        if($rowcount != 0){
            echo "success";
        }else{
            echo "failed";
        }
        $result -> free_result();
    }
}
if(isset($_GET['email']) && isset($_GET['lat']) && isset($_GET['lon'])){
    $sql = "SELECT * FROM UserLocation WHERE email = '".$_GET['email']."'";
    if ($result = $conn -> query($sql)) {
        if($result->num_rows != 0){
            $nextSQL = "UPDATE UserLocation set lon = '" . $_GET['lon'] . "', lat = '" . $_GET['lat'] . "' WHERE email = '" . $_GET['email'] . "'";
        }else{
            $nextSQL = "INSERT INTO UserLocation(lat,lon,email,updated_date) VALUES(".$_GET['lat'].", ".$_GET['lon'].",'".$_GET['email']."', now()) ";
        }
        if ($result1 = $conn -> query($nextSQL)) {
            echo "inserted";
			nearPerson($_GET['email']);
        }
    }
    $result -> free_result();
}


function nearPerson($email){
    global $conn;
    $sql = "SELECT * FROM UserLocation";
    $sqlSingle = "SELECT * FROM UserLocation WHERE email = '".$email."'";
    if ($result = $conn -> query($sql) && $resultSingle = $conn -> query($sqlSingle)) {
        $singleData = $resultSingle -> fetch_row();
        $tempData = $conn -> query($sql);
        while ($row =  $tempData -> fetch_row()) {
            if(($singleData[2] - $row[2] <0.00002 || $singleData[2] - $row[2] > 0.00002) && 
                ($singleData[3] - $row[3] <0.00002 || $singleData[3] - $row[3] > 0.00002)){
                    updateCloseUser($singleData[0],$row[0]);
                }             
        }
      }
}

    function updateCloseUser($user, $fellow){
		global $conn;
        $userSQL = "SELECT * FROM UserLocation WHERE email = '".$user."'";
        $fellowSQL ="SELECT * FROM UserLocation WHERE email = '".$fellow."'";
        $userResult = $conn -> query($userSQL);
        $fellowResult = $conn -> query($fellowSQL);
        $userData = $userResult -> fetch_row();
        $fellowData = $fellowResult -> fetch_row();
        echo $userData[1];
        return;
        $userColumn =  "SELECT * FROM users WHERE email = '"+$userData[1]+"'";
        $fellowColumn =  "SELECT * FROM users WHERE email = '"+$fellowData[1]+"'";
        
        $userData = $conn -> query($userColumn)  -> fetch_row();
        $fellowData = $conn -> query($fellowColumn) -> fetch_row();

        $userId = $userData[0]; 
        $fellowId = $fellowData[0]; 

        $finalSQL = "INSERT INTO CloseUser(user_id,fellow_id,updated_date) VALUES(".$userId.",".$fellowId.",now())";
        
    }

?>