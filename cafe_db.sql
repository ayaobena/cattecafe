

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `catbooking_tbl` (
  `booking_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `areabooking_id` int(11) NOT NULL,
  `booking_date` date NOT NULL,
  `booking_time` time NOT NULL,
  `booking_status` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
--

INSERT INTO `catbooking_tbl` (`booking_id`, `customer_id`, `cat_id`, `areabooking_id`, `booking_date`, `booking_time`, `booking_status`) VALUES
(1, 1, 1, 1, '2026-06-08', '14:30:54', 'Pending'),
(2, 1, 1, 2, '2026-06-08', '14:35:37', 'Pending'),
(3, 1, 1, 3, '2026-06-08', '14:41:42', 'Pending'),
(4, 1, 1, 3, '2026-06-08', '14:41:42', 'Pending'),
(5, 1, 1, 4, '2026-06-08', '14:42:32', 'Pending'),
(6, 1, 1, 4, '2026-06-08', '14:42:32', 'Pending'),
(7, 1, 1, 4, '2026-06-08', '14:42:32', 'Pending'),
(8, 1, 1, 4, '2026-06-08', '14:42:32', 'Pending'),
(9, 1, 1, 4, '2026-06-08', '14:42:32', 'Pending'),
(10, 1, 1, 4, '2026-06-08', '14:42:32', 'Pending'),
(11, 1, 1, 4, '2026-06-08', '14:42:32', 'Pending'),
(12, 1, 1, 4, '2026-06-08', '14:42:32', 'Pending'),
(13, 1, 1, 4, '2026-06-08', '14:42:32', 'Pending'),
(14, 1, 1, 4, '2026-06-08', '14:42:32', 'Pending'),
(15, 1, 1, 1, '2026-06-09', '15:44:51', 'Pending'),
(16, 1, 1, 2, '2026-06-09', '15:46:22', 'Pending'),
(17, 1, 1, 2, '2026-06-09', '15:46:22', 'Pending'),
(18, 3, 1, 5, '2026-06-09', '20:31:19', 'Pending'),
(19, 3, 1, 5, '2026-06-09', '20:31:19', 'Pending'),
(20, 3, 1, 6, '2026-06-09', '21:05:11', 'Pending'),
(21, 3, 1, 6, '2026-06-09', '21:05:11', 'Pending'),
(22, 3, 10, 1, '2026-06-18', '06:15:00', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `cat_tbl`
--

CREATE TABLE `cat_tbl` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(100) NOT NULL,
  `breed` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `img` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
--

INSERT INTO `cat_tbl` (`cat_id`, `cat_name`, `breed`, `age`, `gender`, `img`, `description`) VALUES
(1, 'Luna', 'Ginger Cat', 2, 'Male', 'C:\\wamp64\\www\\cafe\\Cat\\Luna.jpg', 'A friendly ginger cat who loves meeting cafe visitors.'),
(2, 'appleranger', 'puspin', 3, 'Female', 'C:\\wamp64\\www\\cafe\\Cat\\appleranger.jpg', 'A sweet and playful puspin who enjoys exploring every corner.'),
(3, 'biscuit', 'Puspin', 1, 'Female', 'C:\\wamp64\\www\\cafe\\Cat\\biscuit.jpg', 'A curious kitten with a gentle and affectionate personality.'),
(4, 'blacky', 'puspin', 3, 'female', 'C:\\wamp64\\www\\cafe\\Cat\\blacky.jpg', 'A calm black cat who enjoys relaxing in cozy spaces.'),
(5, 'brownie', 'puspin', 1, 'Female', 'C:\\wamp64\\www\\cafe\\Cat\\brownie.jpg', 'A playful young cat with endless energy and charm.'),
(6, 'chicken', 'sphynx', 2, 'Male', 'C:\\wamp64\\www\\cafe\\Cat\\chicken.jpg', 'A unique sphynx cat who loves warm spots and attention.'),
(7, 'coco', 'puspin', 4, 'Male', 'C:\\wamp64\\www\\cafe\\Cat\r\n\\coco.jpg', 'A relaxed and friendly cat who enjoys quiet afternoons.'),
(8, 'dahyun', 'puspin', 3, 'Male', 'C:\\wamp64\\www\\cafe\\Cat\\dahyun.jpg', 'A lovable companion who greets guests with curiosity.'),
(9, 'el gato', 'puspin', 5, 'Male', 'C:\\wamp64\\www\\cafe\\Cat\\el gato.jpg', 'A confident cat with a big personality and a playful spirit.'),
(10, 'gatito', 'puspin', 3, 'Female', 'C:\\wamp64\\www\\cafe\\Cat\\gatito.jpg', 'A gentle female cat who loves cuddles and treats.'),
(11, 'holy', 'puspin', 5, 'Female', 'C:\\wamp64\\www\\cafe\\Cat\\holy.jpg', 'A graceful cat known for her calm and loving nature.'),
(12, 'kit', 'puspin', 1, 'Male', 'C:\\wamp64\\www\\cafe\\Cat\\kit.jpg', 'An energetic young cat who enjoys chasing toys.'),
(13, 'loki', 'puspin', 6, 'Male', 'C:\\wamp64\\www\\cafe\\Cat\\loki.jpg', 'An adventurous cat who is always ready to explore.'),
(14, 'mango', 'puspin', 2, 'Female', 'C:\\wamp64\\www\\cafe\\Cat\\mango.jpg', 'A sweet and friendly cat with a cheerful personality.'),
(15, 'marshmallow', 'puspin', 2, 'Female', 'C:\\wamp64\\www\\cafe\\Cat\\marshmallow.jpg', 'A fluffy cat who enjoys naps and cozy blankets.'),
(16, 'meowgry', 'puspin', 2, 'Male', 'C:\\wamp64\\www\\cafe\\Cat\\meowgry.jpg', 'A curious foodie who is always looking for snacks.'),
(17, 'milo', 'puspin', 4, 'Female', 'C:\\wamp64\\www\\cafe\\Cat\\milo.jpg', 'A gentle and affectionate cat who loves human company.'),
(18, 'mingming', 'puspin', 2, 'Male', 'C:\\wamp64\\www\\cafe\\Cat\\mingming.jpg', 'A playful cat who brightens everyones day.'),
(19, 'mochi', 'puspin', 2, 'Male', 'C:\\wamp64\\www\\cafe\\Cat\\mochi.jpg', 'A charming cat with a soft coat and friendly attitude.'),
(20, 'neko', 'puspin', 2, 'Male', 'C:\\wamp64\\www\\cafe\\Cat\\neko.jpg', 'A calm and observant cat who enjoys peaceful surroundings.'),
(21, 'nugget', 'puspin', 2, 'Male', 'C:\\wamp64\\www\\cafe\\Cat\\nugget.jpg', 'A small but brave cat full of energy and curiosity.'),
(22, 'oreo', 'Puspin', 1, 'Female', 'C:\\wamp64\\www\\cafe\\Cat\\oreo.jpg', 'A playful black and white cat who loves attention.'),
(23, 'peanut', 'puspin', 1, 'Female', 'C:\\wamp64\\www\\cafe\\Cat\\peanut.jpg', 'A tiny cat with a big personality and endless charm.'),
(24, 'pumpkin', 'puspin', 3, 'Male', 'C:\\wamp64\\www\\cafe\\Cat\\pumpkin.jpg', 'A cheerful orange cat who enjoys meeting new people.'),
(25, 'sailormoon', 'puspin', 1, 'Male', 'C:\\wamp64\\www\\cafe\\Cat\\sailormoon.jpg', 'A playful young cat inspired by adventure and fun.'),
(26, 'sushi', 'puspin', 2, 'Male', 'C:\\wamp64\\www\\cafe\\Cat\\sushi.jpg', 'A relaxed cat who enjoys long naps and quiet company.'),
(27, 'tiger', 'puspin', 2, 'Male', 'C:\\wamp64\\www\\cafe\\Cat\\tiger.jpg', 'A striped cat with a confident and friendly nature.'),
(28, 'tik', 'puspin', 5, 'Male', 'C:\\wamp64\\www\\cafe\\Cat\\tik.jpg', 'A wise and calm cat who enjoys watching the world go by.'),
(29, 'toungi', 'puspin', 2, 'Female', 'C:\\wamp64\\www\\cafe\\Cat\\toungi.jpg', 'A sweet female cat who loves affection and treats.'),
(30, 'whitey', 'puspin', 2, 'Male', 'C:\\wamp64\\www\\cafe\\Cat\\whitey.jpg', 'A handsome white cat with a gentle personality.');

-- --------------------------------------------------------

--
--

CREATE TABLE `customer_tbl` (
  `customer_id` int(11) NOT NULL,
  `Fname` varchar(100) NOT NULL,
  `Mname` varchar(100) NOT NULL,
  `Lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` int(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
--

INSERT INTO `customer_tbl` (`customer_id`, `Fname`, `Mname`, `Lname`, `email`, `contact`, `password`, `role`) VALUES
(1, 'aya', 'Bobadilla', 'Obena', 'abc@gmail.com', 912345678, '$2y$10$7oGRg/vi5nrG/rtdnR5c..pM7xjaZBp99Aj0PdqKzVXaCsdN28TY.', 'user'),
(2, 'Jhon ', '', 'Mackay', 'mackay@gmail.com', 993736322, '$2y$10$AOqPcIdrB4Zw9n6Tfi6WW.4p98PmBAr0vGE5GysMHSAm/TiZ8O2UC', 'user'),
(3, 'Jhon', 'Drei', 'Mackay', 'mackayjhondrei632@gmail.com', 2147483647, '$2y$10$NQKlaE.hM/PQzZCHF72Dk.z8Q7a7enajm/9RtMPItHmj3XUjlIJRS', 'user');

-- --------------------------------------------------------

--
--

CREATE TABLE `delivery_tbl` (
  `delivery_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `delivery_address` varchar(100) NOT NULL,
  `recipient_name` varchar(100) DEFAULT NULL,
  `contact_number` int(11) NOT NULL,
  `delivery_status` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
--

INSERT INTO `delivery_tbl` (`delivery_id`, `customer_id`, `delivery_address`, `recipient_name`, `contact_number`, `delivery_status`) VALUES
(1, 758980, '123street', 'jodi', 995891562, 'Pending'),
(2, 1, '1234street', 'Jodi Rosenda Pampilon Montemayor', 995891562, 'Pending'),
(3, 1, '12345street', 'jhondrei mackay', 995891562, 'Pending'),
(4, 1, '123456street', 'jhondrei mackay', 995891562, 'Pending'),
(5, 1, '123456street', 'jhondrei mackay', 995891562, 'Pending'),
(6, 1, '12345street', 'jhondrei mackay', 995891562, 'Pending'),
(7, 3, '#123 Zone 1', 'Jhon Drei', 2147483647, 'Pending'),
(8, 3, '1234 fgafe', 'Jhon Drei', 2147483647, 'Pending'),
(9, 3, 'atsvreafeef', 'Jhon Drei', 2147483647, 'Pending'),
(10, 3, '\'avadvap\' adpvad', 'Jhon Drei', 2147483647, 'Pending'),
(11, 3, 'ywhdiwneejk3', 'Jhon Drei Mackay', 2147483647, 'Pending'),
(12, 3, '123 Miguel Antonio Street', 'Jhon Drei Mackay', 2147483647, 'Pending');

-- --------------------------------------------------------

--
--

CREATE TABLE `menuitem_tbl` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
--

INSERT INTO `menuitem_tbl` (`item_id`, `item_name`, `category`, `price`, `image`, `description`) VALUES
(1, 'Lotus Biscoff Cookie', 'Cookie', 125.00, 'Cookies/Lotus.jpg', 'Soft-baked brown butter cookie loaded with crushed...'),
(2, 'Pink Birthday Cake Cookie', 'Cookie', 110.00, 'Cookies/birthday.jpg', 'Funfetti-speckled sweet cream cookie topped with s...'),
(3, 'White Chocolate Macadamia Cookie', 'Cookie', 130.00, 'Cookies/White.jpg', 'Classic rich recipe featuring buttery macadamia nu...'),
(4, 'Cookies & Cream Cookie', 'Cookie', 120.00, 'Cookies/Cookies & Cream.jpg', 'A dark cocoa dough base folded with crushed Oreo p...'),
(5, 'Classic Chocolate Chip Cookie', 'Cookie', 95.00, 'Cookies/classic.jpg', 'Our timeless recipe, chewy on the inside with a cr...'),
(6, 'Frosted Animal Sugar Cookie', 'Cookie', 110.00, 'Cookies/frosted.jpg', 'Nostalgic melt-in-your-mouth sugar cookie topped w...'),
(7, 'Rocky Road Cookie', 'Cookie', 130.00, 'Cookies/rocky road.jpg', 'Double chocolate dough packed with mini marshmallo...'),
(8, 'Matcha White Chocolate Cookie', 'Cookie', 125.00, 'Cookies/matcha.jpg', 'Earthy premium Japanese Uji matcha base beautifull...'),
(9, 'Strawberry Cream Cookie', 'Cookie', 120.00, 'Cookies/strawberry.jpg', 'Delicate strawberry infused cookie dough layered w...'),
(10, 'Red Velvet Cookie', 'Cookie', 120.00, 'Cookies/red velvet.jpg', 'Striking crimson cocoa cookie with a soft, velvet ...'),
(11, 'Nutella Swirl Brownie', 'Brownie', 125.00, 'Brownies/Nutella.jpg', 'Rich fudge brownie swirled heavily with smooth haz...'),
(12, 'Ube White Chocolate Brownie', 'Brownie', 130.00, 'Brownies/Ube.jpg', 'Vibrant purple yam brownie providing a unique swee...'),
(13, 'Matcha Walnut Brownie', 'Brownie', 125.00, 'Brownies/Matcha.jpg', 'Fudgy premium green tea matcha blondie loaded up w...'),
(14, 'Cheesecake Brownie', 'Brownie', 130.00, 'Brownies/Cheesecake.jpg', 'Decadent dark chocolate brownie beautifully marble...'),
(15, 'Classic Fudge Brownie', 'Brownie', 105.00, 'Brownies/Classic.jpg', 'Our ultra-dense signature dark chocolate fudge bro...'),
(16, 'Salted Caramel Brownie', 'Brownie', 125.00, 'Brownies/Salted Caramel.jpg', 'Rich chocolate brownie layer smothered in an artis...'),
(17, 'Cookies & Cream Brownie', 'Brownie', 125.00, 'Brownies/Cookies & Cream.jpg', 'Deep dark cocoa brownie embedded with whole crushe...'),
(18, 'Smores Brownie', 'Brownie', 130.00, 'Brownies/Smore.jpg', 'Fudgy brownie base topped with a layer of honey gr...'),
(19, 'Red Velvet Brownie', 'Brownie', 125.00, 'Brownies/Red velvet.jpg', 'Stunning crimson fudgy cocoa brownie layered with...'),
(20, 'Walnut Fudge Brownie', 'Brownie', 115.00, 'Brownies/Walnut.jpg', 'A classic dark chocolate fudge brownie packed with...'),
(21, 'Carrot Cream Cake', 'Cake', 185.00, 'cake/Carrot.jpg', 'Spiced, moist cake layer packed with grated carrot...'),
(22, 'Chocolate Strawberry Cake', 'Cake', 210.00, 'cake/Chocolate Strawberry.jpg', 'Rich dark chocolate cake sponge separated by fresh...'),
(23, 'Red Velvet Cake', 'Cake', 185.00, 'cake/Red velvet.jpg', 'Classic light cocoa layer cake tinted a gorgeous r...'),
(24, 'Strawberry Shortcake', 'Cake', 195.00, 'cake/Strawberry.jpg', 'Light, airy vanilla sponge layered cleanly with fr...'),
(25, 'Chocolate Layer Cake', 'Cake', 210.00, 'cake/Chocolate.jpg', 'Decadent, sky-high triple chocolate sponge layered...'),
(26, 'Ube Cheesecake', 'Cake', 220.00, 'cake/Ube cheese cake.jpg', 'Creamy New York style cheesecake infused with auth...'),
(27, 'Classic Tiramisu', 'Cake', 195.00, 'cake/Tiramisu.jpg', 'Espresso-soaked ladyfingers layered elegantly with...'),
(28, 'Blueberry Cream Cake', 'Cake', 185.00, 'cake/Blueberry Cream.jpg', 'Sweet vanilla bean sponge cake layered with wild b...'),
(29, 'Blueberry Cheesecake', 'Cake', 220.00, 'cake/Blueberry cheesecake.jpg', 'Dense, velvety classic baked cream cheese cake cro...'),
(30, 'Matcha Layer Cake', 'Cake', 195.00, 'cake/Matcha.jpg', 'Delicate, earthy green tea sponge layers frosted l...'),
(31, 'Matcha Latte', 'Coffee', 175.00, 'Coffee/Matcha.jpg', 'Whisked premium ceremonial Japanese matcha green t...'),
(32, 'Cafe Latte', 'Coffee', 155.00, 'Coffee/Cafe Latte.jpg', 'Our rich signature espresso blend mellowed with si...'),
(33, 'Espresso', 'Coffee', 110.00, 'Coffee/Espresso.jpg', 'A concentrated, full-bodied double shot of our pre...'),
(34, 'Cafee Mocha', 'Coffee', 170.00, 'Coffee/Mocha.jpg', 'A perfect balance of robust espresso and decadent...'),
(35, 'Flat White', 'Coffee', 160.00, 'Coffee/Flat White.jpg', 'Expertly prepared double espresso shot combined wi...'),
(36, 'Iced Latte', 'Coffee', 165.00, 'Coffee/Iced .jpg', 'Chilled signature espresso served over ice, topped...'),
(37, 'Cappuccino', 'Coffee', 155.00, 'Coffee/Cappuccino.jpg', 'A balanced combination of bold espresso, silky ste...'),
(38, 'Caramel Macchiato', 'Coffee', 180.00, 'Coffee/Caramel.jpg', 'Creamy milk and espresso topped with sweet caramel...'),
(39, 'Dalgona Coffee', 'Coffee', 175.00, 'Coffee/Dalgona.jpg', 'Creamy milk and espresso topped with sweet caramel...'),
(40, 'Americano', 'Coffee', 150.00, 'Coffee/Americano.jpg', 'Smooth espresso blended with hot water for a bold,...');

-- --------------------------------------------------------

--
--

CREATE TABLE `orderdetails_tbl` (
  `orderDeatails_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
--

INSERT INTO `orderdetails_tbl` (`orderDeatails_id`, `order_id`, `item_id`, `quantity`, `sub_total`) VALUES
(1, 1, 11, 5, 625),
(2, 2, 1, 1, 125),
(3, 3, 11, 1, 125),
(4, 4, 11, 1, 125),
(5, 5, 11, 3, 375),
(6, 6, 11, 2, 250),
(7, 7, 11, 1, 125),
(8, 8, 11, 1, 125),
(9, 8, 14, 1, 130),
(10, 8, 5, 1, 95),
(11, 9, 11, 2, 250),
(12, 9, 14, 1, 130),
(13, 9, 40, 1, 150),
(14, 10, 12, 1, 130),
(15, 10, 13, 1, 125),
(16, 10, 11, 1, 125),
(17, 11, 40, 1, 150),
(18, 11, 29, 1, 220),
(19, 11, 11, 1, 125),
(20, 11, 14, 1, 130),
(21, 12, 40, 1, 150),
(22, 12, 29, 1, 220),
(23, 12, 11, 1, 125),
(24, 12, 14, 2, 260),
(25, 13, 11, 1, 125),
(26, 14, 11, 1, 125),
(27, 14, 13, 1, 125),
(28, 14, 15, 1, 105),
(29, 14, 16, 1, 125),
(30, 14, 14, 1, 130),
(31, 14, 12, 1, 130),
(32, 15, 11, 2, 250),
(33, 15, 13, 1, 125),
(34, 15, 15, 1, 105),
(35, 15, 16, 1, 125),
(36, 15, 14, 1, 130),
(37, 15, 12, 1, 130),
(38, 16, 11, 1, 125),
(39, 16, 31, 1, 175),
(40, 17, 11, 1, 125),
(41, 18, 11, 1, 125),
(42, 19, 11, 1, 125);

-- --------------------------------------------------------

--
--

CREATE TABLE `order_tbl` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_type` varchar(100) NOT NULL,
  `order_date` date NOT NULL,
  `total_amount` decimal(10,4) NOT NULL,
  `order_status` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
--

INSERT INTO `order_tbl` (`order_id`, `customer_id`, `order_type`, `order_date`, `total_amount`, `order_status`) VALUES
(1, 1, 'Pre-order', '2026-06-09', 625.0000, 'Pending'),
(2, 1, 'Pre-order', '2026-06-10', 125.0000, 'Pending'),
(3, 1, 'Pre-order', '2026-06-10', 125.0000, 'Pending'),
(4, 1, 'Pre-order', '2026-06-24', 125.0000, 'Pending'),
(5, 1, 'Pre-order', '2026-06-09', 375.0000, '0'),
(6, 1, 'Pre-order', '2026-06-18', 250.0000, '0'),
(7, 1, 'Pre-order', '2026-06-11', 125.0000, '0'),
(8, 3, 'Pre-order', '2026-06-11', 350.0000, '0'),
(9, 3, 'Delivery', '2026-06-09', 530.0000, 'Pending'),
(10, 3, 'Pre-order', '2026-06-10', 380.0000, '0'),
(11, 3, 'Pre-order', '2026-06-17', 625.0000, 'Confirmed'),
(12, 3, 'Pre-order', '2026-07-03', 755.0000, 'Pending'),
(13, 3, 'Pre-order', '2026-06-25', 125.0000, 'Pending'),
(14, 3, 'Delivery', '2026-06-12', 740.0000, 'Pending'),
(15, 3, 'Pre-order', '2026-06-18', 865.0000, 'Confirmed'),
(16, 3, 'Delivery', '2026-06-12', 300.0000, 'Pending'),
(17, 3, 'Pre-order', '2026-06-18', 125.0000, 'Pending'),
(18, 3, 'Pre-order', '2026-07-02', 125.0000, 'Pending'),
(19, 3, 'Pre-order', '2026-06-26', 125.0000, 'Pending');

-- --------------------------------------------------------

--
--

CREATE TABLE `payment_tbl` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `payment_method` varchar(50) NOT NULL DEFAULT 'Cash',
  `amount` decimal(10,2) NOT NULL,
  `payment_status` varchar(50) NOT NULL DEFAULT 'Pending',
  `payment_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
--

INSERT INTO `payment_tbl` (`payment_id`, `order_id`, `customer_id`, `payment_method`, `amount`, `payment_status`, `payment_date`) VALUES
(1, 1, 1, 'Cash', 625.00, 'Pending', '2026-06-07 22:30:57'),
(2, 2, 1, 'Cash', 125.00, 'Pending', '2026-06-07 22:35:39'),
(3, 3, 1, 'Cash', 125.00, 'Pending', '2026-06-07 22:41:47'),
(4, 4, 1, 'Cash', 125.00, 'Pending', '2026-06-07 22:42:33'),
(5, 5, 1, 'Cash', 375.00, 'Pending', '2026-06-07 23:36:22'),
(6, 6, 1, 'Cash', 250.00, 'Pending', '2026-06-09 00:17:53'),
(7, 7, 1, 'Cash', 125.00, 'Pending', '2026-06-09 00:24:43'),
(8, 8, 3, 'Cash', 350.00, 'Pending', '2026-06-09 12:31:24'),
(9, 4778, 3, 'Cash', 0.00, 'Pending', '2026-06-09 12:37:25'),
(10, 4869, 3, 'PayPal', 125.00, 'Completed', '2026-06-09 12:38:12'),
(11, 5375, 3, 'PayPal', 125.00, 'Completed', '2026-06-09 12:42:34'),
(12, 9, 3, 'PayPal', 530.00, 'Completed', '2026-06-09 12:59:26'),
(13, 10, 3, 'Cash', 380.00, 'Pending', '2026-06-09 13:06:29'),
(14, 11, 3, 'PayPal', 625.00, 'Paid', '2026-06-12 05:39:02'),
(15, 12, 3, 'Cash', 755.00, 'Pending', '2026-06-12 05:45:04'),
(16, 13, 3, 'Cash', 125.00, 'Pending', '2026-06-12 05:53:58'),
(17, 14, 3, 'PayPal', 740.00, 'Completed', '2026-06-12 05:54:44'),
(18, 15, 3, 'PayPal', 865.00, 'Paid', '2026-06-12 05:55:16'),
(19, 16, 3, 'Cash', 300.00, 'Pending', '2026-06-12 06:02:21'),
(20, 17, 3, 'Cash', 125.00, 'Pending', '2026-06-12 06:11:13'),
(21, 18, 3, 'Cash', 125.00, 'Pending', '2026-06-12 06:23:57'),
(22, 19, 3, 'Cash', 125.00, 'Pending', '2026-06-12 06:38:28');

-- --------------------------------------------------------

--
--

CREATE TABLE `stock_tbl` (
  `stock_id` int(11) NOT NULL,
  `menuitem_id` int(11) NOT NULL,
  `quantity_available` int(11) NOT NULL DEFAULT 0,
  `reorder_level` int(11) NOT NULL DEFAULT 10,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
--

INSERT INTO `stock_tbl` (`stock_id`, `menuitem_id`, `quantity_available`, `reorder_level`, `last_updated`) VALUES
(1, 1, 50, 10, '2026-06-12 06:21:49'),
(2, 2, 50, 10, '2026-06-12 06:21:49'),
(3, 3, 50, 10, '2026-06-12 06:21:49'),
(4, 4, 50, 10, '2026-06-12 06:21:49'),
(5, 5, 50, 10, '2026-06-12 06:21:49'),
(6, 6, 50, 10, '2026-06-12 06:21:49'),
(7, 7, 50, 10, '2026-06-12 06:21:49'),
(8, 8, 50, 10, '2026-06-12 06:21:49'),
(9, 9, 50, 10, '2026-06-12 06:21:49'),
(10, 10, 50, 10, '2026-06-12 06:21:49'),
(11, 11, 49, 10, '2026-06-12 06:38:28'),
(12, 12, 50, 10, '2026-06-12 06:21:49'),
(13, 13, 50, 10, '2026-06-12 06:21:49'),
(14, 14, 50, 10, '2026-06-12 06:21:49'),
(15, 15, 50, 10, '2026-06-12 06:21:49'),
(16, 16, 50, 10, '2026-06-12 06:21:49'),
(17, 17, 50, 10, '2026-06-12 06:21:49'),
(18, 18, 50, 10, '2026-06-12 06:21:49'),
(19, 19, 50, 10, '2026-06-12 06:21:49'),
(20, 20, 50, 10, '2026-06-12 06:21:49'),
(21, 21, 50, 10, '2026-06-12 06:21:49'),
(22, 22, 50, 10, '2026-06-12 06:21:49'),
(23, 23, 50, 10, '2026-06-12 06:21:49'),
(24, 24, 50, 10, '2026-06-12 06:21:49'),
(25, 25, 50, 10, '2026-06-12 06:21:49'),
(26, 26, 50, 10, '2026-06-12 06:21:49'),
(27, 27, 50, 10, '2026-06-12 06:21:49'),
(28, 28, 50, 10, '2026-06-12 06:21:49'),
(29, 29, 50, 10, '2026-06-12 06:21:49'),
(30, 30, 50, 10, '2026-06-12 06:21:49'),
(31, 31, 50, 10, '2026-06-12 06:21:49'),
(32, 32, 50, 10, '2026-06-12 06:21:49'),
(33, 33, 50, 10, '2026-06-12 06:21:49'),
(34, 34, 50, 10, '2026-06-12 06:21:49'),
(35, 35, 50, 10, '2026-06-12 06:21:49'),
(36, 36, 50, 10, '2026-06-12 06:21:49'),
(37, 37, 50, 10, '2026-06-12 06:21:49'),
(38, 38, 50, 10, '2026-06-12 06:21:49'),
(39, 39, 50, 10, '2026-06-12 06:21:49'),
(40, 40, 50, 10, '2026-06-12 06:21:49');

--

ALTER TABLE `catbooking_tbl`
  ADD PRIMARY KEY (`booking_id`);

--
--
ALTER TABLE `cat_tbl`
  ADD PRIMARY KEY (`cat_id`);

--
--
ALTER TABLE `customer_tbl`
  ADD PRIMARY KEY (`customer_id`);

--
--
ALTER TABLE `delivery_tbl`
  ADD PRIMARY KEY (`delivery_id`);

--
--
ALTER TABLE `menuitem_tbl`
  ADD PRIMARY KEY (`item_id`);

--
-
ALTER TABLE `orderdetails_tbl`
  ADD PRIMARY KEY (`orderDeatails_id`);

--
--
ALTER TABLE `order_tbl`
  ADD PRIMARY KEY (`order_id`);

--
--
ALTER TABLE `payment_tbl`
  ADD PRIMARY KEY (`payment_id`);

--
--
ALTER TABLE `stock_tbl`
  ADD PRIMARY KEY (`stock_id`);

--
--

--
--
ALTER TABLE `catbooking_tbl`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
--
ALTER TABLE `cat_tbl`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
--
ALTER TABLE `customer_tbl`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
--
ALTER TABLE `delivery_tbl`
  MODIFY `delivery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
--
ALTER TABLE `menuitem_tbl`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
--
ALTER TABLE `orderdetails_tbl`
  MODIFY `orderDeatails_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
--
ALTER TABLE `order_tbl`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
--
ALTER TABLE `payment_tbl`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
--
ALTER TABLE `stock_tbl`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

