-- Creation of the database
CREATE DATABASE project_management;

USE project_management;

-- Table: users
CREATE TABLE
    users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        role ENUM ('manager', 'regular') DEFAULT 'regular',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

-- Table: projects
CREATE TABLE
    projects (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL UNIQUE,
        description TEXT,
        visibility ENUM ('public', 'private') NOT NULL,
        due_date DATE NOT NULL,
        manager_id INT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (manager_id) REFERENCES users (id) ON DELETE CASCADE
    );

-- Table: categories
CREATE TABLE
    categories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL UNIQUE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

-- Table: tags
CREATE TABLE
    tags (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL UNIQUE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

-- Table: tasks
CREATE TABLE
    tasks (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT,
        status ENUM ('todo', 'doing', 'done') DEFAULT 'todo',
        due_date DATE,
        project_id INT NOT NULL,
        category_id INT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (project_id) REFERENCES projects (id) ON DELETE CASCADE,
        FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE SET NULL
    );

-- Table: project_users (many-to-many relationship between projects and users)
CREATE TABLE
    project_users (
        project_id INT NOT NULL,
        user_id INT NOT NULL,
        PRIMARY KEY (project_id, user_id),
        FOREIGN KEY (project_id) REFERENCES projects (id) ON DELETE CASCADE,
        FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
    );

-- Table: task_users (many-to-many relationship between tasks and users)
CREATE TABLE
    task_users (
        task_id INT NOT NULL,
        user_id INT NOT NULL,
        PRIMARY KEY (task_id, user_id),
        FOREIGN KEY (task_id) REFERENCES tasks (id) ON DELETE CASCADE,
        FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
    );

-- Table: task_tags (many-to-many relationship between tasks and tags)
CREATE TABLE
    task_tags (
        task_id INT NOT NULL,
        tag_id INT NOT NULL,
        PRIMARY KEY (task_id, tag_id),
        FOREIGN KEY (task_id) REFERENCES tasks (id) ON DELETE CASCADE,
        FOREIGN KEY (tag_id) REFERENCES tags (id) ON DELETE CASCADE
    );

-- Insert fake data into users
INSERT INTO
    users (name, email, password, role)
VALUES
    (
        'ayoub akraou',
        'ayoubakraou@gmail.com',
        '$2y$10$CsIw8C6Chum3RJzYaYbKG.mXGpOQH3qKcN8a9R2NbNWFwSVl8xe0m', -- 00000000
        'manager'
    ),
    (
        'akram mowahidi',
        'akram@example.com',
        '$2y$10$0u8sRBwOwCXYjMkpislirudw1GWbFzkhKR2AAiNSlaZuQawTqrV1m', -- 11111111
        'regular'
    ),
    (
        'karim el korchi',
        'karim@example.com',
        '$2y$10$0u8sRBwOwCXYjMkpislirudw1GWbFzkhKR2AAiNSlaZuQawTqrV1m', -- 11111111
        'regular'
    ),
    (
        'mohamed nadir',
        'mohamed@example.com',
        '$2y$10$0u8sRBwOwCXYjMkpislirudw1GWbFzkhKR2AAiNSlaZuQawTqrV1m', -- 11111111
        'regular'
    );

-- Insert fake data into projects
INSERT INTO
    projects (
        name,
        description,
        visibility,
        due_date,
        manager_id
    )
VALUES
    (
        'Website Redesign',
        'Redesign the company website.',
        'private',
        '2024-03-01',
        1
    ),
    (
        'Mobile App Development',
        'Develop a new mobile application.',
        'public',
        '2024-04-10',
        4
    );

-- Insert fake data into categories
INSERT INTO
    categories (name)
VALUES
    ('Development'),
    ('Design'),
    ('Testing');

-- Insert fake data into tags
INSERT INTO
    tags (name)
VALUES
    ('Urgent'),
    ('Frontend'),
    ('Backend');

-- Insert fake data into tasks
INSERT INTO
    tasks (
        title,
        description,
        status,
        due_date,
        project_id,
        category_id
    )
VALUES
    (
        'Create Wireframes',
        'Design wireframes for the new website.',
        'doing',
        '2025-01-15',
        1,
        2
    ),
    (
        'Develop API',
        'Build the backend API for the mobile app.',
        'done',
        '2025-02-01',
        2,
        1
    ),
    (
        'Write Test Cases',
        'Prepare test cases for the application.',
        'todo',
        '2025-01-20',
        2,
        3
    ),
    (
        'Setup Database',
        'Design and implement the database schema.',
        'done',
        '2025-01-25',
        1,
        1
    ),
    (
        'Frontend Implementation',
        'Create responsive layouts for the application.',
        'done',
        '2025-01-30',
        2,
        2
    ),
    (
        'Performance Testing',
        'Analyze and improve the apps performance.',
        'todo',
        '2025-02-10',
        2,
        3
    ),
    (
        'Fix UI Bugs',
        'Resolve UI-related issues found during testing.',
        'doing',
        '2025-01-22',
        1,
        2
    );

-- Insert fake data into project_users
INSERT INTO
    project_users (project_id, user_id)
VALUES
    (1, 1),
    (1, 2),
    (2, 3),
    (2, 4);

-- Insert fake data into task_users
INSERT INTO
    task_users (task_id, user_id)
VALUES
    (1, 2),
    (2, 3),
    (3, 4),
    (4, 1),
    (5, 3),
    (6, 4),
    (7, 2);

-- Insert fake data into task_tags
INSERT INTO
    task_tags (task_id, tag_id)
VALUES
    (1, 1),
    (2, 2),
    (2, 3),
    (3, 1),
    (4, 3),
    (5, 2),
    (6, 1),
    (7, 2);