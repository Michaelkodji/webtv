# web_tv
Développement d'une apllication de webtv et de vidéo à la demande 
Cette applicaition est subdivisé en deuc étéapes 
-la diffusion 
-et la publication des vidéos à la demande 

Au cours de notre travail nous avons rencontré des difficultés notamment lors du déploiement du serveur de streaming. En effet les technologies open source existantes sont soit fermées ou obsolètes , aussi les documents trouvés étaient insuffisants et ne répondaient plus aux contraintes actuelles. 

Nous nous sommes donc beaucoup plus concernés sur le déploiement du serveur en premier et le développement de la plate-forme en dernier. Cela explique le fait qu’elle présente quelques erreurs de gestion de session, de profils et de sécurité.

Un serveur de diffusion requiert des caractéristiques importantes  en termes de vitesse de processeur, de mémoire vive et d’espace de stockage pour une performance maximale.

Étant donné que nous ne disposons pas du matériel nécessaire pour monter ce genre de serveur nous avons donc virtualisé le nôtre à l’aide de l’hyperviseur virtualbox.

Nous avons utilisé comme OS la dernière version de la distribution Ubuntu serveur (22.04) afin de réduire l’utilisation de carte graphique par le serveur même et une efficacité assez satisfaisante.

Nous avons installé les principaux éléments pour en faire un serveur web que sont :
-Un interpréteur PHP
-Un serveur FTP pour le transfert des fichiers
-Un serveur de data base mysql 
-Phpmyadmin pour mieux gérer notre  data base mysql 

Nous avons fixé une adresse ip à la machine virtuelle (192.168.100.40) ainsi qu’à la machine hôte(192.168.100.7). 

Notre réseau se présente comme suit 
[Net id:192.168.100.0/24; 
Gateway : 192.168.100.1 ; 
DNS :8.8.8.8]


Pour déployer le serveur streaming nous avons installé Nginx et ses modules RTMP. Nginx est connu pour sa flexibilité en matière de diffusion de flux sur ip .

Les principales configurations ont été faites dans les fichiers 

/etc/Nginx/Nginx.conf
/etc/Nginx/sites-enable/default 

(nous avons configurer ici le protocole RTMP avec l’adresse ip du serveur que nous avons fixé plus haut ainsi que l’adresse ip de la machine effectuant la diffusion sur OBS qui est ici la machine hôte)

Nous avons ensuite activé les port 1935 et 8080 au niveau du pare-feu pour laisser passer les utilisateurs essayant d’accéder aux ressources du serveur avec ce port .

Les diffusions ont été faites depuis obs installé sur la machine hôte et tournant sous Windows 10
Dans les paramètres de diffusion nous avons sélectionné type personnalisé et entrer le lien de notre serveur
Serveur:rtmp://192.168.100.40/live 
clé stream :obs_stream 


Pour lire les live dans le navigateur nous avons eu besoin d’utiliser un player comme VLC mais en web qui autorise les protocoles HLS(HTTP live streaming )et DASH(Dynamic Adaptive Streaming over HTTP).

Nous avons donc utilisé la librairie video-js qui est une bibliothèque JavaScript.
Les fichiers ont été inclus dans notre code html avec la balise <video> </video> qui fait appel à la fonction de la librairie.


Nous avons ensuite intégré le code à notre plate-forme dans le fichier live.php que seuls les étudiants connectés peuvent voir /suivre.

En effet le scénario est tels que 
-Un administrateur de IFRI en enregistre les étudiant dans la base avec un fichier csv ( supposant que les étudiants ont tous un matricule) et programme les lives

-L’étudiant s’identifie sur la plate-forme grâce à sont matricule ,s’inscrit en entrant adresse e-mail et confirmant son mot de passe , se connecte et voit les lives bientôt disponibles.

-Une fois le moment du live venu , l’étudiant se connecte sur la plate-forme et suit le live qui est diffusé depuis les locaux de IFRI à partir de n’importe quel terminal .

-l’admin enregistre  le live et le téléverser sur la plate-forme pour que les étudiants qui n’ont pas pu le suivre y accèdent dans la rubriques replay

