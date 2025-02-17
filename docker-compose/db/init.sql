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

create table GROUPS
(
    id          SERIAL      not null
        constraint ID
            primary key,
    name        varchar(64) not null,
    description varchar(256),
    owner_id    integer     not null,
        constraint GROUPS_USERS_ID_TO_GROUPS_OWNER_ID
            references users
);

create table PHOTOS
(
    uuid        varchar(36)                         not null
        constraint PHOTOS_pk
            primary key,
    title       varchar(64)                         not null,
    description varchar(256)                        not null,
    likes       integer   default 0                 not null,
    visibility  integer   default 1                 not null,
    owner_id    integer                             not null
        constraint FK_PHOTOS_USERS_ID_TO_PHOTOS_OWNER_ID
            references users,
    group_id    integer                             not null
        constraint FK_PHOTOS_GROUPS_ID_TO_PHOTOS_GROUP_ID
            references GROUPS (id),
    created_at  timestamp default CURRENT_TIMESTAMP not null
);

create table USER_FOLLOW_GROUPS
(
    id         SERIAL                              not null,
    user_id    integer                             not null
        constraint FK_USERS_ID_TO_USER_FOLLOW_GROUPS_USER_ID
            references users,
    group_id   integer                             not null
        constraint FK_GROUPS_ID_TO_USER_FOLLOW_GROUPS_GROUP_ID
            references GROUPS (id),
    created_at timestamp default CURRENT_TIMESTAMP not null
);

