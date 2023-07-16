<?php 
  require_once 'scripts/inc.php'; 
  require_once 'scripts/connect.inc.php';
  $stm = $pdo->prepare("SELECT * FROM tasks WHERE idUser = :idUser ORDER BY createdAt DESC");
  $stm->bindValue(":idUser", $_SESSION['auth']['idUser'], PDO::PARAM_INT);
  $stm->execute();
  $tasks = $stm->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP MySQL CRUD</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a href="" class="navbar-brand">PHP MySQL CRUD</a>
      <a href="scripts/signout.php" class="btn btn-outline-dark" type="submit">SignOut</a>
    </div>
  </nav>
  <header class="header">
    <div class="container">
      <h3>Welcome <?php echo $_SESSION['auth']['firstname']." ".$_SESSION['auth']['lastname']; ?></h3>
    </div>
  </header>
  <!-- NEW TASK Modal -->
  <div class="modal fade" id="newTaskModal" tabindex="-1" aria-labelledby="newTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form action="scripts/addtask.php" method="post" class="modal-content needs-validation" novalidate>
        <div class="modal-header">
          <h1 class="modal-title fs-5 h3 fw-normal" id="newTaskModalLabel">Add new task</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="g-3">
            <div class="md-4">
              <label for="validationCustom01" class="form-label">Title</label>
              <input type="text" class="form-control" name="title" id="validationCustom01" placeholder="Your task title" required>
              <div class="invalid-feedback">
                Please provide a valid task title.
              </div>
            </div>
            <div class="md-4">
              <label for="validationCustom02" class="form-label">Description</label>
              <textarea class="form-control" name="description" id="validationCustom02" placeholder="Your task description" style="height: 100px" required></textarea>
              <div class="invalid-feedback">
                Please provide a valid task description.
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="addtask">Add task</button>
        </div>
      </form>
    </div>
  </div>
  <!-- UPDATE TASK Modal -->
  <div class="modal fade" id="updateTaskModal" tabindex="-1" aria-labelledby="updateTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form action="scripts/update.php" method="post" id="edit-form" class="modal-content needs-validation" novalidate>
        <div class="modal-header">
          <h1 class="modal-title fs-5 h3 fw-normal" id="updateTaskModalLabel">Update your task</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="g-3">
            <input type="hidden" class="form-control" name="idTask" value="">
            <div class="md-4">
              <label for="validationCustom01" class="form-label">Title</label>
              <input type="text" class="form-control" name="title" id="validationCustom01" value="" placeholder="Your task title" required>
              <div class="invalid-feedback">
                Please provide a valid task title.
              </div>
            </div>
            <div class="md-4">
              <label for="validationCustom02" class="form-label">Description</label>
              <textarea class="form-control" name="description" id="validationCustom02" placeholder="Your task description" style="height: 100px" required></textarea>
              <div class="invalid-feedback">
                Please provide a valid task description.
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="updatetask">Update task</button>
        </div>
      </form>
    </div>
  </div>
   <!-- DELETE TASK Modal -->
   <div class="modal fade" id="deleteTaskModal" tabindex="-1" aria-labelledby="deleteTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form action="scripts/delete.php" method="post" id="delete-form" class="modal-content needs-validation" novalidate>
        <div class="modal-header">
          <h1 class="modal-title fs-5 h3 fw-normal" id="deleteTaskModalLabel">Delete your task</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="g-3">
            <input type="hidden" class="form-control" name="idTask" value="">
          </div>
          <p>Are you sure you want to delete this task?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger" name="deletetask">Delete task</button>
        </div>
      </form>
    </div>
  </div>
  <section class="py-5 d-lg-flex justify-content-center align-items-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center mx-auto col-12">
          <?php if (isset($_SESSION['error'])): ?>
          <div class="alert alert-danger">
            <?php 
              echo $_SESSION['error'];
              unset($_SESSION['error']);
            ?>
          </div>
          <?php endif; ?>
          <?php if (isset($_SESSION['success'])): ?>
          <div class="alert alert-success">
            <?php 
              echo $_SESSION['success'];
              unset($_SESSION['success']);
            ?>
          </div>
          <?php endif; ?>
          <div class="d-sm-flex justify-content-between align-items-start">
            <div>
              <h4 class="card-title card-title-dash title">My tasks</h4>
            </div>
            <div>
              <button class="btn btn-primary btn-sm text-white mb-0 me-0" type="button" data-bs-toggle="modal" data-bs-target="#newTaskModal"></i>New task</button>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <td>Created At</td>
                  <td>Title</td>
                  <td>Description</td>
                  <td></td>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($tasks as $task): ?>
                <tr>
                  <td><?php echo $task['createdAt']; ?></td>
                  <td><?php echo $task['title']; ?></td>
                  <td><?php echo $task['description']; ?></td>
                  <td>
                    <button class="btn btn-sm btn-outline-warning" onclick="get_task(<?php echo $task['idTask']; ?>)">Update</button>
                    <button class="btn btn-sm btn-outline-danger" onclick="confirm_delete(<?php echo $task['idTask']; ?>)">Delete</button>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>          
        </div>
      </div>
    </div>
  </section>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/validate-form.js"></script>
  <script src="js/jquery.min.js"></script>
  <script src="js/script.js"></script>
</body>
</html>