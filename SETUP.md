# Setup

## Setup instructions for developers

### Without script

If you want to locally develop on the platform, you can follow the instructions above using the script to configure the application. However, you can also perform these operations manually:

    # Composer install
    composer install

    # Create a new database
    touch database/database.sqlite

    # Migrations
    php artisan migrate

    # Environment file
    cp .env.example .env

    # Install Elixir dependencies
    sudo npm install

    # Gulp
    # Use --production flag for minified files
    gulp watch --production

### Setting up environment

You will want to replace some of the lines in the environment file with different values, depending on your setup.

### ez-mode

To set it all up in one go:

    composer install && touch database/database.sqlite && php artisan migrate && cp .env.example .env

If you do not want to go through the wizard, you can use the SettingsTestSeeder to seed default data. (This is the data that is also used by the unit tests.)

    php artisan db:seed --class=SettingsTestSeeder