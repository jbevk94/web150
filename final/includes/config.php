<?php

ob_start();

date_default_timezone_set('America/Los_Angeles');

define('THIS_PAGE',basename($_SERVER['PHP_SELF']));

switch(THIS_PAGE){

    case 'index.php':
        $title = "Something Better";
        $PageID = 'Something Better for Everyone';
    break;
           case 'about.php':
            $title = "Our History";
            $PageID = 'Our History';
           break;
           case 'products.php':
            $title = "Locations";
            $PageID = 'Come Visit Us';
           break;
           case 'contact.php':
            $title = "Contact Us";
            $PageID = 'Contact Us';
           break;
    default:
        $title = THIS_PAGE;
        $PageID = 'Welcome';
   }


?>



