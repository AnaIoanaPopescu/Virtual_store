RAPPORT DU MAGASIN VIRTUEL
BASES DE DONNÉES

Nom d’étudiante : Ana-Ioana POPESCU
UNSTPB – Faculté d’Ingénierie en Langues Étrangères
Spécialisation : Ordinateurs et Technologie de l’Information, Ingénierie de
l'Information
Groupe: 1220FA, sg. I
Nom du professeur coordinateur : Florin RĂDULESCU

INTRODUCTION
En tant que grande amatrice de chocolat – une passion qui m'accompagne depuis l'enfance –
j'ai toujours rêvé de partager cette douceur magique avec d'autres.Le chocolat, bien plus qu'une simple gourmandise, est une véritable expérience sensorielle,
capable de raviver les souvenirs, de réchauffer les cœurs et de transformer les journées ordinaires en
moments extraordinaires.
Dans ce rapport, je vais vous présenter comment ce magasin virtuel a été conçu pour
capturer l'essence même du chocolat, en combinant technologie, créativité et amour pour cet
ingrédient universellement apprécié.
Alors, ChocoLatino, c’est bien plus qu’un simple magasin virtuel, c’est un véritable univers
dédié aux amateurs de chocolat sous toutes ses formes. Nous avons imaginé un espace où chaque
gourmand, qu’il soit vegan ou non-vegan, peut trouver son bonheur. Avec une attention particulière
portée à la qualité et à la diversité, ChocoLatino propose une gamme étendue de produits : des
tablettes artisanales au chocolat noir intense, des truffes fondantes, des assortiments gourmands
pour les amateurs de douceurs classiques, et une collection innovante pour les adeptes du chocolat
vegan.

LES LANGUAGES UTILISÉS
Pour la gestion de la base de données, le projet a été développé à l'aide du logiciel XAMPP,
qui offre un environnement local combinant Apache et MySQL. Grâce à ces outils, j'ai pu créer et
administrer la base de données en tant qu'administrateur. L'interface phpMyAdmin a été utilisée
pour établir la liaison entre le magasin virtuel et la base de données.
J'ai conçu une base de données nommée shoppingcart, composée de deux tables
principales :
1. Products : Cette table contient neuf colonnes pour représenter les différentes propriétés des
produits disponibles dans le magasin. Ces colonnes incluent :
o id : L'identifiant unique pour chaque produit.
o title : Le nom du produit.
o description : Une description détaillée du produit.
o price : Le prix du produit.
o rrp : Le prix recommandé (prix de référence).
o quantity : La quantité disponible en stock.
o img : Le chemin vers l'image associée au produit.
o date_added : La date d'ajout du produit dans la base.
o is_vegan : Une indication si le produit est adapté aux régimes véganes.
2. Buyers : Cette table est liée à la partie commande du magasin. Elle stocke les informations
des clients après qu'ils aient passé une commande. Les colonnes de cette table incluent :
o id2 : L'identifiant unique du client.
o name : Le nom complet du client.
o phone_number : Le numéro de téléphone du client.
o email : L'adresse e-mail pour la communication.
o order_date : La date à laquelle la commande a été passée.
Du côté des langages de programmation, j'ai mobilisé une combinaison de PHP, HTML,
CSS et JavaScript.
PHP a été utilisé pour le traitement côté serveur et l'interaction avec la base de données,
tandis que HTML et CSS ont permis de concevoir une interface utilisateur attrayante et
fonctionnelle.
JavaScript a ajouté une dimension dynamique et interactive, améliorant l'expérience
utilisateur dans la navigation et l'achat en ligne. J'ai également intégré deux animations
attrayantes dans le magasin virtuel pour aider les utilisateurs à mieux s'intégrer dans le monde du
chocolat. Ces animations immersives rendent l'expérience plus engageante et contribuent à plonger
les utilisateurs dans un univers chaleureux et captivant, renforçant ainsi leur connexion au thème
principal du magasin.
En utilisant cette architecture, le système est capable de gérer efficacement les produits
disponibles et de suivre les commandes des clients, tout en offrant une interface utilisateur
conviviale. Ce mélange harmonieux de technologies a permis de donner vie à un magasin virtuel
fonctionnel et performant.

Le fichier index.php sert de point d'entrée principal du site web et joue le rôle de contrôleur
en incluant dynamiquement le contenu en fonction des demandes de l'utilisateur. Il commence par
démarrer une session PHP et se connecte à la base de données via une fonction personnalisée
incluse dans le fichier functions.php. La page à afficher est déterminée par un paramètre GET
(?page=) dans l'URL. Si la page demandée existe sous forme de fichier .php, elle est incluse
dynamiquement. Dans le cas contraire, la page par défaut, home.php, est chargée.
Le fichier home.php représente la page d'accueil du site, où les utilisateurs sont accueillis
par une interface interactive et visuellement attrayante, inspirée du thème du chocolat. Cette page
récupère les quatre produits les plus récemment ajoutés dans la base de données à l'aide d'une
requête SQL préparée. Ces produits, avec leurs informations (titre, image, prix et prix recommandé
s'il y en a un), sont affichés sous forme d'une grille dynamique d'éléments cliquables.
En plus des informations sur les produits, home.php intègre des éléments graphiques
animés : une scène thématique avec des SVG représentant une machine à café et des tasses. Ces
animations immersives, combinées à la présentation des produits récents, plongent les utilisateurs
dans un univers gourmand et chocolaté, rendant leur expérience de navigation captivante.
La connexion entre index.php et home.php est fluide. Lorsque le site est consulté sans
qu'une page spécifique ne soit mentionnée, index.php inclut automatiquement home.php. Cette
structure modulaire garantit une organisation claire du code et facilite l'extension future du site. De
nouvelles pages, comme une page de détails produits ou un formulaire de contact, peuvent être
ajoutées sous forme de fichiers .php supplémentaires et accessibles via le paramètre page dans
l'URL.
Ensemble, ces deux fichiers constituent la base d'une expérience d'achat dynamique et
interactive, combinant une fonctionnalité backend (comme l'interaction avec la base de données et
le chargement dynamique des pages) et un design créatif qui donne vie au monde du chocolat.

Le fichier functions.php joue un rôle central dans le fonctionnement de l'application
en fournissant des fonctionnalités essentielles pour gérer la connexion à la base de données,
ainsi que les templates pour l'en-tête et le pied de page du site.
Fonctionnalités principales :
1. Connexion à la base de données :
o La fonction pdo_connect_mysql() établit une connexion sécurisée avec la base de
données MySQL en utilisant PDO (PHP Data Objects). Les paramètres (hôte,
utilisateur, mot de passe, nom de la base de données) sont configurés pour s'adapter à
l'environnement local.
o En cas d'échec de connexion, un message d'erreur est affiché et le script est arrêté
grâce à la gestion d'exceptions.
o Cette fonction garantit une interaction fluide et sécurisée entre l'application et la base
de données shoppingcart.
2. Template pour l'en-tête (Header) :
o La fonction template_header($title) génère dynamiquement l'en-tête HTML pour
chaque page.
o Elle inclut :
▪ Les liens vers les fichiers CSS (style.css, animation.css, style2.css) pour le
style visuel et un lien vers la bibliothèque FontAwesome pour les icônes.
▪ Une barre de navigation contenant des liens vers les différentes pages du site,
comme Accueil, Produits, Vegan, et une page dédiée aux animations
chocolatées.
▪ Une zone d'icône de panier qui affiche dynamiquement le nombre d'articles
ajoutés, récupéré depuis la variable de session $_SESSION['cart'].
▪ Un design soigné avec des bordures personnalisées et des couleurs
cohérentes pour maintenir une esthétique élégante, notamment avec des
bordures et styles inspirés du thème du chocolat.
3. Template pour le pied de page (Footer) :
o La fonction template_footer() génère le pied de page, qui est uniformément appliqué
à toutes les pages du site.
o Elle inclut :
▪ Une mention des droits d'auteur, avec l'année dynamique récupérée grâce à la
fonction date('Y').
▪ Une phrase chaleureuse pour renforcer l'ambiance conviviale et passionnée
du site, adressée aux amateurs de chocolat.

Le fichier products.php est une page dynamique dédiée à l'affichage des produits
non-véganes du site. Il propose plusieurs fonctionnalités pour une expérience utilisateur
optimisée.

Le fichier product.php est une page dynamique dédiée à l'affichage des détails d'un
produit spécifique. Elle joue un rôle essentiel dans le site en offrant aux utilisateurs une vue
détaillée sur un produit avant de l'ajouter à leur panier.

La page cart.php gère le panier d'achat du site et offre aux utilisateurs une interface
pour visualiser, modifier et valider leurs articles avant de passer commande.

Fonctionnalités principales :
1. Ajout d'un produit au panier :
o Lorsqu'un utilisateur ajoute un produit au panier depuis la page produit, les données
sont transmises via un formulaire POST.
o Une requête sécurisée vérifie l'existence du produit et la disponibilité du stock.
o Si le stock est suffisant, le produit est ajouté ou mis à jour dans la session
$_SESSION['cart'].
o La quantité du produit dans la base de données est ajustée en temps réel.
2. Gestion des produits dans le panier :
o Les utilisateurs peuvent :
▪ Retirer un produit : Le produit est supprimé du panier en cliquant sur le lien
"Retirer".
▪ Modifier la quantité : Les utilisateurs peuvent ajuster la quantité d'un
produit directement depuis le panier. La mise à jour vérifie la disponibilité en
stock avant de valider les modifications.
o Le panier est mis à jour dynamiquement, et les changements sont enregistrés dans la
session.
3. Résumé du panier :
o Les produits ajoutés sont affichés sous forme de tableau avec les colonnes suivantes :
▪ Image : Une vignette pour identifier rapidement le produit.
▪ Nom : Un lien vers la page détaillée du produit.
▪ Prix unitaire : Le prix de l'article.
▪ Quantité : Une entrée modifiable pour ajuster le nombre d'articles.
▪ Total : Le prix total pour la quantité spécifiée.
o Un message s'affiche si le panier est vide.
4. Validation et commande :
o Un bouton "Passer la commande" redirige les utilisateurs vers la page de validation
finale (placeorder), à condition que le panier ne soit pas vide.
5. Sous-total dynamique :
o Le sous-total est calculé en fonction des articles et quantités dans le panier. Ce
montant est affiché pour informer l'utilisateur du coût total avant taxes et frais
supplémentaires.

La page Place Order est la dernière étape du processus d'achat, où les utilisateurs
finalisent leur commande en soumettant leurs informations personnelles. Elle sert également
de point de confirmation pour signaler que la commande a été passée avec succès.

La page vegan.php est dédiée à l'affichage des produits véganes disponibles sur le site. Elle
offre une interface dynamique et conviviale permettant aux utilisateurs de parcourir, trier et
naviguer facilement à travers une sélection spécifique de produits adaptés aux régimes véganes.

Le fichier script.js ajoute une dimension interactive et dynamique à l'interface
utilisateur en permettant aux utilisateurs de modifier l'apparence d'une tasse et d'afficher le
titre correspondant en fonction de leurs sélections.

La page chocolate_animation.php est une section immersive et interactive du site,
conçue pour célébrer l'association du chocolat et du café à travers des animations
dynamiques et un design captivant.

1. Texte scintillant :
o Un élément de texte animé affiche : "Le café qui va bien avec le chocolat !".
o Le texte utilise une palette de couleurs et des ombrages dynamiques pour créer un
effet scintillant, attirant immédiatement l'attention de l'utilisateur.
o Une animation définie par @keyframes sparkle ajoute un effet lumineux qui renforce
l'esthétique festive et engageante.
2. Options de café interactives :
o Une liste de différents types de café est présentée sous forme de blocs cliquables
(ex. : Black, Latte, Cappuccino, etc.).
o Lorsqu'une option est sélectionnée, elle déclenche une interaction via le script
associé (voir script.js) :
▪ La tasse virtuelle change d'apparence pour correspondre à la boisson choisie.
▪ Le titre de la boisson est mis à jour dynamiquement.
3. Tasse virtuelle animée :
o Une tasse virtuelle est affichée au centre de la page, avec des classes CSS
dynamiques qui modifient son contenu en fonction de la sélection de l'utilisateur.
o Les éléments de la tasse (comme espresso, chocolat, lait, crème, etc.) sont affichés
de manière interactive pour représenter visuellement la composition de la boisson.
4. Effets graphiques supplémentaires :
o Des ombres et des couches visuelles sont appliquées à la tasse pour ajouter de la
profondeur et du réalisme à l'animation.
o Les transitions fluides entre les options de café renforcent l'expérience utilisateur.
5. JavaScript pour l'interactivité :
o Le fichier externe script.js est intégré pour gérer les interactions utilisateur, comme
l'ajout ou la suppression de classes CSS en fonction des options sélectionnées.
Fichiers CSS utilisés :
1. style.css :
o Ce fichier est utilisé pour le design global du site.
o Il définit les styles communs, tels que la mise en page principale, la typographie, les
couleurs de base, et les éléments comme les boutons ou les en-têtes.
o Grâce à ce fichier, le site conserve une apparence cohérente sur toutes les pages.
2. animation.css :
o Ce fichier est spécifiquement consacré aux animations de la tasse interactive.
o Il gère les transitions et les transformations dynamiques, comme les modifications de
la tasse (contenu, apparence) lorsque l'utilisateur sélectionne une option de café.
o Les animations créent une expérience fluide et engageante pour l'utilisateur,
renforçant l'interactivité de la page.
27
3. style2.css :
o Ce fichier est dédié à la machine à café animée et ses éléments associés.
o Il inclut des styles détaillés pour les composants SVG de la machine (ex. : corps,
tasses, éléments mobiles).
o Les animations et les ombres appliquées à la machine apportent du réalisme et de la
profondeur, offrant une immersion visuelle captivante.
