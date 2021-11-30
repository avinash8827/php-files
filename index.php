<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Files Uploads</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</head>
<?php
     if(isset($_POST['filesbtn'])){
         echo 'yes';


         /* echo '<pre>';
         var_dump($_POST);
         echo '<pre/>'; */
         echo '<pre>';
         var_dump($_FILES['photo']);
         echo '</pre>';


         $conn = mysqli_connect('localhost','root','','ecom3_db');

         $name = mysqli_real_escape_string($conn,$_POST['name']);
         $photo_name = mysqli_real_escape_string($conn,$_FILES['photo']['name']);

         $source = $_FILES['photo']['tmp_name'];
         $detination = './uplods/'.$photo_name;
         $photo_name = rand(10,1000000).$photo_name;

         move_uploaded_file($source,$detination);


         $sql = "INSERT INTO users_tbl(`name`,`photo`) VALUES('$name','$photo_name')";

         mysqli_query($conn,$sql) or die(mysqli_error($conn));

         echo 'data insert';







         mysqli_close($conn);

         

     }



?>
<body>
    <form class="w-50 offset-3" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="photo" class="form-label">Photo</label>
            <input type="file" class="form-control" id="photo" name="photo">
        </div>
        <button type="submit" name="filesbtn" class="btn btn-primary">Submit</button>
    </form>


</body>

</html>