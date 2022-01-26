-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 26 Oca 2022, 19:22:30
-- Sunucu sürümü: 5.7.31
-- PHP Sürümü: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `osmanblog_db`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `admin_surname` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `admin_kullanici_adi` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `admin_mail` text COLLATE utf8_turkish_ci NOT NULL,
  `admin_password` text COLLATE utf8_turkish_ci NOT NULL,
  `admin_status` text COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `admin`
--

INSERT INTO `admin` (`id`, `admin_name`, `admin_surname`, `admin_kullanici_adi`, `admin_mail`, `admin_password`, `admin_status`) VALUES
(1, 'osman', 'onat', 'osmanonat', 'osmanonat@gmail.com', 'osman131518', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `duyurular`
--

DROP TABLE IF EXISTS `duyurular`;
CREATE TABLE IF NOT EXISTS `duyurular` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `duyuru` text COLLATE utf8_turkish_ci NOT NULL,
  `duyuru_durum` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `duyurular`
--

INSERT INTO `duyurular` (`id`, `duyuru`, `duyuru_durum`) VALUES
(1, 'Selam Ben Osman', 0),
(4, 'Bu Bir Deneme Duyurusudur!', 0),
(5, 'Blog Sitesine HoÅŸgeldiniz!', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `iletisim`
--

DROP TABLE IF EXISTS `iletisim`;
CREATE TABLE IF NOT EXISTS `iletisim` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iletisim_isim` text COLLATE utf8_turkish_ci NOT NULL,
  `iletisim_mail` text COLLATE utf8_turkish_ci NOT NULL,
  `iletisim_icerik` text COLLATE utf8_turkish_ci NOT NULL,
  `iletisim_durum` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategoriler`
--

DROP TABLE IF EXISTS `kategoriler`;
CREATE TABLE IF NOT EXISTS `kategoriler` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `kategori_isim` text COLLATE utf8_turkish_ci NOT NULL,
  `kategori_seo` text COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kategoriler`
--

INSERT INTO `kategoriler` (`id`, `kategori_isim`, `kategori_seo`) VALUES
(1, 'Yazilim', 'yazilim'),
(2, 'SEO', 'seo'),
(4, 'WordPress', 'wordpress'),
(5, 'Motivasyon', 'motivasyon');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yazilar`
--

DROP TABLE IF EXISTS `yazilar`;
CREATE TABLE IF NOT EXISTS `yazilar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `yazi_baslik` text COLLATE utf8_turkish_ci NOT NULL,
  `yazi_baslik_seo` text COLLATE utf8_turkish_ci NOT NULL,
  `yazi_kategori` text COLLATE utf8_turkish_ci NOT NULL,
  `yazi_icerik` text COLLATE utf8_turkish_ci NOT NULL,
  `yazi_begeni` int(11) NOT NULL,
  `yazi_yorum` int(11) NOT NULL,
  `yazi_durum` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorumlar`
--

DROP TABLE IF EXISTS `yorumlar`;
CREATE TABLE IF NOT EXISTS `yorumlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `yorum_ad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `yorum_email` text COLLATE utf8_turkish_ci NOT NULL,
  `yorum_message` text COLLATE utf8_turkish_ci NOT NULL,
  `yorum_link` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `yorum_durum` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `yorumlar`
--

INSERT INTO `yorumlar` (`id`, `yorum_ad`, `yorum_email`, `yorum_message`, `yorum_link`, `yorum_durum`) VALUES
(4, 'osman 2', 'osmanonat@gmail.com', 'adsadsadasdasdsadsdasdsad', 'yazilima-baslarken-nelere-dikkat-edilmeli', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
