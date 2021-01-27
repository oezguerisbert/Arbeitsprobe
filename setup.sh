docker-compose up --build -d
$IP = $(docker inspect $(docker ps --quiet --filter name=arbeitsprobe-mysql) --format "{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}")
echo $IP;