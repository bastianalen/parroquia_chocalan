<?php
require_once("../model/initialize.php");

class ReporteController {
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            redirect(web_root . "../view/reporte/index.php");
        }

        $sector = isset($_POST['sector']) ? $_POST['sector'] : "";

        $reporteModel = new ReporteModel();
        $reporte = $reporteModel->getReporte($sector);

        $this->view($reporte);
    }

    public function view($reporte) {
        include("../view/reportes/index.php");
    }
}

$reporteController = new ReporteController();
$reporteController->index();