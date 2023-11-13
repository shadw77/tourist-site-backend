-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3310
-- Generation Time: Nov 13, 2023 at 10:46 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iti_tourist`
--

-- --------------------------------------------------------

--
-- Table structure for table `custom_notifications`
--

CREATE TABLE `custom_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `notifiable_type` varchar(191) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `rating` varchar(191) NOT NULL,
  `creator_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`id`, `name`, `description`, `thumbnail`, `rating`, `creator_id`, `created_at`, `updated_at`) VALUES
(1, 'Sharm El Sheikh', 'Diverse marine life and hundreds of Red Sea coral reef sites make Sharm El Sheikh a magnet for divers and eco-tourists. The tourist economy of this Sinai Peninsula city has grown quite rapidly over the last few decades, resulting in an upcrop of first-class resorts and posh nightlife. The waters of Ras Mohamed National Park are abundant with schools of fish and, oddly, toilets – thanks to the bathroom fixtures being transported by a cargo ship that sank during a 1981 storm', '1699815523_ras-mohammed-park.jpg', '4', 2, '2023-11-12 16:58:42', '2023-11-12 17:10:00'),
(2, 'Hurghada', 'Stunning coral reefs and turquoise waters perfect for windsurfing have made Hurghada, on Egypt\'s Red Sea Coast, a busy resort town. Within easy reach of the stunning Giftun Islands and the Eastern Arabian Desert, Hurghada has seen enormous amounts of development in the past decade—and yes, it does seem overrun with tourists at times. But it’s a relatively easy beach escape for Europeans, and some of the world\'s best diving and snorkeling sites are just offshore. Walk or catch a cab to explore the old quarter, El Dahar.', '1699815741_giftun-islands-red-sea.jpg', '3', 2, '2023-11-12 17:02:21', '2023-11-12 17:11:41'),
(3, 'Cairo', 'Cairo’s an ancient city that also happens to be a modern metropolis—it’s one of the biggest cities in the Middle East and has the traffic and noise issues to prove it. But as long as you’re not looking for solitude, Cairo—the City of the Thousand Minarets—is a splendid place to explore Egyptian history and culture. (Editor\'s note: Our list was compiled before political unrest prompted many countries to issue travel warnings for Egypt. If you\'re currently planning a trip to Egypt, please consider the risks and monitor your government\'s travel alerts.', '1699815800_cairo.jpg', '3', 2, '2023-11-12 17:03:20', '2023-11-12 17:12:06'),
(4, 'Ain Sukhna', 'El Ain El Sokhna is one of the most beautiful destinations to visit while in Egypt. This coastal village has been developed as a beach getaway for Cairo, accessible by a trip of less than two hours from the city. To cruise passengers, El Ain El Sukhna provides easy access to all of the sights of Cairo from the Giza Pyramids and Egyptian Museum to the Islamic Cairo', '1699816074_ain-sukhna.jpg', '2', 2, '2023-11-12 17:07:54', '2023-11-12 17:07:54'),
(5, 'Mersa Matruh', 'Mersa Matruh is protected by a ring of natural rocks some seven kilometres long which acts as a breakwater; the sea, therefore, as well as being spectacular due to its intense turquoise colour, is always calm. Many of the beaches have evocative names: Cleopatra beach, in honour of the beautiful queen who loved to bathe in this sea.', '1699816396_beach-area.jpg', '2', 2, '2023-11-12 17:13:16', '2023-11-12 17:13:16'),
(6, 'Alexandria', 'The Pearl of the Mediterranean has an ambiance more in keeping with its neighbors to the north than with those in the Middle East. Site of Pharos lighthouse, one of the Wonders of the World, and of Anthony and Cleopatra’s tempestuous romance, the city was founded by Alexander the Great in 331 BCE. Today, Alexandria offers fascinating insights into its proud Greek past, as well as interesting mosques, the casino strip of the Corniche, some lovely gardens and both modern and traditional hotels. (Editor\'s note: Our list was compiled before political unrest prompted many countries to issue travel warnings for Egypt. If you\'re currently planning a trip to Egypt, please consider the risks and monitor your government\'s travel alerts.', '1699816628_alexandria.jpg', '5', 2, '2023-11-12 17:17:08', '2023-11-12 17:17:08'),
(7, 'Marsa Alam', 'Thanks to the addition of an international airport in 2001, Marsa Alam is fast becoming a premium tourist destination, especially for scuba divers. The waters here are brimming with marine life and pristine dive sites. Landlubbers, don’t miss the Emerald Mines and the Temple of Seti I at Khanais.', '1699816701_bigphotoformarsa-alam.jpg', '3', 2, '2023-11-12 17:18:21', '2023-11-12 17:18:21'),
(8, 'El Alamein', 'The Battle of El Alamein was the largest conflict to take place in Africa during World War II and a significant turning point in the war. Before General Bernard Montgomery and the British 8th Army defeated Field Marshall Erwin Rommel and his German tank divisions, the Allies had not experienced a significant success on any front during the war. Montgomery’s army stopped the German advance toward Alexandria and Cairo, ensuring the safety of Egypt. The battle signaled the beginning of the end of Germany’s campaign in North Africa, guaranteeing the Allies control of the Suez Canal and the Middle East’s oil fields and significantly shifting the momentum of the war in favor of the Allies.', '1699816743_the-marina--v9514476.jpg', '2', 2, '2023-11-12 17:19:03', '2023-11-12 17:19:03'),
(9, 'Dahab', 'This former Bedouin fishing village is now a popular tourist destination—especially for serious windsurfers,who\'ll find some of the best conditions in the world off Dahab\'s beaches. Long known as a laid-back,backpacker-friendly town, Dahab is becoming more developed, yet retains a casual vibe. Finally,Dahab is also home to the Blue Hole, the world\'s most dangerous dive site.', '1699816780_a-view-from-the-mountain.jpg', '4', 2, '2023-11-12 17:19:40', '2023-11-12 17:19:40'),
(10, 'Luxor', 'At the height of the Ancient Egyptian New Kingdom (1549—1069 BC) its capital, Thebes (Luxor), was a city of over a million people. The pharaohs that ruled over this kingdom were made wealthy by military successes that expanded their influence south into Nubia, west along the Mediterranean, and east into modern-day Syria', '1699816823_b145de4d72cd7da8b329e85ddcb33a10.jpg', '5', 2, '2023-11-12 17:20:23', '2023-11-12 17:20:23'),
(11, 'Aswan', 'Aswan provides a much more relaxed experience. It is the smallest of Egypt’s major touristic cities, but it also bears the distinctive mark of the more relaxed Nubian culture. Those interested in Pharaonic history cannot pass up Aswan because of the impressive Philae Temple nearby, located on an island behind the old Aswan Dam, and the famous Abu Simbel Temples several hours south along the banks of Lake Nasser.', '1699816998_download.jpg', '5', 2, '2023-11-12 17:23:18', '2023-11-12 17:23:18');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` text NOT NULL,
  `street` varchar(191) NOT NULL,
  `government` varchar(191) NOT NULL,
  `thumbnail` varchar(191) NOT NULL,
  `rating` varchar(191) DEFAULT NULL,
  `cost` varchar(191) NOT NULL,
  `discount` varchar(191) DEFAULT NULL,
  `available` tinyint(1) NOT NULL DEFAULT 1,
  `creator_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `name`, `description`, `street`, `government`, `thumbnail`, `rating`, `cost`, `discount`, `available`, `creator_id`, `created_at`, `updated_at`) VALUES
(1, 'Egyptian Nile Cairo', 'All rooms at the hotel come with air conditioning, a seating area,\r\n        a flat-screen TV with satellite channels, a safety deposit box and a private bathroom with a shower, a hairdryer and slippers. Rooms are equipped with a kettle, while some rooms have a kitchen with a fridge, a microwave and a toaster. At Egyptian Nile Cairo rooms are fitted with bed linen and towels', '69 abdelasis street', 'Cairo', '1699867903_490884915.jpg', NULL, '3059', '5', 1, 2, '2023-11-13 07:31:43', '2023-11-13 07:31:43'),
(2, 'Hilton Cairo Heliopolis Hotel', 'Hilton Cairo Heliopolis Hotel features a Casino, and a hot tub.\r\n       It has 3 swimming pools surrounded by a landscaped garden. WiFi is available in all\r\n        rooms with charge and free in the Lobby and Restaurant', 'Uruba Street, Heliopolis, Heliopolis, Cairo, Egypt', 'Cairo', '1699867978_491882641.jpg', NULL, '5716', '5', 1, 2, '2023-11-13 07:32:58', '2023-11-13 07:32:58'),
(3, 'Novotel Cairo Airport', 'Guests can enjoy a workout at the on-site fitness center or a game of tennis on the\r\n     court nearby. Novotel Cairo Airport also offers a business center, a 24-hour front desk and car rental', 'Cairo Airport Road, Heliopolis, 11776', 'Cairo', '1699868051_277751146.jpg', NULL, '2100', '5', 1, 2, '2023-11-13 07:34:11', '2023-11-13 07:34:11'),
(4, 'Iberotel Luxor', 'A heated pool floating on the Nile is one of the most unique features\r\n     of this 4-star hotel. Overlooking the Theben Hills, Iberotel Luxor also offers a restaurant boat and rooms with private balconies', 'Khaled Ibn El Waleed Street, East Bank, 99999', 'Luxor', '1699868124_333397081.jpg', NULL, '1335', '5', 1, 2, '2023-11-13 07:35:24', '2023-11-13 07:35:24'),
(5, 'Pyramisa Hotel Luxor', 'A heated pool floating on the Nile is one of the most unique features of this 4-star hotel. Overlooking the Theben Hills, Iberotel Luxor also offers a restaurant boat and rooms with private balconies', 'Khaled Ibn El Walid Stree', 'Luxor', '1699868190_476581584.jpg', NULL, '1000', '5', 1, 2, '2023-11-13 07:36:30', '2023-11-13 07:36:30'),
(6, 'Porto El Jabal Hotel', 'At the hotel the rooms come with air conditioning, a desk, a flat-screen TV, a private bathroom, bed linen, towels and a terrace with a sea view. All guest rooms will provide guests with a wardrobe and a kettle.', 'Porto El Sokhna, 43514 Ain Sokhna', 'Ain Sokhna', '1699868332_95687809.jpg', NULL, '2209', '8', 1, 2, '2023-11-13 07:38:52', '2023-11-13 07:38:52'),
(7, 'Swiss Inn Teda Hotel & Aqua Park', 'The Teda Swiss Inn Plaza Hotel is set amidst lush gardens at the entrance of Chinese- Egyptian Economic Zone. Guests can make use of the free WiFi in the entire hotel, the pool and the 24-hour room service.', 'North West Gulf of Suez, Economic Sector', 'Ain Sokhna', '1699868419_49182302 (1).jpg', NULL, '1900', '5', 1, 6, '2023-11-13 07:40:19', '2023-11-13 07:40:19'),
(8, 'Tanoak Resort', 'The 4-star Tropitel Dahab Oasis is located on the coast of Aqaba Gulf. The hotel has its own private beach, an outdoor swimming pool heated during winter and a diving centre overlooking the Blue Hole diving spot.', 'Azha Resort, Ain Sokhna 34 Km – Suez-Hurghada Road – Red Sea', 'Hurghada', '1699868489_308549179.jpg', NULL, '2809', '5', 1, 6, '2023-11-13 07:41:29', '2023-11-13 07:41:29'),
(9, 'Golden Hoster Hotel, Alex', 'Guest rooms are equipped with air conditioning, a flat-screen TV with satellite channels, a microwave, a kettle, a shower, free toiletries and a desk. With a private bathroom, rooms at the hotel also offer a city view. At HI Alexandria Apartments, each room comes with a seating area.', '123 Hole Road, Alex', 'Alex', '1699868556_39245097.jpg', NULL, '2209', '5', 1, 6, '2023-11-13 07:42:36', '2023-11-13 07:42:36'),
(10, 'Blue Beach Club', 'The air-conditioned rooms at Blue Beach Club feature Oriental décor and a modern private bathroom. Each unit is elegantly decorated and has a private balcony or a terrace', 'El Melal Street, 99999 Dahab', 'Dahab', '1699868618_6874499.jpg', NULL, '1800', NULL, 1, 6, '2023-11-13 07:43:38', '2023-11-13 07:43:38'),
(11, 'Tropitel Dahab Oasis', 'the 4-star Tropitel Dahab Oasis is located on the coast of Aqaba Gulf. The hotel has its own private beach, an outdoor swimming pool heated during winter and a diving centre overlooking the Blue Hole diving spot.', 'Blue Hole Road, Dahab', 'Dahab', '1699868695_39245097.jpg', NULL, '2209', '5', 1, 6, '2023-11-13 07:44:55', '2023-11-13 07:44:55');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `imageable_id` int(10) UNSIGNED NOT NULL,
  `imageable_type` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image`, `imageable_id`, `imageable_type`, `created_at`, `updated_at`) VALUES
(1, '1699815523_dolphina-park.jpg', 1, 'Destination', '2023-11-12 16:58:43', '2023-11-12 16:58:43'),
(2, '1699815523_sharm-el-sheikh.jpg', 1, 'Destination', '2023-11-12 16:58:43', '2023-11-12 16:58:43'),
(3, '1699815523_tiran.jpg', 1, 'Destination', '2023-11-12 16:58:43', '2023-11-12 16:58:43'),
(4, '1699815741_interno-ed-esterno.jpg', 2, 'Destination', '2023-11-12 17:02:21', '2023-11-12 17:02:21'),
(5, '1699815741_makadi-water-world.jpg', 2, 'Destination', '2023-11-12 17:02:21', '2023-11-12 17:02:21'),
(6, '1699815741_new-marina.jpg', 2, 'Destination', '2023-11-12 17:02:21', '2023-11-12 17:02:21'),
(7, '1699815801_photo0jpg.jpg', 3, 'Destination', '2023-11-12 17:03:21', '2023-11-12 17:03:21'),
(8, '1699815801_view-on-the-islamic-cairo.jpg', 3, 'Destination', '2023-11-12 17:03:21', '2023-11-12 17:03:21'),
(9, '1699815801_wadi-el-rayn.jpg', 3, 'Destination', '2023-11-12 17:03:21', '2023-11-12 17:03:21'),
(10, '1699816074_cancun-visit-august-2015.jpg', 4, 'Destination', '2023-11-12 17:07:54', '2023-11-12 17:07:54'),
(11, '1699816074_img-20181028-115828-largejpg.jpg', 4, 'Destination', '2023-11-12 17:07:54', '2023-11-12 17:07:54'),
(12, '1699816074_porto-sokhna-beach-resort.jpg', 4, 'Destination', '2023-11-12 17:07:54', '2023-11-12 17:07:54'),
(13, '1699816396_ageeba-beach.jpg', 5, 'Destination', '2023-11-12 17:13:16', '2023-11-12 17:13:16'),
(14, '1699816397_dsc-0229-largejpg.jpg', 5, 'Destination', '2023-11-12 17:13:17', '2023-11-12 17:13:17'),
(15, '1699816397_photo1jpg.jpg', 5, 'Destination', '2023-11-12 17:13:17', '2023-11-12 17:13:17'),
(16, '1699816628_an-outside-entrance-to.jpg', 6, 'Destination', '2023-11-12 17:17:08', '2023-11-12 17:17:08'),
(17, '1699816628_pompey-s-pillar-and-sphinx.jpg', 6, 'Destination', '2023-11-12 17:17:08', '2023-11-12 17:17:08'),
(18, '1699816629_view-from-the-hotel-of.jpg', 6, 'Destination', '2023-11-12 17:17:09', '2023-11-12 17:17:09'),
(19, '1699816701_marsa-alam.jpg', 7, 'Destination', '2023-11-12 17:18:21', '2023-11-12 17:18:21'),
(20, '1699816702_sataya.jpg', 7, 'Destination', '2023-11-12 17:18:22', '2023-11-12 17:18:22'),
(21, '1699816702_sataya-dei-delfini.jpg', 7, 'Destination', '2023-11-12 17:18:22', '2023-11-12 17:18:22'),
(22, '1699816743_el-alamein.jpg', 8, 'Destination', '2023-11-12 17:19:03', '2023-11-12 17:19:03'),
(23, '1699816743_etap-resort.jpg', 8, 'Destination', '2023-11-12 17:19:03', '2023-11-12 17:19:03'),
(24, '1699816743_porto-marina-resort-spa.jpg', 8, 'Destination', '2023-11-12 17:19:03', '2023-11-12 17:19:03'),
(25, '1699816780_caption.jpg', 9, 'Destination', '2023-11-12 17:19:40', '2023-11-12 17:19:40'),
(26, '1699816780_dahab.jpg', 9, 'Destination', '2023-11-12 17:19:40', '2023-11-12 17:19:40'),
(27, '1699816781_the-famous-blue-hole_rotated_90.jpg', 9, 'Destination', '2023-11-12 17:19:41', '2023-11-12 17:19:41'),
(28, '1699816824_c6262dfcddaf7c465a831411d9effd03.jpg', 10, 'Destination', '2023-11-12 17:20:24', '2023-11-12 17:20:24'),
(29, '1699816824_f0f7b84d7f11337a98325b23e5307aea.jpg', 10, 'Destination', '2023-11-12 17:20:25', '2023-11-12 17:20:25'),
(30, '1699816825_f0260b474d24d165223557affcdfc302.jpg', 10, 'Destination', '2023-11-12 17:20:25', '2023-11-12 17:20:25'),
(31, '1699816998_3b2dcf5f4f76f7d462e7d8f4ba6b99a2.jpg', 11, 'Destination', '2023-11-12 17:23:18', '2023-11-12 17:23:18'),
(32, '1699816998_da60c4e01554a3306a7b9b01cdce259d.jpg', 11, 'Destination', '2023-11-12 17:23:18', '2023-11-12 17:23:18'),
(33, '1699816998_f20135dd159bf4f54efa2f814e5254b4.jpg', 11, 'Destination', '2023-11-12 17:23:18', '2023-11-12 17:23:18'),
(34, '1699817912_2019-04-22.jpg', 1, 'Restaurant', '2023-11-12 17:38:32', '2023-11-12 17:38:32'),
(35, '1699817912_images.jpg', 1, 'Restaurant', '2023-11-12 17:38:32', '2023-11-12 17:38:32'),
(36, '1699817912_ML7_8865.JPG', 1, 'Restaurant', '2023-11-12 17:38:32', '2023-11-12 17:38:32'),
(37, '1699817977_106_507077348.jpg', 2, 'Restaurant', '2023-11-12 17:39:37', '2023-11-12 17:39:37'),
(38, '1699817978_18486414_1357322671018649_5197753448517419126_n.0.0.jpg', 2, 'Restaurant', '2023-11-12 17:39:38', '2023-11-12 17:39:38'),
(39, '1699817978_el-kababgy-luxor.jpg', 2, 'Restaurant', '2023-11-12 17:39:38', '2023-11-12 17:39:38'),
(40, '1699818038_finest-foods-in-sharm.jpg', 3, 'Restaurant', '2023-11-12 17:40:38', '2023-11-12 17:40:38'),
(41, '1699818038_rangoli.jpg', 3, 'Restaurant', '2023-11-12 17:40:38', '2023-11-12 17:40:38'),
(42, '1699818038_vista-da-varanda.jpg', 3, 'Restaurant', '2023-11-12 17:40:38', '2023-11-12 17:40:38'),
(43, '1699818122_image0-3.webp', 4, 'Restaurant', '2023-11-12 17:42:02', '2023-11-12 17:42:02'),
(44, '1699818122_Lazib-inn-fayoum-egypt-Hotel-Restaurant-Restaurant-terrace-1-1024x682-1-e1559694070314.jpg', 4, 'Restaurant', '2023-11-12 17:42:02', '2023-11-12 17:42:02'),
(45, '1699818123_we-highly-recommend-ibis.jpg', 4, 'Restaurant', '2023-11-12 17:42:03', '2023-11-12 17:42:03'),
(46, '1699818197_5eff48_30669344f0d54ad7a2342ecbabff00a1~mv2.webp', 5, 'Restaurant', '2023-11-12 17:43:17', '2023-11-12 17:43:17'),
(47, '1699818197_165528920_496476684713239_3224182009222267644_n-f02f3358-22ee-4723-b39a-13d74e0b8fb8-13897dc6-157f-4ec4-9d83-1990f9dadea5.jpg', 5, 'Restaurant', '2023-11-12 17:43:17', '2023-11-12 17:43:17'),
(48, '1699818197_IMG_8262-1024x670.jpg', 5, 'Restaurant', '2023-11-12 17:43:17', '2023-11-12 17:43:17'),
(49, '1699818265_701838ab-f2c9-4666-a5a7-d21801cf8205.jpg', 6, 'Restaurant', '2023-11-12 17:44:25', '2023-11-12 17:44:25'),
(50, '1699818265_Florence-Hotel-Assiut-Exterior.jpg', 6, 'Restaurant', '2023-11-12 17:44:25', '2023-11-12 17:44:25'),
(51, '1699818265_restaurant-in-ms-florence.jpg', 6, 'Restaurant', '2023-11-12 17:44:25', '2023-11-12 17:44:25'),
(52, '1699819759_1691239566_large_a2 - Copy.jpg.webp', 1, 'Trip', '2023-11-12 18:09:19', '2023-11-12 18:09:19'),
(53, '1699819759_1691239567_large_57 - Copy.jpg.webp', 1, 'Trip', '2023-11-12 18:09:19', '2023-11-12 18:09:19'),
(54, '1699819759_large_6X0A1919.JPG.webp', 1, 'Trip', '2023-11-12 18:09:19', '2023-11-12 18:09:19'),
(55, '1699819759_large_IMG_7635.JPG.webp', 1, 'Trip', '2023-11-12 18:09:19', '2023-11-12 18:09:19'),
(56, '1699819858_0d.jpg', 2, 'Trip', '2023-11-12 18:10:58', '2023-11-12 18:10:58'),
(57, '1699819858_4e.jpg', 2, 'Trip', '2023-11-12 18:10:58', '2023-11-12 18:10:58'),
(58, '1699819858_8b.jpg', 2, 'Trip', '2023-11-12 18:10:58', '2023-11-12 18:10:58'),
(59, '1699819858_72.jpg', 2, 'Trip', '2023-11-12 18:10:58', '2023-11-12 18:10:58'),
(60, '1699819858_91.jpg', 2, 'Trip', '2023-11-12 18:10:58', '2023-11-12 18:10:58'),
(61, '1699819858_db.jpg', 2, 'Trip', '2023-11-12 18:10:58', '2023-11-12 18:10:58'),
(62, '1699819858_dc.jpg', 2, 'Trip', '2023-11-12 18:10:58', '2023-11-12 18:10:58'),
(63, '1699819858_df.jpg', 2, 'Trip', '2023-11-12 18:10:58', '2023-11-12 18:10:58'),
(64, '1699819858_e5.jpg', 2, 'Trip', '2023-11-12 18:10:58', '2023-11-12 18:10:58'),
(65, '1699819858_ef.jpg', 2, 'Trip', '2023-11-12 18:10:58', '2023-11-12 18:10:58'),
(66, '1699819858_f1.jpg', 2, 'Trip', '2023-11-12 18:10:58', '2023-11-12 18:10:58'),
(67, '1699819937_55.jpg', 3, 'Trip', '2023-11-12 18:12:17', '2023-11-12 18:12:17'),
(68, '1699819937_d5.jpg', 3, 'Trip', '2023-11-12 18:12:17', '2023-11-12 18:12:17'),
(69, '1699819937_e9.jpg', 3, 'Trip', '2023-11-12 18:12:17', '2023-11-12 18:12:17'),
(70, '1699819937_Exploring-the-Hidden-Beauty-of-Siwa-Oasis-in-Egypt.jpg', 3, 'Trip', '2023-11-12 18:12:17', '2023-11-12 18:12:17'),
(71, '1699819937_Siwa+Salt+Lake-1920w.webp', 3, 'Trip', '2023-11-12 18:12:17', '2023-11-12 18:12:17'),
(72, '1699820010_900x600-1-50-abfa90153df72a0ae9f39b3db27de1a8.jpg', 4, 'Trip', '2023-11-12 18:13:30', '2023-11-12 18:13:30'),
(73, '1699820117_3b.jpg', 5, 'Trip', '2023-11-12 18:15:17', '2023-11-12 18:15:17'),
(74, '1699820117_6e.jpg', 5, 'Trip', '2023-11-12 18:15:17', '2023-11-12 18:15:17'),
(75, '1699820117_6f.jpg', 5, 'Trip', '2023-11-12 18:15:17', '2023-11-12 18:15:17'),
(76, '1699820117_21.jpg', 5, 'Trip', '2023-11-12 18:15:17', '2023-11-12 18:15:17'),
(77, '1699820117_22.jpg', 5, 'Trip', '2023-11-12 18:15:17', '2023-11-12 18:15:17'),
(78, '1699820117_44.jpg', 5, 'Trip', '2023-11-12 18:15:17', '2023-11-12 18:15:17'),
(79, '1699820117_70.jpg', 5, 'Trip', '2023-11-12 18:15:17', '2023-11-12 18:15:17'),
(80, '1699820117_71.jpg', 5, 'Trip', '2023-11-12 18:15:17', '2023-11-12 18:15:17'),
(81, '1699820117_75.jpg', 5, 'Trip', '2023-11-12 18:15:17', '2023-11-12 18:15:17'),
(82, '1699820117_79.jpg', 5, 'Trip', '2023-11-12 18:15:17', '2023-11-12 18:15:17'),
(83, '1699820117_88.jpg', 5, 'Trip', '2023-11-12 18:15:17', '2023-11-12 18:15:17'),
(84, '1699820117_a2.jpg', 5, 'Trip', '2023-11-12 18:15:17', '2023-11-12 18:15:17'),
(85, '1699820212_44.jpg', 6, 'Trip', '2023-11-12 18:16:52', '2023-11-12 18:16:52'),
(86, '1699820212_45.jpg', 6, 'Trip', '2023-11-12 18:16:52', '2023-11-12 18:16:52'),
(87, '1699820212_46.jpg', 6, 'Trip', '2023-11-12 18:16:52', '2023-11-12 18:16:52'),
(88, '1699820212_47.jpg', 6, 'Trip', '2023-11-12 18:16:52', '2023-11-12 18:16:52'),
(89, '1699820212_48.jpg', 6, 'Trip', '2023-11-12 18:16:52', '2023-11-12 18:16:52'),
(90, '1699820212_68.jpg', 6, 'Trip', '2023-11-12 18:16:52', '2023-11-12 18:16:52'),
(91, '1699820212_69.jpg', 6, 'Trip', '2023-11-12 18:16:52', '2023-11-12 18:16:52'),
(92, '1699820297_0K3A2439.jpg', 7, 'Trip', '2023-11-12 18:18:17', '2023-11-12 18:18:17'),
(93, '1699820297_7c.jpg', 7, 'Trip', '2023-11-12 18:18:17', '2023-11-12 18:18:17'),
(94, '1699820297_2000x2000-0-70-f5c7b95c85560519da8605d6553b5959.jpg', 7, 'Trip', '2023-11-12 18:18:17', '2023-11-12 18:18:17'),
(95, '1699820297_caption.jpg', 7, 'Trip', '2023-11-12 18:18:17', '2023-11-12 18:18:17'),
(96, '1699820297_images.jpeg', 7, 'Trip', '2023-11-12 18:18:17', '2023-11-12 18:18:17'),
(97, '1699820297_White-Desert-Camping.jpg', 7, 'Trip', '2023-11-12 18:18:17', '2023-11-12 18:18:17'),
(98, '1699820369_0a.jpg', 9, 'Trip', '2023-11-12 18:19:29', '2023-11-12 18:19:29'),
(99, '1699820369_76.jpg', 9, 'Trip', '2023-11-12 18:19:29', '2023-11-12 18:19:29'),
(100, '1699820369_caption.jpg', 9, 'Trip', '2023-11-12 18:19:29', '2023-11-12 18:19:29'),
(101, '1699820369_d3dd03de2b9f44cc703d2d176c27331e.jpg', 9, 'Trip', '2023-11-12 18:19:29', '2023-11-12 18:19:29'),
(102, '1699820369_e3.jpg', 9, 'Trip', '2023-11-12 18:19:29', '2023-11-12 18:19:29'),
(103, '1699820369_egyptian-food-hero.webp', 9, 'Trip', '2023-11-12 18:19:29', '2023-11-12 18:19:29'),
(104, '1699820369_images.jpeg', 9, 'Trip', '2023-11-12 18:19:29', '2023-11-12 18:19:29'),
(105, '1699820434_3f.jpg', 10, 'Trip', '2023-11-12 18:20:34', '2023-11-12 18:20:34'),
(106, '1699820434_42.jpg', 10, 'Trip', '2023-11-12 18:20:34', '2023-11-12 18:20:34'),
(107, '1699820584_3b.jpg', 12, 'Trip', '2023-11-12 18:23:04', '2023-11-12 18:23:04'),
(108, '1699820584_91.jpg', 12, 'Trip', '2023-11-12 18:23:04', '2023-11-12 18:23:04'),
(109, '1699820584_cb.jpg', 12, 'Trip', '2023-11-12 18:23:04', '2023-11-12 18:23:04'),
(110, '1699820721_2b.jpg', 13, 'Trip', '2023-11-12 18:25:21', '2023-11-12 18:25:21'),
(111, '1699820721_16.jpg', 13, 'Trip', '2023-11-12 18:25:21', '2023-11-12 18:25:21'),
(112, '1699820721_c4.jpg', 13, 'Trip', '2023-11-12 18:25:21', '2023-11-12 18:25:21'),
(113, '1699820721_d8.jpg', 13, 'Trip', '2023-11-12 18:25:21', '2023-11-12 18:25:21'),
(114, '1699820721_e1.jpg', 13, 'Trip', '2023-11-12 18:25:21', '2023-11-12 18:25:21'),
(115, '1699820808_26.jpg', 14, 'Trip', '2023-11-12 18:26:48', '2023-11-12 18:26:48'),
(116, '1699820808_1236816_650966741701669_3152016548232430279_n.jpg', 14, 'Trip', '2023-11-12 18:26:48', '2023-11-12 18:26:48'),
(117, '1699820808_caption.jpg', 14, 'Trip', '2023-11-12 18:26:48', '2023-11-12 18:26:48'),
(118, '1699820808_d0.jpg', 14, 'Trip', '2023-11-12 18:26:48', '2023-11-12 18:26:48'),
(119, '1699820808_ec0e2d8ea12384cfb14d971e4b5575cc.jpg', 14, 'Trip', '2023-11-12 18:26:48', '2023-11-12 18:26:48'),
(120, '1699820808_fe.jpg', 14, 'Trip', '2023-11-12 18:26:48', '2023-11-12 18:26:48'),
(121, '1699820884_63.jpg', 15, 'Trip', '2023-11-12 18:28:04', '2023-11-12 18:28:04'),
(122, '1699820884_a0.jpg', 15, 'Trip', '2023-11-12 18:28:04', '2023-11-12 18:28:04'),
(123, '1699820884_b0.jpg', 15, 'Trip', '2023-11-12 18:28:04', '2023-11-12 18:28:04'),
(124, '1699820884_d3.jpg', 15, 'Trip', '2023-11-12 18:28:04', '2023-11-12 18:28:04'),
(125, '1699820884_d8.jpg', 15, 'Trip', '2023-11-12 18:28:04', '2023-11-12 18:28:04'),
(126, '1699821182_63.jpg', 16, 'Trip', '2023-11-12 18:33:02', '2023-11-12 18:33:02'),
(127, '1699821182_a0.jpg', 16, 'Trip', '2023-11-12 18:33:02', '2023-11-12 18:33:02'),
(128, '1699821182_b0.jpg', 16, 'Trip', '2023-11-12 18:33:02', '2023-11-12 18:33:02'),
(129, '1699821182_d3.jpg', 16, 'Trip', '2023-11-12 18:33:02', '2023-11-12 18:33:02'),
(130, '1699821182_d8.jpg', 16, 'Trip', '2023-11-12 18:33:02', '2023-11-12 18:33:02'),
(131, '1699821261_2e.jpg', 17, 'Trip', '2023-11-12 18:34:21', '2023-11-12 18:34:21'),
(132, '1699821261_5a.jpg', 17, 'Trip', '2023-11-12 18:34:21', '2023-11-12 18:34:21'),
(133, '1699821261_65.jpg', 17, 'Trip', '2023-11-12 18:34:21', '2023-11-12 18:34:21'),
(134, '1699821261_96.jpg', 17, 'Trip', '2023-11-12 18:34:21', '2023-11-12 18:34:21'),
(135, '1699821261_a4.jpg', 17, 'Trip', '2023-11-12 18:34:21', '2023-11-12 18:34:21'),
(136, '1699821341_10.jpg', 18, 'Trip', '2023-11-12 18:35:41', '2023-11-12 18:35:41'),
(137, '1699821341_15.jpg', 18, 'Trip', '2023-11-12 18:35:41', '2023-11-12 18:35:41'),
(138, '1699821341_16.jpg', 18, 'Trip', '2023-11-12 18:35:41', '2023-11-12 18:35:41'),
(139, '1699821341_21.jpg', 18, 'Trip', '2023-11-12 18:35:41', '2023-11-12 18:35:41'),
(140, '1699821341_36.jpg', 18, 'Trip', '2023-11-12 18:35:41', '2023-11-12 18:35:41'),
(141, '1699821341_87.jpg', 18, 'Trip', '2023-11-12 18:35:41', '2023-11-12 18:35:41'),
(142, '1699821341_89.jpg', 18, 'Trip', '2023-11-12 18:35:41', '2023-11-12 18:35:41'),
(143, '1699821341_c1.jpg', 18, 'Trip', '2023-11-12 18:35:41', '2023-11-12 18:35:41'),
(144, '1699821401_Petra-the-Treasury-via-Canva.jpg', 19, 'Trip', '2023-11-12 18:36:41', '2023-11-12 18:36:41'),
(145, '1699821401_petra-world-heritage-jordan.webp', 19, 'Trip', '2023-11-12 18:36:41', '2023-11-12 18:36:41'),
(146, '1699821457_7e.jpg', 20, 'Trip', '2023-11-12 18:37:37', '2023-11-12 18:37:37'),
(147, '1699821457_11.jpg', 20, 'Trip', '2023-11-12 18:37:37', '2023-11-12 18:37:37'),
(148, '1699821457_43.jpg', 20, 'Trip', '2023-11-12 18:37:37', '2023-11-12 18:37:37'),
(149, '1699821457_84.jpg', 20, 'Trip', '2023-11-12 18:37:37', '2023-11-12 18:37:37'),
(150, '1699821457_d8.jpg', 20, 'Trip', '2023-11-12 18:37:37', '2023-11-12 18:37:37'),
(151, '1699821457_ff.jpg', 20, 'Trip', '2023-11-12 18:37:37', '2023-11-12 18:37:37'),
(152, '1699821518_7e.jpg', 21, 'Trip', '2023-11-12 18:38:38', '2023-11-12 18:38:38'),
(153, '1699821518_77.jpg', 21, 'Trip', '2023-11-12 18:38:38', '2023-11-12 18:38:38'),
(154, '1699821518_89.jpg', 21, 'Trip', '2023-11-12 18:38:38', '2023-11-12 18:38:38'),
(155, '1699821518_d0.jpg', 21, 'Trip', '2023-11-12 18:38:38', '2023-11-12 18:38:38'),
(156, '1699821589_0c.jpg', 22, 'Trip', '2023-11-12 18:39:49', '2023-11-12 18:39:49'),
(157, '1699821649_900x600-1-50-8d5df903cab7719643a9f68ac0b5982e.jpg', 23, 'Trip', '2023-11-12 18:40:49', '2023-11-12 18:40:49'),
(158, '1699821649_1304725889-Sunset-Safari-by-Quad-Bike.jpg', 23, 'Trip', '2023-11-12 18:40:49', '2023-11-12 18:40:49'),
(159, '1699821649_A-wonderful-view-of-tourists-riding-a-desert-bike-in-Egypt-safari.jpg', 23, 'Trip', '2023-11-12 18:40:49', '2023-11-12 18:40:49'),
(160, '1699867903_490168687.jpg', 1, 'Hotel', '2023-11-13 07:31:43', '2023-11-13 07:31:43'),
(161, '1699867903_490887357.jpg', 1, 'Hotel', '2023-11-13 07:31:43', '2023-11-13 07:31:43'),
(162, '1699867903_490884915.jpg', 1, 'Hotel', '2023-11-13 07:31:43', '2023-11-13 07:31:43'),
(163, '1699867903_490569066.jpg', 1, 'Hotel', '2023-11-13 07:31:43', '2023-11-13 07:31:43'),
(164, '1699867903_490885947.jpg', 1, 'Hotel', '2023-11-13 07:31:43', '2023-11-13 07:31:43'),
(165, '1699867978_483730770.jpg', 2, 'Hotel', '2023-11-13 07:32:58', '2023-11-13 07:32:58'),
(166, '1699867978_491882641.jpg', 2, 'Hotel', '2023-11-13 07:32:58', '2023-11-13 07:32:58'),
(167, '1699867978_491882675.jpg', 2, 'Hotel', '2023-11-13 07:32:58', '2023-11-13 07:32:58'),
(168, '1699867978_491882685.jpg', 2, 'Hotel', '2023-11-13 07:32:58', '2023-11-13 07:32:58'),
(169, '1699867978_491975454.jpg', 2, 'Hotel', '2023-11-13 07:32:58', '2023-11-13 07:32:58'),
(170, '1699868051_25187086.jpg', 3, 'Hotel', '2023-11-13 07:34:11', '2023-11-13 07:34:11'),
(171, '1699868051_277751146.jpg', 3, 'Hotel', '2023-11-13 07:34:11', '2023-11-13 07:34:11'),
(172, '1699868051_278181522.jpg', 3, 'Hotel', '2023-11-13 07:34:11', '2023-11-13 07:34:11'),
(173, '1699868051_278183282.jpg', 3, 'Hotel', '2023-11-13 07:34:11', '2023-11-13 07:34:11'),
(174, '1699868051_479953632.jpg', 3, 'Hotel', '2023-11-13 07:34:11', '2023-11-13 07:34:11'),
(175, '1699868124_333394176.jpg', 4, 'Hotel', '2023-11-13 07:35:24', '2023-11-13 07:35:24'),
(176, '1699868124_333394393.jpg', 4, 'Hotel', '2023-11-13 07:35:24', '2023-11-13 07:35:24'),
(177, '1699868124_333397071.jpg', 4, 'Hotel', '2023-11-13 07:35:24', '2023-11-13 07:35:24'),
(178, '1699868124_333397081.jpg', 4, 'Hotel', '2023-11-13 07:35:24', '2023-11-13 07:35:24'),
(179, '1699868190_333394176.jpg', 5, 'Hotel', '2023-11-13 07:36:30', '2023-11-13 07:36:30'),
(180, '1699868190_333397071.jpg', 5, 'Hotel', '2023-11-13 07:36:30', '2023-11-13 07:36:30'),
(181, '1699868190_476581584.jpg', 5, 'Hotel', '2023-11-13 07:36:30', '2023-11-13 07:36:30'),
(182, '1699868190_476581729.jpg', 5, 'Hotel', '2023-11-13 07:36:30', '2023-11-13 07:36:30'),
(183, '1699868333_95682456.jpg', 6, 'Hotel', '2023-11-13 07:38:53', '2023-11-13 07:38:53'),
(184, '1699868333_95684997.jpg', 6, 'Hotel', '2023-11-13 07:38:53', '2023-11-13 07:38:53'),
(185, '1699868333_95687809.jpg', 6, 'Hotel', '2023-11-13 07:38:53', '2023-11-13 07:38:53'),
(186, '1699868333_95693035.jpg', 6, 'Hotel', '2023-11-13 07:38:53', '2023-11-13 07:38:53'),
(187, '1699868333_319433891.jpg', 6, 'Hotel', '2023-11-13 07:38:53', '2023-11-13 07:38:53'),
(188, '1699868419_49181253.jpg', 7, 'Hotel', '2023-11-13 07:40:19', '2023-11-13 07:40:19'),
(189, '1699868419_49181312.jpg', 7, 'Hotel', '2023-11-13 07:40:19', '2023-11-13 07:40:19'),
(190, '1699868419_49181744.jpg', 7, 'Hotel', '2023-11-13 07:40:19', '2023-11-13 07:40:19'),
(191, '1699868419_49182302 (1).jpg', 7, 'Hotel', '2023-11-13 07:40:19', '2023-11-13 07:40:19'),
(192, '1699868489_308540956.jpg', 8, 'Hotel', '2023-11-13 07:41:29', '2023-11-13 07:41:29'),
(193, '1699868489_308546697.jpg', 8, 'Hotel', '2023-11-13 07:41:29', '2023-11-13 07:41:29'),
(194, '1699868489_308549179.jpg', 8, 'Hotel', '2023-11-13 07:41:29', '2023-11-13 07:41:29'),
(195, '1699868490_308549500.jpg', 8, 'Hotel', '2023-11-13 07:41:30', '2023-11-13 07:41:30'),
(196, '1699868490_323463737.jpg', 8, 'Hotel', '2023-11-13 07:41:30', '2023-11-13 07:41:30'),
(197, '1699868556_39245097.jpg', 9, 'Hotel', '2023-11-13 07:42:36', '2023-11-13 07:42:36'),
(198, '1699868556_39245986.jpg', 9, 'Hotel', '2023-11-13 07:42:36', '2023-11-13 07:42:36'),
(199, '1699868556_478882921.jpg', 9, 'Hotel', '2023-11-13 07:42:36', '2023-11-13 07:42:36'),
(200, '1699868556_479010562.jpg', 9, 'Hotel', '2023-11-13 07:42:36', '2023-11-13 07:42:36'),
(201, '1699868618_6874499.jpg', 10, 'Hotel', '2023-11-13 07:43:38', '2023-11-13 07:43:38'),
(202, '1699868618_39245986.jpg', 10, 'Hotel', '2023-11-13 07:43:38', '2023-11-13 07:43:38'),
(203, '1699868618_39246508.jpg', 10, 'Hotel', '2023-11-13 07:43:38', '2023-11-13 07:43:38'),
(204, '1699868618_252879798.jpg', 10, 'Hotel', '2023-11-13 07:43:38', '2023-11-13 07:43:38'),
(205, '1699868695_39245097.jpg', 11, 'Hotel', '2023-11-13 07:44:55', '2023-11-13 07:44:55'),
(206, '1699868695_39245986.jpg', 11, 'Hotel', '2023-11-13 07:44:55', '2023-11-13 07:44:55'),
(207, '1699868695_39246508.jpg', 11, 'Hotel', '2023-11-13 07:44:55', '2023-11-13 07:44:55'),
(208, '1699868695_40342593.jpg', 11, 'Hotel', '2023-11-13 07:44:55', '2023-11-13 07:44:55');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0000_00_00_000000_create_websockets_statistics_entries_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_10_20_072650_create_destinations_table', 1),
(7, '2023_10_20_073235_create_trips_table', 1),
(8, '2023_10_20_074004_create_restaurants_table', 1),
(9, '2023_10_20_074249_create_user_restaurants_table', 1),
(10, '2023_10_20_074617_create_hotels_table', 1),
(11, '2023_10_20_074909_create_rooms_table', 1),
(12, '2023_10_20_075045_create_reviews_table', 1),
(13, '2023_10_21_061221_create_transactions_table', 1),
(14, '2023_10_29_204113_create_user_orders_table', 1),
(15, '2023_10_30_160632_create_time_slot_table', 1),
(16, '2023_10_30_213504_create_custom_notifications_table', 1),
(17, '2023_11_01_195524_create_images_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` text NOT NULL,
  `email` varchar(191) NOT NULL,
  `street` varchar(191) NOT NULL,
  `government` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `thumbnail` varchar(191) NOT NULL,
  `rating` varchar(191) DEFAULT NULL,
  `cost` varchar(191) NOT NULL,
  `discount` varchar(191) DEFAULT NULL,
  `available` tinyint(1) NOT NULL DEFAULT 1,
  `creator_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `description`, `email`, `street`, `government`, `phone`, `thumbnail`, `rating`, `cost`, `discount`, `available`, `creator_id`, `created_at`, `updated_at`) VALUES
(1, 'bab elhara', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil dicta esse quo, aliquam quaerat autem provident eveniet? Nihil, enim accusantium?', 'redseadivers@example.com', '8 Dive Center Road', 'beni suef', '+20 333 222 111', '1699817911_2019-04-22.jpg', '4', '1000', '10', 1, 2, '2023-11-12 17:38:31', '2023-11-12 17:38:31'),
(2, 'el-kababgy', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil dicta esse quo, aliquam quaerat autem provident eveniet? Nihil, enim accusantium?', 'nilecruise@example.com', '7 Nile Cruise Avenue', 'Luxor', '+20 333 222 111', '1699817977_106_507077348.jpg', '2', '1500', '10', 1, 2, '2023-11-12 17:39:37', '2023-11-12 17:39:37'),
(3, 'Rangoli Paradise', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil dicta esse quo, aliquam quaerat autem provident eveniet? Nihil, enim accusantium?', 'redseaparadise@example.com', '12 Paradise Road', 'Sharm El Sheikh', '+20 333 222 111', '1699818037_finest-foods-in-sharm.jpg', '2', '2222', '20', 1, 2, '2023-11-12 17:40:37', '2023-11-12 17:40:37'),
(4, 'Fayoum Fisherman\'s Grill', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil dicta esse quo, aliquam quaerat autem provident eveniet? Nihil, enim accusantium?', 'fayoumfisherman@example.com', '20 Fayoum Beach Road', 'Fayoum', '+20 333 222 111', '1699818122_image0-3.webp', '4', '1222', '30', 1, 2, '2023-11-12 17:42:02', '2023-11-12 17:42:02'),
(5, 'Pyramid View Restaurant', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil dicta esse quo, aliquam quaerat autem provident eveniet? Nihil, enim accusantium?', 'pyramidview@example.com', '2 Giza Pyramid Road', 'Giza', '+20 333 222 111', '1699818197_5eff48_30669344f0d54ad7a2342ecbabff00a1~mv2.webp', '4', '6666', '40', 1, 2, '2023-11-12 17:43:17', '2023-11-12 17:43:17'),
(6, 'Nile Felucca Cafe', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil dicta esse quo, aliquam quaerat autem provident eveniet? Nihil, enim accusantium?', 'feluccacafe@example.com', '10 Felucca Street', 'Asyut', '+20 333 222 111', '1699818265_701838ab-f2c9-4666-a5a7-d21801cf8205.jpg', '3', '4568', '20', 1, 2, '2023-11-12 17:44:25', '2023-11-12 17:44:25');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `review` text NOT NULL,
  `reviewable_type` varchar(191) NOT NULL,
  `reviewable_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('single','double') NOT NULL DEFAULT 'single',
  `thumbnail` varchar(191) NOT NULL,
  `description` text NOT NULL,
  `hotel_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `time_slot`
--

CREATE TABLE `time_slot` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `service_type` varchar(191) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `available_slots` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoiceid` varchar(255) NOT NULL,
  `paymentid` varchar(255) NOT NULL,
  `creator_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `government` varchar(191) NOT NULL,
  `duration` varchar(191) NOT NULL,
  `cost` varchar(191) NOT NULL,
  `description` text NOT NULL,
  `rating` varchar(191) NOT NULL,
  `thumbnail` varchar(191) NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT 1,
  `discount` varchar(191) DEFAULT NULL,
  `creator_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`id`, `name`, `government`, `duration`, `cost`, `description`, `rating`, `thumbnail`, `available`, `discount`, `creator_id`, `created_at`, `updated_at`) VALUES
(1, 'Desert: Super Safari By Jeep', 'Hurghada', '2', '840', 'Start an exhilarating desert journey that promises a day filled with adventure and cultural immersion. Your full-day escapade commences with a hotel pickup in Hurghada, setting the stage for an unforgettable experience. Prepare for an action-packed 45-minute quad biking adventure, followed by an exhilarating 15-minute ride on a spider car. The desert landscape unfolds before you, inviting exploration and excitement.', '5', '1699819759_large_6X0A2306.JPG.webp', 1, NULL, 1, '2023-11-12 18:09:19', '2023-11-12 18:09:19'),
(2, '4-Day 3-Night Nile Cruise from Aswan to Luxor&Abu Simbel+Balloon', 'Aswan', '4', '11550', 'Savor the timeless experience that is a Nile cruise as you sail from Aswan to Luxor on an indulgent ship with onboard swimming pool. Feast on breakfast, lunch, dinner—and even afternoon tea—as you discover ancient Egypt’s highlights. Professional Egyptologists are on hand as you visit the temples of Philae, Kom Ombo, Edfu, Luxor, and Karnak.', '5', '1699819858_1b.jpg', 1, NULL, 1, '2023-11-12 18:10:58', '2023-11-12 18:10:58'),
(3, 'Siwa Oasis', 'Marsa Matruh', '7', '8100', 'The Siwa oasis is one of the Western Desert’s most magical areas, but it’s more than an 8-hour drive from Cairo. Say no to hellish bus journeys and yes to the comfort of your own private vehicle with rest stops, snack breaks, and a guide. Explore the Great Sand Sea by 4WD, with dune bashing, sandboarding, and a desert sunset; see salt lakes, ancient ruins, Fatnis Island, and more.', '5', '1699819937_68.jpg', 1, NULL, 2, '2023-11-12 18:12:17', '2023-11-12 18:12:17'),
(4, 'Day Tour to Giza Pyramids Memphis city Dahshur and Saqqara Pyramids', 'Giza', '1', '1350', 'Giza Pyramids 9 Hours Tour Start at 7:30 Am, 8:00 Am, or 9:00 Am, Private Tour Includes All Pick-Up & Drop Off from Customer Location in Cairo, Entry Fees, Expert Tour Guide, Lunch at Local Restaurant, All Taxes Services, Bottle of Water And All Transfers by Private A/C Vehicles Newest Model, Tour Excludes Personal Items, Tipping, Any Optional Tours. There is the possibility of entering any of the pyramids from inside, riding a camel around of Giza pyramids or ridding the quad bike in the wide desert, or Felucca ride sailing on the Nile but all those activities can be added on in the middle of the booking process as it requires additional fees.', '5', '1699820010_900x600-1-50-abfa90153df72a0ae9f39b3db27de1a8.jpg', 1, NULL, 2, '2023-11-12 18:13:30', '2023-11-12 18:13:30'),
(5, 'Alexandria Day Trip From Cairo', 'Alexandria', '1', '1170', 'Alexandria is at least 11-12 hours round trip from Cairo so it pays to use your time effectively. Make the absolute most of those precious hours on this door-to-door tour that covers the library, the Roman Amphitheater, the corniche and harbor, the site of the lighthouse, the Citadel of Qaitbay, the Montazah Palace Gardens, Stanley Bridge, the Mosque of Abu al-Abbas al-Mursi, El Nabi Daniel Mosque and many other stops.', '5', '1699820117_a0.jpg', 1, NULL, 1, '2023-11-12 18:15:17', '2023-11-12 18:15:17'),
(6, 'Private Day Tour To El Fayoum Oasis and Waterfalls from Cairo', 'Fayoum', '1', '5130', 'With lush greenery, desert, and waterfalls, the Al-Fayoum (Faiyum) oasis is a fascinating area. Hit the highlights with your own Egyptologist on this private door-to-door tour that includes sandboarding, a boat trip, and a restaurant lunch, but excludes entrance fees. You’ll have the option of visiting the Valley of the Whales, then view Lake Qarun, Magic Lake, Mt. Mudarawa, and Wadi El-Rayan, home to Egypt’s only waterfalls.', '5', '1699820212_43.jpg', 1, NULL, 2, '2023-11-12 18:16:52', '2023-11-12 18:16:52'),
(7, '2 Days Tour from Cairo to The White Desert from Cairo', 'Cairo', '2', '3600', 'This trip to the white desert it\'s epic, we will let you to enjoy the movement through the black and white deserts is one of those experiences one never forgets. The experience of sleeping under the stars and the delicious BBQ dinner at night in desert made so far a beautiful and unique experience.', '4', '1699820297_17.jpg', 1, NULL, 2, '2023-11-12 18:18:17', '2023-11-12 18:18:17'),
(9, 'Cairo Food Tour', 'Cairo', '2', '4020', 'Eat your way through Cairo with this private tour, led by a professional guide. Your guide will pick you up at your hotel and take you out to visit spots that locals love. You’ll try out a range of quintessentially Egyptian dishes as you learn about Egyptian history, culture, and culinary traditions.', '3', '1699820369_images.jpeg', 1, NULL, 2, '2023-11-12 18:19:29', '2023-11-12 18:19:29'),
(10, 'One day trip from Cairo to Suez', 'Suez', '1', '3420', 'Visit the Suez Canal and be back in Cairo by evening during this private, full-day excursion in Egypt. Make the two-hour drive pleasant and comfortable with private transfers in a chauffeured vehicle, with door-to-door hotel pickup and drop-off. See how the canal connects the Red and Mediterranean seas and visit the iconic Port Tewfik Memorial. Lunch and complimentary mineral water are included.', '4', '1699820434_b0.jpg', 1, NULL, 1, '2023-11-12 18:20:34', '2023-11-12 18:20:34'),
(12, 'Overnight Luxor Tours by train from Cairo with Hot Air Balloon and much more', 'Luxor', '2', '10500', 'See Luxor without the carbon cost or cash expense of a flight when you book this 2-day tour by first-class seated night train. You’ll glide above ancient monuments in a hot-air balloon, explore the Valley of the Kings and more, and sail the Nile. Your package includes transfers, train tickets, a private guide, a hotel with breakfast, and the balloon and felucca fees: entrance tickets are at your own expense.', '5', '1699820584_a4.jpg', 1, NULL, 2, '2023-11-12 18:23:04', '2023-11-12 18:23:04'),
(13, 'Fabulous Private Day-Tour to Cairo’s Museums and Coptic Cairo', 'Cairo', '1', '600', 'Take a fabulous day to Cairo’s main museums and explore ancient artifacts and browse the Egyptian Civilization through the ages with an Egyptology guide. Visit Coptic Cairo site and marvel some of the oldest churches in Egyptian and Christian history in one day tour. This tour make you explore the Egyptian Civilization the best way possible with a professional guide. This tour is like a time machine taking you back to the different eras of the Egyptian history and you will get to see the change in culture every step of the way.', '5', '1699820721_d3.jpg', 1, NULL, 2, '2023-11-12 18:25:21', '2023-11-12 18:25:21'),
(14, 'Day-Tour to the Red Sea from Cairo', 'Cairo', '2', '770', 'Say goodbye to the hustle and dust of Cairo and hello to the Red Sea’s golden sands on this door-to-door day trip to Ain Sukhna, a beach resort. Leave the city’s toxic traffic to your private driver and unwind. Your package includes a room for the day at a waterfront hotel, lunch in the restaurant (or on the beach), bottled water, and private round-trip hotel transfers.', '5', '1699820808_9b.jpg', 1, NULL, 4, '2023-11-12 18:26:48', '2023-11-12 18:26:48'),
(15, 'Private Half Day in Dendera Temple', 'Luxor', '1', '200', 'Get off the beaten path with a private, half-day tour to Dendera to see the Temple of Hathor and its famous ceiling depiction of the zodiac with this day tour. Your Egyptologist guide will pick you up at your hotel and take you out to the temple complex at a time of your choosing, where you’ll have plenty of time to explore before returning to Luxor.', '5', '1699820884_af.jpg', 1, NULL, 5, '2023-11-12 18:28:04', '2023-11-12 18:28:04'),
(16, 'Private Half Day in Dendera Temple', 'Luxor', '1', '200', 'Get off the beaten path with a private, half-day tour to Dendera to see the Temple of Hathor and its famous ceiling depiction of the zodiac with this day tour. Your Egyptologist guide will pick you up at your hotel and take you out to the temple complex at a time of your choosing, where you’ll have plenty of time to explore before returning to Luxor.', '4', '1699821182_af.jpg', 1, NULL, 5, '2023-11-12 18:33:02', '2023-11-12 18:33:02'),
(17, 'Private Tour Abu Simbel Temple', 'Aswan', '2', '840', 'Embark on an exclusive private tour from Aswan to the magnificent Abu Simbel Temple, a UNESCO World Heritage site, and an enduring testament to ancient Egypt\'s grandeur. Journey in comfort and style as our expert guide leads you to these iconic temples, originally carved into the mountainside by Pharaoh Ramses II. Marvel at the colossal statues guarding the entrance, each a symbol of his might and authority.', '5', '1699821261_3b.jpg', 1, NULL, 5, '2023-11-12 18:34:21', '2023-11-12 18:34:21'),
(18, 'Hot Air Balloon & Breakfast & Felucca Nile boat private', 'Luxor', '4', '900', 'Experience the pinnacle of Luxor\'s beauty with our exclusive Hot Air Balloon & Breakfast & Felucca Nile Boat Private tour. This extraordinary journey promises a day filled with indelible memories and awe-inspiring vistas. Start your day by ascending high above Luxor\'s ancient wonders in a hot air balloon. Witness the sunrise casting a golden embrace over the temples, monuments, and the lush Nile River below. This tranquil and breathtaking experience will offer you a unique perspective of Luxor\'s historical treasures. Following your exhilarating balloon ride, relish a delectable breakfast at a charming locale, allowing you to rejuvenate and savor the moments.', '5', '1699821341_11.jpg', 1, NULL, 4, '2023-11-12 18:35:41', '2023-11-12 18:35:41'),
(19, 'Day Tour to Petra', 'Sharm El Sheikh', '1', '400', 'Experience one of the New Seven Wonders of the World in just a day and cross the Red Sea too when you book this door-to-door tour to Petra, the rock-carved city of the Nabateans. Transfer to Taba, catch the boat to Aqaba, then you will take boat to Jordan,then drive through the desert to Petra to tour the Siq, the Treasury, the Royal Tombs, and more with a guide. After lunch, repeat the journey in reverse.', '5', '1699821401_IMG_3324.jpg', 1, NULL, 4, '2023-11-12 18:36:41', '2023-11-12 18:36:41'),
(20, 'Day Tour to Manial Palace, Nilometer and Cairo Tower', 'Cairo', '1', '500', 'Sun Pyramids Tours representative will pick you up from your hotel, to enjoy an excursion to Menial Palace where you will visit Mohamed Ali Home, Rooms, the unique Planet garden, Mummified Animal Museum, Treasury and Meeting Rooms. Then proceed to visit the Nilometer at Al Roda Island. Then visit Cairo Tower where you can take photos for the beautiful panoramic view. The Cairo Tower or El Gezira tower or (Borg Al Qahari) in Arabic language is considered one of the most prominent features of the Egyptian capital. Its partially open lattice-work design is intended to evoke a lotus plant. You will be transferred back to your hotel.', '4', '1699821456_82.jpg', 1, NULL, 4, '2023-11-12 18:37:36', '2023-11-12 18:37:37'),
(21, 'Snorkeling and Dolphin Watching in a Private Speedboat', 'Hurghada', '2', '700', 'Discover the incredible underwater world and stunning scenery of the Red Sea. Choose the private speed boat excursion to observe dolphins in their natural habitat while you sunbathe and snorkel. most travelers will have more than 80% chance to see the dolphins at the open sea!', '4', '1699821518_75.jpg', 1, NULL, 5, '2023-11-12 18:38:38', '2023-11-12 18:38:38'),
(22, 'Cleopatra Peeling Spa', 'Hurghada', '5', '16000', 'Indulge in the ultimate self-care experience with our Cleopatra Peeling Plus treatment in Hurghada. This luxurious spa experience is designed to rejuvenate and pamper you, leaving you feeling refreshed and revitalized. Cleopatra Peeling Plus: Our signature Cleopatra Peeling Plus treatment is inspired by the legendary beauty rituals of the iconic Queen Cleopatra herself. This spa experience combines traditional and modern techniques to exfoliate, cleanse, and nourish your skin, promoting a radiant and youthful complexion. Benefits: This treatment is known for its skin-renewing properties, helping to reduce the appearance of blemishes, fine lines, and uneven skin tone. It leaves your skin feeling smoother, softer, and more radiant. Relaxation: As you undergo this rejuvenating experience, you\'ll also enjoy a sense of relaxation and well-being, making it a perfect way to unwind during your time in Hurghada.', '5', '1699821589_80.jpg', 1, NULL, 4, '2023-11-12 18:39:49', '2023-11-12 18:39:49'),
(23, 'Quad Bike Desert Safari', 'Luxor', '2', '440', 'Watch the sun set in the Western Desert as you ride a quad bike past desert villages, ancient sites, and gorgeous Egyptian scenery. You\'ll go way beyond the top tourist sites as you explore, an ideal way to get off the Luxor tourist trail and into desert during the cooler evening hours. This quad bike tour includes pickup and drop-off at hotels in Luxor, with a local guide to lead the way.', '3', '1699821649_17-Desert-Safari-Trip-by-Quad-Bike-in-Hurghada-1051487279614.jpeg', 1, NULL, 5, '2023-11-12 18:40:49', '2023-11-12 18:40:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `government` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `role` enum('user','vendor','admin') NOT NULL DEFAULT 'user',
  `github_id` varchar(191) DEFAULT NULL,
  `github_token` varchar(191) DEFAULT NULL,
  `github_refresh_token` varchar(191) DEFAULT NULL,
  `google_id` varchar(191) DEFAULT NULL,
  `google_token` varchar(191) DEFAULT NULL,
  `google_refresh_token` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `government`, `street`, `mobile`, `role`, `github_id`, `github_token`, `github_refresh_token`, `google_id`, `google_token`, `google_refresh_token`, `created_at`, `updated_at`) VALUES
(1, 'abdelrahman ahmed', 'abdelrahman@gmail.com', NULL, '$2y$10$nEUTwoRKT7c7bwseNfvmDesVQ9aj3KrR/LE5dT7./uTyWoMnrrIpa', NULL, 'Cairo', 'giza', '12345678911', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'mohamed ahmed', 'mohamed@gmail.com', NULL, '$2y$10$nEUTwoRKT7c7bwseNfvmDesVQ9aj3KrR/LE5dT7./uTyWoMnrrIpa', NULL, 'Cairo', 'giza', '12345678911', 'vendor', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Shadwa', 'sh@gmail.com', NULL, '12345', NULL, 'Giza', 'Zayed', '01178654378', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-12 18:05:24', '2023-11-12 18:05:24'),
(5, 'Yara', 'yara@gmail.com', NULL, '12345', NULL, 'Giza', 'Zayed', '01178654379', 'vendor', NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-12 18:21:09', '2023-11-12 18:21:09'),
(6, 'Manal', 'manal@gmail.com', NULL, '12345', NULL, 'Giza', 'Zayed', '01178654386', 'vendor', NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-12 18:21:31', '2023-11-12 18:21:31');

-- --------------------------------------------------------

--
-- Table structure for table `user_orders`
--

CREATE TABLE `user_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `service_type` enum('Trip','Restaurant','Hotel','Destination') NOT NULL,
  `quantity` varchar(191) NOT NULL,
  `amount` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_restaurants`
--

CREATE TABLE `user_restaurants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `websockets_statistics_entries`
--

CREATE TABLE `websockets_statistics_entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_id` varchar(191) NOT NULL,
  `peak_connection_count` int(11) NOT NULL,
  `websocket_message_count` int(11) NOT NULL,
  `api_message_count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `custom_notifications`
--
ALTER TABLE `custom_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `custom_notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`),
  ADD KEY `custom_notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `destinations_creator_id_foreign` (`creator_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotels_creator_id_foreign` (`creator_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurants_creator_id_foreign` (`creator_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_reviewable_type_reviewable_id_index` (`reviewable_type`,`reviewable_id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rooms_hotel_id_foreign` (`hotel_id`);

--
-- Indexes for table `time_slot`
--
ALTER TABLE `time_slot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_creator_id_foreign` (`creator_id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`);

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trips_creator_id_foreign` (`creator_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_orders_user_id_foreign` (`user_id`),
  ADD KEY `user_orders_service_id_service_type_index` (`service_id`,`service_type`);

--
-- Indexes for table `user_restaurants`
--
ALTER TABLE `user_restaurants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_restaurants_user_id_foreign` (`user_id`),
  ADD KEY `user_restaurants_restaurant_id_foreign` (`restaurant_id`);

--
-- Indexes for table `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `custom_notifications`
--
ALTER TABLE `custom_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `time_slot`
--
ALTER TABLE `time_slot`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_restaurants`
--
ALTER TABLE `user_restaurants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `custom_notifications`
--
ALTER TABLE `custom_notifications`
  ADD CONSTRAINT `custom_notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `destinations`
--
ALTER TABLE `destinations`
  ADD CONSTRAINT `destinations_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hotels`
--
ALTER TABLE `hotels`
  ADD CONSTRAINT `hotels_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD CONSTRAINT `restaurants_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trips`
--
ALTER TABLE `trips`
  ADD CONSTRAINT `trips_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_orders`
--
ALTER TABLE `user_orders`
  ADD CONSTRAINT `user_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_restaurants`
--
ALTER TABLE `user_restaurants`
  ADD CONSTRAINT `user_restaurants_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_restaurants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
