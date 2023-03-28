DROP TABLE IF EXISTS "peticion" CASCADE;
DROP TABLE IF EXISTS "edificio" CASCADE;
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

CREATE TABLE "edificio" (
  "id_edificio" serial,
  "descripcion" varchar(200) not null,
  "condicion" varchar(50) not null,
  "costo" numeric(6) not null,
  "id_asesor" integer,
  "estado" varchar(1),
  CONSTRAINT "PK_edificio"
	PRIMARY KEY ("id_edificio"),
  CONSTRAINT "FK_edificio_id_asesor"
    FOREIGN KEY ("id_asesor") REFERENCES "usuario"("id_usuario")
);


CREATE TABLE "peticion" (
  "id_peticion" serial,
  "id_usuario" integer not null,
  "id_edificio" integer not null,
  "condicion" varchar(50) not null,
  "estado" varchar(1),
  CONSTRAINT "PK_peticion"
	PRIMARY KEY ("id_peticion"),
  CONSTRAINT "FK_peticion_id_edificio"
    FOREIGN KEY ("id_edificio") REFERENCES "edificio"("id_edificio"),
  CONSTRAINT "FK_peticion_id_usuario"
    FOREIGN KEY ("id_usuario") REFERENCES "usuario"("id_usuario")
);

INSERT INTO usuario (nombre, apellido, correo, clave, tipo, roles, estado)
    VALUES ('admin', 'admin', 'admin@gmail.com', '$2y$13$p6GUK.ECGHLu8bQtEn3o6uwMF6lqtPB/0.RoQD7tm/Vjdk6fR/j6e', 'ADMIN','["ROLE_ADMIN"]','A');

SELECT * FROM public."usuario"
ORDER BY id_usuario ASC; 

SELECT * FROM public."peticion"
ORDER BY id_peticion ASC; 

SELECT * FROM public."edificio"
ORDER BY id_edificio ASC; 
