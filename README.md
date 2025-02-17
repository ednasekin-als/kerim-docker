For develop
Build
- docker compose -f docker-compose.dev.yml up -d --build

Start
- docker compose -f docker-compose.dev.yml up

For production
Build
- docker compose up -d --build

Start
- docker compose up

Install BD. Ask bd telegram @eugene_nd
- scp /Users/evgenijnasekin/Desktop/kerim/backup.sql root@ip:/var/www/kerim-docker/

Additional command
- touch .env
- nano .env


Backend. Ask upload/plugins content telegram @eugene_nd