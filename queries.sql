-- 1
CREATE TABLE `cards` (
    id INT(2) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `name` VARCHAR(120) NOT NULL,
    price INT(10) NOT NULL,
    `desc` VARCHAR(240) NOT NULL,
    category INT(2) NOT NULL
);

-- 2
CREATE TABLE `categories` (
    id INT(2) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `name` VARCHAR(120) NOT NULL
);


-- 3
ALTER TABLE cards ADD CONSTRAINT fk_cards_category FOREIGN KEY (category) REFERENCES categories(id);


-- 4
CREATE TABLE `images` (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    card_id INT NOT NULL,
    path VARCHAR(255) NOT NULL,
    
    FOREIGN KEY (card_id) REFERENCES cards(id)
);

-- 5 
CREATE TABLE `services` (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    image VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL
)


-- 6 

CREATE TABLE `news`(
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    title VARCHAR(120) NOT NULL,
    descrip VARCHAR(255) NOT NULL,
    date DATE NOT NULL
);

-- 7

ALTER TABLE `news` ADD `img` VARCHAR(225) NULL DEFAULT NULL AFTER `date`; 