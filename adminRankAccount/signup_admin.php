
<?php
// Script pour ajouter un utilisateur en tant qu'administrateur

$json = '../configs/config.json';

$json_bd = file_get_contents($json);

$bd = json_decode($json_bd, true);

$host = $bd['host'];
$port = $bd['port'];
$db_name = 'wolfgameinc';
$username = $bd['user'];
$password = $bd['password'];
$conn = new PDO("mysql:host=$host;port=$port;dbname=$db_name", $username, $password);


echo "Entrez le prénom de l'utilisateur : ";
$name = trim(fgets(STDIN));

echo "Entrez le nom de l'utilisateur : ";
$lastname = trim(fgets(STDIN));

echo "Entrez l'adresse email de l'utilisateur : ";
$email = trim(fgets(STDIN));
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "L'adresse email n'est pas valide.\n";
    exit;
}

$status_email = $conn->prepare("SELECT * FROM user WHERE email = :email");
$status_email->bindParam(':email', $email);
$status_email->execute();

if ($status_email->rowCount() > 0) {
    echo "L'adresse email est déjà utilisée.\n";
    exit;
}

echo "Entrez l'adresse de l'utilisateur : ";
$address = trim(fgets(STDIN));

echo "Entrez le mot de passe : ";
$password = trim(fgets(STDIN));

echo "Entrez le mot de passe à nouveau : ";
$password_confirm = trim(fgets(STDIN));

if($password !== $password_confirm) {
    echo "Les mots de passe ne correspondent pas.";
    exit;
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

try {
    
    $stmt = $conn->prepare("INSERT INTO user (name,lastname,email,address, password, role) VALUES (:name, :lastname, :email,:address, :password, 1)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->execute();
    echo "L'administrateur a été ajouté avec succès.\n";
}  catch(PDOException $e) {
    echo "Une erreur est survenue : " . $e->getMessage();
}

?>