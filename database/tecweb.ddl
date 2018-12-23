-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 10.0.3              
-- * Generator date: Aug 17 2017              
-- * Generation date: Sun Dec 23 12:19:15 2018 
-- * LUN file: G:\xampp\htdocs\sitotecweb\database\tecweb.lun 
-- * Schema: cfu/1 
-- ********************************************* 


-- Database Section
-- ________________ 

create database cfu;
use cfu;


-- Tables Section
-- _____________ 

create table aggiunge (
     ingrediente varchar(20) not null,
     nome_alimento varchar(20) not null,
     id_ristorante int not null,
     nome_menu varchar(20) not null,
     constraint IDaggiunge primary key (ingrediente, nome_alimento, id_ristorante, nome_menu));

create table alimento (
     disponibilita char not null,
     nome varchar(20) not null,
     info varchar(100) not null,
     prezzo decimal(5,2) not null,
     id_ristorante int not null,
     nome_menu varchar(20) not null,
     constraint IDalimento primary key (nome, id_ristorante, nome_menu));

create table categoria_menu (
     nome_categoria varchar(20) not null,
     constraint IDcategoria_alimenti_ID primary key (nome_categoria));

create table categoria_ristoranti (
     nome_categoria varchar(20) not null,
     constraint IDcategoria_ristoranti primary key (nome_categoria));

create table ingredienti (
     nome varchar(20) not null,
     constraint IDingredienti primary key (nome));

create table lista (
     nome_alimento varchar(20) not null,
     id_prenotazione int not null,
     constraint IDlista primary key (nome_alimento, id_prenotazione));

create table menu (
     id_ristorante int not null,
     nome varchar(20) not null,
     nome_categoria varchar(20) not null,
     constraint IDmenu primary key (id_ristorante, nome));

create table notifica (
     codice int not null,
     testo varchar(50) not null,
     constraint IDnotifica primary key (codice));

create table persona (
     nome varchar(20) not null,
     cognome varchar(20) not null,
     email varchar(40) not null,
     id_ristorante int,
     password varchar(40) not null,
     privilegi int not null,
     cellulare char(10) not null,
     id int not null,
     constraint IDpersona_ID primary key (email));

create table prenotazione (
     id int not null,
     id_ristorante int not null,
     email_cliente varchar(40) not null,
     data date not null,
     ora_accettazione date not null,
     stato int not null,
     luogo_cosegna varchar(20) not null,
     ora_consegna date not null,
     totale int not null,
     constraint IDprenotazione primary key (id));

create table riceve (
     codice_notifica int not null,
     email varchar(40) not null,
     constraint IDriceve primary key (email, codice_notifica));

create table ristorante (
     info varchar(100) not null,
     id  int not null,
     email_proprietario varchar(40) not null,
     nome_categoria varchar(20),
     nome varchar(20) not null,
     posizione varchar(40) not null,
     rating int not null,
     constraint IDristorante_ID primary key (id ),
     constraint FKappartiene_ID unique (email_proprietario),
     constraint FKinclude_ID unique (nome_categoria));


-- Constraints Section
-- ___________________ 

alter table aggiunge add constraint FKagg_ing
     foreign key (ingrediente)
     references ingredienti (nome);

alter table aggiunge add constraint FKR
     foreign key (nome_alimento, id_ristorante, nome_menu)
     references alimento (nome, id_ristorante, nome_menu);

alter table alimento add constraint FKpartecipa
     foreign key (id_ristorante, nome_menu)
     references menu (id_ristorante, nome);

-- Not implemented
-- alter table categoria_menu add constraint IDcategoria_alimenti_CHK
--     check(exists(select * from menu
--                  where menu.nome_categoria = nome_categoria)); 

alter table lista add constraint FKlis_pre
     foreign key (id_prenotazione)
     references prenotazione (id);

alter table menu add constraint FKoffre
     foreign key (id_ristorante)
     references ristorante (id );

alter table menu add constraint FKpartecipa2
     foreign key (nome_categoria)
     references categoria_menu (nome_categoria);

-- Not implemented
-- alter table persona add constraint IDpersona_CHK
--     check(exists(select * from ristorante
--                  where ristorante.email_proprietario = email)); 

-- Not implemented
-- alter table persona add constraint IDpersona_CHK
--     check(exists(select * from prenotazione
--                  where prenotazione.email_cliente = email)); 

alter table persona add constraint FKappartiene
     foreign key (id_ristorante)
     references ristorante (id );

alter table prenotazione add constraint FKeffettua
     foreign key (email_cliente)
     references persona (email);

alter table prenotazione add constraint FKriferisce
     foreign key (id_ristorante)
     references ristorante (id );

alter table riceve add constraint FKric_per
     foreign key (email)
     references persona (email);

alter table riceve add constraint FKric_not
     foreign key (codice_notifica)
     references notifica (codice);

-- Not implemented
-- alter table ristorante add constraint IDristorante_CHK
--     check(exists(select * from menu
--                  where menu.id_ristorante = id )); 

-- Not implemented
-- alter table ristorante add constraint IDristorante_CHK
--     check(exists(select * from prenotazione
--                  where prenotazione.id_ristorante = id )); 

alter table ristorante add constraint FKappartiene_FK
     foreign key (email_proprietario)
     references persona (email);

alter table ristorante add constraint FKinclude_FK
     foreign key (nome_categoria)
     references categoria_ristoranti (nome_categoria);


-- Index Section
-- _____________ 

