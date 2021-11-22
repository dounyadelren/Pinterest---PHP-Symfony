# Pinterest---PHP-Symfony
Recréer Pinterest avec le framework php Symfony et MYSQL

<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/60/Symfony2.svg/1280px-Symfony2.svg.png" />

<h1>Installation</h1>

<h2>prérequis </h2>
~ avoir Symfony installé et mis à jour sur votre ordinateur ~<br>
SINON -> aller voir la documentation sur l'installation de Symfony <a href="https://symfony.com/doc/current/setup.html">ici</a><br>

<h2>commandes</h2>

Pour ce projet j'ai choisi de ne pas installer une application complète mais d'installer les bundles dont j'ai besoin au fur et à mesure (cf composer.json).<br>
Pour regarder mon projet il suffit donc de cloner ce dépot sur le terminal, aller dans le dossier "pinterest_clone" puis d'entrer la commmande <code>composer install</code> afin de récuperer tout les outils nécessaires.<br>
Veuillez noter que ce projet ne contient aucun fichier d'environnement ( <code>.env</code> ) il faudra donc que vous utilisiez le vôtre pour avoir une connexion à une base de données ainsi qu'un identifiant <code>MAILER DSN</code> valide (j'ai utilisé Mail Trap, marche très bien).<br>

<h1>L'application</h1>
<ul>Fonctionnalités basiques: <br>
    <ul><i> CRUD complet:</i>
          <li>  affichage de tout les post (les plus récents) avec chacun leur page détaillée</li>
          <li>  publications d'images avec titre et description</li>
          <li>  edition du post (pin) </li>
          <li>  suppresion du post en local et dans la BDD (pin) </li>
     </ul>
     <li> l'image publiée est rognée en respectant l'échelle</li>
     <li> interface utilisateur : inscription/connexion, sécurités basiques (ne pas pouvoir modifier ou supprimer le post des autres), déconnexion</li>
</ul>

<h2>La publication d'image</h2>
A été gerée par le bundle Vich <a href="https://github.com/dustin10/VichUploaderBundle">(doc ici)</a>, il me permet de télécharger, renommer ou supprimer une image sélectionnée sur l'ordinateur. Au moment de l'upload l'image s'enregistre également dans le dossier public de l'app ce qui permet à tout les utilisateurs d'y avoir accès.<br>
J'ai également utlisé Liip Bundle <a href="https://github.com/liip/LiipImagineBundle">(et la)</a> pour réaliser des filtres twig "customisés" .i.e rogner et redimensionner l'image si trop grande/trop petite. Il y a une légère perte de qualité par rapport à la photo originale mais la qualité revient si l'utilisateur décide de la télécharger en local.<br>

<h2>Le CSS</h2>
Cette mini réplique de Pinterest a presque entièrement été réalisée avec la librairie Bootstrap Minty 

<h2>A venir</h2>
- une page pour modifier le profil + ajout d'une photo de profil <br>
- le rôle administrateur ainsi que son interface <br>
- Responsivité <br>




