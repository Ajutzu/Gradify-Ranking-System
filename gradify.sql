-- USERS TABLE
CREATE TABLE users_table (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    fullname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    profile_picture VARCHAR(255) DEFAULT 'upload/profile/default.png',
    profile_cover VARCHAR(255) DEFAULT 'upload/cover/default.png',
    otp VARCHAR(255),
    expired_time DATETIME,
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_banned BOOLEAN DEFAULT 0,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    user_type ENUM('Student', 'Teacher', 'Admin') NOT NULL
);

CREATE TABLE classroom_post (
    post_id INT AUTO_INCREMENT PRIMARY KEY,
    classroom_id INT NOT NULL,
    user_id INT NOT NULL,
    rank INT NOT NULL,
    description TEXT NOT NULL,
    gpa FLOAT NOT NULL,
    post_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (classroom_id) REFERENCES classroom_table(classroom_id),
    FOREIGN KEY (user_id) REFERENCES users_table(user_id)
);

-- CLASSROOM TABLE
CREATE TABLE classroom_table (
    classroom_id INT AUTO_INCREMENT PRIMARY KEY,
    classroom_name VARCHAR(255) NOT NULL,
    classroom_host INT,
    classroom_code VARCHAR(255) NOT NULL UNIQUE,
    classroom_banner VARCHAR(255) DEFAULT 'upload/classroom/default.png',
    classroom_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    classroom_active BOOLEAN DEFAULT 1,
    classroom_expired DATETIME,
    FOREIGN KEY (classroom_host) REFERENCES users_table(user_id)
);

-- CLASSROOM-STUDENT RELATIONSHIP TABLE
CREATE TABLE classroom_student (
    classroom_id INT,
    user_id INT,
    student_gpa FLOAT DEFAULT NULL, -- Moved GPA here
    PRIMARY KEY (classroom_id, user_id),
    FOREIGN KEY (classroom_id) REFERENCES classroom_table(classroom_id),
    FOREIGN KEY (user_id) REFERENCES users_table(user_id)
);

-- SUBJECTS TABLE (CONNECTED TO CLASSROOMS)
CREATE TABLE subjects_table (
    subject_id INT AUTO_INCREMENT PRIMARY KEY,
    subject_name VARCHAR(255) NOT NULL,
    subject_code VARCHAR(50) NOT NULL UNIQUE,
    classroom_id INT,
    subject_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (classroom_id) REFERENCES classroom_table(classroom_id)
);

-- GRADES TABLE (CONNECTED TO SUBJECTS AND STUDENTS)
CREATE TABLE grades_table (
    grade_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    subject_id INT,
    grade FLOAT NOT NULL, -- Grade for the specific subject
    grade_recorded TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users_table(user_id),
    FOREIGN KEY (subject_id) REFERENCES subjects_table(subject_id)
);
