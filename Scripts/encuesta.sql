CREATE TABLE encuesta(
	id serial not null,
	curso_fk integer references cursos(id_cursos),
	vol_info_1 smallint,
	pres_info_2 smallint,
	time_asign_3 smallint,
	cap_exp_4 smallint,
	teo_pract_5 smallint,
	org_time_6 smallint,
	resp_cons_7 smallint,
	calif_docente integer,
	aten_per_seu_8 smallint,
	equip_aula_9 smallint,
	cali_mat_10 smallint,
	calif_curso integer,
	observa text,
	fecreg date
);

alter table inscriptosxcurso add column enc_hecha boolean default false;