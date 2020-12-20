 -- procedimientos dizy
 
 -- para  productos
 create procedure crearProducto(
in categoria varchar(10),
in id varchar(30),
in descripcion varchar(200),
in linea varchar(200),
in familia varchar(200),
in departamento varchar(200),
in costo double,
in precio double,
in imagen varchar(700)
 )insert into productos values(id,descripcion,categoria,linea,familia,departamento,costo,precio,imagen);
 
 create procedure actualizarProducto(
 in categoria varchar(10),
 in id varchar(30),
 in descripcion varchar(200),
in linea varchar(200),
in familia varchar(200),
in departamento varchar(200),
in costo double,
in precio double,
in imagen varchar(700)
 )update productos set idCategoria=categoria,
 descripcion=descripcion,costo=costo,precio=precio,linea=linea,familia=familia,departamento=departamento,imagen=imagen where idProducto=id;
 

 create procedure buscarProductobyId(
 in id varchar(30)
 )select * from productos where idProducto=id;
 
 create procedure buscarProductobyName(
 in nombre varchar(30)
 )select * from productos where descripcion like nombre;
 
 
 create procedure buscarProducto(
 )select * from productos;
 
 -- para categorias
 
 
 create procedure crearCategoria(
 in id varchar(10),
 in categoria varchar(200)
 )insert into categorias values(id,categoria);
 
 
 create procedure actualizarCategoria(
 in id varchar(10),
 in categoria varchar(200)
 )update categorias set nombre=categoria where idCategoria=id;
 
 create procedure buscarCategoria(
 )select * from categorias ;

 create procedure buscarCategoriabyName(
 in nombreCaegoria varchar(30)
 )select * from categorias  where nombre like nombreCaegoria;
 
 create procedure buscarCategoriabyId(
 in id varchar(30)
 )select * from categorias  where idCategoria=id;

 
 -- para movimientos
 
 create procedure listarIngresoCompras(
 in sucursal int
 )select inc.numeroIngreso,inc.idProveedor,prov.nombre as proveedor,inc.tipoDocumento,inc.fechaCreacion,
inc.estadoDocumento,inc.totalFactura,inc.numeroDocumento,inc.idSucursal
from ingresosmercaderiacompras as inc,proveedores as prov where inc.idProveedor=prov.idProveedor
 and inc.idSucursal=sucursal order by inc.fechaCreacion desc;
 
 create procedure listarEgresos(
 in sucursal int
 )select mi.numeroIngreso,mi.fechaMovimiento,mi.estado,mi.destino,su.nombre as destino
from sucursales as su,movimientosinventario as mi where mi.destino=su.idSucursal 
and mi.idMovimiento=5  and mi.idSucursal=sucursal order by  mi.fechaMovimiento DESC ,mi.numeroIngreso ASC ;
 
 
 
 
 create procedure crearIngresoCompra(
in id int ,
in movimiento int,
in numero int,
in proveedor  int,
in tipodoc varchar(30),
in numerodoc varchar(100),
in fechadoc varchar(30),
in estadodoc varchar(30),
in estadoingreso varchar(30),
in fecha varchar(30),
in total double,
in sucursal int
)insert into ingresosmercaderiacompras values(id,movimiento,numero,proveedor,tipodoc,numerodoc,fechadoc,estadodoc,estadoingreso,fecha,total,sucursal);
 
 
 create procedure crearDetalleIngreso(
in movimiento int,
in numeroingreso int,
in producto varchar(25),
in precio double,
in cantidad int,
in total double,
in sucursal int
 )insert into detalleingresocompras values(null,movimiento,numeroingreso,producto,precio,cantidad,total,sucursal);
 

 
 create procedure buscarActual(
 in id int,
 in sucursal int
 )select (actual+1) as actual from movimientos where idMovimiento=id and idSucursal=sucursal;
 
 create procedure actualizarActual(
 in id int,
 in sucursal int,
 in actual int
 )update movimientos set actual=actual where idMovimiento=id and idSucursal=sucursal;
 
 
 create procedure crearMovimientoSalida(
 in egreso int,
 in movimiento int,
 in numero int,
 in fecha varchar(30),
 in salida int,
 in destino int,
 in copia varchar(10),
 in estado varchar(100),
 in sucursal int
 )insert into movimientosinventario values(egreso,movimiento,numero,fecha,salida,destino,copia,estado,sucursal);
 
 create procedure crearDetalleSalida(
 in egreso int,
 in movimiento int,
 in numero int,
 in producto varchar(25),
 in precio double,
 in cantidad int,
 in total double,
 in sucursal int
 )insert into detallemovimientoinventario values(null,egreso,movimiento,numero,producto,precio,cantidad,total,sucursal);
 
 
 
 -- para sucursales
 create procedure traerSucursales(
 in sucursal int
 )select * from sucursales where idSucursal!=sucursal;
 
 create procedure traerCajasSucursales(
 in sucursal int
 )select * from cajas where idSucursal=sucursal;
 
 create procedure traerCorrelativoscaja(
 in sucursal int,
 in caja int
 )select co.idCorrelativo,co.idDocumento,co.serie,co.n_resolucion,co.desde,co.hasta,cocaja.idNumCaja,cocaja.desde as desdecaja,cocaja.hasta as hastacaja,
cocaja.actual as actualcaja,cocaja.estado as estadocaja,cocaja.idSucursal,cocaja.linea
from correlativos as co,correlativoscajas as cocaja
 where cocaja.idCorrelativo=co.idCorrelativo and cocaja.idDocumento=co.idDocumento
 and cocaja.idSucursal=sucursal and cocaja.estado='ACTIVO' and cocaja.idNumCaja=caja order by cocaja.linea  asc;
 
 create procedure validarDocumentoCaja(
 in documento varchar(10),
 in correlativo int,
 in caja int,
 in sucursal int
 )select * from correlativoscajas where idDocumento=documento 
 and idCorrelativo=correlativo and idNumCaja=caja and idSucursal=sucursal;
 
 create procedure validarSerie(
 in se varchar(100),
 in documento varchar(10)
 )
 select * from correlativos where serie=se  and idDocumento=documento;
 
 create procedure crearCorrelativosCajas(
 in correlativo int,
 in caja int,
 in desde int ,
 in hasta int,
 in actual int,
 in estado VARCHAR(50),
 in documento varchar(10),
 in sucursal int
 )insert into correlativoscajas values(null,correlativo,caja,desde,hasta,actual,estado,documento,sucursal);
 
 create procedure traerCorrelativos(
 in documento varchar(10)
 )select * from correlativos where idDocumento=documento;
 
 
 create procedure crearCorrelativos(
 in documento varchar(10),
 in serie varchar(100),
 in desde int,
 in hasta int,
 in resolucion varchar(45),
 in fecha varchar(45)
 )insert into correlativos values(null,documento,serie,desde,hasta,resolucion,fecha);
 
 
 
 -- para proveedores 
 create procedure crearProveedor(
in nombre varchar(200),
in correo varchar(200),
in telefono varchar(15),
in direccion varchar(300)
)insert into proveedores values(null,nombre,correo,telefono,direccion,0);
 
 
 create procedure actualizarProveedor(
in id int,
in nombre varchar(200),
in correo varchar(200),
in telefono varchar(15),
in direccion varchar(300)
 )update proveedores set nombre=nombre,correo=correo,telefono=telefono,direccion=direccion where idProveedor=id;
 

 create procedure buscarProveedorbyId(
 in id varchar(30)
 )select * from proveedores where idProveedor=id;
 
 create procedure buscarProveedorbyName(
 in nombreProveedor varchar(30)
 )select * from proveedores where nombre like nombreProveedor;
 
 
 create procedure buscarProveedor(
 )select * from proveedores;
 
 create procedure actualizarSaldo(
 in proveedor int,
 in nuevosaldo double
 )UPDATE proveedores  set saldo=nuevosaldo where idProveedor=proveedor;
 
 
 
 -- para existencias 
 create procedure crearExistencia(
 in producto varchar(25),
 in cantidad int,
 in sucursal int
 )insert into existencias values(producto,cantidad,sucursal);
 
 create procedure actualizarExistencia(
 in producto varchar(25),
 in cantidad int,
 in sucursal int
 )update existencias set cantidad=cantidad where idProducto=producto and idSucursal=sucursal; 
 
 create procedure buscarExistenciabyId(
  in producto varchar(25),
 in sucursal int
 )select * from existencias where idProducto=producto and idSucursal=sucursal;
 
 create procedure buscarExistenciaSucursales(
 in producto varchar(25)
 ) 
select e.idProducto,e.cantidad,su.nombre,pro.descripcion 
from existencias as e,sucursales as su,productos as pro 
where e.idSucursal=su.idSucursal  and e.idProducto=pro.idProducto and e.idProducto=producto; 
 
 
 -- para ordenes
 create procedure crearOrden(
 in orden int,
 in nombre varchar(200),
 in estado varchar(30),
 in sucursal int,
 in fecha varchar(30),
 in total double,
 in empleado int
 )insert into orden values(orden,nombre,estado,fecha,total,sucursal,empleado);
 
 create procedure crearDetalleOrden(
 in orden int,
 in producto varchar(25),
 in precio double,
 in cantidad int,
 in total double,
 in fecha varchar(30),
 in sucursal int
)insert into detalleorden values (null,orden,producto,precio,cantidad,total,fecha,sucursal);
				
 create procedure buscarOrdenActual(
in fe varchar(30),
in  sucursal int
 )select * from orden where idSucursal=sucursal and fecha=fe order by idOrden desc limit 1;
 
 
 create procedure buscarOrdenesPendientes(
in fechaNueva varchar(30),
in sucursal int
 )select  * from orden where fecha=fechaNueva and idSucursal=sucursal and estado='PENDIENTE' order by idOrden asc;
 
create procedure buscarOrdenesbyVendedor(
in fechaNueva varchar(30),
in sucursal int,
in usuario int
 )select  * from orden where fecha=fechaNueva and idSucursal=sucursal and estado='PENDIENTE' and idEmpleado=usuario order by idOrden asc;
 
 
 create procedure traerOrdenFactura(
 in orden int,
 in fe varchar(30),
 in sucursal int
 )select det.*,pro.descripcion,o.nombre
 from productos as pro,detalleorden as 
 det,orden as o where o.idOrden=det.idOrden and det.idProducto=pro.idProducto
 and det.idOrden=orden and  o.fecha=fe and det.fecha=fe ;
 
 create procedure eliminarOrden(
 in orden int,
 in fecha varchar(30),
 in sucursal int
 )delete  from orden where idOrden=orden and fecha=fecha and idSucursal=sucursal limit 1;
 
 create procedure eliminarDetalleOrden(
 in orden int,
 in fecha varchar(30),
 in sucursal int
 )delete  from detalleorden where idOrden=orden and fecha=fecha and idSucursal=sucursal;
 
 create procedure eliminarItemOrden(
 in producto varchar(25),
 in orden int,
 in fecha varchar(30),
 in sucursal int
 )delete from detalleorden where idOrden=orden and fecha=fecha and idSucursal=sucursal and idProducto=producto;
 
 create procedure actualizarEstadoOrden(
 in orden int,
 in fe varchar(30),
 in sucursal int,
 in es varchar(30) 
 )update orden set estado='FACTURADO' where idOrden=orden and fecha=fe and estado=es and idSucursal=sucursal;
 
 create procedure actualizartotalorden(
 in orden int,
 in fe varchar(30),
 in sucursal int,
 in tot double
 )update orden set total=tot where idOrden=orden and fecha=fe  and idSucursal=sucursal;
 
  create procedure FacturarOrdenEstado(
 in orden int,
 in fe varchar(30),
 in sucursal int
 )update orden set estado='FACTURADO' where idOrden=orden and fecha=fe  and idSucursal=sucursal;
 
 
 create procedure actualizarPrecioOrden(
 in producto varchar(25),
 in orden int,
 in fecha varchar(30),
 in sucursal int,
 in pre double,
 in can int,
 in tot double
 )update detalleorden set precio=pre,cantidad=can,total=tot 
 where idOrden=orden and idProducto=producto and idSucursal=sucursal and fecha=fecha;
 
 
 -- clientes
 CREATE  PROCEDURE crearCliente(
in nombre varchar(200),
in tipo varchar(50),
in nit varchar(50),
in nrc varchar(50),
in direccion varchar(1500),
in giro varchar(200),
in municipio int
)insert into clientes values(null,nombre,tipo,nit,nrc,direccion,giro,municipio);



CREATE  PROCEDURE actualizarCliente(
 in id int,
in nombreCliente varchar(200),
in tipoCliente varchar(50),
in nitCliente varchar(50),
in nrcCliente varchar(50),
in direccionCliente varchar(1500),
in giroCliente varchar(200),
in municipioCliente int
)
update clientes set nombre=nombreCliente,tipoEmpresa=tipoCliente,
nit=nitCliente,nrc=nrcCliente,direccion=direccionCliente,giro=giroCliente,idMunicipio=municipioCliente
 where idCliente=id;
 
create procedure buscarCliente(
)select * from clientes;

create procedure buscarClientebyName(
in nombreCliente varchar(200)
)select * from clientes where nombre like nombreCliente;

create procedure buscarClienteNrc(
in nrcEmpresa varchar(50)
)select * from clientes where nrc=nrcEmpresa;

create procedure buscarClientebyId(
in id int
)select cli.idCliente,cli.nombre as nombreempresa,cli.tipoEmpresa,cli.nit,cli.nrc,cli.direccion,cli.giro,cli.idMunicipio,dpt.*
from departamentos as dpt ,clientes as cli ,municipio as mu where
 cli.idMunicipio=mu.idMunicipio and mu.idDepartamento=dpt.idDepartamento and cli.idCliente=id;


-- para cuentas por cobrar

create procedure crearCuentaporCobrar(
in id varchar(30),
in nombre varchar(200),
in dui varchar(100),
in nit varchar(100),
in telefono varchar(30),
in fecha varchar(30)
)insert into cuentasporCobrar values(id,nombre,dui,nit,telefono,fecha,0.00);

create procedure actualizarCuentaPorCobrar(
in id varchar(30),
in nom varchar(200),
in du varchar(100),
in ni varchar(100),
in tel varchar(30)
)update cuentasporcobrar set nombre=nom,dui=du,nit=nit,telefono=tel where idCliente=id;

create procedure actualizarSaldoCuentaPorCobrar(
in id varchar(30),
in monto double
)update cuentasporcobrar set saldo=monto where idCliente=id;

create procedure buscarCuentaporCobrar(
)select * from cuentasporcobrar;

create procedure buscarCuentabyName(
in nom varchar(200)
)select * from cuentasporcobrar where nombre like nom;

create procedure buscarCuentaporCobrarbyId(
in id varchar(30)
)select * from cuentasporcobrar where idCliente=id;


-- para departametos

create procedure buscarDepartamentos(
)select * from departamentos;

create procedure buscarMunicipiobyId(
in idDpt int
)select * from municipio where idDepartamento=idDpt;
 
 
 -- para traer documentos;
 
 create procedure buscarDoumentosName()
 select * from tipodocumentos;
 
 create procedure traercorrelativofactura(
 in sucursal int,
 in caja int,
 in documento varchar(10)
 )select (actual +1)as actual,idCorrelativo
 from correlativoscajas where idSucursal=sucursal
 and idNumCaja=caja and idDocumento=documento and estado='ACTIVO' order by linea asc;
 
 create procedure crearFactura(
in correlativo int,
in documento varchar(10),
in numerodoc int,
in cliente varchar(200),
in nrc varchar(50),
in nit varchar(50),
in giro varchar(700),
in tipoFactura varchar(100),
in sumas double,
in iva double,
in subtotal double,
in retencion double,
in totalFinal double,
in idOrden int,
in fechaFactura varchar(30),
in estado varchar(50),
in idEmpleado int,
in idSucursal int
 )insert into facturacion values(null,correlativo,documento,numerodoc,cliente,nrc,nit,giro,tipoFactura,sumas,iva,subtotal,
 retencion,totalFinal,idOrden,fechaFactura,estado,idEmpleado,idSucursal);

 
 
 
 
 
 
 