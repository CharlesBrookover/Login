create table users
(
    email     TEXT not null,
    firstName TEXT,
    lastName  TEXT,
    city      TEXT,
    age       INTEGER,
    inserted  INTEGER default CURRENT_TIMESTAMP,
    updated   INTEGER
);

create unique index email_index
    on users (email);

create table users_auth
(
    email       TEXT not null,
    password    TEXT not null,
    lastChanged INTEGER,
    created     INTEGER default CURRENT_TIMESTAMP
);

create unique index email_auth_index
    on users_auth (email);
