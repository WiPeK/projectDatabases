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
	execution_date_sales TIMESTAMP(0),
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
	execution_date_provides TIMESTAMP(0),
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

INSERT INTO producers VALUES(producers_seq.NEXTVAL, 'Usunięty producent');
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

INSERT INTO items VALUES(items_seq.NEXTVAL, 'Usunięty przedmiot', 'Brak', 0, 0.00, 2);
INSERT INTO items VALUES(items_seq.NEXTVAL, 'Procesor', 'i7', 34, 1234.45, 2);
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

INSERT INTO features VALUES(features_seq.NEXTVAL, 'Brak parametru');
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
INSERT INTO features VALUES(features_seq.NEXTVAL, 'Rozdzielczość:');

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

INSERT INTO employees VALUES(employees_seq.NEXTVAL, 'Usunięty pracownik', 'Usunięty pracownik', 'brak', DBMS_OBFUSCATION_TOOLKIT.md5 (input => UTL_RAW.cast_to_raw('dsfdsfsd435345')), 'Brak', '000000000');
INSERT INTO employees VALUES(employees_seq.NEXTVAL, 'Krzysztof', 'Adamczyk', 'wipekxxx@gmail.com', DBMS_OBFUSCATION_TOOLKIT.md5 (input => UTL_RAW.cast_to_raw(12345)), 'Wzdół 26-010 Bodzentyn', '5555555555');
INSERT INTO employees VALUES(employees_seq.NEXTVAL,'Janusz','Tracz','janusztracz@naszertv.pl',DBMS_OBFUSCATION_TOOLKIT.md5 (input => UTL_RAW.cast_to_raw(12345)),'Kraków,ul.Wieliczkowa 23','721024123');
INSERT INTO employees VALUES(employees_seq.NEXTVAL,'Marek','Wieluń','marekwielun@naszertv.pl',DBMS_OBFUSCATION_TOOLKIT.md5 (input => UTL_RAW.cast_to_raw(12345)),'Kraków,ul.Browarna 4/23','722424100');
INSERT INTO employees VALUES(employees_seq.NEXTVAL,'Karol','Truj','karoltruj@naszertv.pl',DBMS_OBFUSCATION_TOOLKIT.md5 (input => UTL_RAW.cast_to_raw(12345)),'Kraków,ul.Podwawelska 23/21','561022300');
INSERT INTO employees VALUES(employees_seq.NEXTVAL,'Katarzyna','Madryt','katarzynamadryt@naszertv.pl',DBMS_OBFUSCATION_TOOLKIT.md5 (input => UTL_RAW.cast_to_raw(12345)),'Kraków,ul.Wieliczkowa 21','751034100');
INSERT INTO employees VALUES(employees_seq.NEXTVAL,'Wojciech','Tokaj','wojciechtokaj@naszertv.pl',DBMS_OBFUSCATION_TOOLKIT.md5 (input => UTL_RAW.cast_to_raw(12345)),'Kraków,ul.Warszawska 24','721264234');
INSERT INTO employees VALUES(employees_seq.NEXTVAL,'Monika','Mohito','monikamohito@wnaszertv.pl',DBMS_OBFUSCATION_TOOLKIT.md5 (input => UTL_RAW.cast_to_raw(12345)),'Kraków,ul.Wawelska 66','761234340');

INSERT INTO clients VALUES(clients_seq.NEXTVAL,'Usunięty klient','Usunięty klient','Usunięty klient','Usunięty klient','000000000');

INSERT INTO providers VALUES(providers_seq.NEXTVAL,'Usunięty dostawca','Usunięty dostawca','Usunięty dostawca','000000000',0000000000,000000000);
INSERT INTO providers VALUES(providers_seq.NEXTVAL,'Marcinspedition','Marcinsped@janosiko.pl','Detroit,9268 Country Club Ave.','489628496',3786749531,192594973);
INSERT INTO providers VALUES(providers_seq.NEXTVAL,'Jupiter','Jupiter@gmail.com','Kanton,234 Haizhu','874542496',2917074287,511494475);
INSERT INTO providers VALUES(providers_seq.NEXTVAL,'DHL','DHL@dhl.com','Warszawa,Mokotów 24 ','84264296',1155245903,278110658);
INSERT INTO providers VALUES(providers_seq.NEXTVAL,'DPD','DPDhelp@dpd.com','Kraków,ul.Wieliczkowa 21','78421496',3588132623,711934809);
INSERT INTO providers VALUES(providers_seq.NEXTVAL,'UPS','UPSclient@ups.com','Warszawa,ul.Warszawska 24','721264234',2983592145,579895250);
INSERT INTO providers VALUES(providers_seq.NEXTVAL,'Poczta Polska','pocztapolska@pp.pl','Kraków,ul.Wawelska 66','761314340',1759887417,418478100);

CREATE OR REPLACE VIEW item_relation AS SELECT items.id_items, items.name_items, items.model_items, items.quantity_items, items.price_items, items.id_producers, producers.name_producers, LISTAGG(CONCAT(CONCAT(features.name_features, ' '), items_features.value), '; ') WITHIN GROUP (ORDER BY features.name_features) "ftrs" FROM items JOIN items_features ON items.id_items = items_features.id_items JOIN features ON items_features.id_features = features.id_features JOIN producers ON items.id_producers = producers.id_producers GROUP BY items.id_items, items.name_items, items.model_items, items.quantity_items, items.price_items, items.id_producers, producers.name_producers;
CREATE OR REPLACE VIEW item_relation_edit AS SELECT items.id_items, items.name_items, items.model_items, items.quantity_items, items.price_items, items.id_producers, producers.name_producers, LISTAGG(CONCAT(CONCAT(features.id_features, '>'),CONCAT(CONCAT(features.name_features, '>'), items_features.value)), '; ') WITHIN GROUP (ORDER BY features.name_features) as ftrs FROM items LEFT OUTER JOIN items_features ON items.id_items = items_features.id_items LEFT OUTER JOIN features ON items_features.id_features = features.id_features LEFT OUTER JOIN producers ON items.id_producers = producers.id_producers GROUP BY items.id_items, items.name_items, items.model_items, items.quantity_items, items.price_items, items.id_producers, producers.name_producers;
CREATE OR REPLACE VIEW salesView AS SELECT sales.id_sales, sales.id_employees, sales.id_clients, sales.execution_date_sales, sales.sales_price, sales.status_sales, CONCAT(employees.name_employees ,CONCAT(' ', employees.surname_employees)) as SPRZEDAWCA, CONCAT(clients.name_clients ,CONCAT(' ', clients.surname_clients)) as KLIENT FROM sales LEFT OUTER JOIN employees ON sales.id_employees = employees.id_employees LEFT OUTER JOIN clients ON sales.id_clients = clients.id_clients ORDER BY id_sales DESC;
CREATE OR REPLACE VIEW providesView AS SELECT provides.id_provides, provides.id_employees, provides.id_providers, provides.execution_date_provides, provides.provides_price, provides.status_provides, CONCAT(employees.name_employees ,CONCAT(' ', employees.surname_employees)) as SPRZEDAWCA, providers.name_providers FROM provides LEFT OUTER JOIN employees ON provides.id_employees = employees.id_employees LEFT OUTER JOIN providers ON provides.id_providers = providers.id_providers ORDER BY id_provides DESC;
CREATE OR REPLACE VIEW stats AS SELECT (SELECT COUNT(*) FROM employees) as empl, (SELECT COUNT(*) FROM clients) as clnt, (SELECT COUNT(*) FROM items) as itct, (SELECT COUNT(*) FROM producers) as prdc, (SELECT COUNT(*) FROM providers) as prvd, (SELECT COUNT(*) FROM sales) as slsc, (SELECT SUM(quantity_sales_items) FROM sales_items) as sism, (SELECT SUM(sales_price) FROM sales) as salpr  FROM dual;
CREATE OR REPLACE VIEW itemsToProvide AS SELECT ID_ITEMS, CONCAT(CONCAT(NAME_ITEMS, ' '), MODEL_ITEMS) as ITEM FROM items ORDER BY id_items;
CREATE OR REPLACE VIEW getItems AS SELECT id_items, name_items, model_items, quantity_items, price_items, name_producers FROM items JOIN producers ON items.id_producers = producers.id_producers ORDER BY items.id_items;
CREATE OR REPLACE VIEW getEmployeeSales AS SELECT sales.id_sales, sales.id_employees, CONCAT(employees.name_employees, employees.surname_employees) as Sprzedawca, sales.id_clients, CONCAT(clients.name_clients, clients.surname_clients) as Klient, sales.EXECUTION_DATE_SALES, sales.SALES_PRICE, sales.status_sales FROM sales JOIN employees ON sales.id_employees = employees.id_employees JOIN clients ON sales.id_clients = clients.id_clients;
CREATE OR REPLACE VIEW getEmployeeProvides AS SELECT provides.id_provides, provides.id_employees, CONCAT(employees.name_employees, employees.surname_employees) as Sprzedawca, providers.id_providers, providers.name_providers, provides.EXECUTION_DATE_PROVIDES, provides.PROVIDES_PRICE, provides.status_provides FROM provides JOIN employees ON provides.id_employees = employees.id_employees JOIN providers ON provides.id_providers = providers.id_providers;
CREATE OR REPLACE VIEW getClientSales AS SELECT s.id_sales, s.id_employees, (e.name_employees || ' ' || e.surname_employees) as Sprzedawca, s.id_clients, (c.name_clients || ' ' || c.surname_clients) as Klient, s.EXECUTION_DATE_SALES, s.SALES_PRICE, s.status_sales FROM sales s JOIN employees e ON s.id_employees = e.id_employees JOIN clients c ON s.id_clients = c.id_clients;
CREATE OR REPLACE VIEW getItemsToProducer AS SELECT i.id_items, CONCAT(i.name_items, CONCAT(' ', i.model_items)) as item, p.name_producers FROM items i JOIN producers p ON i.id_producers = p.id_producers;
CREATE OR REPLACE VIEW getItemsToSale AS SELECT items.id_items, CONCAT(items.name_items, CONCAT(' ', items.model_items)) as item, sales_items.QUANTITY_SALES_ITEMS, producers.name_producers FROM items JOIN producers ON items.id_producers = producers.id_producers JOIN sales_items ON items.id_items = sales_items.id_items JOIN sales ON sales_items.id_sales = sales.id_sales;
CREATE OR REPLACE VIEW getProvideItems AS SELECT items.id_items, CONCAT(items.name_items, CONCAT(' ', items.model_items)) as ITEM, provides_items.QUANTITY_PROVIDES_ITEMS, producers.name_producers FROM items JOIN producers ON items.id_producers = producers.id_producers JOIN provides_items ON items.id_items = provides_items.id_items JOIN provides ON provides_items.id_provides = provides.id_provides;

create or replace TRIGGER checkitemsales
BEFORE INSERT ON sales_items FOR EACH ROW
	declare
	itval NUMBER;
	noitems exception;
BEGIN
	SELECT items.QUANTITY_ITEMS INTO itval FROM items WHERE items.id_items = :new.ID_ITEMS;
	IF (itval - :new.QUANTITY_SALES_ITEMS) < 0 THEN
		raise noitems;
	END IF;
END;

create or replace TRIGGER updateQuantity
AFTER INSERT ON sales_items FOR EACH ROW
BEGIN
	UPDATE items SET quantity_items = quantity_items - :new.QUANTITY_SALES_ITEMS WHERE items.id_items = :new.ID_ITEMS;
END;

create or replace FUNCTION DOBUYFUNC(
	iname IN clients.name_clients%type,
	isurname IN clients.surname_clients%type,
	iemail IN clients.email_clients%type,
	iaddress IN clients.address_clients%type,
	iphone IN clients.phone_number_clients%type,
	basketPrice IN sales.sales_price%type,
	itemsvalues IN VARCHAR
) RETURN NUMBER
	IS
  	PRAGMA AUTONOMOUS_TRANSACTION;
	rescntcl NUMBER(1);
	resclid clients.id_clients%type;
	salesid sales.id_sales%type;
	itsid sales_items.id_items%type;
	itsval sales_items.quantity_sales_items%type;
BEGIN
	IF iname IS NULL THEN
		RAISE_APPLICATION_ERROR(-20001, 'Empty name');
    RETURN 0;
	END IF;
	IF isurname IS NULL THEN
		RAISE_APPLICATION_ERROR(-20001, 'Empty surname');
    RETURN 0;
	END IF;
	IF iemail IS NULL THEN
		RAISE_APPLICATION_ERROR(-20001, 'Empty email');
    RETURN 0;
	END IF;
	IF iaddress IS NULL THEN
		RAISE_APPLICATION_ERROR(-20001, 'Empty address');
    RETURN 0;
	END IF;
	IF iphone IS NULL THEN
		RAISE_APPLICATION_ERROR(-20001, 'Empty phone number');
    RETURN 0;
	END IF;

	SELECT count(clients.id_clients) INTO rescntcl FROM clients WHERE clients.name_clients = iname AND clients.surname_clients = isurname AND clients.email_clients = iemail AND clients.address_clients = iaddress AND clients.phone_number_clients = iphone;
	IF (rescntcl = 0) THEN
		INSERT INTO clients VALUES(clients_seq.NEXTVAL, iname, isurname, iemail, iaddress, iphone);
	END IF;
	SELECT id_clients INTO resclid FROM clients WHERE clients.name_clients = iname AND clients.surname_clients = isurname AND clients.email_clients = iemail AND clients.address_clients = iaddress AND clients.phone_number_clients = iphone;
	IF (resclid > 0) THEN
    dbms_output.put_line('Company code no.'||resclid);
		INSERT INTO sales VALUES(sales_seq.NEXTVAL, NULL, resclid, NULL, basketPrice, 0);
		SELECT max(sales.id_sales) INTO salesid FROM sales WHERE sales.id_clients = resclid AND sales.sales_price = basketPrice;
		IF (salesid > 0) THEN
			FOR i IN
				(SELECT level,
				trim(regexp_substr(itemsvalues, '[^;]+', 1, LEVEL)) str
				FROM dual
				CONNECT BY regexp_substr(itemsvalues , '[^;]+', 1, LEVEL) IS NOT NULL
				)
			LOOP
		      SELECT regexp_substr(i.str, '[^,]+', 1, 1), regexp_substr(i.str, '[^,]+', 1, 2) INTO itsid,itsval FROM dual;
		      INSERT INTO sales_items VALUES(id_sales, id_items, quantity_sales_items) VALUES(salesid, itsid, itsval);
			END LOOP;
			COMMIT;
      RETURN 1;
		END IF;
	ROLLBACK;
    RETURN 0;
	END IF;
  ROLLBACK;
  RETURN 0;
END;

CREATE OR REPLACE FUNCTION DECLINEPROVIDEFUNC(id IN provides.id_provides%type)
RETURN NUMBER
IS
CURSOR declineprovidecursor IS
SELECT PROVIDES_ITEMS.ID_ITEMS, PROVIDES_ITEMS.QUANTITY_PROVIDES_ITEMS FROM PROVIDES_ITEMS JOIN items ON items.id_items = provides_items.id_items WHERE PROVIDES_ITEMS.ID_PROVIDES = id;
PRAGMA AUTONOMOUS_TRANSACTION;
BEGIN
 	FOR i IN declineprovidecursor LOOP
    EXIT WHEN declineprovidecursor%notfound;
 		UPDATE items SET QUANTITY_ITEMS = QUANTITY_ITEMS - i.QUANTITY_PROVIDES_ITEMS WHERE ID_ITEMS = i.ID_ITEMS;
 	END LOOP;
 	DELETE FROM PROVIDES_ITEMS WHERE ID_PROVIDES = id;
 	DELETE FROM provides WHERE id_provides = id;
 	COMMIT;
 	RETURN 1;
 	exception
 		WHEN OTHERS THEN
 			ROLLBACK;
 			RETURN 0;
END;

CREATE OR REPLACE FUNCTION DECLINESALEFUNC(id IN sales.id_sales%type)
RETURN NUMBER
IS CURSOR declinesalecursor IS
SELECT id_items, QUANTITY_SALES_ITEMS from sales_items WHERE id_sales = id;
PRAGMA AUTONOMOUS_TRANSACTION;
BEGIN
	FOR i IN declinesalecursor LOOP
		UPDATE items SET QUANTITY_ITEMS = QUANTITY_ITEMS + i.QUANTITY_SALES_ITEMS WHERE id_items = i.ID_ITEMS;
	END LOOP;
	DELETE FROM sales_items WHERE id_sales = id;
	DELETE FROM sales WHERE id_sales = id;
	COMMIT;
 	RETURN 1;
	exception
 		WHEN OTHERS THEN
 			ROLLBACK;
 			RETURN 0;
END;

create or replace TRIGGER DELETEFROMITFT
BEFORE DELETE ON items FOR EACH ROW
BEGIN
	DELETE FROM ITEMS_FEATURES WHERE id_items = :old.id_items;
END;

CREATE OR REPLACE FUNCTION DELETEITEMFUNC(id IN items.id_items%type)
RETURN NUMBER
IS
PRAGMA AUTONOMOUS_TRANSACTION;
BEGIN
	DELETE FROM items WHERE id_items = id;
	COMMIT;
 	RETURN 1;
	exception
 		WHEN OTHERS THEN
 			ROLLBACK;
 			RETURN 0;
END;

create or replace TRIGGER DELETEFTFROMITFT
BEFORE DELETE ON features FOR EACH ROW
BEGIN
	DELETE FROM ITEMS_FEATURES WHERE id_features = :old.id_features;
END;

CREATE OR REPLACE FUNCTION DELETEFEATUREFUNC(id IN features.id_features%type)
RETURN NUMBER
IS
PRAGMA AUTONOMOUS_TRANSACTION;
BEGIN
	DELETE FROM features WHERE id_features = id;
	COMMIT;
 	RETURN 1;
	exception
 		WHEN OTHERS THEN
 			ROLLBACK;
 			RETURN 0;
END;

create or replace TRIGGER UPDATEADDITEMTOPROVIDE
AFTER INSERT ON provides_items FOR EACH ROW
BEGIN
	UPDATE items SET QUANTITY_ITEMS = QUANTITY_ITEMS + :new.QUANTITY_PROVIDES_ITEMS WHERE ID_ITEMS = :new.ID_ITEMS;
END;

CREATE OR REPLACE FUNCTION ADDITEMTOPROVIDEFUNC(id IN provides_items.id_provides%type, iditem IN items.id_items%type, val IN provides_items.QUANTITY_PROVIDES_ITEMS%type)
RETURN NUMBER
IS
PRAGMA AUTONOMOUS_TRANSACTION;
BEGIN
	INSERT INTO provides_items VALUES(id, iditem, val);
	COMMIT;
 	RETURN 1;
	exception
 		WHEN OTHERS THEN
 			ROLLBACK;
 			RETURN 0;
END;

create or replace TRIGGER UPDATEDELETEITEMFROMPROVIDE
BEFORE DELETE ON provides_items FOR EACH ROW
BEGIN
	UPDATE items SET QUANTITY_ITEMS = QUANTITY_ITEMS - :old.QUANTITY_PROVIDES_ITEMS WHERE ID_ITEMS = :old.ID_ITEMS;
END;

CREATE OR REPLACE FUNCTION DELETEITEMFROMPROVIDEFUNC(iditem IN PROVIDES_ITEMS.ID_ITEMS%type, idprovide IN provides_items.ID_PROVIDES%type)
RETURN NUMBER
IS
PRAGMA AUTONOMOUS_TRANSACTION;
BEGIN
	DELETE FROM provides_items WHERE ID_ITEMS = iditem AND ID_PROVIDES = idprovide;
	COMMIT;
 	RETURN 1;
	exception
 		WHEN OTHERS THEN
 			ROLLBACK;
 			RETURN 0;
END;


CREATE OR REPLACE FUNCTION DELETEEMPLOYEEFUNC(id IN employees.id_employees%type)
RETURN NUMBER
IS
CURSOR deleteemployeesalescursor IS SELECT s.id_sales FROM sales s JOIN employees ems ON s.id_employees = ems.id_employees WHERE ems.id_employees = id;
CURSOR deleteemployeeprovidescursor IS SELECT p.id_provides FROM provides p JOIN employees emp ON p.id_employees = emp.id_employees WHERE emp.id_employees = id;
PRAGMA AUTONOMOUS_TRANSACTION;
BEGIN
 	FOR i IN deleteemployeesalescursor LOOP
    EXIT WHEN deleteemployeesalescursor%notfound;
 		UPDATE sales SET id_employees = 1 WHERE id_sales = i.id_sales;
 	END LOOP;

 	FOR i IN deleteemployeeprovidescursor LOOP
    EXIT WHEN deleteemployeeprovidescursor%notfound;
 		UPDATE provides SET id_employees = 1 WHERE id_provides = i.id_provides;
 	END LOOP;
 	DELETE FROM employees WHERE id_employees = id AND id_employees != 1;
 	COMMIT;
 	RETURN 1;
 	exception
 		WHEN OTHERS THEN
 			ROLLBACK;
 			RETURN 0;
END;

CREATE OR REPLACE FUNCTION DELETECLIENTFUNC(id IN clients.id_clients%type)
RETURN NUMBER
IS
CURSOR deleteclientsalescursor IS SELECT s.id_sales FROM sales s JOIN clients cl ON s.id_clients = cl.id_clients WHERE s.id_clients = id;
PRAGMA AUTONOMOUS_TRANSACTION;
BEGIN
 	FOR i IN deleteclientsalescursor LOOP
    EXIT WHEN deleteclientsalescursor%notfound;
 		UPDATE sales SET id_clients = 1 WHERE id_sales = i.id_sales;
 	END LOOP;
 	DELETE FROM clients WHERE id_clients = id AND id_clients != 1;
 	COMMIT;
 	RETURN 1;
 	exception
 		WHEN OTHERS THEN
 			ROLLBACK;
 			RETURN 0;
END;

CREATE OR REPLACE FUNCTION DELETEPRODUCERFUNC(id IN producers.id_producers%type)
RETURN NUMBER
IS
CURSOR deleteproducercursor IS SELECT items.id_items from items JOIN producers ON items.id_producers = producers.id_producers WHERE items.id_producers = id;
PRAGMA AUTONOMOUS_TRANSACTION;
BEGIN
 	FOR i IN deleteproducercursor LOOP
    EXIT WHEN deleteproducercursor%notfound;
 		UPDATE items SET id_producers = 1 WHERE id_items = i.id_items;
 	END LOOP;
 	DELETE FROM producers WHERE id_producers = id AND id_producers != 1;
 	COMMIT;
 	RETURN 1;
 	exception
 		WHEN OTHERS THEN
 			ROLLBACK;
 			RETURN 0;
END;

CREATE OR REPLACE FUNCTION DELETEPROVIDERFUNC(id IN providers.id_providers%type)
RETURN NUMBER
IS
CURSOR deleteprovidercursor IS SELECT provides.id_provides from provides JOIN providers ON provides.id_providers = providers.id_providers WHERE provides.id_providers = id;
PRAGMA AUTONOMOUS_TRANSACTION;
BEGIN
 	FOR i IN deleteprovidercursor LOOP
    EXIT WHEN deleteprovidercursor%notfound;
 		UPDATE provides SET id_providers = 1 WHERE id_provides = i.id_provides;
 	END LOOP;
 	DELETE FROM providers WHERE id_providers = id AND id_providers != 1;
 	COMMIT;
 	RETURN 1;
 	exception
 		WHEN OTHERS THEN
 			ROLLBACK;
 			RETURN 0;
END;

CREATE OR REPLACE FUNCTION IINSERTEMPLOYEES (nname in employees.name_employees%type, ssurname in employees.surname_employees%type, eemail in employees.email_employees%type, password in employees.password_employees%type, aadress in employees.address_employees%type, pphone in employees.phone_number_employees%type)
RETURN NUMBER
IS
PRAGMA AUTONOMOUS_TRANSACTION;
BEGIN
	IF nname IS NULL THEN
		RAISE_APPLICATION_ERROR(-20001, 'Empty name');
	RETURN 0;
	END IF;
	IF ssurname IS NULL THEN
		RAISE_APPLICATION_ERROR(-20001, 'Emppty surrname');
	RETURN 0;
	END IF;
	IF eemail IS NULL THEN 
		RAISE_APPLICATION_ERROR(-20001, 'Empty email');
	RETURN 0;
	END IF;
	IF password IS NULL THEN 
		RAISE_APPLICATION_ERROR(-20001, 'Empty password');
	RETURN 0;
	END IF;
	IF aadress IS NULL THEN 
		RAISE_APPLICATION_ERROR(-20001, 'Empty address');
	RETURN 0;
	END IF;
	IF pphone IS NULL THEN 
		RAISE_APPLICATION_ERROR(-20001, 'Empty pphone');
	RETURN 0;
	END IF;
	INSERT INTO employees VALUES (employees_seq.NEXTVAL, nname, ssurname,eemail, DBMS_OBFUSCATION_TOOLKIT.md5 (input => UTL_RAW.cast_to_raw(password)), aadress, pphone);
COMMIT;
 	RETURN 1;
 	exception
 		WHEN OTHERS THEN
 			ROLLBACK;
 			RETURN 0;
END;