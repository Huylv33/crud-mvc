<?php

require_once 'model/DstinhService.php';
require_once 'model/ValidationException.php';
class TinhsController
{
  private $DstinhService = null;
  public function __construct()
  {
    $this->DstinhService = new DstinhService();
  }
  public function redirect($location)
  {
    header("Location: $location");
  }
  public function handleRequest()
  {
    $op = isset($_GET['op']) ? $_GET['op'] : null;
    try {
      if (!$op || $op == 'list') {
        $this->listTinhs();
      } elseif ($op == 'new') {
        $this->saveTinh();
      } elseif ($op == 'delete') {
        $this->deleteTinh();
      } elseif ($op == 'show') {
        $this->showTinh();
      } else {
        $this->showError("Page not found", "Page for operation " . $op . " was not found!");
      }
    } catch (Exception $e) {
      $this->showError("Application error", $e->getMessage());
    }
  }
  public function listTinhs()
  {
    $orderby = isset($_GET['orderby']) ? $_GET['orderby'] : "id";
    $tinhs = $this->DstinhService->getAllTinhs($orderby);
    $errors = array();
    include 'view/tinhs.php';
  }
  public function saveTinh()
  {
    $errors = array();
    if (isset($_POST["add"])) {
      $id = isset($_POST["id"]) ? $_POST["id"] : "";
      $name = isset($_POST["name"]) ? $_POST["name"] : "";
      try {
        $this->DstinhService->insertTinh($id, $name);
      } catch (ValidationException $e) {
        $errors = $e->getErrors();
      }
    }
    $this->redirect("index.php?op=list");
  }
  public function showTinh()
  {
    
  }
  public function deleteTinh()
  {
    if (isset($_POST['delete'])) {
      if (isset($_POST['check'])) {
        $idArr = $_POST['check'];
        var_dump($idArr);
        foreach ($idArr as $id) {
          $this->DstinhService->deleteTinh($id);
        }
      }
    } else {
      $id = $_GET["id"];
      $this->DstinhService->deleteTinh($id);
    }
    $this->redirect("index.php?op=list");
  }
  public function showError($title, $message)
  {
    include 'view/errors.php';
  }
}