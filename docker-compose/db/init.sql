create table USERS
(
    id         SERIAL      not null
        constraint USERS_ID_PK
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
        constraint GROUPS_ID_PK
            primary key,
    name        varchar(64) not null,
    description varchar(256),
    owner_id    integer     not null,
    constraint FK_GROUPS_USERS_ID_TO_GROUPS_OWNER_ID
        foreign key (owner_id) references USERS(id),
    cover_id    varchar(36)
);

create table PHOTOS
(
    uuid        varchar(36)                         not null
        constraint PHOTOS_UUID_PK
            primary key,
    title       varchar(64)                         not null,
    description varchar(256)                                ,
    likes       integer   default 0                 not null,
    visibility  integer   default 1                 not null,
    owner_id    integer                             not null,
    constraint FK_PHOTOS_USERS_ID_TO_PHOTOS_OWNER_ID
        foreign key (owner_id) references USERS(id),
    group_id    integer                             not null,
    constraint FK_PHOTOS_GROUPS_ID_TO_PHOTOS_GROUP_ID
        foreign key (group_id) references GROUPS(id),
    created_at  timestamp default CURRENT_TIMESTAMP not null
);

ALTER TABLE GROUPS
    ADD CONSTRAINT FK_GROUPS_PHOTOS_ID_TO_GROUPS_COVER_ID
        FOREIGN KEY (cover_id) REFERENCES PHOTOS(uuid);

create table USER_FOLLOW_GROUPS
(
    id         SERIAL                              not null
        constraint USER_FOLLOW_GROUPS_ID_PK
            primary key,
    user_id    integer                             not null,
    constraint FK_USERS_ID_TO_USER_FOLLOW_GROUPS_USER_ID
        foreign key (user_id) references USERS(id),
    group_id   integer                             not null,
    constraint FK_GROUPS_ID_TO_USER_FOLLOW_GROUPS_GROUP_ID
        foreign key (group_id) references GROUPS(id),
    right     integer default 0                   not null,
    created_at timestamp default CURRENT_TIMESTAMP not null
);
