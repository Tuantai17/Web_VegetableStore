# --- Build stage ---
FROM node:20-alpine AS build
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build   # tạo thư mục dist

# --- Runtime stage ---
FROM node:20-alpine
WORKDIR /app
# cài serve để phục vụ dist
RUN npm i -g serve
# copy output build
COPY --from=build /app/dist /app/dist

ENV PORT=10000
EXPOSE 10000
CMD ["serve", "-s", "dist", "-l", "10000"]
