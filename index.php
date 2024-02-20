<?php
if(isset($_POST['submit'])){
  $originalPostCount = count($_POST);
  
  if (count(array_filter($_POST)) === $originalPostCount){
    $new_message = array(
      "task" => $_POST['task'],
      "id" => time()
   );
   if(filesize("tasks.json") == 0){
      $first_record = array($new_message);
      $data_to_save = $first_record;
   }else{
      $old_records = json_decode(file_get_contents("tasks.json"));
      array_push($old_records ,$new_message);
      $data_to_save = $old_records;
   }
   $encoded_data = json_encode($data_to_save, JSON_PRETTY_PRINT);
   file_put_contents("tasks.json", $encoded_data, LOCK_EX);

  }else{
    // ioiiuniui
  }
}
$tasks = json_decode(file_get_contents("tasks.json"),true);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/fontawesome.min.css"/>
  <link rel="stylesheet" href="./css/style.css">
  <title>Document</title>
</head>
<body>
  <div class="container">
    <h1>to do list</h1>
    <div class="inputs">
      <form action="" method="post"> 
        <input type="text" name="task" id="" placeholder="Enter your task">
        <input type="submit" value="Add" class="btn-add" name="submit">
      </form>     
    </div>
    <div class="text">
      <ul>
      <?php foreach($tasks as $task): ?> 
        <?php  $count = count($task);?>
        <?php foreach($task as $input): ?>    
          <?php if (--$count < 1){
                break;}
              ?>
        <li><?php echo $input ?> <i class="fa-regular fa-trash-can"></i></li>
        <?php endforeach; ?> 

        <?php endforeach; ?> 

        </ul>
    </div>
  </div>
</body>
</html>