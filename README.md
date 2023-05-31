How ro run app

Using Docker:

1.Clone this repo
2.Go inside .docker folder and run "docker compose up -d" to run containers
3.Go inside automat-php container using "docker exec -it automat-php bash" or using terminal in docker desktop
4.Run "composer install" to download autoload files

---------------------------------------------------------------------------------------------------------

Using xampp and apache:
1.Clone this repo
2.Go to C:\xampp\apache\conf\extra
3.Open "httpd-vhosts.conf" in text editor
4.Add this vhost configuration:

<VirtualHost *:80>
    DocumentRoot "path/to/app/automat/public"
    ServerName automat.localhost

    <Directory "path/to/app/automat/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    <Directory path/to/app/automat/templates/assets">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    AccessFileName .htaccess
</VirtualHost>

5.Go to C:\Windows\System32\drivers\etc
6.Open hosts file in text editor
7.Add this:
127.0.0.1       automat.localhost
