<?php

class asgClass
{
	var $tabla;
	var $numFields;
	var $campos;
	var $empresa = null;
	var $sucursal = null;
	var $tipos;
	
	var $dbcoment;
	var $dbname;
	
	static function getEmpresa(){
		$id = 0;	
		if(defined("EMPRESA_ID")){
			$id = EMPRESA_ID;
		}
		return $id;
	}
	
	static function getSucursal(){
		$id = 0;	
		if(defined("SUCURSAL_ID")){
			$id = SUCURSAL_ID;
		}
		return $id;
	}
	
	function setVal($nombre, $valor)
	{
		$this->$nombre = mysql_real_escape_string(stripslashes($valor));
	
	}
	
	function getPOST()
	{
		
		echo "<pre>";
		
		foreach($this->campos as $campo)
		{
			$c = ucwords($campo);
			echo "
\${$this->tabla}->{$campo} = (isset(\$_POST['txt{$c}']))?\$_POST['txt{$c}']:\${$this->tabla}->{$campo};";
		}
		echo "
		
\${$this->tabla}->guardar();
		</pre>";
	}
	
	
	function getTEXT($class="frm-asg")
	{
		//title=\"<?php  echo \${$this->tabla}->dbcoment['$campo']; ? > \";
		$t = <<<TEXT
		
		<div class="panel panel-default">
		
			<div class="panel-heading">
	            Default Buttons
	        </div>
			<form role="form" method='post' id='frm{$this->tabla}' action='modulos/sfsdfsdf/pagina.php'>
			<table>
TEXT;
		foreach($this->campos as $campo)
		{
			$c = ucwords($campo);
			$t .=   <<<TEXT2
			
			
				<tr>
					<th style="text-align:right;">{$c}</th>
					
					<td>
						<input class="{$class}" placeholder="{$c}" type='text' name='txt{$c}' id='txt{$c}' value="<?php  echo htmlentities(\${$this->tabla}->{$campo}); ?>"  />
					</td>
				</tr>
TEXT2;
	

		}
		$t .= "
			</tr>
				<tr>
					<td colspan='2' align='center'>
						<button type='submit' class='btn btn-default'>Guardar</button>
					</td>
				</tr>
			</table>
			</form>
			<div id='divRs{$this->tabla}'></div>
			<script language='javascript'>
				asgForm(\$('#frm{$this->tabla}'),\$('#divRs{$this->tabla}'));
			</script>
        </div>
		
		";
		
		echo "<pre style='width:100%'>";
		echo htmlentities($t) ;
		echo "</pre>";
	}
	
	
	function getTEXT2()
	{
		//title=\"<?php  echo \${$this->tabla}->dbcoment['$campo']; ? > \";
		$t = <<<TEXT
		<div class="col-md-12">
			<form class="uk-grid-small" uk-grid role="form" method='post' id='frm{$this->tabla}' >
TEXT;
		foreach($this->campos as $campo)
		{
			$c = ucwords($campo);
			$t .=   <<<TEXT2
			
			<div class="uk-width-1-3@s">
				<label  class="uk-form-label" for="txtNombre">{$c}</label>
				<div class="uk-form-controls">
					<input class="uk-input" placeholder="{$c}" type='text' name='txt{$c}' id='txt{$c}' value="<?php  echo htmlentities(\${$this->tabla}->{$campo}); ?>"  />
				</div>
			</div>
TEXT2;
	

		}
		$t .= "
				<div>
					<button type='submit' class='btn btn-default btnSave'>Guardar</button>
				</div>
			</form>
			<div id='divRs{$this->tabla}'></div>
			<script language='javascript'>
				asgForm(\$('#frm{$this->tabla}'),\$('#divRs{$this->tabla}'));
			</script>
        </div>
		
		";
		
		echo "<pre style='width:100%'>";
		echo htmlentities($t) ;
		echo "</pre>";
	}
	
	public static function getInstancia($tabla, $cod=0){
		$rs = null;
		$ruta = __DIR__;
		$separador = "/";
		
		$filename = $ruta."{$separador}auto{$separador}$tabla.php";
		if(strpos($ruta, '\\')){
			$separador = "\\";
		}
		
		if(is_file($filename)){
			include($filename);
			$codigo = "\$rs = new asg_{$tabla}('{$cod}'); ";
			
		}else
		{
			$codigo = "\$rs = new asgClass('{$tabla}','{$cod}', true); ";
			
		}
		
		eval($codigo);
		return $rs;
	}
	
	function __construct($tabla, $cod = 0, $file = false, $dbname=null)
	{
		$ruta = __DIR__;
		$separador = "/";
		
		$filename = $ruta."{$separador}auto{$separador}$tabla.php";
		if(strpos($ruta, '\\')){
			$separador = "\\";
		}
				
		$this->dbcoment = array();
		$this->tabla = $tabla;
		
		$this->dbname = (is_null($dbname))?DB_NAME:$dbname;
		
		$sql = "select * from `information_schema`.`COLUMNS` where `TABLE_SCHEMA` = '".$this->dbname."' and `TABLE_NAME` = '{$this->tabla}'  order by ordinal_position";
		
		$rs = mysqli_query(asgMng::getCon(), $sql);

		$this->numFields = mysqli_num_rows($rs);
		$this->campos = array();
		
		$this->tipos = array();
		$x=0; 
		while($row = mysqli_fetch_array($rs))
		{
			if($x==0)
			{
				$this->primario = $row['COLUMN_NAME'];
				
			}
			
			$campo = $row['COLUMN_NAME'];
			$this->$campo = "";
			$this->dbcoment[$campo] = $row['COLUMN_COMMENT'];
			$this->campos[] = $campo;
			$x++;
			$this->tipos[$campo] =  $this->etipos($row['DATA_TYPE']);
		}
		
		$pri = $this->primario;
		mysqli_free_result($rs);
		
		if($cod+0 > 0 || strlen($cod) > 1)
		{
			$this->$pri = $cod;
			$this->cargar();
		}
		
		
		if($file)
		{
			
			$fecha = date("d/m/Y");
			
			
			
			$vars = array();
				
			foreach ($this->campos as $key => $value) {
					//$t = $this->tipos[$key];
				$vars[] = "
			public \${$value}; //kkk";
			}
					$vars = implode('', $vars);
					
			
			$pri = $this->primario;
			$sqlI1 = array();
			$sqlI2 = array();
			$parametros = array();
			$tdatos = "";
			$sqlu = array();
			
			
			foreach($this->campos as $x=>$campo)
			{
				if($x > 0)
				{
					//$v = mysql_real_escape_string(stripslashes($this->$campo));
					$v = $this->$campo;
					$sqlI1[] = "`{$campo}`";
					$sqlI2[] = "?";
					$parametros[] = "\$this->{$campo}";
					
					$tdatos .= $this->tipos[$campo];
					
					$sqlu[] = "`{$campo}`=? ";
				}
			}
			
			$sqlI1 = implode(",",$sqlI1);
			$sqlI2 = implode(",",$sqlI2);
			$sqlu= implode(",",$sqlu);
			$parametros = implode(", ",$parametros);
					
			
			$datos = <<<GENERADOR
<?php class asg_{$tabla}{
		
	{$vars}
	
	function __construct(\${$this->primario}=0)
	{
		if(\${$this->primario} > 0){
			\$this->{$this->primario} = \${$this->primario};
			\$this->cargar();
		}
	}
	
	function guardar(){
		\$todoBien = true;	
		if(\$this->{$this->primario} > 0){
			\$sql = "update {$this->dbname}.{$this->tabla} set {$sqlu} where `{$this->primario}` = '\$this->{$this->primario}'";
			
			\$stmt = mysqli_prepare(asgMng::getCon(), \$sql);
			
			mysqli_stmt_bind_param(\$stmt, '{$tdatos}', {$parametros});	
			mysqli_stmt_execute(\$stmt);

		}
		else {
			\$sql = "insert into {$this->dbname}.{$this->tabla} ({$sqlI1}) values ({$sqlI2})";
			
			\$stmt = mysqli_prepare(asgMng::getCon(), \$sql);	
			mysqli_stmt_bind_param(\$stmt, '{$tdatos}', {$parametros});
			mysqli_stmt_execute(\$stmt);
			\$this->{$this->primario} = mysqli_insert_id(asgMng::getCon());
			
		}
		
		return \$todoBien;
	}
				
	function cargar(){
		if(\$this->{$this->primario} > 0){
			\$sql = "select * from {$this->dbname}.{$this->tabla} where `{$this->primario}` = '{\$this->{$this->primario}}'";
			
			\$rs = mysqli_query(asgMng::getCon(), \$sql);
			
			if(mysqli_num_rows(\$rs) > 0)
			{
				\$row = mysqli_fetch_array(\$rs);
				foreach(\$row as \$campo=>\$valor)
				{
					\$this->\$campo = \$valor;
				}
			}
			mysqli_free_result(\$rs);
			
		}
		
	}			
				
}

//Creado en fecha {$fecha}
GENERADOR;
		//	echo $datos;
			$f = fopen($filename,'w');
			fwrite($f, $datos);
			fclose($f);
			
			
		}
	}
	
	
	
	function guardar($mostrarError = true)
	{
		if($this->empresa == null){
			$this->empresa = asgClass::getEmpresa();
		}
		if($this->sucursal == null){
			$this->sucursal = asgClass::getSucursal();
		}
		$todoBien = true;
		$pri = $this->primario;
		$sqlI1 = array();
		$sqlI2 = array();
		$parametros = array();
		$tdatos = "";
		$sqlu = array();
		foreach($this->campos as $x=>$campo)
		{
			if($x > 0)
			{
				//$v = mysql_real_escape_string(stripslashes($this->$campo));
				$v = $this->$campo;
				$sqlI1[] = "`{$campo}`";
				$sqlI2[] = "?";
				$parametros[] = "\$this->{$campo}";
				
				$tdatos .= $this->tipos[$campo];
				
				$sqlu[] = "`{$campo}`=? ";
			}
		}
		
		$sqlI1 = implode(",",$sqlI1);
		$sqlI2 = implode(",",$sqlI2);
		$sqlu= implode(",",$sqlu);
		$errores = "";
		if(strlen($this->$pri)>1 ||$this->$pri > 0)
		{
			$sql = "update {$this->dbname}.{$this->tabla} set {$sqlu} where `{$this->primario}` = '{$this->$pri}'";
			
			
			$stmt = mysqli_prepare(asgMng::getCon(), $sql);
				
			$parametros = implode(", ",$parametros);
			
			$p = "mysqli_stmt_bind_param(\$stmt, \$tdatos, {$parametros});";
			
			eval($p);
			mysqli_stmt_execute($stmt);
			
			
			//mysql_query($sql);
			//$errores = mysql_error();
			if($mostrarError)
			{
				$errores = mysqli_error(asgMng::getCon());
				if($errores != '')
					$todoBien = false;
				$errores;
			}
		}
		else
		{
			$sql = "insert into {$this->dbname}.{$this->tabla} ({$sqlI1}) values ({$sqlI2})";
			
			$stmt = mysqli_prepare(asgMng::getCon(), $sql);
				
			$parametros = implode(", ",$parametros);
			
			$p = "mysqli_stmt_bind_param(\$stmt, \$tdatos, {$parametros});";
						
			eval($p);
			
			mysqli_stmt_execute($stmt);
			if($mostrarError)
			{
				$errores = mysqli_error(asgMng::getCon());
				if($errores != '')
					$todoBien = false;
				$errores;
			}
			$this->$pri = mysqli_insert_id(asgMng::getCon());
			
		}

		return array( 
			"saved"=> $todoBien,
			"object" => $this,
			"error"=> $errores);
	}
	
	function cargar()
	{
		$pri = $this->primario;
		$sql = "select * from {$this->dbname}.{$this->tabla} where `{$this->primario}` = '{$this->$pri}'";
		
		
		$rs = mysqli_query(asgMng::getCon(), $sql);
		
		if(mysqli_num_rows($rs) > 0)
		{
			$row = mysqli_fetch_array($rs);
			foreach($this->campos as $x=>$campo)
			{
				$this->$campo = $row[$campo];
			}
		}
		mysqli_free_result($rs);
	}
	
	
	function etipos($t)
	{
		switch($t)
		{
			case "varchar":
				$t = 's';
			break;
			case "datetime":
			case "date":
				$t = 's';
			break;
			
			case "smallint";
				$t = 'i';
			break;
			
			case "text";
				$t = 's';
			break;
			
			default:
				$t = 's';
			break;
			
		}
		return substr($t, 0, 1);
	}

}


//echo rutaRelativa(__FILE__);
//echo"<br/>".rutaRelativa(__DIR__);
function rutaRelativa($ruta){
	$pos = strlen(getcwd());
	return substr($ruta, $pos);
	}
?>