-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 13, 2018 at 10:37 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scraper`
--

-- --------------------------------------------------------

--
-- Table structure for table `challenges`
--

DROP TABLE IF EXISTS `challenges`;
CREATE TABLE IF NOT EXISTS `challenges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `difficulty` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `hint` text NOT NULL,
  `note` text NOT NULL,
  `url` text NOT NULL,
  `solved` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `challenges`
--

INSERT INTO `challenges` (`id`, `title`, `difficulty`, `description`, `hint`, `note`, `url`, `solved`) VALUES
(4, 'Sum square difference', 'easy', '<p>The sum of the squares of the first ten natural numbers is,</p><p>The square of the sum of the first ten natural numbers is,</p><p>Hence the difference between the sum of the squares of the first ten natural numbers and the square of the sum is 3025 âˆ’ 385 = 2640.</p><p>Find the difference between the sum of the squares of the first one hundred natural numbers and the square of the sum.</p>', 'none', 'none', 'https://projecteuler.net/problem=6', 0),
(3, 'Smallest multiple', 'easy', '<p>2520 is the smallest number that can be divided by each of the numbers from 1 to 10 without any remainder.</p><p>What is the smallest positive number that is evenly divisible by all of the numbers from 1 to 20?</p>', 'none', 'none', 'https://projecteuler.net/problem=5', 0),
(5, 'Largest palindrome product', 'easy', '<p>A palindromic number reads the same both ways. The largest palindrome made from the product of two 2-digit numbers is 9009 = 91 Ã— 99.</p><p>Find the largest palindrome made from the product of two 3-digit numbers.</p>', 'none', 'none', 'https://projecteuler.net/problem=4', 0),
(6, 'Multiples of 3 and 5', 'easy', '<p>If we list all the natural numbers below 10 that are multiples of 3 or 5, we get 3, 5, 6 and 9. The sum of these multiples is 23.</p><p>Find the sum of all the multiples of 3 or 5 below 1000.</p>', 'none', 'none', 'https://projecteuler.net/problem=1', 0),
(7, 'Even Fibonacci numbers', 'easy', '<p>Each new term in the Fibonacci sequence is generated by adding the previous two terms. By starting with 1 and 2, the first 10 terms will be:</p><p>1, 2, 3, 5, 8, 13, 21, 34, 55, 89, ...</p><p>By considering the terms in the Fibonacci sequence whose values do not exceed four million, find the sum of the even-valued terms.</p>', 'none', 'none', 'https://projecteuler.net/problem=2', 0),
(8, 'Largest prime factor', 'easy', '<p>The prime factors of 13195 are 5, 7, 13 and 29.</p><p>What is the largest prime factor of the number 600851475143 ?</p>', 'none', 'none', 'https://projecteuler.net/problem=3', 0),
(9, '10001st prime', 'easy', '<p>By listing the first six prime numbers: 2, 3, 5, 7, 11, and 13, we can see that the 6th prime is 13.</p><p>What is the 10 001st prime number?</p>', 'none', 'none', 'https://projecteuler.net/problem=7', 0),
(10, 'Largest product in a series', 'easy', '<p>The four adjacent digits in the 1000-digit number that have the greatest product are 9 Ã— 9 Ã— 8 Ã— 9 = 5832.</p><p>\n73167176531330624919225119674426574742355349194934\n96983520312774506326239578318016984801869478851843\n85861560789112949495459501737958331952853208805511\n12540698747158523863050715693290963295227443043557\n66896648950445244523161731856403098711121722383113\n62229893423380308135336276614282806444486645238749\n30358907296290491560440772390713810515859307960866\n70172427121883998797908792274921901699720888093776\n65727333001053367881220235421809751254540594752243\n52584907711670556013604839586446706324415722155397\n53697817977846174064955149290862569321978468622482\n83972241375657056057490261407972968652414535100474\n82166370484403199890008895243450658541227588666881\n16427171479924442928230863465674813919123162824586\n17866458359124566529476545682848912883142607690042\n24219022671055626321111109370544217506941658960408\n07198403850962455444362981230987879927244284909188\n84580156166097919133875499200524063689912560717606\n05886116467109405077541002256983155200055935729725\n71636269561882670428252483600823257530420752963450</p><p>Find the thirteen adjacent digits in the 1000-digit number that have the greatest product. What is the value of this product?</p>', 'none', 'none', 'https://projecteuler.net/problem=8', 0),
(11, 'Special Pythagorean triplet', 'easy', '<p>A Pythagorean triplet is a set of three natural numbers, a < b < c, for which,</p><p>For example, 32 + 42 = 9 + 16 = 25 = 52.</p><p>There exists exactly one Pythagorean triplet for which a + b + c = 1000.Find the product abc.</p>', 'none', 'none', 'https://projecteuler.net/problem=9', 0),
(12, 'Summation of primes', 'easy', '<p>The sum of the primes below 10 is 2 + 3 + 5 + 7 = 17.</p><p>Find the sum of all the primes below two million.</p>', 'none', 'none', 'https://projecteuler.net/problem=10', 0),
(13, 'Largest product in a grid', 'easy', '<p>In the 20Ã—20 grid below, four numbers along a diagonal line have been marked in red.</p><p>\n08 02 22 97 38 15 00 40 00 75 04 05 07 78 52 12 50 77 91 08\n49 49 99 40 17 81 18 57 60 87 17 40 98 43 69 48 04 56 62 00\n81 49 31 73 55 79 14 29 93 71 40 67 53 88 30 03 49 13 36 65\n52 70 95 23 04 60 11 42 69 24 68 56 01 32 56 71 37 02 36 91\n22 31 16 71 51 67 63 89 41 92 36 54 22 40 40 28 66 33 13 80\n24 47 32 60 99 03 45 02 44 75 33 53 78 36 84 20 35 17 12 50\n32 98 81 28 64 23 67 10 26 38 40 67 59 54 70 66 18 38 64 70\n67 26 20 68 02 62 12 20 95 63 94 39 63 08 40 91 66 49 94 21\n24 55 58 05 66 73 99 26 97 17 78 78 96 83 14 88 34 89 63 72\n21 36 23 09 75 00 76 44 20 45 35 14 00 61 33 97 34 31 33 95\n78 17 53 28 22 75 31 67 15 94 03 80 04 62 16 14 09 53 56 92\n16 39 05 42 96 35 31 47 55 58 88 24 00 17 54 24 36 29 85 57\n86 56 00 48 35 71 89 07 05 44 44 37 44 60 21 58 51 54 17 58\n19 80 81 68 05 94 47 69 28 73 92 13 86 52 17 77 04 89 55 40\n04 52 08 83 97 35 99 16 07 97 57 32 16 26 26 79 33 27 98 66\n88 36 68 87 57 62 20 72 03 46 33 67 46 55 12 32 63 93 53 69\n04 42 16 73 38 25 39 11 24 94 72 18 08 46 29 32 40 62 76 36\n20 69 36 41 72 30 23 88 34 62 99 69 82 67 59 85 74 04 36 16\n20 73 35 29 78 31 90 01 74 31 49 71 48 86 81 16 23 57 05 54\n01 70 54 71 83 51 54 69 16 92 33 48 61 43 52 01 89 19 67 48</p><p>The product of these numbers is 26 Ã— 63 Ã— 78 Ã— 14 = 1788696.</p><p>What is the greatest product of four adjacent numbers in the same direction (up, down, left, right, or diagonally) in the 20Ã—20 grid?</p>', 'none', 'none', 'https://projecteuler.net/problem=11', 0),
(14, 'Highly divisible triangular number', 'easy', '<p>The sequence of triangle numbers is generated by adding the natural numbers. So the 7th triangle number would be 1 + 2 + 3 + 4 + 5 + 6 + 7 = 28. The first ten terms would be:</p><p>1, 3, 6, 10, 15, 21, 28, 36, 45, 55, ...</p><p>Let us list the factors of the first seven triangle numbers:</p><p>We can see that 28 is the first triangle number to have over five divisors.</p><p>What is the value of the first triangle number to have over five hundred divisors?</p>', 'none', 'none', 'https://projecteuler.net/problem=12', 0),
(15, 'Large sum', 'easy', '<p>Work out the first ten digits of the sum of the following one-hundred 50-digit numbers.</p>', 'none', 'none', 'https://projecteuler.net/problem=13', 0),
(16, 'Longest Collatz sequence', 'easy', '<p>The following iterative sequence is defined for the set of positive integers:</p><p>n â†’ n/2 (n is even)n â†’ 3n + 1 (n is odd)</p><p>Using the rule above and starting with 13, we generate the following sequence:</p><p>It can be seen that this sequence (starting at 13 and finishing at 1) contains 10 terms. Although it has not been proved yet (Collatz Problem), it is thought that all starting numbers finish at 1.</p><p>Which starting number, under one million, produces the longest chain?</p><p>NOTE: Once the chain starts the terms are allowed to go above one million.</p>', 'none', 'none', 'https://projecteuler.net/problem=14', 0),
(17, 'Lattice paths', 'easy', '<p>Starting in the top left corner of a 2Ã—2 grid, and only being able to move to the right and down, there are exactly 6 routes to the bottom right corner.</p><p>How many such routes are there through a 20Ã—20 grid?</p>', 'none', 'none', 'https://projecteuler.net/problem=15', 0);

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

DROP TABLE IF EXISTS `favorites`;
CREATE TABLE IF NOT EXISTS `favorites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `challenge_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `challenge_id`, `status`) VALUES
(1, 1, 1, 0),
(2, 1, 2, 1),
(3, 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'Name', 'email@email.com', 'e99a18c428cb38d5f260853678922e03'),
(2, 'test user', 'test@test.com', 'e99a18c428cb38d5f260853678922e03');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
