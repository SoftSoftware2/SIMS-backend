#!/bin/bash
set -e

psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" --dbname "$POSTGRES_DB" <<-EOSQL
    CREATE DATABASE company_1;
    GRANT ALL PRIVILEGES ON DATABASE company_1 TO "$POSTGRES_USER";
EOSQL