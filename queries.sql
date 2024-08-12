
CREATE TABLE `cards` (
    id INT(2) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `name` VARCHAR(120) NOT NULL,
    price INT(10) NOT NULL,
    `desc` VARCHAR(240) NOT NULL,
    category INT(2) NOT NULL
);


CREATE TABLE `categories` (
    id INT(2) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `name` VARCHAR(120) NOT NULL
);



ALTER TABLE cards ADD CONSTRAINT fk_cards_category FOREIGN KEY (category) REFERENCES categories(id);