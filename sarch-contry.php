<?php

ini_set('display_errors',"On");

$name = isset($_POST['name']) ? $_POST['name']:"";
$region = isset($_POST['region']) ? $_POST['region']:"";
$sumbit = isset($_POST['indepyeara_min']) ? $_POST['indepyear_min']: 0;
$sumbit = isset($_POST['indepyear_max']) ? $_POST['indepyear_max']: 0;
$sumbit = isset($_POST['submit']) ? $_POST['submit']:"";

//MySQLiコネクタを生成
$link = mysqli_connect("localhost","root","","world");

//DBコネクションを確立
if(!$link) {
    die("コネクションエラー");
}

//SQL文を生成
$query = "SELECT Code , Name , Continent , Region , FROM country  ORDER BY Code LIMIT 30";
if($submit === "search"){
    $wheres = [];
    if($name !== "") {
        $wheres[] = "Name LIKE '%{$name}%'";
        $wheres[] = "Region LIKE '%{$region}%'"
    }
    if(!empty($indepyear_min) && !empty($indepyear_max)) {
        $wheres[] = "IndepYear BETWEEN {$indepyear_min} AND {$Indepyear_max}";
    } else if(!empty($indepyear_min)) {
        $wheres[] = "IndepYear >= {$indepyear_min}";
    } else if(!empty($indepyear_max)) {
        $wheres[] = "IndepYear <= {$indepyear_max}";
    }
    if(!empty($wheres)) {
        $wheres = implode( ' AND ' , $wheres );
        $query = "SELECT Code , Name , Continent , Region , FROM country WHERE {$wheres} ORDER BY Code LIMIT 30";
    }
    
}

//SQL文を実行、結果を変数に格納
$result = mysqli_query($link, $query);

//DBコネクションを切断
mysqli_close($link);

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
<body>
    <form>
        <div class="container" method="POST" action="./sarch-contry.php"> 
        <div class="row mb-3">
           <label for="name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
            <div class="input-group">
                <input type="number" class="form-control" id="indepyear_min" name="indepyear_min"
                <idv class="input-group-text>～</div>
                <input type="number" class="form-contrpl" id="ndepyear_max" name="ndepyear_max"
             <input type="text" class="form-control" id="inputEmail3" name="name" value="<?php echo $name; ?>">
            </div>
        </div>
        <button type="submid" class="btn btn-primary" name="sumbit" value="serch">検索</button>
    </form>
    <table class="table">
      <thead>
          <th>Code</th>
          <th>Name</th>
          <th>Continent</th>
          <th>Region</th>
          <th>IndepYear</th>
      </thead>
      <tbody>
        <?php while($row = mysqli_fetch_assoc($result)){ ?>
            <tr>
                <td><?php echo $row['Code']; ?></td>
                <td><?php echo $row['Name']; ?></td>
                <td><?php echo $row['Continent']; ?></td>
                <td><?php echo $row['Region']; ?></td>
                <td><?php echo $row['IndepYear']; ?></td>
            </tr>
        <?php } ?>
      </tbody>
    </table>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>
</html>