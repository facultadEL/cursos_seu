CREATE TABLE tipodocumento
(
  id_tipodocumento serial NOT NULL,
  nombretipo character varying NOT NULL,
  descripcion character varying NOT NULL,
  CONSTRAINT tipodocumento_pkey PRIMARY KEY (id_tipodocumento )
)
WITH (
  OIDS=FALSE
);
ALTER TABLE tipodocumento
  OWNER TO extension;
  INSERT INTO tipodocumento(nombretipo,descripcion) VALUES ('DNI','Documento Nacional de Identidad');
  INSERT INTO tipodocumento(nombretipo,descripcion) VALUES ('LC','Libreta Cívica');
  INSERT INTO tipodocumento(nombretipo,descripcion) VALUES ('LE','Libreta de Enrolamiento');


  
  
CREATE TABLE inscripto
(
  id_inscripto serial NOT NULL,
  nombre text,
  apellido text,
  telfijo text,
  mail text,
  direccion text,
  numero integer,
  dni integer,
  fechainscripto date,
  fk_tipodoc integer,
  localidad text,
  telcel text,
  CONSTRAINT inscripto_pkey PRIMARY KEY (id_inscripto ),
  CONSTRAINT inscripto_fk_tipodoc_fkey FOREIGN KEY (fk_tipodoc)
      REFERENCES tipodocumento (id_tipodocumento) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=TRUE
);
ALTER TABLE inscripto
  OWNER TO extension;
  

CREATE TABLE imagen
(
  id_imagen serial NOT NULL,
  nombre character varying,
  mime character varying,
  size double precision,
  img_archivo_oid oid,
  CONSTRAINT imagen_pkey PRIMARY KEY (id_imagen )
)
WITH (
  OIDS=TRUE
);
ALTER TABLE imagen
  OWNER TO extension;

CREATE TABLE tipo_curso
(
  id_tipo_curso serial NOT NULL,
  nombre character varying(50),
  publicado boolean,
  CONSTRAINT tipo_curso_pkey PRIMARY KEY (id_tipo_curso )
)
WITH (
  OIDS=TRUE
);

-- Table: interesado

-- DROP TABLE interesado;

CREATE TABLE interesado
(
  id_interesado serial NOT NULL,
  nombre character varying(30),
  apellido character varying(30),
  telefono character varying(35),
  mail character varying(50),
  direccion character varying(40),
  numero integer,
  anio integer,
  descripcion text,
  CONSTRAINT interesado_pkey PRIMARY KEY (id_interesado )
)
WITH (
  OIDS=TRUE
);
ALTER TABLE interesado
  OWNER TO extension;


ALTER TABLE tipo_curso
  OWNER TO extension;
	
CREATE TABLE cursos
(
  id_cursos serial NOT NULL,
  nombre character varying(150) NOT NULL,
  duracion_desde character varying(20),
  duracion_hasta character varying(20),
  docente character varying(40),
  descripcion character varying(900),
  fk_tipo integer,
  anio integer,
  publicidad_desde character varying(11),
  publicidad_hasta character varying(11),
  hora_desde character varying(9),
  hora_hasta character varying(9),
  dia1 character varying(30),
  dia2 character varying(30),
  hora_desde2 character varying(9),
  hora_hasta2 character varying(9),
  monto integer,
  cantcuota integer,
  carga_horaria character varying(20) DEFAULT 0,
  num_resolucion character varying(10),
  fecha_resolucion character varying(50),
  fecha_impresion character varying(50),
  publicar boolean,
  fk_imagen integer references imagen(id_imagen),
  fk_programa integer,
  fk_planificacion integer,
  fk_curriculum integer,
  fk_publicidad integer,
  CONSTRAINT cursos_pkey PRIMARY KEY (id_cursos ),
  CONSTRAINT cursos_fk_curriculum_fkey FOREIGN KEY (fk_curriculum)
      REFERENCES imagen (id_imagen) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT cursos_fk_planificacion_fkey FOREIGN KEY (fk_planificacion)
      REFERENCES imagen (id_imagen) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT cursos_fk_programa_fkey FOREIGN KEY (fk_programa)
      REFERENCES imagen (id_imagen) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT cursos_fk_publicidad_fkey FOREIGN KEY (fk_publicidad)
      REFERENCES imagen (id_imagen) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT cursos_fk_tipo_fkey FOREIGN KEY (fk_tipo)
      REFERENCES tipo_curso (id_tipo_curso) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=TRUE
);
ALTER TABLE cursos
  OWNER TO extension;
  
-- Table: interesadoxcurso

-- DROP TABLE interesadoxcurso;

CREATE TABLE interesadoxcurso
(
  id_interesadoxcurso serial NOT NULL,
  fk_interesado integer,
  fk_curso integer,
  CONSTRAINT interesadoxcurso_fk_curso_fkey FOREIGN KEY (fk_curso)
      REFERENCES tipo_curso (id_tipo_curso) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT interesadoxcurso_fk_interesado_fkey FOREIGN KEY (fk_interesado)
      REFERENCES interesado (id_interesado) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=TRUE
);
ALTER TABLE interesadoxcurso
  OWNER TO extension;
  
  
CREATE TABLE inscriptosxcurso
(
  id_inscriptosxcurso serial NOT NULL,
  fk_curso integer,
  fk_inscriptos integer,
  porcdescuento integer,
  motivodescuento character varying,
  CONSTRAINT inscriptosxcurso_pkey PRIMARY KEY (id_inscriptosxcurso ),
  CONSTRAINT inscriptosxcurso_fk_curso_fkey FOREIGN KEY (fk_curso)
      REFERENCES cursos (id_cursos) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT inscriptosxcurso_fk_inscriptos_fkey FOREIGN KEY (fk_inscriptos)
      REFERENCES inscripto (id_inscripto) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=TRUE
);
ALTER TABLE inscriptosxcurso
  OWNER TO extension;
  
CREATE TABLE pagosencoop
(
  id_pagosencoop serial NOT NULL,
  codigo_barras character varying(30) NOT NULL,
  fechapago date,
  updatesg boolean,
  monto integer,
  num_recibo character varying,
  nombreyapellido character varying(100),
  fk_inscriptosxcursos integer,
  CONSTRAINT pagosencoop_pkey PRIMARY KEY (id_pagosencoop ),
  CONSTRAINT pagosencoop_fk_inscriptosxcursos_fkey FOREIGN KEY (fk_inscriptosxcursos)
      REFERENCES inscriptosxcurso (id_inscriptosxcurso) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=TRUE
);
ALTER TABLE pagosencoop
  OWNER TO extension;
  
CREATE TABLE asistencia
(
  id_asistencia serial NOT NULL,
  fecha date,
  asistencia boolean,
  fk_alumno integer,
  CONSTRAINT "Asistencia_pkey" PRIMARY KEY (id_asistencia ),
  CONSTRAINT asistencia_fk_alumno_fkey FOREIGN KEY (fk_alumno)
      REFERENCES inscriptosxcurso (id_inscriptosxcurso) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=TRUE
);
ALTER TABLE asistencia
  OWNER TO extension;
  
  
CREATE TABLE pagodocente
(
  id_pagodocente serial NOT NULL,
  fecha_pago character varying(16),
  mes_q_corresponde character varying(24),
  monto character varying(15),
  fk_curso integer,
  CONSTRAINT pagodocente_pkey PRIMARY KEY (id_pagodocente ),
  CONSTRAINT pagodocente_fk_curso_fkey FOREIGN KEY (fk_curso)
      REFERENCES cursos (id_cursos) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=TRUE
);
ALTER TABLE pagodocente
  OWNER TO extension;

  
  