FROM node:16

ENV DOCKER_DEV 1

WORKDIR /app

COPY package*.json .

RUN npm install

COPY . .

CMD ["npm", "run", "dev"]
