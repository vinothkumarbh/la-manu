<?php
 require '../controller/Appointment.php';
 $app = new Appointment();
 $res = $app->get_apps()->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/main.css">
    <title>Patient list</title>
</head>


<body>
    <nav class="navbar navbar-expand-lg navbar-dark border-bottom">
        <div class="container-fluid">
            <a class="navbar-brand" href="./index.php">HOME</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="./ajout-patient.php">Patients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-decoration-underline" href="#">Appointments</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="mx-auto d-flex w-25 justify-content-around text-light mt-5">
    <h4>Patient id</h4>
    <h4>Appointment Date</h4>
    </div>
    <ul>
    <?php
if($res) {

    foreach($res as $data) {
        ?>

        <a href="rendezvous.php?pat_id=<?php echo $data['idPatients'] ?>">
            <li class="d-flex w-25 justify-content-around border m-auto list-group-item">
                <?php echo $data['idPatients'] ?></p><p><?php echo $data['dateHour'] ?>
            </li>
        </a>
    <?php
    }
}
    ?>
    </ul>

    <div class="mx-auto d-flex w-25 justify-content-around mt-3">
    <a href="./ajout-rendezvous.php" class="btn btn-sm btn-success mt-2">Create new appointment</a>


    <!-- delete appointment -->
    <?php
    if(isset($_GET['del_app'])) {
       $app->delete_app($_GET['del_app']);
       header("Location: liste-rendezvous.php");
    }
    ?>

        <!-- Button trigger modal -->
        <button class="btn btn-sm btn-danger mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete appointment</button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-auto">
                    <form method='GET'>
                        <input type="number" placeholder="Insert patient id" name="del_app">
                        <input type="submit" value="Confirm" name='del_app_btn'>                    
                    </form>
                </div>
                </div>
            </div>
        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>