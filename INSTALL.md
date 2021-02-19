# Multisite WordPress install

## Installation sur un serveur Web standard.

Suivez les instructions suivantes: https://fr.wordpress.org/support/article/create-a-network/

## Installation dans un environnement Docker.

Nécessite d'avoir sur le serveur des versions à jour de `docker` & `docker-compose`.

### Initialisation de la stack MySQL/WordPress

#### Prérequis pour 

#### 1. Configurer la stack

copiez le fichier .env et éditez le

```bash
cp .env.sample .env
editor .env
```

#### 2. Créez un réseau externe pour une utilisation avec un proxy dockerisé (nginx, traefik, apache)

Ici, nous allons créer le réseau nommé `front`

```bash
docker network create front
```

#### 3. Initialisez la stack

L'option `WP_ALLOW_MULTISITE` définie dans le `docker-compose.yaml` permet la configuration d'un réseau nécessaire au déploiement de WordPress en mode multisite.

```bash
docker-compose up -d
```

Il faut maintenant se rendre sur l'url du WordPress pour finaliser l'installation.

## Configurez le mode multisite

Connectez vous à WordPress, et créez un réseau, menu `Outils > Création du réseau`.

Configurez alors votre réseau. Dans cet exemple, nous choisirons l'option `sous-répertoires`.

Suivez ensuite les instructions données pour mettre à jour les fichiers `wp-config.php` et `.htaccess` dans le dossier `/var/www/html` du conteneur WordPress. Pour le fichier `.htaccess`, remplacer le contenu du bloc `<IfModule mod_rewrite.c>...</IfModule>` par celui fournit.

## Activez les fonctionnalités du thème WordPress dédié aux portails d'ABT.

### Installez et activez le thème sur WordPress

#### Installer le thème

Sur une installation standard, copiez le dossier `wp_obsbiodiv_theme` dans le dossier wordpress `wp-content/themes/`. 

Dans un environnement Docker, copiez le fichier `docker-compose.override.yaml.sample` en `docker-compose.override.yaml` et relancer la stack.

```bash
cp docker-compose.override.yaml.sample docker-compose.override.yaml 
docker-compose up -d
```
#### Activer le thème pour les sites

Par défaut, seule le thème principal est disponible pour les sites, il faut donc spécifier à WordPress de rendre ce thème également disponible.

Dans l'interface d'administration, rendez vous sur `Mes sites` dans la barre du haut puis `Admin du réseaux > Themes`. Sur cette page, activez le thème `WP OBSBIODIV` et désactivez les thèmes inutilisés.

Activez le thème sur au moins un site pour disposer de la configuration générale de l'instance. Pour se faire, alles sur `Mes sites > Nom du site > Tableau de bord` puis dans le menu (barre de gauche), sur  personnaliser `Personnaliser (pinceau) > Themes` et activez le theme `WP OBSBIODIV`.

Les options de paramétrages sont maintenant disponibles sur l'interface d'administration générale de l'instance WordPress. Rendez vous donc sur `Mes sites > Admin du réseau` puis dans le menu (barre de gauche toujours) sur `Réglages > GeoCitizen API`. Là renseignez les URL d'API qui listent :
* **les projets** (niveau cadre d'acquisition, un projet pour un site WordPress). ex. `https://mondomain.orgh/api/projects/`
* **les programmes** (niveau jeux de données, plusieurs programmes possibles pour un site WordPress). ex. `https://mondomain.orgh/api/programs`

## Créer et configurer un site associé à un projet


## Création 

Dans GeoNature-citizen, créez un projet et les programmes associés.

Dans WordPress, créez un site pour ce projet en allant sur  `Mes sites > Admin du réseau > Sites`.

## Configuration

Une fois le site créé, rendez-vous sur son tableau de bord `Mes sites > Admin du réseau > Sites`, puis sur la ligne du site qui nous intéresse, sur cliquez sur `Tableau de bord`. Rendez vous ensuite dans `Apparence > Thèmes` et activez, si ce n'est déjà fait, le thème `WP OBSBIODIV`. Une fois activé, cliquez sur le lien `Personnaliser`





