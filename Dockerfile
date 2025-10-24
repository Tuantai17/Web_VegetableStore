# -------- Build stage --------
FROM node:20-alpine AS build
WORKDIR /app

# copy manifest trước để cache install
COPY package.json package-lock.json* ./
# nếu bạn dùng pnpm/yarn thì đổi tương ứng, còn npm thì:
RUN npm ci

# copy source
COPY . .
# build ra /app/dist
RUN npm run build

# -------- Runtime stage (static) --------
FROM nginx:alpine
# copy dist sang nginx html
COPY --from=build /app/dist /usr/share/nginx/html
# (tuỳ chọn) thêm SPA fallback
# RUN printf "try_files \$uri /index.html;\n" > /etc/nginx/conf.d/default.conf
EXPOSE 80
CMD ["nginx","-g","daemon off;"]
