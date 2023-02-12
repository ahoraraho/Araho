CREATE Table registro_datos (
IdResgistro	int	PRIMARY KEY AUTO_INCREMENT,
IdUsuario	varchar(65) NOT NULL,
facha_ingreso	varchar(128) NOT NULL,
fecha_salida	varchar(11) NOT NULL,
horas_activas	varchar(9) NOT NULL
);

CREATE TABLE Proveedor	
(
idprovee	int	PRIMARY KEY AUTO_INCREMENT,
Nomprovee	varchar(65) NOT NULL,
Dirprovee	varchar(128) NOT NULL,
rucprovee	varchar(11) NOT NULL,
telprovee	varchar(9) NOT NULL,
mailprovee	varchar(128) NOT NULL
);

CREATE TABLE CategoriasProveedor
(
Id	int	PRIMARY KEY AUTO_INCREMENT,
idprovee int (Foreign key) References Proveedor(idprovee)
);


CREATE TABLE TipoVenta
(
Idtipo	int	PRIMARY KEY AUTO_INCREMENT,
Nomtipo	varchar(25) NOT NULL
);


CREATE TABLE MarcasProveedor
(
Id	int	PRIMARY KEY AUTO_INCREMENT,
idprovee int (Foreign key) References Proveedor(idprovee),
idcategoria	int (Foreign key) References Categorias(idcategoria)
);

CREATE TABLE ProductosDigitales
(
Idproducto	int	PRIMARY KEY AUTO_INCREMENT,
Nomprodu	varchar(128) NOT NULL,
Preuni	decimal(10,4) NOT NULL,
idcategoria	int (Foreign key) References Categorias(idcategoria),
estado	varchar(1) NULL
);

CREATE TABLE Servicios
(
IdServicio	int	PRIMARY KEY AUTO_INCREMENT,
NomServicio	varchar(128) NOT NULL,
costo	decimal(10,4) NOT NULL,
estado	varchar(1) NULL
);


CREATE TABLE UsuariosApi
(
Idusuario	int	PRIMARY KEY AUTO_INCREMENT,
NomUsuario  VARCHAR(128) NOT NULL,
emailUsuario	varchar(50) NOT NULL,
Telefono	varchar(9) NULL
);


CREATE TABLE tipoEmpresa
(
IdTipoEmpresa	int	PRIMARY KEY AUTO_INCREMENT,
Nombre  VARCHAR(128) NOT NULL,
email	varchar(50) NOT NULL,
Telefono	varchar(9) NULL
);

CREATE TABLE detalleCompraProveedor
(
Id	int	PRIMARY KEY AUTO_INCREMENT,
idprovee int (Foreign key) References Proveedor(idprovee),
fechaRegistro	date not null
);

CREATE TABLE estadisticasVentas(
    idEstadistica int PRIMARY KEY auto_increment,
    espectativas FLOAT not null,
    ingresosBrutoAnual FLOAT not null,
    ingresosNetoAnual FLOAT not null
);