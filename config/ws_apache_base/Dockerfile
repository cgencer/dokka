FROM "tsle/ws-apache-php74-mariadb103-arm64:2.7a"

ADD ./startup.sh /opt/startup.sh
RUN sed -i 's/\r//g' /opt/startup.sh
CMD ["/bin/bash", "/opt/startup.sh"]
