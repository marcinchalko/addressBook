# addressBook

### Uruchomienie lokalnie:

1. Uruchomienie kontenerów Docker Compose i zbudowanie obrazów:

    ```bash
    docker-compose up -d --build
    ```

2. Wykonanie skryptu PHP w kontenerze:

    ```bash
    docker exec -it addressbook-php-1 php migration.php
    ```