<?php
$domain = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "";

if(empty($domain)) die("ACCESS DENIED");

$a = array();
$a[] = ".ultramaxnet.com";

//echo $domain;
//print_r($a);

$host = parse_url($domain, PHP_URL_HOST);
if(empty($host)) die("ACCESS DENIED");
$host = strtolower($host);
//print_r($host);
$isAllowed = false;
foreach($a as $v)
{
	if(substr($host, -(strlen($v))) == $v )
	{
		$isAllowed = true;
	}
}


if(!$isAllowed)  die("ACCESS DENIED");
