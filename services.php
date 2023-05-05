<?php
// check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // get form data
    $user_Id = $_POST['user_Id'];
    $user_Name = $_POST['user_Name'];
    $phone = $_POST['Phone'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];

    // connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "parking_db";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //handle sign up form submission
    if (isset($_POST['signup'])) {
        $user_Id = $_POST['user_Id'];
        $user_Name = $_POST['user_Name'];
        $phone = $_POST['Phone'];
        $email = $_POST['Email'];
        $password_hash = password_hash($_POST['Password'], PASSWORD_DEFAULT);
        
        //insert new user into sign up
        $sql = "INSERT INTO sign_up(user_id, user_name, phone, email, password_hash) VALUES (?, ?, ?, ?, ?)";
        if ($conn->query($sql) === TRUE) {
            
            //redirect to log in
            header("location: signupBtn");
            exit();
        }else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $stmt->close();
    }

    //handle login submission
    if (isset($_POST['login'])) {
        $user_Id = $_POST['user_Id'];
        $email = $_POST['Email'];
        $password = $_POST['Password'];

        //querry signup up table to get users email and password
        $sql = "SELECT email, password FROM signup WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            //user found, verify password
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                //Password is correct
                $sql = "INSERT INTO login (email, password) VALUES ('$email', '$password')";
                if ($conn->query($sql) === TRUE) {
                    //redirect to parking.html
                    header("location: parking.php");
                    exit();
                } else {
                    echo "Error" . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error: " . $stmt->error;
        }
    }
    // insert data into the sign_up table
   /* $stmt = $conn->prepare("INSERT INTO sign_up(user_id, user_name, phone, email, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $user_Id, $user_Name, $phone, $email, $password);
    if ($stmt->execute()) {
        echo "Successfully Signed Up";
      
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();

    // close the database connection
$conn->close(); */
}
}
?>