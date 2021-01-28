set -e

echo "Deploying application ..."

set -e

echo "Deploying application ..."

# Enter maintenance mode
(php artisan down --message 'The app is being (quickly!) updated. Please try again in a minute.') || true
    # Update codebase
    git pull origin master
    composer install
    env-generator-prod.sh
    php artisan key:generate
# Exit maintenance mode
php artisan up

echo "Application deployed!"