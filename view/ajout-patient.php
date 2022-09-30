<?php include '../controller/Patient.php' ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/main.css">
    <title>Patients</title>
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
                        <a class="nav-link text-decoration-underline" href="#">Patients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./ajout-rendezvous.php">Appointments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./ajout-patient-rendez-vous.php">Patient and Appointment</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="row m-0 w-50 m-auto">

        <!-- Button trigger modal -->
        <button type="button" class="col btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <div class=" border links me-2 bg-success">
                <img src="./images/patient.png" alt="patient">
                <h2 class="text-center text-light">Add patient</h2>
            </div>
        </button>

        <!-- php add patient form -->
        <?php
            $pat = new Patient();

            if(isset($_POST['submit'])) {
                // Required field names
                $required = array('firstname', 'lastname', 'birthdate', 'phone', 'email');

                // Loop over field names, make sure each one exists and is not empty
                $error = false;
                foreach($required as $field) {
                    if (empty($_POST[$field])) {
                        $error = true;
                    }
                }

                if ($error) {
                echo "<script>alert('All fields are required.')</script>";
                } else {
                    $add_patient = $pat->add_patient($_POST['firstname'], $_POST['lastname'], $_POST['birthdate'], $_POST['phone'], $_POST['email']);
                }
            }
        ?>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New patient</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="ajout-patient.php">
                            <div class="mb-3">
                                <label for="first_name" class="form-label">First name</label>
                                <input type="text" class="form-control" name="firstname" id="first_name">
                            </div>
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last name</label>
                                <input type="text" class="form-control" name="lastname" id="last_name">
                            </div>
                            <div class="mb-3">
                                <label for="date_of_birth" class="form-label">Date of birth</label>
                                <input type="date" class="form-control" name="birthdate" id="date_of_birth">
                            </div>
                            <div class="mb-3">
                                <label for="telephone" class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone" id="telephone">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email">
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="col border links bg-primary">
            <a href="./liste-patient.php">
                <img src="./images/list_patient.png" alt="patients">
                <h2 class="text-center text-light">Patient List</h2>
            </a>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>