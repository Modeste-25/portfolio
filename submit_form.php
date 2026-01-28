<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio créatif</title>
</head>
<body>
     <form id="contactForm" action="submit_form.php" method="POST" novalidate></form>
     <?php
$serveur = "localhost"; 
$login = "root";
try {
    $pdo = new PDO("mysql:host=$serveur;dbname=contact", $login);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = htmlspecialchars(trim($_POST['nom']));
        $email = htmlspecialchars(trim($_POST['mail']));
        $message = htmlspecialchars(trim($_POST['message']));

        $stmt = $pdo->prepare("INSERT INTO contacts (nom, mail, message) VALUES (:name, :email, :message)");
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(': message', $message);

        if ($stmt->execute()) {
            echo "Votre message a été envoyé avec succès.";
        } else {
            echo "Une erreur s'est produite. Veuillez réessayer.";
        }
    }
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>
</body>
</html>