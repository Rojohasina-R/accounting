Ceci est une application minimaliste permettant de suivre les flux financiers d'une petite entreprise en utilisant les notions de base de comptabilité

## Fonctionnalités

- Paramétrage du plan comptable
- Paramétrage des journaux
- Saisie comptable des opérations courantes
- Consultation du bilan (*)
- Consultation du compte de résultat (*)
- Consultation des grands livres des comptes banque, caisse, et des sous-comptes de gestion (*)

(*) Les interfaces ont été conçues de manière à être intuitives, compréhensibles par tous, et ne donner que les informations utiles

## Fonctionnalités à ajouter

- Gestion des clients
- Gestion des fournisseurs
- Gestion des échéances

## Installation

- git clone
- cd accounting
- composer install
- configurer la base de données
- php artisan migrate --seed
- php artisan serve
