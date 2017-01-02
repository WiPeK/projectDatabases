DELETE FROM producers;
DELETE FROM items;
DELETE FROM features;
DELETE FROM items_features;

TRUNCATE TABLE producers;
TRUNCATE TABLE items;
TRUNCATE TABLE features;
TRUNCATE TABLE items_features;

CREATE sequence producers_seq minvalue 1 start with 1 increment by 1;
CREATE sequence features_seq minvalue 1 start with 1 increment by 1;
CREATE sequence items_seq minvalue 1 start with 1 increment by 1;
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