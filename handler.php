<?php
include("include/db_connect.php");
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$action = trim($_REQUEST['action']); 
    switch ($action){ 
        case "save":{ 
        
		$name = $_POST["name"];
    	$mail = $_POST["mail"];
    	$textarea = $_POST["textarea"];


    	if (isset($_POST['img']))
    		$types = array('image/gif', 'image/png', 'image/jpeg');
$foto_dir = "img/";
$foto_name = $fotos_dir.time()."_".basename
($_FILES['file']['name']);
$foto_light_name = time()."_".basename
($_FILES['file']['name']); 
$foto_tag = "<img src=\"$foto_name\" border=\"0\">"; 
$foto_tag_preview = "<img src=\"$foto_name\" 
border=\"0\">"; 

// Текст ошибок
$error_by_mysql = "<label class=\"label\">
Ошибка при добавлении данных в базу</span>";
$error_by_file = "<label class=\"label\">Невозможно 
загрузить файл в директорию. Возможно её не 
существует</span>";

// Начало
if (!in_array($_FILES['picture']['type'], $types))

{
$myfile = $_FILES["file"]["tmp_name"];
$myfile_name = $_FILES["file"]["name"];
$myfile_size = $_FILES["file"]["size"];
$myfile_type = $_FILES["file"]["type"];
$error_flag = $_FILES["file"]["error"];

// Если ошибок не было
if($error_flag == 0)
{
$DOCUMENT_ROOT = $_SERVER['DOCMENT_ROOT'];
$upfile = getcwd()."/img/" . time()."_".basename
($_FILES["file"]["name"]);
if ($_FILES['file']['tmp_name'])
{

//Если не удалось загрузить файл

if (!move_uploaded_file($_FILES['file']
['tmp_name'], $upfile))
{
echo "$error_by_file";
exit;
}

}
else
{
echo 'Проблема: возможна атака через загрузку файла. ';
echo $_FILES['file']['name'];
exit;
}
}

        mysqli_query($connection, "INSERT INTO `test_user` (email_user, textarea_user, img_user, name_user)
						VALUES(
						'".$mail."',
						'".$textarea."',
						'".$foto_name."',
						'".$name."')");    
	echo 'Всё успешно!';             
	
}
}
break; 
case "view":{ 
    $html = '<h3>'.$_POST["name"].'</h3>'; 
    $html .= '<br /><h3>'.$_POST["mail"].'</h3>'; 
    $html .= '<br /><h3>'.$_POST["textarea"].'</h3>';

if (isset($_POST['img']))
    		$types = array('image/gif', 'image/png', 'image/jpeg');
$foto_dir = "img/";
$foto_name = $fotos_dir.time()."_".basename
($_FILES['file']['name']);
$foto_light_name = time()."_".basename
($_FILES['file']['name']); 
$foto_tag = "<img src=\"$foto_name\" border=\"0\">"; 
$foto_tag_preview = "<img src=\"$foto_name\" 
border=\"0\">"; 

// Текст ошибок
$error_by_mysql = "<label class=\"label\">
Ошибка при добавлении данных в базу</span>";
$error_by_file = "<label class=\"label\">Невозможно 
загрузить файл в директорию. Возможно её не 
существует</span>";

// Начало
if (!in_array($_FILES['picture']['type'], $types))

{
$myfile = $_FILES["file"]["tmp_name"];
$myfile_name = $_FILES["file"]["name"];
$myfile_size = $_FILES["file"]["size"];
$myfile_type = $_FILES["file"]["type"];
$error_flag = $_FILES["file"]["error"];

// Если ошибок не было
if($error_flag == 0)
{
$DOCUMENT_ROOT = $_SERVER['DOCMENT_ROOT'];
$upfile = getcwd()."/img/" . time()."_".basename
($_FILES["file"]["name"]);
if ($_FILES['file']['tmp_name'])
{

//Если не удалось загрузить файл

if (!move_uploaded_file($_FILES['file']
['tmp_name'], $upfile))
{
echo "$error_by_file";
exit;
}
				$img_path = "img/".$foto_light_name;
				$max_width = 240;
				$max_height = 320;
				list($width, $height) = getimagesize($img_path);
				$ratioh = $max_height/$height;
				$ratiow = $max_width/$width;
				$ratio = min($ratioh, $ratiow);
				$width = intval($ratio*$width);
				$height = intval($ratio*$height);
    
    echo $html;
    echo '<img src="'.$img_path.'"width="'.$width.'" height="'.$height.'"/>'; 
    break; 
        }      
        } 
           
    } 
}}}



?>
