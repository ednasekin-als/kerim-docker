FROM node:20-alpine
RUN if lscpu | grep -q "aarch64"; then RUN apk add g++ make python; fi

WORKDIR /app

COPY package*.json ./

RUN npm install

COPY . .

CMD ["npm", "run", "dev"]
