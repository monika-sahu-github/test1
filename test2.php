<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <title>jQuery UI Datepicker - Default functionality</title> -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>
<body>
 
<p>Date: <input type="text" id="datepicker1" onkeyup="sayhello()" value="<?php echo '04-01-1995';?>"></p>
 

</body>
</html>
   <script>
  $( function sayhello() {
    $( "#datepicker1" ).datepicker();
  } );
  </script>