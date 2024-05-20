# Security Policy




## Supported Versions

Use this section to tell people about which versions of your project are
currently being supported with security updates.

| Version | Supported          |
| ------- | ------------------ |
| 5.1.x   | :white_check_mark: |
| 5.0.x   | :x:                |
| 4.0.x   | :white_check_mark: |
| < 4.0   | :x:                |

## Reporting a Vulnerability

<?php
// Configuration file with secure database credentials
require_once 'config.php';

// Validate user input
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    // Check if input meets specified criteria
    if (preg_match('/^[a-zA-Z0-9_]+$/', $username) && strlen($password) >= 8) {
        // Connect to the database using secure credentials
        $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and bind
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        //mugamit ka i kong integer ang gipangyo sa isa ka variable example 'AND price = ?'
        //"ssi",$username, $password, $price 

        // Set parameters and execute
        $stmt->execute();

        // Store result
        $result = $stmt->get_result();

        // Check if the user exists
        if ($result->num_rows > 0) {
            // User exists, log in
            session_start();
            $_SESSION['username'] = $username;
            header('Location: dashboard.php');
            exit;
        } else {
            // User does not exist, display error
            $error = 'Invalid username or password';
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        // Input does not meet criteria, display error
        $error = 'Invalid input';
    }
}

// Display login form
if (isset($error)) {
    echo '<p style="color: red;">' . $error . '</p>';
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username"><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br>
    <input type="submit" va
</form>




Use this section to tell people how to report a vulnerability.

Tell them where to go, how often they can expect to get an update on a
reported vulnerability, what to expect if the vulnerability is accepted or
declined, etc.
