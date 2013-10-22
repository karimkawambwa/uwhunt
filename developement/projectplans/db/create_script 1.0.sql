CREATE TABLE Company (
  idCompany INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(120) NULL,
  city VARCHAR(50) NULL,
  country VARCHAR(50) NULL,
  address VARCHAR(80) NULL,
  postal_code VARCHAR(10) NULL,
  PRIMARY KEY(idCompany)
);

CREATE TABLE Employment (
  employment_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  Student_student_id INTEGER UNSIGNED NOT NULL,
  House_idHouse INTEGER UNSIGNED NOT NULL,
  Company_idCompany INTEGER UNSIGNED NOT NULL,
  position VARCHAR(80) NULL,
  start_date TIMESTAMP NULL,
  end_date TIMESTAMP NULL,
  PRIMARY KEY(employment_id),
  INDEX Employment_FKIndex1(Student_student_id),
  INDEX Employment_FKIndex2(Company_idCompany),
  INDEX Employment_FKIndex3(House_idHouse)
);

CREATE TABLE House (
  idHouse INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  House_Owner_owner_id INTEGER UNSIGNED NOT NULL,
  city VARCHAR(54) NULL,
  provience VARCHAR(5) NULL,
  postalcode VARCHAR(12) NULL,
  occupant_capacity INTEGER UNSIGNED NULL,
  date_added TIMESTAMP NULL,
  rent_price DOUBLE NULL,
  last_editted TIMESTAMP NULL,
  PRIMARY KEY(idHouse),
  INDEX House_FKIndex1(House_Owner_owner_id)
);

CREATE TABLE House_Image (
  image_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  House_idHouse INTEGER UNSIGNED NOT NULL,
  image_type VARCHAR(12) NULL,
  image LONGBLOB NULL,
  image_size VARCHAR(25) NULL,
  image_name VARCHAR(50) NULL,
  PRIMARY KEY(image_id),
  INDEX House_Pictures_FKIndex1(House_idHouse)
);

CREATE TABLE House_Owner (
  owner_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  first_name VARCHAR(64) NULL,
  last_name VARCHAR(64) NULL,
  email VARCHAR(82) NULL,
  phone_number INTEGER UNSIGNED NULL,
  PRIMARY KEY(owner_id)
);

CREATE TABLE House_Review (
  idHouse_Review INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  House_idHouse INTEGER UNSIGNED NOT NULL,
  comments VARCHAR(250) NULL,
  rating INTEGER UNSIGNED NULL,
  PRIMARY KEY(idHouse_Review),
  INDEX House_Review_FKIndex1(House_idHouse)
);

CREATE TABLE House_Validation (
  idHouse_Validation INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  House_idHouse INTEGER UNSIGNED NOT NULL,
  date_sent TIMESTAMP NULL,
  validation_expiration TIMESTAMP NULL,
  allow_display BOOL NULL,
  validation_code VARCHAR(45) NULL,
  PRIMARY KEY(idHouse_Validation, House_idHouse),
  INDEX House_Validation_FKIndex1(House_idHouse)
);

CREATE TABLE Student (
  student_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  first_name VARCHAR(80) NULL,
  last_name VARCHAR(80) NULL,
  username VARCHAR(30) NULL,
  student_password VARCHAR(40) NULL,
  salt VARCHAR(50) NULL,
  student_email VARCHAR(100) NULL,
  student_phone VARCHAR(50) NULL,
  PRIMARY KEY(student_id)
);

CREATE TABLE Student_Confirmation (
  idStudent_Confirmation INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  Student_student_id INTEGER UNSIGNED NOT NULL,
  banned BOOL NULL,
  varified BOOL NULL,
  varification_code VARCHAR(45) NULL,
  PRIMARY KEY(idStudent_Confirmation),
  INDEX Student_Confirmation_FKIndex1(Student_student_id)
);


