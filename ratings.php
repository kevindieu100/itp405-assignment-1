<?php

//redirects if url was messed with
if (!isset($_GET['rating'])) {
  header('Location: index.php');
}

$host = 'itp460.usc.edu';
$database_name = 'dvd';
$username = 'student';
$password = 'ttrojan';

$rating_clicked = $_GET['rating']; //retrieves the rating that they clicked

$pdo = new PDO("mysql:host=$host;dbname=$database_name", $username, $password);

//title, genre, format, rating
$sql = "
  SELECT title, rating_name, genre_name, format_name
  FROM dvds
  INNER JOIN genres
  ON dvds.genre_id = genres.id
  INNER JOIN formats
  ON dvds.format_id = formats.id
  INNER JOIN ratings
  on dvds.rating_id = ratings.id
  WHERE rating_name LIKE ?
";

$statement = $pdo->prepare($sql);
$like = '%' . $rating_clicked . '%';
$statement->bindParam(1, $like);
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_OBJ);

?>

<!-- prints out what they searched -->
<h2> Results for other movies rated "<?php echo $rating_clicked ?>":</h2>

<!--prints out the title of the other movie titles with that rating-->
<ul>
  <?php foreach($results as $result) : ?>
    <li>
      <h3>
        <?php echo $result->title ?>
      </h3>
      <p>Genre: <?php echo $result->genre_name ?></p>
      <p>Format: <?php echo $result->format_name ?></p> 
    </li>
  <?php endforeach; ?>
</ul>