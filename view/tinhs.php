<!DOCTYPE html>
<html>
  <head>
    <title>DS tỉnh</title>
    <style type="text/css">
            table.tinhs {
                width: 100%;
            }
            
            table.tinhs thead {
                background-color: #eee;
                text-align: left;
            }
            
            table.tinhs thead th {
                border: solid 1px #fff;
                padding: 3px;
            }
            
            table.tinhs tbody td {
                border: solid 1px #eee;
                padding: 3px;
            }
            
            a, a:hover, a:active, a:visited {
                color: blue;
                text-decoration: underline;
            }
    </style>
  </head>
  <body>
    <form method="POST" action="index.php?op=new">
      <label for="name">Id :</label><br>
      <input type="text" name="id"><br>
      <label for="name">Name:</label><br>
      <input type="text" name="name"><br>
      <input type="submit" name="add" value="Add" name="add">
    </form>
    <?php 
    foreach ($errors as $error) {
      echo "<span style='color:red'>$error</span>";
    }
    ?>
    <form method="post" action="index.php?op=delete">
      <table class="tinhs">
            <thead>
                <tr>
                    <th>Chọn để xóa</th>
                    <th>Chọn để edit</th>
                    <th><a href="?orderby=id">Id</a></th>
                    <th><a href="?orderby=name">Name</a></th>
                    <th><a href="?orderby=sohuyen">So huyen</a></th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($tinhs as $tinh) { ?>
                <tr>
                    <td><input type="checkbox" name="check[]" value="<?php echo $tinh['id']; ?>"></td>
                    <td><input type="radio" name="itemEdited" value=""></td>
                    <td><?php echo htmlentities($tinh["id"]) ?></td>
                    <td><a href="index.php?op=show&id=<?php echo $tinh["id"]; ?>">
                    <?php echo htmlentities($tinh["name"]); ?></a></td>
                    <td><?php echo htmlentities($tinh['sohuyen']); ?></td>                  
                    <td>
                      <a href="index.php?op=delete&id=<?php echo $tinh["id"]; ?>">delete</a>
                      <a href="index.php?op=edit&id=<?php echo $tinh["id"]; ?>">edit</a>
                    </td>
                </tr> 
            <?php 
          } ?>
            </tbody>
        </table>
      <input type="submit" name="delete" value="Delete">
    </form>
  </body>
</html>