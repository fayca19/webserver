#!/bin/bash
service apache2 start 
service php7.4-fpm start
a2enmod rewrite
service apache2 restart
a2ensite agb.local.conf
a2ensite bna.local.conf
a2ensite cash.local.conf
a2ensite salama.local.conf
a2ensite declaration.local.conf
a2ensite localhost.conf
service apache2 reload
tail -f /dev/null


