<?php 
session_start();
include("include/db_connect.php");
if ($_SESSION['auth_admin'] == "yes_auth")
{
  
$sorting = $_GET["sort"];
  switch ($sorting)
{
  case 'name';
  $sorting = 'name_user DESC';
  $sort_name = 'Имя';
  break;
  
  case 'email';
  $sorting = 'email_user DESC';
  $sort_name = 'mail';
  break;
  
  case 'visible';
  $sorting = 'visible DESC';
  $sort_name = 'Выполнено';
  break;

  default:
  $sorting = 'id_user DESC';
  $sort_name = 'id';
  break;    
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Админка</title>
</head>
<body>
    <table cellspacing="0">
        <thead>
          <tr>
            <td>id</td>
            <td>mail</td>
            <td>Описание</td>
            <td>Картинка</td>
            <td>Имя</td>
            <td>Выполнено</td>
          </tr>
        </thead>
<?php
	   $result = mysqli_query($connection, "SELECT * FROM test_user ORDER BY $sorting");
    
  if (mysqli_num_rows($result) > 0)
  {
    $row = mysqli_fetch_array($result);
    do
    {
      
      if ($row["img_user"] != "" && file_exists("img/".$row["img_user"]))
      {
        $img_path = 'img/'.$row["img_user"];
        $max_width = 320;
        $max_height = 240;
        list($width, $height) = getimagesize($img_path);
        $ratioh = $max_height/$height;
        $ratiow = $max_width/$width;
        $ratio = min($ratioh, $ratiow);
        $width = intval($ratio*$width);
        $height = intval($ratio*$height);
      }else
      {
        echo $row["img_user"];
      }
            
    echo '
        <tr>
            <td>'.$row["id_user"].'</td>
            <td>'.$row["email_user"].'</td>
            <td><textarea>'.$row["textarea_user"].'</textarea></td>
            <td><img src="'.$img_path.'"width="'.$width.'" height="'.$height.'"/></td>
            <td>'.$row["name_user"].'</td>
            <td><input type="checkbox" name="visible"
              ';
              if ($row["visible"]!=0) {
                echo "checked";
                }else{
                  echo "";
                }
              echo'
             ></td>
        </tr>
    ';
    }
      while ($row = mysqli_fetch_array($result));
  }else
    {
        echo '<h3>Нету подключения к БД!</h3>';
    }
    
  ?>
  </table>
  <ul type="none">
    <li>Сортировка:</li>
    <li><?php echo $sort_name; ?></a>
        <?php 
        echo '
          <ul type="none">
              <li><a href="admin.php?sort=name">По имени</a></li>
              <li><a href="admin.php?sort=email">По почте</a></li>
              <li><a href="admin.php?sort=visible">Видимость</a></li>
          </ul>
    '?></li>
  </ul>
  <a href="index.php">На главную</a>
</body>
</html>
<?php
}else
{
    header("Location: index.php");
}
?>
<style type="text/css">
  td{
    border:1px solid;
    padding: 10px;
  }
  thead{
    background: yellow;
  }
</style>