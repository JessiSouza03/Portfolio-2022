create database Hospital;
use Hospital;

create table Pacientes
(Numero int(11),
 CPF int(11),
 Nome varchar(30),
 Idade smallint(2));
 
 create table Medicos
 (Numero int(11),
 CPF int(11),
 Nome varchar(30),
 Cidade varchar(20),
 Idade smallint(2),
 Especialidade varchar(25));
 
 create table Funcionario
 (NUM int auto_increment PRIMARY KEY,
 Nome varchar(30),
 Depto varchar(30), 
 Data_Nasc date, 
 Estado varchar(30),
 Ano_Admissao smallint(4),
 Salario int(8)
 );
 
 
 
 
