<?php  
require '../controller/Patient.php';
$pat = new Patient();

$res = $pat->get_patients()->fetchAll(PDO::FETCH_ASSOC);

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
                <form class="d-flex" method="GET">
                    <input class="form-control me-2" type="search" placeholder="Search" name="kw">
                    <input class="btn btn-primary" type="submit" value="Submit">
                </form>
            </div>
        </div>
    </nav>

    <!-- liste de patients -->
    <div class="accordion w-50 mx-auto mt-4" id="accordionExample">
        <ul class="list-group">
        <?php 
        if(isset($_GET['kw']) && $_GET['kw'] !== "") {
            $search_result = $pat->search_input($_GET['kw'])->fetchAll(PDO::FETCH_ASSOC);
            if($search_result) {
                foreach($search_result as $result) {
                ?>
                    <li class="list-group-item">
                        <a href="./profil-patient.php?pid=<?php echo $result['id'] ?>"><?php echo $result['firstname'].' '.$result['lastname']  ?></a>
                    </li>
                <?php
                }
            }
        }elseif ($res) {
            foreach($res as $data) {
                ?>
            <li class="list-group-item">
                <a href="./profil-patient.php?pid=<?php echo $data['id'] ?>"><?php echo $data['firstname'].' '.$data['lastname']  ?></a>
            </li>
            <?php
            }
        }
        ?>
        </ul>

        <a href="./ajout-patient.php" class="btn btn-sm btn-success mt-2">Create new patient</a>


        <!-- delete patient -->
        <?php
        if(isset($_GET['del_pat_id'])) {
            $pat->delete_patient($_GET['del_pat_id']);
            header("Location: liste-patient.php");
        }
        ?>

        <!-- Button trigger modal -->
        <button class="btn btn-sm btn-danger mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete Patient</button>

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
                        <select class="form-select" name="del_pat_id">
                            <option selected>Select Patient</option>
                            <?php
                            $res = $pat->get_patients();
                            foreach($res as $data) {
                            ?>
                                <option value="<?php echo $data['id'] ?>">
                                    <?php echo $data['lastname'] ?> <?php echo $data['firstname'] ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>

                        <input type="submit" value="Confirm" name='del_pat_btn'>                    
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