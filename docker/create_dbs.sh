#!/bin/bash
set -e

# Aquí definimos las bases de datos extra que queremos
# Puedes cambiar 'db_testing' por el nombre que quieras
psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" --dbname "$POSTGRES_DB" <<-EOSQL
    CREATE DATABASE company_1;
    GRANT ALL PRIVILEGES ON DATABASE company_1 TO "$POSTGRES_USER";
EOSQL