<?php
require '../controller/Patient.php';
require '../controller/Appointment.php';

$pat = new Patient();
$app = new Appointment();

if(isset($_POST['submit'])) {
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $birthdate = $_POST['birthdate'];
    $editp = $_POST['editp'];
    $rdv_date = $_POST['rdv_date'];

    $pat->edit_patient($fname, $lname, $birthdate, $email, $phone, $editp);
    $app->edit_rdv($rdv_date, $editp);

    header('Location: profil-patient.php?pid='. $editp);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/main.css">
    <title>Patient profile</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark border-bottom">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">HOME</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-decoration-underline" href="./ajout-patient.php">Patients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./ajout-rendezvous.php">Appointments</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <h1 class='text-center text-light'>Patient info - Edit</h1>

    <form class="w-50 m-auto" method="POST" action="edit_patient.php">
        <div class="mb-3">
            <input type="text" class="form-control" name="firstname" placeholder="Firstname" required>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" name="lastname" placeholder="Lastname" required>
        </div>
        <div class="mb-3">
            <input type="email" class="form-control" name="email" placeholder="Email" required>
        </div>
        <div class="mb-3">
            <input type="date" class="form-control" name="birthdate" required>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" name="phone" placeholder="Phone Number" required>
        </div>
        <div class="mb-3">
            <input type="datetime-local" class="form-control" name="rdv_date" placeholder="Date of appointment">
        </div>
        <div class="mb-3">
            <input type="number" value="<?php echo $_GET['editp'] ?>" class="form-control" name="editp" hidden>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>