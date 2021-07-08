<?php
class TestCommandRun {
function testInput($data) 
{
  $data = trim($data);
  $data = addslashes($data);
  $data = htmlspecialchars($data);
// $data = strip_tags($data);
  //echo $data ; die;
  return $data;
}
function timetodate($timestamp)
{
	
	$usa=substr($timestamp,0,10);
	
	$ndate = explode("-",$usa);
	$year = $ndate[0];
	$day = $ndate[2];
	$month = $ndate[1];
	
	if($usa == "0000-00-00" || $usa =="")
	return "";
	else
	return $day . "-" . $month . "-" . $year;
}
function numtow($amount)
{
	
			//num to word
			
   $no = round($amount);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
 // echo $result . "Rupees  " . $points . " Paise";
			
			
		return $result;	
			//ward code ends here
			
	}	


function showOutput($data) 
{
  $data = stripslashes($data);
  $data = htmlspecialchars_decode($data);
  return $data;
}
function useractivity_logs($con,$action_type,$page_name,$table_name,$column_id,$user_id)
{
	$date = date("Y-m-d H:i:s");
	$sql = "insert into useractivity_logs(action_type,page_name,table_name,column_id,user_id,createdate) 
	values ('$action_type', '$page_name', '$table_name', '$column_id', '$user_id','$date')";
	//echo $sql; die;
	mysqli_query($con,$sql);
}
// To encrypt data based on key //
function encrypt($string, $key)
{  
	$result = '';
	for($i=0; $i<strlen($string); $i++)
	{
		$char = substr($string, $i, 1);
		$keychar = substr($key, ($i % strlen($key))-1, 1);
		$char = chr(ord($char)+ord($keychar));
		$result.=$char;
	}
	return base64_encode($result);
}

// To decrypt data based on key //
function decrypt($string, $key)
{  
	$result = '';
	$string = base64_decode($string);
	for($i=0; $i<strlen($string); $i++)
	{
		$char = substr($string, $i, 1);
		$keychar = substr($key, ($i % strlen($key))-1, 1);
		$char = chr(ord($char)-ord($keychar));
		$result.=$char;
	}
	return $result;
}


function reArrayFiles($file)
{
    $file_ary = array();
    $file_count = count($file['name']);
    $file_key = array_keys($file);
    
    for($i=0;$i<$file_count;$i++)
    {
        foreach($file_key as $val)
        {
            $file_ary[$i][$val] = $file[$val][$i];
        }
    }
    return $file_ary;
}


// to check if a parent table exist in child table
function deleteData($con,$query_string)
{
  try 
  {
	//echo $query_string;
	$resdel = mysqli_query($con,$query_string);
	if(!$resdel)
	{
	  throw new Exception("Data Cannot be Deleted");
	}
	else
	{
	  return true;
	}
  
  } 
  catch (Exception $e) {
		 echo $e->getMessage();
	}
}
// get value if you know the primary key value //
function getvalMultiple($con,$table,$field,$where,$space)
{
	if($where != "")
	 $sql = "select $field from $table where $where";
	else
	 $sql = "select $field from $table";
	 
	//echo $sql;
	$getvalue = mysqli_query($con,$sql);
	$getval="";
	while($row = mysqli_fetch_row($getvalue))
	{
		if($getval == "")
		$getval = $row[0];
		else
		{
			if($space==true)
			$getval .= ", ". $row[0];
			else
			$getval .= ",". $row[0];
		}
	}
	return $getval;
}

function showData($con, $tableName , $where=1) {
        $query = "SELECT * FROM $tableName WHERE $where";
		//echo $query; die;
		 mysqli_set_charset($link,'utf8');
        $result = mysqli_query($link, $query);
        $num_rows = mysqli_num_rows($result);
        for ($i = 0; $i < $num_rows; $i++) {
            $data[] = mysqli_fetch_assoc($result);
        }
		if($num_rows==0)
		return array();
		//echo "hiiii";
		else
        return $data;
		
    }


// get value from any condition //
function getvalfield($con,$table,$field,$where)
{
	//$sql = "select $field from $table where $where";
	//echo $sql; echo "<br>";
	//$getvalue = mysqli_query($con,$sql);
	//$getval = mysqli_fetch_row($getvalue);

	//return $getval[0];
	$stmt = $con->prepare("SELECT $field FROM $table WHERE $where"); 
	$stmt->execute(); 
	$row = $stmt->fetch(); 
	if(empty($row)){
		return 0;
	}else{
		return $row[0];
	}
	
}

// get date format (01 march 2012) from 2012-03-01 //
function dateformat($date)
{
	if($date != "0000-00-00")
	{
	$ndate = explode("-",$date);
	$year = $ndate[0];
	$day = $ndate[2];
	$month = intval($ndate[1])-1;
	$montharr = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
	$month1 = $montharr[$month];
	
	
	return $day . " " . $month1 . " " . $year;
	}
	else
	return "";
}

// get date format (01-03-2012) from (2012-03-01) //
function dateformatindia($date)
{
	$ndate = explode("-",$date);
	$year = $ndate[0];
	$day = $ndate[2];
	$month = $ndate[1];
	
	if($date == "0000-00-00" || $date =="")
	return "";
	else
	return $day . "-" . $month . "-" . $year;
	
}

// get date format (01-03-2012) from (2012-03-01 23:12:04) //
function dateFullToIndia($date,$full)
{
	$fdate = explode(" ",$date);
	
	$ndate = explode("-",$fdate[0]);
	$year = $ndate[0];
	$day = $ndate[2];
	$month = $ndate[1];
	
	$time = explode(":",$fdate[1]);
	$hour = $time[0];
	$minute = $time[1];
	$second = $time[2];
	if($hour > 12)
	{
		$h = $hour-12;
		if($h < 10)
		$h = "0" . $h;
		$fulltime = $h . ":" . $minute . ":" . $second . " PM";
	}
	else
	$fulltime = $hour . ":" . $minute . ":" . $second . " AM";
	
	
	if($full == "full")
	return $day . "-" . $month . "-" . $year . " " . $fdate[1];
	else if($full == "fullindia")
	return $day . "-" . $month . "-" . $year . " " . $fulltime;
	else if($full == "time")
	return $fulltime;
	else
	return $day . "-" . $month . "-" . $year;
}

// get date format (2012-03-01) from (01-03-2012) //
function dateformatusa($date)
{
	$ndate = explode("-",$date);
	$year = $ndate[2];
	$day = $ndate[0];
	$month = $ndate[1];
	
	return $year . "-" . $month . "-" . $day;
}



// get image in particular size. if you writ only width then it returns in ratio of height. and you can set width and height //
function convert_image($fname,$path,$wid,$hei)
{
	$wid = intval($wid); 
	$hei = intval($hei); 
	//$fname = $sname;
	$sname = "$path$fname";
	//echo $sname;
	//header('Content-type: image/jpeg,image/gif,image/png');
	//image size
	list($width, $height) = getimagesize($sname);
	
	if($hei == "")
	{
		if($width < $wid)
		{
			$wid = $width;
			$hei = $height;
		}
		else
		{
			$percent = $wid/$width;  
			$wid = $wid;
			$hei = round ($height * $percent);
		}
	}
	
	//$wid=469;
	//$hei=290;
	$thumb = imagecreatetruecolor($wid,$hei);
	//image type
	$type=exif_imagetype($sname);
	//check image type
	switch($type)
	{
	case 2:
	$source = imagecreatefromjpeg($sname);
	break;
	case 3:
	$source = imagecreatefrompng($sname);
	break;
	case 1:
	$source = imagecreatefromgif($sname);
	break;
	}
	// Resize
	imagecopyresized($thumb, $source, 0, 0, 0, 0,$wid,$hei, $width, $height);
	//echo "converted";
	//else
	//echo "not converted";
	// source filename
	$file = basename($sname);
	//destiantion file path
	//$path="uploaded/flashgallery/";
	$dname=$path.$fname;
	//display on browser
	//imagejpeg($thumb);
	//store into file path
	imagejpeg($thumb,$dname);
}

// for get mixed no. like password etc. //
function getmixedno($totalchar)
{
	$abc= array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "1", "2", "3", "4", "5", "6", "7", "8", "9");
	$mixedno = "";
	for($i=1; $i<=$totalchar; $i++)
	{
		$mixedno .= $abc[rand(0,33)];
	}
	return $mixedno;
}


// get total no. of rows //
function getTotalNum($con,$table,$where)
{
	$sql = "select * from $table where $where";
	//echo $sql;
	$getvalue = mysqli_query($con,$sql);
	$getval = mysqli_num_rows($getvalue);

	return $getval;
}


// for pagination //
function startPagination($con,$page_query, $data_in_a_page)
{
	$getrow = mysqli_query($con,$page_query);
	$count = mysqli_num_rows($getrow);
	
	$page_for_site = "";
	
	$page=1;
	if(isset($_REQUEST['page']))
	$page = $_REQUEST['page'];
	
	if($count > $data_in_a_page)
	{
		$cnt = ceil($count / $data_in_a_page);
		
		$page_for_site .= "<div style='float:left; padding-top:3px; color:#c0f;'>Page $page of $cnt &nbsp;&nbsp;&nbsp;</div>";
		
		for($i = 1; $i<= $cnt; $i++)
		{
			$class = " class='pagination' ";
			if($i == $page)
			$class = " class='pagination-current' ";
			
			$pu = $this->curPageURL();
			$cm = explode("/",$pu);
			$n = count($cm);
			$curl = $cm[$n-1];
			
			$qm_avail = strpos($curl,"?");
			if($qm_avail == "")
			$page_for_site .= "<a href='?page=$i' $class>$i</a>";
			else
			{
				$page_avail = strpos($curl,"page=");
				if($page_avail != "")
				{
					$pagevalue = $_REQUEST['page'];
					$past_page = "page=$pagevalue";
					$finalurl = str_replace($past_page,"page=$i",$curl);
					$page_for_site .= "<a href='$finalurl' $class>$i</a>";
				}
				else
				$page_for_site .= "<a href='$curl&page=$i' $class>$i</a>";
			}
		}
		$page_for_site .= "<div style='clear:both'></div>";
	}
	echo $page_for_site;
}


// return present page url //
function curPageURL()
{
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") 
	$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	else
	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	return $pageURL;
}

// change number into word format //
function numtowords($num)
{
	$ones = array(
	1 => "one",
	2 => "two",
	3 => "three",
	4 => "four",
	5 => "five",
	6 => "six",
	7 => "seven",
	8 => "eight",
	9 => "nine",
	10 => "ten",
	11 => "eleven",
	12 => "twelve",
	13 => "thirteen",
	14 => "fourteen",
	15 => "fifteen",
	16 => "sixteen",
	17 => "seventeen",
	18 => "eighteen",
	19 => "nineteen"
	);
	$tens = array(
	2 => "twenty",
	3 => "thirty",
	4 => "forty",
	5 => "fifty",
	6 => "sixty",
	7 => "seventy",
	8 => "eighty",
	9 => "ninety"
	);
	$hundreds = array(
	"hundred",
	"thousand",
	"million",
	"billion",
	"trillion",
	"quadrillion"
	); //limit t quadrillion
	$num = number_format($num,2,".",",");
	$num_arr = explode(".",$num);
	$wholenum = $num_arr[0];
	$decnum = $num_arr[1];
	$whole_arr = array_reverse(explode(",",$wholenum));
	krsort($whole_arr);
	$rettxt = "";
	foreach($whole_arr as $key => $i)
	{
		if($i < 20)
		{
			$rettxt .= $ones[$i];
		}
		elseif($i < 100)
		{
			$rettxt .= $tens[substr($i,0,1)];
			$rettxt .= " ".$ones[substr($i,1,1)];
		}
		else
		{
			$rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0];
			$rettxt .= " ".$tens[substr($i,1,1)];
			$rettxt .= " ".$ones[substr($i,2,1)];
		}
		
		if($key > 0)
		{
			$rettxt .= " ".$hundreds[$key]." ";
		}
	}
	if($decnum > 0)
	{
		$rettxt .= " and ";
		if($decnum < 20)
		{
			$rettxt .= $ones[$decnum];
		}
		elseif($decnum < 100)
		{
			$rettxt .= $tens[substr($decnum,0,1)];
			$rettxt .= " ".$ones[substr($decnum,1,1)];
		}
	}
	return $rettxt;
} 
function sendSmsDynamic1($con,$caid, $msg, $mobile, $schedule="", $sentid="", $action=1)
{
	
	/*-----to check if sms info exist in table----*/
    $sttSms = "select * from sms_info where caid='$caid'";
	$sqlSms = mysqli_query($con,$sttSms);
	$cntsms = mysqli_num_rows($sqlSms);
	if($cntsms==0)
	{
	  $caid=1;
	}
	$sttSms = "select * from sms_info where caid='$caid'";
	$sqlSms = mysqli_query($con,$sttSms);
	$rowSms = mysqli_fetch_assoc($sqlSms);
	//die;
	
	$smsuname    = $rowSms['smsuname'];   // sms user name 
	$smspass     = $rowSms['smspass'];    // sms password 
	$smssender   = $rowSms['smssender'];  // sms sender id
	$veruname    = $rowSms['veruname'];   // variable name of user name
	$verpass     = $rowSms['verpass'];    // variable name of password
	$versender   = $rowSms['versender'];  // variable name of sender id
	$vermessage  = $rowSms['vermessage']; // variable name of message
	$vermob      = $rowSms['vermob'];     // variable name of to (mobile no)
	
	$verdate     = $rowSms['verdate'];    // variable of date field for schedule sms
	$verpatter   = $rowSms['verpatter'];  // pattern of date field e.g. ddmmyyyy
	$working_key = $rowSms['working_key'];// working key
	$verkey      = $rowSms['verkey'];     // variable name of working key
	
	$api_url     = $rowSms['api_url'];    // API URL
	$send_api    = $rowSms['send_api'];   // sending page name 
	
	$chk_bal_api = $rowSms['chk_bal_api'];// balance check api
	$sch_api     = $rowSms['sch_api'];    // schedule api
	$status_api  = $rowSms['status_api']; // status api
	
	
	//echo "Called";
	$request = ""; //initialize the request variable
	
	if($working_key == "")
	{
		$param[$veruname] = $smsuname; //this is the username of our TM4B account
		$param[$verpass]  = $smspass; //this is the password of our TM4B account
		
		if($action==1)
		$param[$vermob]   = $mobile; //these are the recipients of the message
	}
	else
	{
		$param[$verkey] = $working_key; //this is the key of our TM4B account
		
		if($action==1)
		$param[$vermob] = "91".$mobile; //these are the recipients of the message
	}
	
	if($action==1)
	{
		$param[$versender]  = $smssender;//this is our sender 
		$param[$vermessage] = $msg; //this is the message that we want to send
	}
	else if($action==2)
	{
		$param['messageid']  = $sentid;//this is our sender 
	}
	
	// for schedule //
	if($schedule!="")
	{
		$timearr = explode(" ",$schedule);
		
		$dateoftime = $timearr[0];
		$timeoftime = $timearr[1];
		
		$datearr = explode("-",$dateoftime); // explode Date //
		$yyyy = $datearr[0]; // year
		$mm   = $datearr[1]; // month
		$dd   = $datearr[2]; // day
		
		$datearr = explode(":",$timeoftime);
		$hh  = $datearr[0];
		$mmt = $datearr[1];
		$ss  = $datearr[2];
		
		$scdltime = strtolower($verpatter);
		$scdltime = str_replace("yyyy",$yyyy,$scdltime);
		$scdltime = str_replace("dd",$dd,$scdltime);
		$scdltime = str_replace("hh",$hh,$scdltime);
		$scdltime = str_replace("ss",$ss,$scdltime);
		$scdltime = preg_replace('/mm/i', $mm, $scdltime, 1);
		$scdltime = str_replace("mm",$mmt,$scdltime);
		
		
		 $param[$verdate] = $scdltime; //this is the schedule datetime //
		
	}
	//print_r($param);	
	foreach($param as $key=>$val) //traverse through each member of the param array
	{ 
		$request.= $key."=".urlencode($val); //we have to urlencode the values
		$request.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request
	//echo $request;

	if($action=="1") // 1 for send sms //
	$process_api = trim($send_api,"/");
	else if($action=="2") // 2 for Delivery report //
	$process_api = trim($status_api,"/");
	else if($action=="3") // 3 for check balance //
	$process_api = trim($chk_bal_api,"/");
	
	
	//First prepare the info that relates to the connection
	$host = $api_url;
	$script = "/$process_api";
	$request_length = strlen($request);
	$method = "POST"; // must be POST if sending multiple messages
	if ($method == "GET") 
	{
	  $script .= "?$request";
	}
	
	//Now comes the header which we are going to post. 
	$header = "$method $script HTTP/1.1\r\n";
	$header .= "Host: $host\r\n";
	$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$header .= "Content-Length: $request_length\r\n";
	$header .= "Connection: close\r\n\r\n";
	$header .= "$request\r\n";
	
	//echo $header;
	//Now we open up the connection
	$socket = @fsockopen($host, 80, $errno, $errstr); 
	if ($socket) //if its open, then...
	{ 
	  fputs($socket, $header); // send the details over
	  while(!feof($socket))
	  {
		 $output[] = fgets($socket); //get the results 
				
	  }
	  fclose($socket); 
	}
	
	if($action==1)
	{ 
		$cntOutput = count($output);
		$lastValue = $output[$cntOutput-1];
		$expLastValue = explode("=",$lastValue);
		$cntLastValue = count($expLastValue);
		$messageid = $expLastValue[$cntLastValue-1];
		
		return  $messageid;
	}
	else if($action==2 || $action==3)
	{
		return  $output;
	}
}

function sendSmsdynamic($link,$msg, $mobile, $schedule="", $sentid="", $action=1,$lang=0)
{
		
		
	//$smsuname    = "crmprofs"; //$rowSms['smsuname'];   // sms user name 
	//$smspass     = "Right@12";//$rowSms['smspass'];    // sms password 
	//$smssender   = "PROSYS"; //$rowSms['smssender'];  // sms sender id	
	
	$smsuname    = "opencompas"; //$rowSms['smsuname'];   // sms user name 
	$smspass     = "welcome@123";//$rowSms['smspass'];    // sms password 
	$smssender   = "COMPAS"; //$rowSms['smssender'];  // sms sender id
	$veruname    = "username"; //$rowSms['veruname'];   // variable name of user name
	$verpass     = "pass";//$rowSms['verpass'];    // variable name of password
	$versender   = "senderid";//$rowSms['versender'];  // variable name of sender id
	$vermessage  = "message";//$rowSms['vermessage']; // variable name of message
	$vermob      = "dest_mobileno";//$rowSms['vermob'];     // variable name of to (mobile no)
	
	$verdate     = "dt";//$rowSms['verdate'];    // variable of date field for schedule sms
	$verpatter   = "yyyy-mm-dd hh:mm:ss";//$rowSms['verpatter'];  // pattern of date field e.g. ddmmyyyy
	$working_key = ""; //$rowSms['working_key'];// working key
	$verkey      = "workingkey";// $rowSms['verkey'];     // variable name of working key
	
	$api_url     = "smsjust.com";//"dndsms.reliableindya.info";//$rowSms['api_url'];    // API URL
	$send_api    = "/sms/user/urlsms.php";//$rowSms['send_api'];   // sending page name 
	
	$chk_bal_api = "/sms/user/balance_check.php";//$rowSms['chk_bal_api'];// balance check api
	$sch_api     = "/sms/user/urlsms.php";// $rowSms['sch_api'];    // schedule api
	$status_api  = "/sms/user/response.php";//$rowSms['status_api']; // status api
	
	
	//echo "Called";
	$request = ""; //initialize the request variable
	if($api_url=="smsjust.com" )
	{
		$api_url='smsjust.com';
		$host='smsjust.com';
		$ch = curl_init();
	}
	
	if($working_key == "")
	{
		if(($action==2 && ($api_url == "smsjust.com" )))
		{
		}
		else
		{
			$param[$veruname] = $smsuname; //this is the username of our TM4B account
			$param[$verpass]  = $smspass; //this is the password of our TM4B account
			
			if($action==1)
			$param[$vermob]   = $mobile; //these are the recipients of the message
		}
	}
	else
	{
		if(($action==2 && ($api_url == "smsjust.com")))
		{
		}
		else
		{
			$param[$verkey] = $working_key; //this is the key of our TM4B account
			
			if($action==1)
			$param[$vermob] = "91".$mobile; //these are the recipients of the message
		}
	}
	
	if($action==1)
	{
		$param[$versender]  = $smssender;//this is our sender 
		$param[$vermessage] = $msg; //this is the message that we want to send
	}
	else if($action==2)
	{
		if($api_url == "smsjust.com" )
		{
			$param['Scheduleid']  =$sentid;

		}
		else
		{
		$param['messageid']  = $sentid;//this is our sender 
		}
	}
	if(( $api_url=="smsjust.com") && $action!=2)
	{
		$param['response'] = 'Y';// variable name of responce  for websms
	}
	// for schedule //
	if($schedule!="")
	{
		$timearr = explode(" ",$schedule);
		
		$dateoftime = $timearr[0];
		$timeoftime = $timearr[1];
		
		$datearr = explode("-",$dateoftime); // explode Date //
		$yyyy = $datearr[0]; // year
		$mm   = $datearr[1]; // month
		$dd   = $datearr[2]; // day
		
		$datearr = explode(":",$timeoftime);
		$hh  = $datearr[0];
		$mmt = $datearr[1];
		$ss  = $datearr[2];
		
		$scdltime = strtolower($verpatter);
		$scdltime = str_replace("yyyy",$yyyy,$scdltime);
		$scdltime = str_replace("dd",$dd,$scdltime);
		$scdltime = str_replace("hh",$hh,$scdltime);
		$scdltime = str_replace("ss",$ss,$scdltime);
		$scdltime = preg_replace('/mm/i', $mm, $scdltime, 1);
		$scdltime = str_replace("mm",$mmt,$scdltime);
		if(($api_url=="smsjust.com"))
		{
			$param['dt'] = "$yyyy-$mm-$dd";
			$param['tm'] = "$hh-$mmt-$ss";
		}
		else
		{
			$param[$verdate] = $scdltime; //this is the schedule datetime //
		}
		
		
		
	}
	//print_r($param);	
	foreach($param as $key=>$val) //traverse through each member of the param array
	{ 
		$request.= $key."=".urlencode($val); //we have to urlencode the values
		$request.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	if($lang!=0 && $api_url!="smsjust.com")
	{
		$request.="unicode=1&";
	}
	elseif($lang!=0 && ($api_url=="smsjust.com"))
	{
		$request.="msgtype=UNI&";
	}
	
	
	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request
	//echo $request;

	if($action=="1") // 1 for send sms //
	$process_api = trim($send_api,"/");
	else if($action=="2") // 2 for Delivery report //
	$process_api = trim($status_api,"/");
	else if($action=="3") // 3 for check balance //
	$process_api = trim($chk_bal_api,"/");
	
	
	//First prepare the info that relates to the connection
	$host = $api_url;
	$script = "/$process_api";
	$request_length = strlen($request);
	$method = "POST"; // must be POST if sending multiple messages
	if ($method == "GET") 
	{
	  $script .= "?$request";
	}
	if($api_url == "smsjust.com" )
	{
		 $url="http://$host$script?$request";
		 curl_setopt($ch,CURLOPT_URL, $url);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$output= curl_exec($ch);
		
		curl_close($ch);
		
		//if($action == 1)die;
	}
	else
	{
		//Now comes the header which we are going to post. 
		$header = "$method $script HTTP/1.1\r\n";
		$header .= "Host: $host\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: $request_length\r\n";
		$header .= "Connection: close\r\n\r\n";
		$header .= "$request\r\n";
		
		//echo $header;
		//Now we open up the connection
		$socket = @fsockopen($host, 80, $errno, $errstr); 
		if ($socket) //if its open, then...
		{ 
		  fputs($socket, $header); // send the details over
		  while(!feof($socket))
		  {
			 $output[] = fgets($socket); //get the results 
					
		  }
		  fclose($socket); 
		}
	}
		
	if($action==1) // sent sms //
	{
		if($api_url=="alerts.reliableindya.info")
		{
			$cntOutput = count($output);
			$lastValue = $output[$cntOutput-1];
			
			$expLastValue = explode("=",$lastValue);
			$cntLastValue = count($expLastValue);
			$messageid = $expLastValue[$cntLastValue-1];
			
			return  $messageid;
		}
		else if($api_url=="dndsms.reliableindya.info" || $api_url=="bulk.reliableindya.info"  || $api_url=="dndsms.reliableservices.org")
		{
			//$messageid = trim($output[22])."||".trim($output[21]);
			$messageid = trim($output[22]);
			return $messageid; //substr($lastBal,4);
		}
		if($api_url=="smsjust.com")
		{
			return $output;
		}
		
	}
	else if($action==2) // delivery report //
	{
		return  $output;
	}
	else if($action==3) // check balance //
	{
		if($api_url=="alerts.reliableindya.info")
		{
			$balamount = "";
			//print_r($output);
			foreach($output as $op)
			{
				if(strpos($op,'credits')!==false)
				$balamount = $op;
			}
			//return preg_replace("/[^0-9]/","",$output[9]);
			return preg_replace("/[^0-9.]/","",$balamount);
		}
		else if($api_url=="smsjust.com")
		{
			$outArr = explode(":",$output);
			$output = trim($outArr[1]);
			return $output;
		}
	}
	
}

function numbertowordorder($num)
{
	$ones = array(
	1 => "First",
	2 => "Second",
	3 => "Third",
	4 => "Fourth",
	5 => "Fifth",
	6 => "Sixth",
	7 => "Seventh",
	8 => "Eightth",
	9 => "Nineth",
	10 => "Tenth",
	11 => "Eleventh",
	12 => "Twelveth",
	13 => "thirteen",
	14 => "fourteen",
	15 => "fifteen",
	16 => "sixteen",
	17 => "seventeen",
	18 => "eighteen",
	19 => "nineteen"
	);
	$tens = array(
	2 => "twenty",
	3 => "thirty",
	4 => "forty",
	5 => "fifty",
	6 => "sixty",
	7 => "seventy",
	8 => "eighty",
	9 => "ninety"
	);
	$hundreds = array(
	"hundred",
	"thousand",
	"million",
	"billion",
	"trillion",
	"quadrillion"
	); //limit t quadrillion
	$num = number_format($num,2,".",",");
	$num_arr = explode(".",$num);
	$wholenum = $num_arr[0];
	$decnum = $num_arr[1];
	$whole_arr = array_reverse(explode(",",$wholenum));
	krsort($whole_arr);
	$rettxt = "";
	foreach($whole_arr as $key => $i)
	{
		if($i < 20)
		{
			$rettxt .= $ones[$i];
		}
		elseif($i < 100)
		{
			$rettxt .= $tens[substr($i,0,1)];
			$rettxt .= " ".$ones[substr($i,1,1)];
		}
		else
		{
			$rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0];
			$rettxt .= " ".$tens[substr($i,1,1)];
			$rettxt .= " ".$ones[substr($i,2,1)];
		}
		
		if($key > 0)
		{
			$rettxt .= " ".$hundreds[$key]." ";
		}
	}
	if($decnum > 0)
	{
		$rettxt .= " and ";
		if($decnum < 20)
		{
			$rettxt .= $ones[$decnum];
		}
		elseif($decnum < 100)
		{
			$rettxt .= $tens[substr($decnum,0,1)];
			$rettxt .= " ".$ones[substr($decnum,1,1)];
		}
	}
	return $rettxt;
} 

function sendsms($smsuname,$smspass,$smssender,$msg,$mobile)
{
	//echo "Called";
	$request = ""; //initialize the request variable
	$param["username"] = $smsuname; //this is the username of our TM4B account
	$param["password"] = $smspass; //this is the password of our TM4B account
	$param["sender"] = $smssender;//this is our sender 
	$param["message"] = $msg; //this is the message that we want to send
	$param["to"] = $mobile; //these are the recipients of the message
			
	foreach($param as $key=>$val) //traverse through each member of the param array
	{ 
		$request.= $key."=".urlencode($val); //we have to urlencode the values
		$request.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request
	

	//First prepare the info that relates to the connection
	$host = "sms.reliableindya.info";
	$script = "/web2sms.php";
	$request_length = strlen($request);
	$method = "POST"; // must be POST if sending multiple messages
	if ($method == "GET") 
	{
	  $script .= "?$request";
	}
	
	//Now comes the header which we are going to post. 
	$header = "$method $script HTTP/1.1\r\n";
	$header .= "Host: $host\r\n";
	$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$header .= "Content-Length: $request_length\r\n";
	$header .= "Connection: close\r\n\r\n";
	$header .= "$request\r\n";
	//Now we open up the connection
	$socket = @fsockopen($host, 80, $errno, $errstr); 
	if ($socket) //if its open, then...
	{ 
	  fputs($socket, $header); // send the details over
	  while(!feof($socket))
	  {
		$output[] = fgets($socket); //get the results 
	  }
	  fclose($socket); 
	} 
}


// for send SMS //
function sendSmsByKey($workingkey,$smssender,$msg,$mobile)
{
	//echo "Called";
	$request = ""; //initialize the request variable
	//$param["username"] = $smsuname; //this is the username of our TM4B account
	//$param["password"] = $smspass; //this is the password of our TM4B account
	$param["workingkey"] = $workingkey; //this is the key of our TM4B account
	$param["sender"] = $smssender;//this is our sender 
	$param["message"] = $msg; //this is the message that we want to send
	$param["to"] = "91".$mobile; //these are the recipients of the message
			
	foreach($param as $key=>$val) //traverse through each member of the param array
	{ 
		$request.= $key."=".urlencode($val); //we have to urlencode the values
		$request.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request
	

	//First prepare the info that relates to the connection
	$host = "alerts.reliableindya.info";
	$script = "/api/web2sms.php";
	$request_length = strlen($request);
	$method = "POST"; // must be POST if sending multiple messages
	if ($method == "GET") 
	{
		$script .= "?$request";
	}
	
	//Now comes the header which we are going to post. 
	$header = "$method $script HTTP/1.1\r\n";
	$header .= "Host: $host\r\n";
	$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$header .= "Content-Length: $request_length\r\n";
	$header .= "Connection: close\r\n\r\n";
	$header .= "$request\r\n";
	//Now we open up the connection
	$socket = @fsockopen($host, 80, $errno, $errstr); 
	if ($socket) //if its open, then...
	{
		fputs($socket, $header); // send the details over
		while(!feof($socket))
		{
			$output[] = fgets($socket); //get the results 
		}
		fclose($socket);
	}
}


function genNDigitCode($joinchar, $id, $num)
{
	$digit = strlen($id);
	$zeronum = "";
	for($i=$digit; $i<$num;  $i++)
	$zeronum .= "0";
	return $joinchar . $zeronum . $id;
}

// To upload a file with selected extentions only //
function fileupload($controlname, $extention, $convert=false, $width, $height, $uploadfolder)
{
	$uploadfolder = trim($uploadfolder,"/");
	//echo $uploadfolder ;
	if(isset($_FILES[$controlname]['tmp_name']))
	{
		  //$_FILES[$controlname]['tmp_name']; 
		if($_FILES[$controlname]['error']!=4)
		{
			
			$timestamp = date('U');
			$swatch = date('B');
			$now = $timestamp.$swatch;
			
			 $fname=$_FILES[$controlname]['name'];
			//echo $fname; die;
			//echo "--".$uploadfolder.'/'.$fname; 
			$tm="ps";
			$tm.= $now.strtolower($this->getmixedno(1));
			$ext = pathinfo($fname, PATHINFO_EXTENSION);
			$ext = strtolower($ext);
			$fname=$tm.".".$ext;
			//echo $fname; 
			$arrext = explode(",",$extention);
			if(in_array($ext,$arrext))
			{
                         //echo "getval". $_FILES[$controlname]['tmp_name'];die;
				if(move_uploaded_file($_FILES[$controlname]['tmp_name'],"$uploadfolder/$fname"))
				{
				
					
					if($convert==true)
					{
						//echo "hello";
						if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'doc' || $ext == 'pdf' )
						$this->convert_image($fname,"$uploadfolder/","$width","$height");
					}
					return $fname;
				}
				else
				
				return 0;
			}
			else
			
			return 0;
		}
	}
	else
	return 1;
}


// To upload a file with selected extentions only //
function fileupload1($controlname, $extention, $convert=false, $width, $height, $uploadfolder)
{
	$uploadfolder = trim($uploadfolder,"/");
	if(isset($_FILES[$controlname]['tmp_name']))
	{
		if($_FILES[$controlname]['error']!=4)
		{
			$fname=$_FILES[$controlname]['name'];
			$tm="p";
			$tm.=microtime(true)*10000;
			$ext = pathinfo($fname, PATHINFO_EXTENSION);
			$fname=$tm.".".$ext;
			
			$arrext = explode(",",$extention);
			if(in_array($ext,$arrext))
			{
				if(move_uploaded_file($_FILES[$controlname]['tmp_name'],"$uploadfolder/$fname"))
				{
					if($convert==true)
					{
						if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'bmp' || $ext == 'png')
						$this->convert_image($fname,"$uploadfolder/","$width","$height");
					}
					return $fname;
				}
				else
				return 0;
			}
			else
			return 0;
		}
	}
	else
	return 0;
}

// to get final page name e.g. http://www.mysite.com/index.php?a=1 to index.php//
function finalPageName()
{
	$urlname = $_SERVER["REQUEST_URI"]; //to get complete url //
	$urlurl = explode("/",$urlname); // to explode based on '/' to get array of folders //
	$cnturl = count($urlurl); // count all folders in array //
	$finalpagename_q = $urlurl[$cnturl-1]; // to get last page of url //
	$arr_of_qs = explode("?",$finalpagename_q); // to remove query string from last page //
	$finalpagename = $arr_of_qs[0]; // to get final page name //
	return $finalpagename;
}


// check privileges of any user //
function checkPrivileges($con,$roleid, $finalpagename)
{
	$finalpagename = $this->finalPageName();
	//echo "select * from setprivilege where login_id='$roleid'";
	$getprivs = mysqli_query($con,"select * from setprivilege where login_id='$roleid'");
	$rowprivs = mysqli_fetch_array($getprivs);
	
	$privilegesids	= $rowprivs['privilegesids']; // all privileges id means all pages id in concat //
	$setvalues		= $rowprivs['setvalues']; // all privilege's values //
	
	
	$explode_privilegesids = explode(",",$privilegesids);
	$explode_setvalues = explode(",",$setvalues);
	
	
	$return_priv = "";
	//print_r($explode_privilegesids);
	$sttpagename = "select * from privileges where pageurl='$finalpagename'";
	//echo $sttpagename;
	$getpagename = mysqli_query($con,$sttpagename);
	$rowpagename = mysqli_fetch_array($getpagename);
	
	if($rowpagename['privilegesid'] != "")
	{
		//echo $rowpagename['privilegesid'];
		$key = array_search($rowpagename['privilegesid'], $explode_privilegesids);
		//echo "..".$key;
		$val = $explode_setvalues[$key];
		
		
		if($val == 1 || $val == 3 || $val == 5 || $val == 7 || $val == 9 || $val == 11 || $val == 13 || $val == 15)
		$return_priv .= "T";
		else
		$return_priv .= "F";
		
		if($val == 2 || $val == 3 || $val == 6 || $val == 7 || $val == 10 || $val == 11 || $val == 14 || $val == 15)
		$return_priv .= "T";
		else
		$return_priv .= "F";
		
		if($val == 4 || $val == 5 || $val == 6 || $val == 7 || $val == 12 || $val == 13 || $val == 14 || $val == 15)
		$return_priv .= "T";
		else
		$return_priv .= "F";
		
		if($val == 8 || $val == 9 || $val == 10 || $val == 11 || $val == 12 || $val == 13 || $val == 14 || $val == 15)
		$return_priv .= "T";
		else
		$return_priv .= "F";
		
		return $return_priv;
	}
}

// to get privileg true or false //
function explodePriv($return_priv,$type)
{
	$view = substr($return_priv,0,1);
	$add = substr($return_priv,1,1);
	$edit = substr($return_priv,2,1);
	$delete = substr($return_priv,3,1);
	
	if($type == "V")
	return $view;
	else if($type == "A")
	return $add;
	else if($type == "E")
	return $edit;
	else if($type == "D")
	return $delete;
}

// This is the vidhwanshak code if we provide software in offline mode then used this function //
function checkMacAdd()
{
	$original = "AC-22-0B-29-7A-9C1"; // Write here original MAC address //
	ob_start(); // Turn on output buffering
	system('ipconfig /all'); //Execute external program to display output
	$mycom=ob_get_contents(); // Capture the output into a variable
	ob_clean(); // Clean (erase) the output buffer

	$findme = "Physical";
	$pmac = strpos($mycom, $findme); // Find the position of Physical text
	$mac=substr($mycom,($pmac+36),17); // Get Physical Address
	
	// Remove comment from here to execute delete query //
	if($original==$mac)
	return true;
	//else
	//$this->rrmdir(getcwd());
}

// delete all files and sub folder of passed $dir //
function rrmdir($dir)
{
	if (is_dir($dir))
	{
		$objects = scandir($dir);
		foreach ($objects as $object)
		{
			if ($object != "." && $object != "..")
			{
				if (filetype($dir."/".$object) == "dir")
				$this->rrmdir($dir."/".$object); 
				else unlink($dir."/".$object);
			}
		}
		reset($objects);
		rmdir($dir);
	}
}

//Insert user's login logout detals //
function insertLoginLogout($con,$user_type,$logged_userid,$action_type,$ipaddress)
{
	$date = date("Y-m-d H:i:s");
	$sql = "insert into users_login_logout(user_type, logged_userid, action_type, login_logout_time, ipaddress) 
	values ('$user_type', '$logged_userid', '$action_type', '$date', '$ipaddress')";
	//echo $sql;
	mysqli_query($con,$sql);
}

/*function getBillid($con,$field,$user_id,$tablename)
{
	$sql = "select max($field) from $tablename where user_id = '$user_id'";
	$getvalue = mysqli_query($con,$sql);
	$getval = mysqli_fetch_row($getvalue);
	$num = $getval[0];
	//if($num == NULL)
	//$num = 0;
    ++$num; // add 1;
    $len = strlen($num);
    for($i=$len; $i< 5; ++$i) {
        $num = '0'.$num;
    }
	//echo $num; die;
    return $num;
}*/
function getBillid($con,$field,$tablename)
{
	$sql = "select max($field) from $tablename";
	$getvalue = mysqli_query($con,$sql);
	$getval = mysqli_fetch_row($getvalue);
	$num = $getval[0];
	//if($num == NULL)
	//$num = 0;
    ++$num; // add 1;
    $len = strlen($num);
    for($i=$len; $i< 5; ++$i) {
        $num = '0'.$num;
    }
	//echo $num; die;
    return $num;
}


function getclientcode($con,$caid)
{
	$sql = "select max(client_number) from m_clientinfo where caid = '$caid'";
	$getvalue = mysqli_query($con,$sql);
	$getval = mysqli_fetch_row($getvalue);
	$num = $getval[0];
	//if($num == NULL)
	//$num = 0;
    ++$num; // add 1;
    $len = strlen($num);
    for($i=$len; $i< 5; ++$i) {
        $num = '0'.$num;
    }
	//echo $num; die;
    return $num;
}

function getempcode($con,$caid)
{
	$sql = "select max(emp_number) from m_ca_users where ca_user_type!='admin' and caid = '$caid'";
	$getvalue = mysqli_query($con,$sql);
	$getval = mysqli_fetch_row($getvalue);
	$num = $getval[0];
	//if($num == NULL)
	//$num = 0;
    ++$num; // add 1;
    $len = strlen($num);
    for($i=$len; $i< 5; ++$i) {
        $num = '0'.$num;
    }
	//echo $num; die;
    return $num;
}

 
//delete value from table
function sqldelete($table,$cond)
{
   
	 $sql = "delete from $table where $cond";
	
	mysqli_query($con,$sql);
	return(0);
}

function get_client_ip() 
{
      $ipaddress = '';
      if (getenv('HTTP_CLIENT_IP'))
          $ipaddress = getenv('HTTP_CLIENT_IP');
      else if(getenv('HTTP_X_FORWARDED_FOR'))
          $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
      else if(getenv('HTTP_X_FORWARDED'))
          $ipaddress = getenv('HTTP_X_FORWARDED');
      else if(getenv('HTTP_FORWARDED_FOR'))
          $ipaddress = getenv('HTTP_FORWARDED_FOR');
      else if(getenv('HTTP_FORWARDED'))
          $ipaddress = getenv('HTTP_FORWARDED');
      else if(getenv('REMOTE_ADDR'))
          $ipaddress = getenv('REMOTE_ADDR');
      else
          $ipaddress = 'UNKNOWN';

      return $ipaddress; 
}
function convert_number_to_words($number)
	{
	$hyphen      = '-';
	$conjunction = ' and ';
	$separator   = ', ';
	$negative    = 'negative ';
	$decimal     = ' point ';
	$dictionary  = array(
		0                   => 'zero',
		1                   => 'one',
		2                   => 'two',
		3                   => 'three',
		4                   => 'four',
		5                   => 'five',
		6                   => 'six',
		7                   => 'seven',
		8                   => 'eight',
		9                   => 'nine',
		10                  => 'ten',
		11                  => 'eleven',
		12                  => 'twelve',
		13                  => 'thirteen',
		14                  => 'fourteen',
		15                  => 'fifteen',
		16                  => 'sixteen',
		17                  => 'seventeen',
		18                  => 'eighteen',
		19                  => 'nineteen',
		20                  => 'twenty',
		30                  => 'thirty',
		40                  => 'fourty',
		50                  => 'fifty',
		60                  => 'sixty',
		70                  => 'seventy',
		80                  => 'eighty',
		90                  => 'ninety',
		100                 => 'hundred',
		1000                => 'thousand',
		1000000             => 'million',
		1000000000          => 'billion',
		1000000000000       => 'trillion',
		1000000000000000    => 'quadrillion',
		1000000000000000000 => 'quintillion'
	);
	
	if (!is_numeric($number)) {
		return false;
	}
	
	if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
		// overflow
		trigger_error(
			'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
			E_USER_WARNING
		);
		return false;
	}
	
	if ($number < 0) {
		return $negative . $this->convert_number_to_words(abs($number));
	}
	
	$string = $fraction = null;
	
	if (strpos($number, '.') !== false) {
		list($number, $fraction) = explode('.', $number);
	}
	
	switch (true) {
		case $number < 21:
			$string = $dictionary[$number];
			break;
		case $number < 100:
			$tens   = ((int) ($number / 10)) * 10;
			$units  = $number % 10;
			$string = $dictionary[$tens];
			if ($units) {
				$string .= $hyphen . $dictionary[$units];
			}
			break;
		case $number < 1000:
			$hundreds  = $number / 100;
			$remainder = $number % 100;
			$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
			if ($remainder) {
				$string .= $conjunction . $this->convert_number_to_words($remainder);
			}
			break;
		default:
			$baseUnit = pow(1000, floor(log($number, 1000)));
			$numBaseUnits = (int) ($number / $baseUnit);
			$remainder = $number % $baseUnit;
			$string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
			if ($remainder) {
				$string .= $remainder < 100 ? $conjunction : $separator;
				$string .= $this->convert_number_to_words($remainder);
			}
			break;
	}
	
	if (null !== $fraction && is_numeric($fraction)) {
		$string .= $decimal;
		$words = array();
		foreach (str_split((string) $fraction) as $number) {
			$words[] = $dictionary[$number];
		}
		$string .= implode(' ', $words);
	}
	
	return $string;
	}
	
	
	function no_to_words($no)
	{
		$words = array('0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five','6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten','11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' =>
		 'fourteen','15' => 'fifteen','16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty','30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy','80' => 'eighty','90' => 'ninty','100' => 'hundred &','1000' => 'thousand','100000' => 'lakh','10000000' => 'crore');
		if($no == 0)
		return ' ';
		else {
		$novalue='';
		$highno=$no;
		$remainno=0;
		$value=100;
		$value1=1000;
		while($no>=100) {
		if(($value <= $no) &&($no < $value1)) {
		$novalue=$words["$value"];
		$highno = (int)($no/$value);
		$remainno = $no % $value;
		break;
		}
			$value= $value1;
			$value1 = $value * 100;
		}
		if(array_key_exists("$highno",$words))
		return $words["$highno"]." ".$novalue." ".$this->no_to_words($remainno);
		else
		{
			$unit=$highno%10;
			$ten =(int)($highno/10)*10;
			return $words["$ten"]." ".$words["$unit"]." ".$novalue." ".$this->no_to_words($remainno);
		}
		}
	} 
	
	
	
}


?>