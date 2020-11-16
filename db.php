<?php

$servername = "192.168.30.8";
  $username = "geepcmdc";
  $password = "3ndl355";
  $dbname = "ebis_new";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }else{
    // echo "working";
  }

  ?>