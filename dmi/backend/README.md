Pour que le back fonctionne : 
- serveur apache2 avec DocumentRoot = /path/to/erp-siris-i3dx1/dmi
- docker mysql => cd bdd ; docker-compose up; (infos de connexion dans le .yml)

Exemple de requete via curl : 
Ajout acte : 
- curl -i -G --data-urlencode 'idGroland=1' --data-urlencode 'idActe=9' --data-urlencode 'lieu=18 avenue des Vosges, 67000 Strasbourg' --data-urlencode 'type=cassage de nuque 3' --data-urlencode 'date=2023-12-18 12:30:00' --data-urlencode 'montant=480.50' http://localhost:80/backend/createact.php

Check login/mdp :
- curl -X POST -d "id=1&password=azerty" localhost:80/backend/loginuser.php

Création dmi :
- curl -i -X POST -d 'idGroland=1&nom=dumond&prenom=jean&mdp=azerty' localhost:80/backend/createdmi.php