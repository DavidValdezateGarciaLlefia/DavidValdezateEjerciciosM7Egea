<?php
// function to generate ratings
function generate_ratings($rating) {
    $movie_rating = '';
    for ($i = 0; $i < $rating; $i++) {
        $movie_rating .= '<img src="star.png" alt="star"/>';
    }
    return $movie_rating;
}

// take in the id of a director and return his/her full name
function get_director($director_id) {
    global $db;
    $query = 'SELECT people_fullname FROM people WHERE people_id = ' . $director_id;
    $result = mysqli_query($db, $query) or die(mysql_error($db));
    $row = mysqli_fetch_assoc($result);
    extract($row);
    return $people_fullname;
}

// take in the id of a lead actor and return his/her full name
function get_leadactor($leadactor_id) {
    global $db;
    $query = 'SELECT people_fullname FROM people WHERE people_id = ' . $leadactor_id;
    $result = mysqli_query($db, $query) or die(mysql_error($db));
    $row = mysqli_fetch_assoc($result);
    extract($row);
    return $people_fullname;
}

// take in the id of a movie type and return the meaningful textual description
function get_movietype($type_id) {
    global $db;
    $query = 'SELECT movietype_label FROM movietype WHERE movietype_id = ' . $type_id;
    $result = mysqli_query($db, $query) or die(mysql_error($db));
    $row = mysqli_fetch_assoc($result);
    extract($row);
    return $movietype_label;
}

// function to calculate if a movie made a profit, loss, or just broke even
function calculate_differences($takings, $cost) {
    $difference = $takings - $cost;
    if ($difference < 0) {
        $color = 'red';
        $difference = '$' . abs($difference) . ' million';
    } elseif ($difference > 0) {
        $color = 'green';
        $difference = '$' . $difference . ' million';
    } else {
        $color = 'blue';
        $difference = 'broke even';
    }
    return '<span style="color:' . $color . ';">' . $difference . '</span>';
}

// Connect to MySQL
$db = mysqli_connect('localhost', 'root', 'root') or die('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'moviesite') or die(mysql_error($db);

// Retrieve information
$query = 'SELECT
        movie_name, movie_year, movie_director, movie_leadactor,
        movie_type, movie_running_time, movie_cost, movie_takings
    FROM
        movie
    WHERE
        movie_id = ' . $_GET['movie_id'];
$result = mysqli_query($db, $query) or die(mysql_error($db));

$row = mysqli_fetch_assoc($result);
$movie_name = $row['movie_name'];
$movie_director = get_director($row['movie_director']);
$movie_leadactor = get_leadactor($row['movie_leadactor']);
$movie_year = $row['movie_year'];
$movie_running_time = $row['movie_running_time'] . ' mins';
$movie_takings = $row['movie_takings'] . ' million';
$movie_cost = $row['movie_cost'] . ' million';
$movie_health = calculate_differences($row['movie_takings'], $row['movie_cost']);

// Display the information
echo <<<ENDHTML
<html>
<head>
  <title>Details and Reviews for: $movie_name</title>
  <style>
    .odd-row {
      background-color: #f2f2f2; /* Light gray background for odd rows */
    }
    .even-row {
      background-color: #ffffff; /* White background for even rows */
    }
  </style>
</head>
<body>
<div style="text-align: center;">
   <h2>$movie_name</h2>
   <h3><em>Details</em></h3>
   <table cellpadding="2" cellspacing="2" style="width: 70%; margin-left: auto; margin-right: auto;">
    <tr>
     <td><strong>Title</strong></td>
     <td>$movie_name</td>
     <td><strong>Release Year</strong></td>
     <td>$movie_year</td>
    </tr>
    <tr>
     <td><strong>Movie Director</strong></td>
     <td>$movie_director</td>
     <td><strong>Cost</strong></td>
     <td>$$movie_cost</td>
    </tr>
    <tr>
     <td><strong>Lead Actor</strong></td>
     <td>$movie_leadactor</td>
     <td><strong>Takings</strong></td>
     <td>$$movie_takings</td>
    </tr>
    <tr>
     <td><strong>Running Time</strong></td>
     <td>$movie_running_time</td>
     <td><strong>Health</strong></td>
     <td>$movie_health</td>
    </tr>
    <tr>
     <td><strong>Average Rating</strong></td>
     <td colspan="3">$average_rating</td>
    </tr>
   </table>
</div>

ENDHTML;

// Retrieve reviews for this movie
$query = 'SELECT
        review_movie_id, review_date, reviewer_name, review_comment,
        review_rating
    FROM
        reviews
    WHERE
        review_movie_id = ' . $_GET['movie_id'];

// Handle sorting
$sort = $_GET['sort'] ?? ''; // Get the sorting parameter from the URL
if ($sort === 'date') {
    $query .= ' ORDER BY review_date';
} elseif ($sort === 'reviewer') {
    $query .= ' ORDER BY reviewer_name';
} elseif ($sort === 'comment') {
    $query .= ' ORDER BY review_comment';
} elseif ($sort === 'rating') {
    $query .= ' ORDER BY review_rating';
}

$result = mysqli_query($db, $query) or die(mysql_error($db);

// Display the reviews table with clickable column headings for sorting
echo <<<ENDHTML
<h3><em>Reviews</em></h3>
<table cellpadding="2" cellspacing="2" style="width: 90%; margin-left: auto; margin-right: auto;">
    <tr>
        <th style="width: 7em;"><a href="details.php?movie_id={$_GET['movie_id']}&sort=date">Date</a></th>
        <th style="width: 10em;"><a href="details.php?movie_id={$_GET['movie_id']}&sort=reviewer">Reviewer</a></th>
        <th><a href="details.php?movie_id={$_GET['movie_id']}&sort=comment">Comments</a></th>
        <th style="width: 5em;"><a href="details.php?movie_id={$_GET['movie_id']}&sort=rating">Rating</a></th>
    </tr>
ENDHTML;

$oddRow = true; // Initialize as true for the first row

while ($row = mysqli_fetch_assoc($result)) {
    $date = $row['review_date'];
    $name = $row['reviewer_name'];
    $comment = $row['review_comment'];
    $rating = $row['review_rating'];

    // Apply the "odd-row" or "even-row" class based on the $oddRow variable
    $rowClass = $oddRow ? 'odd-row' : 'even-row';
    $oddRow = !$oddRow; // Toggle for the next row

    echo <<<ENDHTML
    <tr class="$rowClass">
      <td style="vertical-align: top; text-align: center;">$date</td>
      <td style="vertical-align: top;">$name</td>
      <td style="vertical-align: top;">$comment</td>
      <td style="vertical-align: top;">$rating</td>
    </tr>
ENDHTML;
}

echo <<<ENDHTML
   </table>
</body>
</html>
ENDHTML;
?>