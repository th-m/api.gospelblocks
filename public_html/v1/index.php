<?php
// Main SLIM Framework PSR-7 Functions
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Load Main Slim Framework Files
require('vendor/autoload.php');

$app = new \Slim\App;

$app->get('/', function($request, $response) {
  $payload['message'] = ['message' => 'Welcome to the Gospel Blocks API v1!'];
  $response->withJson($payload);
});

//
// Require Controllers
//
require('controllers/scripturesController.php');
require('controllers/boardsController.php');

//
// Scripture Routes
//

// All Volumes
$app->get('/volumes', '\scriptureController:volumes');
// Books in Volume
$app->get('/volume/{volume}', '\scriptureController:books');
// Chapters in Book
$app->get('/volume/{volume}/book/{book}', '\scriptureController:chapters');
// Verses in Chapter
$app->get('/volume/{volume}/book/{book}/chapter/{chapter}', '\scriptureController:verses');

//
// Search Functions
//
$app->get('/search/{string}', '\scriptureController:searchSciptures');
$app->get('/search/{string}/{page}', '\scriptureController:searchSciptures');
$app->get('/search/{string}/{volumeId}/{page}', '\scriptureController:searchSciptures');
$app->get('/search/{string}/{volumeId}/{bookId}/{page}', '\scriptureController:searchSciptures');
$app->get('/search/{string}/{volumeId}/{bookId}/{chapterId}/{page}', '\scriptureController:searchSciptures');
// $app->get('search/volume/{volume}/{search_string}', '\scriptureController:searchScipturesVolume');
// $app->get('search/volume/{volume}/book/{book}/{search_string}', '\scriptureController:searchScipturesBook');
// $app->get('search/volume/{volume}/book/{book}/chapter/{chapter}/{search_string}', '\scriptureController:searchScipturesChapter');
//
// User's Board/Blocks Routes
//

// User's Boards
// $app->get('/users/{user}/boards', '\boardsController:usersBoards');
// User's Blocks in Board
// $app->get('/users/{user}/board/{board_id}', '\boardsController:usersBoardInfo');
// User's Verses in Block
// $app->get('/users/{user}/board/{board_id}/block/{block_id}', '\boardsController:usersBoardBlockInfo');

// $app->get('/users/{user}/block/{block_id}', '\boardsController:usersBoardBlockInfo');

// Get Blocks Pinned to Dashboard
$app->get('/users/{user}/pinned', '\boardsController:usersPinnedBlocks');

// See Child Blocks and Meta data
$app->get('/users/{user}/block/{block_id}', '\boardsController:usersBlockInfo');

// See Verses associated with stored block
$app->get('/users/{user}/block/{block_id}/verses', '\boardsController:usersBlockVerses');

//
// Run the Slim App
//
$app->run();
