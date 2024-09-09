# myClinic 👋

myClinic est une platform de gestion de clinique...

💡 **NOTE**: le project est actuellement en cours de devéllopment donc
cette documentation pourez changé a tout moment

## Prerequis de l'environement 📦

-   PHP `version: >= 8.1.2`
-   Composer `version: >= 2.5.4`
-   Nodejs `version: >= 18.16.0`

## Mis à place de l'environement de development 🔧

Pour mettre en place l'environement de development clonez dabord le repositorie `(dépot)`:

-   En utilisant HTTP

    ```bash
        git clone https://github.com/MedAb94/myClinic.git
    ```

-   En utilisant SSH
    ```bash
        git clone git@github.com:MedAb94/myClinic.git
    ```

Une fois le depot clonez, Installez les dépendences

```bash
    cd myClinic
    composer install
    npm install
```

Une fois les dépendences installées, configurez vos variable d'environement dans un fichier `.env`
que vous coppieré d'un autre fichié d'exemple `.env.example`

```bash
    cp .env.example .env
    php artisan key:generate
```

Et voila, tout est pret mais avant de demarrer le project localement la platform vous fournie un script
Qui remplira votre base de données avec des données fictive tout ce que vous avez a faire est d'execute la commande suivante:

💡 **NOTE**: avant d'executé la commade suivante assurez vous de cree la base de donnée et de la configuré dans votre fichier .env

```bash
    composer run setup
```

Et maintenet que tout est pret demarrez le project localement en executent la commande suivante:

```bash
    php artisan serve
```
## Components 
 ```Icons 
  example : 
    <x-icons.icon name="list"/>
    * icon name is already prefixed with "fas fa-${name}" so you just need to pass the name of the icon
    
    - action icon 
     compon
    <x-icons.action-icon action="delete"/>
       * contains list of action icons [add ,edit,save,delete,download,upload,print,check,uncheck,pdf,show]
 
