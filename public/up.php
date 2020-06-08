 <?php
 echo('here ');
  $db = mysqli_connect("localhost", "root", "", "bookstore");
  echo('here0 ');
 if (isset($_POST['upload'])) {
	  // Get image name
	  echo('here1 ');
	  $img = $_FILES['image']['name'] ;
	  $id= $_POST['id'];
	  $name= "book.jpg";

	  $image=$id.$name;
	  echo($id);
  
echo('here2 ');
  	// image file directory
  	$target = "uploads/".basename($image);
echo('here3 ');
	  $sql = "UPDATE `book` SET `img` = '$image' WHERE `id` = $id";
	  echo('here4');
  	// execute query
  	mysqli_query($db, $sql);
echo('here5 ');
  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
		  $msg = "Image uploaded successfully";
		  echo('here6 ');
  	}else{
		  $msg = "Failed to upload image";
		  echo('here7 ');
  	}
  }
  $result = mysqli_query($db, "SELECT * FROM img");
 
?>