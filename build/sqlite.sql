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
    created     INTEGER default CURRENT_TIMESTAMP,
    lastChanged INTEGER,
    lastLogin   INTEGER
);

create unique index email_auth_index
    on users_auth (email);
