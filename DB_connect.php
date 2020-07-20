<?php 

$conn = mysqli_connect('localhost', 'MArk', 'test1234', 'CHOPAR_pizza');

      if(!$conn){
            echo 'Connection error: '. mysqli_connect_error();
      }


?>