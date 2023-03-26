<!DOCTYPE html>
<html>
<head>
	<title>Pencarian Film</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
	<h1>Pencarian Film</h1>
	<form method="get" action="index.php">
		<input type="text" name="search" placeholder="Cari judul film...">
		<button type="submit">Cari</button>
	</form>
	<?php
		if(isset($_GET['search'])) {
			$search = $_GET['search'];
			$url = 'http://www.omdbapi.com/?apikey=202bed7d&s=' . urlencode($search);
			$data = file_get_contents($url);
			$result = json_decode($data, true);

			if($result['Response'] == 'False') {
				echo '<p>Tidak ada film yang ditemukan.</p>';
			} else {
				echo '<ul>';
				foreach($result['Search'] as $movie) {
					echo '<li><a href="detail.php?id=' . $movie['imdbID'] . '">' . $movie['Title'] . ' (' . $movie['Year'] . ') . <img src= "'.$movie['Poster'].'"></a></li>';
				}
				echo '</ul>';
			}
		}
	?>
</body>
</html>