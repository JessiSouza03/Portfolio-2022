create database CATALOGO_PEIXINHOS;
use CATALOGO_PEIXINHOS;

create table TB_TIPINHO
(
COD_TIPO int auto_increment primary key,
NOME_TIPO varchar(50)
);

create table TB_LOCALZINHO
(
COD_LOCAL int auto_increment primary key,
NOME_LOCAL varchar(50)
);

create table TB_ESPECIEZINHAS
(
COD_ESPECIE int auto_increment primary key,
NOME_ESPECIE varchar(50) not null 
);


create table TB_ECOSSISTEMINHA 
(
COD_ECOSSISTEMA int auto_increment primary key,
NOME_ECOSSISTEMA varchar(50) not null,
CARACTERISTICAS_GERAIS varchar(150) not null,
COD_TIPO int,
COD_LOCAL int,
foreign key (COD_TIPO) references TB_TIPINHO(COD_TIPO),
foreign key (COD_LOCAL) references TB_LOCALZINHO(COD_LOCAL)
);

create table TB_PEIXINHOS
(
COD_PEIXE int auto_increment primary key,
NOME varchar(50) not null,
PESO varchar(5) not null,
COR varchar(20) not null,
COD_ESPECIE int,
COD_ECOSSISTEMA int,
foreign key (COD_ESPECIE) references TB_ESPECIEZINHAS(COD_ESPECIE),
foreign key (COD_ECOSSISTEMA) references TB_ECOSSISTEMINHA(COD_ECOSSISTEMA)
);





