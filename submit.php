<?php
// Check for empty fields
if (empty($_POST['name']) || empty($_POST['rating']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    echo "No arguments Provided!";
    return false;
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$rating = strip_tags(htmlspecialchars($_POST['rating']));
$message = strip_tags(htmlspecialchars($_POST['message']));

require_once('dbconfig.php');
try {
    $dbh = new PDO($driver, $user, $pass, $attr);
    $stmt = $dbh->prepare('INSERT INTO `waysmeet` (`name`, `email`, `rating`, `message`) VALUES (:name, :email, :rating, :message)');
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email_address);
    $stmt->bindParam(':rating', $rating);
    $stmt->bindParam(':message', $message);
    $stmt->execute();
    unset($stmt);
    unset($dbh);
    return true;
} catch (Exception $e) {
    return false;
}
?>
