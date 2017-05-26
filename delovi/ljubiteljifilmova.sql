/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     25-Apr-17 5:51:51 PM                         */
/*==============================================================*/


drop table if exists FILM;

drop table if exists GLUMAC;

drop table if exists KALENDARPREMIJERA;

drop table if exists KOMENTAR;

drop table if exists NALOG;

drop table if exists OCENAFILMA;

drop table if exists RELATIONSHIP_8;

drop table if exists TEMAFORUMA;

drop table if exists ZANIMLJIVOSTI;

/*==============================================================*/
/* Table: FILM                                                  */
/*==============================================================*/
create table FILM
(
   IDFILMA              int not null,
   IDKORISNIKA          int not null,
   IDPREMIJERE          int not null,
   NAZIV                varchar(50) not null,
   TRAJANJE             numeric(3,0) not null,
   ZANR                 varchar(20) not null,
   ULOGE                longtext not null,
   SLIKAFILMA           longblob,
   OPIS                 text,
   TRAILER              varchar(50),
   primary key (IDFILMA)
);

/*==============================================================*/
/* Table: GLUMAC                                                */
/*==============================================================*/
create table GLUMAC
(
   IDGLUMCA             int not null,
   IMEGLUMCA            varchar(20) not null,
   PREZIMEGLUMCA        varchar(20) not null,
   primary key (IDGLUMCA)
);

/*==============================================================*/
/* Table: KALENDARPREMIJERA                                     */
/*==============================================================*/
create table KALENDARPREMIJERA
(
   IDPREMIJERE          int not null,
   DATUMPREMIJERE       date not null,
   GRAD                 varchar(20) not null,
   primary key (IDPREMIJERE)
);

/*==============================================================*/
/* Table: KOMENTAR                                              */
/*==============================================================*/
create table KOMENTAR
(
   IDKOMENTARA          int not null,
   IDFILMA              int,
   IDKORISNIKA          int,
   DATUMKOMENTARA       date not null,
   TEKST                varchar(100) not null,
   primary key (IDKOMENTARA)
);

/*==============================================================*/
/* Table: NALOG                                                 */
/*==============================================================*/
create table NALOG
(
   IDKORISNIKA          int not null,
   IME                  varchar(20) not null,
   PREZIME              varchar(20) not null,
   KORISNICKOIME        varchar(20) not null,
   SIFRA                varchar(20) not null,
   MEJL                 varchar(50) not null,
   BRFILMOVA            bigint not null,
   primary key (IDKORISNIKA)
);

/*==============================================================*/
/* Table: OCENAFILMA                                            */
/*==============================================================*/
create table OCENAFILMA
(
   IDOCENA              int not null,
   IDFILMA              int not null,
   DATUMOCENE           date not null,
   OCENA                float(10) not null,
   primary key (IDOCENA)
);

/*==============================================================*/
/* Table: RELATIONSHIP_8                                        */
/*==============================================================*/
create table RELATIONSHIP_8
(
   IDFILMA              int not null,
   IDGLUMCA             int not null,
   primary key (IDFILMA, IDGLUMCA)
);

/*==============================================================*/
/* Table: TEMAFORUMA                                            */
/*==============================================================*/
create table TEMAFORUMA
(
   IDTEME               int not null,
   IDKORISNIKA          int not null,
   DATUMTEME            date not null,
   TEKSTTEME            varchar(100) not null,
   primary key (IDTEME)
);

/*==============================================================*/
/* Table: ZANIMLJIVOSTI                                         */
/*==============================================================*/
create table ZANIMLJIVOSTI
(
   IDZANIM              int not null,
   IDKORISNIKA          int,
   TEKSTZANIM           varchar(100) not null,
   SLIKAZANIM           longblob,
   VIDEOZANIM           varchar(50),
   primary key (IDZANIM)
);

alter table FILM add constraint FK_RELATIONSHIP_10 foreign key (IDKORISNIKA)
      references NALOG (IDKORISNIKA) on delete restrict on update restrict;

alter table FILM add constraint FK_RELATIONSHIP_9 foreign key (IDPREMIJERE)
      references KALENDARPREMIJERA (IDPREMIJERE) on delete restrict on update restrict;

alter table KOMENTAR add constraint FK_RELATIONSHIP_3 foreign key (IDFILMA)
      references FILM (IDFILMA) on delete restrict on update restrict;

alter table KOMENTAR add constraint FK_RELATIONSHIP_4 foreign key (IDKORISNIKA)
      references NALOG (IDKORISNIKA) on delete restrict on update restrict;

alter table OCENAFILMA add constraint FK_RELATIONSHIP_11 foreign key (IDFILMA)
      references FILM (IDFILMA) on delete restrict on update restrict;

alter table RELATIONSHIP_8 add constraint FK_RELATIONSHIP_13 foreign key (IDGLUMCA)
      references GLUMAC (IDGLUMCA) on delete restrict on update restrict;

alter table RELATIONSHIP_8 add constraint FK_RELATIONSHIP_8 foreign key (IDFILMA)
      references FILM (IDFILMA) on delete restrict on update restrict;

alter table TEMAFORUMA add constraint FK_RELATIONSHIP_5 foreign key (IDKORISNIKA)
      references NALOG (IDKORISNIKA) on delete restrict on update restrict;

alter table ZANIMLJIVOSTI add constraint FK_RELATIONSHIP_12 foreign key (IDKORISNIKA)
      references NALOG (IDKORISNIKA) on delete restrict on update restrict;

