<?php
include "connection.php";
include "Employeer.php";

if (isset($_POST['submit'])) {
    $employeer = new Employeer($mysqli);

    $employeer->name = $_POST['name'];
    $employeer->age = $_POST['age'];
    $employeer->job = $_POST['job'];
    $employeer->salary = $_POST['salary'];
    $employeer->admission_date = $_POST['admission_date'];
    $set = $employeer->set();

    if ($set){ 
        $msg = "<div class='alert alert-success' role='alert'>Funcionário inserido com sucesso!</div>"; 
    } else { 
        $msg = "<div class='alert alert-danger' role='alert'>Falha ao inserir funcionário!</div>";
    } 
} 
?>
<html>
<head>
<title>Forms</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
<div class="container">
</br>
<?php echo isset($msg) ? $msg : ''; ?>
<form action="<?php $PHP_SELF; ?>" method="POST">
  <div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" class="form-control">
  </div>
  <div class="mb-3">
    <label class="form-label">Age</label>
    <input type="text" name="age" class="form-control">
  </div>
  <div class="mb-3">
    <label class="form-label">Job</label>
    <input type="text" name="job" class="form-control">
  </div>
  <div class="mb-3">
    <label class="form-label">Salary</label>
    <input type="text" name="salary" class="form-control">
  </div>
  <div class="mb-3">
    <label class="form-label">Admission Date</label>
    <input type="date" name="admission_date" class="form-control">
  </div>
  <div class="mb-3 form-check">
  <button name="submit" type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</body>
</html>
