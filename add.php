<?php 

include('config/DB_connect.php');

    $email = $title = $ingredients = '';
    

    $errors = ['email'=> '', 'title' => '', 'ingredients' => ''];


    if(isset($_POST['submit'])){

	//check email
	if(empty($_POST['email'])){
	    $errors['email'] = '*An email is required <br />';
	} else {
		$email = $_POST['email'];
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
          $errors['email'] = '*Email must be a valid email address' . '<br />';
		}
	}

    //check title
	if(empty($_POST['title'])){
	    $errors['title'] = '*A title is required <br />';
	} else {
		$title = $_POST['title'];
		if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
			$errors['title'] = '*Title must be letters and spaces only'. '<br />';
		}

	}

    //check ing.
	if(empty($_POST['ingredients'])){
	    $errors['ingredients'] = '*At least one ingredient is required <br />';
	} else {
		$ingredients = $_POST['ingredients'];
		if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
			$errors['ingredients'] = '*Ingredients must be comma seperated'. '<br />';
		}
	}

    if(array_filter($errors)){
      
    } else{
    
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

    //create sql

    $sql = "INSERT INTO pizzas(title,email,ingredients) VALUES('$title','$email','$ingredients')";

    //save to DB
    if(mysqli_query($conn, $sql)){
    	//success
    	header('Location: index.php');
    } else {
    	// !success
    	echo 'query error:' . mysqli_error($conn);
    }


      
    }
}

	



?>

<!DOCTYPE html>
<html>

<?php include('header.php') ?>
<?php include('footer.php') ?>
	
	<section class="container grey-text">
	<h4 class= "center"> Add a Pizza</h4>
	<form action="add.php" method="POST">
		<label>Your email:</label>
		<input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
		<div class="red-text"><?php echo $errors['email']; ?> </div>

		<label>Pizza title:</label>
		<input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>">
		<div class="red-text"><?php echo $errors['title']; ?> </div>

		<label>Ingredients(comma separated):</label>
		<input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients); ?>">
		<div class="red-text"><?php echo $errors['ingredients']; ?> </div>

		<div class= "center">
		<input type="submit" name="submit" value="submit" class= "btn brand z-depth-0">
</div>
</section>


</html>