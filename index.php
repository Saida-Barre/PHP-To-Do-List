<?php
// Start our session, and declare our history function.
include 'includes/todo-history.php';
global $title; // Try to avoid globals, as they are harder to troubleshoot and track through your application.
$title = 'PHP To-Do App'; // $GLOBALS['title'] = 'PHP Homepage';
include 'templates/header.php';
?>

  <h1><?php echo $title; ?></h1>

  <h2>To-Do History</h2>
  <?php showtodoHistory(); // (Defined in todo-history.php) ?>

<?php include 'templates/footer.php';