DROP SCHEMA IF EXISTS `WAD_Project`;
CREATE SCHEMA IF NOT EXISTS `WAD_Project`; 
USE `WAD_Project`; 

CREATE TABLE `User` (
    id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(150), 
    password_hash VARCHAR(255),
    name VARCHAR(150),
    age INT, 
    mobile_number VARCHAR(8),
    email VARCHAR(150),
    gender ENUM("M", "F", "O"), 
    image_name VARCHAR(150),
    interest TEXT(65535),
    school VARCHAR(150),
    year_of_study INT, 
    course VARCHAR(150),
    date_start TIMESTAMP,
    date_end TIMESTAMP NULL,
    PRIMARY KEY (id)
);

CREATE TABLE Skill (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(150), 
    PRIMARY KEY (id)
);

CREATE TABLE Competition (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(150), 
    description TEXT(65535),
    age_min INT, 
    age_max INT, 
    image_name VARCHAR(150),
    year_of_study_min INT,
    year_of_study_max INT,
    date_start TIMESTAMP,
    date_end TIMESTAMP NULL,
    PRIMARY KEY (id)
);

CREATE TABLE Fee (
    id INT NOT NULL AUTO_INCREMENT,
    amount FLOAT, 
    date_start TIMESTAMP,
    PRIMARY KEY (id)
);

CREATE TABLE `Group` (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(150), 
    competition_id INT NOT NULL,
    is_private BOOLEAN,
    date_start TIMESTAMP,
    date_end TIMESTAMP NULL,
    PRIMARY KEY (id), 
    CONSTRAINT group_fk FOREIGN KEY (competition_id) REFERENCES Competition(id)
);

CREATE TABLE Payment_History (
    id INT NOT NULL AUTO_INCREMENT,
    date_paid TIMESTAMP,
    user_id INT NOT NULL, 
    fee_id INT NOT NULL, 
    PRIMARY KEY (id), 
    CONSTRAINT payment_history_fk1 FOREIGN KEY (user_id) REFERENCES User(id), 
    CONSTRAINT payment_history_fk2 FOREIGN KEY (fee_id) REFERENCES Fee(id)
);

CREATE TABLE User_Skill (
    user_id INT NOT NULL, 
    skill_id INT NOT NULL,
    proficiency INT,
    CONSTRAINT user_skill_pk PRIMARY KEY (user_id, skill_id),
    CONSTRAINT user_skill_fk1 FOREIGN KEY (user_id) REFERENCES User(id),
    CONSTRAINT user_skill_fk2 FOREIGN KEY (skill_id) REFERENCES Skill(id)
);

CREATE TABLE User_Lacks (
    user_id INT NOT NULL, 
    skill_id INT NOT NULL,
    CONSTRAINT user_lacks_pk PRIMARY KEY (user_id, skill_id),
    CONSTRAINT user_lacks_fk1 FOREIGN KEY (user_id) REFERENCES User(id),
    CONSTRAINT user_lacks_fk2 FOREIGN KEY (skill_id) REFERENCES Skill(id)
);

CREATE TABLE Competition_Skill (
    competition_id INT NOT NULL, 
    skill_id INT NOT NULL,
    CONSTRAINT competition_skill_pk PRIMARY KEY (competition_id, skill_id),
    CONSTRAINT competition_skill_fk1 FOREIGN KEY (competition_id) REFERENCES Competition(id),
    CONSTRAINT competition_skill_fk2 FOREIGN KEY (skill_id) REFERENCES Skill(id)
);

CREATE TABLE User_Group (
    user_id INT NOT NULL, 
    group_id INT NOT NULL,
    is_admin BOOLEAN,
    CONSTRAINT user_group_pk PRIMARY KEY (user_id, group_id),
    CONSTRAINT user_group_fk1 FOREIGN KEY (user_id) REFERENCES User(id),
    CONSTRAINT user_group_fk2 FOREIGN KEY (group_id) REFERENCES Group(id) ON DELETE CASCADE
);

CREATE TABLE User_Competition (
    user_id INT NOT NULL, 
    competition_id INT NOT NULL,
    CONSTRAINT user_group_pk PRIMARY KEY (user_id, group_id),
    CONSTRAINT user_group_fk1 FOREIGN KEY (user_id) REFERENCES User(id),
    CONSTRAINT user_group_fk2 FOREIGN KEY (competition_id) REFERENCES Competition(id)
);

CREATE TABLE `Match` (
    user_id1 INT NOT NULL, 
    user_id2 INT NOT NULL, 
    compatibility INT, 
    date TIMESTAMP, 
    status ENUM("Pending", "Cleared", "Rejected"), 
    CONSTRAINT match_pk PRIMARY KEY (user_id1, user_id2),
    CONSTRAINT match_fk1 FOREIGN KEY (user_id1) REFERENCES User(id),
    CONSTRAINT match_fk2 FOREIGN KEY (user_id2) REFERENCES User(id)
);

CREATE TABLE Connection (
    user_id1 INT NOT NULL, 
    user_id2 INT NOT NULL,
    date TIMESTAMP, 
    CONSTRAINT connection_pk PRIMARY KEY (user_id1, user_id2),
    CONSTRAINT connection_fk1 FOREIGN KEY (user_id1) REFERENCES User(id),
    CONSTRAINT connection_fk2 FOREIGN KEY (user_id2) REFERENCES User(id)
);

CREATE TABLE Connection_Request (
    from_id INT NOT NULL, 
    to_id INT NOT NULL,
    date TIMESTAMP, 
    CONSTRAINT connection_pk PRIMARY KEY (from_id, to_id),
    CONSTRAINT connection_fk1 FOREIGN KEY (from_id) REFERENCES User(id),
    CONSTRAINT connection_fk2 FOREIGN KEY (to_id) REFERENCES User(id)
);

-- CREATE TABLE `Portfolio` (
--     id INT NOT NULL AUTO_INCREMENT,
--     date TIMESTAMP, 
--     CONSTRAINT portfolio_pk PRIMARY KEY (id)
-- );

-- CREATE TABLE `Personal_Portfolio` (
--     portfolio_id INT NOT NULL,
--     portfolio_text TEXT(65535),
--     user_id INT NOT NULL,
--     CONSTRAINT personal_portfolio_pk PRIMARY KEY (id),
--     CONSTRAINT personal_portfolio_fk FOREIGN KEY (user_id) REFERENCES User(id)
-- );

-- CREATE TABLE `Group_Portfolio` (
--     portfolio_id INT NOT NULL,
--     portfolio_text TEXT(65535),
--     group_id INT NOT NULL,
--     CONSTRAINT group_portfolio_pk PRIMARY KEY (id),
--     CONSTRAINT group_portfolio_fk FOREIGN KEY (group_id) REFERENCES Group(id)
-- );
