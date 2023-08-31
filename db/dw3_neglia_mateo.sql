-- MySQL Script generated by MySQL Workbench
-- Tue Jun 27 20:35:59 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
-- -----------------------------------------------------
-- Schema dw3_neglia_mateo
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema dw3_neglia_mateo
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `dw3_neglia_mateo` DEFAULT CHARACTER SET utf8mb4 ;
USE `dw3_neglia_mateo` ;

-- -----------------------------------------------------
-- Table `dw3_neglia_mateo`.`user_roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dw3_neglia_mateo`.`user_roles` (
  `user_role_id` TINYINT(3) UNSIGNED NOT NULL,
  `name` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`user_role_id`))
ENGINE = InnoDB;

--
-- Volcado de datos para la tabla `user_roles`
--
INSERT INTO `user_roles` (`user_role_id`, `name`) VALUES
(1, 'admin'),
(2, 'moderator'),
(3, 'user');

--
--
--

-- -----------------------------------------------------
-- Table `dw3_neglia_mateo`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dw3_neglia_mateo`.`users` (
  `user_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `name` VARCHAR(65) NULL,
  `last_name` VARCHAR(65) NULL,
  `nick_name` VARCHAR(65) NULL,
  `user_role_fk` TINYINT(3) UNSIGNED NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  INDEX `fk_users_user_roles1_idx` (`user_role_fk` ASC),
  CONSTRAINT `fk_users_user_roles1`
    FOREIGN KEY (`user_role_fk`)
    REFERENCES `dw3_neglia_mateo`.`user_roles` (`user_role_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `user_role_fk`, `email`, `password`, `name`, `last_name`, `nick_name`) VALUES
(1, 1, 'admin@collector.com', '$2y$10$tu7ws/uOl6fWYu8jtBfKBeELaBmKCBrm287DUklmNd.iTsb8npyo2', 'Admin', 'Admin', 'Admin'),
(2, 3, 'nullcheck@collector.com', '$2y$10$VkwDjpTtGltdF9vag./B4uUpp41D4f39cmXlvWsFgiwUzCxiaUo76', NULL, NULL, NULL),
(3, 2, 'mod1@collector.com', '$2y$10$UTCPQwtBAygCuW3h7KuA8eR.cc5/eynizowc3.uepjL1rfMOZkwCa', 'Mod1', 'Mod1', 'Mod1'),
(4, 2, 'mod2@collector.com', '$2y$10$p3KXQp.aYcwIxgWruXFT.eFjSX1AtKd0EvWKUIQljfNhBJIEtqI86', 'Mod2', 'Mod2', 'Mod2'),
(5, 2, 'mod3@collector.com', '$2y$10$W1JN7wpF6aM7eA51da1SKOBwJUEDUbub5IiCTd4jS39PPuuqaFnwa', 'Mod3', 'Mod3', 'Mod3'),
(6, 3, 'testmail@gmail.com', '$2y$10$p3KXQp.aYcwIxgWruXFT.eFjSX1AtKd0EvWKUIQljfNhBJIEtqI86', NULL, NULL, NULL);

--
-- 
--

-- -----------------------------------------------------
-- Table `dw3_neglia_mateo`.`products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dw3_neglia_mateo`.`products` (
  `product_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_fk` INT UNSIGNED NULL,
  `publish_datetime` DATETIME NOT NULL,
  `name` VARCHAR(150) NOT NULL,
  `description` TEXT NOT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  `img` VARCHAR(255) NULL,
  `img_lore` VARCHAR(255) NULL,
  PRIMARY KEY (`product_id`),
  INDEX `fk_products_users_idx` (`user_fk` ASC),
  CONSTRAINT `fk_products_users`
    FOREIGN KEY (`user_fk`)
    REFERENCES `dw3_neglia_mateo`.`users` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`product_id`, `user_fk`, `publish_datetime`, `name`, `description`, `price`, `img`, `img_lore`) VALUES
(1, 1, '2020-04-25 20:20:15', 'The Lord of the Rings: The Motion Picture Trilogy (Extended Editions) [Blu-ray]', 'The Quest Is Over: All three extended versions in dazzling 1080p and DTS HD-MA 5.1 Audio. Deluxe set includes over 26 Hours of spellbinding behind-the- moviemaking material, including the Rare Costa Botes documentaries, on 15 discs.', '65.25', 'lotred-cover.jpg', 'dvd boxes of the lord of the rings box set'),
(2, 3, '2020-04-26 20:20:15', 'Digimon Adventure: Last Evolution Kizuna [Blu-ray]', 'Join the last adventure of Tai and Agumon! An unprecedented phenomenon occurs and the DigiDestined discover that growing up means an end to their relationships with their Digimon. On top of that, the DigiDestined realize that the more they fight with their Digimon, the faster their bond breaks. Will they fight for others and risk losing? The time to choose and decide is approaching fast. Tai and Agumon, along with the rest, will be forced to risk everything in their epic last adventure.', '13.00', 'kizuna-cover.jpg', 'Dvds and dvd boxes of the digimon box set'),
(3, 1, '2020-04-27 20:20:15', 'Gurren Lagann: Part 1 (Limited Edition DVD + Artbox + LED Light)', 'In his sky-less cavern of a village Simon toils daily, drilling holes to expand his stifling little world until one day he makes an extraordinary discovery, a small glowing drill-bit and the man-sized mecha it activates. Before he can give it a second thought Simon is dragged into a plot to break through to the surface by the local gang leader Kamina, only to have the ceiling come crashing down on top of them under the weight of a giant monster! It somehow falls onto the boisterous Kamina and the cowardly Simon to defend their village but once they defeat the monster what awaits the duo on the surface world? Get ready for buxom babes, beastmen, and giant mecha as only GAINAX can provide them! BUST THROUGH THE HEAVENS WITH YOUR SOUL, GURREN LAGANN!', '300.00', 'box-set-ttgl.jpg', 'dvd boxes and covers of the gurren lagann box set'),
(4, 4, '2020-04-28 20:20:15', 'Digimon Tamers (Digital Monsters Season 3) [DVD] [NTSC]', 'Takato Matsuki, Rika Nonaka, and Henry Wong are children who, on one fateful day, received real Digimon, unlike the imaginary ones in the card game they play. Each of the children, or \'Digimon Tamers\', have their different views on how Digimon should be treated. But when other Digimon begin to appear around Japan, they must put aside their differences to fend off both the digital intruders and those who seek to destroy all Digimon!', '27.00', 'digimon-tamers-cover.jpg', 'dvd cover of the digimon tamers season'),
(5, 3, '2020-04-29 20:20:15', 'Underworld Limited Edition 5-movie collection - Set [4K UHD]', 'Experience all five films in the iconic Underworld series on Blu-Ray in the ultimate Underworld collection!', '80.00', 'box-set-underworld-cover.jpg', 'box set content of the underworld series dvds'),
(6, 4, '2020-05-25 20:20:15', 'Doctor Who: The Complete David Tennant Collection (Blu-ray)', 'Experience all the life of the best Doctor on the screen at the best price. The box contains season 2 to 4 and the specials.', '18.00', 'doctor-who-david-tennant-cover.jpg', 'Dvd cover of the Tennant years doctor who box set'),
(7, 1, '2020-05-26 20:20:15', 'Battlestar Galactica: The Definitive Collection [Blu-ray]', 'The ultimate collection for the classic series that launched one of the most beloved sci-fi franchises of all time, enjoy Battlestar Galactica in both its original television format and in widescreen format for the first time—all in high-definition! Battlestar Galactica: The Original Series: Hopeful for lasting peace following centuries of intense warfare, the Twelve Colonies gather to sign a treaty with their dreaded enemies, the Cylons. But after an act of treachery on the eve of the ceremony, the Cylons launch a devastating surprise attack, destroying the Colonies home planets and most of their military strength. A lone flagship battlestar, the Galactica, remains to aid the surviving colonists on their epic journey for a new home to a far-off legendary planet—Earth. Galactica 1980: The Complete Series: 30 years after the events of Battlestar Galactica, the original crew finally makes the long-anticipated descent to Earth. With time running out and the Cylons closing in on their trail, Commander Adama and the Galactica must work harder than ever before to help Earth create the technology necessary for battle. Battlestar Galactica: The Original Movie: The original movie that started it all, this theatrical version of the pilot episode includes several alternate scenes different from the televised version.', '80.00', 'battlestar-galactica-tdc.jpg', 'box set cover art of the definitive collection of BTSG'),
(8, 3, '2020-05-27 20:20:15', 'Star Trek: Deep Space Nine: The Complete Series', 'The stable wormhole discovered by the Deep Space Nine crew is known to the Bajoran people as the Celestial Temple of their Prophets. Sisko, as discoverer of the wormhole and its inhabitants, is therefore the Emissary of Bajoran prophesy. The wormhole\'s\' other end is in the Gamma Quadrant, halfway around the galaxy from Bajor. That section of space is dominated by the malevolent Dominion. The Dominion is led by the Changelings, the race of shapeshifters to which Odo belongs. As of the beginning of the sixth season, Cardassia has joined the Dominion, and together they are waging war on the Federation and their Klingon allies. The war is quickly becoming the most costly war ever for the Federation, and the Deep Space Nine crew must fight to protect their way of life. SCREENED/AWARDED AT: Emmy Awards, ...Star Trek: Deep Space Nine (Complete Series) - 48-DVD Boxset ( Star Trek: DS9 - Complete Series )', '85.00', 'star-trek-ds9-complete-series.jpg', 'Box set cover art of the complete series of Star Trek DS9');

-- --------------------------------------------------------


-- -----------------------------------------------------
-- Table `dw3_neglia_mateo`.`tags`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dw3_neglia_mateo`.`tags` (
  `tag_id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tag_name` VARCHAR(55) NULL,
  PRIMARY KEY (`tag_id`))
ENGINE = InnoDB;
--
-- Volcado de datos para la tabla `tags`
--
INSERT INTO `tags` (`tag_id`, `tag_name`) VALUES
(1, 'Anime'),
(2, 'Sci-Fi'),
(3, 'Fantasy'),
(4, 'Terror'),
(5, 'Action');

--
--
--

-- -----------------------------------------------------
-- Table `dw3_neglia_mateo`.`products_has_tags`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dw3_neglia_mateo`.`products_has_tags` (
  `products_fk` INT UNSIGNED NOT NULL,
  `tags_fk` TINYINT UNSIGNED NOT NULL,
  PRIMARY KEY (`products_fk`, `tags_fk`),
  INDEX `fk_products_has_tags_tags1_idx` (`tags_fk` ASC),
  INDEX `fk_products_has_tags_products1_idx` (`products_fk` ASC),
  CONSTRAINT `fk_products_has_tags_products1`
    FOREIGN KEY (`products_fk`)
    REFERENCES `dw3_neglia_mateo`.`products` (`product_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_products_has_tags_tags1`
    FOREIGN KEY (`tags_fk`)
    REFERENCES `dw3_neglia_mateo`.`tags` (`tag_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
--
-- Volcado de datos para la tabla `products_has_tags`
--
INSERT INTO `products_has_tags` (`products_fk`, `tags_fk`) VALUES
(1, 3),
(2, 1),
(3, 1),
(4, 1),
(5, 5),
(6, 2),
(7, 2),
(8, 2);

--
--
--

-- -----------------------------------------------------
-- Table `dw3_neglia_mateo`.`retrive_password`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dw3_neglia_mateo`.`retrive_password` (
  `user_fk` INT UNSIGNED NOT NULL,
  `token` VARCHAR(255) NOT NULL,
  `expiration` DATETIME NOT NULL,
  PRIMARY KEY (`user_fk`),
  CONSTRAINT `fk_retrive_password_users1`
    FOREIGN KEY (`user_fk`)
    REFERENCES `dw3_neglia_mateo`.`users` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

--
-- Volcado de datos para la tabla `recuperar_passwords`
--

INSERT INTO `retrive_password` (`user_fk`, `token`, `expiration`) VALUES
(1, '5d37260818baf719a3770fa885d72e27369db4df1a98c615eb8a703902d3a0a5', '2024-06-02 21:10:25');

-- --------------------------------------------------------
-- -----------------------------------------------------
-- Table `dw3_neglia_mateo`.`purchases`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dw3_neglia_mateo`.`purchases` (
  `purchase_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_name` VARCHAR(150) NOT NULL,
  `product_quantity` INT NOT NULL,
  `product_price` DECIMAL(10,2) NOT NULL,
  `user_fk` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`purchase_id`),
  INDEX `fk_purchases_users1_idx` (`user_fk` ASC),
  CONSTRAINT `fk_purchases_users1`
    FOREIGN KEY (`user_fk`)
    REFERENCES `dw3_neglia_mateo`.`users` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
--
--
-- 

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
