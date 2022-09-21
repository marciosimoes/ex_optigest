<?php
include "connection.php";
include "Employeer.php";

echo "<h2>TESTE DOS MÉTODOS</h2>";

$employeer = new Employeer($mysqli);
$employeer->id = 1; #seta funcionario 1 para exemplos

echo "###############################################################<br>";

#get do funcionário
$employeer->get();
echo "# Informações do funcionário #1:<br>";
echo "# " . $employeer->id . " | " . $employeer->name . " | " . $employeer->age . " | " . $employeer->job . " | " . $employeer->salary . "<br>";
echo "###############################################################<br>";

#média de idade dos empregados
$avg = $employeer->age_avg();
echo "# Média de idade dos empregados = " . $avg . "<br>";
echo "###############################################################<br>";

#incremento de salário
$new_salary = $employeer->salary_increment(10);
echo "# 10% para o funcionário #1 = " . $new_salary ." (atual de 1200)<br>";
echo "###############################################################<br>";

#lista de funcionarios e suas funções
$functions = $employeer->functions();
echo "# Lista de funcionários e suas funções:<br>";
foreach ($functions as $row) {
    echo "# " . $row['id'] . " | " . $row['name'] . " | " . $row['job'] . "<br>";
}
echo "###############################################################<br>";

#lista dos projetos finalizados
$projects = $employeer->projects_done_thisyear();
echo "# Lista de projetos finalizados no ano corrente:<br>";
foreach ($projects as $row) {
    echo "# " . $row['id'] . " | " . $row['id_employee'] . " | " . $row['description'] . " | " . $row['value'] . " | " . $row['status'] . " | " . $row['delivery_date'] . "<br>";
}
echo "###############################################################<br>";

#lista dos projetos a entregar agrupado por empregado 
$projects = $employeer->projects_soon("2022-09-01", "2022-10-01");
echo "# Lista de projetos a entregar entre 2022-09-01 e 2022-10-01:<br>";
foreach ($projects as $row) {
    echo "# " . $row['id'] . " | " . $row['description'] . " | " . $row['value'] . " | " . $row['status'] . " | " . $row['delivery_date'] . "<br>";
}
echo "###############################################################<br>";
