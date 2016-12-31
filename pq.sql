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
	email_clients VARCHAR2(255) NOT NULL CONSTRAINT ceu UNIQUE,
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
	price_items DECIMAL DEFAULT 0.00,
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
	execution_date_sales DATE,
	sales_price DECIMAL DEFAULT 0.00,
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
	provides_price DECIMAL DEFAULT 0.00,
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

CREATE OR REPLACE VIEW item_relation AS SELECT i.id_items, i.name_items, i.model_items, i.quantity_items, i.price_items, ift.value, f.name_features, p.name_producers from items i inner join items_features ift on i.id_items = ift.id_items inner join features f on ift.id_features = f.id_features inner join producers p on i.id_producers = p.id_producers;

------------------------------DELETE-------------------------------------------
DELETE FROM producers;
DELETE FROM items;
DELETE FROM features;
DELETE FROM items_features;
------------------------------INSERT-------------------------------------------

------------PRODUCERS------------
INSERT INTO producers VALUES(producers_seq.NEXTVAL, 'Intel');
INSERT INTO producers VALUES(producers_seq.NEXTVAL, 'Nvidia');
INSERT INTO producers VALUES(producers_seq.NEXTVAL, 'Corsair');
INSERT INTO producers VALUES(producers_seq.NEXTVAL, 'Asus');
INSERT INTO producers VALUES(producers_seq.NEXTVAL, 'LG');
INSERT INTO producers VALUES(producers_seq.NEXTVAL, 'HP');
INSERT INTO producers VALUES(producers_seq.NEXTVAL, 'Lenovo');
INSERT INTO producers VALUES(producers_seq.NEXTVAL, 'Dell');
INSERT INTO producers VALUES(producers_seq.NEXTVAL, 'Apple');
INSERT INTO producers VALUES(producers_seq.NEXTVAL, 'Brother');
INSERT INTO producers VALUES(producers_seq.NEXTVAL, 'Epson');
INSERT INTO producers VALUES(producers_seq.NEXTVAL, 'GoodRam');
INSERT INTO producers VALUES(producers_seq.NEXTVAL, 'ScanDisk');
INSERT INTO producers VALUES(producers_seq.NEXTVAL, 'Acer');
INSERT INTO producers VALUES(producers_seq.NEXTVAL, 'be quiet!');
INSERT INTO producers VALUES(producers_seq.NEXTVAL, 'SilentiumPC');
INSERT INTO producers VALUES(producers_seq.NEXTVAL, 'Gigabyte');

------------ITEMS------------

INSERT INTO items VALUES(items_seq.NEXTVAL, 'Procesor', 'i7', 34, 1234.45, 1);
INSERT INTO items VALUES(items_seq.NEXTVAL, 'Karta graficzna', 'GTX1070TI', 5, 2099.00, 2);
INSERT INTO items VALUES(items_seq.NEXTVAL, 'Zasilacz', 'VS Series 550W 120mm',32, 219.00, 3);
INSERT INTO items VALUES(items_seq.NEXTVAL, 'Napęd', 'DRW-24D5MT/BLK/B/AS', 50, 59.00, 4);
INSERT INTO items VALUES(items_seq.NEXTVAL, 'Napęd', 'SuperMulti GH24NSD1 RBBB', 29, 55.00, 5);
INSERT INTO items VALUES(items_seq.NEXTVAL, 'Skaner', 'ADS-2600WE', 8, 1989.00, 10);
INSERT INTO items VALUES(items_seq.NEXTVAL, 'Drukarka', 'GT-S85', 12, 1996.00, 11);
INSERT INTO items VALUES(items_seq.NEXTVAL, 'Karta graficzna', 'GTX1060TI', 5, 1560.00, 2);
INSERT INTO items VALUES(items_seq.NEXTVAL, 'Toner', '12L Q2612L czarny', 14, 218.00, 6);
INSERT INTO items VALUES(items_seq.NEXTVAL, 'Tablet', 'TAB2 A7-10F 7" WiFi 8GB Czarny', 3, 278.00, 7);
INSERT INTO items VALUES(items_seq.NEXTVAL, 'Laptop', 'G51-35', 16, 1299.45, 8);
INSERT INTO items VALUES(items_seq.NEXTVAL, 'Kabel', 'HDD', 22, 142.00, 7);
INSERT INTO items VALUES(items_seq.NEXTVAL, 'Smartfon', 'iPhone 6s Plus 16GB Srebrny', 2, 2899.00, 9);
INSERT INTO items VALUES(items_seq.NEXTVAL, 'Etui', 'iPhone 7 SILICONE CASE, Czarny', 12, 15.38, 9);
INSERT INTO items VALUES(items_seq.NEXTVAL, 'Pasta', 'Termoprzewodząca DC1', 120, 20.99, 15);
INSERT INTO items VALUES(items_seq.NEXTVAL, 'Chłodzenie CPU', 'Fortis 3 HE1425 v2', 12, 149.00, 16);
INSERT INTO items VALUES(items_seq.NEXTVAL, 'Pamięć RAM', 'Play DDR3 4GB 1600MHz CL9', 80, 115.00, 12);
INSERT INTO items VALUES(items_seq.NEXTVAL, 'Klawiatura', 'Force K7', 13, 179.00, 17);
INSERT INTO items VALUES(items_seq.NEXTVAL, 'Mysz', 'FH34', 13, 125.00, 4);


------------FEATURES------------

INSERT INTO features VALUES(features_seq.NEXTVAL, 'Rodzaj:');
INSERT INTO features VALUES(features_seq.NEXTVAL, 'Złącze:');
INSERT INTO features VALUES(features_seq.NEXTVAL, 'Typ złącza:');
INSERT INTO features VALUES(features_seq.NEXTVAL, 'Szyna danych [bit]:');
INSERT INTO features VALUES(features_seq.NEXTVAL, 'Częstotliwość pracy [MHz]:');
INSERT INTO features VALUES(features_seq.NEXTVAL, 'Pojemność:');
INSERT INTO features VALUES(features_seq.NEXTVAL, 'Gniazdo procesora:');
INSERT INTO features VALUES(features_seq.NEXTVAL, 'Prędkość obrotowa [obr./min.]:');
INSERT INTO features VALUES(features_seq.NEXTVAL, 'Kolor:');
INSERT INTO features VALUES(features_seq.NEXTVAL, 'Przeznaczenie:');
INSERT INTO features VALUES(features_seq.NEXTVAL, 'Układ PFC:');
INSERT INTO features VALUES(features_seq.NEXTVAL, 'Materiał:');
INSERT INTO features VALUES(features_seq.NEXTVAL, 'Przekątna ekranu [cal]:');
INSERT INTO features VALUES(features_seq.NEXTVAL, 'System operacyjny:');
INSERT INTO features VALUES(features_seq.NEXTVAL, 'Procesor:');
INSERT INTO features VALUES(features_seq.NEXTVAL, 'Wydajność:');
INSERT INTO features VALUES(features_seq.NEXTVAL, 'Dedykowany model:');
INSERT INTO features VALUES(features_seq.NEXTVAL, 'Interfejs:');
INSERT INTO features VALUES(features_seq.NEXTVAL, 'Typ napędu:');
INSERT INTO features VALUES(features_seq.NEXTVAL, 'Wysokość[mm]');
INSERT INTO features VALUES(features_seq.NEXTVAL, 'Szerekość[mm]');
INSERT INTO features VALUES(features_seq.NEXTVAL, 'Głębokość[mm]');
INSERT INTO features VALUES(features_seq.NEXTVAL, 'Waga[g]');
INSERT INTO features VALUES(features_seq.NEXTVAL, 'Rozdzielczość:]');


------------ITEMS_FEATURES------------

INSERT INTO items_features VALUES(19 ,1,'Optyczna');
INSERT INTO items_features VALUES(1, 5, '3,2GHz');
INSERT INTO items_features VALUES(1, 7, 'Socket 1151');
INSERT INTO items_features VALUES(2, 3, 'PCI Express x16');
INSERT INTO items_features VALUES(2, 4, '256');
INSERT INTO items_features VALUES(17, 6, '4 GB');
INSERT INTO items_features VALUES(13, 6, '16 GB');
INSERT INTO items_features VALUES(16, 7, 'Socket 1151');
INSERT INTO items_features VALUES(4, 8, '500');
INSERT INTO items_features VALUES(4, 9, 'Szary');
INSERT INTO items_features VALUES(5, 9, 'Czarny');
INSERT INTO items_features VALUES(5, 8, '450');
INSERT INTO items_features VALUES(5, 23, '800');
INSERT INTO items_features VALUES(15, 10, 'CPU,GPU');
INSERT INTO items_features VALUES(15, 9, 'Szary');
INSERT INTO items_features VALUES(15, 23, '3');
INSERT INTO items_features VALUES(16, 11, 'Aktywny');
INSERT INTO items_features VALUES(14, 12, 'Skóra naturalna');
INSERT INTO items_features VALUES(10, 13, '7"');
INSERT INTO items_features VALUES(10, 13, '7"');
INSERT INTO items_features VALUES(10, 14, 'Android 4.4');
INSERT INTO items_features VALUES(13, 14, 'iOS');
INSERT INTO items_features VALUES(11, 14, 'Windows 10 PL');
INSERT INTO items_features VALUES(11, 14, 'Linux');
INSERT INTO items_features VALUES(11, 9, 'Szary');
INSERT INTO items_features VALUES(18, 1, 'Mechaniczna');
INSERT INTO items_features VALUES(7, 1, 'Tuszowa');
INSERT INTO items_features VALUES(6, 24, '1800dpi');
INSERT INTO items_features VALUES(3, 16, '550W');
INSERT INTO items_features VALUES(13, 9, 'Srebrny');
INSERT INTO items_features VALUES(14, 9, 'Czarny');
INSERT INTO items_features VALUES(9, 9, 'Czarny');
INSERT INTO items_features VALUES(9, 10, 'HP 552');
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
