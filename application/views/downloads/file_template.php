<?php


$fields = $this->db->field_data('filecontacts');

foreach ($fields as $field)
{
   $names =  $field->names;
   $phonenumber =  $field->phonenumber;

}


$data[] = "$names,$names";


print implode($data, "\r\n");

header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename=example.csv');
header('Pragma: no-cache');
 ?>
