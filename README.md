# Hungarian name day database

## Direct usage

Name days are stored in CSV, JSON and SQLite formats in the project's data directory.

## PHP

```
$nameDays = new \sbolch\NameDays();
$nameDays->today(); // returns today's names in an array
```
