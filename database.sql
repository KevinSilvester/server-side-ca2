ALTER DATABASE todo_app CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE todo_list (
   todo_id INT NOT NULL AUTO_INCREMENT,
   todo_name varchar(255) NOT NULL,
   banner varchar(255) NOT NULL,
   icon varchar(255) not null,
   PRIMARY KEY(todo_id)
) ENGINE=InnoDB;

CREATE TABLE task (
   task_id INT NOT NULL AUTO_INCREMENT,
   todo_id INT NOT NULL,
   name VARCHAR(255) NOT NULL,
   progress ENUM('todo', 'doing', 'done'),
   PRIMARY KEY(task_id),
   FOREIGN KEY(todo_id) REFERENCES todo_list(todo_id)
) ENGINE=InnoDB;


INSERT INTO todo_lists ( banner, icon, name, created_at, updated_at) VALUES
('banner', 'icon', 'Todo List name', '2022-01-01 00:00:01', '2022-01-01 00:00:01' ),
('banner', 'icon', 'Todo List name', '2022-01-01 00:00:01', '2022-01-01 00:00:01' ),
('banner', 'icon', 'Todo List name', '2022-01-01 00:00:01', '2022-01-01 00:00:01' );


UPDATE todo_lists 
SET 
   icon = 'icon-test.png',
   banner = 'banner-test.jpg';


INSERT INTO tasks ( name, progress, todo_id, created_at, updated_at ) VALUES
('Complete the task', 'todo', 1, '2022-01-01 00:00:01', '2022-01-01 00:00:01'),
('Complete the task', 'todo', 1, '2022-01-01 00:00:01', '2022-01-01 00:00:01'),
('Complete the task', 'doing', 1, '2022-01-01 00:00:01', '2022-01-01 00:00:01'),
('Complete the task', 'doing', 1, '2022-01-01 00:00:01', '2022-01-01 00:00:01'),
('Complete the task', 'done', 1, '2022-01-01 00:00:01', '2022-01-01 00:00:01'),
('Complete the task', 'todo', 2, '2022-01-01 00:00:01', '2022-01-01 00:00:01'),
('Complete the task', 'todo', 2, '2022-01-01 00:00:01', '2022-01-01 00:00:01'),
('Complete the task', 'doing', 2, '2022-01-01 00:00:01', '2022-01-01 00:00:01'),
('Complete the task', 'doing', 2, '2022-01-01 00:00:01', '2022-01-01 00:00:01'),
('Complete the task', 'done', 2, '2022-01-01 00:00:01', '2022-01-01 00:00:01'),
('Complete the task', 'done', 2, '2022-01-01 00:00:01', '2022-01-01 00:00:01'),
('Complete the task', 'todo', 3, '2022-01-01 00:00:01', '2022-01-01 00:00:01'),
('Complete the task', 'todo', 3, '2022-01-01 00:00:01', '2022-01-01 00:00:01'),
('Complete the task', 'doing', 3, '2022-01-01 00:00:01', '2022-01-01 00:00:01'),
('Complete the task', 'doing', 3, '2022-01-01 00:00:01', '2022-01-01 00:00:01'),
('Complete the task', 'done', 3, '2022-01-01 00:00:01', '2022-01-01 00:00:01'),
('Complete the task', 'done', 3, '2022-01-01 00:00:01', '2022-01-01 00:00:01'),
('Complete the task', 'done', 1, '2022-01-01 00:00:01', '2022-01-01 00:00:01');
