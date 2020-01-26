# Siren

## Commande à taper (sur Ubuntu) pour faire marcher le projet
```bash
composer install
yarn install

yarn encore dev
composer dump-env dev

php bin/console d:d:c 
php bin/console doctrine:migrations:migrate

# La commande ci-dessous permet d'importer les données du fichier .csv dans la base de données.
# Sachant que pour le projet je me suis limité à 3 colonnes dans le fichier (de la mise à jour du 29 mars) 
# que vous trouvez dans le dossier 'src/Data/Siren.csv'
php bin/console app:update-sirene
```
Après ça rdv sur la page `localhost/Siren/public/index.php/search/siren`
