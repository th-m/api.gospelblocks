<?php
class scriptureController {
  //
  // All Books
  //
  public function volumes($request, $response) {
    // Add functions
    $connectMe = "yes";
    require('includes/functions.php');

    // Users Query
    $volumes_qry = mysqli_query($link, "SELECT * FROM volumes ORDER BY id ASC;");
    while($row = mysqli_fetch_assoc($volumes_qry)) {
     $volumes[] = $row;
    }

    // Return Response
    $payload["message"] = "Success";
    $payload["volumes"] = $volumes;

    // status
    $status = 200;
    $status_message = "Success";

    // Set the response
    $response = $response->withJson($payload);
    $response = $response->withStatus($status, $status_message);

    // Return Response
    return $response;
  }

  //
  // All Books
  //
  public function allBooks($request, $response) {
    // Add functions
    $connectMe = "yes";
    require('includes/functions.php');

    // Users Query
    $books_qry = mysqli_query($link, "SELECT * FROM books ORDER BY id ASC;");
    while($row = mysqli_fetch_assoc($books_qry)) {
     $books[] = $row;
    }

    // Return Response
    $payload["message"] = "Success";
    $payload["books"] = $books;

    // status
    $status = 200;
    $status_message = "Success";

    // Set the response
    $response = $response->withJson($payload);
    $response = $response->withStatus($status, $status_message);

    // Return Response
    return $response;
  }
  //
  // Chapters by Book
  //
  public function books($request, $response, $args) {
    // Add functions
    $connectMe = "yes";
    require('includes/functions.php');

    $volume_id = $args['volume'];

    $vol_qry = mysqli_fetch_assoc(mysqli_query($link, "SELECT volume_title, volume_title_long FROM volumes WHERE id = $volume_id;"));
    $volume = array('id' => $volume_id, 'title' => $vol_qry['volume_title'], 'title_long' => $vol_qry['volume_title_long']);

    $book_qry = mysqli_fetch_assoc(mysqli_query($link, "SELECT book_title, book_title_long, book_title_short FROM books WHERE id = $book_id;"));
    $book = array('id' => $book_id, 'title' => $book_qry['book_title'], 'title_long' => $book_qry['book_title_long'], 'title_short' => $book_qry['book_title_short']);

    // Verses Query
    $qry = mysqli_query($link, "SELECT * FROM books WHERE volume_id = $volume_id;");
    $i=1;
    while($row = mysqli_fetch_assoc($qry)) {
     $row['id']=$i;
     $books[] = $row;
     $i += 1;
    }

    // Return Response
    $payload["message"] = "Success";
    $payload['volume'] = $volume;
    $payload["books"] = $books;
    $payload['test']='test';

    // status
    $status = 200;
    $status_message = "Success";

    // Set the response
    $response = $response->withJson($payload);
    $response = $response->withStatus($status, $status_message);

    // Return Response
    return $response;
  }

  //
  // Chapters by Book
  //
  public function chapters($request, $response, $args) {
    // Add functions
    $connectMe = "yes";
    require('includes/functions.php');

    $volume_id = $args['volume'];
    $book_id = $args['book'];


    $vol_qry = mysqli_fetch_assoc(mysqli_query($link, "SELECT volume_title, volume_title_long FROM volumes WHERE id = $volume_id;"));
    $volume = array('id' => $volume_id, 'title' => $vol_qry['volume_title'], 'title_long' => $vol_qry['volume_title_long']);
    $book_num_qry = mysqli_fetch_assoc(mysqli_query($link, "SELECT id from books where volume_id =$volume_id limit 1;"));
    $book_num = $book_num_qry['id'] + ($book_id - 1);
    $book_qry = mysqli_fetch_assoc(mysqli_query($link, "SELECT book_title, book_title_long, book_title_short FROM books WHERE id = $book_num;"));
    $book = array('id' => $book_id, 'title' => $book_qry['book_title'], 'title_long' => $book_qry['book_title_long'], 'title_short' => $book_qry['book_title_short']);

    // Verses Query
    $qry = mysqli_query($link, "SELECT chapter FROM verses WHERE volume_id = $volume_id && book_id = $book_num GROUP BY chapter;");
    while($row = mysqli_fetch_assoc($qry)) {
     $chapters[] = $row;
    }

    // Return Response
    $payload["message"] = "Success";
    $payload['volume'] = $volume;
    $payload['book'] = $book;
    $payload["chapters"] = $chapters;

    // status
    $status = 200;
    $status_message = "Success";

    // Set the response
    $response = $response->withJson($payload);
    $response = $response->withStatus($status, $status_message);

    // Return Response
    return $response;
  }
  
  //
  // All Books
  //
  public function chapterVerses($request, $response, $args) {
    // Add functions
    $connectMe = "yes";
    require('includes/functions.php');

    $volume_id = $args['volume'];
    $book_id = $args['book'];
    $chapter_id = $args['chapter'];

    $vol_qry = mysqli_fetch_assoc(mysqli_query($link, "SELECT volume_title, volume_title_long FROM volumes WHERE id = $volume_id;"));
    $volume = array('id' => $volume_id, 'title' => $vol_qry['volume_title'], 'title_long' => $vol_qry['volume_title_long']);
    $book_num_qry = mysqli_fetch_assoc(mysqli_query($link, "SELECT id from books where volume_id =$volume_id limit 1;"));
    $book_num = $book_num_qry['id'] + ($book_id - 1);
    $book_qry = mysqli_fetch_assoc(mysqli_query($link, "SELECT book_title, book_title_long, book_title_short FROM books WHERE id = $book_num;"));
    $book = array('id' => $book_id, 'title' => $book_qry['book_title'], 'title_long' => $book_qry['book_title_long'], 'title_short' => $book_qry['book_title_short']);

    // Verses Query
    $qry = mysqli_query($link, "SELECT * FROM verses WHERE volume_id = $volume_id && book_id = $book_num && chapter = $chapter_id ORDER BY id ASC;");
    while($row = mysqli_fetch_assoc($qry)) {
     $verses[] = $row;
    }

    // Return Response
    $payload["message"] = "Success";
    $payload['volume'] = $volume;
    $payload['book'] = $book;
    $payload["verses"] = $verses;

    // status
    $status = 200;
    $status_message = "Success";

    // Set the response
    $response = $response->withJson($payload);
    $response = $response->withStatus($status, $status_message);

    // Return Response
    return $response;
  }
} // END class
?>
