Pour que le back fonctionne : 
- serveur apache2 avec DocumentRoot = /path/to/erp-siris-i3dx1/dmi
- docker mysql => cd bdd ; docker-compose up; (infos de connexion dans le .yml)

Exemple de requete via curl : 

Création dmi :
- curl -i -X POST -d 'idGroland=1&nom=dumond&prenom=jean&mdp=azerty' localhost:3001/createdmi.php

Création acte : 
- curl -i -G --data-urlencode 'idGroland=1' --data-urlencode 'idActe=10' --data-urlencode 'lieu=18 avenue des Vosges, 67000 Strasbourg' --data-urlencode 'type=scanner' --data-urlencode 'date=2023-12-18 12:30:00' --data-urlencode 'montant=480.50' http://localhost:3001/createact.php

Check login/mdp :
- curl -X POST -d "id=1&password=azerty" localhost:3001/loginuser.php

Récupérer les infos d'un patient :
- curl -i -X POST -d 'idGroland=1' localhost:3001/getpatientinfo.php

Récupérer l'entièreté du dmi :
- curl -i -X POST -d 'idGroland=1' localhost:3001/getdmi.php

Payer un acte (interconnexion avec Hopital quand restant = 0):
- curl -i -X POST -d 'idActe=1&montant=200.00' localhost:3001/payact.php

Confirmer un acte : 
- curl -i -X POST -d 'idActe=10' localhost:3001/confirmact.php

Confirmer le paiement fait par la mutuelle (interconnexion mutuelle) :
- curl -i -G -d 'id=10' -d 'intervention=scanner' http://localhost:3001/actmut.php
