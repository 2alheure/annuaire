# Exo superglobales

Vous allez créer un prototype de site web utilisant les superglobales.

## Liste des pages
- Une page d'accueil
- Une page de connexion
- Une page de déconnexion
- Une page de modification de profil

### La page d'accueil
Affiche le menu du site et un contenu statique.

### Le menu du site
Le menu du site est affiché sur **toutes** les pages (visibles) du site (c'est une navbar).  
Il contient tous les liens des pages du site. Il affiche également le pseudo et l'image de profil de l'utilisateur.

### La page de connexion
Affiche un formulaire de connexion. Si l'identifiant et le mot de passe saisis sont corrects, crée une session.  
N.B. : Identifiants et mot de passe stockés en dur dans une variable. Idem pour image de profil et pseudo.  
On redirige ensuite vers la page d'accueil.

### La page de déconnexion
On détruit la session.  
On redirige ensuite vers la page d'accueil / de connexion.

### La page de modification de profil
Affiche un formulaire proposant de saisir un pseudo et de fournir une image de profil.  
A la soumission du formulaire, vous procédez à l'upload du fichier, et les informations de la session doivent suivre en conséquence.

### Bonus : remember me 
Proposer à l'utilisateur de se souvenir de lui même s'il ferme son navigateur.  
Si l'utilisateur coche la case, un cookie est créé. Il dure un mois et stocke une information qui permet de reconnaître l'utilisateur.  
Si quelqu'un arrive sur le site sans être connecté mais avec un cookie, vous le connectez d'office.