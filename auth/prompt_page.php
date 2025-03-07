<?php

include "../db_connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventify</title>
    <link rel="stylesheet" href="../css/welcome3-style.css">
</head>
<body>
    <form action="" class="form-style" method="post">
        <header class="header-style">
            <!-- Space Section -->
        </header>
        <div class="image-style">
            <!-- Image Section -->
             <img src="/images/inventify-logo-383838.png" alt="Logo" class="logo-img-style">
        </div>
        <div class="input-style">
            <!-- Input Section -->
             <div class="text-container-style">
                <h1 class="h1-style">Who's going to use Inventify?</h1>
                <p class="p-style">You'll use this account to sign in to Inventify.</p>
             </div>
             <div class="input-container-style">
                <!-- Input Section-->
                 <div class="input-container">
                    <input type="text" name="firstName" id="firstName" required maxlength="50" placeholder="First Name">
                    <input type="text" name="middleName" id="middleName" maxlength="50" placeholder="Middle Name">
                    <input type="text" name="lastName" id="lastName" required maxlength="50" placeholder="Last Name">
                    <div class="input-container4">
                    <input type="email" name="email" id="email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" maxlength="50" placeholder="Email"> 
                    <input type="text" name="username" id="username" required maxlength="30" placeholder="Username">
                    <input type="text" name="address" id="address" required maxlength="100" placeholder="Address">
                    <input type="password" name="password" id="password" required maxlength="255" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}" 
                    title="Must contain at least 8 characters, including one uppercase, one lowercase, one number, and one special character." placeholder="Password">
                          
                    <select name="gender" id="gender" class="select-style" required>
                        <option value="" class="option-style">Select Gender</option>
                        <option value="Male" class="option-style">Male</option>
                        <option value="Female" class="option-style">Female</option>
                    </select>
                    </div>
                 </div>
                 <div class="input-container2">
                    
                    <label for="dateBirth" class="label-style">Date of Birth</label>
                    <input type="date" name="dateBirth" id="dateBirth" required placeholder="Date of Birth" pattern="^(19[0-9]{2}|20[0-9]{2})-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|30)$" 
                    title="Year must be 1900 or later, month must be 01-12, and day must be 01-30.">
                 </div>
             </div>
        </div>
        <div class="space-style">

            <button class="button-style" name="submit_prompt_name">Create</button>
        </div>
    </form>
</body>
</html>

<?php

    class Account {
        public $firstName;
        public $middleName;
        public $lastName;
        public $email;
        public $address;
        public $username;
        public $password;
        public $gender;
        public $account_type;
        public $dateOfBirth;

        function __construct($firstName, $middleName, $lastName, $email, $address, $username, $password, $gender, $dateOfBirth){
            $this->firstName = $firstName;
            $this->middleName = $middleName;
            $this->lastName = $lastName;
            $this->email = $email;
            $this->address = $address;
            $this->username = $username;
            $this->password = $password;
            $this->gender = $gender;
            $this->account_type = "Admin";
            $this->dateOfBirth = $dateOfBirth;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_prompt_name"])) {

        if(empty($_POST["firstName"]) || empty($_POST["lastName"]) || empty($_POST["email"]) || empty($_POST["address"]) || empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["gender"]) || empty($_POST["dateBirth"])){
            die("Please input the required fields.");
        }

        $acc = new Account($_POST["firstName"], $_POST["middleName"], $_POST["lastName"], $_POST["email"], $_POST["address"], $_POST["username"], $_POST["password"], $_POST["gender"], $_POST["dateBirth"]);

        $statement = $conn->prepare("INSERT INTO accounts (first_name, middle_name, last_name, email, address, username, password, gender, account_type, date_of_birth) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");

        $statement->bind_param("ssssssssss", $acc->firstName, $acc->middleName, $acc->lastName, $acc->email, $acc->address, $acc->username, $acc->password, $acc->gender, $acc->account_type, $acc->dateOfBirth);
        $statement->execute();
        $statement->close();

        header("Location: done_page.php");
        exit();
    }
?>