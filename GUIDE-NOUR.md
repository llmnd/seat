# Guide complet de Nour, l’assistante solaire

Ce document explique le fonctionnement de Nour dans le site SEAT Opus Global :
son parcours de conversation, les réglages, les formules, le graphique, les
boutons et les limites de l’estimation. Il est écrit pour pouvoir présenter
Nour à une autre personne sans avoir à lire le code.

## 1. Nour en une phrase

Nour est un assistant guidé qui demande quels appareils doivent être alimentés,
estime les panneaux, la batterie et l’onduleur nécessaires à partir de valeurs
prédéfinies, demande le lieu et l’orientation des panneaux, puis utilise des
données solaires historiques pour comparer un scénario avec et sans batterie.
Les appareils et les calculs de dimensionnement restent dans le navigateur ;
seuls le nom de ville et les paramètres solaires sont transmis aux services de
données. Ce n’est ni une étude technique sur site ni une mesure réelle de la
position du soleil.

## 2. Le parcours de la personne qui utilise Nour

1. La personne ouvre l’assistant avec le bouton **« Besoin d’aide ? Parler avec
   Nour »** ou un lien de la page marqué pour ouvrir Nour.
2. Nour demande quel type de projet la personne veut équiper :
   **une maison**, **un commerce ou un bureau**, **une ferme ou un point d’eau**,
   ou **un projet à composer soi-même**.
3. Un ensemble d’appareils de départ est proposé pour les trois premiers choix.
   La personne peut ajouter, retirer ou ajuster des appareils, leurs horaires,
   et choisir si chaque appareil fonctionne le jour, la nuit ou les deux.
4. Elle choisit si elle veut également de l’électricité **le soir et la nuit**
   ou **seulement le jour**.
5. Elle recherche sa ville et choisit le résultat exact, puis vérifie ou change
   l’orientation et l’inclinaison des panneaux.
6. Nour récupère les données historiques PVGIS, choisit automatiquement le
   mois le moins ensoleillé pour dimensionner prudemment, puis affiche une
   comparaison du même projet avec et sans batterie.
7. Le panneau de droite affiche aussi une courbe journalière, une commande de
   sélection de l’heure et les indicateurs du scénario sélectionné.
8. Le lien **« Demander une étude personnalisée »** conduit au formulaire de
   contact. Le bouton **« Recommencer »** relance le parcours.

```text
Ouvrir Nour
    │
    ▼
Choisir un type de projet ──► Charger une liste d'appareils de départ
    │                                      │
    │                                      ▼
    └─ Projet à composer ─────────► Ajouter / régler les appareils
                                           │
                                           ▼
                              Choisir jour seul ou jour + nuit
                                           │
                                           ▼
                              Rechercher la ville du projet
                                           │
                                           ▼
                             Régler orientation et inclinaison
                                           │
                                           ▼
                         Charger les données solaires historiques
                                           │
                                           ▼
                       Comparer les scénarios avec/sans batterie
                                           │
                                           ▼
                        Lire le graphique et demander une étude
```

## 3. Les appareils et leurs hypothèses par défaut

Le modèle donne à chaque appareil une puissance nominale, un nombre d’heures
d’utilisation quotidien et une période d’utilisation. Les puissances sont des
valeurs types dans le programme : elles ne sont pas lues sur les appareils
réels de la personne.

| Appareil | Puissance type | Heures/jour par défaut | Période retenue | Particularité du calcul |
|---|---:|---:|---|---|
| Lampe LED | 10 W | 5 h | Soir et nuit | — |
| Ventilateur | 60 W | 8 h | Jour et nuit, moitié-moitié | — |
| Téléviseur | 100 W | 4 h | Soir et nuit | — |
| Ordinateur portable | 65 W | 6 h | Jour | — |
| Chargeur de téléphone | 10 W | 3 h | Jour et nuit, moitié-moitié | — |
| Box internet | 12 W | 24 h | Jour et nuit, moitié-moitié | — |
| Réfrigérateur | 150 W | 24 h | Jour et nuit, moitié-moitié | Fonctionne à 40 % du temps ; démarrage moteur ×3 |
| Congélateur | 200 W | 24 h | Jour et nuit, moitié-moitié | Fonctionne à 40 % du temps ; démarrage moteur ×3 |
| Climatiseur (1 CV) | 900 W | 8 h | Soir et nuit | Fonctionne à 60 % du temps ; démarrage moteur ×3,5 |
| Pompe immergée (1 CV) | 750 W | 6 h | Jour | Démarrage moteur ×3 |
| Autre appareil | 100 W | 4 h | Jour et nuit, moitié-moitié | Puissance modifiable ; aucun taux de fonctionnement ou démarrage spécial |

« Jour et nuit, moitié-moitié » est une règle de répartition de l’énergie
quotidienne : la moitié est classée le jour et l’autre moitié la nuit. Cela ne
signifie pas que Nour connaît l’heure réelle à laquelle chaque appareil sera
utilisé.

### Listes proposées

- **Une maison** : 6 lampes LED, 2 ventilateurs, 1 téléviseur, 1 réfrigérateur,
  3 chargeurs de téléphone et 1 ordinateur portable.
- **Un commerce ou un bureau** : 8 lampes LED, 3 ventilateurs, 2 ordinateurs
  portables, 1 réfrigérateur, 1 congélateur et 1 box internet.
- **Une ferme ou un point d’eau** : 1 pompe, 4 lampes LED, 2 chargeurs de
  téléphone et 1 réfrigérateur.
- **Je choisis moi-même** : aucune ligne au départ ; il faut ajouter au moins
  un appareil pour faire le calcul.

## 4. Les commandes et les réglages

### Commandes de la fenêtre

- **Ouvrir Nour** : bouton flottant de lancement ; le lien d’appel présent sur
  certaines pages peut également ouvrir la fenêtre.
- **× / Fermer l’assistant** : ferme la fenêtre. La touche **Échap** et un clic
  sur le fond extérieur la ferment aussi.
- **Réponses proposées** : les boutons de réponse font avancer la conversation.
- **Continuer** : passe à l’étape suivante après le réglage des appareils.
- **Recommencer** : vide le parcours courant et relance une nouvelle estimation.
- **Demander une étude personnalisée** : ouvre la page de contact.
- **Comment c’est calculé** : déplie les cinq grandes étapes de calcul dans le
  panneau de simulation.

### Réglage de la liste d’appareils

- **Ajouter un appareil** : menu déroulant. Ajouter un appareil déjà présent
  augmente sa quantité au lieu de créer une deuxième ligne.
- **− / + de Quantité** : retire ou ajoute une unité ; les valeurs sont limitées
  à 1–20.
- **− / + d’Heures par jour** : retire ou ajoute 0,5 heure ; les valeurs sont
  limitées à 0,5–24 heures.
- **× sur une ligne** : retire l’appareil de la liste.
- **Champ de puissance de “Autre appareil”** : accepte une puissance de 1 à
  20 000 W.
- **Menu du moment d’utilisation** : permet de classer chaque appareil comme
  utilisé le jour, le soir et la nuit, ou réparti moitié-moitié entre les deux.
- **Recherche de ville** : tapez au moins deux caractères, lancez la recherche,
  puis sélectionnez la ville, la région et le pays correspondants.
- **Orientation** : huit directions cardinales/intercardinales ; la valeur
  proposée par défaut regarde vers l’équateur (sud dans l’hémisphère nord,
  nord dans l’hémisphère sud).
- **Inclinaison** : curseur de 0° à 90° par rapport à l’horizontale. La valeur
  par défaut est proche de la latitude du lieu ; elle peut être ajustée si la
  toiture impose une pente différente.
- **Calculer le potentiel solaire** : récupère les données de rayonnement
  correspondant au lieu, à l’orientation et à la pente.
- **Réessayer / Continuer avec l’estimation générale** : si le service solaire
  ne répond pas, la personne peut relancer la requête ou choisir explicitement
  le calcul de repli basé sur 5 heures de soleil équivalent par jour.

Chaque changement de la liste recalcule immédiatement l’estimation et le
graphique après le chargement des paramètres de lieu. Les changements
d’utilisation jour/nuit modifient l’énergie affectée aux panneaux et à la
batterie. La comparaison présente en parallèle les deux options de stockage.

Fermer puis rouvrir la fenêtre au cours du même chargement de page ne relance
pas automatiquement le questionnaire : l’état reste en mémoire. Le bouton
**Recommencer** relance le questionnaire. Un rechargement de la page, lui,
recrée l’assistant ; aucune sauvegarde durable n’est faite.

### Commande qui « fait bouger le soleil »

Le curseur **Heure de la journée** est un curseur de 0 à 24 heures, par pas de
15 minutes. Il déplace le marqueur lumineux sur la courbe et met à jour
l’heure, la production estimée, la consommation estimée et le texte d’état.

Au premier résultat calculable, Nour fait aussi automatiquement glisser le
marqueur de **5 h 30 à midi**, en environ **2,4 secondes**, pour montrer que le
marqueur suit le profil de production. Ce mouvement est une animation de
présentation, pas une simulation accélérée de la journée réelle. Le premier
mouvement manuel interrompt l’animation. Si l’appareil est réglé pour réduire
les animations, ce déplacement automatique est omis.

Le curseur ne modifie **ni** la quantité d’énergie quotidienne, **ni** le
nombre de panneaux, **ni** la batterie, **ni** l’onduleur. Il ne change que le
point de lecture de l’estimation horaire. Le déplacer ne fait pas réellement
bouger le soleil dans le ciel et ne modifie pas l’orientation des panneaux.

## 5. Comment Nour calcule les besoins

Toutes les énergies intermédiaires sont calculées en wattheures (Wh), puis
affichées en kilowattheures (kWh) lorsque nécessaire. Rappel :
**1 kWh = 1 000 Wh**. Les puissances des appareils sont en watts (W) et la
puissance de panneaux en watts-crête (Wc).

### Étape A — Énergie quotidienne de chaque appareil

Pour chaque ligne :

```text
Énergie quotidienne (Wh)
  = puissance (W) × quantité × heures par jour × taux de fonctionnement
```

Le taux vaut 100 % par défaut. Il est réduit à 40 % pour les réfrigérateurs et
congélateurs, et à 60 % pour le climatiseur. Exemple : le modèle estime le
réfrigérateur à `150 W × 1 × 24 h × 0,40 = 1 440 Wh/jour`, plutôt qu’à
3 600 Wh/jour en fonctionnement continu.

### Étape B — Séparer énergie de jour et énergie de nuit

Le modèle répartit l’énergie de chaque appareil selon son menu d’utilisation :

- **Jour** : 100 % dans l’énergie de jour, 0 % la nuit.
- **Soir et nuit** : 0 % le jour, 100 % la nuit.
- **Jour et nuit** : 50 % le jour et 50 % la nuit.

Il additionne ensuite toutes les lignes en deux totaux : `dayWh` et `nightWh`.
Si la personne demande **« Non, seulement le jour »**, l’énergie servie la nuit
devient zéro pour le dimensionnement. Pour les appareils classés « jour et
nuit », cela exclut donc aussi leur moitié nocturne du total retenu. Nour
affiche alors explicitement que les appareils utilisés le soir et la nuit ne
seront pas alimentés sans batterie.

### Étape C — Récupérer le soleil du lieu et dimensionner les panneaux

Après sélection d’une ville et des réglages de panneaux, Nour interroge le
service PVGIS de la Commission européenne pour obtenir l’irradiation moyenne
reçue par les panneaux, avec l’inclinaison et l’azimut choisis. La base utilisée
est **PVGIS-ERA5** ; la réponse fournit les valeurs quotidiennes moyennes par
mois et une moyenne annuelle.

Nour choisit le mois ayant la plus petite irradiation moyenne pour le
dimensionnement. C’est une hypothèse prudente pour tenir compte de la saison
moins ensoleillée ; ce n’est pas une garantie pendant une période météo
exceptionnelle. La recherche de ville utilise Open-Meteo/GeoNames. Le serveur
fait l’appel PVGIS, car PVGIS n’autorise pas les appels AJAX directs depuis le
navigateur. Pour que cet appel HTTPS fonctionne en production, PHP doit avoir
l’extension **cURL** ou **OpenSSL** activée (et `allow_url_fopen` activé si
l’installation utilise le repli par flux PHP).

Les constantes restantes sont :

- **5 heures de soleil équivalent par jour** (`PSH = 5`), utilisées uniquement
  si la personne choisit l’estimation générale parce que les données locales
  sont indisponibles ;
- **15 % de pertes** (`LOSS = 0,85`) pour représenter notamment chaleur,
  poussière et câbles ;
- **85 % de rendement direct** des panneaux vers les appareils (`ETA_DIRECT`);
- **75 % de rendement** pour l’énergie qui passe par la batterie (`ETA_BATT`);
- **550 W par panneau** (`PANEL_W`).

Le besoin brut de panneaux avant l’arrondi est :

```text
Besoin panneaux (Wc)
  = (énergie jour / 0,85 + énergie nuit servie / 0,75)
    / (irradiation journalière du mois choisi × 0,85)
```

L’irradiation est en kWh/m²/jour. La valeur numérique équivaut au nombre
d’heures de soleil équivalent reçu par un panneau d’un kWc. Dans l’exemple de
repli, on remplace cette valeur locale par 5.
Le terme « énergie nuit servie » vaut le total de nuit si la batterie est
demandée, sinon zéro. L’énergie nocturne est divisée par 0,75 parce qu’elle
subit davantage de pertes en passant par le stockage. Le besoin est ensuite
divisé par 550 W et arrondi **au panneau entier supérieur**, avec au moins un
panneau si le résultat n’est pas nul.

La puissance installée vaut `nombre de panneaux × 550 Wc`. La production
journalière indicative affichée pour le mois de dimensionnement est :

```text
Production estimée (kWh/jour)
  = puissance installée (Wc) × irradiation journalière × 0,85 / 1 000
```

La surface indicative de toiture est `nombre de panneaux × 2,6 m²`, arrondie à
l’entier pour l’affichage.

### Étape D — Dimensionner la batterie

Si l’option jour + nuit est retenue, Nour dimensionne une capacité indicative
pour une nuit :

```text
Batterie (kWh)
  = énergie de nuit (Wh) / (0,80 × 0,90) / 1 000
```

`0,80` signifie que 80 % de la capacité nominale d’une batterie lithium
LiFePO₄ est considérée comme utilisable (profondeur de décharge). `0,90` est le
rendement retenu pour l’onduleur lors de l’alimentation depuis la batterie.
Sans besoin nocturne, l’écran indique **« Aucune »** et **« Usage de jour
uniquement »**.

### Étape E — Dimensionner l’onduleur

Pour l’onduleur, le modèle utilise les puissances nominales simultanées
estimées et prévoit une marge de démarrage moteur :

```text
Puissance à couvrir (VA, approximation)
  = (somme des puissances nominales × 70 %
     + surcharge de démarrage du moteur le plus exigeant) × 1,25
```

La surcharge de démarrage est estimée appareil par appareil par
`puissance × (facteur de démarrage − 1)`. Le plus grand résultat est retenu
(la règle suppose qu’un moteur démarre à la fois). Les facteurs configurés
sont ×3 pour le réfrigérateur, le congélateur et la pompe, et ×3,5 pour le
climatiseur. Enfin, la valeur est arrondie au calibre suivant de la liste :
300, 500, 800, 1 000, 1 500, 2 000, 3 000, 5 000, 8 000, 10 000, 15 000 ou
20 000 VA. Au-dessus de 20 000, le modèle arrondit au prochain millier.

Le résultat est affiché en VA ou kVA ; l’écran présente les watts calculés
comme une approximation en VA. Il faut donc le comprendre comme un calibre
indicatif, pas comme un choix final de matériel.

## 6. Exemple complet : le préréglage « Une maison »

Les calculs ci-dessous illustrent le **mode général de repli à 5 heures**,
pour donner un exemple reproductible. En mode local, la quantité de panneaux
et la production changent selon la ville, l’orientation, la pente et le mois
le moins ensoleillé. L’énergie des appareils et la capacité de batterie restent
calculées à partir de la même liste d’appareils.

Avec les valeurs par défaut et l’option **jour + nuit**, la liste comporte :
6 lampes, 2 ventilateurs, 1 téléviseur, 1 réfrigérateur, 3 chargeurs et
1 ordinateur portable.

### Énergie par appareil

| Appareils | Calcul | Total |
|---|---:|---:|
| 6 lampes LED | 10 × 6 × 5 | 300 Wh, nuit |
| 2 ventilateurs | 60 × 2 × 8 | 960 Wh, soit 480 jour + 480 nuit |
| 1 téléviseur | 100 × 1 × 4 | 400 Wh, nuit |
| 1 réfrigérateur | 150 × 1 × 24 × 0,40 | 1 440 Wh, soit 720 jour + 720 nuit |
| 3 chargeurs | 10 × 3 × 3 | 90 Wh, soit 45 jour + 45 nuit |
| 1 ordinateur portable | 65 × 1 × 6 | 390 Wh, jour |
| **Totaux** |  | **1 635 Wh jour + 1 945 Wh nuit = 3 580 Wh/jour** |

### Résultats dimensionnés

```text
Panneaux avant arrondi
  = (1 635 / 0,85 + 1 945 / 0,75) / (5 × 0,85)
  ≈ 1 063 Wc

Nombre de panneaux
  = plafond(1 063 / 550) = 2 panneaux

Puissance installée et toiture
  = 2 × 550 Wc = 1 100 Wc ; 2 × 2,6 m² = 5,2 m²
  affichée comme environ 5 m² (arrondi à l'entier)

Batterie
  = 1 945 / (0,80 × 0,90) / 1 000 ≈ 2,7 kWh

Onduleur
  = somme des puissances × 70 % + démarrage
  = 525 × 0,70 + 300 = 667,5 W
  avec marge 25 % : 667,5 × 1,25 ≈ 834 W
  calibre supérieur disponible : environ 1 kVA

Production journalière indicative
  = 1 100 × 5 × 0,85 / 1 000 = 4,675 kWh/jour
  pour une demande retenue de 3,580 kWh/jour
```

L’onduleur du calcul de l’exemple utilise 525 W de puissance nominale cumulée.
Le réfrigérateur fournit la surcharge moteur maximale : `150 × (3 − 1) =
300 W`. Le calibre proposé est le suivant disponible après l’application de
la marge.

Avec **« seulement le jour »**, le modèle ne dimensionne pas la partie nocturne
de 1 945 Wh. Il n’indique donc pas les 2,7 kWh de batterie ; les appareils
utilisés la nuit ne seront pas alimentés selon le scénario affiché.

## 7. Lire le graphique de la journée

```text
Puissance
   ▲
   │                 ╭── production solaire (courbe orange)
   │              ╭──╯  ╰──╮
   │  consommation ▮▮       ▮▮  (barres bleues selon l'heure)
   │ nuit   jour  │   midi   │ nuit
   └───────0──────6────12────18────24────► Heure
              le marqueur se déplace avec le curseur
```

Ce croquis explique les formes, il ne représente pas une mesure ni une échelle
numérique exacte. Dans le graphique réel :

- L’axe horizontal couvre **0 h à 24 h**, avec repères à 0, 6, 12, 18 et 24 h.
- La **courbe orange** représente une puissance solaire estimée en watts. Elle
  monte au lever approximatif du soleil, atteint son maximum à midi puis
  redescend jusqu’au coucher estimé. Les heures de lever et de coucher sont
  approximées avec la latitude et le milieu du mois de dimensionnement.
- Les **barres bleu clair** représentent la consommation de jour ; les
  **barres bleu foncé** représentent la consommation attribuée au soir et à la
  nuit. Elles montrent la demande de nuit même dans la comparaison sans
  batterie : cette part est alors indiquée comme non couverte.
- Les zones avant le lever et après le coucher sont assombries et intitulées
  « Nuit » ; la zone centrale est « Jour ».
- Une ligne verticale en pointillés et un point lumineux indiquent l’heure
  sélectionnée. En période sans production, le point devient gris.
- L’échelle verticale est partagée par la production et les barres, mais aucun
  chiffre de puissance n’est écrit sur l’axe vertical. Le lecteur exact à côté
  du curseur donne les valeurs de l’heure choisie.

### Comment les courbes horaires sont construites

La production utilise une cloche mathématique entre le lever et le coucher
approximatifs :

```text
x = (heure − lever) / (coucher − lever)
forme = 0 si x ≤ 0 ou x ≥ 1
forme = sin(π × x)^1,6 sinon
```

Cette forme est normalisée par une somme numérique de pas de 0,1 heure. Le
coefficient de normalisation est choisi pour que l’aire sous la courbe sur la
journée corresponde à la production journalière du mois choisi
(`puissance panneaux × irradiation × 0,85`). Le pic est à midi. L’irradiation
est locale et tient compte de l’orientation et de la pente choisies ; la forme
horaire reste pédagogique et ne provient pas de prévisions météo heure par
heure.

Pour tracer les barres, l’énergie de jour est distribuée uniformément entre le
lever et le coucher approximatifs et l’énergie nocturne sur le reste de la
journée. Le code répartit aussi les portions d’heures aux limites du lever et
du coucher. Les horaires détaillés des appareils ne sont donc pas reproduits :
le profil est une représentation pédagogique, pas un programme de
fonctionnement individuel appareil par appareil.

### Lire le texte sous le curseur

À l’heure sélectionnée, le lecteur affiche :

1. **l’heure** (le pas réel du curseur est de 15 minutes) ;
2. **Production**, calculée par la courbe à cette heure ;
3. **Consommation**, prise dans le créneau horaire correspondant ;
4. une phrase d’interprétation :
   - consommation nulle : les appareils ne tournent pas à cette heure ;
   - production suffisante après le facteur direct de 85 % : le texte dit que
     le soleil alimente les appareils (et indique une recharge de batterie si
     une batterie est prévue) ;
   - production solaire positive mais insuffisante : le texte dit que le
     soleil couvre tout ou partie de la charge, avec partage avec la batterie
     si le système en prévoit une ;
   - aucune production et une charge : le texte indique que la batterie prend
     le relais si elle est prévue, ou que la consommation nocturne n’est pas
     couverte dans le scénario sans batterie.

À **24 h**, le point est à l’extrémité droite et la production est nulle ;
pour la consommation, le code lit le dernier créneau (23 h–24 h).

Ces phrases comparent des valeurs horaires estimées. Nour ne calcule pas l’état
de charge heure après heure : il n’y a pas de compteur de batterie, de
simulation de charge réelle, ni d’algorithme qui vérifie que la batterie a
effectivement accumulé assez d’énergie dans la journée. « Recharge » et «
prend le relais » sont donc des explications simplifiées du scénario.

## 8. Comprendre les quatre résultats

- **Panneaux solaires** : nombre de modules de 550 W et puissance totale en Wc.
  Le sous-texte donne une surface de toiture approximative. Plus la demande
  journalière ou la part utilisée la nuit augmente, plus le besoin calculé
  peut augmenter.
- **Batterie** : capacité nominale estimée en kWh pour la consommation de nuit
  prise en compte, avec les hypothèses d’autonomie et de pertes ci-dessus.
  « Aucune » correspond à un scénario jour uniquement ou sans énergie nocturne.
- **Onduleur** : calibre supérieur retenu après l’estimation de puissance
  cumulée et de démarrage moteur. Les charges réelles, leur simultanéité et
  leurs pointes doivent être mesurées pour choisir le matériel.
- **Production journalière** : production théorique pour le mois le moins
  ensoleillé sélectionné dans les données locales ; la ligne en dessous
  rappelle l’énergie quotidienne servie dans le scénario choisi. En mode
  général, elle se base sur 5 heures de soleil équivalent par jour. Ce n’est
  pas une garantie de production chaque jour.

### Comparaison avec et sans batterie

Les deux cartes utilisent le même lieu, la même orientation, la même liste et
les mêmes appareils :

- **Sans batterie** : les panneaux sont calculés pour l’énergie classée de
  jour ; la carte affiche en plus l’énergie nocturne qui restera non couverte.
  Si toute la consommation est nocturne, ce scénario affiche zéro panneau pour
  l’alimentation de jour et toute la demande nocturne comme non couverte.
- **Avec batterie** : les panneaux sont calculés pour l’énergie de jour et
  l’énergie de nuit après pertes de stockage ; la carte donne aussi la capacité
  indicative de batterie pour une nuit.

Les panneaux arrondis au module entier peuvent faire apparaître une production
affichée supérieure à la demande. Cela ne signifie pas nécessairement qu’il y
a un surplus constant : la production varie selon le soleil, les saisons et
les conditions réelles.

## 9. Les hypothèses modifiables dans le code

Les paramètres ci-dessous ne sont pas des réglages proposés à l’utilisateur
dans la fenêtre ; ce sont des constantes du programme. Pour changer le modèle,
il faut les modifier dans
[solar-advisor.js](./site-a-televerser/js/solar-advisor.js), puis vérifier que
les explications « Comment c’est calculé » restent cohérentes :

| Paramètre du programme | Valeur actuelle | Rôle |
|---|---:|---|
| `PSH` | 5 h/jour | Soleil équivalent du seul mode général de repli |
| Source solaire locale | PVGIS-ERA5 | Irradiation moyenne par mois pour le lieu/pente/azimut choisis |
| `LOSS` | 0,85 | Rendement global correspondant à 15 % de pertes |
| `PANEL_W` | 550 W | Puissance d’un panneau type |
| `PANEL_M2` | 2,6 m² | Surface estimée d’un panneau |
| `DOD` | 0,8 | Fraction de capacité batterie utilisable |
| `ETA_DIRECT` | 0,85 | Rendement panneaux vers les appareils |
| `ETA_BATT` | 0,75 | Rendement du trajet panneaux → batterie → appareils |
| Rendement onduleur batterie | 0,90 | Fraction appliquée au calcul de capacité de batterie |
| Marge simultanéité onduleur | 0,70 | Fraction de la somme des puissances en fonctionnement |
| Marge de dimensionnement onduleur | 1,25 | Marge ajoutée après la surcharge moteur |

La liste `APP` contient les puissances, heures, périodes, taux de
fonctionnement et facteurs de démarrage des appareils. `PRESETS` contient les
listes initiales des trois types de projet.

## 10. Ce que Nour ne prend pas en compte

Les résultats sont expressément indiqués comme **estimation indicative**, à
confirmer par une étude technique. Le calcul actuel ne demande pas ou ne
modélise pas :

- l’adresse exacte du toit et les conditions météo du jour ; la ville est
  géolocalisée et des moyennes mensuelles historiques sont disponibles, mais
  Nour ne connaît pas la prévision météo à la date précise d’installation ;
- la météo exacte du jour, une prévision horaire, ou les conditions d’une
  année exceptionnelle ; PVGIS fournit ici des moyennes historiques par mois ;
- l’ombrage local causé par les bâtiments, arbres ou éléments de toiture ; les
  données d’horizon topographique ne remplacent pas une visite du toit ;
- les relevés réels de puissance, les fiches techniques et les habitudes
  horaires détaillées des appareils, au-delà de leur catégorie jour/nuit ;
- les températures, les nuages, la poussière réelle, le vieillissement, ni les
  pertes propres à une installation précise ;
- le modèle exact de batterie, sa tension, sa capacité commerciale, sa durée de
  vie, ou plusieurs jours d’autonomie ;
- la puissance réellement disponible d’un onduleur, ses limites, ses
  protections, le câblage, la sécurité ou la conformité de l’installation ;
- les coûts, le réseau électrique ou un bilan énergétique mesuré.

La personne peut choisir l’orientation et la pente, mais le modèle ne vérifie
pas si la toiture peut physiquement les respecter. La période attribuée aux
appareils et leurs puissances types restent des hypothèses. Une puissance de
démarrage peut varier fortement d’un appareil réel à l’autre. Un technicien
doit confirmer le dimensionnement sur site avant l’achat et l’installation.

## 11. Données, démarrage et accessibilité

La liste des appareils et les calculs restent dans le navigateur et ne sont pas
transmis aux API. Le nom de la ville est envoyé à la recherche
Open-Meteo/GeoNames ; les coordonnées, l’orientation et l’inclinaison sont
envoyées au serveur du site, qui interroge PVGIS. Nour ne stocke pas ces choix
durablement ; les services externes peuvent appliquer leurs propres règles de
journaux et de confidentialité. Une mention de source accompagne la recherche
de ville et les données solaires locales.

L’assistant démarre lorsque son élément devient visible (ou immédiatement si
le navigateur ne prend pas en charge l’observation de visibilité). L’animation
tient compte du réglage système de réduction des mouvements.

La fenêtre est déclarée comme dialogue accessible : son titre est annoncé,
le focus est placé à l’ouverture, reste contenu dans la fenêtre avec Tab, puis
revient au bouton d’origine à la fermeture. Le curseur fournit également un
texte accessible donnant l’heure et les valeurs sélectionnées.

## 12. Explication courte à transmettre à quelqu’un

> « Nour est un assistant qui part de la liste des appareils que vous voulez
> faire fonctionner. Il estime leur consommation à partir de puissances et
> d’heures types, sépare ce qui est utilisé le jour et la nuit, puis calcule
> un nombre de panneaux, une capacité de batterie et un calibre d’onduleur.
> Elle demande aussi la ville, l’orientation et la pente pour récupérer une
> irradiation historique locale, et compare les résultats avec ou sans
> batterie. Le graphique montre une journée type, pas la météo en direct : le
> curseur déplace le point de lecture, pas le vrai soleil. Les chiffres restent
> indicatifs, car les appareils réels, l’ombre et la toiture doivent être
> vérifiés sur place. »

## 13. Fichiers concernés

- [solar-advisor.js](./site-a-televerser/js/solar-advisor.js) : conversation,
  valeurs par défaut, recherche de ville, configuration des panneaux,
  formules, comparaison, tracé et curseur horaire.
- [solar-resource.php](./site-a-televerser/api/solar-resource.php) : validation
  des paramètres et récupération côté serveur des données mensuelles PVGIS.
- [nour-assistant.php](./site-a-televerser/includes/nour-assistant.php) :
  structure de la fenêtre, du graphique, des indicateurs et du curseur.
- [solar-advisor.css](./site-a-televerser/css/solar-advisor.css) : apparence
  de l’assistant, des commandes et du graphique.
- [site-footer.php](./site-a-televerser/includes/site-footer.php) : inclusion
  de la fenêtre dans le site.
- [site-fonts.php](./site-a-televerser/includes/site-fonts.php) : chargement du
  CSS et du JavaScript de Nour.
