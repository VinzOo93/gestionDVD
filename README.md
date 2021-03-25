# gestionDVD
# Installation

Se rendre dans le dossier à l'intérieur du repertoire de votre server local :

cd /wamp64/www
lancer la commande :
git clone https://github.com/VinzOo93/.git 

pour installé les dépendances de symfony se rendre dans : 
cd gestionDVD
composer install

Pour créer la base de donnée, vous devez d'abord configurer correctement le fichier .env, puis exécuter :
et modifier cette variable avec le user, mot de passe et non de base de donnée MySQL
# .env
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"

+ info
voir doc lien ci dessous
https://symfony.com/doc/4.4/configuration.html

Pour créer la base de donnée, vous devez d'abord configurer correctement le fichier .env ou .env.local, puis exécuter :

php bin/console doctrine:database:create 

et ensuite :
php bin/console doctrine:schema:update --force

# Import de la base donnée

Se rendre dans votre interface de base donnée (compatible mySQL) et effectuer l'import de ce ficher :

dvdmanager-db.sql (se trouvant dans ce même répertoire)

# Utilisation
lien acceder à l'index : 

http://localhost/gestionDVD/public/

Vous pouvez acceder aux détails de chaque film en cliquant sur le nom dans la card.  

Pour gerer les crud dans la base donnée, se rendre dans un navigateur et cliquer dans gestion crud (navbar) ou voir lien ci-dessous:
http://localhost/gestionDVD/public/serie/serie/manager

(assurez-vous de bien avoir des films dans la bdd) et d'avoir lancé votre serveur

Bonne visite 
