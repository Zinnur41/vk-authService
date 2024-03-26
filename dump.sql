CREATE TABLE if not exists user_account(
                                     id bigserial primary key,
                                     email varchar(255),
                                     password varchar(100)
);
