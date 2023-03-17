<form method="post" action="comment.php">
  <label for="name">Nom :</label>
  <input type="text" name="name" required>
  <br>
  <label for="email">Adresse email :</label>
  <input type="email" name="email" required>
  <br>
  <label for="comment">Commentaire :</label>
  <textarea name="comment" required></textarea>
  <br>
  <input type="submit" name="submit" value="Envoyer">
</form>