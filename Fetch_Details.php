<?php

  include('admin/includes/connect_db.php'); 
  include('admin/includes/comman_classes.php');

  $mysqlObj = new mysql_class();
  $helper   = new Helper_class();

$fet = "select * from question where question_id = 25";

$sqlQuery=$mysqlObj->mysqlQuery($fet);
$row = $sqlQuery->fetch(PDO::FETCH_ASSOC);
$tooltip = $row['tooltip'];

$html = '<div>';
$html .= "<span class='head'>Qtooltip : </span><span>".$tooltip."</span><br/>";
}
$html .= '</div>';

echo $html;