FROM node

WORKDIR /app

COPY frontend/. .

RUN npm install
RUN npm install -g typescript

USER node

CMD ["npm", "run", "build"]