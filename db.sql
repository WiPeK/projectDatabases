DROP TABLE provides_items CASCADE CONSTRAINTS;
DROP TABLE provides CASCADE CONSTRAINTS;
DROP TABLE sales_items CASCADE CONSTRAINTS;
DROP TABLE sales CASCADE CONSTRAINTS;
DROP TABLE items_features CASCADE CONSTRAINTS;
DROP TABLE items CASCADE CONSTRAINTS;
DROP TABLE features CASCADE CONSTRAINTS;
DROP TABLE producers CASCADE CONSTRAINTS;
DROP TABLE providers CASCADE CONSTRAINTS;
DROP TABLE clients CASCADE CONSTRAINTS;
DROP TABLE employees CASCADE CONSTRAINTS;
DROP sequence employees_seq;
DROP sequence clients_seq;
DROP sequence providers_seq;
DROP sequence producers_seq;
DROP sequence features_seq;
DROP sequence items_seq;
DROP sequence sales_seq;
DROP sequence provides_seq;

CREATE sequence employees_seq minvalue 1 start with 1 increment by 1;
CREATE sequence clients_seq minvalue 1 start with 1 increment by 1;
CREATE sequence providers_seq minvalue 1 start with 1 increment by 1;
CREATE sequence producers_seq minvalue 1 start with 1 increment by 1;
CREATE sequence features_seq minvalue 1 start with 1 increment by 1;
CREATE sequence items_seq minvalue 1 start with 1 increment by 1;
CREATE sequence sales_seq minvalue 1 start with 1 increment by 1;
CREATE sequence provides_seq minvalue 1 start with 1 increment by 1;

CREATE TABLE employees(
	id_employees NUMBER CONSTRAINT employees_pk PRIMARY KEY,
	name_employees VARCHAR2(50) NOT NULL,
	surname_employees VARCHAR2(50) NOT NULL,
	email_employees VARCHAR2(255) NOT NULL CONSTRAINT eeu UNIQUE,
	password_employees VARCHAR2(100) NOT NULL,
	address_employees VARCHAR2(255) NOT NULL,
	phone_number_employees VARCHAR2(20) NOT NULL
);

CREATE TABLE clients(
	id_clients NUMBER CONSTRAINT clients_pk PRIMARY KEY,
	name_clients VARCHAR2(50) NOT NULL,
	surname_clients VARCHAR2(50) NOT NULL,
	email_clients VARCHAR2(255) NOT NULL,
	address_clients VARCHAR2(255) NOT NULL,
	phone_number_clients VARCHAR2(20) NOT NULL
);

CREATE TABLE providers(
	id_providers NUMBER CONSTRAINT providers_pk PRIMARY KEY,
	name_providers VARCHAR2(50) NOT NULL,
	email_providers VARCHAR2(255) NOT NULL CONSTRAINT peu UNIQUE,
	address_providers VARCHAR2(255) NOT NULL,
	phone_number_providers VARCHAR2(20) NOT NULL,
	nip_providers NUMBER(10) NOT NULL CONSTRAINT pnu UNIQUE,
	regon_providers NUMBER(9) NOT NULL CONSTRAINT pru UNIQUE
);

CREATE TABLE producers(
	id_producers NUMBER CONSTRAINT producers_pk PRIMARY KEY,
	name_producers VARCHAR2(255) NOT NULL CONSTRAINT prnu UNIQUE
);

CREATE TABLE features(
	id_features NUMBER CONSTRAINT features_pk PRIMARY KEY,
	name_features VARCHAR2(255) NOT NULL CONSTRAINT fnu UNIQUE
);

CREATE TABLE items(
	id_items NUMBER CONSTRAINT items_pk PRIMARY KEY,
	name_items VARCHAR2(255) NOT NULL,
	model_items VARCHAR2(255) NOT NULL,
	quantity_items NUMBER NOT NULL CONSTRAINT itq_ch CHECK(quantity_items >= 0),
	price_items NUMBER(10,2) DEFAULT 0.00,
	id_producers NUMBER NOT NULL,
	CONSTRAINT it_pr_fk FOREIGN KEY (id_producers) REFERENCES producers(id_producers)
);

CREATE TABLE items_features(
	id_items NUMBER NOT NULL,
	id_features NUMBER NOT NULL,
	value VARCHAR2(255) NOT NULL,
	CONSTRAINT itf_it_fk FOREIGN KEY (id_items) REFERENCES items(id_items),
	CONSTRAINT itf_ft_fk FOREIGN KEY (id_features) REFERENCES features(id_features)
);

CREATE TABLE sales(
	id_sales NUMBER CONSTRAINT sales_pk PRIMARY KEY,
	id_employees NUMBER,
	id_clients NUMBER NOT NULL,
	execution_date_sales DATE,
	sales_price NUMBER(10,2) DEFAULT 0.00,
	status_sales CHAR(1) DEFAULT 0,
	CONSTRAINT sal_em_fk FOREIGN KEY (id_employees) REFERENCES employees(id_employees),
	CONSTRAINT sal_cl_fk FOREIGN KEY (id_clients) REFERENCES clients(id_clients)
);

CREATE TABLE sales_items(
	id_sales NUMBER NOT NULL,
	id_items NUMBER NOT NULL,
	quantity_sales_items NUMBER NOT NULL,
	CONSTRAINT si_sal_fk FOREIGN KEY (id_sales) REFERENCES sales(id_sales),
	CONSTRAINT si_it_fk FOREIGN KEY (id_items) REFERENCES items(id_items)
);

CREATE TABLE provides(
	id_provides NUMBER CONSTRAINT provides_pk PRIMARY KEY,
	id_employees NUMBER NOT NULL,
	id_providers NUMBER NOT NULL,
	execution_date_provides DATE,
	provides_price NUMBER(10,2) DEFAULT 0.00,
	status_provides CHAR(1) DEFAULT 0,
	CONSTRAINT prs_em_fk FOREIGN KEY (id_employees) REFERENCES employees(id_employees),
	CONSTRAINT prs_pr_fk FOREIGN KEY (id_providers) REFERENCES providers(id_providers)
);

CREATE TABLE provides_items(
	id_provides NUMBER NOT NULL,
	id_items NUMBER NOT NULL,
	quantity_provides_items NUMBER NOT NULL,
	CONSTRAINT pri_prs_fk FOREIGN KEY (id_provides) REFERENCES provides(id_provides),
	CONSTRAINT pri_it_fk FOREIGN KEY (id_items) REFERENCES items(id_items)
);

CREATE OR REPLACE VIEW item_relation AS SELECT items.id_items, items.name_items, items.model_items, items.quantity_items, items.price_items, producers.name_producers, LISTAGG(CONCAT(CONCAT(features.name_features, ' '), items_features.value), '; ') WITHIN GROUP (ORDER BY features.name_features) "ftrs" FROM items JOIN items_features ON items.id_items = items_features.id_items JOIN features ON items_features.id_features = features.id_features JOIN producers ON items.id_producers = producers.id_producers GROUP BY items.id_items, items.name_items, items.model_items, items.quantity_items, items.price_items, producers.name_producers;
CREATE OR REPLACE VIEW salesView AS SELECT sales.id_sales, sales.id_employees, sales.id_clients, sales.execution_date_sales, sales.sales_price, sales.status_sales, CONCAT(employees.name_employees ,CONCAT(' ', employees.surname_employees)) as SPRZEDAWCA, CONCAT(clients.name_clients ,CONCAT(' ', clients.surname_clients)) as KLIENT FROM sales LEFT OUTER JOIN employees ON sales.id_employees = employees.id_employees LEFT OUTER JOIN clients ON sales.id_clients = clients.id_clients ORDER BY id_sales DESC;
CREATE OR REPLACE VIEW providesView AS SELECT provides.id_provides, provides.id_employees, provides.id_providers, provides.execution_date_provides, provides.provides_price, provides.status_provides, CONCAT(employees.name_employees ,CONCAT(' ', employees.surname_employees)) as SPRZEDAWCA, providers.name_providers FROM provides LEFT OUTER JOIN employees ON provides.id_employees = employees.id_employees LEFT OUTER JOIN providers ON provides.id_providers = clients.id_providers ORDER BY id_provides DESC;
-- create or replace procedure checkClient(
-- name in varchar2,
-- surname in varchar2,
-- email in varchar2,
-- address in varchar2,
-- phone in varchar2)
-- is
-- isExist clients.id_clients%TYPE;
-- begin
-- SELECT count(clients.id_clients) into isExist FROM clients WHERE clients.email_clients = email;
-- IF isExist = 1 THEN
-- INSERT INTO clients VALUES(clients_seq.NEXTVAL, name, surname, email, address, phone);
-- END IF;
-- END;

--INSERT INTO employees VALUES(employees_seq.NEXTVAL, 'Krzysztof', 'Adamczyk', 'wipekxxx@gmail.com', DBMS_OBFUSCATION_TOOLKIT.md5 (input => UTL_RAW.cast_to_raw(12345)), 'Wzdół 26-010 Bodzentyn', '5555555555');
--SELECT DBMS_OBFUSCATION_TOOLKIT.md5 (input => UTL_RAW.cast_to_raw('Eddie')) md5_val FROM DUAL;
--INSERT INTO producers VALUES(producers_seq.NEXTVAL, 'intel');
--INSERT INTO producers VALUES(producers_seq.NEXTVAL, 'nvidia');

--INSERT INTO items VALUES(items_seq.NEXTVAL, 'procesor', 'i7', 120, 123.45, 1);
--INSERT INTO items VALUES(items_seq.NEXTVAL, 'karta graficzna', 'gtx960', 12, 823, 2);

--INSERT INTO features VALUES(features_seq.NEXTVAL, 'sdfdsfdsf');
--INSERT INTO features VALUES(features_seq.NEXTVAL, 'cvxbxcfxcvxc');
--INSERT INTO features VALUES(features_seq.NEXTVAL, 'gujgnhjgn');
--INSERT INTO features VALUES(features_seq.NEXTVAL, 'bnmhjkhgjgh');

--INSERT INTO items_features VALUES(1, 1, 'fdfsd');
--INSERT INTO items_features VALUES(1, 2, 'fdfsdfdsfsd');
--INSERT INTO items_features VALUES(2, 3, 'rfgdfdfdfsd');
--INSERT INTO items_features VALUES(2, 4, 'bvcnbfdfsd');

--skomplikowane inserty joinami albo procedurami

-- 6 widoków
	--sales with all relation
	--provides with all relation
	--item with features [x]
	--employe sales
-- 4 kursory
-- 3 wyzwalacze
	--w razie usuniecia pracownika/klienta/dostawcy pozmieniac id tam gdzie wystepuja w innych tabelkach
	--akcpetacja sprzedazy

-- 15 rekordow w kazdej tabeli
-- sekwencje do wypelniania primary

--prosta rejestracja
--logowanie tylko dla pracownikow
--przy zakupie podanie danych imie, nazwisko, email, adres, nr tel
--baza przedmiotow
	--opis z bazy danych i wybieranie liczby sztuk
	--itemy quantity > 0 / brak w magazynie
	--w koszyku zatwierdzanie zakupu
--panel admina
	--dodawanie / edycja pracownika
	--dodawanie / edycja dostawcow
	--dostawy
	--akcpetowanie sprzedazy
	--edycja przedmiotow

--jezeli nie zakceptujemy sprzedazy cofamy ilosc sztuk
