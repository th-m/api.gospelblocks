<?php
class booksController {
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
} // END class
?>
