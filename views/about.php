<?php

	$titulo = "Sobre Nosotros";
	include('../views/plantilla.php');
?>
<!DOCTYPE HTML>
<html>
	<head>
	
		<script type="text/javascript">
			console.log('about');
		</script>
	</head>
	<body>	
	<div>
	<img src="../images/banner.png" \>
	</div>
	</br>
	<div class="uk-container">
		<div class="uk-grid">
			<ul uk-accordion="multiple: true">
				<li class="uk-open">
					<a class="uk-accordion-title" href="#" ><font color="green">Historia</font></a>
					<div class="uk-accordion-content">
						<p>La Universidad Nacional Pedro Henríquez Ureña (UNPHU),  fue fundada en el año de 1966 como la primera Universidad privada, sin fines de lucro, de la ciudad de Santo Domingo, capital de la República Dominicana. Cuenta con una campus de 250,000 mts2 rodeado de áreas verdes y espacios armónicos de estudios.</p>

						<p>Una universidad que ha mantenido su prestigio de excelencia y calidad educativa, y una constante actualización de sus programas y carreras.</p>

						<p>Un personal dispuesto a colaborar con las necesidades de los estudiantes con un servicio personalizado en donde el estudio se convierte en una interacción integral para la mente y el espíritu.</p>
					</div>
				</li>
				<li>
					<a class="uk-accordion-title" href="#"><font color="green">Misión</font></a>
					<div class="uk-accordion-content">
						<p>Formar profesionales, competentes, humanistas, emprendedores y comprometidos con el desarrollo del conocimiento, capaces de aportar soluciones para lograr bienestar social.</p>
					</div>
				</li>
				<li>
					<a class="uk-accordion-title" href="#"><font color="green">Visión</font></a>
					<div class="uk-accordion-content">
						<p>Ser una universidad que fomente la excelencia académica, innovación e investigación, apegada al desarrollo sostenible y la preservación del medio ambiente.</p>
					</div>
				</li>
				<li>
					<a class="uk-accordion-title" href="#"><font color="green">Valores</font></a>
					<div class="uk-accordion-content">
						<ul>
							<li>Compromiso: Firmeza de cumplir lo pactado, contribuyendo positivamente al entorno.</li>
							<li>Responsabilidad: Virtud de asumir nuestras decisiones y sustentar sus resultados.</li>
							<li>Integridad: Permanecer fieles a los buenos principios durante nuestra ejecución.</li>
							<li>Ética: Alineación de la moral con nuestras normas, opiniones y actuaciones.</li>
							<li>Excelencia: Vocación de obtener resultados óptimos en todas nuestras labores.</li>
						</ul>
					</div>
				</li>
			</ul>
		</div>
	</div>
	</body>
</html>