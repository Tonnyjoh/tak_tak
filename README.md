# Taktak

## CodeIgniter 4 Framework

### Informations de Connexion
- **Superuser**:
    - Email: `root@admin.com`
    - Mot de passe: `123456789`

- **Utilisateur 1**:
    - Email: `rabe@test.com`
    - Mot de passe: `123456789`

- **Utilisateur 2**:
    - Email: `rak@example.com`
    - Mot de passe: `password`

- **Utilisateur 3**:
    - Email: `soa@example.com`
    - Mot de passe: `pass`

### Configuration de la Base de Données
1. Importez le fichier SQL situé dans le dossier `public` pour créer la base de données et les tables nécessaires.
2. Mettez à jour le fichier `.env` dans le répertoire racine :
   ```plaintext
   database.default.database = takalo_takalo // Votre base de données 
   database.default.username = root // Nom d'utilisateur
   database.default.password = '' // Votre mot de passe MySQL ici
3. Mettre à jour le fichier `public/fetch.php`
  ```plaintext
    $dbname = 'takalo_takalo';  // Base de données à utiliser
    $username = 'root';         // Nom d'utilisateur
    $password = '';             // Votre mot de passe
