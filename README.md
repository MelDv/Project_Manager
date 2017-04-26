# Tietokantasovelluksen esittelysivu

Sisäänkirjautuminen: käyttäjätunnus a@a.fi salasana: 1111111 (seitsemän ykköstä)


Yleisiä linkkejä (huom! osalle sivuista pitää ensin kirjautua):

* [Linkki sovellukseeni](http://madufva.users.cs.helsinki.fi/tsoha)
  * [Projektilistaus](http://madufva.users.cs.helsinki.fi/tsoha/projektit)
  * [Käyttäjän oma sivu](http://madufva.users.cs.helsinki.fi/tsoha/kayttajat/1)
  * [Omat tehtäväti](http://madufva.users.cs.helsinki.fi/tsoha/projektit/omattehtavat)
  * [Oman sivun muokkaus](http://madufva.users.cs.helsinki.fi/tsoha/kayttajat/1/muokkaa)
  * [Käyttäjälistaus](http://madufva.users.cs.helsinki.fi/tsoha/kayttajat)
* [Linkki dokumentaatiooni](doc/dokumentaatio.pdf)

## Työn aihe

Projektinhallintasovellus, jossa voidaan luoda projekteja ja niille tehtäviä, sekä seurata työn edistymistä.
Tehtäville voidaan lisätä tekijöitä ja merkitä tehtäviä tehdyiksi. Kun kaikki projektin tehtävät ovat valmiita,
projekti merkitään automaattisesti valmiiksi. Projektin tekijälistaus tulee automaattisesti sen tehtävistä.
Projekteja ei voi poistaa, jos niissä on hyväksyttyjä tehtäviä. Projektin poistaminen poistaa myös kaikki sen tehtävät.

Sovellusta voidaan käyttää monenlaisten työkokonaisuuksien hallintaan ja töiden jakamiseen. Kukin käyttäjä näkee 
omien tehtäviensä tilan ja voi muuttaa sitä, sekä selailla kaikkia tehtäviä.

Käyttäjiä voidaan lisätä Käyttäjät-sivulta käsin. Tässä kohtaa ei täytetä kaikkia taulun kenttiä. Ajatuksena on, että adminit luovat käyttäjät ja kutsuvat heidät käyttäjiksi. He voivat muokata omia tietojaan ja tässä vaiheessa lisätä puuttuvat tiedot.

Käyttäjät kuuluvat yhteen tai useampaan ryhmään (esim. ohjelmointi, asiakaspalvelu...) Ryhmissä on monta käyttäjää ja käyttäjillä voi olla monta ryhmää. Käyttäjillä on myös useita tehtäviä ja tehtävillä useita käyttäjiä.

Toimintoja:
* Kirjautuminen
* Käyttäjien lisääminen, muokkaaminen ja poistaminen
* Projektien lisääminen, muokkaaminen ja poistaminen
* Tehtävien lisääminen, muokkaaminen, poistaminen
* Jokaisella projektilla tulee olla vähintään yksi tehtävä ja jokaisella tehtävällä vähintään yksi tekijä
* Tehtävät voivat liittyä vain yhteen projektiin
* Kun projektin tehtävät ovat valmiita, projekti tulee automaattisesti valmiiksi







<a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/"><img alt="Creative Commons -lisenssi" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-nd/4.0/88x31.png" /></a><br />Tämä teos, jonka tekijä on <span xmlns:cc="http://creativecommons.org/ns#" property="cc:attributionName">Maaret Dufva</span>, on lisensoitu <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/">Creative Commons Nimeä-EiKaupallinen-EiMuutoksia 4.0 Kansainvälinen  -lisenssillä</a>.
