# Upute za pokretanje

1. Potrebno je buildati Docker kontejner. U root direktoriju pokrenuti naredbu:

```
docker build -t php-my .
```

2. Pokrenuti docker-compose skriptu.

```
docker compose up
```

Potrebno je nešto vremena da se pokrene.

Prvo se pokreće MySQL server i u njemu se inicijaliziraju useri, baze podataka i tablice, te se unose podatci u tablice. Nakon što se pokrene MySQL, kreće pokretanje PHP servera.

Web stranici je moguće pristupiti `http://localhost`.


