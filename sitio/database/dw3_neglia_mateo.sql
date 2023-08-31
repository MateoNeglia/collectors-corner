-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-06-2022 a las 18:32:57
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dw3_neglia_mateo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `user_fk` int(10) UNSIGNED DEFAULT NULL,
  `publish_datetime` datetime NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `img_large` varchar(255) DEFAULT NULL,
  `img_lore` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`product_id`, `user_fk`, `publish_datetime`, `name`, `description`, `price`, `img`, `img_large`, `img_lore`) VALUES
(1, 1, '2020-04-25 20:20:15', 'The Lord of the Rings: The Motion Picture Trilogy (Extended Editions) [Blu-ray]', 'The Quest Is Over: All three extended versions in dazzling 1080p and DTS HD-MA 5.1 Audio. Deluxe set includes over 26 Hours of spellbinding behind-the- moviemaking material, including the Rare Costa Botes documentaries, on 15 discs.', '65.25', 'lotred-cover.jpg', 'lotred-cover-large.jpg', 'dvd boxes of the lord of the rings box set'),
(2, 3, '2020-04-26 20:20:15', 'Digimon Adventure: Last Evolution Kizuna [Blu-ray]', 'Join the last adventure of Tai and Agumon! An unprecedented phenomenon occurs and the DigiDestined discover that growing up means an end to their relationships with their Digimon. On top of that, the DigiDestined realize that the more they fight with their Digimon, the faster their bond breaks. Will they fight for others and risk losing? The time to choose and decide is approaching fast. Tai and Agumon, along with the rest, will be forced to risk everything in their epic last adventure.', '13.00', 'kizuna-cover.jpg', 'kizuna-cover-large.jpg', 'Dvds and dvd boxes of the digimon box set'),
(3, 1, '2020-04-27 20:20:15', 'Gurren Lagann: Part 1 (Limited Edition DVD + Artbox + LED Light)', 'In his sky-less cavern of a village Simon toils daily, drilling holes to expand his stifling little world until one day he makes an extraordinary discovery, a small glowing drill-bit and the man-sized mecha it activates. Before he can give it a second thought Simon is dragged into a plot to break through to the surface by the local gang leader Kamina, only to have the ceiling come crashing down on top of them under the weight of a giant monster! It somehow falls onto the boisterous Kamina and the cowardly Simon to defend their village but once they defeat the monster what awaits the duo on the surface world? Get ready for buxom babes, beastmen, and giant mecha as only GAINAX can provide them! BUST THROUGH THE HEAVENS WITH YOUR SOUL, GURREN LAGANN!', '300.00', 'box-set-ttgl.jpg', 'box-set-ttgl-large.jpg', 'dvd boxes and covers of the gurren lagann box set'),
(4, 4, '2020-04-28 20:20:15', 'Digimon Tamers (Digital Monsters Season 3) [DVD] [NTSC]', 'Takato Matsuki, Rika Nonaka, and Henry Wong are children who, on one fateful day, received real Digimon, unlike the imaginary ones in the card game they play. Each of the children, or \'Digimon Tamers\', have their different views on how Digimon should be treated. But when other Digimon begin to appear around Japan, they must put aside their differences to fend off both the digital intruders and those who seek to destroy all Digimon!', '27.00', 'digimon-tamers-cover.jpg', 'digimon-tamers-cover-large.jpg', 'dvd cover of the digimon tamers season'),
(5, 3, '2020-04-29 20:20:15', 'Underworld Limited Edition 5-movie collection - Set [4K UHD]', 'Experience all five films in the iconic Underworld series on Blu-Ray in the ultimate Underworld collection!', '80.00', 'box-set-underworld-cover.jpg', 'box-set-underworld-cover-large.jpg', 'box set content of the underworld series dvds'),
(6, 4, '2020-05-25 20:20:15', 'Doctor Who: The Complete David Tennant Collection (Blu-ray)', 'Experience all the life of the best Doctor on the screen at the best price. The box contains season 2 to 4 and the specials.', '18.00', 'doctor-who-david-tennant-cover.jpg', 'doctor-who-david-tennant-cover-large.jpg', 'Dvd cover of the Tennant years doctor who box set'),
(7, 1, '2020-05-26 20:20:15', 'Battlestar Galactica: The Definitive Collection [Blu-ray]', 'The ultimate collection for the classic series that launched one of the most beloved sci-fi franchises of all time, enjoy Battlestar Galactica in both its original television format and in widescreen format for the first time—all in high-definition! Battlestar Galactica: The Original Series: Hopeful for lasting peace following centuries of intense warfare, the Twelve Colonies gather to sign a treaty with their dreaded enemies, the Cylons. But after an act of treachery on the eve of the ceremony, the Cylons launch a devastating surprise attack, destroying the Colonies\' home planets and most of their military strength. A lone flagship battlestar, the Galactica, remains to aid the surviving colonists on their epic journey for a new home to a far-off legendary planet—Earth. Galactica 1980: The Complete Series: 30 years after the events of Battlestar Galactica, the original crew finally makes the long-anticipated descent to Earth. With time running out and the Cylons closing in on their trail, Commander Adama and the Galactica must work harder than ever before to help Earth create the technology necessary for battle. Battlestar Galactica: The Original Movie: The original movie that started it all, this theatrical version of the pilot episode includes several alternate scenes different from the televised version.', '80.00', 'battlestar-galactica-tdc.jpg', 'battlestar-galactica-tdc-large.jpg', 'box set cover art of the definitive collection of BTSG'),
(8, 3, '2020-05-27 20:20:15', 'Star Trek: Deep Space Nine: The Complete Series', 'The stable wormhole discovered by the Deep Space Nine crew is known to the Bajoran people as the Celestial Temple of their Prophets. Sisko, as discoverer of the wormhole and its inhabitants, is therefore the Emissary of Bajoran prophesy. The wormhole\'s other end is in the Gamma Quadrant, halfway around the galaxy from Bajor. That section of space is dominated by the malevolent Dominion. The Dominion is led by the Changelings, the race of shapeshifters to which Odo belongs. As of the beginning of the sixth season, Cardassia has joined the Dominion, and together they are waging war on the Federation and their Klingon allies. The war is quickly becoming the most costly war ever for the Federation, and the Deep Space Nine crew must fight to protect their way of life. SCREENED/AWARDED AT: Emmy Awards, ...Star Trek: Deep Space Nine (Complete Series) - 48-DVD Boxset ( Star Trek: DS9 - Complete Series )', '85.00', 'star-trek-ds9-complete-series.jpg', 'star-trek-ds9-complete-series-large.jpg', 'Box set cover art of the complete series of Star Trek DS9');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products_has_tags`
--

CREATE TABLE `products_has_tags` (
  `products_fk` int(10) UNSIGNED NOT NULL,
  `tags_fk` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tags`
--

CREATE TABLE `tags` (
  `tag_id` tinyint(3) UNSIGNED NOT NULL,
  `tag_name` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(65) DEFAULT NULL,
  `last_name` varchar(65) DEFAULT NULL,
  `nick_name` varchar(65) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `name`, `last_name`, `nick_name`) VALUES
(1, 'admin@collector.com', '$2y$10$tu7ws/uOl6fWYu8jtBfKBeELaBmKCBrm287DUklmNd.iTsb8npyo2', 'Admin', 'Admin', 'Admin'),
(2, 'nullcheck@collector.com', '$2y$10$VkwDjpTtGltdF9vag./B4uUpp41D4f39cmXlvWsFgiwUzCxiaUo76', NULL, NULL, NULL),
(3, 'mod1@collector.com', '$2y$10$UTCPQwtBAygCuW3h7KuA8eR.cc5/eynizowc3.uepjL1rfMOZkwCa', 'Mod1', 'Mod1', 'Mod1'),
(4, 'mod2@collector.com', '$2y$10$p3KXQp.aYcwIxgWruXFT.eFjSX1AtKd0EvWKUIQljfNhBJIEtqI86', 'Mod2', 'Mod2', 'Mod2'),
(5, 'mod3@collector.com', '$2y$10$W1JN7wpF6aM7eA51da1SKOBwJUEDUbub5IiCTd4jS39PPuuqaFnwa', 'Mod3', 'Mod3', 'Mod3'),
(6, 'testmail@gmail.com', '$2y$10$p3KXQp.aYcwIxgWruXFT.eFjSX1AtKd0EvWKUIQljfNhBJIEtqI86', NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_products_users_idx` (`user_fk`);

--
-- Indices de la tabla `products_has_tags`
--
ALTER TABLE `products_has_tags`
  ADD PRIMARY KEY (`products_fk`,`tags_fk`),
  ADD KEY `fk_products_has_tags_tags1_idx` (`tags_fk`),
  ADD KEY `fk_products_has_tags_products1_idx` (`products_fk`);

--
-- Indices de la tabla `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_users` FOREIGN KEY (`user_fk`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `products_has_tags`
--
ALTER TABLE `products_has_tags`
  ADD CONSTRAINT `fk_products_has_tags_products1` FOREIGN KEY (`products_fk`) REFERENCES `products` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_products_has_tags_tags1` FOREIGN KEY (`tags_fk`) REFERENCES `tags` (`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
