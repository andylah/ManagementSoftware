<?php
$config = parse_ini_file("php_file/config.ini");
error_reporting(E_ALL);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<link rel="stylesheet" type="text/css" href="lib/ext/resources/css/ext-all.css" />
<link rel="stylesheet" type="text/css" href="lib/ext/resources/style.css" />
<link rel="stylesheet" type="text/css" href="lib/ext/resources/css/icons.css" />

<link rel="shortcut icon" href="lib/ext/resources/favicon.ico" type="image/x-icon"/>

<script language="javascript1.2" src="lib/ext/adapter/ext/ext-base.js"></script>
<script language="javascript1.2" src="lib/ext/ext-all.js"></script>

<script language="javascript1.2" src="index.js"></script>
<script language="javascript1.2" src="javascript_file/validation.js"></script>
<script language="javascript1.2" src="javascript_file/register.js"></script>

<title><?php echo $config['host_title'] ?></title>
</head>

<body>

   
</body>
</html>