<?php include '../controller/Patient.php';
include '../controller/Appointment.php';
$pat = new Patient();
$app = new Appointment();
?>
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
                        <a class="nav-link" href="./ajout-patient.php">Patients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./ajout-rendezvous.php">Appointments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-decoration-underline" href="./ajout-patient-rendez-vous.php">Patient and Appointment</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php
    if(isset($_POST['confirm'])) {
        // Required field names
        $required = array('firstname', 'lastname', 'birthdate', 'phone', 'email', 'rdv_date');

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

            // getting last inserted patient's id
            $last_patient = $pat->get_last_patient()->fetchAll(PDO::FETCH_ASSOC);
            // adding new appointment with patient's id
            $add_app = $app->add_app($last_patient[0]['id'], $_POST['rdv_date']);
        }
    }

    ?>

    <div class="w-50 mx-auto mt-5">
        <form method="post">
            <div class="mb-3">
                <input type="text" class="form-control" name="firstname" placeholder="First name">
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="lastname"  placeholder="Last name">
            </div>
            <div class="mb-3">
                <label class="text-light">Date of birth</label>
                <input type="date" class="form-control" name="birthdate"  placeholder="Date of birth">
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="phone"  placeholder="Telephone number" >
            </div>
            <div class="mb-3">
                <input type="email" class="form-control" name="email"  placeholder="example@gmail.com">
            </div>
            <div class="mb-3">
                <label class="text-light">Date of Appointment</label>
                <input type="datetime-local" class="form-control" name="rdv_date">
            </div>
            <button type="submit" name="confirm" class="btn btn-primary">Submit</button>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>