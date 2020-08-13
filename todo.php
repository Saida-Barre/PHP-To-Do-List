<?php
session_start(); // session_start() is required for us to access any values stored in this user's session.
// Note: we are not including todo-history.php, because we aren't using our "showTodoHistory()" function in this file.
global $title;
$title = 'PHP To-Do App';
include 'templates/header.php';
?>

  <h1><?php echo $title; ?></h1>

  <?php
    // $_POST $_GET
    echo '<pre>'; // var_dump outputs all the info for the variable and/or expression we pass it!
    var_dump( $_GET );
    echo '</pre>';

    // Prepare to store some warnings for the user...
    $warnings = array();

    // Check if the form fields are all submitted...
    /**
     * isset() Checks to see if a value is declared / defined at all.
     * empty() Checks to see if a value is an empty string, zero, or the array has no elements.
     */
    if ( isset( $_GET['newTask'] ) && !empty( $_GET['newTask'] ) ) {
      $newTask = (string) $_GET['newTask']; // We can type-cast this to a text using (string) before the value. 
    } else {
      $warnings[] = 'input is missing.'; // array_push( $warnings, 'New warning.' )
    }
  
    // Make sure we have values we can use.
    if ( isset( $newTask ) && isset( $addBtn ) && isset( $activeList ) && isset( $completedList ) && isset( $listItem ) ) {
        echo "variables 'newTask', 'addBtn', 'activeList', 'completedTask' is set";
        }

      // Check if our result is available.
      if ( isset( $result ) ) {
        // If we want to push to an array... it needs to be an array! Let's make sure it is the proper data-type if it isn't already defined.
        if ( !isset( $_SESSION['todo-history'] ) || empty( $_SESSION['todo-history'] ) ) {
          $_SESSION['todo-history'] = array();
        }
        array_push( // Add this result to the 'todo-history' session array.
          $_SESSION['todo-history'],
          "$newTask $addBtn $activeList $completedList $listItem = $result"
        );
      }
    }
  ?>

  <h2>PHP To-Do Form</h2>
  <form action="todo.php" method="GET">
    <?php if ( !empty( $warnings ) ) : ?>
      <ul>
        <?php foreach ( $warnings as $warning ) : ?>
          <li>
            <?php echo $warning; ?>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
    <ul>
        <?php foreach ( $activeList as $listItem ) : ?>
          <li>
            <?php echo $listItem; ?>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
    <h1>TO-DO APP</h1>
    <form>
        <label for="newTask">
        New Task:
        </label>
        <input type="text" name="newTask" id="newTask"/>
        <button type="button" name="addBtn" id="addBtn" class="button">Add</button>
        <p id="error-out"></p>
    </form>
    <section class="main">
        <div class="todo-list box">
            <h2>Active To-Dos</h2>
            <ul id="activeList">

            </ul>
            </div>
            
            <div class="complete-list box">
            <h2>Completed To-Dos</h2>
            <ul id="completedList">

            </ul>  
            </div>
        </section>




<?php include 'templates/footer.php';