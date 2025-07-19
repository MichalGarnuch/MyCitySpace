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

![Zrzut ekranu 2025-07-19 173640](https://github.com/user-attachments/assets/68ea0e06-1b07-4c38-a51d-d9473b7cb0cd)

![Zrzut ekranu 2025-07-19 173733](https://github.com/user-attachments/assets/62aec0ae-08d5-4793-9f5d-c81238d118b7)

![Zrzut ekranu 2025-07-19 173817](https://github.com/user-attachments/assets/09fe3b51-ffdf-491c-b6a7-c0f9f40a288f)

![Zrzut ekranu 2025-07-19 173841](https://github.com/user-attachments/assets/6441e16b-14e3-4e54-b1a7-767d1d750e88)

![Zrzut ekranu 2025-07-19 173906](https://github.com/user-attachments/assets/8cc775da-9713-4c55-97e4-67f229830015)

![Zrzut ekranu 2025-07-19 173957](https://github.com/user-attachments/assets/df9d4de0-6b0f-4866-9bca-83345ae19d2b)

![Zrzut ekranu 2025-07-19 174030](https://github.com/user-attachments/assets/49cbcfdf-c2d8-42e5-b4a9-dbdcfc981f24)

![Zrzut ekranu 2025-07-19 174055](https://github.com/user-attachments/assets/1ff45b76-350e-4e2d-92a9-72f8a6eb464d)

![Zrzut ekranu 2025-07-19 174131](https://github.com/user-attachments/assets/ed6c58f5-7ec5-4e5d-96b0-8771a6aa17b8)




