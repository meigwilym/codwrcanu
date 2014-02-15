<?php

$sql = "SELECT id, title, lyrics, ton, youtube FROM songs ORDER BY title ASC;";

$link = mysql_connect('localhost', 'root', '');

$rv = mysql_select_db('canwn', $link);
mysql_query('SET CHARACTER SET utf8');
$result = mysql_query($sql);

//fetch tha data from the database
$data = array();
$i = 0;
while ($row = mysql_fetch_row($result, MYSQL_ASSOC)) 
{

    $data[$i]['id'] = $row['id'];
    $data[$i]['title'] = $row['title'];
    $data[$i]['lyrics'] = nl2br($row['lyrics']);
    $data[$i]['ton'] = $row['ton'];
    $data[$i]['youtube'] = $row['youtube'];
    
    $i++;
}
echo 'var caneuon = ';
echo json_encode($data);

mysql_close();