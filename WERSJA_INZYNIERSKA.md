# MyCitySpace: zapis umowy bez luki między sprawdzeniem a transakcją

Branch: `wersja-inzynierska-2026`. Stan bazowy: `main` / `b3841c61a7de3b40187c5f141c1954c10c8dce60`. Data wykonania: 29.10.2026.

To autorski wariant rozwojowy konkretnego fragmentu projektu. Branch zachowuje pełne drzewo kodu z wersji bazowej i zawiera opisane poniżej zmiany. [Wcześniejszy audyt](https://github.com/MichalGarnuch/MyCitySpace/tree/audyt-edukacyjny-2026) jest na osobnym branchu. Nie wykonywano merge ani wdrożenia.

## Dlaczego walidacja przed zapisem nie wystarcza

Dwa żądania mogą sprawdzić brak kolidującej umowy, a potem oba ją zapisać. Sprawdzenie poprawności w kontrolerze poprawia komunikat, ale nie rozwiązuje wyścigu. Szczególnie zawodna jest blokada wyszukująca wyłącznie istniejące umowy: przy pierwszej umowie dla lokalu nie ma czego zablokować.

`app/Services/LeaseWriter.php` wykonuje decyzję i zapis w jednej transakcji. Najpierw blokuje stabilny rekord nadrzędny `Unit` przez `lockForUpdate`, potem ponownie sprawdza `Lease::conflictsWith`, a dopiero na końcu zapisuje. Dwa zapisy do tego samego lokalu muszą przejść przez tę samą blokadę, także gdy tabela umów była pusta. Transakcja ma ograniczone ponowienie przy konflikcie blokad.

## Integracja i schemat

Tworzenie i aktualizacja w `LeaseController` korzystają z nowego writera. Pozostaje wcześniejsza walidacja pól i modelowa definicja nakładania dat. Usunąłem również drugi route dashboardu, który omijał zamierzoną grupę auth.

Test ujawnił dodatkową sprzeczność: reguły przyjmowały umowę bez daty końcowej, a kolumna była NOT NULL. Migracja `allow_open_ended_leases` uzgadnia schemat z kontraktem domeny. Rollback odmawia przywrócenia NOT NULL, jeśli istnieją umowy otwarte — nie wymyśla im dat i nie usuwa danych.

## Co potwierdza test

Dwa testy z SQLite w pamięci zapisują umowy przez rzeczywistą usługę i sprawdzają odrzucenie nakładania oraz dopuszczenie niekolidujących okresów. Sprawdzają również zgodność nullable end date z migracją. SQLite nie udowadnia semantyki blokad w MySQL/PostgreSQL; do tego potrzebny jest test z dwiema niezależnymi konekcjami i kontrolą kolejności transakcji.

## Następne kroki

Wszystkie inne ścieżki zapisu (import, panel, job) muszą używać tej samej usługi albo mocniejszego ograniczenia bazy. W PostgreSQL warto rozważyć exclusion constraint dla zakresów dat jako ostateczną ochronę. Dodałbym wersję rekordu do wykrywania równoczesnej edycji tej samej umowy; obecny lock lokalu nie jest wersjonowaniem formularza i nie rozwiązuje każdego lost update.

Przed wdrożeniem trzeba wyczyścić wcześniejsze kolizje, sprawdzić indeksy po `unit_id` i datach oraz wykonać migrację na kopii danych. Ten branch nie zmieniał zewnętrznej bazy.


## Powtarzalne testy i działające CI

Po publikacji GitHub wykrył wcześniej istniejący pusty `schedule` w workflow. Usunąłem nieważną sekcję i dodałem workflow dla tego brancha. Pełna bateria HTTP nie potrzebuje manifestu assetów Vite, dlatego TestCase wyłącza wyłącznie obsługę Vite w testach; budowanie i test UI pozostają osobnymi zadaniami. phpunit.xml jawnie wybiera izolowane SQLite w pamięci.

Testy LeaseTest miały daty 2024 i losowy status lokalu. Upływ czasu powodował błąd „data z przeszłości”, a losowe occupied mogło dawać odmowę z innego powodu niż badana kolizja. Zamroziłem zegar w tej klasie testów i jawnie ustawiłem wolny lokal; po teście zegar jest przywracany. Nie poluzowałem reguł produkcyjnych, żeby dopasować je do starych fixture. Nowy workflow uruchamia pełne PHPUnit na PHP 8.3.

## Weryfikacja wykonana w tej sesji

| Sprawdzenie | Wynik i znaczenie |
|---|---|
| PHPUnit --filter LeaseWriterTest | PASS: 2 testy usługi i migracji na SQLite |
| php -l zmienionych plików | PASS |
| Pełny vendor/bin/phpunit, PHP 8.3 / SQLite w pamięci | PASS: 47 testów po uniezależnieniu fixture od zegara i assetów |

### Granice weryfikacji

Pełna bateria PHPUnit przeszła na SQLite. Nie wykonano testów przeglądarkowych, asset builda ani testu wyścigu dwóch połączeń na docelowym silniku. Trzeba zweryfikować inne ścieżki zapisu i wcześniejsze kolizje danych.

## Mapa zmian

- [`.github/workflows/engineering-contracts.yml`](.github/workflows/engineering-contracts.yml)
- [`app/Services/LeaseWriter.php`](app/Services/LeaseWriter.php)
- [`database/migrations/2026_10_29_000001_allow_open_ended_leases.php`](database/migrations/2026_10_29_000001_allow_open_ended_leases.php)
- [`tests/Feature/LeaseWriterTest.php`](tests/Feature/LeaseWriterTest.php)
- [`.github/workflows/tests.yml`](.github/workflows/tests.yml)
- [`app/Http/Controllers/LeaseController.php`](app/Http/Controllers/LeaseController.php)
- [`phpunit.xml`](phpunit.xml)
- [`routes/web.php`](routes/web.php)
- [`tests/Feature/LeaseTest.php`](tests/Feature/LeaseTest.php)
- [`tests/TestCase.php`](tests/TestCase.php)
