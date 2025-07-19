# MyCitySpace

MyCitySpace to niewielki system do zarządzania nieruchomościami napisany w Laravelu 11. Umożliwia prowadzenie ewidencji budynków, lokali, lokatorów i umów najmu wraz z listą dostępnych udogodnień. Projekt korzysta z pakietu Breeze do uwierzytelniania i budowania podstawowego interfejsu użytkownika opartego o Tailwind CSS oraz Alpine.js.

## Główne funkcje

- **Nieruchomości** – możliwość tworzenia i edycji budynków wraz z listą lokali.
- **Lokale** – przypisane do nieruchomości lokale posiadają status (wolny/zajęty) i powiązane umowy.
- **Najemcy** – baza lokatorów z danymi kontaktowymi.
- **Umowy najmu** – rejestrowanie okresów wynajmu wraz z kontrolą kolidujących terminów i kwotą czynszu.
- **Udogodnienia** – osobne wpisy, które można powiązać z nieruchomością, lokalem lub lokatorem.
- **Uwierzytelnianie** – logowanie i zarządzanie profilem użytkownika (Laravel Breeze).

## Stos technologiczny

Projekt stworzono w oparciu o:

- PHP 8.2 i framework **Laravel 11**.
- Baza danych SQLite (domyślnie) lub MySQL.
- Frontend kompilowany przez **Vite**, z wykorzystaniem **Tailwind CSS** i **Alpine.js**.
- Testy jednostkowe i funkcjonalne w **PHPUnit** (katalog `tests/`).

## Wymagania

- PHP \(>= 8.2\)
- Composer
- Node.js wraz z npm
- Opcjonalnie: MySQL (np. w pakiecie XAMPP). Domyślnie używana jest baza SQLite.

## Instalacja

```bash
git clone https://github.com/MichalGarnuch/MyCitySpace.git
cd MyCitySpace
composer install
npm install
```

Podczas `composer install` automatycznie zostanie utworzony plik `.env`, pusty `database/database.sqlite` oraz uruchomione migracje.

## Konfiguracja

Jeżeli `.env` nie został utworzony, skopiuj go ręcznie:

```bash
cp .env.example .env
```

Wygeneruj klucz aplikacji:

```bash
php artisan key:generate
```

W pliku `.env` domyślnie aktywne jest połączenie SQLite (`DB_CONNECTION=sqlite`). Chcąc używać MySQL, zmień `DB_CONNECTION` na `mysql` i uzupełnij pola `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`.

## Baza danych

Aby skorzystać z przykładowej bazy dołączonej do repozytorium:

```bash
cp mycityspace_db database/database.sqlite
```

Możesz też utworzyć pusty plik `database/database.sqlite` i uruchomić migracje oraz seedy:

```bash
php artisan migrate --seed
```

Seeder `UserSeeder` tworzy konto administratora `admin@example.com` z hasłem `password`.

## Kompilacja zasobów

- Tryb developerski:

```bash
npm run dev
```

- Wersja produkcyjna:

```bash
npm run build
```

## Uruchomienie aplikacji

```bash
php artisan serve
```

Aplikacja będzie dostępna pod adresem `http://localhost:8000`.

Po uruchomieniu można zalogować się danymi administratora i rozpocząć korzystanie z aplikacji.

## Testy

```bash
php artisan test
```

Polecenie uruchomi zestaw testów jednostkowych i funkcjonalnych z katalogu `tests/`.

## Zrzuty ekranu
