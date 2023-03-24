Ouvrir une ligne de commande dans windows

Rajouter dans front : php8.1-intl
Se placer à la racine du dossier contenant ce fichier

docker compose build

docker compose up -d

Dans l'application docker une stack est apparue

- composer require symfony/orm-pack
- composer require make
- 

Ouvrir la ligne de commande du container symfony_bts

git config --global user.email "jeannicolas34980@gmail.com"
git config --global user.name "julien"

cd /home/symfo
	symfony new ./ --version=6.0 --php=8.1 --webapp

nano /home/symfo/.env
	Commenter la ligne non commentée commençant par DATABASE_URL (attention au multiligne)
	DATABASE_URL="mysql://root:password@mysql-symfony:3306/symfony?serverVersion=8&charset=utf8mb4"

symfony server:start --port=80 -d 

symfony server:stop
Avoir une base

Créer un controler 

symfony console make:controller

Créer une Entité 

symfony console make:entity

Faire une migration 

symfony console make:migration
symfony console doctrine:migrations:migrate
Easy admin

Installer 

composer require easycorp/easyadmin-bundle

Avoir un dashboard

symfony console make:admin:dashboard
Avoir un Crud

symfony console make:admin:crud 

hasher mdp : symfony console security:hash-password 

mdp admin  patrick@gmail.com   et password