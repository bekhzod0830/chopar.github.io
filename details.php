<?php 

 include('config/DB_connect.php'); 

 if(isset($_POST['DELETE'])){

 	$deleteid = mysqli_real_escape_string($conn, $_POST['deleteid']);

 	$sql = "DELETE FROM pizzas WHERE id = $deleteid";

 	if(mysqli_query($conn, $sql)){

 	  header('Location: index.php');
 	} {
      echo 'query error' . mysqli_error($conn);       
 	}
 }

 // check GET request id parametr
if(isset($_GET['id'])){

	$id = mysqli_real_escape_string($conn, $_GET['id']);

	// make sql

	$sql = "SELECT * FROM pizzas WHERE id = $id";

	// get the query result

	$result = mysqli_query($conn, $sql);

	$pizza = mysqli_fetch_assoc($result);

	mysqli_free_result($result); 

	mysqli_close($conn);
	
}

?>

<!DOCTYPE html>
<html>


<?php include('header.php'); ?>

<div class = "container center gray-text">
	<?php if($pizza): ?>
     <h4> <?php echo htmlspecialchars($pizza['title']); ?> </h4>
     <p> Creared by: <?php echo htmlspecialchars($pizza['email']);  ?> </p>
     <P> <?php echo date($pizza['created_id']); ?>
     <h5> INGREDIENTS: </h5>
     <p> <?php echo htmlspecialchars($pizza['ingredients']); ?> </p>

     <!--- delete the form--->
     <form action ="details.php" method = "POST">
     	<input type = "hidden" name = "deleteid" value="<?php echo $pizza['id'] ?>">
     	<input type = "submit" name = "DELETE"  value ="Delete" class = "btn brand z-depth-0">
     </form>


<?php else: ?>
	<h5 class=" center red-text"> This kind of pizza does not exist!!!</h5>


	<?php endif; ?>

	

</div>


<?php include('footer.php'); ?>


</html>