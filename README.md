# Siren

## Commande à taper pour faire marcher le projet
```bash
composer install
yarn install

yarn encore dev
composer dump-env dev

php bin/console d:d:c 
php bin/console doctrine:migrations:migrate

# importer les données du fichier .csv dans la base de données
php bin/console app:update-sirene
```
Après ça rdv sur la page `localhost/Siren/public/index.php/search/siren`
