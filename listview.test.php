<?php

require("listview.class.php");
require("listview.render.php");

$data = array(array("listview.class.php", filesize("listview.class.php")),
			  array("listview.render.php",filesize("listview.render.php")),
			  array("listview.test.php",  filesize("listview.test.php"))
			  );

$list = new Listview();

$list->addData($data);

$list->addColumn("File");
$list->addColumn("Size");

$list->drawList();

?>