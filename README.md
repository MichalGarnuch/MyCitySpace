# MyCitySpace

MyCitySpace to prosta aplikacja w Laravelu do zarządzania nieruchomościami, lokalami, lokatorami i umowami najmu.

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

W pliku `.env` domyślnie aktywne jest połączenie SQLite (`DB_CONNECTION=sqlite`).
Chcąc używać MySQL, zmień `DB_CONNECTION` na `mysql` i uzupełnij pola `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`.

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
