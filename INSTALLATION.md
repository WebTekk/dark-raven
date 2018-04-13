# Installation guide

## Fresh installation

### File system
- Rename `example.env.php` to `env.php`
- Configure database settings in `env.php`
- Run `composer install` in the command line

### SQL
```
CREATE SCHEMA `dark_raven` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE dark_raven;

CREATE TABLE `dark_raven`.`role` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `role` VARCHAR(45) NOT NULL,
  `title` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `dark_raven`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NULL,
  `password` VARCHAR(60) NULL,
  `role_id` INT NULL,
  `email` VARCHAR(45) NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `active` INT NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`role_id`) references role(`id`)
);

INSERT INTO `dark_raven`.`role` (`id`, `role`, `title`) VALUES (1, 'ROLE_MEMBER', 'Member');
INSERT INTO `dark_raven`.`role` (`id`, `role`, `title`) VALUES (2, 'ROLE_ADMIN', 'Admin');
INSERT INTO `dark_raven`.`user` (`username`, `password`, `role_id`, `email`) VALUES ('testuser', '$2y$10$ZHNhkjhQAO2Bx0BU90P8WOAv94nbCL2SA.7PP4wpD8F8Wf4GIlXbW', '1', 'user@test.ch');
INSERT INTO `dark_raven`.`user` (`username`, `password`, `role_id`, `email`) VALUES ('testadmin', '$2y$10$ZHNhkjhQAO2Bx0BU90P8WOAv94nbCL2SA.7PP4wpD8F8Wf4GIlXbW', '2', 'admin@test.ch');
```

### Test user
User - Username: testuser, Password: test1234\
Admin - Username: testadmin, Password: test1234