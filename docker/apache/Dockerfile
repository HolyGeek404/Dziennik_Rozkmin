FROM httpd:2.4.51

COPY projektphp.apache.conf /usr/local/apache2/conf/projektphp.apache.conf

RUN echo "Include /usr/local/apache2/conf/projektphp.apache.conf" \
    >> /usr/local/apache2/conf/httpd.conf