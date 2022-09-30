<?php
include_once __DIR__.'/../model/db.php';


class Patient {
    private $db;

    public function __construct() {
        $this->db = new DatabaseConnection();
    }

    public function get_patients() {
        $res = $this->db->reading_data("SELECT * FROM patients");
        return $res;
    }

    public function get_last_patient() {
        $res = $this->db->reading_data("SELECT * FROM patients ORDER BY id DESC LIMIT 1");
        return $res;
    }

    public function patient_profile($pid) {
        $res = $this->db->reading_data("SELECT * FROM patients WHERE id = '$pid'");
        return $res;
    }

    public function add_patient($firstname, $lastname, $birthdate, $email, $phone) {
        $res = $this->db->add_data("INSERT INTO patients (lastname, firstname, birthdate, phone, mail) VALUES ('$lastname','$firstname','$birthdate','$phone','$email')");
    }

    public function delete_patient($pid) {
        $this->db->delete_data("DELETE FROM patients where id = $pid");
    }

    public function edit_patient($firstname, $lastname, $birthdate, $email, $phone, $pid) {
        $res = $this->db->add_data("UPDATE patients SET  lastname = '$lastname', firstname = '$firstname', birthdate = '$birthdate', phone = '$phone', mail = '$email' WHERE id = '$pid'");
    }

    public function search_input($kw) {
        $res = $this->db->reading_data("SELECT * FROM patients WHERE firstname LIKE '%$kw%' OR lastname LIKE '%$kw%' OR mail LIKE '%$kw%'");
        return $res;
    }

}