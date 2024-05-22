<?php
require_once("../../../public/include/initialize.php");
require_once("../../model/ReporteModel.php");

class ReporteController {
    public function index() {
        if (!isset($_SESSION['USERID'])) {
            redirect(web_root . "admin/index.php");
        }

        $section = isset($_POST['SECTION']) ? $_POST['SECTION'] : "";

        $reporteModel = new ReporteModel();
        $reporte = $reporteModel->getReporte($section);

        $this->view($reporte);
    }

    public function view($reporte) {
        include("../view/report/index.php");
    }
}

$reporteController = new ReporteController();
$reporteController->index();