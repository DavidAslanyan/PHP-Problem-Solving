<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP in HTML</title>
</head>
<body>
    <?php 
      session_start();

      $BASE_URL = "to-do";

      function clear() {
        unset($_SESSION["tasks"]);
      }

      if (!isset($_SESSION["tasks"])) {
        $_SESSION["tasks"] = [];
      }

      $tasks = $_SESSION["tasks"];

      if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["task"])) {
        $new_task = trim($_POST["task"]);

        if (!empty($new_task)) {
          $_SESSION["tasks"][] = htmlspecialchars($new_task);
        }

        header("Location: " . $BASE_URL . ".php");
        exit();
      }

      if (isset($_POST['clear_tasks'])) {
        clear(); 
        header("Location: " . $BASE_URL . ".php");
        exit();
      }

      if (isset($_GET["delete"])) {
        $task = $_GET["delete"];
        unset($_SESSION["tasks"][$task]);
        $_SESSION["tasks"] = array_values($_SESSION['tasks']);

        header("Location: " . $BASE_URL . ".php");
        exit();
      }

    ?>

    <form method="POST">
      <label for="Enter a Task"></label>
      <input name="task" type="text" placeholder="Type here...">
      <button type="submit">Add</button>
    </form>

    <?php if (count($tasks) > 0) { ?>
      <ul>
        <?php for ($i = 0; $i < count($tasks); $i++) { ?>
        <li>
          <span><?php echo $i + 1; ?>. </span> <?php echo $tasks[$i];?>
          <a href="?delete=<?php echo $i ?>">❌</a>
        </li>
        <?php } ?>
      </ul>

      <form method="POST">
        <button name="clear_tasks" type="submit">Clear Tasks</button>
      </form>
    <?php } ?>

</body>
</html>