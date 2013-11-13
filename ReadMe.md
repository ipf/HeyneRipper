#  HeyneRipper

Ripper for all files from Heyne Digital

## Installation

Clone this repository and install all needed dependencies using composer.

$ ``` composer install ```

## Configuration

All configuration is done in config.json.

## Running

HeyneRipper can be run from commandline with

$ ``` php index.php ```

You may also pass additional arguments such as

$ ``` php index.php clean ```

which cleans the *Data* directory where logfiles and downloaded data reside.

## Todos

* enable search engine indexing (Solr, elasticsearch)
* implement error counter
* implement more rippers
* write more unit tests
* more cli options