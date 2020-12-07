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
in fecha varchar(30),
in  sucursal int
 )select * from orden where idSucursal=sucursal and fecha=fecha order by idOrden desc limit 1;
 
 
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
 in fecha varchar(30),
 in sucursal int
 )select det.*,pro.descripcion,o.nombre
 from productos as pro,detalleorden as 
 det,orden as o where o.idOrden=det.idOrden and det.idProducto=pro.idProducto and det.idOrden=orden and det.fecha=fecha;
 
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
 in prouducto varchar(25),
 in orden int,
 in fecha varchar(30),
 in sucursal int
 )delete from detalleorden where idOrden=orden and fecha=fecha and idSucursal=sucursal and idProducto=producto;
 
 
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
)update clientes set nombre=nombreCliente,tipoEmpresa=tipoCliente,
nit=nitCliente,nrc=nrcCliente,direccion=direccionCliente,giro=giroCliente,idMunicipio=municipioCliente where idCliente=id;

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

-- para departametos

create procedure buscarDepartamentos(
)select * from departamentos;

create procedure buscarMunicipiobyId(
in idDpt int
)select * from municipio where idDepartamento=idDpt;
 
 
 -- para traer documentos;
 
 create procedure bsucarDoumentosName()
 select * from tipodocumentos;
 
 create procedure traercorrelativofactura(
 in sucursal int,
 in caja int,
 in documento varchar(10)
 )select (actual +1)as actual from correlativoscajas where idSucursal=sucursal and idNumCaja=caja and idDocumento=documento;
 
 
 
 