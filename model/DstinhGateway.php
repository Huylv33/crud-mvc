<?php 
class DstinhGateway {
  public function selectAll($conn,$order = "id") {
    $order = mysqli_escape_string($conn,$order);
    $dbOrder = ($order != "sohuyen") ? "dt.".$order : "$order";
    $result = mysqli_query($conn,"select dt.*, count(dh.name) as sohuyen 
                from dstinh dt left join dshuyen dh on dh.tinhid = dt.id  group by dt.id order by $dbOrder asc");
    $tinhs = array();
    if (!$result) {
      echo mysqli_error($conn);
    }
    while ($row = mysqli_fetch_assoc($result)) {
      $tinhs[] = $row;
    }
    return $tinhs;
  }
  public function selectById($conn,$id) {
    $tinhid = mysqli_escape_string($conn,$id);
    $result = mysqli_query($conn,"select * from dstinh where id = $tinhid");
    $tinhs = array();
    while ($row = mysqli_fetch_assoc($result)) {
      $tinhs[] = $row;
    } 
  }
  public function selectByName($conn,$name) {
    $name = mysqli_escape_string($conn,$name);
    $result = mysqli_query($conn,"select * from dstinh where name = $name");
    $tinhs = array();
    while ($row = mysqli_fetch_assoc($result)) {
      $tinhs[] = $row;
    }
    return $tinhs; 
  }
  public function update($conn,$id, $name) {
    $id = mysqli_escape_string($conn,$id);
    $name = mysqli_escape_string($conn,$name);
    mysqli_query($conn,"UPDATE dstinh SET id = $id, name = $name where id = $id");
  }
  public function insert($conn,$id, $name) {
    $id = mysqli_escape_string($conn,$id);
    $name = mysqli_escape_string($conn,$name);
    $result=mysqli_query($conn,"insert into dstinh(id, name) values('$id','$name')");
  }  
  public function delete($conn,$id) {
    $id = mysqli_escape_string($conn,$id);
    if (!mysqli_query($conn,"delete from dstinh where id = '$id'")) {
      echo mysqli_error($conn);
    } 
  }
}
?>