docker compose -f dmi/docker-compose.yml down
docker compose -f hopital/docker-compose.yml down
docker compose -f log-agent/docker-compose.yml down
docker compose -f mutuelle/docker-compose.yml down

docker compose -f mutuelle/docker-compose.yml up -d
docker compose -f dmi/docker-compose.yml up -d
docker compose -f hopital/docker-compose.yml up -d
docker compose -f log-agent/docker-compose.yml up -d