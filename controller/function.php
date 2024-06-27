<?php
	/*La función strip_zeros_from_date en PHP
	está diseñada para limpiar una cadena de texto que 
	contiene fechas marcadas con asteriscos seguidos de ceros. 
	Aquí está la descripción detallada del código: */

	/*$marked_string: Es el parámetro de entrada 
	que contiene la cadena de texto con fechas marcadas. */
	function strip_zeros_from_date($marked_string="") {
		/*str_replace('*0','',$marked_string): Esta línea elimina todos los caracteres *0 de la cadena $marked_string. Esto significa que cualquier secuencia que coincida exactamente con *0 será reemplazada por una cadena vacía ('').

		La variable $no_zeros almacena el resultado de esta operación.
		str_replace('*0','',$no_zeros): Esta segunda llamada a str_replace es 
		redundante, ya que $no_zeros ya no contiene ningún *0 después de la primera 
		llamada. Parece ser un error en el código, ya que repite la misma operación 
		sin efectuar ningún cambio adicional. 
		Esta función es útil cuando se trabaja con fechas almacenadas
		 como cadenas de texto que pueden contener caracteres adicionales
		 como marcadores o espacios que no son necesarios en el formato de fecha estándar.
		En resumen, la función strip_zeros_from_date busca y elimina todos los 
		marcadores de cero (*0) de una cadena de texto que representa una
		fecha, asegurando que la cadena devuelta esté limpia y lista para 
		su procesamiento adicional o presentación.
		*/
		$no_zeros = str_replace('*0','',$marked_string);
		$cleaned_string = str_replace('*0','',$no_zeros);
		return $cleaned_string;
	}
	/*Función redirect_to
	La función redirect_to se utiliza para redirigir al usuario
	a otra página o URL dentro del sitio web. Aquí está cómo funciona:

	Parámetro $location: Este parámetro es opcional y representa 
	la URL a la cual se desea redirigir al usuario. Si no se proporciona 
	ningún valor, el parámetro predeterminado es NULL. */
	function redirect_to($location = NULL) {
		/*Condición if: Verifica si $location no es NULL. Si $location tiene un valor distinto de NULL, el flujo del programa continúa. */
		if($location != NULL){
			/*Función header(): Esta función de PHP se utiliza para enviar encabezados 
			HTTP. En este caso, se utiliza para enviar un encabezado de redirección 
			(Location) al navegador del cliente con la URL especificada en $location. */
			header("Location: {$location}");
			/*exit: Es una función de PHP que termina la ejecución del script
			actual después de que se envía la redirección. Esto es importante 
			para asegurarse de que el navegador del cliente siga la redirección
			y no procese más código en la página actual. */
			exit;
		}
	}
	/*La función redirect tiene como objetivo redirigir al usuario a una nueva ubicación (URL). */
	/*Parámetro $location: Este es el parámetro opcional que representa la URL 
	a la cual se desea redirigir al usuario. Si no se proporciona ningún valor 
	(NULL), se mostrará un mensaje de error indicando "error location". */
	function redirect($location=Null){
		/*if: Verifica si $location no es NULL. Si $location tiene un valor distinto de NULL, el flujo del programa continúa. */
		if($location!=Null){
			/*JavaScript window.location: Si se proporciona una URL válida en 
			$location, se imprime un bloque de script JavaScript en la página. 
			Este script JavaScript (window.location = '{$location}') redirigirá 
			al navegador del usuario a la URL especificada en $location. */
			echo "<script>
					window.location='{$location}'
				</script>";	
		}else{
			/*Mensaje de error: Si $location es NULL, se imprime en la página el mensaje 'error location'. */
			echo 'error location';
		}
		 
	}
	/*La función output_message se utiliza para generar un mensaje HTML encapsulado en un párrafo (<p>). Aquí se explica cómo funciona: */
	function output_message($message="") {
		/*Parámetro $message: Este es el parámetro opcional que representa
		el mensaje que se desea mostrar. Si se proporciona un mensaje válido
		(no vacío), la función generará un fragmento HTML con ese mensaje. */

		/*if: Verifica si $message no está vacío (!empty($message)). Si $message tiene contenido válido, el flujo del programa continúa. */
		if(!empty($message)){
			/*HTML de salida: Si se proporciona un mensaje válido, 
			la función construye un fragmento de HTML que contiene 
			el mensaje dentro de un párrafo con la clase CSS message. 
			El mensaje se interpola dentro del HTML utilizando llaves {}. */
			/*Valor de retorno: La función retorna el fragmento HTML generado, que puede ser utilizado para mostrar mensajes en una página web. */
		return "<p class=\"message\">{$message}</p>";
		/*else: Si $message está vacío o no se proporciona, la función devuelve una cadena vacía "". */
		}else{
			return "";
		}
	}
	/*La función date_toText($datetime) convierte una fecha y hora dada en formato de texto 
	 $datetime: Es el parámetro que se espera contenga una fecha y hora en formato compatible 
	 con strtotime(). Esto incluye formatos como "YYYY-MM-DD HH:MM" o
	 cualquier otro formato reconocido por strtotime().*/
	function date_toText($datetime=""){
		/*strtotime($datetime): Esta función convierte el valor de 
		$datetime en un timestamp Unix. Un timestamp Unix representa 
		la cantidad de segundos transcurridos desde
		el 1 de enero de 1970 a las 00:00:00 UTC (época Unix). */
		$nicetime = strtotime($datetime);
		/*strftime("%B %d, %Y at %I:%M %p", $nicetime): Utiliza strftime() para formatear el timestamp Unix ($nicetime) en un formato de fecha y hora específico.
		%B: Nombre completo del mes (por ejemplo, "January").
		%d: Día del mes (por ejemplo, "01" a "31").
		%Y: Año con cuatro dígitos (por ejemplo, "2024").
		%I:%M %p: Hora en formato de 12 horas con minutos y AM/PM (por ejemplo, "12:30 PM"). */
		return strftime("%B %d, %Y at %I:%M %p", $nicetime);	
		/*La función devuelve una cadena de texto formateada que representa la fecha y la hora proporcionadas en el parámetro $datetime en un formato más legible */
	}
	/*spl_autoload_register() es una función en PHP que permite registrar funciones o métodos 
	como manejadores de autocarga de clases. Estos manejadores se invocan automáticamente cuando 
	se intenta usar una clase que aún no ha sido definida en el script actual. */
	spl_autoload_register(function ($class_name) {
		/*$class_name = strtolower($class_name);:
		Convierte el nombre de la clase a minúsculas. Esto es útil porque en algunos 
		sistemas de archivos y configuraciones de servidores, los nombres de archivo 
		son sensibles a mayúsculas y minúsculas. */
		$class_name = strtolower($class_name); // Convierte el nombre de la clase a minúsculas
		/*LIB_PATH y DS son constantes definidas anteriormente. LIB_PATH probablemente 
		contiene la ruta principal donde se encuentran las clases, y DS es un separador 
		de directorios compatible con el sistema operativo (/ en UNIX y \ en Windows).
		$path = LIB_PATH.DS."{$class_name}.php"; construye la ruta completa al archivo 
		de la clase basado en el nombre de la clase convertido a minúsculas. */
		$path = LIB_PATH.DS."{$class_name}.php"; // Construye la ruta del archivo de la clase
	
		// Verifica si el archivo de la clase existe en la ruta especificada por $path
		if (file_exists($path)) {
			/*Si el archivo de la clase existe, se incluye utilizando require_once().
			Esto asegura que el archivo se incluya solo una vez para evitar problemas de redefinición de clases. */
			require_once($path); // Incluye el archivo de la clase
		} else {
			/*Si file_exists($path) devuelve false, significa que el archivo 
			de la clase no se encontró. En ese caso, el script se detiene y
			muestra un mensaje de error indicando el nombre del archivo de clase que no se pudo encontrar. */
			die("The file {$class_name}.php could not be found."); // Termina el script si el archivo no se encuentra
		}
	});
	
	/*define una función llamada currentpage_public() para obtener el nombre de la pagina actual */
	/*$this_page = $_SERVER['SCRIPT_NAME'];:

	$_SERVER['SCRIPT_NAME'] es una variable superglobal en PHP que contiene la ruta
	del script actual en el servidor. Por ejemplo, si el script actual se encuentra 
	en http://example.com/path/to/file.php, $_SERVER['SCRIPT_NAME'] devolverá /path/to/file.php. */
	function currentpage_public(){
		$this_page = $_SERVER['SCRIPT_NAME']; // will return /path/to/file.php
		/*$bits = explode('/',$this_page);:

	explode('/', $this_page) divide la cadena $this_page en un 
	array $bits utilizando '/' como delimitador. Esto es útil para 
	dividir la ruta en partes separadas por directorios. */
	    $bits = explode('/',$this_page);
		/*$this_page = $bits[count($bits)-1];:

	count($bits) devuelve el número de elementos en el array $bits. 
	$bits[count($bits)-1] obtiene el último elemento del array 
	$bits, que es el nombre del archivo actual (file.php en el ejemplo dado). */
	    $this_page = $bits[count($bits)-1]; // will return file.php, with parameters if case, like file.php?id=2
		/*$this_script = $bits[0];:
		$bits[0] obtiene el primer elemento del array $bits,
		que sería la primera parte de la ruta (como file.php en el ejemplo inicial). */
	    $this_script = $bits[0]; // will return file.php, no parameters*/
		/*La función devuelve el tercer elemento del array $bits. Esto
		podría ser útil para recuperar algún componente específico de
		la ruta del script, dependiendo del contexto de la aplicación. */
		 return $bits[2];
	  
	}

	/*esta función está diseñada para obtener y devolver un componente específico 
	de la ruta del script actual en el servidor, particularmente para determinar
	la página actual dentro de una aplicación administrativa. */
	function currentpage_admin(){
		/*$this_page = $_SERVER['SCRIPT_NAME'];:

		$_SERVER['SCRIPT_NAME'] es una variable superglobal en PHP que contiene la ruta 
		del script actual en el servidor. Por ejemplo, si el script actual se encuentra 
		en http://example.com/path/to/file.php, $_SERVER['SCRIPT_NAME'] devolverá /path/to/file.php. */
		$this_page = $_SERVER['SCRIPT_NAME']; // will return /path/to/file.php
		/*$bits = explode('/',$this_page);:

		explode('/', $this_page) divide la cadena $this_page en un array 
		$bits utilizando '/' como delimitador. Esto es útil para dividir 
		la ruta en partes separadas por directorios. */
	    $bits = explode('/',$this_page);
		/*$this_page = $bits[count($bits)-1];:
		count($bits) devuelve el número de elementos en el array $bits. 
		$bits[count($bits)-1] obtiene el último elemento del array $bits, 
		que es el nombre del archivo actual (file.php en el ejemplo dado). */
	    $this_page = $bits[count($bits)-1]; 
		/*$this_script = $bits[0];:
		$bits[0] obtiene el primer elemento del array $bits, que sería 
		la primera parte de la ruta (como file.php en el ejemplo inicial). */
	    $this_script = $bits[0]; 
		/*return $bits[4];:
		La función devuelve el quinto elemento del array $bits. Esto 
		supone que la estructura de la URL está organizada de una manera
		específica donde el quinto elemento es relevante para determinar 
		la página actual dentro del contexto de la aplicación administrativa. */
		 return $bits[4];
	  
	}
  // echo "string " .currentpage_admin()."<br/>";
/*curPageName(): Esta función esta diseñada para obtener el nombre de la página actual a partir de la URL.  */
	function curPageName() {
		/*$_SERVER['REQUEST_URI'] devuelve la parte de la URL que sigue al dominio, incluyendo la ruta y los parámetros de la consulta.
		substr($_SERVER['REQUEST_URI'], 21, strrpos($_SERVER['REQUEST_URI'], '/')-24) realiza dos operaciones:
		substr($_SERVER['REQUEST_URI'], 21, ...) extrae una subcadena de $_SERVER['REQUEST_URI'] comenzando en el índice 21.
		strrpos($_SERVER['REQUEST_URI'], '/')-24 encuentra la posición del último '/' en la URL y luego resta 24 para ajustar el índice.
		En resumen, intenta extraer el nombre de la página de la URL. Sin embargo, el número mágico 21 y la resta de 24 son específicos para un formato particular de URL, por lo que este código podría no ser genérico o confiable para todas las URL. */
 return substr($_SERVER['REQUEST_URI'], 21, strrpos($_SERVER['REQUEST_URI'], '/')-24);
}

  // echo "The current page name is ".curPageName();
	 /*msgBox($msg): Esta función genera un cuadro de mensaje de alerta en JavaScript que muestra el mensaje proporcionado como argumento. */
	function msgBox($msg=""){
		?>
		/*Nota importante: El código PHP dentro de JavaScript podría ser problemático si $msg contiene caracteres especiales o comillas simples. Sería más seguro envolver $msg con comillas dobles para asegurar la salida correcta de JavaScript. */
		<script type="text/javascript">
			 alert(<?php echo $msg; ?>)
		</script>
		<?php
	}
		
?>