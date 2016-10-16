<?php
class boardsController {
  //
  // All Books
  //
  public function usersBoards($request, $response, $args) {
    // Add functions
    $connectMe = "yes";
    require('includes/functions.php');
    $user_id = $args['user'];
    // Users Query


    $users_boards_qry = mysqli_query($link, "SELECT * FROM users_boards WHERE user_id =$user_id;");
    while($row = mysqli_fetch_assoc($users_boards_qry)) {
      $row_id = $row['board_id'];
      $users_boards[$row_id] = $row;
      $board_info_qry = mysqli_query($link, "SELECT * FROM boards WHERE id = $row_id;");
      while($info_row = mysqli_fetch_assoc($board_info_qry)) {
         $users_boards[$row_id]['board_info'] = $info_row;
      }
    }

    // Return Response
    $payload["message"] = "Success";
    $payload["users_boards"] = $users_boards;


    // status
    $status = 200;
    $status_message = "Success";

    // Set the response
    $response = $response->withJson($payload);
    $response = $response->withStatus($status, $status_message);

    // Return Response
    return $response;
  }

  public function usersBoardInfo($request, $response, $args) {
    // Add functions
    $connectMe = "yes";
    require('includes/functions.php');
    $user_id = $args['user'];
    $board_id = $args['board_id'];
    // Users Query
    $board_info = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM boards WHERE id = $board_id;"));

    $blocks_qry = mysqli_query($link, "SELECT * FROM blocks WHERE board_id =$board_id;");
    while($row = mysqli_fetch_assoc($blocks_qry)) {
      $users_blocks[] = $row;
    }

    // Return Response
    $payload["message"] = "Success";
    $payload["board_info"] = $board_info;
    $payload["users_blocks"] = $users_blocks;
    // $payload["test_id"] = $user_id;
    // $payload["test_board"] = $board_id;



    // status
    $status = 200;
    $status_message = "Success";

    // Set the response
    $response = $response->withJson($payload);
    $response = $response->withStatus($status, $status_message);

    // Return Response
    return $response;
  }

  public function usersBoardBlockInfo($request, $response, $args) {
    // Add functions
    $connectMe = "yes";
    require('includes/functions.php');
    $user_id = $args['user'];
    $board_id = $args['board_id'];
    $block_id = $args['block_id'];
    // Users Query
    $board_info = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM boards WHERE id = $board_id;"));
    $block_info = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM blocks WHERE id = $block_id;"));

    $block_verses_qry = mysqli_query($link, "SELECT block_verses.*, verses.verse_scripture, verses.verse_title_short FROM block_verses LEFT JOIN verses ON verses.id = block_verses.verse_id WHERE block_verses.block_id = $block_id ORDER BY sequence ASC;");
    while($row = mysqli_fetch_assoc($block_verses_qry)) {
      $block_verses[] = $row;
    }

    // Return Response
    $payload["message"] = "Success";
    $payload["board_info"] = $board_info;
    $payload["block_info"] = $block_info;
    $payload["block_verses"] = $block_verses;
    // $payload["test_id"] = $user_id;
    // $payload["test_board"] = $board_id;



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
