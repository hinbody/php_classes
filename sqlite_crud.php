<?php
class SqliteCrud{

  private $dbh;

  function __construct($db_file) {
    $this->dbh = new PDO('sqlite:'.$db_file);
  }

  public function create_table($tname, $columns) {
    $statement = $this->dbh->prepare('create table if not exists '.$tname.
      '('.join(',', $columns).')');
    $statement->execute();
  }

  public function insert($tname, $info) {
    $statement = $this->dbh->prepare('insert into '.$tname.' values(?,?)');
    $statement->execute($info);
  }

}

$columns = array('make', 'frame');
$info = array('Standard Bykes', '125r');
$bikes = new SqliteCrud('bikes.sqlite');
$bikes->create_table('info', $columns);
$bikes->insert('info', $info); 
?>
