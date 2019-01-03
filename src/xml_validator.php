<?php


    $file = '/home/mica/html/players.xml';
    $schema = '/home/mica/html/xml_schema.xsd';
    $ab = new DOMDocument;
    $ab->load($file);

    if ($ab->schemaValidate($schema)) {
 	print "$file is valid.\n";
    } else {
	print "$file is invalid.\n";
    
    }


?>
