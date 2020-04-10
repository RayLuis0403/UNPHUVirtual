<?php

function obtenerUsuario(){
	
	return isset($_SESSION['sistemaUser']) ? unserialize($_SESSION['sistemaUser']) : null;
}

function obtenerEmpresa(){
	return new asgClass('empresa',$_SESSION['sistemaCompany']);
}


function obtenerSucursal(){
	return new asgClass('empresa_sucursal',$_SESSION['sistemaSucursal']);
}

class usuario extends asgClass
{
	
	static function generarClave($clave){
		$salt = "amadis";
		return md5("{$clave}{$salt}");
	}
	
	
	public static function login($email, $password){
		$rs = false;
		include_once('util.php');

		$dt = new dataTable("SELECT id, clave FROM usuario WHERE email = '{$email}'");
		
		if($dt->numRows > 0){
			$fila = $dt->getRow(0);
			if(decrypt($fila['clave']) == $password){
				$usuario = new usuario($fila['id']);
				$_SESSION['sistemaUser'] = serialize($usuario);
				
				return array( 
					"validUser"=> true,
					"user" => $usuario,
					"error"=> "");
			}
		}
		
		return array( 
			"validUser"=> false,
			"user" => null,
			"error"=> "Usuario o Contraseña invalido." );
		
	}
	
	function __construct($cod=0)
	{
		parent::__construct("usuario",$cod);
	}
	
	function __toString(){
		
		return $this->nombre;
	}
	
	function setClave($clave)
	{
		include_once('util.php');
		$this->clave = encrypt($clave);
		$this->guardar();
		
	}
}



class documentos_detalle extends asgClass
{
	var $codigo;
	var $codigo_item;
	var $nombre;
	var $cantidad;
	var $precio;
	var $total;
	var $descuento;
	
	
	function __construct($codigo, $codigo_item, $nombre, $total, $cantidad, $precio, $descuento)	
	{
		parent::__construct("documentos_detalle");
		$this->codigo_item = $codigo_item;
		$this->codigo = 0;
		$this->marticulo = $codigo;
		$this->nombre = $nombre;
		$this->total = $total;
		$this->cantidad = $cantidad;
		$this->precio = $precio;
		$this->descuento = $descuento;
	}
	
}

class documentos extends asgClass
{
	var $detalles = array();
	var $clienteAtencionA;
	
	function __construct($id = 0)
	{
		parent::__construct("documentos");
		$this->detalles = array();
		if($id > 0)
		{
			$this->cod = $id;
			$this->cargar();
		}
	}
	
	function cargar()
	{
		parent::cargar();
					
		$sql = "select * from documentos_detalle WHERE documento = {$this->cod}";
		$rs = asgMng::query($sql);
		
		while($row = mysqli_fetch_array($rs))
		{
				
			$this->addDetalle( $row['marticulo'],  $row['codigo_item'],  $row['nombre'], $row['total'], $row['cantidad'], $row['precio'],$row['descuento']);
							
		}
		
		$sql = "select * from clientes where cod = '{$this->cliente}'";
		$rs = asgMng::query($sql);
		if(mysqli_num_rows($rs) > 0)
		{
			$fila = mysqli_fetch_array($rs);
			$this->clienteAtencionA = $fila['contacto'];
			$this->cnombre = $fila['nombre'];	
		}
		
	}
	
	static function cancelar($cod)
	{
		$sql = "update documentos set estado = 0 where cod = '$cod' ";
		asgMng::query($sql);
	}
	
	function getContacto()
	{
		$sql = "select email from clientes where cod = '{$this->cliente}'";
		
		$row = mysqli_fetch_row(asgMng::query($sql));
		
		return $row[0];	
	}
	
	function addDetalle($codigo, $codigo_item, $nombre, $total, $cantidad, $precio,$descuento)
	{
		
		$this->detalles[] = new documentos_detalle($codigo, $codigo_item,  $nombre, $total, $cantidad, $precio,$descuento);
		
		//$this->totalc += $monto;
	}
	
	function imprimir(){
		
	
	}
	
	//En esta funcion se aplica el comprobante a la factura
	function aplicarComprobante()
	{
		if(strlen($this->ncf) < 10 && $this->tipoImpuesto > 0 && $this->tipo == "factura")
		{
			asgMng::query('lock tables tipocomprobantes');
			$sql = "select tc.id, tc.ultimoNCF from tipoimpuesto ti
left join tipocomprobantes tc on tc.id = ti.tipoNCF
where ti.id = {$this->tipoImpuesto}";
			
			$rs = asgMng::query($sql);
			if(mysqli_num_rows($rs) > 0)
			{
				$row = mysqli_fetch_array($rs);
				$uncf = $row["ultimoNCF"];
				$uncf++;
				$this->ncf = strtoupper($uncf);
				$this->guardar();
				$id = $row["id"];
				$sql = "update tipocomprobantes set ultimoNCF = '$uncf' where id = $id";
				asgMng::query($sql);
			}
			asgMng::query('unlock tables');
		}
		
	}
	
	
	
	function guardar($mostrarError = true)
	{
		$this->empresa = EMPRESA_ID;
		$this->sucursal = asgClass::getSucursal();
		$this->aplicarComprobante();
		$rs = true;
		if(strlen($this->cod) > 0 && $this->cod+0 != 0)
		{
			$this->pendiente = $this->total;
			parent::guardar();
		}
		else
		{
			
			$this->numero = utils::getProximoId($this->tipo);
			$this->estado = 1;
			$this->pendiente = $this->total;
			parent::guardar();
			
		}
		
		if(mysqli_error(asgMng::getCon()))
		{
			$rs = false;
		}
	
		asgMng::query("DELETE FROM documentos_detalle WHERE documento = {$this->cod}");
		
		foreach($this->detalles as $articulo)
		{
			$articulo->codigo = 0;
			$articulo->documento = $this->cod;
			//print_r($articulo);
			$articulo->guardar();
		}

		return $rs;

	}
	
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	
	
	
		class mpagos extends asgClass 
		{
			var $cod; 	//int
			var $cliente; //int
			var $nombre; 	//string
			var $concepto; 	//blob
			var $valor; 	//real
			var $fecha; 	//timestamp
			var $formaPago; 	//string
			var $Banco; 	//int
			var $referencia; 	//string
			var $usuario; 	//string
			var $facturas;
			var $aplicar;
			var $detalleCarga;
			
			var $dnumero;
			var $dtotal;
			var $dfecha;
			
			
			function destino($facturas, $aplicar)
			{
				$this->facturas = $facturas;
				$this->aplicar = $aplicar;
			}
		
			function __construct($cod=0)
			{
				parent::__construct('mpagos',$cod);
			}
			
			function imprimir()
			{
				
			}
			
			function guardar($mostrarError = true)
			{
				$rs = true;
				
				
				if(strlen($this->cod) > 0 && $this->cod+0 != 0){
					
					$this->cod = utils::getProximoId('recibo_ingreso');
				}
				
				
				parent::guardar();
				
				$sql = "delete from pagodetalle where pago = $this->id";
				asgMng::query($sql);
				
				foreach($this->facturas as $id=>$factura)
				{
						
					$monto = $this->aplicar[$id];
					if($monto > 0)
					{
						$pd = new pagodetalle();
						$pd->pago = $this->id; 	//int
						$pd->factura = $factura; 	//int
						$pd->monto = $monto; 	//real
						$pd->guardar();
						
						$sql = "UPDATE documentos SET pendiente = total - (SELECT SUM(monto) FROM pagodetalle WHERE factura = '{$factura}') WHERE cod = '{$factura}'";
						asgMng::query($sql);
						unset($pd);
					}
					
					
				}
				
				if(mysqli_error(asgMng::getCon()))
				{
						$rs = false;
				}
				return $rs;

			}
			
			function cargar()
			{
				$sql = "select * from mpagos where id = '$this->id'";
				$rs = asgMng::query($sql);
				$row = mysqli_fetch_array($rs);
				$this->cod = $row['cod'];
				$this->cliente = $row['cliente'];
				$this->nombre = $row['nombre'];
				$this->concepto = $row['concepto'];
				$this->valor = $row['valor'];
				$this->fecha = $row['fecha'];
				$this->formaPago = $row['formaPago'];
				$this->Banco = $row['Banco'];
				$this->referencia = $row['referencia'];
				$this->usuario = $row['usuario'];
				
				$sql = "select pd.*, d.fecha, d.total, d.numero from pagodetalle pd
				left join documentos d on pd.factura = d.cod
				where pago = '$this->id'";
				$rs = asgMng::query($sql);
				$this->detalleCarga = array();
				while($row = mysqli_fetch_array($rs))
				{
					$pd = new pagodetalle();
					$pd->cod = $row['cod'];
					$pd->pago = $row['pago'];
					$pd->factura = $row['factura'];
					$pd->monto = $row['monto'];
					$pd->dfecha = $row['fecha'];
					$pd->dtotal = $row['total'];	
					$pd->dnumero = $row['numero'];
					$this->detalleCarga[] = $pd;
				}
			
			}
			
			function validarEntrada()
			{
				$this->cod = $this->cod +0;
				$this->nombre = $this->nombre ;
				$this->concepto = $this->concepto ;
				$this->valor = $this->valor +0;
				$this->fecha = $this->fecha ;
				$this->formaPago = $this->formaPago ;
				$this->Banco = $this->Banco +0;
				$this->referencia = $this->referencia ;
				$this->usuario = $this->usuario ;
			
			
			}
		
		}
			
	
	class pagodetalle extends asgClass
	{
		var $cod; 	//int
		var $pago; 	//int
		var $factura; 	//int
		var $monto; 	//real
		
	
		function __construct($cod = 0)
		{
			parent::__construct('pagodetalle',$cod);
		}
		
		function guardar($mostrarError = true)
		{
			$rs = true;
			parent::guardar();
			return $rs;
		}
				
			
		
		function cargar()
		{
			parent::cargar();
						
			$sql = "select * from documentos_detalle WHERE documento = {$this->cod}";
			$rs = asgMng::query($sql);
			
			while($row = mysqli_fetch_array($rs))
			{
				$this->addDetalle( $row['marticulo'],  $row['nombre'], $row['total'], $row['cantidad'], $row['precio']);			
			}
			
			$sql = "select * from clientes where cod = '{$this->cliente}'";
			$rs = asgMng::query($sql);
			if(mysqli_num_rows($rs) > 0)
			{
				$fila = mysqli_fetch_array($rs);
				$this->clienteAtencionA = $fila['contacto'];
				$this->cnombre = $fila['nombre'];	
			}
			
		}
		
		function validarEntrada()
		{
			$this->cod = $this->cod +0;
			$this->tipoFactura = $this->tipoFactura ;
			$this->tipoImpuesto = $this->tipoImpuesto +0;
			$this->valorImpuesto = $this->valorImpuesto +0;
			$this->fecha = $this->fecha ;
			$this->vencimiento = $this->vencimiento ;
			$this->ncf = $this->ncf ;
			$this->cliente = $this->cliente +0;
			$this->detalle = $this->detalle ;
			$this->subtotal = $this->subtotal +0;
			//$this->total = $this->total +0;
			$this->generada = $this->generada +0;
			$this->mes = $this->mes +0;
			$this->per = $this->per +0;
			$this->estado = $this->estado +0;
		
		
		}
	
	}