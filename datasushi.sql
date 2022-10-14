-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 13, 2022 lúc 08:24 PM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `datasushi`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `admin_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `admin_password`, `admin_name`, `created_at`, `updated_at`) VALUES
(1, 'admin@yahoo.com', '25f9e794323b453885f5181f1b624d0b', 'Administrator', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `employees`
--

CREATE TABLE `employees` (
  `EMP_ID` int(10) UNSIGNED NOT NULL,
  `LastName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FirstName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `employees`
--

INSERT INTO `employees` (`EMP_ID`, `LastName`, `FirstName`, `Email`, `Phone`, `Image`) VALUES
(14, 'Lê', 'Ngọc Hân', 'hanle@gmail.com', '0123456789', NULL),
(24, 'Kiều', 'Oanh', 'oanhkieungo96@gmail.com', '0987654321', NULL),
(25, 'Thong', 'Nhat', 'thongnhat@gmail.com', '0987654321', NULL),
(26, 'Đăng', 'Khoa', 'thongnhat@gmail.com', '0987654321', NULL),
(28, 'Tran', 'Triet', 'trantriet@gmail.com', '0123456789', NULL),
(29, 'Đăng', 'Khoa', 'dangkhoa@gmail.com', '0987654321', NULL),
(31, 'Đăng', 'Khoa', 'dangkhoa@gmail.com', '0987654322', NULL),
(34, 'Hoàng', 'Tấn', 'hoangtanit@gmail.com', '0123987654', 'FD-Y3soVEAE9Sjj_1665279471.jpg'),
(35, 'Dang', 'Rey', NULL, NULL, 'ca-hoi_1665626728.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_09_20_121115_create_employees_table--create=employees', 1),
(6, '2022_10_08_112214_create_product_types_table', 1),
(7, '2022_10_08_112310_create_products_table', 1),
(8, '2022_10_09_025333_create_admin_table', 1),
(9, '2022_10_10_160800_add_is_show_to_product_types_table', 2),
(10, '2022_10_11_141646_add_is_show_to_products_table', 2),
(11, '2022_10_13_161608_add_phone_to_users_table', 3),
(14, '2022_10_13_165318_create_orders_table', 4),
(15, '2022_10_13_165323_create_order_items_table', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_fee` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reject_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method_payment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `username`, `name`, `phone`, `address`, `shipping_fee`, `sub_total`, `total`, `status`, `reject_reason`, `note`, `method_payment`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Dinh Thanh Tuan -login', '012355', 'Ha Noi', 0, 425000, 425000, 'WAITING', NULL, NULL, 'CASH', '2022-10-13 09:55:54', '2022-10-13 09:55:54'),
(2, '034123123', 'Dinh Thanh Tuan -login', '012355', 'Ha Noi', 0, 425000, 425000, 'WAITING', NULL, NULL, 'CASH', '2022-10-13 09:56:56', '2022-10-13 09:56:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `PRO_ID` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `PRO_ID`, `name`, `price`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Sushi Set Cá Hồi', 139000, 2, '2022-10-13 09:55:54', '2022-10-13 09:55:54'),
(2, 1, 2, 'Sushi Tôm Tít Trộn Trứng Cá Chuồn', 49000, 3, '2022-10-13 09:55:54', '2022-10-13 09:55:54'),
(3, 2, 1, 'Sushi Set Cá Hồi', 139000, 2, '2022-10-13 09:56:56', '2022-10-13 09:56:56'),
(4, 2, 2, 'Sushi Tôm Tít Trộn Trứng Cá Chuồn', 49000, 3, '2022-10-13 09:56:56', '2022-10-13 09:56:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(2, 'App\\Models\\User', 1, 'ApiToken', '77009e1698bbb33422f8791477141bdf61dd09901f0eb9f17a41394bffe93d5d', '[\"*\"]', NULL, NULL, '2022-09-23 20:09:07', '2022-09-23 20:09:07'),
(5, 'App\\Models\\User', 5, 'ApiToken', '840bdf15e6451ec85bfac8cab6332100c3512328ad471103ebe700c41fe9c495', '[\"*\"]', '2022-10-07 19:16:09', NULL, '2022-10-07 19:14:56', '2022-10-07 19:16:09'),
(24, 'App\\Models\\User', 6, 'ApiToken', '8eeb36beb9e991fcd6af80ecf8079a4b2f78dc683aa22f9bb1c00fbb7732c816', '[\"*\"]', NULL, NULL, '2022-10-11 23:55:25', '2022-10-11 23:55:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `PRO_ID` int(10) UNSIGNED NOT NULL,
  `Code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Votes` smallint(6) NOT NULL,
  `Price` double NOT NULL,
  `Unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Materials` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TYPE_ID` int(10) UNSIGNED NOT NULL,
  `is_show` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`PRO_ID`, `Code`, `Name`, `Votes`, `Price`, `Unit`, `Materials`, `Amount`, `Description`, `Image`, `TYPE_ID`, `is_show`) VALUES
(1, 'collection_001', 'Sushi Set Cá Hồi', 5, 139000, 'VND', 'Cá Hồi – Bụng Cá Hồi – Cá Hồi Khè Lửa – Cơm', '2', '– Set sushi cá hồi bao gồm sushi fillet cá hồi tươi, sushi bụng cá hồi tươi, sushi cá hồi khè mù tạt.\n\n– Nếu bạn là tín đồ của cá hồi thì đây quả là một sự lựa chọn sáng suốt, vị cá hồi thơm mùi đặc trưng được chế biến theo nhiều cách khác nhau hòa quyện cùng cơm dẻo được tẩm ướp chua thanh.\n\n– Món này bạn sẽ ăn kèm cùng một ít nước tương và wasabi', 'Sushi-Set-Ca-Hoi-1_1665634554.png', 1, 1),
(2, 'collection_002', 'Sushi Tôm Tít Trộn Trứng Cá Chuồn', 5, 49000, 'VND', 'Tôm Tít – Trứng Cá Chuồn – Cơm – Dưa Leo', '2', '– Món ăn bao gồm dưa leo giòn tươi cuộn quanh viên cơm cùng tôm tít xốt béo ngậy, điểm xuyến trên đó là những hạt trứng cá chuồn đỏ tươi, nhìn ngon mắt vô cùng.\n\n– Đây là sự kết hợp vị ngọt của tôm, vị béo thơm của xốt, chua ngọt thanh trong cơm, hòa quyện với vị giòn của dưa leo, cùng tiếng nổ lách tách của trứng cá chuồn.\n\n– Món này bạn sẽ ăn kèm cùng gừng hồng, rong nho, rau củ bào, cùng một ít nước tương và mù tạt.', 'Sushi-Tom-Tit-Tron-Trung-Ca-Chuon-1_1665634622.png', 1, 1),
(3, 'sashimi_001', 'Cá Hồi', 5, 265000, 'VND', 'Cá Hồi – Rong Nho – Rau Củ Bào – Tía Tô', '2', '– Một phần Sashimi cá hồi Nauy gồm những miếng cá được cắt ra có các đường vân mỡ trắng dài, chắc thịt và vô cùng đẹp mắt.\n\n– Thịt cá hồi Nauy khi ăn vào có mùi thơm,mềm, không bị tanh, vị ngọt thanh mát tự nhiên.\n\n– Món này ăn kèm với Rong Nho – Rau Củ – Bào – Tía Tô – Gừng chua. Chấm cùng với nước tương Nhật và wasabi.', 'ca-hoi_1665634705.png', 2, 1),
(4, 'sashimi_002', 'Cá Hồi', 5, 265000, 'VND', 'Bụng Cá Hồi – Rong Nho – Rau Củ Bào – Tía Tô', '2', '– Bụng cá hồi là phần thịt với lớp mỡ  mỏng trải nhẹ mang một hương vị mới lạ cho món sushi cá hồi.\n\n– Nếu thực khách nào thích thưởng thức vị béo thì bụng cá hồi quả là một lựa chọn hoàn hảo, mềm hơn, béo hơn, đặc trưng mùi hơn sẽ làm hài lòng mọi thực khách.\n\n– Món này thực khách có thể ăn kèm với nước tương nhật và wasabi, rong nho, rau củ bào, tía tô.', 'bung-ca-hoi-1_1665634754.png', 2, 1),
(5, 'sashimi_003', 'Cá Trích', 5, 195000, 'VND', 'Cá Trích – Rong Nho – Rau Củ Bào – Tía Tô', '2', '– Gồm một phần cá trích ép trứng với màu vàng óng bắt mắt thực khách.\n\n– Khi thưởng thức thực khác sẽ cảm nhận được mùi thơm béo của cá trích, cùng với vị giòn tan ngọt lịm vỡ ra của trứng cá chuồn.\n\n– Với món ăn này thực khách ăn kèm với Rong Nho – Rau Củ Bào – Tía Tô. Chấm cùng với nước tương và wasabi.', 'bung-ca-hoi-1_1665634784.png', 2, 1),
(6, 'sushi_001', 'Sushi Set Cá Hồi', 5, 139000, 'VND', 'Cá Hồi – Bụng Cá Hồi – Cá Hồi Khè Lửa – Cơm', '2', '– Set sushi cá hồi bao gồm sushi fillet cá hồi tươi, sushi bụng cá hồi tươi, sushi cá hồi khè mù tạt.\n\n– Nếu bạn là tín đồ của cá hồi thì đây quả là một sự lựa chọn sáng suốt, vị cá hồi thơm mùi đặc trưng được chế biến theo nhiều cách khác nhau hòa quyện cùng cơm dẻo được tẩm ướp chua thanh.\n\n– Món này bạn sẽ ăn kèm cùng một ít nước tương và wasabi', 'Sushi-Set-Ca-Hoi-1_1665634937.png', 3, 1),
(7, 'sushi_003', 'Sushi Tôm Tít Trộn Trứng Cá Chuồn', 5, 49000, 'VND', 'Tôm Tít – Trứng Cá Chuồn – Cơm – Dưa Leo', '2', '– Món ăn bao gồm dưa leo giòn tươi cuộn quanh viên cơm cùng tôm tít xốt béo ngậy, điểm xuyến trên đó là những hạt trứng cá chuồn đỏ tươi, nhìn ngon mắt vô cùng.\n\n– Đây là sự kết hợp vị ngọt của tôm, vị béo thơm của xốt, chua ngọt thanh trong cơm, hòa quyện với vị giòn của dưa leo, cùng tiếng nổ lách tách của trứng cá chuồn.\n\n– Món này bạn sẽ ăn kèm cùng gừng hồng, rong nho, rau củ bào, cùng một ít nước tương và mù tạt.', 'sushi_tomtit_1665634977.png', 3, 1),
(8, 'salad_001', 'Salad Rong Biển', 5, 85000, 'VND', 'Rong Nho –  Rau Củ Healthy', '2', '– Món ăn này gồm rong biển khô, rong nho, xà lách, bơ, cà chua bi. Nhìn bắt mắt nhiều màu sắc đa dạng.\n\n– Rong biển giòn thơm, xen lẫn miếng rong nhỏ nổ tí tách cùng với vị rau củ tươi. Tạo cảm giác thú vị cho thực khách.\n\n– Món Salad rong biển chấm kèm xốt mè rang béo, chua, ngọt kết hợp rau quả đúng là một hương vị không thể bỏ qua được', 'Salad-Rong-Bien-1-1_1665635240.png', 4, 1),
(9, 'salad_002', 'Salad Bò', 5, 125000, 'VND', 'Bò Úc Teri – Salad rau healthy\n\nSalad Bò số lượng\n1', '2', '– Một phần Salad Bò gồm có thịt bò xào chín tới kết hợp cùng nhiều loại rau, của, quả healthy là một món ăn giải nhiệt hiệu quả\n\n– Hương vị mát, ngọt của salad rau củ hòa cùng thịt bò mềm dai thơm ngon tạo nên một món ăn cực kì hấp dẫn\n\n– Đối với món ăn này nên chấm kèm một ít xốt mè rang béo thơm sẽ kích thích vị giác rất nhiều.', 'Salad-Bo-1_1665635281.png', 4, 1),
(10, 'salad_003', 'Salad Bơ Thanh Cua', 5, 99000, 'VND', 'Thanh Cua – Salad Rau Củ Healthy', '2', '– Salad Bơ Thanh Cua gồm có món chính là thanh cua, bơ ăn kèm với đậu hũ non và rau của healthy.\n\n– Salad có vị ngọt của thanh cua, thêm vị tươi mát của rau củ quả ăn kèm và vị béo nhẹ của đậu hũ non.\n\n– Chấm kèm một ít nước xốt mè rang làm tăng mỹ vị của món ăn hơn.', 'Salad-Bo-Thanh-Cua-1_1665635326.png', 4, 1),
(11, 'bento_001', 'Bento Gà Áp Chảo Xốt Teri', 5, 125000, 'VND', 'Gà Xốt Teri – Cơm – Gà Chiên – Salad', '2', '– Salad Bơ Thanh Cua gồm có món chính là thanh cua, bơ ăn kèm với đậu hũ non và rau của healthy.\n\n– Salad có vị ngọt của thanh cua, thêm vị tươi mát của rau củ quả ăn kèm và vị béo nhẹ của đậu hũ non.\n\n– Chấm kèm một ít nước xốt mè rang làm tăng mỹ vị của món ăn hơn.', 'Bento-Ga-Ap-Chao-Sot-Teri-800x800-1_1665635396.png', 5, 1),
(12, 'bento_002', 'Bento Thịt Heo Xào Gừng', 5, 85000, 'VND', 'Thịt Heo Xào Gừng – Cơm – Gà Chiên – Salad', '2', '– Một phần Bento Thịt Heo Xào Gừng gồm cơm, món chính và các món ăn kèm. Bề ngoài bắt mắt với nhiều màu sắc đa dạng, đảm bảo dinh dưỡng cho bữa ăn trong ngày.\n\n– Đây là sự kết hợp giữa thịt heo và gừng cay, tạo nên hương vị lạ miệng nhưng rất đậm đà.\n\n– Bên cạnh dùng cơm với thịt heo xào gừng thì có thêm gà chiên và một ít salad để chống ngấy.', 'BENTO-THIT-HEO-800x800-1_1665635441.png', 5, 1),
(13, 'rice_001', 'Cơm Lươn Nhật', 5, 159000, 'VND', 'Cơm – Lươn Nhật – Trứng Sushi', '2', '– Phần cơm lươn Nhật bao gồm trứng sushi, rau cùng thịt lươn vừa ăn, có màu nâu sáng bóng vô cùng đẹp mắt. \n\n– Thịt lươn thấm đều hương vị đậm đà từ nước xốt và vẫn giữ được độ mềm ngọt, tươi ngon vốn có tạo nên bữa ăn đủ dinh dưỡng trong ngày.\n\n– Món ăn này có thể ăn với nước tương Nhật đi kèm.', 'Com-Luon-Nhat-1_1665635505.png', 6, 1),
(14, 'rice_002', 'Cơm hàu Nhật', 5, 165000, 'VND', 'Cơm – Hàu – Trứng', '2', '– Cơm hàu Nhật gồm hàu tươi, trứng và một ít gia vị, nước xốt chuẩn Nhật\n\n– Vị ngọt của hàu hoà quyện với trứng cùng với một chút vị cay của gừng hồng bào nhuyễn tạo nên hương vị đậm đà, đưa cơm.\n\n– Đối với món ăn này có thể ăn kèm với wasabi.', 'Com-hau-Nhat-1_1665635552.png', 6, 1),
(15, 'rice_003', 'Cơm Cá Hồi Bơ', 5, 145000, 'VND', 'Cá Hồi – Bơ – Trứng Cá Hồi – Cơm', '2', '– Đây là món ăn ngon kết hợp giữa cá hồi với bơ trái tươi, trứng cá hồi, rong nho. Món ăn rất dễ làm, cung cấp đầy đủ chất dinh dưỡng. \n\n– Hương vị mằn mặn của cá hoà trộn cùng cơm trắng và vị béo của bơ tạo nên món ăn bổ dưỡng, mới lạ và độc đáo.\n\n– Đối với món ăn này có thể ăn kèm với nước tương Nhật đi kèm.', 'Com-Ca-Hoi-Bo-1_1665635600.png', 6, 1),
(16, 'drink_001', 'Trà Đậu Đen Rang Dâu Atiso Đỏ', 5, 35000, 'VND', '\"\"', '2', '\"\"', 'tra-dau-den_1665635681.png', 7, 1),
(17, 'drink_002', 'Trà Gạo Rang Lài Táo', 5, 29000, 'VND', '\"\"', '2', '\"\"', 'tra-gao-rang-lai-tao_1665635713.png', 7, 1),
(18, 'drink_003', 'Tía Tô Dâu Tằm', 5, 19000, 'VND', '\"\"', '2', '\"\"', 'tia-to-dau-tam_1665635738.png', 7, 1),
(19, 'drink_004', 'Trà Dâu Atiso Đỏ', 5, 29000, 'VND', '\"\"', '2', '\"\"', 'tra-dau-atiso-do_1665635765.png', 7, 1),
(20, 'combo_sushi_001', 'Combo Sushi 4', 5, 225000, 'VND', 'Sushi Cá Hồi – Sushi Cá Ngừ – Sushi Cá Trích – Sushi Sò Đỏ – Sushi Tôm', '2', '– Combo Sushi 4 là sự kết hợp của cá, tôm và sò. Màu sắc được bài trí rực rỡ, bắt mắt.\n\n– Cảm giác mềm, mọng nước tan trong miệng của cá và tôm. Sò, trứng cá trích dai ngon, nổ tanh tách trong miệng, kích thích vị giác.\n\n– Món được ăn kèm cùng nước tương nhật và wasabi.', 'Combo-Sushi-4-1_1665635977.png', 8, 1),
(21, 'combo_sushi_002', 'Combo Sushi 1', 5, 149000, 'VND', 'Maki Bơ – Sushi Sò Đỏ – Sushi Cá Trích – Sushi Cá Hồi – Sushi Cá Cam – Sushi Tôm', '2', '– Combo sushi 1 là sự hòa quyện đầy màu sắc của nhiều loại sushi đa dạng, làm phong phú thêm cho bữa ăn.\n\n– Có quá nhiều sự ưa thích dành cho sushi, không biết chọn loại nào thì đây là một gợi ý với vị béo đặc trưng của cá hồi, dai giòn sừng sực sò đỏ và cá trích ép trứng cùng vị tươi rói rói của tôm sẻ chiều lòng nhiều thực khách.\n\n– Bạn có thể ăn kèm cùng với nước tương nhật và wasabi.', 'Combo-Sashimi-15-7-1_1665636020.png', 8, 1),
(22, 'combo_sushi_003', 'Combo Sushi 2', 5, 149000, 'VND', 'Roll Trứng Cá Chuồn – Sushi Sò Đỏ – Sushi Cá Trích – Sushi Cá Cam – Sushi Cá Hồi – Sushi Tôm', '2', '– Nhiều loại sushi được phục vụ trong combo này, đa dạng mùi vị, đa dạng màu sắc, mang đến những trải nghiệm khác biệt cho quý thực khách.\n\n– Ở combo này quý thực khách sẽ tận hưởng vị béo đặc trưng của cá hồi và trứng ép cá trích, dai giòn của sò đỏ, bạch tuộc, tiếng nổ tanh tách của trứng cá chuồn, và không thể thiếu vị ngọt thơm của cơm dẻo.\n\n– Bạn có thể ăn kèm cùng với nước tương nhật và wasabi.', 'Combo-Sashimi-15-8-1_1665636060.png', 8, 1),
(23, 'combo_sushi_004', 'Combo Sushi 3', 5, 165000, 'VND', 'Sushi Thanh Cua – Sushi Bạch Tuột – Sushi Cá Hồi – Sushi Trứng – Sushi Lươn Nhật', '2', '– Những miếng sushi to đẹp được xếp đều đặn trông thật bắt mắt, combo là sự hòa hợp màu sắc giữa đỏ, vàng, cam, trắng khiến ai nhìn vào cũng không thể cưỡng lại.\n\n– Combo sushi 3 là sự hòa quyện của vị thơm nguyên bản trong lươn áp chảo, vị béo xốp của trứng, vị béo mền của cá hồi, dai giòn của bạch tuộc, và thơm mùi biển cả của thanh cua.\n\n– Món được ăn kèm cùng nước tương nhật và wasabi.', 'COMBO-SUSHI-3_1665636107.png', 8, 1),
(24, 'combo_sashimi_001', 'Combo Sashimi 14', 5, 560000, 'VND', 'Cá Hồi – Cá Trích – Bạch Tuộc – Sò Đỏ', '2', '– Một phần combo này gồm 4 loại sashimi tươi, màu sắc phong phú, hút mắt thực khách.\n\n– Khi thưởng thức có vị dai, giòn,ngọt béo kết hợp làm thực khách không thể quên được hương vị này. \n\n– Đối với món này, ăn kèm với với Gừng Chua – Tía tô chấm kèm nước tương Nhật và wasabi.', 'Combo-Sashimi-14-1_1665636253.png', 9, 1),
(25, 'combo_sashimi_002', 'Combo Sashimi 02', 5, 305000, 'VND', 'Cá Hồi – Cá Ngừ – Cá Trích – Bạch Tuộc', '2', '-Combo sashimi số 2 gồm 4 loại sashimi với nhiều màu trắng, cam, vàng, đỏ. Tổng thể nhìn hài hòa, kích thích thị giác thực khách.\n\n-Đây là sự kết hợp của nhiều hương vị béo, mọng nước, thơm, dai tạo cho thực khách một cảm giác thoải mái, dễ chịu.\n\n-Chấm cùng với nước tương Nhật và Wasabi, ngoài ra còn kết hợp thêm ít Gừng Chua – Tía Tô.. để tăng hương vị.', 'Combo-Sashimi-02-1_1665636328.png', 9, 1),
(26, 'combo_sashimi_003', 'Combo Sashimi 12', 5, 565000, 'VND', 'Cá Ngừ – Cá Hồi – Cá Trích –  Cá Cam', '2', '– Combo sashimi 12 gồm 4 loại cá tươi ngon, đảm bảo cung cấp đầy đủ dinh dưỡng cho cơ thể.\n\n– Khi ăn sẽ cảm nhận được vị ngọt thịt, sashimi tươi nên không tanh không ngấy, càng ăn càng cuốn.\n\n– Chấm cùng với nước tương Nhật và Wasabi, ngoài ra còn kết hợp thêm ít Gừng Chua – Tía Tô.. để tăng hương vị.', 'Thiet-ke-chua-co-ten-2-1_1665636372.png', 9, 1),
(27, 'com-vn', 'Com viet nam', 0, 123000, 'vnd', 'com-nuoc mam', '10000', NULL, 'product-com-vietnam_1665679389.png', 15, 1),
(28, 'com-vn-update', 'Com viet nam update', 0, 999, 'vnd', 'com-nuoc mam update', '999', NULL, 'product-com-vietnam_1665679565.png', 14, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_types`
--

CREATE TABLE `product_types` (
  `TYPE_ID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_show` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_types`
--

INSERT INTO `product_types` (`TYPE_ID`, `Name`, `is_show`, `icon`) VALUES
(1, 'Bộ sưu tập sushi', '1', '1000000000_1665632861.png'),
(2, 'Sashimi', '1', 'sashimi_1665632888.png'),
(3, 'Sushi', '1', 'sushi_1665632911.png'),
(4, 'Salad', '1', 'salad_1665632920.png'),
(5, 'Bento', '1', 'bento_1665632928.png'),
(6, 'Cơm Nhật', '1', 'com-nhat_1665632937.png'),
(7, 'Đồ uống', '1', 'do-uong_1665632955.png'),
(8, 'Combo sushi', '1', 'combo-sushi_1665632965.png'),
(9, 'Combo sashimi', '1', 'combo-sashimi_1665632977.png'),
(10, 'Sản phẩm đóng gói', '1', 'san-pham-dong-goi_1665632988.png'),
(11, 'Giao hàng đúng giờ', '1', 'giao-hang-dung-gio_1665633002.png'),
(12, 'Miễn phí đổi trả trong 7 ngày', '1', 'mien-phi-doi-tra-hang_1665633024.png'),
(13, 'Ưu đãi', '1', 'uu-dai_1665633034.png'),
(14, 'test dt', '0', 'database_1665678459.png'),
(15, 'test dt 2 thay doi', '1', 'database_1665678692.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`) VALUES
(5, 'User', 'user@gmail.com', 'user', '$2y$10$2xegSkKuLjWIAna8xdRwp.dmNuT3BOzng9gVdXZWKGPoPMCxGCD8K', NULL, '2022-10-06 14:40:53', NULL, ''),
(6, 'Administrator', 'admin@gmail.com', 'admin', '$2y$10$j1cctTqfsYkFOfq03MWhm.mdwbH8ml.1yepdqvoWFYOslSKr4RbNu', NULL, '2022-10-06 14:41:26', NULL, ''),
(7, 'Dinh Thanh Tuan', 'tuandt@email.com', '034123123', '$2y$10$ADS8npSvYBjHt0JXaCdC8.xoO7noM8Nh7gFe8BU.NVXvS4XsnxvXC', NULL, '2022-10-13 09:20:25', '2022-10-13 09:20:25', '034123123'),
(8, 'Huynh Duc', 'ducdt@email.com', '03413123', '$2y$10$PTDc4pEaMa7fCyyePn0dsunDKQzsJBrjywttYWiP2oZYZatvnfc1K', NULL, '2022-10-13 10:22:45', '2022-10-13 10:22:45', '03413123'),
(9, 'Huynhhh Duc', 'duuucdt@email.com', '031231223', '$2y$10$E5VB2FSRIjzr04CnSIujEuB3vpV/xQr3ONxDG2xHfdC8vE/vyxG2K', NULL, '2022-10-13 11:18:45', '2022-10-13 11:18:45', '031231223');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Chỉ mục cho bảng `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`EMP_ID`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`PRO_ID`),
  ADD KEY `products_type_id_foreign` (`TYPE_ID`);

--
-- Chỉ mục cho bảng `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`TYPE_ID`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `employees`
--
ALTER TABLE `employees`
  MODIFY `EMP_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `PRO_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `product_types`
--
ALTER TABLE `product_types`
  MODIFY `TYPE_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_type_id_foreign` FOREIGN KEY (`TYPE_ID`) REFERENCES `product_types` (`TYPE_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
