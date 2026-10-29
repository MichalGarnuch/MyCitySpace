# MyCitySpace — przewodnik i audyt edukacyjny

**Stan przeglądu:** 29 października 2026 r.  
**Gałąź bazowa:** `main`  
**Analizowany commit:** `b3841c61a7de3b40187c5f141c1954c10c8dce60`  
**Mapa wszystkich plików śledzonych przez Git:** [1](AUDYT_MAPA_01.md)

> To jest przegląd reprezentatywnych części projektu z inwentaryzacją wszystkich śledzonych plików, a nie pełna, ręczna weryfikacja każdego wiersza ani certyfikat bezpieczeństwa. Mapa jest automatyczna; wymienienie pliku nie oznacza, że został przetestowany lub dokładnie przeczytany. Wyniki odnoszą się do powyższego commita. Inne gałęzie mogą zawierać inne wersje.

## Co robi projekt

Laravelowy system ewidencji nieruchomości, lokali, najemców i umów.

## Jak czytać kod i jak przepływają dane

[`routes/web.php`](routes/web.php) definiuje zasoby pod middleware auth. `LeaseController` operuje na modelach, a `LeaseRequest` uruchamia reguły dat, czynszu i dostępności lokalu; migracje i widoki wspierają trwałość oraz interfejs.

Podczas czytania zacznij od punktu wejścia, przejdź do funkcji odpowiadającej za żądanie lub działanie użytkownika, a potem do operacji na danych i wyniku. Mapa plików podaje ścieżki i automatycznie rozpoznane nazwy wybranych deklaracji.

## Co jest wartościowe w obecnym rozwiązaniu

Reguły walidacji są wydzielone w osobne klasy; kontroler pobiera relacje, co zmniejsza część problemów z nadmiarem zapytań.

## Ustalenia, luki i proponowany rozwój

- **Potwierdzone — definicje tras:** [`routes/web.php`](routes/web.php) definiuje `/dashboard` dwukrotnie, z różnym zestawem middleware. Uporządkuj jedną definicję i zweryfikuj wynikowy routing oraz wymóg weryfikacji konta.

- **Do sprawdzenia — uprawnienia:** `LeaseRequest::authorize()` zwraca `true`, a przejrzany `LeaseController` pobiera wszystkie umowy. Jeśli dane mają być ograniczone do właściciela/organizacji, dodaj polityki i testy izolacji.

- **Do rozwoju:** zabezpieczyć konflikt jednocześnie zakładanych umów na poziomie transakcji/bazy, nie tylko walidacji przed zapisem.

## Sprawdzenia i ich granice

Nie uruchomiono testów Laravel ani bazy z powodu braku PHP/Composera. Oceniono routing, kontroler i walidację umowy.

W kopii roboczej dostępne pliki Pythona sprawdzono dodatkowo parserem składni; sprawdzono też składnię odczytanych plików [`package.json`](package.json) i [`composer.json`](composer.json). Nie zastępuje to uruchomienia programu. Kod źródłowy tej gałęzi jest taki sam jak w commicie bazowym; dodane są wyłącznie dokumenty audytu i mapy.

## Jak zaplanować kolejne prace

Najpierw zajmij się punktami oznaczonymi jako krytyczne lub wysokie, następnie ustal, które uwagi wymagają testu na pełnym środowisku. Dla każdej zmiany przygotuj osobną gałąź, konkretny przypadek odtwarzający problem i test rezultatu. Nie traktuj propozycji jako potwierdzenia, że poprawka została już wdrożona.
