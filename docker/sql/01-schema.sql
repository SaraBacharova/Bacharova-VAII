CREATE TABLE `books`
(
    `id`          INT AUTO_INCREMENT PRIMARY KEY,
    `title`       VARCHAR(200) NOT NULL,
    `author`      VARCHAR(150) NOT NULL,
    `year`        INT          NOT NULL,
    `pages`       INT          NOT NULL,
    `description` TEXT         NOT NULL
) DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;