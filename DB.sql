DROP TABLE IF EXISTS "paquete" CASCADE;
DROP TABLE IF EXISTS "destinos" CASCADE;
DROP TABLE IF EXISTS "ruta" CASCADE;
DROP TABLE IF EXISTS "usuario" CASCADE;

CREATE TABLE "usuario" (
  "id_usuario" serial,
  "nombre" varchar(50)  not null,
  "apellido" varchar(50) not null,
  "correo" varchar(100) not null,
  "clave" varchar(100) not null,
  "roles" json not null,
  "tipo" varchar(100) not null,
  "estado" varchar(1),
  CONSTRAINT "PK_usuario"
  	PRIMARY KEY ("id_usuario")
);

CREATE TABLE "ruta" (
  "id_ruta" serial,
  "id_repartidor" integer not null,
  "paquetes" json not null,
  "condicion" varchar(50) not null,
  "estado" varchar(1),
  CONSTRAINT "PK_ruta"
	PRIMARY KEY ("id_ruta"),
  CONSTRAINT "FK_ruta_id_repartidor"
    FOREIGN KEY ("id_repartidor") REFERENCES "usuario"("id_usuario")
);

CREATE TABLE "destinos" (
  "id_destinos" serial,
  "destinos" json,
  "estado" varchar(1),
  CONSTRAINT "PK_destinos"
	PRIMARY KEY ("id_destinos")
);

CREATE TABLE "paquete" (
  "id_paquete" serial,
  "peso" numeric(2,1) not null,
  "destino" varchar(100),
  "emisor" integer,
  "receptor" integer,
  "tipo" varchar(50),
  "id_ruta" integer,
  "condicion" varchar(50),
  "estado" varchar(1),
  CONSTRAINT "PK_paquete"
	PRIMARY KEY ("id_paquete"),
  CONSTRAINT "FK_Paquete_id_ruta"
    FOREIGN KEY ("id_ruta") REFERENCES "ruta"("id_ruta")
);


INSERT INTO usuario (nombre, apellido, correo, clave, tipo, roles, estado)
    VALUES ('admin', 'admin', 'admin@gmail.com', '$2y$13$p6GUK.ECGHLu8bQtEn3o6uwMF6lqtPB/0.RoQD7tm/Vjdk6fR/j6e', 'ADMIN','["ROLE_ADMIN"]','A');

SELECT * FROM public."usuario"
ORDER BY id_usuario ASC; 

SELECT * FROM public."ruta"
ORDER BY id_ruta ASC; 

SELECT * FROM public."destinos"
ORDER BY id_destinos ASC; 

SELECT * FROM public."paquete"
ORDER BY id_paquete ASC; 
