DROP DATABASE IF EXISTS blog;
CREATE DATABASE blog
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;
USE blog;


CREATE TABLE IF NOT EXISTS blog_posts
(
  postID    INT(11),
  postTitle VARCHAR(255),
  postDesc  TEXT,
  postCont  TEXT,
  postDate  DATETIME
);

CREATE TABLE IF NOT EXISTS blog_members
(
  memberID INT(11),
  username VARCHAR(255),
  password VARCHAR(255),
  email    VARCHAR(255)
);