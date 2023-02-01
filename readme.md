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

- Télécharger l'ORM doctrine (abstraction sql pour base de donnée) :
`````
composer require orm
`````

- Créer une database avec docker :
````
symfony console make:docker:database   
````

- lancer la database docker :
`````
docker-compose up -d  
`````

- Créer la base de donnée :
`````
symfony console doctrine:database:create
`````

- Générer des entités :
`````
symfony console make:entity
`````

- Ajouter le profiler symfony :
````
composer require profiler
````

- Nettoyer le cache:
````
symfony console cache:clear 
````
