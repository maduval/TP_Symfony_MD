TP_Symfony_MD
=============

A Symfony project created on May 19, 2016, 3:44 pm.

Cloner ce repository
-
Plus d'informations: <https://help.github.com/articles/cloning-a-repository/>

Se placer à la racine du projet:
    
    $ cd TP_Symfony_MD/

Installer des dependances
-
    
    $ php composer.phar update

Créer la BDD et charger des données de test
-
Créer la BDD:

    $ php app/console doctrine:database:create

*En cas d'erreur, vérifier les paramètres de connexion à la base de données dans le fichier: app\config\parameters.yml*

Créer les tables:

    $ php app/console doctrine:schema:create

Charger des données:

    $ php app/console doctrine:fixtures:load

Créer un utilisateur de test
-

    $ php app/console md:jobeet:users admin admin

Lancer le serveur
-

    $ php app/console server:run

Visiter le site et son back-office
-

Site: <http://localhost:8000/> ou <http://localhost:8000/md_job/>
    
Back-office: <http://localhost:8000/admin> avec:

    identifiant: admin
            mdp: admin
