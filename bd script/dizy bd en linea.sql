create database dizy;
use dizy;
create table empresa(
idEmpresa int auto_increment ,
nombre varchar(300),
direccion varchar(300),
correo varchar(200),
nit varchar(100),
nrc varchar(100),
giro varchar(1000),
telefono varchar(30),
encargado varchar(200),
primary key (idEmpresa)
);

create table sucursales(
idSucursal int auto_increment ,
nombre varchar(300),
direccion varchar(300),
telefono varchar(30),
idEmpresa int,
primary key (idSucursal),
foreign key(idEmpresa)references empresa(idEmpresa)
);

create table categorias(
idCategoria varchar(10),
nombre varchar(200),
primary key (idCategoria)
);

create table lineasProductos(
idLinea int auto_increment,
nombreLinea varchar(200),
primary key(idLinea)
);
create table FamiliasProductos(
idFamilia int auto_increment,
nombreFamilia varchar(200),
primary key(idFamilia)
);
create table DepartamentosProductos(
idDptProducto int auto_increment,
nombreDptProducto varchar(200),
primary key(idDptProducto)
);


create table productos(
idProducto varchar(25),
descripcion varchar(200),
idCategoria varchar(10),
idLinea int,
idFamilia int,
idDptProducto int,
idProveedor int,
costo double,
precio double,
imagen varchar(700),
primary key (idProducto),
foreign key(idCategoria)references categorias(idCategoria),
foreign key(idLinea)references lineasProductos(idLinea),
foreign key(idFamilia)references FamiliasProductos(idFamilia),
foreign key(idDptProducto)references DepartamentosProductos(idDptProducto),
foreign key(idProveedor)references proveedores(idProveedor)
);

create table existencias(
idProducto varchar(25),
cantidad int,
idSucursal int ,
primary key(idProducto,idSucursal),
foreign key (idProducto)references productos(idProducto),
foreign key(idSucursal)references sucursales(idSucursal)
);

create table proveedores(
idProveedor int auto_increment,
nombre varchar(200),
correo varchar(200),
telefono varchar(15),
direccion varchar(300),
saldo double,
primary key (idProveedor)
);

create table Movimientos(
idMovimiento int ,
nombre varchar(100),
actual int,
idSucursal int ,
primary key(idMovimiento,idSucursal),
foreign key(idSucursal)references sucursales(idSucursal)
);


create table ingresosMercaderiaCompras(
idIngreso int ,
idMovimiento int,
numeroIngreso int,
idProveedor  int,
tipoDocumento varchar(30),
numeroDocumento varchar(100),
fechaDocumento varchar(30),
estadoDocumento varchar(30),
estadoIngreso varchar(30),
fechaCreacion varchar(30),
totalFactura double,
idSucursal int,
primary key(idIngreso,idMovimiento,idSucursal),
foreign key(idProveedor)references proveedores(idProveedor),
foreign key(idMovimiento)references movimientos(idMovimiento),
foreign key(idSucursal)references sucursales(idSucursal)
);

create table detalleIngresoCompras(
lineaDetalle int auto_increment,
idMovimiento int,
numeroIngreso int,
idProducto varchar(25),
precio double,
cantidad int,
total double,
idSucursal int,
primary key(lineaDetalle),
foreign key(idProducto)references productos(idProducto),
foreign key(idMovimiento)references movimientos(idMovimiento),
foreign key(idSucursal)references sucursales(idSucursal)
);


create table orden(
idOrden int ,
nombre varchar(200),
estado varchar(30),
fecha varchar(30),
total double,
idSucursal int,
idEmpleado int(11) ,
primary key(idOrden,fecha,idSucursal),
foreign key(idSucursal)references sucursales(idSucursal),
foreign key(idEmpleado)references empleados(idEmpleado)
);

create table detalleOrden (
lineaDetalle int auto_increment,
idOrden int,
idProducto varchar(25),
precio double,
cantidad int,
total double,
fecha varchar(30),
idSucursal int,
primary key(lineaDetalle),
foreign key(idOrden)references orden(idOrden),
foreign key(idProducto)references productos (idProducto),
foreign key(idSucursal)references sucursales(idSucursal)
);


CREATE TABLE departamentos (
idDepartamento int(11) ,
nombre varchar(100),
PRIMARY KEY (idDepartamento)
);

CREATE TABLE municipio (
idMunicipio int(11)  AUTO_INCREMENT,
nombre varchar(200) DEFAULT NULL,
idDepartamento int(11),
PRIMARY KEY (idMunicipio),
FOREIGN KEY (idDepartamento) REFERENCES departamentos(idDepartamento)
) ;

CREATE TABLE clientes (
  idCliente int(11) NOT NULL AUTO_INCREMENT,
  nombre varchar(200) DEFAULT NULL,
  tipoEmpresa varchar(50) DEFAULT NULL,
  nit varchar(50) DEFAULT NULL,
  nrc varchar(50) DEFAULT NULL,
  direccion varchar(1500) DEFAULT NULL,
  giro varchar(200) DEFAULT NULL,
  idMunicipio int(11) DEFAULT NULL,
PRIMARY KEY (idCliente),
FOREIGN KEY (idMunicipio) REFERENCES municipio (idMunicipio) 
) ;

create table tipoDocumentos(
idDocumento varchar(10),
nombre varchar(50),
primary key(idDocumento)
);

CREATE TABLE empleados (
  idEmpleado int(11) NOT NULL AUTO_INCREMENT,
  nombre varchar(200) DEFAULT NULL,
  dui varchar(30) DEFAULT NULL,
  nit varchar(30) DEFAULT NULL,
  direccion varchar(500) DEFAULT NULL,
  telefono varchar(30) DEFAULT NULL,
  usuario varchar(100) DEFAULT NULL,
  clave varchar(100) DEFAULT NULL,
  numeroEmergencia varchar(30) DEFAULT NULL,
  padre varchar(200) DEFAULT NULL,
  madre varchar(200) DEFAULT NULL,
  foto varchar(500) DEFAULT NULL,
  estado varchar(30) DEFAULT NULL,
  nivel varchar(50) DEFAULT NULL,
  salario double DEFAULT '0',
  comision double DEFAULT '0',
  idSucursal int(11) DEFAULT NULL,
  PRIMARY KEY (idEmpleado),
  KEY idSucursal (idSucursal),
  FOREIGN KEY (idSucursal) REFERENCES sucursales (idSucursal)
) ;

CREATE TABLE correlativos (
  idCorrelativo int(11) NOT NULL AUTO_INCREMENT,
  idDocumento varchar(10) DEFAULT NULL,
  serie varchar(100) DEFAULT NULL,
  desde int(5) unsigned zerofill DEFAULT NULL,
  hasta int(5) unsigned zerofill DEFAULT NULL,
  n_resolucion varchar(45) DEFAULT NULL,
  fecha_resolucion varchar(45) DEFAULT NULL,
  PRIMARY KEY (idCorrelativo),
  KEY idDocumento (idDocumento),
   FOREIGN KEY (idDocumento) REFERENCES tipodocumentos (idDocumento)
) ;

create table cajas(
idNumCaja int,
idSucursal int,
primary key(idNUmCaja,idSucursal),
foreign key(idSucursal)references sucursales(idSucursal)
);

create table correlativosCajas(
linea int auto_increment,
idCorrelativo int,
idNumCaja int,
desde int,
hasta int,
actual int,
estado varchar(50),
idDocumento varchar(10),
idSucursal int,
primary key (linea),
foreign key(idSucursal)references sucursales(idSucursal),
foreign key(idCorrelativo)references correlativos(idCorrelativo),
foreign key(idNumCaja)references cajas(idNumCaja),
foreign key(idDocumento)references tipodocumentos(idDocumento)
);

create table cuentasporCobrar(
idCliente varchar(30) ,
nombre varchar(200),
dui varchar(100),
nit varchar(100),
telefono varchar(20),
fechaCreacion varchar(30),
saldo double,
primary key(idCliente)
);

create table detalleCuentasporCobrar(
lineaDetalle int auto_increment,
idCliente varchar(30),
fechaMovimiento varchar(30),
debe double,
haber double,
primary key(lineaDetalle),
foreign key(idCliente)references cuentasporcobrar(idCliente)
);


create table movimientosInventario(
idEgreso int ,
idMovimiento int,
numeroIngreso int,
fechaMovimiento varchar(30),
salida int,
destino int,
copia varchar(10),
estado varchar(100),
idSucursal int,
primary key(idEgreso,idMovimiento,idSucursal),
foreign key(idMovimiento)references movimientos(idMovimiento),
foreign key(idSucursal)references sucursales(idSucursal),
foreign key(salida)references sucursales(idSucursal),
foreign key(destino)references sucursales(idSucursal)
);

create table detalleMovimientoInventario(
lineaDetalle int auto_increment,
idEgreso int,
idMovimiento int,
numeroIngreso int,
idProducto varchar(25),
precio double,
cantidad int,
total double,
idSucursal int,
primary key(lineaDetalle),
foreign key(idEgreso)references movimientosinventario(idEgreso),
foreign key(idProducto)references productos(idProducto),
foreign key(idMovimiento)references movimientos(idMovimiento),
foreign key(idSucursal)references sucursales(idSucursal)
);


create table facturacion(
idFactura int auto_increment,
idCorrelativo int,
idDocumento varchar(10),
numeroDocumento int,
cliente varchar(200),
nrc varchar(50),
nit varchar(50),
giro varchar(700),
tipoFactura varchar(100),
sumas double,
iva double,
subtotal double,
retencion double,
totalFinal double,
idOrden int,
fechaFactura varchar(30),
estado varchar(50),
idEmpleado int,
idSucursal int,
primary key(idFactura),
foreign key(idSucursal)references sucursales (idSucursal),
foreign key(idDocumento)references tipodocumentos(idDocumento),
foreign key (idOrden)references orden (idOrden)
);









