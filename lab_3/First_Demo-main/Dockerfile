FROM ubuntu:18.04
RUN apt-get update && apt-get install nginx -y
COPY app/ /var/www/html/
EXPOSE 80
CMD ["nginx","-g","daemon off;"]
