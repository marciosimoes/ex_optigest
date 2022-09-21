<?php

class Employeer {
    public $name;
    public $age;
    public $job;
    public $salary;
    public $admission_date;
    public $id;
    public $mysqli;

    public function __construct($mysqli) {
        #pega a instancia do mysqli para trabalhar com o db
        $this->mysqli = $mysqli;
    }

    public function get() {
        #cria a query de obtenção em sql
        $sql = "SELECT * FROM employees WHERE id = $this->id";

        $query = $this->mysqli->query($sql);
        $result = $query->fetch_array();

        #seta as informacoes do empregado
        $this->name = $result['name'];
        $this->age = $result['age'];
        $this->job = $result['job'];
        $this->salary = $result['salary'];
        $this->admission_date = $result['admission_date'];
    }

    public function set() {
        #cria a query de inserção em sql
        $sql = "INSERT INTO employees (name, age, job, salary, admission_date)
            VALUES ('$this->name', 
                    '$this->age',
                    '$this->job',
                    '$this->salary',
                    '$this->admission_date')";
        
        #executa a query verificando seu sucesso
        if ($this->mysqli->query($sql) === TRUE) {
            return true;
        } else {
           return false;
        }
    }

    public function age_avg() {
        #cria a query de media de idade em sql
        $sql = "SELECT AVG(age) as age_avg FROM employees";

        $query = $this->mysqli->query($sql);
        $result = $query->fetch_array();
        #retorna a media
        return $result['age_avg'];
    } 

    public function salary_increment($porcent) { 
        #cria a query que seleciona o empregado
        $sql = "SELECT salary FROM employees WHERE id = $this->id";

        $query = $this->mysqli->query($sql);
        $result = $query->fetch_array();
        #simula novo salario com incremento
        $new_salary = $result['salary'] * (1 + $porcent/100);

        #retorna simulacao
        return $new_salary;
    }

    public function functions() { 
        #cria a query que seleciona funcoes de cada empregado
        $sql = "SELECT id, name, job FROM employees";

        $query = $this->mysqli->query($sql);
        $rows = [];
        while($row = mysqli_fetch_assoc($query))
            $rows[] = $row;
        
        #retorna toda a tabela
        return $rows;
    }

    public function projects_done_thisyear() {
        #obtem ano corrente
        $year = date('Y'); 
        #cria a query que seleciona projetos entreges/concluidos
        $sql = "SELECT * FROM projects WHERE
            (status = 'entregue'
            OR status = 'concluido')
            AND Year(delivery_date) = '$year' 
            ORDER BY delivery_date DESC";

        $query = $this->mysqli->query($sql);
        $rows = [];
        while($row = mysqli_fetch_assoc($query))
            $rows[] = $row;

        #retorna toda a tabela
        return $rows;
    }

    public function projects_soon($pre_date, $pos_date) { 
        #cria a query que verifica quais empregados tem projetos a entregar
        $sql1 = "SELECT id_employee FROM projects WHERE
            status = 'a entregar'
            AND delivery_date BETWEEN '$pre_date' AND '$pos_date'
            GROUP BY id_employee";

        $query1 = $this->mysqli->query($sql1);
        $rows = [];
        while($row1 = mysqli_fetch_assoc($query1)) {
            #apenas para estilizar o agrupamento
            $row1['id'] = "###";
            $row1['description'] = "###";
            $row1['status'] = "###";
            $row1['delivery_date'] = "###";
            $row1['value'] = "Funcionário #" . $row1['id_employee'];
            $rows[] = $row1;

            #criar query que verifica os projetos deste empregado
            $sql2 = "SELECT * FROM projects WHERE
                status = 'a entregar'
                AND delivery_date BETWEEN '$pre_date' AND '$pos_date'
                AND id_employee = " . $row1['id_employee'] . "
                ORDER BY delivery_date ASC";
            
            $query2 = $this->mysqli->query($sql2);
            while($row2 = mysqli_fetch_assoc($query2))
                $rows[] = $row2;
        }

        return $rows; #retorna toda a tabela agrupada
    }
}
