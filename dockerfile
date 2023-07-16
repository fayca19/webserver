FROM ubuntu:latest
COPY ./start.sh /
RUN chmod +x /start.sh
RUN apt -y update
RUN apt -y install software-properties-common
RUN add-apt-repository ppa:ondrej/php
RUN apt -y update
RUN apt -y install apache2
RUN DEBIAN_FRONTEND=noninteractive TZ=Etc/UTC apt-get -y install tzdata
RUN apt-get -y install php7.4 php7.4-fpm php7.4-mysql php7.4-mbstring php7.4-gd
RUN a2enmod proxy_fcgi proxy  
ENTRYPOINT ["/start.sh"]