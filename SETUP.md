# Setup

## Important

There are some things you'll need to do after a succesful installation. You'll find the details below.

## Setup instructions for developers

### A note on newer builds

Whenever you are pulling a newer version of W4P, you should probably run:

    composer dump && gulp

If this is your first time setting up the project, you can use the script or follow the instructions below.

### Without script

If you want to locally develop on the platform, you can follow the instructions above using the script to configure the application. However, you can also perform these operations manually:

    # Create a new database
    touch database/database.sqlite

    # Composer install
    composer install

    # Migrations
    php artisan migrate && php artisan db:seed

    # If this is the first time setting the project up, seed the default pages (running this again will result in duplicates!)
    php artisan db:seed --class=DefaultPagesSeeder

    # Environment file
    cp .env.example .env

    # Generate a new key
    php artisan key:generate

    # Install Elixir dependencies
    npm install

    # Gulp
    # Use --production flag for minified files
    gulp --production


### A note on Gulp

Gulp/Elixir is responsible for:

    * Minification and concatenation of SASS files
    * Copying assets to the correct directory
    * CSS/JS versioning

### Setting up environment

You will want to replace some of the lines in the environment file with different values, depending on your setup.

### Localization

In order to localize the application, you must translate the existing strings in the /app/resources/lang folder and e.g. use your own language code (e.g. nl) as a folder.

For example, you might want to translate this part of core.php:

    return [
        "project" => "Project",
        "howdoesitwork" => "How does it work?"
    ];

You can do it like this:

    return [
        "project" => "Project",
        "howdoesitwork" => "Hoe werkt het?"
    ];

### ez-mode

To set it all up in one go:

    touch database/database.sqlite && composer install && php artisan migrate && php artisan db:seed && php artisan key:generate && cp .env.example .env

If you do not want to go through the wizard, you can use the SettingsTestSeeder to seed default data. (This is the data that is also used by the unit tests.)

    php artisan db:seed --class=SettingsTestSeeder

### Write access

The following directories need to be writable (and if they do not exist, create them with `mkdir`):

* /public/images
* /public/organisation
* /public/project
* /public/platform
* /database
* /storage

Terminal commands:

    cd public
    chmod -R a+w images
    chmod -R a+w organisation
    chmod -R a+w project
    chmod -R a+w platform
    cd ..
    chmod -R a+w database
    chmod -R a+w storage

## Post installation instructions

### Twitter cards

Twitter cards with a player need validation - so you need to run your hostname through a validation procedure: see https://cards-dev.twitter.com/validator

### Mollie

Mollie also has a validation procedure for accepting payments.

**Before you can accept payments, you need to have them validate your website. In order to make complying to the TOS easier, we require you to fill in some information (more below)**.

They will check these guidlines before approving you:

> Uw ondernemingsnummer ... moet duidelijk zichtbaar zijn voor al uw bezoekers. Alleen vermelden in uw algemene voorwaarden is niet voldoende.
  De handelsnaam ... moet bij de Kamer van Koophandel geregistreerd staan onder hetzelfde ondernemingsnummer ... .
  Als u BTW-plichtig bent, is het vermelden van uw BTW-nummer op de website verplicht.
  Het vermelden van een vestigingsadres is verplicht. Een postbus is helaas niet toegestaan. Vermeld eventueel dat het géén bezoekadres is.
  Het e-mailadres ... in het websiteprofiel moet duidelijk zichtbaar zijn voor al uw bezoekers of eventueel te bereiken zijn via een contactformulier, mochten zij vragen hebben over hun bestelling.
  Naast het vermelden van uw e-mailadres dient u ook een manier aan te bieden waar op klanten direct contact met u kunnen opnemen, bijvoorbeeld een telefoonnummer.

If you enter a Mollie API key in the setup, you are REQUIRED to enter valid organisation information for:

* Your organisation's VAT number
* Your organisation's email address
* Your organisation's physical address

Remember, you can also customize your footer to provide additional information.