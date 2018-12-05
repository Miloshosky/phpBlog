DROP TABLE IF EXISTS 'blog_members';

CREATE TABLE 'blog_members' (
'memberID' int(11) unsigned NOT NULL AUTO_INCREMENT,
'username' varchar(255) DEFAULT NULL,
'password' varchar(255) DEFAULT NULL,
'email' varchar(255) DEFAULT NULL,
PRIMARY KEY ('memberID');
)

INSERT INTO 'blog_members' ('memberID', 'username', 'password', 'email')
VALUES (11, 'Admin', '$2y$10$F8jwYTX8Le30hqnv7yazBOI3fHLn39j8kovpl9062oD1lOHJMuzFK', 'admin@admin.com');


DROP TABLE IF EXISTS 'blog_posts';

CREATE TABLE 'blog_posts' (
'postID' int(11) unsigned NOT NULL AUTO_INCREMENT,
'postTitle' varchar(255) DEFAULT NULL,
'postDesc' text DEFAULT NULL,
'postCont' text DEFAULT NULL,
'postDate' datetime DEFAULT NULL,
PRIMARY KEY('postID')
);