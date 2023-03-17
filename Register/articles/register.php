<?php
// Démarrage de la session
session_start();

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=nom_de_la_base_de_donnees', 'nom_utilisateur', 'mot_de_passe');

// Vérification si le formulaire a été soumis
if (isset($_POST['submit'])) {
  // Récupération des données du formulaire
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  // Vérification si l'utilisateur existe déjà
  $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ? OR email = ?');
  $stmt->execute([$username, $email]);
  $user = $stmt->fetch();

  if ($user) {
    // Erreur : l'utilisateur existe déjà
    $error = 'Un utilisateur avec ce nom d\'utilisateur ou cette adresse e-mail existe déjà.';
  } else {
    // Ajout de l'utilisateur à la base de données
    $stmt = $pdo->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
    $stmt->execute([$username, $email, $password]);

    // Connexion automatique de l'utilisateur
    $user_id = $pdo->lastInsertId();
    $_SESSION['user_id'] = $user_id;

    // Redirection vers la page de tableau de bord
    header('Location: dashboard.php');
    exit();
  }
}
?>

<!-- Affichage des erreurs -->
<?php if (isset($error)): ?>
  <div><?php echo $error; ?></div>
<?php endif; ?>