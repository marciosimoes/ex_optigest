CREATE TABLE employees (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `age` INT NOT NULL,
  `job` VARCHAR(45) NOT NULL,
  `salary` FLOAT NOT NULL,
  `admission_date` DATE NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE projects (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_employee` INT NOT NULL,
  `description` VARCHAR(45) NOT NULL,
  `value` VARCHAR(45) NOT NULL,
  `status` VARCHAR(45) NOT NULL,
  `delivery_date` DATE NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_projects_employees_idx` (`id_employee` ASC),
  CONSTRAINT `fk_projects_employees`
    FOREIGN KEY (`id_employee`)
    REFERENCES employees (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
