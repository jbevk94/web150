<?php

$siteKey = "6LfvcNAUAAAAAKjt0T193im85eOqRLP5VHjcTK32";
$secretKey = "6LfvcNAUAAAAADh1CsC2zRP13_d2-Q6q91B2-850";
date_default_timezone_set('America/Los_Angeles'); 
$server = 'beverlymjames.com';


spl_autoload_register('MyAutoLoader::NamespaceLoader');
include 'ReCaptcha/ReCaptcha.php'; 
if(
    !isset($siteKey) || 
    !isset($secretKey) || 
    $siteKey == ''  ||  
    $secretKey == ''
)      
{
    echo '<p>Please go into the index_include.php file and place 
    the <b>$siteKey</b> and <b>$secretKey</b> for the domain where your forms 
    will be posted.</p>';
    die;
}



function loadContact($form,$feedback='')
{
    global $toName,$toAddress,$website,$siteKey,$secretKey,$server;
    
    if($toAddress=='' || $toAddress == 'jbevk94@gmail.com')
    {
        echo '<p>Please place a real email into the variable named <b>$toAddress</b> on your web page.</p>';
        die;
    }

  
    $skipFields = 'g-recaptcha-response,Email';
    if($feedback == '')
    {
        $feedback = 'feedback.php';
    }
    
    if (isset($_POST['g-recaptcha-response'])):
   
    $recaptcha = new \ReCaptcha\ReCaptcha($secretKey);

    $resp = $recaptcha->setExpectedHostname($_SERVER['SERVER_NAME'])
                      ->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
    if ($resp->isSuccess()):
        
        $aSkip = explode(",",$skipFields); 
        $postData = show_POST($aSkip);
        $fromAddress = "";
        if(is_email($_POST['Email']))
        {
            $fromAddress = $_POST['Email'];
            
            $fromAddress = preg_replace("([\r\n])", "", $fromAddress);
        }

        if(isset($_POST['Name'])){$Name = $_POST['Name'];}else{$Name = "";} 

        if($Name != ""){$SubjectName = " from: " . $Name . ",";}else{$SubjectName = "";} 
        $postData = str_replace("<br />",PHP_EOL . PHP_EOL,$postData);
        $Subject= $website . " message" . $SubjectName . " " . date('F j, Y g:i a');
        $txt =  $Subject . PHP_EOL . PHP_EOL  . $postData; 
        
        if($server==''){
            $server=$_SERVER["SERVER_NAME"];
        }
         email_handler($toAddress,$toName,$Subject,$txt,$fromAddress,$Name,$website,$server);

        include_once $feedback;
    else:
        
        include_once $form;
        include_once 'ReCaptcha/js_includes.php'; 
    endif;
else:
   
    include_once $form;
    include_once 'ReCaptcha/js_includes.php'; 
endif;

}


function show_POST($aSkip)
{
	$myReturn = ""; 
	foreach($_POST as $varName=> $value)
	{
	 	if(!in_array($varName,$aSkip) || $varName == 'Email')
	 	{
	 		$strippedVarName = str_replace("_"," ",$varName);
			if(is_array($_POST[$varName]))
		 	{
		 	    $myReturn .= $strippedVarName . ": " . sanitize_it(implode(",",$_POST[$varName])) . "<br />";
	 		}else{
	 			$strippedValue = nl_2br2($value); 
	 			$strippedValue = str_replace("<br />","~!~!~",$strippedValue);
	 			$strippedValue = str_replace("~!~!~","\n",$strippedValue);
	 			$myReturn .= $strippedVarName . ": " . $strippedValue . "<br />"; 
	 		}
		}
	}
	return $myReturn;
}
function sanitize_it($str)
{
	$str = strip_tags($str); 
	$str = preg_replace("/[^[:alnum:][:punct:]]/"," ",$str);  
	return $str;
}

function is_email($myString)
{
  if(preg_match("/^[a-zA-Z0-9_\-\.]+@[a-zA-Z0-9_\-]+\.[a-zA-Z0-9_\-]+$/",$myString))
  {return true;}else{return false;}
}
function br_2nl($text)
{
	$nl = "\n";   
    $text = str_replace("<br />",$nl,$text);  
    $text = str_replace("<br>",$nl,$text); 
    $text = str_replace("<br/>",$nl,$text); 
    return $text;
}
function nl_2br2($text)
{
	$text = str_replace(array("\r\n", "\r", "\n"), "<br />", $text);
	return $text;
}

function email_handler($toEmail,$toName,$subject,$body,$fromEmail,$fromName,$website,$domain)
{
	$debug=false;
	if($fromName==""){$fromName = $website;} 
	$headers[] = "MIME-Version: 1.0";
	$headers[] = "Content-type: text/plain; charset=iso-8859-1";
	$headers[] = "From: {$fromName} <noreply@{$domain}>";
    
	if(isset($fromEmail) && $fromEmail != "")
	{
		$headers[] = "Reply-To: {$fromName} <{$fromEmail}>";
	}
	$headers[] = "Subject: {$subject}";
	$headers[] = "X-Mailer: PHP/".phpversion();
	
	$toEmail = 'To:' . $toName . ' <' . $toEmail . '>'; 
	if(@mail($toEmail, $subject, $body, implode(PHP_EOL, $headers)))
	{
		if($debug){echo 'Email sent! ' . date("m/d/y, g:i A");}
	}else{
		if($debug){echo 'Email NOT sent! Unknown error. ' . date("m/d/y, g:i A");}	
	}	

}
class MyAutoLoader
{
    
	public static function NamespaceLoader($class)
    {
        
		$path = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $class);
        $path = __DIR__ . '/' . $path . '.php';
		
		if (file_exists($path)) {
			include $path;
			return; 
		}else{
            echo 'include file not found!';
            die;
        }
    }

}