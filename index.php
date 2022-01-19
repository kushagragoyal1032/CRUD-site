<?php

include 'partial/_db_connect.php';
?>

<?php
// this code for inserting title and desc in database
$showAlert = false;
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['add'] == 'inserting')
{
    $title = $_POST['mytitle'];
    $desc = $_POST['mydesc'];
    
    $quer = "insert INTO `note_table` (`Title`, `Description`) VALUES ('$title', '$desc')";
    $result = mysqli_query($con, $quer);

    if($result === true )
    {
        $showAlert = true;
    }
    else
    {
        $showAlert = false;
    }
}
?>

<?php
// update the data into a table
$show_update_Alert = false;
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['add'] == 'updating')
{
    $hiddenID = $_POST['snoEdit'];
    $title = $_POST['mytitle_edit'];
    $desc = $_POST['mydesc_edit'];

    $quer1 = "UPDATE `note_table` SET `Title` = '$title',`Description` = '$desc' WHERE `Sno` = $hiddenID ";
    $result = mysqli_query($con, $quer1);

    if($result === true )
    {
        $show_update_Alert = true;
    }

}
?>

<?php
// delete the data into a table
$show_delete_Alert = false;
if(isset($_GET['V_delete']))
{
    $sno = $_GET['V_delete'];
    
    $quer2 = "DELETE FROM `note_table` WHERE `Sno` = $sno";
    $result = mysqli_query($con, $quer2);

    if($result === true )
    {
        $show_delete_Alert = true;
    }

}
?>


<!-- --------------------------------------------------------------------------------------------------------------- -->


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

    <title>CRUD OPERATIONS</title>

</head>

<body>



    <!-- Modal -->
    <div class="modal fade" id="edit_Modal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Update Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="index.php">      

                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="mb-3">
                            <label for="title" class="form-label">Note Title</label>
                            <input type="text" class="form-control" id="titleEdit" name="mytitle_edit"
                                aria-describedby="emailHelp">
                        </div>

                        <div class="mb-3 my-3">
                            <label for="desc" class="form-label">Note Description</label>
                            <textarea class="form-control " placeholder="Leave a comment here" id="descEdit" name="mydesc_edit"></textarea>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name= "add" value = "updating">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>



    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">iMemo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">about</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <?php
if($showAlert)
  {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>inserted Successfully !!</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }

  if($show_update_Alert)
  {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>update Successfully !!</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }

  if($show_delete_Alert)
  {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>deletete Successfully !!</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }
?>

    <div class="container my-4">
        <b>
            <h2>Add Note</h2>
        </b>
        <form method="POST" action="index.php">
            <div class="mb-3">
                <label for="title" class="form-label">Note Title</label>
                <input type="text" class="form-control" id="title" name="mytitle" aria-describedby="emailHelp">
            </div>

                    <div class="mb-3 my-3">
                        <label for="desc" class="form-label">Note Description</label>
                        <textarea class="form-control " placeholder="Leave a comment here" id="desc" name="mydesc"></textarea>
                    </div>
                        <button type="submit" class="btn btn-primary my-4" name="add" value="inserting">Add</button>
        </form>

    </div>

    <div class="container my-4">

    <table class="table table-striped" id=myTable>
        <thead>
            <tr>
                <th scope="col">S.No</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>

            <?php
                $S_no = 0;
                $quer = "SELECT * FROM `note_table`";
                $result = mysqli_query($con,$quer);
                while($row = mysqli_fetch_assoc($result))
                {
                    $S_no = $S_no+1;
                    echo '<tr>
                    <th scope="row">'. $S_no . '</th>
                    <td>'.$row['Title'].'</td>
                    <td>'.$row['Description'].'</td>
                    <td> 
                        <button type="button" class="btn btn-primary editbtn mx-2" id = '.$row['Sno'].' >Edit</button>
                        <button type="button" class="btn btn-danger deletebtn" id = d'.$row['Sno'].' >Delete</button> 
                    </td>
                </tr>';
                }
            ?>
        </tbody>
    </table>
            </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>

    <script> // this script is used to update 
        edits = document.getElementsByClassName('editbtn');
        Array.from(edits).forEach((element)=>{
            element.addEventListener("click",(e)=>{
            console.log("editbtn", );
            tr= e.target.parentNode.parentNode;

            title_script_data = tr.getElementsByTagName("td")[0].innerText;
            description_script_data = tr.getElementsByTagName("td")[1].innerText;

            console.log(title_script_data, description_script_data);
            titleEdit.value = title_script_data;
            descEdit.value = description_script_data;

            snoEdit.value = e.target.id;  // taking the actual id from databse and put to hiddne snoEdit
            $('#edit_Modal').modal('toggle');
        })
        })

                // this script is used to delete

        deletes = document.getElementsByClassName('deletebtn');
        Array.from(deletes).forEach((element)=>{
            element.addEventListener("click",(e)=>{
            console.log("deletebtn", );
            
            sno = e.target.id.substr(1,);
            console.log(sno );

            if(confirm("Are you want to delete"))
            {
                console.log("yes");
                window.location = `/CRUD project/index.php?V_delete=${sno}`;
            }
            else
            {
                console.log("no");
            }
        })
        })
    </script>
</body>

</html>