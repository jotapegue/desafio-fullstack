FROM node

WORKDIR /app

COPY frontend/package.json package.json
COPY frontend/package-lock.json package-lock.json

RUN npm install
RUN npm install -g typescript

USER node

CMD ["npm", "run", "dev"]