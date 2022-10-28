create table users
(
    email     TEXT not null unique,
    firstName TEXT,
    lastName  TEXT,
    city      TEXT,
    age       INTEGER check ( age > 0 ),
    inserted  INTEGER default CURRENT_TIMESTAMP,
    updated   INTEGER
);

create table users_auth
(
    email       TEXT not null unique,
    password    TEXT not null,
    created     INTEGER default CURRENT_TIMESTAMP,
    lastChanged INTEGER,
    lastLogin   INTEGER
);
