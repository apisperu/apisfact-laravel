CREATE TABLE IF NOT EXISTS products (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  descripcion varchar(255),
  codProducto varchar(255),
  unidad varchar(255),
  mtoValorUnitario decimal(10,2),
  companyRuc varchar(11),
  updated_at datetime,
  created_at datetime
);

CREATE TABLE IF NOT EXISTS clients (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  rznSocial varchar(255),
  tipoDoc varchar(255),
  numDoc varchar(255),
  direccion varchar(255),
  companyRuc varchar(11),
  updated_at datetime,
  created_at datetime
);

CREATE TABLE IF NOT EXISTS sales (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  tipoOperacion varchar(255),
  tipoDoc varchar(255),
  serie varchar(255),
  correlativo varchar(255),
  fechaEmision varchar(255),
  tipoMoneda varchar(255),
  clientId int(11),
  companyRuc varchar(255),
  companyRazonSocial varchar(255),
  companyDireccion varchar(255),
  mtoOperGravadas decimal(10,2),
  mtoIGV decimal(10,2),
  totalImpuestos decimal(10,2),
  valorVenta decimal(10,2),
  mtoImpVenta decimal(10,2),
  ublVersion varchar(255),
  sunatResponse varchar(255),
  updated_at datetime,
  created_at datetime
);

CREATE TABLE IF NOT EXISTS sale_details (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  saleId int(11),
  productId int(11),
  cantidad decimal(10,2),
  mtoValorVenta decimal(10,2),
  mtoBaseIgv decimal(10,2),
  porcentajeIgv decimal(10,2),
  igv decimal(10,2),
  tipAfeIgv decimal(10,2),
  totalImpuestos decimal(10,2),
  mtoPrecioUnitario decimal(10,2),
  updated_at datetime,
  created_at datetime
);

CREATE TABLE IF NOT EXISTS legends (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  saleId int(11),
  code varchar(255),
  value varchar(255),
  updated_at datetime,
  created_at datetime
);

-- Clients
insert into clients (rznSocial, tipoDoc, numDoc, direccion, companyRuc) values ('Juan Perez', '1', '12345678', 'jr huanuco', '12345678987');
insert into clients (rznSocial, tipoDoc, numDoc, direccion, companyRuc) values ('Jorge Chuqui', '1', '87654321', 'jr cajamarca', '12345678987');

-- Products
insert into products (descripcion, codProducto, unidad, mtoValorUnitario, companyRuc) values ('Leche', 'P001', 'NIU', 5.80, '12345678987');
insert into products (descripcion, codProducto, unidad, mtoValorUnitario, companyRuc) values ('Aceite', 'P002', 'NIU', 9.80, '12345678987');
insert into products (descripcion, codProducto, unidad, mtoValorUnitario, companyRuc) values ('Arroz', 'P003', 'NIU', 12.50, '12345678987');