<?php 

/*
Name: Dipu Pravinbhai Dodiya
Date: 04/15/2022
Course Code: 78296  
*/

/* Defined Variable  */
$output ="";
$errorMessage ="";

try{
  //To connect with database
  $dataConnection = new
  PDO("mysql:host=localhost;dbname=dodiyad_assignment4_db",
    "dodiyad_dipu","Father2001mother@");
  //to insert data in the table
  $sql = "select email_address, first_name, last_name, phone_number, created_on from contacts
  order by last_name ASC";
  $statments = $dataConnection->prepare($sql);
  $executeOk = $statments->execute();
  $numRow = $statments->rowCount();

  //if statement executes
  if($executeOk){
    $rows=$statments->fetchAll();
    //to display data in for loop
    foreach($rows as $row) {
      $email = $row['email_address'];
      $firstname = $row['first_name'];
      $lastname = $row['last_name'];
      $contact = $row['phone_number'];
      $date = $row['created_on'];
      $output.= "<tr><td>$email</td><td>$firstname</td><td>$lastname</td><td>$contact</td><td>$date</td></tr>";
    }
  }
  else{
    $errorMessage.=("not done");
  } 
}
catch(PDOException $e){
  echo 'Connection error: ' .$e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Menu</title>
  <link rel="stylesheet" href="./css/vertical-menue.css">
</head>

<body>
  <header>
    <h1>Sys10199: Assignment 4-Contacts</h1>
  </header>
  <div class="container">
    <nav>
      <ul>
        <li><a href="./ass4out.php">View Contacts</a></li>
        <li><a href="./ass4in.php">Add Contact</a></li>
      </ul>
    </nav>
    <section class="main">
      <article>
        <h1>View Contacts Table:</h1>
        <h3 id="error"><?=$errorMessage; ?></h3>
        <div id="output">
          <table border='1'>
            <tr><th>E-Mail Address</th><th>First Name</th><th>Last Name</th><th>Phone Number</th><th>Created ON</th></tr>
            <tr> <?=$output; ?> </tr>
          </table>
        </div>
      </article>
      <article>
      </article>
    </section><!-- main  -->
  </div><!--  container -->
  <footer>
    <section>
      <!-- for download -->
      <br>
      <p>&copy; Dodiya 2022</p>
    </section>
  </footer>
</body>
</html>