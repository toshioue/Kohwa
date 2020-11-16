DROP TABLE IF EXISTS Posts;
CREATE TABLE Posts (
          PostID INT NOT NULL AUTO_INCREMENT,
          Title VARCHAR(100) NOT NULL,
          Content TEXT NOT NULL,
          DateCreated Date NOT NULL,
          CONSTRAINT PK_Post PRIMARY KEY (PostID)
);
