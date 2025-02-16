create table USERS
(
    id         SERIAL      not null
        constraint ID
            primary key,
    first_name    varchar(64) not null,
    last_name    varchar(64) not null,
    email       VARCHAR(100) UNIQUE not null,
    password   varchar(255) not null,
    created_at timestamp default current_timestamp
);
