
<VirtualHost *:80>
    ServerName dev.statgate
    ServerAlias www.dev.statgate
    DocumentRoot /var/www/html/public
</VirtualHost>

<VirtualHost *:443>
    ServerName dev.statgate
    DocumentRoot /var/www/html/public
    ServerAlias www.dev.statgate
    ErrorLog /var/www/html/storage/logs/error.log
    CustomLog /var/www/html/storage/logs/requests.log combined

    # Enable Proxy Module
#        ProxyPass "/@vite" "http://localhost:5173/"
#       ProxyPassReverse "/@vite" "http://localhost:5173/"

    # ProxyPassReverseCookiePath /localhost

    # <IfModule mod_proxy.c>
    #     ProxyPassReverseCookiePath /localhost /
    # <IfModule>
    
    ### following three lines are for CORS support
    <IfModule mod_headers.c>
    Header always set Access-Control-Allow-Origin "*"
    Header always set Access-Control-Allow-Methods "POST, GET, OPTIONS, DELETE, PUT"
    Header always set Access-Control-Allow-Headers "x-requested-with, Content-Type, origin, authorization, accept"
    Header always set Access-Control-Expose-Headers "Content-Security-Policy, Location"
    Header always set Access-Control-Max-Age "600"
    Header always set Access-Control-Allow-Credentials "true"
    </IfModule>

    RewriteEngine On
    RewriteCond %{REQUEST_METHOD} OPTIONS
    RewriteRule ^(.*)$ $1 [R=200,L]
    RewriteRule ^storage/(.*)$ storage/app/public/$1 [L]
    
    SSLEngine on
    SSLCipherSuite ALL:!ADH:!EXPORT56:RC4+RSA:+HIGH:+MEDIUM:+LOW:+SSLv2:+EXP
    SSLCertificateFile /etc/apache2/ssl/laravel/apache-selfsigned.crt
    SSLCertificateKeyFile /etc/apache2/ssl/laravel/apache-selfsigned.key
</VirtualHost>