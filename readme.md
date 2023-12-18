# SAE 303 : Concevoir des visualisations de données

## Mon projet :

Bonjour, bienvenue dans ce fichier readme. Je vais préciser toutes les informations nécessaires à la compréhension de mon projet, ainsi que les consignes pour le cloner et le lancer.

- On note d'abord la présence du `package.json`, il sert uniquement lors du développement pour lancer le watcher de `tailwindcss` et `postcss`. Il n'est pas nécessaire de l'utiliser pour lancer ou déploier le projet.
- Le projet sera déployé sur le serveur de l'université, retrouvable à l'adresse suivante : [https://gueropie.tpweb.univ-rouen.fr/sae303/](https://gueropie.tpweb.univ-rouen.fr/sae303/).
- Il est aussi prévu que je déploie ce projet sur un serveur personnel, relié à mon nom de domaine : [https://pierregueroult.dev]. Je mettrais à jour le readme du repository lorsque ce sera fait.
- Il est de même possible de retrouver mon projet sur mon github : [https://github.com/pierregueroult/energy-dashboard](https://github.com/pierregueroult/energy-dashboard)
- Pour un déploiement local, il est possible de cloner le repository ou de récupérer le code auprès de moi. Sans oublier d'installer la base de données correspondente dans le fichier "sae303_lite.sql" à installer dans la base de données `sae303` de votre serveur MySQL.

## Rappel des consignes :

### Objectifs :

- Analyser des données pour en extraire des indicateurs ou les informations pertinentes;
- Proposer un site web permettant de visualiser les données;
- Compléter ce site web par la production d'élements de communication visuelle sur différents supports ou par la production d'une application interactive permettant une navigation au sein des données.

### Sujet :

Chaque étudiant se verra attribué un des départements français (voir le tableau en annexe). A partir de deux fichiers CSV contenant l'ensemble des données de consommation et de production régionale d’énergie d’une part et de consommation par secteur d’activité d’autre part, les étudiants devront produire un tableau de bord synthétique des indicateurs caractéristiques et pertinents de l’état de la consommation et de la production d'énergie pour le département qui lui a été attribué.

### Livrables :

Le livrable attendu est une page web unique non responsive regroupant les représentations pertinentes des données. Cette page peut être réalisée techniquement de plusieurs façons distinctes avec trois niveaux d’accomplissement :

- Soit elle est statique avec des représentations de données obtenues en tant qu’images générées à partir d’un tableur. Dans ce cas, une attention toute particulière devra être menée quant à l’intégration web de ces images en termes d’ergonomie et d’accessibilité d’une part et de mise en page et de rédaction de contenus textuels associés d’autre part.
- Soit elle s’appuie sur une base de données et les représentations de ces données sont produites à partir d’une seule des deux librairies JavaScript présentées sans interaction.
- Soit en plus du niveau de réalisation précédent, l’utilisateur pourra sélectionner tout ou partie des données à représenter avec interaction.

Cette page web devra comporter au minimum les représentations étudiées en TD (linechart, pichart, histogram) et une représentation explorée en autonomie. Ces représentations s’appuieront sur au moins deux indicateurs de chacune des deux sources de données fournies, soit au moins 4 représentations différentes.

Dans tous les cas, la page réalisée devra être hébergée sur la plateforme TpWeb de l’université et chaque
étudiant déposera sur une universitice :

- Un document pdf d’une page maximum contenant :
  - Des explications concernant les choix réalisés autant d’un point de vue technique que d’un point de vue de la pertinence des représentations des données,
  - Le niveau de réalisation atteint,
  - Les difficultés éventuelles rencontrées,
  - Le lien fonctionnel vers la réalisation sur la plateforme TPWeb.
- Une archive contenant :
  - La page web statique ou dynamique,
  - Les fichiers de style s’il y en a,
  - Un export de la base de donnée utilisée s’il y a lieu
