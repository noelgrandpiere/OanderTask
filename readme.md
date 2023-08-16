# Teszt Feladat - Grandpiere Noel

Ez a projekt egy teszt feladat keretében készült az Oander számára, ahol a cél az volt, hogy egy PHP alapú webalkalmazást hozzak létre, amely termékek (monitorok) kezelését teszi lehetővé.

Note: Tudom, hogy nem lehet használni frameworkot, azonban a simfony template engine-ját használtam. Bízok benne, hogy ez nem okoz hátrányt.

## Időigény

A feladat elkészítése összesen nagyjából 2x2-2,5 órát vett igénybe.

## Telepítés és Futtatás

1. Klónozd le a repót a számítógépedre.
2. Futtasd a Docker Compose parancsot a projekt gyökérkönyvtárában: `docker-compose up -d`
3. Nyisd meg a böngészőt, és navigálj a `http://localhost:8080` URL-re.

Ha Mysql hibát jelez, akkor a config.env-ben kell átállítani az értékeket, ha hiányzik neki az autoload, akkor egy `composer install` parancs kell.

## Funkciók

- A webalkalmazás lehetővé teszi a termékek listázását oldalanként.
- Szűrők használatával keresés és szűrés a termékekre.
- Egyszerű telepítés Docker segítségével.

---

noel.grandpiere@outlook.hu