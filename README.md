# Taktak

Application d'échange développée avec CodeIgniter 4 Framework

## Captures d'écran
### Interface principale
<img src="/public/takone.png" alt="Capture d'écran 1" width="300"/>

### Tableau de bord
<img src="/public/taktwo.png" alt="Capture d'écran 2" width="300"/>

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

## Contributeurs
- RAJAOHARIVONY Haritody Tonny Raldo (ESIIA3A- №01)
- RAMESON ANDRIANARINOSY Imanoela Fiderana Ny Avo (ESIIA3A - №03)
- ANDRIAMANARINTSOA Hugues Steeven (ESIIA3A - №25)
- RALIJEMISON STEPHAN Ambinitsoa (ESIIA3A - №26)
- RAHARISON Santatriniaina Tiantsoa (ESIIA3A - №28)
- RAKOTOMANANA HARILALA Najaina Rotsiniaina (ESIIA3A - №40)
- TANG FAKANAH Randy (ESIIA3A - №41)
- RANDRIAMAEFAMANANA Rojotiana (ESIIA3A - №46)
- RANAIVOSON Mamisedra Hariniaina (ESIIA3B - №11)
- RAKANDRAINA Tojotiana (ESIIA3B - №13)
