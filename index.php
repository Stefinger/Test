<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3IT</title>

    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sometype+Mono:wght@600&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="style.css">

</head>
<body>
<h1>3IT Test</h1>
    <table>
        <tr>
            <th>NAME</th>
            <th>AGE</th>
        </tr>
<?php 
    // JSON
    $studentsData = 'students.json';

    // Vytazeni dat z JSONU a prevedeni do PHP
    if(file_exists($studentsData)){
        $studentsData = file_get_contents($studentsData);
        if(!empty($studentsData)){
            $studentsData = json_decode($studentsData,true);
            $students = array();
            foreach($studentsData as $data){
                $name = $data['name']. " " .$data['surname'];
                $age = $data['age'];
                $students[] = array($name,$age);
            }
            function compareAge($a, $b) {
                return $a[1] - $b[1];
            }
            usort($students, 'compareAge');

    foreach($students as $student){
        echo "<tr><td class='changeBackground'><a href='#'>" . $student[0] ."</a></td>"."<td class='changeBackground'><a href='#'>". $student[1] . "</a></td></tr>";
    }
        }else {     
            echo'The file is empty!';
        }
    }else{
        echo 'File not found';
    }
?>
</table>

<h1 class="marginLeft">Connect to MySQL</h1>

<form method="post" action="">
    <div class="marginBottom">
        <label for="serverName">Server Name</label><br>
        <input type="text" name="serverName" placeholder="localhost">
    </div>
    <div class="marginBottom">
        <label for="username">Username</label><br>
        <input type="text" name="username" placeholder="root">
    </div>
    <div class="marginBottom">
        <label for="password">Password</label><br>
        <input type="password" name="password" placeholder="root">
    </div>
    <div class="marginBottom"> 
        <label for="database">Database</label><br>
        <input type="text" name="database" placeholder="name_db">
    </div>
    <input type="submit" name="submit" value="Submit">
    
</form>
<?php 
    // MySQL
    if (isset($_POST['submit'])) {
        $servername = $_POST["serverName"]; 
        $username = $_POST["username"];
        $password = $_POST["password"];
        $database = $_POST["database"];
        $conn = mysqli_connect($servername, $username, $password, $database);
        if($conn){
            echo 'The database is connected!';
        }
    } else {
        echo'The database cannot be connected <br>';
    }

    if (mysqli_connect_errno()) {
        echo "Database connection error: " . mysqli_connect_error();
        exit();
    }

    foreach($studentsData as $studentData) {
        $name = $data['name']. " " .$data['surname'];
        $age = $data['age'];
        $email = $data['email'];
        $sql = "INSERT INTO students (name, age, email) VALUES ('$name', $age, '$email')";
        if (mysqli_query($conn, $sql)) {
            
        } else {
            echo "ERROR: " . mysqli_error($conn);
        }
    }
    $conn = mysqli_close($conn);
    
?>
<script>
    // Zmena pozadi, pri kliknuti
    document.querySelectorAll('.changeBackground').forEach(function(link) {
        link.addEventListener('click', function() {
            link.classList.toggle('changed');
        });
    });
</script>
</body>
</html>