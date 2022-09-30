<?php
 session_start();
 require '../controller/Appointment.php';
 require '../controller/Patient.php';

 $app = new Appointment(); 

 // editing appointment date
 if(isset($_POST['submit'])) {
    $edit_app = $app->edit_rdv($_POST['rdv_date'], $_GET['pat_id']);
    header('Location: rendezvous.php?pat_id='. $_GET['pat_id']);
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
                        <a class="nav-link text-decoration-underline" href="./ajout-rendezvous">Appointments</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <h1 class='text-center text-light'>Appointment Info</h1>
    <ul class="list-group w-50 mx-auto">
        <?php
        if(isset($_GET['pat_id'])) {
            $pat_id = $_GET['pat_id'];
            $rdv_date = $app->get_app_by_patId($pat_id);
            $res = $app->search_patient($pat_id)->fetchAll(PDO::FETCH_ASSOC);
            foreach($res as $data) {
                ?>
                <li class="list-group-item">
                    <?php echo $data['firstname'] ?> <?php echo $data['lastname'] ?>
                </li>
                <li class="list-group-item">
                    <?php echo $data['mail'] ?>
                </li>
                <li class="list-group-item">
                    <?php echo $data['birthdate'] ?>
                </li>
                <li class="list-group-item">
                    <?php echo $data['phone'] ?>
                </li>
                <?php
                foreach($rdv_date as $rdv) {
                ?>
                <li class="list-group-item d-flex justify-content-between">
                    <?php
                    if(isset($_GET['editr'])) { ?>
                        <form method="POST">
                            <input type="datetime-local" name="rdv_date"/>
                            <input type="hidden" name="pat_id" value="<?php echo $_GET['pat_id'] ?>"/>
                            <button class="btn btn-success" name="submit" type="submit">Submit</button>
                        </form>
                    <?php }else {
                    ?>
                        <span><?php echo $rdv['dateHour'] ?></span>
                        <span><a href="rendezvous.php?pat_id=<?php echo $_GET['pat_id'] ?>&editr=<?php echo $rdv['id'] ?>" class="btn btn-warning">Edit</a></span>
                    <?php
                    }
                    ?>
                </li>
            <?php
            }
            }
        }
        ?>
    <ul/>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>