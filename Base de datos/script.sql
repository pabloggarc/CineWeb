CREATE TABLE public."Pelicula" (
	"ID" serial NOT NULL,
	nombre varchar(30) NOT NULL,
	sinopsis varchar(500) NOT NULL,
	web varchar(200) NOT NULL,
	titulo varchar(30) NOT NULL,
	duracion integer NOT NULL,
	"año" integer NOT NULL,
	"ID_Clasificacion" integer NOT NULL,
	"ID_Distribuidora" integer NOT NULL,
	CONSTRAINT "Pelicula_pk" PRIMARY KEY ("ID")

);
-- ddl-end --
ALTER TABLE public."Pelicula" OWNER TO gczgoasf;
-- ddl-end --

-- object: public."Sala" | type: TABLE --
-- DROP TABLE IF EXISTS public."Sala" CASCADE;
CREATE TABLE public."Sala" (
	"ID" serial NOT NULL,
	nombre varchar(20) NOT NULL,
	filas integer NOT NULL,
	columnas integer NOT NULL,
	CONSTRAINT "Sala_pk" PRIMARY KEY ("ID")

);
-- ddl-end --
ALTER TABLE public."Sala" OWNER TO gczgoasf;
-- ddl-end --

-- object: public."Genero" | type: TABLE --
-- DROP TABLE IF EXISTS public."Genero" CASCADE;
CREATE TABLE public."Genero" (
	"ID" serial NOT NULL,
	tipo varchar(20) NOT NULL,
	CONSTRAINT "Genero_pk" PRIMARY KEY ("ID")

);
-- ddl-end --
ALTER TABLE public."Genero" OWNER TO gczgoasf;
-- ddl-end --

-- object: public."Nacionalidad" | type: TABLE --
-- DROP TABLE IF EXISTS public."Nacionalidad" CASCADE;
CREATE TABLE public."Nacionalidad" (
	"ID" serial NOT NULL,
	nombre varchar(30) NOT NULL,
	CONSTRAINT "Nacionalidad_pk" PRIMARY KEY ("ID")

);
-- ddl-end --
ALTER TABLE public."Nacionalidad" OWNER TO gczgoasf;
-- ddl-end --

-- object: public."Distribuidora" | type: TABLE --
-- DROP TABLE IF EXISTS public."Distribuidora" CASCADE;
CREATE TABLE public."Distribuidora" (
	"ID" serial NOT NULL,
	nombre varchar(50) NOT NULL,
	correo varchar(50) NOT NULL,
	CONSTRAINT "Distribuidora_pk" PRIMARY KEY ("ID")

);
-- ddl-end --
ALTER TABLE public."Distribuidora" OWNER TO gczgoasf;
-- ddl-end --

-- object: public."Director" | type: TABLE --
-- DROP TABLE IF EXISTS public."Director" CASCADE;
CREATE TABLE public."Director" (
	"ID" serial NOT NULL,
	nombre varchar(50) NOT NULL,
	apellidos varchar(50) NOT NULL,
	nacimiento date NOT NULL,
	CONSTRAINT "Director_pk" PRIMARY KEY ("ID")

);
-- ddl-end --
ALTER TABLE public."Director" OWNER TO gczgoasf;
-- ddl-end --

-- object: public."Actor" | type: TABLE --
-- DROP TABLE IF EXISTS public."Actor" CASCADE;
CREATE TABLE public."Actor" (
	"ID" serial NOT NULL,
	nombre varchar(50) NOT NULL,
	apellidos varchar(50) NOT NULL,
	nacimiento date NOT NULL,
	CONSTRAINT "Actor_pk" PRIMARY KEY ("ID")

);
-- ddl-end --
ALTER TABLE public."Actor" OWNER TO gczgoasf;
-- ddl-end --

-- object: public."Clasificacion" | type: TABLE --
-- DROP TABLE IF EXISTS public."Clasificacion" CASCADE;
CREATE TABLE public."Clasificacion" (
	"ID" serial NOT NULL,
	edad integer NOT NULL,
	CONSTRAINT "Clasificacion_pk" PRIMARY KEY ("ID")

);
-- ddl-end --
ALTER TABLE public."Clasificacion" OWNER TO gczgoasf;
-- ddl-end --

-- object: public."Valoracion" | type: TABLE --
-- DROP TABLE IF EXISTS public."Valoracion" CASCADE;
CREATE TABLE public."Valoracion" (
	"ID" serial NOT NULL,
	puntuacion integer NOT NULL,
	comentario varchar(1000),
	"ID_Pelicula" integer NOT NULL,
	CONSTRAINT "Valoracion_pk" PRIMARY KEY ("ID")

);
-- ddl-end --
ALTER TABLE public."Valoracion" OWNER TO gczgoasf;
-- ddl-end --

-- object: public."Butaca" | type: TABLE --
-- DROP TABLE IF EXISTS public."Butaca" CASCADE;
CREATE TABLE public."Butaca" (
	"ID" serial NOT NULL,
	fila integer NOT NULL,
	columna integer NOT NULL,
	"ID_Sala" integer NOT NULL,
	CONSTRAINT "Butaca_pk" PRIMARY KEY ("ID")

);
-- ddl-end --
ALTER TABLE public."Butaca" OWNER TO gczgoasf;
-- ddl-end --

-- object: public."Usuario" | type: TABLE --
-- DROP TABLE IF EXISTS public."Usuario" CASCADE;
CREATE TABLE public."Usuario" (
	"ID" serial NOT NULL,
	nick varchar(20) NOT NULL,
	clave varchar(60) NOT NULL,
	nombre varchar(30) NOT NULL,
	apellidos varchar(50) NOT NULL,
	correo varchar(50) NOT NULL,
	fecha_nacimiento date NOT NULL,
	"ID_Rol" integer NOT NULL,
	CONSTRAINT "Usuario_pk" PRIMARY KEY ("ID")

);
-- ddl-end --
ALTER TABLE public."Usuario" OWNER TO gczgoasf;
-- ddl-end --

-- object: public."Rol" | type: TABLE --
-- DROP TABLE IF EXISTS public."Rol" CASCADE;
CREATE TABLE public."Rol" (
	"ID" serial NOT NULL,
	rol varchar(30) NOT NULL,
	CONSTRAINT "Rol_pk" PRIMARY KEY ("ID")

);
-- ddl-end --
ALTER TABLE public."Rol" OWNER TO gczgoasf;
-- ddl-end --

-- object: "Rol_fk" | type: CONSTRAINT --
-- ALTER TABLE public."Usuario" DROP CONSTRAINT IF EXISTS "Rol_fk" CASCADE;
ALTER TABLE public."Usuario" ADD CONSTRAINT "Rol_fk" FOREIGN KEY ("ID_Rol")
REFERENCES public."Rol" ("ID") MATCH FULL
ON DELETE RESTRICT ON UPDATE CASCADE;
-- ddl-end --

-- object: "Sala_fk" | type: CONSTRAINT --
-- ALTER TABLE public."Butaca" DROP CONSTRAINT IF EXISTS "Sala_fk" CASCADE;
ALTER TABLE public."Butaca" ADD CONSTRAINT "Sala_fk" FOREIGN KEY ("ID_Sala")
REFERENCES public."Sala" ("ID") MATCH FULL
ON DELETE RESTRICT ON UPDATE CASCADE;
-- ddl-end --

-- object: public."Sesion" | type: TABLE --
-- DROP TABLE IF EXISTS public."Sesion" CASCADE;
CREATE TABLE public."Sesion" (
	"ID_Sala" integer NOT NULL,
	"ID_Pelicula" integer NOT NULL,
	"ID_Pase" integer NOT NULL,
	CONSTRAINT "Sesion_pk" PRIMARY KEY ("ID_Sala","ID_Pelicula","ID_Pase")

);
-- ddl-end --

-- object: "Sala_fk" | type: CONSTRAINT --
-- ALTER TABLE public."Sesion" DROP CONSTRAINT IF EXISTS "Sala_fk" CASCADE;
ALTER TABLE public."Sesion" ADD CONSTRAINT "Sala_fk" FOREIGN KEY ("ID_Sala")
REFERENCES public."Sala" ("ID") MATCH FULL
ON DELETE CASCADE ON UPDATE CASCADE;
-- ddl-end --

-- object: "Pelicula_fk" | type: CONSTRAINT --
-- ALTER TABLE public."Sesion" DROP CONSTRAINT IF EXISTS "Pelicula_fk" CASCADE;
ALTER TABLE public."Sesion" ADD CONSTRAINT "Pelicula_fk" FOREIGN KEY ("ID_Pelicula")
REFERENCES public."Pelicula" ("ID") MATCH FULL
ON DELETE CASCADE ON UPDATE CASCADE;
-- ddl-end --

-- object: "Pelicula_fk" | type: CONSTRAINT --
-- ALTER TABLE public."Valoracion" DROP CONSTRAINT IF EXISTS "Pelicula_fk" CASCADE;
ALTER TABLE public."Valoracion" ADD CONSTRAINT "Pelicula_fk" FOREIGN KEY ("ID_Pelicula")
REFERENCES public."Pelicula" ("ID") MATCH FULL
ON DELETE RESTRICT ON UPDATE CASCADE;
-- ddl-end --

-- object: "Clasificacion_fk" | type: CONSTRAINT --
-- ALTER TABLE public."Pelicula" DROP CONSTRAINT IF EXISTS "Clasificacion_fk" CASCADE;
ALTER TABLE public."Pelicula" ADD CONSTRAINT "Clasificacion_fk" FOREIGN KEY ("ID_Clasificacion")
REFERENCES public."Clasificacion" ("ID") MATCH FULL
ON DELETE RESTRICT ON UPDATE CASCADE;
-- ddl-end --

-- object: "Distribuidora_fk" | type: CONSTRAINT --
-- ALTER TABLE public."Pelicula" DROP CONSTRAINT IF EXISTS "Distribuidora_fk" CASCADE;
ALTER TABLE public."Pelicula" ADD CONSTRAINT "Distribuidora_fk" FOREIGN KEY ("ID_Distribuidora")
REFERENCES public."Distribuidora" ("ID") MATCH FULL
ON DELETE RESTRICT ON UPDATE CASCADE;
-- ddl-end --

-- object: public."Reparto" | type: TABLE --
-- DROP TABLE IF EXISTS public."Reparto" CASCADE;
CREATE TABLE public."Reparto" (
	id serial NOT NULL,
	"ID_Actor" integer NOT NULL,
	"ID_Pelicula" integer NOT NULL,
	CONSTRAINT "many_Actor_has_many_Pelicula_pk" PRIMARY KEY (id)

);
-- ddl-end --

-- object: "Actor_fk" | type: CONSTRAINT --
-- ALTER TABLE public."Reparto" DROP CONSTRAINT IF EXISTS "Actor_fk" CASCADE;
ALTER TABLE public."Reparto" ADD CONSTRAINT "Actor_fk" FOREIGN KEY ("ID_Actor")
REFERENCES public."Actor" ("ID") MATCH FULL
ON DELETE RESTRICT ON UPDATE CASCADE;
-- ddl-end --

-- object: "Pelicula_fk" | type: CONSTRAINT --
-- ALTER TABLE public."Reparto" DROP CONSTRAINT IF EXISTS "Pelicula_fk" CASCADE;
ALTER TABLE public."Reparto" ADD CONSTRAINT "Pelicula_fk" FOREIGN KEY ("ID_Pelicula")
REFERENCES public."Pelicula" ("ID") MATCH FULL
ON DELETE RESTRICT ON UPDATE CASCADE;
-- ddl-end --

-- object: public."Direccion" | type: TABLE --
-- DROP TABLE IF EXISTS public."Direccion" CASCADE;
CREATE TABLE public."Direccion" (
	id serial NOT NULL,
	"ID_Director" integer NOT NULL,
	"ID_Pelicula" integer NOT NULL,
	CONSTRAINT "many_Director_has_many_Pelicula_pk" PRIMARY KEY (id)

);
-- ddl-end --

-- object: "Director_fk" | type: CONSTRAINT --
-- ALTER TABLE public."Direccion" DROP CONSTRAINT IF EXISTS "Director_fk" CASCADE;
ALTER TABLE public."Direccion" ADD CONSTRAINT "Director_fk" FOREIGN KEY ("ID_Director")
REFERENCES public."Director" ("ID") MATCH FULL
ON DELETE RESTRICT ON UPDATE CASCADE;
-- ddl-end --

-- object: "Pelicula_fk" | type: CONSTRAINT --
-- ALTER TABLE public."Direccion" DROP CONSTRAINT IF EXISTS "Pelicula_fk" CASCADE;
ALTER TABLE public."Direccion" ADD CONSTRAINT "Pelicula_fk" FOREIGN KEY ("ID_Pelicula")
REFERENCES public."Pelicula" ("ID") MATCH FULL
ON DELETE RESTRICT ON UPDATE CASCADE;
-- ddl-end --

-- object: public."Genero_Pelicula" | type: TABLE --
-- DROP TABLE IF EXISTS public."Genero_Pelicula" CASCADE;
CREATE TABLE public."Genero_Pelicula" (
	id serial NOT NULL,
	"ID_Genero" integer NOT NULL,
	"ID_Pelicula" integer NOT NULL,
	CONSTRAINT "many_Genero_has_many_Pelicula_pk" PRIMARY KEY (id)

);
-- ddl-end --

-- object: "Genero_fk" | type: CONSTRAINT --
-- ALTER TABLE public."Genero_Pelicula" DROP CONSTRAINT IF EXISTS "Genero_fk" CASCADE;
ALTER TABLE public."Genero_Pelicula" ADD CONSTRAINT "Genero_fk" FOREIGN KEY ("ID_Genero")
REFERENCES public."Genero" ("ID") MATCH FULL
ON DELETE RESTRICT ON UPDATE CASCADE;
-- ddl-end --

-- object: "Pelicula_fk" | type: CONSTRAINT --
-- ALTER TABLE public."Genero_Pelicula" DROP CONSTRAINT IF EXISTS "Pelicula_fk" CASCADE;
ALTER TABLE public."Genero_Pelicula" ADD CONSTRAINT "Pelicula_fk" FOREIGN KEY ("ID_Pelicula")
REFERENCES public."Pelicula" ("ID") MATCH FULL
ON DELETE RESTRICT ON UPDATE CASCADE;
-- ddl-end --

-- object: public."Nacionalidad_Pelicula" | type: TABLE --
-- DROP TABLE IF EXISTS public."Nacionalidad_Pelicula" CASCADE;
CREATE TABLE public."Nacionalidad_Pelicula" (
	id serial NOT NULL,
	"ID_Nacionalidad" integer NOT NULL,
	"ID_Pelicula" integer NOT NULL,
	CONSTRAINT "many_Nacionalidad_has_many_Pelicula_pk" PRIMARY KEY (id)

);
-- ddl-end --

-- object: "Nacionalidad_fk" | type: CONSTRAINT --
-- ALTER TABLE public."Nacionalidad_Pelicula" DROP CONSTRAINT IF EXISTS "Nacionalidad_fk" CASCADE;
ALTER TABLE public."Nacionalidad_Pelicula" ADD CONSTRAINT "Nacionalidad_fk" FOREIGN KEY ("ID_Nacionalidad")
REFERENCES public."Nacionalidad" ("ID") MATCH FULL
ON DELETE RESTRICT ON UPDATE CASCADE;
-- ddl-end --

-- object: "Pelicula_fk" | type: CONSTRAINT --
-- ALTER TABLE public."Nacionalidad_Pelicula" DROP CONSTRAINT IF EXISTS "Pelicula_fk" CASCADE;
ALTER TABLE public."Nacionalidad_Pelicula" ADD CONSTRAINT "Pelicula_fk" FOREIGN KEY ("ID_Pelicula")
REFERENCES public."Pelicula" ("ID") MATCH FULL
ON DELETE RESTRICT ON UPDATE CASCADE;
-- ddl-end --

-- object: public."Pase" | type: TABLE --
-- DROP TABLE IF EXISTS public."Pase" CASCADE;
CREATE TABLE public."Pase" (
	"ID" serial NOT NULL,
	hora time NOT NULL,
	dia date NOT NULL,
	CONSTRAINT "Pase_pk" PRIMARY KEY ("ID")

);
-- ddl-end --
ALTER TABLE public."Pase" OWNER TO gczgoasf;
-- ddl-end --

-- object: "Pase_fk" | type: CONSTRAINT --
-- ALTER TABLE public."Sesion" DROP CONSTRAINT IF EXISTS "Pase_fk" CASCADE;
ALTER TABLE public."Sesion" ADD CONSTRAINT "Pase_fk" FOREIGN KEY ("ID_Pase")
REFERENCES public."Pase" ("ID") MATCH FULL
ON DELETE CASCADE ON UPDATE CASCADE;
-- ddl-end --

-- object: public."Entrada" | type: TABLE --
-- DROP TABLE IF EXISTS public."Entrada" CASCADE;
CREATE TABLE public."Entrada" (
	id serial NOT NULL,
	"ID_Usuario" integer NOT NULL,
	"ID_Butaca" integer NOT NULL,
	"ID_Pase_Sesion" integer NOT NULL,
	"ID_Sala_Sesion" integer NOT NULL,
	"ID_Pelicula_Sesion" integer NOT NULL,
	CONSTRAINT "many_Usuario_has_many_Sesion_pk" PRIMARY KEY (id)

);
-- ddl-end --

-- object: "Usuario_fk" | type: CONSTRAINT --
-- ALTER TABLE public."Entrada" DROP CONSTRAINT IF EXISTS "Usuario_fk" CASCADE;
ALTER TABLE public."Entrada" ADD CONSTRAINT "Usuario_fk" FOREIGN KEY ("ID_Usuario")
REFERENCES public."Usuario" ("ID") MATCH FULL
ON DELETE RESTRICT ON UPDATE CASCADE;
-- ddl-end --

-- object: "Sesion_fk" | type: CONSTRAINT --
-- ALTER TABLE public."Entrada" DROP CONSTRAINT IF EXISTS "Sesion_fk" CASCADE;
ALTER TABLE public."Entrada" ADD CONSTRAINT "Sesion_fk" FOREIGN KEY ("ID_Sala_Sesion","ID_Pelicula_Sesion","ID_Pase_Sesion")
REFERENCES public."Sesion" ("ID_Sala","ID_Pelicula","ID_Pase") MATCH FULL
ON DELETE RESTRICT ON UPDATE CASCADE;
-- ddl-end --

-- object: "Butaca_fk" | type: CONSTRAINT --
-- ALTER TABLE public."Entrada" DROP CONSTRAINT IF EXISTS "Butaca_fk" CASCADE;
ALTER TABLE public."Entrada" ADD CONSTRAINT "Butaca_fk" FOREIGN KEY ("ID_Butaca")
REFERENCES public."Butaca" ("ID") MATCH FULL
ON DELETE RESTRICT ON UPDATE CASCADE;
-- ddl-end --