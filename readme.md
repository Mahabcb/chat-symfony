# Introduction à Symfony

## Prérequis

- Composer
- PHP >= 8.0
- Docker
- symfony-cli

## Lancement:

- Initier un projet symfony (version minimum)
````
symfony new 'nom_du_projet'
````

- Initier un projet symfony (version full)
````
symfony new 'nom_du_projet' --webapp
````

- Lancer le serveur web Symfony
````
symfony serve -d
````

- Liste des commandes exécutables :

````
symfony console
````

- Télécharger le maker de symfony :
`````
composer require --dev symfony/maker-bundle
`````

- Télécharger l'ORM doctrine :
`````
composer require orm      
`````

- Générer des entités :
`````
symfony console make:entity
`````

