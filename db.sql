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

CREATE TABLE employees(
	id_employees NUMBER CONSTRAINT employees_pk PRIMARY KEY,
	name VARCHAR2(50) NOT NULL,
	surname VARCHAR2(50) NOT NULL,
	email VARCHAR2(255) NOT NULL,
	password VARCHAR2(100) NOT NULL,
	address VARCHAR2(255) NOT NULL,
	phone_number VARCHAR2(20) NOT NULL
);

CREATE TABLE clients(
	id_clients NUMBER CONSTRAINT clients_pk PRIMARY KEY,
	name VARCHAR2(50) NOT NULL,
	surname VARCHAR2(50) NOT NULL,
	email VARCHAR2(255) NOT NULL,
	address VARCHAR2(255) NOT NULL,
	phone_number VARCHAR2(20) NOT NULL
);

CREATE TABLE providers(
	id_providers NUMBER CONSTRAINT providers_pk PRIMARY KEY,
	name VARCHAR2(50) NOT NULL,
	nip NUMBER(10) NOT NULL,
	regon NUMBER(9) NOT NULL,
	address VARCHAR2(255) NOT NULL,
	phone_number VARCHAR2(20) NOT NULL,
	email VARCHAR2(255) NOT NULL
);

CREATE TABLE producers(
	id_producers NUMBER CONSTRAINT producers_pk PRIMARY KEY,
	name VARCHAR2(255) NOT NULL
);

CREATE TABLE features(
	id_features NUMBER CONSTRAINT features_pk PRIMARY KEY,
	name VARCHAR2(255) NOT NULL
);

CREATE TABLE items(
	id_items NUMBER CONSTRAINT items_pk PRIMARY KEY,
	name VARCHAR2(255) NOT NULL,
	model VARCHAR2(255) NOT NULL,
	quantity NUMBER NOT NULL CONSTRAINT itq_ch CHECK(quantity >= 0),
	price DECIMAL(10,2) DEFAULT 0.00,
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
	id_employees NUMBER NOT NULL,
	id_clients NUMBER NOT NULL,
	execution_date DATE,
	sales_price DECIMAL(10,2) DEFAULT 0.00,
	status CHAR(1) DEFAULT 0,
	CONSTRAINT sal_em_fk FOREIGN KEY (id_employees) REFERENCES employees(id_employees),
	CONSTRAINT sal_cl_fk FOREIGN KEY (id_clients) REFERENCES clients(id_clients)
);

CREATE TABLE sales_items(
	id_sales NUMBER NOT NULL,
	id_items NUMBER NOT NULL,
	quantity NUMBER NOT NULL,
	CONSTRAINT si_sal_fk FOREIGN KEY (id_sales) REFERENCES sales(id_sales),
	CONSTRAINT si_it_fk FOREIGN KEY (id_items) REFERENCES items(id_items)
);

CREATE TABLE provides(
	id_provides NUMBER CONSTRAINT provides_pk PRIMARY KEY,
	id_employees NUMBER NOT NULL,
	id_providers NUMBER NOT NULL,
	execution_date DATE,
	provides_price DECIMAL(10,2) DEFAULT 0.00,
	status CHAR(1) DEFAULT 0,
	CONSTRAINT prs_em_fk FOREIGN KEY (id_employees) REFERENCES employees(id_employees),
	CONSTRAINT prs_pr_fk FOREIGN KEY (id_providers) REFERENCES providers(id_providers)
);

CREATE TABLE provides_items(
	id_provides NUMBER NOT NULL,
	id_items NUMBER NOT NULL,
	quantity NUMBER NOT NULL,
	CONSTRAINT pri_prs_fk FOREIGN KEY (id_provides) REFERENCES provides(id_provides),
	CONSTRAINT pri_it_fk FOREIGN KEY (id_items) REFERENCES items(id_items)
);


--skomplikowane inserty joinami albo procedurami

-- 6 widoków
	--sales with all relation
	--provides with all relation
	--item with features
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
--panel admina
	--dodawanie / edycja pracownika
	--dodawanie / edycja dostawcow
	--dostawy
	--akcpetowanie sprzedazy
	--edycja przedmiotow

--jezeli nie zakceptujemy sprzedazy cofamy ilosc sztuk
