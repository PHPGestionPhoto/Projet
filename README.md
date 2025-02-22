# Projet

---

## 🛠️ Prérequis

Avant de commencer, assurez-vous d'avoir installé les outils suivants sur votre machine :

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)

---

## ⚙️ Installation

Lancer le projet est un jeu d'enfant. Suivez ces étapes :

1. **Configurer les variables d'environnement**  
   Copiez le fichier `.env.example` et renommez-le en `.env` :
   ```bash
   cp .env.example .env
    ```
   Remplissez les informations nécessaires dans le fichier .env (vous pouvez utiliser des valeurs fictives si nécessaire).
2. **Construire et démarrer les conteneurs Docker**
   Exécutez la commande suivante pour lancer l'application :
    ```bash
    docker-compose up -d --build
    ```
3. **Accéder à l'application**
    Ouvrez votre navigateur et accédez à l'URL suivante : [http://localhost:80](http://localhost:80)


---

## 🐞 Dépannage

Si vous rencontrez des problèmes lors de l'exécution du projet, assurez-vous que :

- Docker et Docker Compose sont bien installés et fonctionnels.
- Le fichier `.env` est correctement configuré.
- Aucun autre service n'utilise le port 80 sur votre machine.
