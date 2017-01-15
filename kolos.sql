CREATE SEQUENCE client_seq START WITH 15;
CREATE SEQUENCE person_seq START WITH 21;
CREATE SEQUENCE address_seq START WITH 16;
CREATE OR REPLACE PROCEDURE addClientPersonAddress(
	name in Osoby.Imie%type,
	surname IN Osoby.Nazwisko%type,
	age IN Osoby.Wiek%type,
	stcw IN Osoby.Stan_cywilny%type,
	phone IN Osoby.Telefon%type,
	psl IN Osoby.Pesel%type,
	city IN Adresy.Miasto%type,
	street IN Adresy.Ulica%type,
	nr IN Adresy.Nr%type,
	off IN Klienci.Znizka%type)
IS
isexincl NUMBER;
nullexc exception;
isexerr exception;
ageexc exception;
pslex exception;
isexpsl NUMBER;
idpers Osoby.Id_osoby%type;
BEGIN
DBMS_OUTPUT.ENABLE;
	IF name IS NULL THEN
		dbms_output.Put_line('Person name is empty');
		raise nullexc;
	END IF;
	IF surname IS NULL THEN
		dbms_output.Put_line('Person surname is empty');
		raise nullexc;
	END IF;
	IF age IS NULL THEN
		dbms_output.Put_line('Person age is empty');
		raise nullexc;
	END IF;
	IF ((age < 0) OR (age > 125)) THEN
		dbms_output.Put_line('Person age is too small or too huge');
		raise ageexc;
	END IF;
	IF stcw IS NULL THEN
		dbms_output.Put_line('Person maritial status is empty');
		raise nullexc;
	END IF;
	IF psl IS NULL THEN
		dbms_output.Put_line('Person PESEL is empty');
		raise nullexc;
	END IF;
	IF city IS NULL THEN
		dbms_output.Put_line('Address city is empty');
		raise nullexc;
	END IF;
	IF street IS NULL THEN
		dbms_output.Put_line('Address street is empty');
		raise nullexc;
	END IF;
	IF nr IS NULL THEN
		dbms_output.Put_line('Address nr is empty');
		raise nullexc;
	END IF;
	IF off IS NULL THEN
		dbms_output.Put_line('Client off is empty');
		raise nullexc;
	END IF;

	SELECT count(*) INTO isexpsl FROM Osoby WHERE Pesel = psl;
	IF (isexpsl > 0) THEN
		dbms_output.Put_line('Pesel existing, must be unique');
		raise pslex;
	END IF;

	INSERT INTO Adresy VALUES(address_seq.NEXTVAL, city, street, nr);
	SELECT Id_adresu INTO idadrex FROM Adresy WHERE Miasto = city AND Ulica = street AND Nr = nr;
	IF idadrex IS NULL THEN
		dbms_output.Put_line('Address not insert');
		raise nullexc;
	END IF;

	INSERT INTO Osoby VALUES(person_seq.NEXTVAL, name, surname, age, stcw, phone, psl, idadrex);
	SELECT Id_osoby INTO idpers FROM Osoby WHERE Pesel = psl;

	IF idpers IS NULL THEN
		dbms_output.Put_line('Person not insert');
		raise nullexc;
	END IF;

	INSERT INTO Klienci VALUES(client_seq.NEXTVAL, idpers, off);
	dbms_output.Put_line('OK');

	EXCEPTION
		WHEN OTHERS THEN
			dbms_output.Put_line('Error with inserting client');
END;
/
--EXEC addClientPersonAddress(name, surname, age, stcw, phone, psl, city, street, nr, off);
--EXEC addClientPersonAddress('Andrzej', 'Dupa', 33, 'Żonaty', '+48 986345876', '34567890987', 'Warszawa', 'Cebulowa', '69', 15);

CREATE OR REPLACE FUNCTION COUNTEMPLMN(val IN NUMBER)
RETURN VARCHAR2
IS
resw NUMBER;
resm NUMBER;
BEGIN
SELECT COUNT(*) INTO resw FROM Pracownicy WHERE Pensja_br > val;
SELECT COUNT(*) INTO resm FROM Pracownicy WHERE Pensja_br < val;
RETURN 'Wiecej ' || resw || ' mniej ' || resm;
END;
--SELECT COUNTEMPLMN(5000) FROM dual;

CREATE OR REPLACE PROCEDURE kurzad1
IS
CURSOR kurzadcursor IS SELECT Pracownicy.Id_osoby FROM Pracownicy JOIN Osoby ON Pracownicy.Id_osoby = Osoby.Id_osoby WHERE Osoby.Wiek > 40;
BEGIN
	FOR i IN kurzadcursor LOOP
		EXIT WHEN kurzadcursor%notfound;
		UPDATE Pracownicy SET Pensja_br = Pensja_br + (Pensja_br * 0.2) WHERE Pracownicy.Id_osoby = i.Id_osoby;
	END LOOP;
	DBMS_OUTPUT.ENABLE;
	DBMS_OUTPUT.Put_line('OK');
	EXCEPTION
		WHEN OTHERS THEN
			DBMS_OUTPUT.Put_line('ERROR');
END;
/

CREATE OR REPLACE PROCEDURE OFFUP
IS
CURSOR curou IS SELECT Id_klienta, COUNT(*) AS CNT FROM Zlecenia GROUP BY Id_klienta ORDER BY Id_klienta;
BEGIN
  DBMS_OUTPUT.ENABLE;
  FOR i IN curou LOOP
    EXIT WHEN curou%NOTFOUND;
    DBMS_OUTPUT.PUT_LINE(i.Id_Klienta || ' ' || i.CNT);
    IF (i.CNT >= 3) THEN
      UPDATE Klienci SET Znizka = Znizka + (Znizka * 0.3) WHERE Id_klienta = i.Id_klienta;
    END IF;
  END LOOP;
  DBMS_OUTPUT.PUT_LINE('OK');
  EXCEPTION
    WHEN OTHERS THEN
      DBMS_OUTPUT.PUT_LINE('ERROR');
END;
/