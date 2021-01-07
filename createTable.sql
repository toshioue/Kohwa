DROP TABLE IF EXISTS Posts;
DROP TABLE IF EXISTS Sessions;
DROP TABLE IF EXISTS Users;

CREATE TABLE Posts (
          PostID INT NOT NULL AUTO_INCREMENT,
          Title VARCHAR(100) NOT NULL,
          Content TEXT NOT NULL,
          Thumbnail VARCHAR(100) NULL,
          DateCreated Date NOT NULL,
          CONSTRAINT PK_Post PRIMARY KEY (PostID)
);

/*USERS TABLE*/
CREATE TABLE Users (Username VARCHAR(20) NOT NULL,
                    Password VARCHAR(255) NOT NULL,
                    Session TEXT NULL,
                    LastLogin TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    CONSTRAINT PK_Users PRIMARY KEY (Username)
                    );

/*Sessions */
CREATE TABLE Sessions (User VARCHAR(20) NOT NULL,
                       SessionID VARCHAR(100) NOT NULL,
                       LastVisit TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                       CONSTRAINT PK_Session PRIMARY KEY (SessionID),
                           CONSTRAINT FK_auth_Session_Users FOREIGN KEY(User)
                           REFERENCES Users (Username) ON DELETE CASCADE ON UPDATE CASCADE);

INSERT INTO Users (Username, Password) VALUES ('admin', '$2y$10$yrYZX4p3IVBWmq.jb2JE2eqrCY2duItPMK5MfvedgaGLKESmbFX2e');
