<?php

//redirects if url was messed if
if (!isset($_GET['dvd_title'])) {
  header('Location: index.php');
}

$host = 'itp460.usc.edu';
$database_name = 'dvd';
$username = 'student';
$password = 'ttrojan';

$dvd_title = $_GET['dvd_title']; // $_REQUEST['artist']

$pdo = new PDO("mysql:host=$host;dbname=$database_name", $username, $password);

//title, genre, format, rating
$sql = "
  SELECT title, genre_name, format_name, rating_name
  FROM dvds
  INNER JOIN genres
  ON dvds.genre_id = genres.id
  INNER JOIN formats
  ON dvds.format_id = formats.id
  INNER JOIN ratings
  on dvds.rating_id = ratings.id
  WHERE title LIKE ?
";

$statement = $pdo->prepare($sql);
$like = '%' . $dvd_title . '%';
$statement->bindParam(1, $like);
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_OBJ);

?>

<!-- prints out what they searched -->
<h3> You searched for "<?php echo $dvd_title ?>":</h3>

<!--loops through the results and prints them out if there are any-->
<?php if(count($results) == 0 || empty($dvd_title) ): ?>
  <!--displays message with nothing found and link back to index-->
  <h2> Nothing was found! <a href="index.php">Click here to go back to search again.</a></h2>
<?php else: ?>
  <?php foreach($results as $result) : ?>
    <h3>
      <?php echo $result->title ?>
    </h3>
    <p>Genre: <?php echo $result->genre_name ?></p>
    <p>Format: <?php echo $result->format_name ?></p>
    <p>Rating: <a href="ratings.php?rating=<?php echo $result->rating_name ?>"> View other <?php echo $result->rating_name ?> rated movies.</a></p>
    </br>
  <?php endforeach; ?>
<?php endif; ?>