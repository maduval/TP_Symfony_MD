TP_Symfony_MD
=============

A Symfony project created on May 19, 2016, 3:44 pm.

1. Cloner ce repository:
    

Plus d'informations: https://help.github.com/articles/cloning-a-repository/

2. Dans le terminal se positionner dans le dossier du projet:
    

Commande: cd TP_Symfony_MD/

3. Via le terminal, installer des dependances:
    Commande: php composer.phar update

4. Via le terminal, créer la base de données et charger des données de test:
    Commande 1: php app/console doctrine:database:create
      En cas d'erreur, vérifier les paramètres de connexion à la base de données dans le fichier: app\config\parameters.yml
    Commande 2: php app/console doctrine:schema:create
    Commande 3: php app/console doctrine:fixtures:load

5. Via le terminal, créer un utilisateur de test:
    Commande: php app/console md:jobeet:users admin admin

6. Via le terminal, lancer le serveur:
    Commande: php app/console server:run

7. Via le navigateur, visiter le site et son back-office:
    Site: http://localhost:8000/ ou http://localhost:8000/md_job/
    Back-office: http://localhost:8000/admin avec:
      identifiant: admin
      mdp: admin
