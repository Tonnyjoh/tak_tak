# Taktak

Application d'échange développée avec CodeIgniter 4 Framework

## Prérequis
- Une connexion Internet est requise
- PHP version 7.4 ou supérieure
- MySQL

## Configuration

### Base de Données
1. Importez le fichier SQL situé dans le dossier `public`
2. Configurez le fichier `.env` dans le répertoire racine :
   ```plaintext
   database.default.database = takalo_takalo
   database.default.username = root
   database.default.password = ''
   ```

3. Mettez à jour le fichier `public/fetch.php` :
   ```plaintext
   $dbname = 'takalo_takalo';
   $username = 'root';
   $password = '';
   ```

## Comptes de Test

### Superadministrateur
- Email: `root@admin.com`
- Mot de passe: `superuser`

### Utilisateurs de Test
1. **Utilisateur 1**
   - Email: `rabe@test.com`
   - Mot de passe: `123456789`

2. **Utilisateur 2**
   - Email: `rak@example.com`
   - Mot de passe: `password`

3. **Utilisateur 3**
   - Email: `ampela@gmail.com`
   - Mot de passe: `123456789`

