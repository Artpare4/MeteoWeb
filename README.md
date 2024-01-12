# MeteoWeb
## Arthur Parent
![Static Badge](https://img.shields.io/badge/symfony-5.4-orange)
![Static Badge](https://img.shields.io/badge/php-8.1-blue)

## Documentation
La documentation du projet(MCD,Diagramme Use Case, Dump de la base de donnée) se situe dans le répertoire ``/Documentaion``.


## Scripts Composer

### Lancement d'un serveur local
```
composer start
```

### Génération/Regénération de la base de donnée

```
composer db
```
## Installation du projet:
### Prérequis:
- Installer **composer**
- Installer **Symfony**

### Installaton:

1. Installer les dépendances requises pour le projet:
```
composer install
```

2. Générer la base de donnée
```
composer db
```

3. Lancer le serveur web local
```
composer start
```



## Descriptif de la réalisation

Lors de ce projet, j'ai utiliser phpStorm en tant qu'IDE pour développer.

Pour pouvoir mener à bien ce projet, j'ai du notement installer le paquet easyAdmin dans le bût de
réaliser le CRUD des entités facilement.
Pour ce qui est de la création des entités, j'ai utiliser le makeBundle de symfony. La création des formulaire d'inscription et
de connexion à aussi été effectué avec le makeBundle.
En ce qui concerne la base de donnée, j'ai utilisé un serveur Mysql fournis par le département informatique de l'IUT.

Au cours de ce projet, j'ai du me familliariser avec l'utilisation des API avec symfony. Des requêtes à l'implémentation des
valeurs reçus, j'ai du apprendre comment les gérer, les utilisés et les exploités pour en extraire les valeurs souhaités.


## Comptes Utilisateurs

### Parent
- Nom : Parent
- Prénom : Arthur
- Email : test@exemple.com
- Mot de passe : test
- Rôles : Admin


