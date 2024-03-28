FROM node

WORKDIR /app

COPY frontend/. .

RUN npm install
RUN npm install -g typescript
RUN npm run build

USER node
