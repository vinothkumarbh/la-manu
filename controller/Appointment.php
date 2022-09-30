<?php
include_once __DIR__.'/../model/db.php';


class Appointment {
    private $db;

    public function __construct() {
        $this->db = new DatabaseConnection();
    }

    // search patient id
    public function search_patient($pid) {
        $res = $this->db->reading_data("SELECT * FROM patients WHERE id = '$pid'");
        return $res;
    }

    public function add_app($pid, $appdate) {
        $this->db->add_data("INSERT INTO appointments (dateHour, idPatients) VALUES ('$appdate', '$pid')");
    }

    public function get_apps() {
        $res = $this->db->reading_data("SELECT * FROM appointments");
        return $res;
    }

    public function delete_app($pid) {
        $this->db->delete_data("DELETE FROM appointments where idPatients = $pid");
    }

    public function get_app_by_patId($pid) {
        $res = $this->db->reading_data("SELECT * FROM appointments WHERE idPatients = $pid");
        return $res;
    }

    public function edit_rdv($rdv_date, $pid) {
        $res = $this->db->add_data("UPDATE appointments SET dateHour = '$rdv_date' WHERE idPatients = '$pid'");
    }
}