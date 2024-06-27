<?php
require_once("../model/initialize.php");

/*Define una clase ReporteController que encapsula la funcionalidad relacionada con la gestión de reportes. */
class ReporteController {
    public function index() {
        /*Verificación de sesión: Verifica si la variable de sesión $_SESSION['user_id'] está definida. 
        Si no lo está, redirige al usuario a la página de inicio de 
        sesión de reportes (../view/reporte/index.php). */
        if (!isset($_SESSION['user_id'])) {
            redirect(web_root . "../view/reporte/index.php");
        }
        /*Obtención de datos: Recupera el valor del parámetro sector enviado mediante POST, si está definido. */
        $sector = isset($_POST['sector']) ? $_POST['sector'] : "";
        /*Instanciación de modelo: Crea una instancia del modelo ReporteModel. */
        $reporteModel = new ReporteModel();
        /*Obtención de reporte: Llama al método getReporte() del modelo 
        ReporteModel para obtener los datos del reporte basados en el sector proporcionado. */
        $reporte = $reporteModel->getReporte($sector);
        /*Llamada al método view(): Llama al método view() 
        de la misma clase (ReporteController) para mostrar la
        vista del reporte, pasando los datos obtenidos como argumento. */
        $this->view($reporte);
    }
    /*Inclusión de la vista: Este método incluye el archivo index.php 
    ubicado en el directorio ../view/reportes/. Presumiblemente, este 
    archivo contiene la estructura HTML y el código PHP necesario para 
    mostrar los datos del reporte pasado como argumento. */
    public function view($reporte) {
        include("../view/reportes/index.php");
    }
}
/*Crea una instancia del ReporteController.
Llama al método index() del controlador para iniciar el proceso
de manejo de reportes, lo que implica verificar la sesión, obtener 
datos del modelo y mostrar la vista correspondiente. */
$reporteController = new ReporteController();
$reporteController->index();