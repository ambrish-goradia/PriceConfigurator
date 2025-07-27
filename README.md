# Tech Stack

- Laravel 12
- Livewire 3
- PHP 8.3+
- MySQL DB

# Installation & Setup

1. Clone the repo

git clone https://github.com/ambrish-goradia/PriceConfigurator.git
cd PriceConfigurator

2. Install Dependencies

composer install
npm install && npm run dev

3. Set up database

Edit your .env and configure database connection, then:
php artisan migrate --seed

4. Run the app

php artisan serve