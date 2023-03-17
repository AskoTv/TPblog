<?php
// Démarrage de la session
session_start();

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=nom_de_la_base_de_donnees', 'nom_utilisateur', 'mot_de_passe');

// Vérification si le formulaire a été soumis
if (isset($_POST['submit'])) {
  // Récupération des données du formulaire
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Vérification des informations d'identification
  $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
  $stmt->execute([$username]);
  $user = $stmt->fetch();

  if ($user && password_verify($password, $user['password'])) {
    // Connexion réussie
    $_SESSION['user_id'] = $user['id'];
    header('Location: dashboard.php');
    exit();
  } else {
    // Connexion échouée
    $error = 'Nom d\'utilisateur ou mot de passe incorrect.';
  }
}
?>

<!-- Affichage des erreurs -->
<?php if (isset($error)): ?>
  <div><?php echo $error; ?></div>
<?php endif; ?>