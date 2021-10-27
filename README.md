
# Projet Symfony avancé - 25-29 octobre 2021 

1. Créer un projet

2. Créer un controller + template twig => php bin/console make:controller

3. Créer un BDD + tables => php bin/console doctrine:database:create // php bin/console make:entity -> php bin/console make:migration -> php bin/console
doctrine:migrations:migrate

4. Créer une fixture | installer le composant, créer la fixture, charger la fixture
  4.1 composer require orm-fixtures --dev
  4.2 php bin/console make:fixtures
  4.3 php bin/console doctrine:fixtures:load 
  
5. Utilisation de services Symfony natifs
  5.1 listing : php bin/console debug:autowiring

6. Debugg
7. Doctrine
