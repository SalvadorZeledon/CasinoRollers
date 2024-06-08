-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 08-06-2024 a las 07:01:30
-- Versión del servidor: 10.3.39-MariaDB-0ubuntu0.20.04.2
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `casino`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarProgreso` (IN `p_userId` INT, IN `p_resultado` VARCHAR(10))   BEGIN
    DECLARE userCoin INT;

    IF p_resultado = 'ganados' THEN
        UPDATE progreso SET ganados = ganados + 1, puntos = puntos + 100 WHERE idUser = p_userId;
    ELSEIF p_resultado = 'perdidos' THEN
        UPDATE progreso SET perdidos = perdidos + 1, puntos = puntos + 10 WHERE idUser = p_userId;
        UPDATE user SET fichas = fichas - 1 WHERE ID = p_userId;
    ELSEIF p_resultado = 'empate' THEN
        UPDATE progreso SET empate = empate + 1, puntos = puntos + 50 WHERE idUser = p_userId;
        UPDATE user SET fichas = fichas - 1 WHERE ID = p_userId;
    END IF;

    SELECT fichas INTO userCoin FROM user WHERE ID = p_userId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `autenticar_usuario` (IN `p_email` VARCHAR(255), IN `p_password` VARCHAR(255), OUT `p_userId` INT, OUT `p_fichas` INT, OUT `p_userName` VARCHAR(255), OUT `p_error_message` VARCHAR(255))   BEGIN
    -- Validar que p_email y p_password no estén vacíos
    IF p_email IS NULL OR p_email = '' THEN
        SET p_error_message = 'El email no puede estar vacío';
    ELSEIF p_password IS NULL OR p_password = '' THEN
        SET p_error_message = 'La contraseña no puede estar vacía';
    ELSE
        -- Todos los campos están llenos, proceder con la selección
        SELECT COUNT(*)
        INTO @user_found
        FROM user
        WHERE email = p_email AND password = p_password;
        
        IF @user_found = 0 THEN
            SET p_error_message = 'Usuario no encontrado';
        ELSE
            -- Usuario encontrado, obtener sus datos
            SELECT ID, fichas, nombre
            INTO p_userId, p_fichas, p_userName
            FROM user
            WHERE email = p_email AND password = p_password;
            
            SET p_error_message = NULL; -- No hay error
        END IF;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarProgreso` (IN `p_id_usuario` INT)   BEGIN
    INSERT INTO progreso (idUser, ganados, perdidos, empate, puntos)
    VALUES (p_id_usuario, 0, 0, 0, 0);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_usuario` (IN `p_nombre` VARCHAR(255), IN `p_edad` INT, IN `p_email` VARCHAR(255), IN `p_password` VARCHAR(255), OUT `p_id_usuario` INT, OUT `p_error_message` VARCHAR(255))   BEGIN
    -- Validar que ninguno de los campos esté vacío
    IF p_nombre IS NULL OR p_nombre = '' THEN
        SET p_error_message = 'El nombre no puede estar vacío';
    ELSEIF p_edad IS NULL THEN
        SET p_error_message = 'La edad no puede estar vacía';
    ELSEIF p_email IS NULL OR p_email = '' THEN
        SET p_error_message = 'El email no puede estar vacío';
    ELSEIF p_password IS NULL OR p_password = '' THEN
        SET p_error_message = 'La contraseña no puede estar vacía';
    ELSE
        -- Todos los campos están llenos, proceder con la inserción
        INSERT INTO user (nombre, edad, email, password, fichas)
        VALUES (p_nombre, p_edad, p_email, p_password, 5);
        
        SET p_id_usuario = LAST_INSERT_ID();
        SET p_error_message = NULL; -- No hay error
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerIDPorEmail` (IN `userEmail` VARCHAR(255), OUT `userId` INT)   BEGIN
    SELECT id INTO userId FROM user WHERE email = userEmail;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerIDPorEmail2` (IN `p_email` VARCHAR(100), OUT `p_id` INT)   BEGIN
    SELECT ID INTO p_id
    FROM user
    WHERE email = p_email;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerTopUsuarios` ()   BEGIN
    SELECT u.nombre, u.fichas, p.ganados, p.perdidos, p.puntos
    FROM user u
    INNER JOIN progreso p ON u.ID = p.idUser
    ORDER BY p.puntos DESC
    LIMIT 10;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `progreso`
--

CREATE TABLE `progreso` (
  `ID` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `ganados` int(11) NOT NULL,
  `perdidos` int(11) NOT NULL,
  `empate` int(11) NOT NULL,
  `puntos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `progreso`
--

INSERT INTO `progreso` (`ID`, `idUser`, `ganados`, `perdidos`, `empate`, `puntos`) VALUES
(63, 64, 4, 3, 2, 530),
(64, 65, 7, 4, 1, 790),
(65, 66, 0, 0, 0, 0),
(66, 67, 3, 5, 0, 350),
(67, 68, 0, 0, 0, 0),
(68, 69, 4, 5, 0, 450),
(69, 70, 0, 0, 0, 0),
(70, 71, 4, 2, 3, 570),
(71, 72, 2, 3, 2, 330),
(72, 73, 4, 4, 1, 490),
(73, 74, 3, 2, 3, 470),
(74, 75, 0, 0, 0, 0),
(75, 76, 5, 5, 0, 550),
(76, 77, 0, 0, 0, 0),
(77, 78, 4, 5, 0, 450),
(78, 79, 8, 5, 0, 850),
(79, 80, 5, 4, 1, 590),
(80, 81, 4, 5, 0, 450),
(81, 82, 3, 5, 0, 350),
(82, 83, 4, 2, 3, 570),
(83, 84, 4, 5, 0, 450),
(84, 85, 5, 4, 1, 590),
(85, 86, 5, 5, 0, 550),
(86, 87, 3, 5, 0, 350),
(87, 88, 0, 0, 0, 0),
(88, 89, 3, 4, 1, 390),
(89, 90, 5, 5, 0, 550),
(90, 91, 0, 0, 0, 0),
(91, 92, 2, 5, 0, 250),
(92, 93, 9, 5, 0, 950),
(93, 94, 0, 0, 0, 0),
(94, 95, 8, 5, 0, 850),
(95, 96, 5, 5, 0, 550),
(96, 97, 3, 4, 1, 390),
(97, 98, 1, 5, 0, 150),
(98, 99, 2, 3, 2, 330),
(99, 100, 5, 5, 0, 550),
(100, 101, 1, 3, 2, 230),
(101, 102, 2, 1, 4, 410),
(102, 103, 5, 5, 0, 550),
(103, 104, 0, 0, 0, 0),
(104, 105, 1, 5, 0, 150),
(105, 106, 3, 5, 0, 350),
(106, 107, 2, 5, 0, 250),
(107, 108, 1, 4, 0, 140),
(108, 109, 7, 5, 0, 750),
(109, 110, 2, 5, 0, 250),
(110, 111, 4, 2, 3, 570),
(111, 112, 1, 5, 0, 150),
(112, 113, 5, 3, 2, 630),
(113, 114, 5, 5, 0, 550),
(114, 115, 3, 5, 0, 350),
(115, 116, 2, 4, 1, 290),
(116, 117, 3, 5, 0, 350),
(117, 118, 2, 5, 0, 250),
(118, 119, 0, 0, 0, 0),
(119, 120, 3, 4, 1, 390),
(120, 121, 4, 5, 0, 450),
(121, 122, 3, 5, 0, 350),
(122, 123, 11, 5, 0, 1150),
(123, 124, 0, 0, 0, 0),
(124, 125, 3, 4, 1, 390),
(125, 126, 3, 5, 0, 350),
(126, 127, 4, 1, 0, 410),
(127, 128, 0, 0, 0, 0),
(128, 129, 10, 5, 0, 1050),
(129, 130, 8, 5, 0, 850);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `edad` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fichas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`ID`, `nombre`, `edad`, `email`, `password`, `fichas`) VALUES
(64, 'Drodrigo', 26, 'rr@gmail.com', 'rrrr', 0),
(65, 'Berserker', 23, 'salvadorzeledon9@gmail.com', 'root', 0),
(66, 'Admin', 23, 'admin@gmail.com', 'root', 5),
(67, 'Melissa', 20, 'kennyolivares220@gmail.com', 'juegossv', 0),
(68, 'William Bonilla ', 25, 'shadow.bonilla2444@gmail.com', '123456789', 5),
(69, 'William', 24, 'josefina@gmail.com', '12345', 0),
(70, 'Adriana', 23, 'adrianaperezlc23@gmail.com', '123', 5),
(71, 'Cesar', 41, 'moralescesar77@gmail.com', '3141', 0),
(72, 'Melissa2', 20, 'nanism600@gmail.com', 'juegossv', 0),
(73, 'JoseUrias', 22, 'uriasj22@gmail.com', 'Joseurias22', 0),
(74, 'Hhjjkk ', 18, 'hessyvalle@gmail.com', 'Straykids', 0),
(75, 'Jhonathan ancheta', 18, 'janchetairaheta@gmail.com', 'Anchetairaheta.04', 5),
(76, 'David', 27, 'davidezequielcernaochoa@gmail.com', '1996', 0),
(77, 'Jhonathan ancheta Iraheta', 18, 'ai24i08001@usosonsonate.edu.sv', 'Anchetairaheta.04', 5),
(78, 'Andmlop', 24, 'Andrea.lopez.amlo@gmail.com', 'D4zn2hmx', 0),
(79, 'Jonathan Ancheta', 18, 'aletobar44@gmail.com', '12345', 0),
(80, 'Khada', 25, 'zavaletalainez@gmail.com', 'zavaletta64', 0),
(81, 'Alejandro ', 21, 'alejandri.chilin@gmail.com', '153624Arz', 0),
(82, 'Zavaleta', 25, 'zl18e01001@usonsonate.edu.sv', 'zavaletta64', 0),
(83, 'Julio', 21, 'julioriveraaguilar9@gmail.com', 'Uso123', 0),
(84, 'YuvelRivera', 22, 'yuligau2416@gmail.com', '1234', 0),
(85, 'Joseline ', 22, 'jdanaguecru@gmail.com', '12345678d', 0),
(86, 'Alfonso', 22, 'alfonsoaguilat@clases.edu.sv', '12345678', 0),
(87, 'Ernmor', 25, 'ernmor2305@gmail.com', 'hola', 0),
(88, 'Keiry', 21, 'frailekeiry@gmail.com', '70895929k', 5),
(89, 'Keiry', 21, 'fm21i03001@usonsonate.edu.sv', '1234', 0),
(90, 'Franklin', 22, 'ra00192019@gmail.com', '12345', 0),
(91, 'Steven ', 21, 'sg616716@gmail.com', 'sonsonate503sv', 5),
(92, 'Josue', 21, 'hernandezaranajosue4@gmail.com', 'Josue', 0),
(93, 'Steven ', 21, 'steven503@gmail.com', 'steven', 0),
(94, 'Rodrigo ', 18, 'mendezmedina2611@gmail.com', '1', 5),
(95, 'remm', 24, 'mm18e03003@usonsonate.edu.sv', '1234', 0),
(96, 'Erick', 21, 'cacereserick624@gmail.com', '12345678', 0),
(97, 'Adriana', 22, 'adrianamarcela.santamaria02@gmail.com', '1234', 0),
(98, 'SOLECITO', 32, 'yesicadecortez17@gmail.com', '1234', 0),
(99, 'Melissa09', 21, 'statick52@gmail.com', '1234', 0),
(100, 'Anddd', 24, 'Andrea.lopez.amloo@gmail.com', 'andrea', 0),
(101, 'Tatiana', 19, 'katherinecazun27g@gmail.com', '1234', 0),
(102, 'Hazel', 23, 'Rm19i01003@usonsonate.edu.sv', '1234', 0),
(103, 'Gudiel C', 22, 'jose511gudiel@gmail.com', 'el511', 0),
(104, 'Wick', 22, 'aquinojonthan344@gmail.com', 'marcella', 5),
(105, 'Andrellaaw ', 22, 'andreaaguilar5455@gmail.com', 'aguilarmar', 0),
(106, 'Wick', 22, 'jvalleaquino@yahoo.com', 'Marcella', 0),
(107, 'Keila Styles', 21, 'keila.styles1313@gmail.com', '12345', 0),
(108, 'Alex', 22, 'diegogt.santiago@gmail.com', '1234', 1),
(109, 'Jorge', 22, 'a@gmail.com', '1234', 0),
(110, 'NohemiRamos', 24, 'ramosgilma122@gmail.com', '1234', 0),
(111, 'Elvira', 22, 'elvirahuezo.o1@gmail.com', '1234', 0),
(112, 'Jenniffer', 24, 'mjenniffer951@gmail.com', '2114', 0),
(113, 'YeriZ_0', 20, 'fredycampos726@gmail.com', '1234', 0),
(114, 'Leslie', 22, 'll0302915@gmail.com', 'leslie', 0),
(115, 'Alejandra ', 23, 'adelaargueta28@gmail.com', 'jaja28', 0),
(116, 'Kenita', 22, 'zkeniajulissa@gmail.com', '1234', 0),
(117, 'Jezreel ', 21, 'jezreelmusto@gmail.com', 'Kanukles2', 0),
(118, 'Fernando', 20, 'fernandovanegas2002@gmail.com', '1234', 0),
(119, 'Yohalmo', 22, 'yohalmoavg@gmail.com', '123', 5),
(120, 'Menhdez ', 30, 'menhdez020@gmail.com', 'Usonsonate24', 0),
(121, 'Yohalmo', 22, 'Yohalexandervg@gmail.com', '12345', 0),
(122, 'Jonathan', 19, 'mm23i04001@usonsonate.edu.sv', 'Jonathan1500', 0),
(123, 'AxelGil863', 19, 'axelgil863@gmail.com', 'telefono1', 0),
(124, 'Volib', 19, 'juanfrancisco010805@gmail.com', 'nIdwid-vutbyw-kimmy7', 5),
(125, 'Volib', 19, 'juanfrancisco@gmail.com', 'Jfrm010805', 0),
(126, 'Nestor', 21, 'nestorgarzona1030@gmail.com', '12345', 0),
(127, 'JesusAmaya', 18, 'ag22i04002@usonsonate.edu.sv', '1234', 4),
(128, 'Jonathan ', 24, 'cjonathanlopez4@gmail.com', '12345', 5),
(129, 'JonathanAlexande', 24, 'lc22i01001@usonsonate.edu.sv', '12345678', 0),
(130, 'JonathanAlex', 24, 'alexlopez-cortez@hotmail.com', '12345678', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `progreso`
--
ALTER TABLE `progreso`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `idUser` (`idUser`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `progreso`
--
ALTER TABLE `progreso`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `progreso`
--
ALTER TABLE `progreso`
  ADD CONSTRAINT `progreso_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`ID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
