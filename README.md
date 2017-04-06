# Tietokantasovelluksen esittelysivu

### Huom! Nelosviikolle tehty...
Testikäyttäjä Testi-Admin. Kirjautuminen sähköpostilla a@a ja salasanalla 1111111 (seitsemän ykköstä)

Käyttäjiä voi päivittää ja poistaa. Huom! Vain adminin oman sivun muokkaus toimii, ei muiden käyttäjien muokkaus vielä. (yläpalkista omalle sivulle) Muiden muokkauksessa muokattaisiin käyttöoikeuksia jne.
Vain admin voi poistaa tai lisätä käyttäjiä (käyttäjien listaussivulla)
Virheilmoitukset ja viestit näkyy.

*Validointi
  * Käyttäjänimi a-Ö, min 4 merkkiä
  * Salasana min 7 merkkiä ja sallitut merkit listattu
  * Kuvaus max 2000 merkkiä
  * Emailin muodon tarkastaminen suoraan bootstapista

* Muutokset kirjautumisen jälkeen
  * Kirjautumislinkki vaihtuu uloskirjautumiseen
  * Admin näkee muiden käyttäjien sivulla  muokkauslinkin
  * Admin näkee käyttäjien listauksessa poistolinkin ei-aktiivisten kohdalla
  * Navigointilinkeihin tulee oma sivu ja omat tehtävät
  * Vain admin voi lisätä käyttäjiä

Yleisiä linkkejä:

* [Linkki sovellukseeni](http://madufva.users.cs.helsinki.fi/tsoha)
  * [Projektilistaus](http://madufva.users.cs.helsinki.fi/tsoha/projektit)
  * [Oma sivu](http://madufva.users.cs.helsinki.fi/tsoha/kayttajat/1)
  * [Omat tehtävät](http://madufva.users.cs.helsinki.fi/tsoha/omattehtavat)
  * [Oman sivun muokkaus](http://madufva.users.cs.helsinki.fi/tsoha/kayttajat/1/muokkaa)
  * [Käyttäjälistaus](http://madufva.users.cs.helsinki.fi/tsoha/kayttajat)
* [Linkki dokumentaatiooni](doc/dokumentaatio.pdf)

## Työn aihe

Projektinhallintasovellus, jossa voidaan luoda projekteja ja niille tehtäviä, sekä seurata työn edistymistä.
Tehtäville voidaan lisätä tekijöitä ja merkitä tehtäviä tehdyiksi. Kun kaikki projektin tehtävät ovat valmiita,
projekti merkitään automaattisesti valmiiksi. Projektin tekijälistaus tulee automaattisesti sen tehtävistä.

Sovellusta voidaan käyttää monenlaisten työkokonaisuuksien hallintaan ja töiden jakamiseen. Kukin käyttäjä näkee 
omien tehtäviensä tilan ja voi muuttaa sitä, sekä selailla kaikkia tehtäviä.

Käyttäjiä voidaan lisätä Käyttäjät-sivulta käsin. Tässä kohtaa ei täytetä kaikkia taulun kenttiä. Ajatuksena on, että adminit luovat käyttäjät ja kutsuvat heidät käyttäjiksi. He voivat muokata omia tietojaan ja tässä vaiheessa lisätä puuttuvat tiedot.

Käyttäjät kuuluvat yhteen tai useampaan ryhmään (esim. ohjelmointi, asiakaspalvelu...) Ryhmissä on monta käyttäjää ja käyttäjillä voi olla monta ryhmää. Käyttäjillä on myös useita tehtäviä ja tehtävillä useita käyttäjiä.

Toimintoja:
* Kirjautuminen
* Käyttäjien lisääminen, muokkaaminen ja poistaminen
* Projektien lisääminen, muokkaaminen ja poistaminen
* Tehtävien lisääminen, muokkaaminen, poistaminen ja yhdistäminen
* Jokaisella projektilla tulee olla vähintään yksi tehtävä ja jokaisella tehtävällä vähintään yksi tekijä
* Tehtävät voivat liittyä vain yhteen projektiin
* Kun projektin tehtävät ovat valmiita, projekti tulee automaattisesti valmiiksi

