/* 自分の学籍番号＋dbに変更する */
USE G999A9999db;

CREATE TABLE tasks (
    id           INT          AUTO_INCREMENT,
    body         VARCHAR(255) NOT NULL,
    done         INT(1)       NOT NULL DEFAULT 0,  -- 0:未完了 1:完了
    created_at   DATETIME,  -- タスク作成日時
    updated_at   DATETIME,  -- タスク更新日時

    PRIMARY KEY (id)
);