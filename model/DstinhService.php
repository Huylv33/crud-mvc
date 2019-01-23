<?php
include 'DstinhGateway.php';
include 'dbconfig.php';
class DstinhService extends DbConfig {
  private $DstinhGateway = null;
  public function __construct() {
    parent::__construct('danhmuc');
    $this->DstinhGateway = new DstinhGateway();
  }
  public function getAllTinhs($order) {
    try {
      $conn = $this->connectDB();
      $res = $this->DstinhGateway->selectAll($conn, $order);
      $this->closeDb();
      return $res;
    }catch (Exception $e){
      $this->closeDb();
      throw $e;
    }
  }
  public function getTinhById($id) {
    try {
      $conn = $this->connectDB();
      $this->DstinhGateway->selectById($conn, $id);
      $this->closeDb();
    } catch (Exception $e) {
      $this->closeDb();
      throw $e;
    }
  }
  public function getTinhByName($name){
    try {
      $conn = $this->connectDB();
      $this->DstinhGateway->selectById($conn,$name);
      $this->closeDb();
    } catch (Exception $e) {
      $this->closeDb();
      throw $e;
    }
  }
  public function updateTinh($id, $name){
    try {
      $conn = $this->connectDB();
      $this->DstinhGateway->update($conn,$id,$name);
      $this->closeDb();
    } catch (Exception $e) {
      $this->closeDb();
      throw $e;
    }
  }
  public function insertTinh($id,$name) {
    try {
      $conn = $this->connectDB();
      $this->validateTinhParams($id,$name);
      $this->DstinhGateway->insert($conn,$id,$name);
      $this->closeDb();
    } catch (Exception $e) {
      $this->closeDb();
      throw $e;
    }
  }
  public function deleteTinh($id) {
    try {
      $conn = $this->connectDB();
      $this->DstinhGateway->delete($conn,$id);
      $this->closeDb();
    } catch (Exception $e) {
      $this->closeDb();
      throw $e;
    }
  }
  private function validateTinhParams($id, $name)
  {
    $errors = array();
    if (!isset($name) || $name = "") {
      $errors[] = 'Name is required';
    }
    if (!isset($id) || $id = "") {
      $errors[] = "Id is required";
    }
    if (empty($errors)) {
      return;
    }
    throw new ValidationException($errors);
  }
}
?>