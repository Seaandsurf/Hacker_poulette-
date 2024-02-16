<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script defer src="script.js"></script>   
    <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://www.google.com/recaptcha/enterprise.js" async defer></script>
    <title>Hacker Poulette</title>
    </head>

<body>

<?php
// session.start();
//     require 'vendor/autoload.php';
        
//      use PHPMailer\PHPMailer\PHPMailer;
//      use PHPMailer\PHPMailer\Exception;


$servername = "localhost";
$username = "host";
$password = "";
$dbname = "instruction";

try {
    // On se connecte à MySQL
    $bdd = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    echo "Erreur : " . $e->getMessage();
}



// CSRF Protection 
// function generate_csrf_token() {
//     return bin2hex(random_bytes(16));
// }

// if (!isset($_SESSION)) {
//     session_start();
// }

// $_SESSION['csrf_token'] = generate_csrf_token();


// Traitement pour ajout l'ajout au formulaire
require_once 'recaptcha/autoload.php';
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
 
 
//  if (!isset($_POST['csrf_token']) || !hash_equals($_POST['csrf_token'], $_SESSION['csrf_token'])) {
//     die('Invalid CSRF token');
// }

        
 require 'vendor/autoload.php';
if (isset($_POST['submit'])) {
    $recaptcha = new \ReCaptcha\ReCaptcha('6LfBPXIpAAAAAFfcJH4IVldbL5eFTa_Z1JeQc0zi');
    $gRecaptchaResponse = $_POST['g-recaptcha-response'];
    
    $resp = $recaptcha->setExpectedHostname('ysora.be')
                      ->verify($gRecaptchaResponse, $remoteIp);
    if ($resp->isSuccess()) {
       echo "success";
    } else {
        $errors = $resp->getErrorCodes();
    }
    
    
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = $_POST['mail'];
    $fil = $_POST['file'];
    $description = $_POST['description'];
    
    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    
    // Lire le contenu du fichier
    $file_content = file_get_contents($file_tmp);
    
//injection SQL protection ------
        $insertQuery = "INSERT INTO costumer_info (nom, prenom, mail, file, description) VALUES (:nom, :prenom, :mail, :file , :description)";
        $insertStatement = $bdd->prepare($insertQuery);
        $insertStatement->bindParam(':nom', $nom);
        $insertStatement->bindParam(':prenom', $prenom);
        $insertStatement->bindParam(':mail', $mail);
        $insertStatement->bindParam(':file',  $file_content);
        $insertStatement->bindParam(':description', $description);
        
        
        $insertStatement->execute();
        
     

    

if (isset($_POST['submit'])) {
    $recaptcha = new \ReCaptcha\ReCaptcha('6LfBPXIpAAAAAFfcJH4IVldbL5eFTa_Z1JeQc0zi');
    $gRecaptchaResponse = $_POST['g-recaptcha-response'];
    
    $resp = $recaptcha->setExpectedHostname('ysora.be')->verify($gRecaptchaResponse, $remoteIp);
    
    if ($resp->isSuccess()) {
        echo "success";
    } else {
        $errors = $resp->getErrorCodes();
    }
    
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = $_POST['mail'];
    $description = $_POST['description'];
    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    
    // Lire le contenu du fichier
    $file_content = file_get_contents($file_tmp);
    
    // Insertion des données dans la base de données
    $insertQuery = "INSERT INTO costumer_info (nom, prenom, mail, file, description) VALUES (:nom, :prenom, :mail, :file , :description)";
    $insertStatement = $bdd->prepare($insertQuery);
    $insertStatement->bindParam(':nom', $nom);
    $insertStatement->bindParam(':prenom', $prenom);
    $insertStatement->bindParam(':mail', $mail);
    $insertStatement->bindParam(':file',  $file_content);
    $insertStatement->bindParam(':description', $description);
    $insertStatement->execute();
    
    // // Envoi de l'e-mail avec PHPMailer
    // $mailer = new PHPMailer(true);

    // // Paramètres du serveur SMTP
    // $mailer->isSMTP();
    // $mailer->Host = 'smtp.gmail.com';
    // $mailer->SMTPAuth = true;
    // $mailer->Username = 'huseyinsasmaz2001@gmail.com'; // Votre adresse Gmail
    // $mailer->Password = 'xxxx'; // Votre mot de passe Gmail
    // $mailer->SMTPSecure = 'tls';
    // $mailer->Port = 587;

    // // Destinataire, sujet, corps du message
    // $mailer->setFrom('poulettehackers@gmail.com', 'Hackers Poulette');
    // $mailer->addAddress($mail); // Utilisation de l'adresse e-mail récupérée depuis le formulaire
    // $mailer->Subject = 'Confirmation de réception';
    // $mailer->Body = 'Votre message a bien été reçu. Merci !';

    // // Envoi du message
    // $mailer->send();
}

         header('Location: ' . $_SERVER['PHP_SELF']);
    }

?>

         <form class="max-w-md mx-auto relative overflow-hidden z-10 bg-white p-8 rounded-lg shadow-md before:w-24 before:h-24 before:absolute before:bg-purple-500 before:rounded-full before:-z-10 before:blur-2xl after:w-32 after:h-32 after:absolute after:bg-sky-400 after:rounded-full after:-z-10 after:blur-xl after:top-24 after:-right-12" onsubmit="return verifierInput(event)" method="post" action="" enctype="multipart/form-data">
             <!--<input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">-->
            <h1 class="text-2xl text-sky-900 text-center font-bold mb-6">Hacker Poulette</h1>
            


    <!-- Name -->
        <label class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-gray-600" for="nom">Nom:</label>
        <input class="mt-1 p-2  w-full border rounded-md" type="text" id="name" placeholder="Nom" name="nom">  <br>
        <span id="errorName"></span><br>

    <!-- Prenom -->
        <label class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-gray-600" for="prenom">Prenom:</label>
        <input class="mt-1 p-2  w-full border rounded-md" type="text" id="firstname" placeholder="Prenom" name="prenom">  <br>
        <span id="errorFirstname"></span><br>

    <!-- E-mail -->
        <label class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-gray-600" for="mail">E-mail:</label>
        <input class="mt-1 p-2  w-full border rounded-md" type="text" id="mail" placeholder="hacker@poulette.be" name="mail">  <br>
        <span id="errorMail"></span><br>

    <!-- File -->
        <label class="block text-sm font-medium text-gray-600" for="file">File:</label>
        <input class="block  w-full text-sm text-slate-500
      file:mr-4 file:py-2 file:px-4
      file:rounded-full file:border-0
      file:text-sm file:font-semibold
      file:bg-violet-50 file:text-violet-700
      hover:file:bg-violet-100" type="file" id="file" name="file" accept=".jpg, .jpeg, .png, .gif"><br>
        <span id="errorFile"></span><br>

    <!-- Description -->
            <label class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-gray-600" for="Description">Description:</label>

        <textarea class="mt-1 p-2  w-full border rounded-md"
        rows="3" type="text" placeholder="Description" name="description" id="description"></textarea>  <br>
        <span id="errorDescription"></span><br>
        
    <!-- Captcha -->
    <div class="flex justify-center">
         <div class="g-recaptcha" data-sitekey="6LfBPXIpAAAAAFfcJH4IVldbL5eFTa_Z1JeQc0zi" data-action="LOGIN"></div>
</div>

    <!-- Confirmation -->
    <div class="flex justify-center">
        <input class="[background:linear-gradient(144deg,#af40ff,#5b42f3_50%,#00ddeb)] w-1/3 text-white px-4 py-2 mt-3 font-bold rounded-md hover:opacity-80" type="submit" name="submit" value="Ajouter" class="bg-sky-500 hover:bg-sky-700">
</div>
    <p class="before:content-['*'] before:ml-0.5 before:text-red-500 text-right"> Champs obligatoire.</p>
    </form>

   
</body>

</html>







