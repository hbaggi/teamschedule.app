<?php

$cookieSetup = [
	"expires" => time() + 3600,
	"secure" => true
];

setcookie("CookiaA", "PopTag 1.0", $cookieSetup);