<?php 
/*
Name: Dipu Pravinbhai Dodiya
Date: 04/15/2022
Course Code: 78296  
*/

/* Constant Variable defined */
define("PHONE_LENGTH",13);
define("MAX_FIRST_NAME_LENGTH",20);
define("MAX_LAST_NAME_LENGTH",30);
define("MAXIMUM_EMAIL_LENGTH",255);

/* Defined Variable  */
$errorMessage="";
$email="";
$firstname="";
$lastname="";
$contact="";
$date="";

//Form is submited in post method
if($_SERVER['REQUEST_METHOD']=='POST')
{
  $email = $_POST['email_address'];
  $firstname = $_POST['first_name'];
  $lastname = $_POST['last_name'];
  $contact = $_POST['phone_number'];
  $date = date("Y-m-d");

  //to trim white space
  $email = str_replace(' ', '', $email);
  $firstname = str_replace(' ', '', $firstname);
  $lastname = str_replace(' ', '', $lastname);
  $contact = str_replace(' ', '', $contact);

  //to connect with database
  $dataBaseConnection = new 
  PDO("mysql:host=localhost;dbname=dodiyad_assignment4_db",
    "dodiyad_dipu","Father2001mother@");
  //to prepare statement
  $sentence = $dataBaseConnection->prepare("SELECT email_address FROM contacts WHERE email_address=?");
  //to execute statement
  $sentence->execute([$email]);
  $oldEmail = $sentence->fetch();

  //if email is not entered
  if($email==""){
    $errorMessage.= "Please enter email address<br>";
  }else{
    //if email already exists
    if ($oldEmail) {
      $errorMessage.="Email already exsits. You Entered: . $email . <br>";
    }
    //if invalid format of email is entered
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errorMessage.= "Please Enter valid email format. You Entered: . $email . <br>";
    }
  }
  //if firstname is not entered
  if($firstname==""){
    $errorMessage.= "Please Enter First Name<br>";
  }
  //if the length of the firstname is greater than 20
  if(strlen($firstname) > MAX_FIRST_NAME_LENGTH){
    $errorMessage.= "Please Enter First Name of Maximum Length that is 20<br>";
  }
  //if lastname is not entered
  if($lastname==""){
    $errorMessage.= "Please Enter Last Name<br>";
  }
  //if the length of the lastname is greater than 30
  if(strlen($lastname) > MAX_LAST_NAME_LENGTH){
    $errorMessage.= "Please Enter Last Name of Maximum Length that is 30<br>";
  }
  //if contact number is not entered
  if($contact==""){
    $errorMessage.= "Please Enter Contact Number<br>";
  }else{
    //if the length of the contact is not equal to 13
    if(strlen($contact) != PHONE_LENGTH){
      $errorMessage.= "Please Enter Contact Number of  length that is 13<br>";
    }
  }

  //if no error exists
  if($errorMessage==""){
    try{
      //to insert data in the table
      $SQL = "INSERT INTO contacts(email_address, first_name, last_name, phone_number, created_on) VALUES (?, ?, ?, ?, ?)";
      $sentences = $dataBaseConnection->prepare($SQL);
      //to store the data in array
      $array = array($email, $firstname, $lastname, $contact, $date);
      $executeOk = $sentences->execute($array);

      //if statement executes
      if($executeOk){
        header("Location: ass4out.php");
      }
      else{
        $errorMessage.=("issue found");
      }
    }

    catch(PDOException $e){
      echo 'Connection error: ' .$e->getMessage();
    }
  } 
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
        <h1>Add Contact - Enter the follwoing Data:</h1>
        <!-- to print the error message -->
        <h3 id="error"><?=$errorMessage; ?></h3>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <div>
                <label for="">Email Address:</label>
                <input type="text" name="email_address" value="<?=$email?>">
            </div>
            <div>
                <label for="">First Name:</label>
                <input type="text" name="first_name" value="<?=$firstname?>">
            </div>
            <div>
                <label for="">Last Name:</label>
                <input type="text" name="last_name" value="<?=$lastname?>">
            </div>
            <div>
                <label for="">Phone Number:</label>
                <input type="tel" name="phone_number" value="<?=$contact?>">
            </div>
            <div>
                <input type="submit" value="Add" name="add">
                <input type="reset" value="Clear">
            </div>
        </form>
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