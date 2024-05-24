<?php
require_once("../model/initialize.php");

class ReporteController {
    public function index() {
        if (!isset($_SESSION['USERID'])) {
            redirect(web_root . "../view/reporte/index.php");
        }

        $section = isset($_POST['SECTION']) ? $_POST['SECTION'] : "";

        $reporteModel = new ReporteModel();
        $reporte = $reporteModel->getReporte($section);

        $this->view($reporte);
    }

    public function view($reporte) {
        include("../view/reportes/index.php");
    }
}

$reporteController = new ReporteController();
$reporteController->index();