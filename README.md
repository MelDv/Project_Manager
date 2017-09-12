(yliopisto sulki palvelimet, joilla sovellus oli, joten se ei toimi tällä hetkellä)

# Tietokantasovelluksen esittelysivu

Sisäänkirjautuminen: käyttäjätunnus a@a.fi salasana: 1111111 (seitsemän ykköstä)

Lopulliseen palautukseen tehty:

* Kirjautuminen ja uloskirjautuminen
* Suurin osa sivuista edellyttää kirjautumista
* Adminille näkyy toimintoja, joita muut eivät voi tehdä
* Tietokohteet:
  * Person - CRUD-nelikko toimii (Huom! Poistaminen edellyttää, että admin on laittanut käyttäjälle available=false ja ettei hän ole aktiivisen projektin projektipäällikkönä, tai minkään tehtävän ainoa tekijä
  * Project - CRUD-nelikko toimii (Huom! Vain adminille)
  * Task - CRUD-nelikko toimii
  * Work_Group - Ei CRUD-nelikkoa. Ryhmiä on kolme. Käyttäjät voidaan liittää tai poistaa ryhmistä
  * 2 liitostaulua (ks. alla)
* Monesta moneen -yhteydet
  * Task - Person (liitostaulu Workers_tasks)
  * Work_group - Person (liitostaulu Workers_groups)
* Dokumentaatio
* Create_tables.sql, drop_tables.sql ja add_test_data.sql


### Yleisiä linkkejä (huom! osalle sivuista pitää ensin kirjautua):

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

Tehtävillä ja projekteilla on alkamis- ja loppumispäivä. Jos tehtävää ei ole merkitty valmiiksi ennen deadlinea, se menee tilaan "myöhässä". Myöhästymisten seuraaminen on mahdollista myös projektin valmistumisen jälkeen, sillä sekä tehtävillä että projekteilla on raportointia ja tilastoja varten erikseen tallentuva boolean-arvo late.

Sovellusta voidaan käyttää monenlaisten työkokonaisuuksien hallintaan ja töiden jakamiseen. Kaikki käyttäjät näkevät projektit ja tehtävät ja voivat tehdä muokkauksia. Osa toiminnoista on vain adminien tehtävissä (esim. projektien luominen)

Käyttäjiä voidaan lisätä Käyttäjät-sivulta käsin. Adminit luovat käyttäjät ja kutsuvat heidät käyttäjiksi. Käyttäjät voivat muokata omia tietojaan, mutta vain adminit voivat muokata oikeuksia tai asettaa käyttäjän tilan (available true tai false).

Käyttäjät kuuluvat yhteen tai useampaan ryhmään (esim. ohjelmointi, asiakaspalvelu...) Ryhmissä on monta käyttäjää ja käyttäjillä voi olla monta ryhmää.

Joitain sovelluksen toimintoja:
* Kirjautuminen
* Käyttäjien lisääminen, muokkaaminen ja poistaminen
* Projektien lisääminen, muokkaaminen ja poistaminen
* Tehtävien lisääminen, muokkaaminen, poistaminen
* Jokaisella tehtävällä täytyy olla vähintään yksi tekijä
* Tehtävät voivat liittyä vain yhteen projektiin, mutta niillä voi olla monta tekijää








<a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/"><img alt="Creative Commons -lisenssi" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-nd/4.0/88x31.png" /></a><br />Tämä teos, jonka tekijä on <span xmlns:cc="http://creativecommons.org/ns#" property="cc:attributionName">Maaret Dufva</span>, on lisensoitu <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/">Creative Commons Nimeä-EiKaupallinen-EiMuutoksia 4.0 Kansainvälinen  -lisenssillä</a>.
