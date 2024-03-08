# nginx/Dockerfile
FROM nginx:latest

# Remove default NGINX configuration
RUN rm /etc/nginx/conf.d/default.conf

# Copy custom NGINX configuration
COPY default.conf /etc/nginx/conf.d/

# Expose port 80 to access NGINX
EXPOSE 80
