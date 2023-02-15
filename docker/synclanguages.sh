#!/bin/bash

echo 'Syncing languages folder from git to the languages runtime volume...'

if [ -d "/app/web/wp-content/languages/wpml" ]; then
    echo "Keeping the contents of /app/web/wp-content/languages/wpml"
    mv /app/web/wp-content/languages/wpml /app/web/wp-content/languages/wpml_old_BiTWPr6YMKchkyX4WLlJxf40wb3jE8PCjLFo2L91fkGMiQ7w9fqt43

    cp -Trf /app/web/wp-content/languages-git/ /app/web/wp-content/languages/

    rm -r /app/web/wp-content/languages/wpml/
    mv /app/web/wp-content/languages/wpml_old_BiTWPr6YMKchkyX4WLlJxf40wb3jE8PCjLFo2L91fkGMiQ7w9fqt43 /app/web/wp-content/languages/wpml
else
    echo "No /app/web/wp-content/languages/wpml folder present"
    cp -Trf /app/web/wp-content/languages-git/ /app/web/wp-content/languages/
fi
