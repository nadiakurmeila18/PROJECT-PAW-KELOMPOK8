<?php
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "";

  // Buat Koneksi
  $connection   = mysqli_connect($dbhost,$dbuser,$dbpass);
  if(!$connection){
    die ("Koneksi dengan database gagal: ".mysqli_connect_errno()." - ".mysqli_connect_error());
  }

  // Buat Database
  $query = "CREATE DATABASE IF NOT EXISTS my_campus";
  $result = mysqli_query($connection, $query);
  if(!$result){
    die ("Query Error: ".mysqli_errno($connection)." - ".mysqli_error($connection));
  }
  else {
    echo "Database <b>'my_campus'</b> berhasil dibuat... <br>";
    }

  // Pilih Database
  $result = mysqli_select_db($connection, "my_campus");
  if(!$result){
    die ("Query Error: ".mysqli_errno($connection)." - ".mysqli_error($connection));
  }
  else {
    echo "Database <b>'my_campus'</b> berhasil dipilih... <br>";
  }

  // Buat Tabel student
  $query = "DROP TABLE IF EXISTS student";
  $query_result = mysqli_query($connection, $query);
  if(!$query_result){
    die ("Query Error: ".mysqli_errno($connection)." - ".mysqli_error($connection));
  }
  else {
    echo "Tabel <b>'student'</b> berhasil dihapus... <br>";
  }
  $query  = "
    CREATE TABLE student 
      (nim CHAR(8), 
      name VARCHAR(100), 
      birth_city VARCHAR(50), 
      birth_date DATE, 
      faculty VARCHAR(50), 
      department VARCHAR(50), 
      gpa DECIMAL(3,2), 
      PRIMARY KEY (nim))";
      $query_result = mysqli_query($connection, $query);
  if(!$query_result){
      die ("Query Error: ".mysqli_errno($connection)." - ".mysqli_error($connection));
  }
  else {
    echo "Tabel <b>'student'</b> berhasil dibuat... <br>";
  }

  // Insert data student
  $query  = "
    INSERT INTO student 
    VALUES 
      ('12041952', 'Brian Yuko', 'Padang', '1996-11-23', 'FTIB', 'Sistem Informasi', 3.1), 
      ('12042010', 'Safira Yanuar', 'Bandung', '1994-08-22', 'FTIB', 'Sistem Informasi', 3.9), 
      ('12042012', 'Rezja Zalva', 'Jakarta', '1997-12-31', 'FTIB', 'Informatika', 3.5),
      ('12042034', 'Agha Rizky', 'Jakarta', '1997-06-28', 'FTEIC', 'Sains Data', 3.4), 
      ('12042041', 'Adhiaksa', 'Medan', '1995-04-02', 'FTEIC','Bisnis Digital', 3.7)";
  $query_result = mysqli_query($connection, $query);
  if(!$query_result){
      die ("Query Error: ".mysqli_errno($connection)." - ".mysqli_error($connection));
  }
  else {
    echo "Tabel <b>'student'</b> berhasil diisi... <br>";
  }

  // Buat Tabel Admin
  $query = "DROP TABLE IF EXISTS admin";
  $query_result = mysqli_query($connection, $query);
  if(!$query_result){
    die ("Query Error: ".mysqli_errno($connection)." - ".mysqli_error($connection));
  }
  else {
    echo "Tabel <b>'admin'</b> berhasil dihapus... <br>";
  }
  $query  = "CREATE TABLE admin (username VARCHAR(50), password CHAR(40))";
  $query_result = mysqli_query($connection, $query);
  if(!$query_result){
      die ("Query Error: ".mysqli_errno($connection)." - ".mysqli_error($connection));
  }
  else {
    echo "Tabel <b>'admin'</b> berhasil dibuat... <br>";
  }

  // Insert Data Admin
  $username = "admin";
  $password = sha1("adminmahasiswa");
  $query  = "INSERT INTO admin VALUES ('$username','$password')";
  $query_result = mysqli_query($connection, $query);
  if(!$query_result){
      die ("Query Error: ".mysqli_errno($connection)." - ".mysqli_error($connection));
  }
  else {
    echo "Tabel <b>'admin'</b> berhasil diisi... <br>";
  }

  mysqli_close($connection);
?>