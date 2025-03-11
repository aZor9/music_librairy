# Music Library

Music Library est une application web développée avec Symfony permettant de gérer une bibliothèque musicale personnelle. Les utilisateurs peuvent s'inscrire, se connecter et ajouter des artistes, des albums et des musiques.

## 📌 Fonctionnalités

- Inscription et connexion des utilisateurs
- Ajout, modification et suppression d'artistes
- Ajout, modification et suppression d'albums
- Ajout, modification et suppression de musiques
- Interface utilisateur intuitive

## 🛠️ Technologies utilisées

- Symfony
- Doctrine (ORM pour la base de données)
- Twig (moteur de templates)
- Bootstrap (pour le design)
- MySQL ou PostgreSQL (base de données)

## 🚀 Lancement

   ```bash
   symfony server:start
   ```
   L'application est accessible à l'adresse `http://127.0.0.1:8000`

## 📂 Structure du projet

```
.
├── src/             # Code source Symfony
├── templates/       # Fichiers Twig (vues)
├── migrations/      # Migrations de base de données
├── public/          # Fichiers publics (CSS, JS, images)
├── config/          # Configuration du projet
├── var/             # Fichiers temporaires et logs
└── assets/          # Ressources front-end (si applicable)
```

## 🏗️ Améliorations futures

- Ajout d'un lecteur audio intégré
- Création de playlists personnalisées
- Partage de musiques entre utilisateurs
- API pour intégration avec d'autres services

## 📜 Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus d'informations.

---

💡 **Contributions et suggestions sont les bienvenues !** N'hésitez pas à proposer des améliorations via des issues ou des pull requests. 🎵
