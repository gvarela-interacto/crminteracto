-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 19-07-2025 a las 14:40:58
-- Versión del servidor: 8.0.42-0ubuntu0.22.04.1
-- Versión de PHP: 8.1.2-1ubuntu2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `templamos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bodegas`
--

CREATE TABLE `bodegas` (
  `id` int NOT NULL,
  `codigo` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `direccion` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `mst_paises_departamentos_ciudades__id` int DEFAULT NULL,
  `mst_paises_departamentos__id` int DEFAULT NULL,
  `mst_paises__id` int DEFAULT NULL,
  `tipo` enum('PRINCIPAL','SUCURSAL','TRANSITO','VIRTUAL','DAÑADOS','CONSIGNACION') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'PRINCIPAL',
  `capacidad_maxima` decimal(10,2) DEFAULT NULL,
  `unidad_capacidad_id` int DEFAULT NULL,
  `responsable_usuario_id` int DEFAULT NULL,
  `permite_ventas` enum('SI','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'SI',
  `permite_compras` enum('SI','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'SI',
  `maneja_ubicaciones` enum('SI','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'NO',
  `estado` enum('ACTIVO','INACTIVO','ELIMINADO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'ACTIVO',
  `creado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `usuario__id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bodega_ubicaciones`
--

CREATE TABLE `bodega_ubicaciones` (
  `id` int NOT NULL,
  `bodega_id` int NOT NULL,
  `codigo` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `pasillo` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `estante` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `nivel` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `capacidad_maxima` decimal(10,2) DEFAULT NULL,
  `tipo_ubicacion` enum('RECEPCION','ALMACENAMIENTO','PICKING','EMPAQUE','DESPACHO','CUARENTENA') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT 'ALMACENAMIENTO',
  `estado` enum('ACTIVO','INACTIVO','ELIMINADO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'ACTIVO',
  `creado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `usuario__id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

CREATE TABLE `cuentas` (
  `id` int NOT NULL,
  `tipo` enum('JURIDICA','NATURAL') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `nombre` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL COMMENT 'Razón social o Nombre de la persona',
  `razoncomercial` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `mst_identificacionTipo__Id` int DEFAULT NULL,
  `identificacion` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `website` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `direccion` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `mst_paises_departamentos_ciudades__id` int DEFAULT NULL,
  `mst_paises_departamentos__id` int DEFAULT NULL,
  `mst_paises__id` int DEFAULT NULL,
  `observaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `mst_cuentaTipo__id` int NOT NULL,
  `mst_sector__id` int DEFAULT NULL,
  `ciuu_primario` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `ciuu_secundario` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `nroMatricula` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `niif` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `capital_autorizado` float(20,2) DEFAULT NULL,
  `capital_suscrito` float(20,2) DEFAULT NULL,
  `capital_pagado` float(10,2) DEFAULT NULL,
  `empleados` int DEFAULT NULL,
  `creado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `estado` enum('ACTIVO','ELIMINADO','DESHABILITADO','PREINSCRIPCION') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `usuario__id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `cuentas`
--

INSERT INTO `cuentas` (`id`, `tipo`, `nombre`, `razoncomercial`, `mst_identificacionTipo__Id`, `identificacion`, `website`, `direccion`, `mst_paises_departamentos_ciudades__id`, `mst_paises_departamentos__id`, `mst_paises__id`, `observaciones`, `mst_cuentaTipo__id`, `mst_sector__id`, `ciuu_primario`, `ciuu_secundario`, `nroMatricula`, `niif`, `capital_autorizado`, `capital_suscrito`, `capital_pagado`, `empleados`, `creado`, `estado`, `usuario__id`) VALUES
(1, 'JURIDICA', 'INTERACTO SAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1741141549', 'ACTIVO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventarios`
--

CREATE TABLE `inventarios` (
  `id` int NOT NULL,
  `producto_id` int NOT NULL,
  `bodega_id` int NOT NULL,
  `ubicacion_id` int DEFAULT NULL,
  `stock_actual` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `stock_comprometido` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `stock_disponible` decimal(15,4) GENERATED ALWAYS AS ((`stock_actual` - `stock_comprometido`)) VIRTUAL,
  `stock_en_transito` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `costo_promedio` decimal(15,4) DEFAULT '0.0000',
  `costo_ultimo` decimal(15,4) DEFAULT '0.0000',
  `fecha_ultimo_movimiento` datetime DEFAULT NULL,
  `fecha_ultimo_ingreso` datetime DEFAULT NULL,
  `fecha_ultimo_egreso` datetime DEFAULT NULL,
  `observaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `estado` enum('ACTIVO','BLOQUEADO','ELIMINADO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'ACTIVO',
  `creado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `modificado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `usuario__id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventarios_fisicos`
--

CREATE TABLE `inventarios_fisicos` (
  `id` int NOT NULL,
  `numero_conteo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `nombre` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `fecha_corte` datetime NOT NULL,
  `bodega_id` int NOT NULL,
  `tipo_conteo` enum('TOTAL','PARCIAL','CICLICO','POR_CATEGORIA','POR_UBICACION') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'TOTAL',
  `estado` enum('PLANIFICADO','EN_PROCESO','FINALIZADO','AJUSTADO','CANCELADO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'PLANIFICADO',
  `permite_ajustes` enum('SI','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'SI',
  `bloquea_movimientos` enum('SI','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'NO',
  `observaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `creado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `finalizado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `usuario__id` int NOT NULL,
  `usuario_finaliza_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventarios_fisicos_detalle`
--

CREATE TABLE `inventarios_fisicos_detalle` (
  `id` int NOT NULL,
  `inventario_fisico_id` int NOT NULL,
  `producto_id` int NOT NULL,
  `ubicacion_id` int DEFAULT NULL,
  `lote_id` int DEFAULT NULL,
  `stock_sistema` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `stock_contado` decimal(15,4) DEFAULT NULL,
  `diferencia` decimal(15,4) GENERATED ALWAYS AS ((`stock_contado` - `stock_sistema`)) STORED,
  `costo_unitario` decimal(15,4) DEFAULT '0.0000',
  `valor_diferencia` decimal(15,4) GENERATED ALWAYS AS (((`stock_contado` - `stock_sistema`) * `costo_unitario`)) STORED,
  `motivo_diferencia` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `observaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `contado_por_usuario_id` int DEFAULT NULL,
  `fecha_conteo` datetime DEFAULT NULL,
  `estado` enum('PENDIENTE','CONTADO','AJUSTADO','DIFERENCIA') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'PENDIENTE',
  `creado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `usuario__id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_lotes`
--

CREATE TABLE `inventario_lotes` (
  `id` int NOT NULL,
  `numero_lote` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `producto_id` int NOT NULL,
  `bodega_id` int NOT NULL,
  `ubicacion_id` int DEFAULT NULL,
  `stock_actual` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `stock_inicial` decimal(15,4) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `fecha_produccion` date DEFAULT NULL,
  `proveedor_cuenta_id` int DEFAULT NULL,
  `documento_origen` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `costo_unitario` decimal(15,4) DEFAULT NULL,
  `observaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `estado` enum('ACTIVO','VENCIDO','BLOQUEADO','AGOTADO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'ACTIVO',
  `creado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `usuario__id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_series`
--

CREATE TABLE `inventario_series` (
  `id` int NOT NULL,
  `numero_serie` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `producto_id` int NOT NULL,
  `bodega_id` int NOT NULL,
  `ubicacion_id` int DEFAULT NULL,
  `lote_id` int DEFAULT NULL,
  `estado_serie` enum('DISPONIBLE','VENDIDO','DAÑADO','EN_REPARACION','RESERVADO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'DISPONIBLE',
  `fecha_ingreso` date NOT NULL,
  `fecha_venta` date DEFAULT NULL,
  `cliente_cuenta_id` int DEFAULT NULL,
  `proveedor_cuenta_id` int DEFAULT NULL,
  `documento_origen` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `garantia_meses` int DEFAULT NULL,
  `fecha_fin_garantia` date DEFAULT NULL,
  `observaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `creado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `usuario__id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos_inventario`
--

CREATE TABLE `movimientos_inventario` (
  `id` int NOT NULL,
  `numero_documento` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `tipo_movimiento_id` int NOT NULL,
  `fecha_movimiento` date NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bodega_origen_id` int DEFAULT NULL,
  `bodega_destino_id` int DEFAULT NULL,
  `cuenta_tercero_id` int DEFAULT NULL,
  `concepto` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `observaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `documento_referencia` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `valor_total` decimal(15,4) DEFAULT '0.0000',
  `estado` enum('BORRADOR','CONFIRMADO','ANULADO','APROBADO','RECHAZADO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'BORRADOR',
  `fecha_aprobacion` datetime DEFAULT NULL,
  `usuario_aprueba_id` int DEFAULT NULL,
  `motivo_anulacion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `creado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `modificado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `usuario__id` int NOT NULL,
  `usuario_modificado_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos_inventario_detalle`
--

CREATE TABLE `movimientos_inventario_detalle` (
  `id` int NOT NULL,
  `movimiento_id` int NOT NULL,
  `producto_id` int NOT NULL,
  `ubicacion_origen_id` int DEFAULT NULL,
  `ubicacion_destino_id` int DEFAULT NULL,
  `lote_id` int DEFAULT NULL,
  `cantidad` decimal(15,4) NOT NULL,
  `unidad_medida_id` int NOT NULL,
  `costo_unitario` decimal(15,4) DEFAULT '0.0000',
  `costo_total` decimal(15,4) GENERATED ALWAYS AS ((`cantidad` * `costo_unitario`)) STORED,
  `observaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `creado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `usuario__id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos_inventario_series`
--

CREATE TABLE `movimientos_inventario_series` (
  `id` int NOT NULL,
  `movimiento_detalle_id` int NOT NULL,
  `serie_id` int NOT NULL,
  `creado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `usuario__id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mst_categorias`
--

CREATE TABLE `mst_categorias` (
  `id` int NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `categoria_padre_id` int DEFAULT NULL,
  `estado` enum('ACTIVO','INACTIVO','ELIMINADO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'ACTIVO',
  `creado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `usuario__id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mst_cuentatipo`
--

CREATE TABLE `mst_cuentatipo` (
  `id` int NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `estado` enum('ACTIVO','INACTIVO','ELIMINADO') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mst_cuentatipo`
--

INSERT INTO `mst_cuentatipo` (`id`, `nombre`, `descripcion`, `estado`) VALUES
(1, 'CLIENTE', 'Cuenta destinada a usuarios que adquieren productos o servicios.', 'ACTIVO'),
(2, 'EMPLEADO', 'Cuenta para personal interno con acceso a funciones operativas, gestión de tareas y recursos según su rol asignado.', 'ACTIVO'),
(3, 'PROVEEDOR', 'Cuenta para terceros que suministran productos o servicios. Acceso a órdenes, entregas y gestión de inventario.', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mst_identificaciontipo`
--

CREATE TABLE `mst_identificaciontipo` (
  `id` int NOT NULL,
  `descripcion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `abreviacion` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `estado` enum('ACTIVO','INACTIVO') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mst_identificaciontipo`
--

INSERT INTO `mst_identificaciontipo` (`id`, `descripcion`, `abreviacion`, `estado`) VALUES
(1, 'CEDULA DE CIUDADANIA', 'CC', 'ACTIVO'),
(2, 'REGISTRO UNICO TRIBUTARIO', 'NIT', 'ACTIVO'),
(3, 'PASAPORTE', 'PP', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mst_marcas`
--

CREATE TABLE `mst_marcas` (
  `id` int NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `logo_url` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `estado` enum('ACTIVO','INACTIVO','ELIMINADO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'ACTIVO',
  `creado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `usuario__id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mst_movimiento_tipos`
--

CREATE TABLE `mst_movimiento_tipos` (
  `id` int NOT NULL,
  `codigo` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `tipo_movimiento` enum('ENTRADA','SALIDA','AJUSTE','TRANSFERENCIA') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `afecta_costo` enum('SI','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'SI',
  `requiere_aprobacion` enum('SI','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'NO',
  `genera_documento` enum('SI','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'NO',
  `consecutivo_automatico` enum('SI','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'SI',
  `estado` enum('ACTIVO','INACTIVO','ELIMINADO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'ACTIVO',
  `creado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `usuario__id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `mst_movimiento_tipos`
--

INSERT INTO `mst_movimiento_tipos` (`id`, `codigo`, `nombre`, `descripcion`, `tipo_movimiento`, `afecta_costo`, `requiere_aprobacion`, `genera_documento`, `consecutivo_automatico`, `estado`, `creado`, `usuario__id`) VALUES
(1, 'ENT_COMPRA', 'Entrada por Compra', 'Ingreso de productos por compra a proveedores', 'ENTRADA', 'SI', 'NO', 'NO', 'SI', 'ACTIVO', '1752903256', 1),
(2, 'ENT_DEVOL', 'Entrada por Devolución', 'Ingreso de productos devueltos por clientes', 'ENTRADA', 'SI', 'SI', 'NO', 'SI', 'ACTIVO', '1752903256', 1),
(3, 'ENT_AJUSTE', 'Entrada por Ajuste', 'Ajuste positivo de inventario', 'ENTRADA', 'SI', 'SI', 'NO', 'SI', 'ACTIVO', '1752903256', 1),
(4, 'SAL_VENTA', 'Salida por Venta', 'Salida de productos por venta', 'SALIDA', 'SI', 'NO', 'NO', 'SI', 'ACTIVO', '1752903256', 1),
(5, 'SAL_DEVOL', 'Salida por Devolución', 'Salida de productos devueltos a proveedores', 'SALIDA', 'SI', 'SI', 'NO', 'SI', 'ACTIVO', '1752903256', 1),
(6, 'SAL_AJUSTE', 'Salida por Ajuste', 'Ajuste negativo de inventario', 'SALIDA', 'SI', 'SI', 'NO', 'SI', 'ACTIVO', '1752903256', 1),
(7, 'SAL_DAÑADO', 'Salida por Daño', 'Salida de productos dañados o vencidos', 'SALIDA', 'SI', 'SI', 'NO', 'SI', 'ACTIVO', '1752903256', 1),
(8, 'TRANSFER', 'Transferencia', 'Transferencia entre bodegas', 'TRANSFERENCIA', 'NO', 'NO', 'NO', 'SI', 'ACTIVO', '1752903256', 1),
(9, 'AJUSTE_INV', 'Ajuste Inventario', 'Ajuste por inventario físico', 'AJUSTE', 'SI', 'SI', 'NO', 'SI', 'ACTIVO', '1752903256', 1),
(10, 'ENT_PRODUC', 'Entrada por Producción', 'Ingreso de productos terminados', 'ENTRADA', 'SI', 'NO', 'NO', 'SI', 'ACTIVO', '1752903256', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mst_paises`
--

CREATE TABLE `mst_paises` (
  `id` int NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `estado` enum('ACTIVO','ELIMINADO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `mst_paises`
--

INSERT INTO `mst_paises` (`id`, `nombre`, `estado`) VALUES
(1, 'Colombia', 'ACTIVO'),
(2, 'Ecuador', 'ACTIVO'),
(3, 'Belgica', 'ACTIVO'),
(4, 'Peru', 'ACTIVO'),
(5, 'Chile', 'ACTIVO'),
(6, 'Bolivia', 'ACTIVO'),
(62, 'VENEZUELA', 'ACTIVO'),
(63, 'URUGUAY', 'ACTIVO'),
(64, 'Rumania', 'ACTIVO'),
(65, 'ANDORRA', 'ACTIVO'),
(66, 'asdasdas', 'ACTIVO'),
(67, 'PANAMA', 'ACTIVO'),
(68, 'asdasdasdasd', 'ACTIVO'),
(69, 'TAILANDIA', 'ACTIVO'),
(70, 'VIETMAN', 'ACTIVO'),
(71, 'HAITI', 'ACTIVO'),
(72, 'NORUEGA', 'ACTIVO'),
(73, 'COSTA RICA', 'ACTIVO'),
(74, 'AUSTRALIA', 'ACTIVO'),
(75, 'LIBANO', 'ACTIVO'),
(76, 'HUNGRIA', 'ACTIVO'),
(77, 'KAZAJISTAN', 'ACTIVO'),
(78, 'ESCOCIA', 'ACTIVO'),
(79, 'nueva zelanda', 'ACTIVO'),
(80, 'mongolia', 'ACTIVO'),
(81, 'singapur', 'ACTIVO'),
(82, 'IPIALES', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mst_paises_departamentos`
--

CREATE TABLE `mst_paises_departamentos` (
  `id` int NOT NULL,
  `mst_paises__id` int NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `estado` enum('ACTIVO','ELIMINADO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `mst_paises_departamentos`
--

INSERT INTO `mst_paises_departamentos` (`id`, `mst_paises__id`, `nombre`, `estado`) VALUES
(1, 1, 'Antioquia', 'ACTIVO'),
(2, 2, 'Pichincha', 'ACTIVO'),
(3, 4, 'Lima', 'ACTIVO'),
(4, 2, 'Gye', 'ACTIVO'),
(5, 1, 'Cundinamarca', 'ACTIVO'),
(6, 2, 'Azuay', 'ACTIVO'),
(7, 5, 'Santiago', 'ACTIVO'),
(27, 63, 'LKASJDOJSA', 'ACTIVO'),
(28, 2, 'dadas', 'ACTIVO'),
(29, 2, 'PRUEBA', 'ACTIVO'),
(30, 2, 'dasdasdasdas', 'ACTIVO'),
(31, 2, 'dadasdas', 'ACTIVO'),
(32, 0, 'kajsdjadjas', 'ACTIVO'),
(33, 0, 'rrrrrrrrrrrrrrrrrrrrrr', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mst_paises_departamentos_ciudades`
--

CREATE TABLE `mst_paises_departamentos_ciudades` (
  `id` int NOT NULL,
  `mst_paises_departamentos__id` int NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `estado` enum('ACTIVO','ELIMINADO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `mst_paises_departamentos_ciudades`
--

INSERT INTO `mst_paises_departamentos_ciudades` (`id`, `mst_paises_departamentos__id`, `nombre`, `estado`) VALUES
(1, 1, 'Medellín', 'ACTIVO'),
(2, 2, 'Quito', 'ACTIVO'),
(3, 1, 'Envigado', 'ACTIVO'),
(4, 1, 'La estrella', 'ACTIVO'),
(5, 1, 'Caldas', 'ACTIVO'),
(6, 1, 'Itagui', 'ACTIVO'),
(7, 3, 'Lima', 'ACTIVO'),
(8, 5, 'Bogotá', 'ACTIVO'),
(9, 2, 'San borondon', 'ACTIVO'),
(10, 7, 'Santiago de chile', 'ACTIVO'),
(11, 0, 'dadadasda', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mst_sector`
--

CREATE TABLE `mst_sector` (
  `id` int NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `estado` enum('ACTIVO','ELIMINADO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `mst_sector`
--

INSERT INTO `mst_sector` (`id`, `nombre`, `descripcion`, `estado`) VALUES
(1, 'Ropa', 'Industria dedicada al diseño, fabricación y comercialización de prendas de vestir.', 'ACTIVO'),
(2, 'Banca', 'Sector económico relacionado con los servicios financieros y operaciones bancarias.', 'ACTIVO'),
(4, 'Químicos', 'Producción y distribución de compuestos químicos para diversos usos industriales.', 'ACTIVO'),
(6, 'Construcción', 'Industria que se encarga de la edificación de infraestructuras y obras civiles.', 'ACTIVO'),
(7, 'Consultoría', 'Servicios profesionales especializados en asesoramiento empresarial y técnico.', 'ACTIVO'),
(8, 'Educación', 'Instituciones y servicios dedicados a la enseñanza y formación académica.', 'ACTIVO'),
(10, 'Energía', 'Producción, distribución y gestión de recursos energéticos como electricidad y combustibles.', 'ACTIVO'),
(11, 'Ingeniería & Electrónica', 'Aplicación del conocimiento científico para el diseño y construcción de soluciones técnicas.', 'ACTIVO'),
(12, 'Entretenimiento', 'Industria dedicada a actividades recreativas como cine, música y espectáculos.', 'ACTIVO'),
(13, 'Medio ambiente', 'Actividades enfocadas en la protección y conservación del entorno natural.', 'ACTIVO'),
(14, 'Finanzas', 'Gestión de recursos económicos, inversiones y análisis financieros.', 'ACTIVO'),
(15, 'Gobierno', 'Entidades públicas y organizaciones que gestionan asuntos estatales.', 'ACTIVO'),
(16, 'Salud', 'Servicios médicos y de atención sanitaria para la población.', 'ACTIVO'),
(18, 'Seguros', 'Actividades relacionadas con la gestión del riesgo y protección financiera.', 'ACTIVO'),
(19, 'Maquinaria', 'Fabricación y mantenimiento de equipos y máquinas industriales.', 'ACTIVO'),
(20, 'Manufactura', 'Transformación de materias primas en productos terminados.', 'ACTIVO'),
(22, 'Sin ánimo de lucro', 'Organizaciones cuyo objetivo no es el lucro, sino el bienestar social o comunitario.', 'ACTIVO'),
(23, 'Recreación', 'Actividades que brindan ocio y esparcimiento.', 'ACTIVO'),
(24, 'Venta al por menor', 'Comercialización directa de productos al consumidor final.', 'ACTIVO'),
(26, 'Tecnología & Telecomunicaciones', 'Desarrollo e implementación de soluciones basadas en ciencia y computación.', 'ACTIVO'),
(28, 'Transporte', 'Movilización de personas y bienes de un lugar a otro.', 'ACTIVO'),
(29, 'Servicios públicos', 'Provisión de agua, electricidad, gas y otros servicios básicos.', 'ACTIVO'),
(30, 'Otro', 'Categoría general para industrias que no se clasifican en las anteriores.', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mst_tipos_servicio`
--

CREATE TABLE `mst_tipos_servicio` (
  `id` int NOT NULL,
  `codigo` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `categoria` enum('PROFESIONAL','TECNICO','CONSULTORÍA','MANTENIMIENTO','SOPORTE','CAPACITACION','OTRO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `requiere_agenda` enum('SI','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'NO',
  `duracion_estimada_horas` decimal(5,2) DEFAULT NULL,
  `estado` enum('ACTIVO','INACTIVO','ELIMINADO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'ACTIVO',
  `creado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `usuario__id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `mst_tipos_servicio`
--

INSERT INTO `mst_tipos_servicio` (`id`, `codigo`, `nombre`, `descripcion`, `categoria`, `requiere_agenda`, `duracion_estimada_horas`, `estado`, `creado`, `usuario__id`) VALUES
(1, 'MANT_PREV', 'Mantenimiento Preventivo', 'Servicios de mantenimiento programado', 'MANTENIMIENTO', 'SI', '2.00', 'ACTIVO', '1752903256', 1),
(2, 'MANT_CORR', 'Mantenimiento Correctivo', 'Servicios de reparación y corrección', 'MANTENIMIENTO', 'SI', '4.00', 'ACTIVO', '1752903256', 1),
(3, 'CONSUL_TEC', 'Consultoría Técnica', 'Asesoramiento técnico especializado', 'CONSULTORÍA', 'SI', '8.00', 'ACTIVO', '1752903256', 1),
(4, 'CAPAC', 'Capacitación', 'Servicios de formación y entrenamiento', 'CAPACITACION', 'SI', '16.00', 'ACTIVO', '1752903256', 1),
(5, 'SOPORTE_TI', 'Soporte Técnico TI', 'Soporte técnico en tecnología', 'SOPORTE', 'NO', '1.00', 'ACTIVO', '1752903256', 1),
(6, 'INSTALACION', 'Instalación', 'Servicios de instalación de equipos', 'TECNICO', 'SI', '4.00', 'ACTIVO', '1752903256', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mst_unidades_medida`
--

CREATE TABLE `mst_unidades_medida` (
  `id` int NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `abreviacion` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `tipo` enum('PESO','VOLUMEN','LONGITUD','UNIDAD','TIEMPO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `factor_conversion` decimal(10,4) DEFAULT '1.0000',
  `unidad_base_id` int DEFAULT NULL,
  `estado` enum('ACTIVO','INACTIVO','ELIMINADO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'ACTIVO',
  `creado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `usuario__id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `mst_unidades_medida`
--

INSERT INTO `mst_unidades_medida` (`id`, `nombre`, `abreviacion`, `tipo`, `factor_conversion`, `unidad_base_id`, `estado`, `creado`, `usuario__id`) VALUES
(1, 'Unidad', 'UN', 'UNIDAD', '1.0000', NULL, 'ACTIVO', '1752903256', 1),
(2, 'Kilogramo', 'KG', 'PESO', '1.0000', NULL, 'ACTIVO', '1752903256', 1),
(3, 'Gramo', 'GR', 'PESO', '0.0010', NULL, 'ACTIVO', '1752903256', 1),
(4, 'Litro', 'LT', 'VOLUMEN', '1.0000', NULL, 'ACTIVO', '1752903256', 1),
(5, 'Metro', 'MT', 'LONGITUD', '1.0000', NULL, 'ACTIVO', '1752903256', 1),
(6, 'Centímetro', 'CM', 'LONGITUD', '0.0100', NULL, 'ACTIVO', '1752903256', 1),
(7, 'Hora', 'HR', 'TIEMPO', '1.0000', NULL, 'ACTIVO', '1752903256', 1),
(8, 'Día', 'DIA', 'TIEMPO', '24.0000', NULL, 'ACTIVO', '1752903256', 1),
(9, 'Caja', 'CJ', 'UNIDAD', '1.0000', NULL, 'ACTIVO', '1752903256', 1),
(10, 'Paquete', 'PQ', 'UNIDAD', '1.0000', NULL, 'ACTIVO', '1752903256', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int NOT NULL,
  `codigo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `codigo_barras` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `nombre` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `descripcion_corta` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `categoria_id` int DEFAULT NULL,
  `marca_id` int DEFAULT NULL,
  `tipo_producto` enum('SIMPLE','COMPUESTO','SERVICIO','KIT','MATERIA_PRIMA') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'SIMPLE',
  `unidad_medida_id` int NOT NULL,
  `unidad_compra_id` int DEFAULT NULL,
  `unidad_venta_id` int DEFAULT NULL,
  `factor_conversion_compra` decimal(10,4) DEFAULT '1.0000',
  `factor_conversion_venta` decimal(10,4) DEFAULT '1.0000',
  `peso` decimal(10,4) DEFAULT NULL,
  `volumen` decimal(10,4) DEFAULT NULL,
  `dimensiones_largo` decimal(10,2) DEFAULT NULL,
  `dimensiones_ancho` decimal(10,2) DEFAULT NULL,
  `dimensiones_alto` decimal(10,2) DEFAULT NULL,
  `precio_costo` decimal(15,4) DEFAULT NULL,
  `precio_venta` decimal(15,4) DEFAULT NULL,
  `precio_minimo` decimal(15,4) DEFAULT NULL,
  `porcentaje_utilidad` decimal(5,2) DEFAULT NULL,
  `impuesto_compra_porcentaje` decimal(5,2) DEFAULT NULL,
  `impuesto_venta_porcentaje` decimal(5,2) DEFAULT NULL,
  `stock_minimo` decimal(10,2) DEFAULT '0.00',
  `stock_maximo` decimal(10,2) DEFAULT NULL,
  `punto_reorden` decimal(10,2) DEFAULT NULL,
  `dias_entrega_proveedor` int DEFAULT NULL,
  `lote_minimo_compra` decimal(10,2) DEFAULT NULL,
  `maneja_lotes` enum('SI','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'NO',
  `maneja_series` enum('SI','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'NO',
  `maneja_vencimientos` enum('SI','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'NO',
  `vida_util_dias` int DEFAULT NULL,
  `dias_alerta_vencimiento` int DEFAULT NULL,
  `permite_inventario_negativo` enum('SI','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'NO',
  `imagen_principal` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `observaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `estado` enum('ACTIVO','INACTIVO','DESCONTINUADO','ELIMINADO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'ACTIVO',
  `creado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `modificado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `usuario__id` int NOT NULL,
  `usuario_modificado_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_componentes`
--

CREATE TABLE `productos_componentes` (
  `id` int NOT NULL,
  `producto_padre_id` int NOT NULL,
  `producto_componente_id` int NOT NULL,
  `cantidad_requerida` decimal(10,4) NOT NULL,
  `unidad_medida_id` int NOT NULL,
  `costo_unitario` decimal(15,4) DEFAULT NULL,
  `es_opcional` enum('SI','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'NO',
  `orden_ensamble` int DEFAULT NULL,
  `desperdicio_porcentaje` decimal(5,2) DEFAULT '0.00',
  `observaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `estado` enum('ACTIVO','INACTIVO','ELIMINADO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'ACTIVO',
  `creado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `usuario__id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_proveedores`
--

CREATE TABLE `producto_proveedores` (
  `id` int NOT NULL,
  `producto_id` int NOT NULL,
  `proveedor_cuenta_id` int NOT NULL,
  `codigo_proveedor` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `precio_compra` decimal(15,4) NOT NULL,
  `unidad_medida_id` int NOT NULL,
  `cantidad_minima` decimal(10,2) DEFAULT NULL,
  `tiempo_entrega_dias` int DEFAULT NULL,
  `es_principal` enum('SI','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'NO',
  `descuento_porcentaje` decimal(5,2) DEFAULT '0.00',
  `moneda` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT 'COP',
  `fecha_ultimo_precio` date DEFAULT NULL,
  `estado` enum('ACTIVO','INACTIVO','ELIMINADO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'ACTIVO',
  `creado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `usuario__id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` int NOT NULL,
  `codigo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `nombre` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `descripcion_corta` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `categoria_id` int DEFAULT NULL,
  `tipo_servicio_id` int NOT NULL,
  `unidad_medida_id` int NOT NULL COMMENT 'hora, día, proyecto, etc.',
  `precio_base` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `precio_minimo` decimal(15,4) DEFAULT NULL,
  `costo_directo` decimal(15,4) DEFAULT '0.0000',
  `porcentaje_utilidad` decimal(5,2) DEFAULT NULL,
  `impuesto_porcentaje` decimal(5,2) DEFAULT NULL,
  `duracion_estimada` decimal(10,2) DEFAULT NULL COMMENT 'En la unidad de medida definida',
  `duracion_minima` decimal(10,2) DEFAULT NULL,
  `duracion_maxima` decimal(10,2) DEFAULT NULL,
  `requiere_materiales` enum('SI','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'NO',
  `requiere_desplazamiento` enum('SI','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'NO',
  `costo_desplazamiento` decimal(15,4) DEFAULT '0.0000',
  `radio_cobertura_km` decimal(10,2) DEFAULT NULL,
  `disponible_online` enum('SI','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'NO',
  `disponible_presencial` enum('SI','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'SI',
  `nivel_experiencia_requerido` enum('JUNIOR','SEMI_SENIOR','SENIOR','ESPECIALISTA','EXPERTO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT 'JUNIOR',
  `certificaciones_requeridas` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `herramientas_requeridas` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `observaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `imagen_principal` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `estado` enum('ACTIVO','INACTIVO','DESCONTINUADO','ELIMINADO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'ACTIVO',
  `creado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `modificado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `usuario__id` int NOT NULL,
  `usuario_modificado_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_agendas`
--

CREATE TABLE `servicio_agendas` (
  `id` int NOT NULL,
  `servicio_id` int NOT NULL,
  `cliente_cuenta_id` int NOT NULL,
  `usuario_asignado_id` int NOT NULL,
  `fecha_servicio` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time DEFAULT NULL,
  `duracion_programada` decimal(5,2) NOT NULL COMMENT 'En horas',
  `duracion_real` decimal(5,2) DEFAULT NULL,
  `tipo_servicio` enum('PRESENCIAL','REMOTO','HIBRIDO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'PRESENCIAL',
  `direccion_servicio` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `ciudad_id` int DEFAULT NULL,
  `departamento_id` int DEFAULT NULL,
  `pais_id` int DEFAULT NULL,
  `coordenadas_gps` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `contacto_cliente` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `telefono_contacto` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `email_contacto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `observaciones_cliente` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `observaciones_internas` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `requiere_confirmacion` enum('SI','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'SI',
  `fecha_confirmacion` datetime DEFAULT NULL,
  `confirmado_por_usuario_id` int DEFAULT NULL,
  `estado` enum('PROGRAMADO','CONFIRMADO','EN_PROCESO','COMPLETADO','CANCELADO','REPROGRAMADO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'PROGRAMADO',
  `motivo_cancelacion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `fecha_cancelacion` datetime DEFAULT NULL,
  `calificacion_cliente` tinyint DEFAULT NULL COMMENT '1-5 estrellas',
  `comentarios_cliente` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `precio_acordado` decimal(15,4) DEFAULT NULL,
  `costo_materiales` decimal(15,4) DEFAULT '0.0000',
  `costo_desplazamiento` decimal(15,4) DEFAULT '0.0000',
  `valor_total` decimal(15,4) GENERATED ALWAYS AS (((`precio_acordado` + `costo_materiales`) + `costo_desplazamiento`)) STORED,
  `documento_referencia` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `creado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `modificado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `usuario__id` int NOT NULL,
  `usuario_modificado_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_ejecuciones`
--

CREATE TABLE `servicio_ejecuciones` (
  `id` int NOT NULL,
  `agenda_id` int NOT NULL,
  `fecha_inicio_real` datetime DEFAULT NULL,
  `fecha_fin_real` datetime DEFAULT NULL,
  `actividades_realizadas` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `problemas_encontrados` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `soluciones_aplicadas` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `materiales_utilizados` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `tiempo_desplazamiento` decimal(5,2) DEFAULT NULL COMMENT 'En horas',
  `kilometros_recorridos` decimal(10,2) DEFAULT NULL,
  `evidencias_fotograficas` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci COMMENT 'URLs de imágenes',
  `firma_cliente` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `documento_entrega` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `requiere_seguimiento` enum('SI','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'NO',
  `fecha_proximo_seguimiento` date DEFAULT NULL,
  `observaciones_tecnicas` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `recomendaciones_cliente` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `estado_ejecucion` enum('NO_INICIADO','EN_PROCESO','PAUSADO','COMPLETADO','CANCELADO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'NO_INICIADO',
  `creado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `modificado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `usuario__id` int NOT NULL,
  `usuario_modificado_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_materiales`
--

CREATE TABLE `servicio_materiales` (
  `id` int NOT NULL,
  `servicio_id` int NOT NULL,
  `producto_id` int NOT NULL,
  `cantidad_requerida` decimal(10,4) NOT NULL,
  `unidad_medida_id` int NOT NULL,
  `es_opcional` enum('SI','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'NO',
  `incluido_en_precio` enum('SI','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'SI',
  `costo_unitario` decimal(15,4) DEFAULT NULL,
  `precio_unitario` decimal(15,4) DEFAULT NULL,
  `observaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `estado` enum('ACTIVO','INACTIVO','ELIMINADO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'ACTIVO',
  `creado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `usuario__id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_materiales_consumidos`
--

CREATE TABLE `servicio_materiales_consumidos` (
  `id` int NOT NULL,
  `ejecucion_id` int NOT NULL,
  `producto_id` int NOT NULL,
  `bodega_id` int NOT NULL,
  `lote_id` int DEFAULT NULL,
  `cantidad_consumida` decimal(10,4) NOT NULL,
  `unidad_medida_id` int NOT NULL,
  `costo_unitario` decimal(15,4) DEFAULT '0.0000',
  `precio_unitario` decimal(15,4) DEFAULT '0.0000',
  `facturado_cliente` enum('SI','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'SI',
  `motivo_consumo` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `observaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `creado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `usuario__id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_recursos`
--

CREATE TABLE `servicio_recursos` (
  `id` int NOT NULL,
  `servicio_id` int NOT NULL,
  `usuario_id` int NOT NULL,
  `es_principal` enum('SI','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'NO',
  `costo_hora` decimal(15,4) DEFAULT NULL,
  `precio_hora` decimal(15,4) DEFAULT NULL,
  `nivel_experiencia` enum('JUNIOR','SEMI_SENIOR','SENIOR','ESPECIALISTA','EXPERTO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `certificaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `disponibilidad_lunes` enum('SI','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'SI',
  `disponibilidad_martes` enum('SI','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'SI',
  `disponibilidad_miercoles` enum('SI','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'SI',
  `disponibilidad_jueves` enum('SI','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'SI',
  `disponibilidad_viernes` enum('SI','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'SI',
  `disponibilidad_sabado` enum('SI','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'NO',
  `disponibilidad_domingo` enum('SI','NO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'NO',
  `hora_inicio` time DEFAULT '08:00:00',
  `hora_fin` time DEFAULT '17:00:00',
  `observaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `estado` enum('ACTIVO','INACTIVO','ELIMINADO') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'ACTIVO',
  `creado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `usuario__id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `identificacion` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombres` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `correoelectronico` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `whatsapp` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rol` enum('ADMINISTRADOR','ASESOR') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cargo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `appId` int DEFAULT NULL,
  `appCreate` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` enum('ACTIVO','INACTIVO','ELIMINADO') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `creado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `entrenamiento` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `identificacion`, `nombres`, `apellidos`, `correoelectronico`, `whatsapp`, `username`, `password`, `rol`, `cargo`, `foto`, `appId`, `appCreate`, `estado`, `creado`, `entrenamiento`) VALUES
(1, '71380449', 'GUSTAVO', 'VARELA', 'gvarelahdez@gmail.com', '304277077', 'gvarela', '$2y$10$RgtKq9GhBkFGhWoy1wnqF.Gqsxij7lZquxUYWB07v8Bs/Gf2LT.jO', 'ADMINISTRADOR', 'GERENTE', NULL, 1, '1745029469', 'ACTIVO', '1741141549', NULL),
(2, '71380449', 'DANIELA', 'MANRIQUE', 'gvarelahdez@gmail.com', '304277077', 'dmanrique', '$2y$10$RgtKq9GhBkFGhWoy1wnqF.Gqsxij7lZquxUYWB07v8Bs/Gf2LT.jO', 'ADMINISTRADOR', 'GERENTE', NULL, 1, '1745029469', 'ACTIVO', '1741141549', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bodegas`
--
ALTER TABLE `bodegas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_codigo` (`codigo`),
  ADD KEY `idx_responsable` (`responsable_usuario_id`),
  ADD KEY `idx_unidad_capacidad` (`unidad_capacidad_id`),
  ADD KEY `usuario__id` (`usuario__id`),
  ADD KEY `mst_paises_departamentos_ciudades__id` (`mst_paises_departamentos_ciudades__id`),
  ADD KEY `mst_paises_departamentos__id` (`mst_paises_departamentos__id`),
  ADD KEY `mst_paises__id` (`mst_paises__id`);

--
-- Indices de la tabla `bodega_ubicaciones`
--
ALTER TABLE `bodega_ubicaciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_bodega_codigo` (`bodega_id`,`codigo`),
  ADD KEY `usuario__id` (`usuario__id`);

--
-- Indices de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario__id` (`usuario__id`),
  ADD KEY `mst_identificacionTipo__Id` (`mst_identificacionTipo__Id`),
  ADD KEY `mst_paises_departamentos_ciudades__id` (`mst_paises_departamentos_ciudades__id`),
  ADD KEY `mst_paises_departamentos__id` (`mst_paises_departamentos__id`),
  ADD KEY `mst_paises__id` (`mst_paises__id`),
  ADD KEY `mst_cuentaTipo__id` (`mst_cuentaTipo__id`),
  ADD KEY `mst_sector__id` (`mst_sector__id`);

--
-- Indices de la tabla `inventarios`
--
ALTER TABLE `inventarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_producto_bodega_ubicacion` (`producto_id`,`bodega_id`,`ubicacion_id`),
  ADD KEY `idx_bodega` (`bodega_id`),
  ADD KEY `idx_ubicacion` (`ubicacion_id`),
  ADD KEY `idx_stock_actual` (`stock_actual`),
  ADD KEY `usuario__id` (`usuario__id`),
  ADD KEY `idx_inventarios_disponibles` (`bodega_id`,`stock_actual`);

--
-- Indices de la tabla `inventarios_fisicos`
--
ALTER TABLE `inventarios_fisicos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_numero_conteo` (`numero_conteo`),
  ADD KEY `idx_bodega` (`bodega_id`),
  ADD KEY `idx_fecha_inicio` (`fecha_inicio`),
  ADD KEY `idx_estado` (`estado`),
  ADD KEY `usuario__id` (`usuario__id`),
  ADD KEY `usuario_finaliza_id` (`usuario_finaliza_id`);

--
-- Indices de la tabla `inventarios_fisicos_detalle`
--
ALTER TABLE `inventarios_fisicos_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_inventario_fisico` (`inventario_fisico_id`),
  ADD KEY `idx_producto` (`producto_id`),
  ADD KEY `idx_ubicacion` (`ubicacion_id`),
  ADD KEY `idx_lote` (`lote_id`),
  ADD KEY `idx_contado_por` (`contado_por_usuario_id`),
  ADD KEY `usuario__id` (`usuario__id`);

--
-- Indices de la tabla `inventario_lotes`
--
ALTER TABLE `inventario_lotes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_lote_producto_bodega` (`numero_lote`,`producto_id`,`bodega_id`),
  ADD KEY `idx_producto` (`producto_id`),
  ADD KEY `idx_bodega` (`bodega_id`),
  ADD KEY `idx_vencimiento` (`fecha_vencimiento`),
  ADD KEY `idx_proveedor` (`proveedor_cuenta_id`),
  ADD KEY `ubicacion_id` (`ubicacion_id`),
  ADD KEY `usuario__id` (`usuario__id`),
  ADD KEY `idx_lotes_vencimiento` (`fecha_vencimiento`,`estado`);

--
-- Indices de la tabla `inventario_series`
--
ALTER TABLE `inventario_series`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_serie_producto` (`numero_serie`,`producto_id`),
  ADD KEY `idx_producto` (`producto_id`),
  ADD KEY `idx_bodega` (`bodega_id`),
  ADD KEY `idx_lote` (`lote_id`),
  ADD KEY `idx_cliente` (`cliente_cuenta_id`),
  ADD KEY `ubicacion_id` (`ubicacion_id`),
  ADD KEY `proveedor_cuenta_id` (`proveedor_cuenta_id`),
  ADD KEY `usuario__id` (`usuario__id`);

--
-- Indices de la tabla `movimientos_inventario`
--
ALTER TABLE `movimientos_inventario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_numero_documento` (`numero_documento`),
  ADD KEY `idx_tipo_movimiento` (`tipo_movimiento_id`),
  ADD KEY `idx_fecha` (`fecha_movimiento`),
  ADD KEY `idx_bodega_origen` (`bodega_origen_id`),
  ADD KEY `idx_bodega_destino` (`bodega_destino_id`),
  ADD KEY `idx_tercero` (`cuenta_tercero_id`),
  ADD KEY `idx_estado` (`estado`),
  ADD KEY `usuario_aprueba_id` (`usuario_aprueba_id`),
  ADD KEY `usuario__id` (`usuario__id`),
  ADD KEY `usuario_modificado_id` (`usuario_modificado_id`),
  ADD KEY `idx_movimientos_fecha_estado` (`fecha_movimiento`,`estado`);

--
-- Indices de la tabla `movimientos_inventario_detalle`
--
ALTER TABLE `movimientos_inventario_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_movimiento` (`movimiento_id`),
  ADD KEY `idx_producto` (`producto_id`),
  ADD KEY `idx_lote` (`lote_id`),
  ADD KEY `ubicacion_origen_id` (`ubicacion_origen_id`),
  ADD KEY `ubicacion_destino_id` (`ubicacion_destino_id`),
  ADD KEY `unidad_medida_id` (`unidad_medida_id`),
  ADD KEY `usuario__id` (`usuario__id`);

--
-- Indices de la tabla `movimientos_inventario_series`
--
ALTER TABLE `movimientos_inventario_series`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_movimiento_detalle` (`movimiento_detalle_id`),
  ADD KEY `idx_serie` (`serie_id`),
  ADD KEY `usuario__id` (`usuario__id`);

--
-- Indices de la tabla `mst_categorias`
--
ALTER TABLE `mst_categorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_categoria_padre` (`categoria_padre_id`),
  ADD KEY `usuario__id` (`usuario__id`);

--
-- Indices de la tabla `mst_cuentatipo`
--
ALTER TABLE `mst_cuentatipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mst_identificaciontipo`
--
ALTER TABLE `mst_identificaciontipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mst_marcas`
--
ALTER TABLE `mst_marcas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario__id` (`usuario__id`);

--
-- Indices de la tabla `mst_movimiento_tipos`
--
ALTER TABLE `mst_movimiento_tipos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_codigo` (`codigo`),
  ADD KEY `usuario__id` (`usuario__id`);

--
-- Indices de la tabla `mst_paises`
--
ALTER TABLE `mst_paises`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mst_paises_departamentos`
--
ALTER TABLE `mst_paises_departamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mst_paises_departamentos_ciudades`
--
ALTER TABLE `mst_paises_departamentos_ciudades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mst_sector`
--
ALTER TABLE `mst_sector`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mst_tipos_servicio`
--
ALTER TABLE `mst_tipos_servicio`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_codigo` (`codigo`),
  ADD KEY `usuario__id` (`usuario__id`);

--
-- Indices de la tabla `mst_unidades_medida`
--
ALTER TABLE `mst_unidades_medida`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_abreviacion` (`abreviacion`),
  ADD KEY `idx_unidad_base` (`unidad_base_id`),
  ADD KEY `usuario__id` (`usuario__id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_codigo` (`codigo`),
  ADD KEY `uk_codigo_barras` (`codigo_barras`),
  ADD KEY `idx_categoria` (`categoria_id`),
  ADD KEY `idx_marca` (`marca_id`),
  ADD KEY `idx_unidad_medida` (`unidad_medida_id`),
  ADD KEY `idx_nombre` (`nombre`),
  ADD KEY `idx_tipo` (`tipo_producto`),
  ADD KEY `unidad_compra_id` (`unidad_compra_id`),
  ADD KEY `unidad_venta_id` (`unidad_venta_id`),
  ADD KEY `usuario__id` (`usuario__id`),
  ADD KEY `usuario_modificado_id` (`usuario_modificado_id`),
  ADD KEY `idx_productos_activos` (`estado`,`nombre`);

--
-- Indices de la tabla `productos_componentes`
--
ALTER TABLE `productos_componentes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_padre_componente` (`producto_padre_id`,`producto_componente_id`),
  ADD KEY `idx_componente` (`producto_componente_id`),
  ADD KEY `idx_unidad` (`unidad_medida_id`),
  ADD KEY `usuario__id` (`usuario__id`);

--
-- Indices de la tabla `producto_proveedores`
--
ALTER TABLE `producto_proveedores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_producto` (`producto_id`),
  ADD KEY `idx_proveedor` (`proveedor_cuenta_id`),
  ADD KEY `idx_unidad` (`unidad_medida_id`),
  ADD KEY `usuario__id` (`usuario__id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_codigo` (`codigo`),
  ADD KEY `idx_categoria` (`categoria_id`),
  ADD KEY `idx_tipo_servicio` (`tipo_servicio_id`),
  ADD KEY `idx_unidad_medida` (`unidad_medida_id`),
  ADD KEY `idx_nombre` (`nombre`),
  ADD KEY `idx_precio` (`precio_base`),
  ADD KEY `usuario__id` (`usuario__id`),
  ADD KEY `usuario_modificado_id` (`usuario_modificado_id`),
  ADD KEY `idx_servicios_activos` (`estado`,`nombre`);

--
-- Indices de la tabla `servicio_agendas`
--
ALTER TABLE `servicio_agendas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_servicio` (`servicio_id`),
  ADD KEY `idx_cliente` (`cliente_cuenta_id`),
  ADD KEY `idx_usuario_asignado` (`usuario_asignado_id`),
  ADD KEY `idx_fecha_servicio` (`fecha_servicio`),
  ADD KEY `idx_estado` (`estado`),
  ADD KEY `idx_ciudad` (`ciudad_id`),
  ADD KEY `confirmado_por_usuario_id` (`confirmado_por_usuario_id`),
  ADD KEY `departamento_id` (`departamento_id`),
  ADD KEY `pais_id` (`pais_id`),
  ADD KEY `usuario__id` (`usuario__id`),
  ADD KEY `usuario_modificado_id` (`usuario_modificado_id`),
  ADD KEY `idx_agendas_fecha` (`fecha_servicio`,`estado`);

--
-- Indices de la tabla `servicio_ejecuciones`
--
ALTER TABLE `servicio_ejecuciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_agenda` (`agenda_id`),
  ADD KEY `idx_fecha_inicio` (`fecha_inicio_real`),
  ADD KEY `idx_estado` (`estado_ejecucion`),
  ADD KEY `usuario__id` (`usuario__id`),
  ADD KEY `usuario_modificado_id` (`usuario_modificado_id`);

--
-- Indices de la tabla `servicio_materiales`
--
ALTER TABLE `servicio_materiales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_servicio_producto` (`servicio_id`,`producto_id`),
  ADD KEY `idx_producto` (`producto_id`),
  ADD KEY `idx_unidad` (`unidad_medida_id`),
  ADD KEY `usuario__id` (`usuario__id`);

--
-- Indices de la tabla `servicio_materiales_consumidos`
--
ALTER TABLE `servicio_materiales_consumidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_ejecucion` (`ejecucion_id`),
  ADD KEY `idx_producto` (`producto_id`),
  ADD KEY `idx_bodega` (`bodega_id`),
  ADD KEY `idx_lote` (`lote_id`),
  ADD KEY `unidad_medida_id` (`unidad_medida_id`),
  ADD KEY `usuario__id` (`usuario__id`);

--
-- Indices de la tabla `servicio_recursos`
--
ALTER TABLE `servicio_recursos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_servicio_usuario` (`servicio_id`,`usuario_id`),
  ADD KEY `idx_usuario_recurso` (`usuario_id`),
  ADD KEY `idx_nivel` (`nivel_experiencia`),
  ADD KEY `usuario__id` (`usuario__id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bodegas`
--
ALTER TABLE `bodegas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bodega_ubicaciones`
--
ALTER TABLE `bodega_ubicaciones`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `inventarios`
--
ALTER TABLE `inventarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventarios_fisicos`
--
ALTER TABLE `inventarios_fisicos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventarios_fisicos_detalle`
--
ALTER TABLE `inventarios_fisicos_detalle`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario_lotes`
--
ALTER TABLE `inventario_lotes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario_series`
--
ALTER TABLE `inventario_series`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `movimientos_inventario`
--
ALTER TABLE `movimientos_inventario`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `movimientos_inventario_detalle`
--
ALTER TABLE `movimientos_inventario_detalle`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `movimientos_inventario_series`
--
ALTER TABLE `movimientos_inventario_series`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mst_categorias`
--
ALTER TABLE `mst_categorias`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mst_cuentatipo`
--
ALTER TABLE `mst_cuentatipo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `mst_identificaciontipo`
--
ALTER TABLE `mst_identificaciontipo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `mst_marcas`
--
ALTER TABLE `mst_marcas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mst_movimiento_tipos`
--
ALTER TABLE `mst_movimiento_tipos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `mst_paises`
--
ALTER TABLE `mst_paises`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT de la tabla `mst_paises_departamentos`
--
ALTER TABLE `mst_paises_departamentos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `mst_paises_departamentos_ciudades`
--
ALTER TABLE `mst_paises_departamentos_ciudades`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `mst_sector`
--
ALTER TABLE `mst_sector`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `mst_tipos_servicio`
--
ALTER TABLE `mst_tipos_servicio`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `mst_unidades_medida`
--
ALTER TABLE `mst_unidades_medida`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos_componentes`
--
ALTER TABLE `productos_componentes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto_proveedores`
--
ALTER TABLE `producto_proveedores`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicio_agendas`
--
ALTER TABLE `servicio_agendas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicio_ejecuciones`
--
ALTER TABLE `servicio_ejecuciones`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicio_materiales`
--
ALTER TABLE `servicio_materiales`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicio_materiales_consumidos`
--
ALTER TABLE `servicio_materiales_consumidos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicio_recursos`
--
ALTER TABLE `servicio_recursos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bodegas`
--
ALTER TABLE `bodegas`
  ADD CONSTRAINT `bodegas_ibfk_1` FOREIGN KEY (`responsable_usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `bodegas_ibfk_2` FOREIGN KEY (`unidad_capacidad_id`) REFERENCES `mst_unidades_medida` (`id`),
  ADD CONSTRAINT `bodegas_ibfk_3` FOREIGN KEY (`usuario__id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `bodegas_ibfk_4` FOREIGN KEY (`mst_paises_departamentos_ciudades__id`) REFERENCES `mst_paises_departamentos_ciudades` (`id`),
  ADD CONSTRAINT `bodegas_ibfk_5` FOREIGN KEY (`mst_paises_departamentos__id`) REFERENCES `mst_paises_departamentos` (`id`),
  ADD CONSTRAINT `bodegas_ibfk_6` FOREIGN KEY (`mst_paises__id`) REFERENCES `mst_paises` (`id`);

--
-- Filtros para la tabla `bodega_ubicaciones`
--
ALTER TABLE `bodega_ubicaciones`
  ADD CONSTRAINT `bodega_ubicaciones_ibfk_1` FOREIGN KEY (`bodega_id`) REFERENCES `bodegas` (`id`),
  ADD CONSTRAINT `bodega_ubicaciones_ibfk_2` FOREIGN KEY (`usuario__id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD CONSTRAINT `cuentas_ibfk_1` FOREIGN KEY (`usuario__id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `cuentas_ibfk_2` FOREIGN KEY (`mst_identificacionTipo__Id`) REFERENCES `mst_identificaciontipo` (`id`),
  ADD CONSTRAINT `cuentas_ibfk_3` FOREIGN KEY (`mst_paises_departamentos_ciudades__id`) REFERENCES `mst_paises_departamentos_ciudades` (`id`),
  ADD CONSTRAINT `cuentas_ibfk_4` FOREIGN KEY (`mst_paises_departamentos__id`) REFERENCES `mst_paises_departamentos` (`id`),
  ADD CONSTRAINT `cuentas_ibfk_5` FOREIGN KEY (`mst_paises__id`) REFERENCES `mst_paises` (`id`),
  ADD CONSTRAINT `cuentas_ibfk_6` FOREIGN KEY (`mst_cuentaTipo__id`) REFERENCES `mst_cuentatipo` (`id`),
  ADD CONSTRAINT `cuentas_ibfk_7` FOREIGN KEY (`mst_sector__id`) REFERENCES `mst_sector` (`id`);

--
-- Filtros para la tabla `inventarios`
--
ALTER TABLE `inventarios`
  ADD CONSTRAINT `inventarios_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `inventarios_ibfk_2` FOREIGN KEY (`bodega_id`) REFERENCES `bodegas` (`id`),
  ADD CONSTRAINT `inventarios_ibfk_3` FOREIGN KEY (`ubicacion_id`) REFERENCES `bodega_ubicaciones` (`id`),
  ADD CONSTRAINT `inventarios_ibfk_4` FOREIGN KEY (`usuario__id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `inventarios_fisicos`
--
ALTER TABLE `inventarios_fisicos`
  ADD CONSTRAINT `inventarios_fisicos_ibfk_1` FOREIGN KEY (`bodega_id`) REFERENCES `bodegas` (`id`),
  ADD CONSTRAINT `inventarios_fisicos_ibfk_2` FOREIGN KEY (`usuario__id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `inventarios_fisicos_ibfk_3` FOREIGN KEY (`usuario_finaliza_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `inventarios_fisicos_detalle`
--
ALTER TABLE `inventarios_fisicos_detalle`
  ADD CONSTRAINT `inventarios_fisicos_detalle_ibfk_1` FOREIGN KEY (`inventario_fisico_id`) REFERENCES `inventarios_fisicos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `inventarios_fisicos_detalle_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `inventarios_fisicos_detalle_ibfk_3` FOREIGN KEY (`ubicacion_id`) REFERENCES `bodega_ubicaciones` (`id`),
  ADD CONSTRAINT `inventarios_fisicos_detalle_ibfk_4` FOREIGN KEY (`lote_id`) REFERENCES `inventario_lotes` (`id`),
  ADD CONSTRAINT `inventarios_fisicos_detalle_ibfk_5` FOREIGN KEY (`contado_por_usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `inventarios_fisicos_detalle_ibfk_6` FOREIGN KEY (`usuario__id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `inventario_lotes`
--
ALTER TABLE `inventario_lotes`
  ADD CONSTRAINT `inventario_lotes_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `inventario_lotes_ibfk_2` FOREIGN KEY (`bodega_id`) REFERENCES `bodegas` (`id`),
  ADD CONSTRAINT `inventario_lotes_ibfk_3` FOREIGN KEY (`ubicacion_id`) REFERENCES `bodega_ubicaciones` (`id`),
  ADD CONSTRAINT `inventario_lotes_ibfk_4` FOREIGN KEY (`proveedor_cuenta_id`) REFERENCES `cuentas` (`id`),
  ADD CONSTRAINT `inventario_lotes_ibfk_5` FOREIGN KEY (`usuario__id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `inventario_series`
--
ALTER TABLE `inventario_series`
  ADD CONSTRAINT `inventario_series_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `inventario_series_ibfk_2` FOREIGN KEY (`bodega_id`) REFERENCES `bodegas` (`id`),
  ADD CONSTRAINT `inventario_series_ibfk_3` FOREIGN KEY (`ubicacion_id`) REFERENCES `bodega_ubicaciones` (`id`),
  ADD CONSTRAINT `inventario_series_ibfk_4` FOREIGN KEY (`lote_id`) REFERENCES `inventario_lotes` (`id`),
  ADD CONSTRAINT `inventario_series_ibfk_5` FOREIGN KEY (`cliente_cuenta_id`) REFERENCES `cuentas` (`id`),
  ADD CONSTRAINT `inventario_series_ibfk_6` FOREIGN KEY (`proveedor_cuenta_id`) REFERENCES `cuentas` (`id`),
  ADD CONSTRAINT `inventario_series_ibfk_7` FOREIGN KEY (`usuario__id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `movimientos_inventario`
--
ALTER TABLE `movimientos_inventario`
  ADD CONSTRAINT `movimientos_inventario_ibfk_1` FOREIGN KEY (`tipo_movimiento_id`) REFERENCES `mst_movimiento_tipos` (`id`),
  ADD CONSTRAINT `movimientos_inventario_ibfk_2` FOREIGN KEY (`bodega_origen_id`) REFERENCES `bodegas` (`id`),
  ADD CONSTRAINT `movimientos_inventario_ibfk_3` FOREIGN KEY (`bodega_destino_id`) REFERENCES `bodegas` (`id`),
  ADD CONSTRAINT `movimientos_inventario_ibfk_4` FOREIGN KEY (`cuenta_tercero_id`) REFERENCES `cuentas` (`id`),
  ADD CONSTRAINT `movimientos_inventario_ibfk_5` FOREIGN KEY (`usuario_aprueba_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `movimientos_inventario_ibfk_6` FOREIGN KEY (`usuario__id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `movimientos_inventario_ibfk_7` FOREIGN KEY (`usuario_modificado_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `movimientos_inventario_detalle`
--
ALTER TABLE `movimientos_inventario_detalle`
  ADD CONSTRAINT `movimientos_inventario_detalle_ibfk_1` FOREIGN KEY (`movimiento_id`) REFERENCES `movimientos_inventario` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `movimientos_inventario_detalle_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `movimientos_inventario_detalle_ibfk_3` FOREIGN KEY (`ubicacion_origen_id`) REFERENCES `bodega_ubicaciones` (`id`),
  ADD CONSTRAINT `movimientos_inventario_detalle_ibfk_4` FOREIGN KEY (`ubicacion_destino_id`) REFERENCES `bodega_ubicaciones` (`id`),
  ADD CONSTRAINT `movimientos_inventario_detalle_ibfk_5` FOREIGN KEY (`lote_id`) REFERENCES `inventario_lotes` (`id`),
  ADD CONSTRAINT `movimientos_inventario_detalle_ibfk_6` FOREIGN KEY (`unidad_medida_id`) REFERENCES `mst_unidades_medida` (`id`),
  ADD CONSTRAINT `movimientos_inventario_detalle_ibfk_7` FOREIGN KEY (`usuario__id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `movimientos_inventario_series`
--
ALTER TABLE `movimientos_inventario_series`
  ADD CONSTRAINT `movimientos_inventario_series_ibfk_1` FOREIGN KEY (`movimiento_detalle_id`) REFERENCES `movimientos_inventario_detalle` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `movimientos_inventario_series_ibfk_2` FOREIGN KEY (`serie_id`) REFERENCES `inventario_series` (`id`),
  ADD CONSTRAINT `movimientos_inventario_series_ibfk_3` FOREIGN KEY (`usuario__id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `mst_categorias`
--
ALTER TABLE `mst_categorias`
  ADD CONSTRAINT `mst_categorias_ibfk_1` FOREIGN KEY (`categoria_padre_id`) REFERENCES `mst_categorias` (`id`),
  ADD CONSTRAINT `mst_categorias_ibfk_2` FOREIGN KEY (`usuario__id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `mst_marcas`
--
ALTER TABLE `mst_marcas`
  ADD CONSTRAINT `mst_marcas_ibfk_1` FOREIGN KEY (`usuario__id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `mst_movimiento_tipos`
--
ALTER TABLE `mst_movimiento_tipos`
  ADD CONSTRAINT `mst_movimiento_tipos_ibfk_1` FOREIGN KEY (`usuario__id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `mst_tipos_servicio`
--
ALTER TABLE `mst_tipos_servicio`
  ADD CONSTRAINT `mst_tipos_servicio_ibfk_1` FOREIGN KEY (`usuario__id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `mst_unidades_medida`
--
ALTER TABLE `mst_unidades_medida`
  ADD CONSTRAINT `mst_unidades_medida_ibfk_1` FOREIGN KEY (`unidad_base_id`) REFERENCES `mst_unidades_medida` (`id`),
  ADD CONSTRAINT `mst_unidades_medida_ibfk_2` FOREIGN KEY (`usuario__id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `mst_categorias` (`id`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`marca_id`) REFERENCES `mst_marcas` (`id`),
  ADD CONSTRAINT `productos_ibfk_3` FOREIGN KEY (`unidad_medida_id`) REFERENCES `mst_unidades_medida` (`id`),
  ADD CONSTRAINT `productos_ibfk_4` FOREIGN KEY (`unidad_compra_id`) REFERENCES `mst_unidades_medida` (`id`),
  ADD CONSTRAINT `productos_ibfk_5` FOREIGN KEY (`unidad_venta_id`) REFERENCES `mst_unidades_medida` (`id`),
  ADD CONSTRAINT `productos_ibfk_6` FOREIGN KEY (`usuario__id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `productos_ibfk_7` FOREIGN KEY (`usuario_modificado_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `productos_componentes`
--
ALTER TABLE `productos_componentes`
  ADD CONSTRAINT `productos_componentes_ibfk_1` FOREIGN KEY (`producto_padre_id`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `productos_componentes_ibfk_2` FOREIGN KEY (`producto_componente_id`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `productos_componentes_ibfk_3` FOREIGN KEY (`unidad_medida_id`) REFERENCES `mst_unidades_medida` (`id`),
  ADD CONSTRAINT `productos_componentes_ibfk_4` FOREIGN KEY (`usuario__id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `producto_proveedores`
--
ALTER TABLE `producto_proveedores`
  ADD CONSTRAINT `producto_proveedores_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `producto_proveedores_ibfk_2` FOREIGN KEY (`proveedor_cuenta_id`) REFERENCES `cuentas` (`id`),
  ADD CONSTRAINT `producto_proveedores_ibfk_3` FOREIGN KEY (`unidad_medida_id`) REFERENCES `mst_unidades_medida` (`id`),
  ADD CONSTRAINT `producto_proveedores_ibfk_4` FOREIGN KEY (`usuario__id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD CONSTRAINT `servicios_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `mst_categorias` (`id`),
  ADD CONSTRAINT `servicios_ibfk_2` FOREIGN KEY (`tipo_servicio_id`) REFERENCES `mst_tipos_servicio` (`id`),
  ADD CONSTRAINT `servicios_ibfk_3` FOREIGN KEY (`unidad_medida_id`) REFERENCES `mst_unidades_medida` (`id`),
  ADD CONSTRAINT `servicios_ibfk_4` FOREIGN KEY (`usuario__id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `servicios_ibfk_5` FOREIGN KEY (`usuario_modificado_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `servicio_agendas`
--
ALTER TABLE `servicio_agendas`
  ADD CONSTRAINT `servicio_agendas_ibfk_1` FOREIGN KEY (`servicio_id`) REFERENCES `servicios` (`id`),
  ADD CONSTRAINT `servicio_agendas_ibfk_2` FOREIGN KEY (`cliente_cuenta_id`) REFERENCES `cuentas` (`id`),
  ADD CONSTRAINT `servicio_agendas_ibfk_3` FOREIGN KEY (`usuario_asignado_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `servicio_agendas_ibfk_4` FOREIGN KEY (`confirmado_por_usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `servicio_agendas_ibfk_5` FOREIGN KEY (`ciudad_id`) REFERENCES `mst_paises_departamentos_ciudades` (`id`),
  ADD CONSTRAINT `servicio_agendas_ibfk_6` FOREIGN KEY (`departamento_id`) REFERENCES `mst_paises_departamentos` (`id`),
  ADD CONSTRAINT `servicio_agendas_ibfk_7` FOREIGN KEY (`pais_id`) REFERENCES `mst_paises` (`id`),
  ADD CONSTRAINT `servicio_agendas_ibfk_8` FOREIGN KEY (`usuario__id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `servicio_agendas_ibfk_9` FOREIGN KEY (`usuario_modificado_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `servicio_ejecuciones`
--
ALTER TABLE `servicio_ejecuciones`
  ADD CONSTRAINT `servicio_ejecuciones_ibfk_1` FOREIGN KEY (`agenda_id`) REFERENCES `servicio_agendas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `servicio_ejecuciones_ibfk_2` FOREIGN KEY (`usuario__id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `servicio_ejecuciones_ibfk_3` FOREIGN KEY (`usuario_modificado_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `servicio_materiales`
--
ALTER TABLE `servicio_materiales`
  ADD CONSTRAINT `servicio_materiales_ibfk_1` FOREIGN KEY (`servicio_id`) REFERENCES `servicios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `servicio_materiales_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `servicio_materiales_ibfk_3` FOREIGN KEY (`unidad_medida_id`) REFERENCES `mst_unidades_medida` (`id`),
  ADD CONSTRAINT `servicio_materiales_ibfk_4` FOREIGN KEY (`usuario__id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `servicio_materiales_consumidos`
--
ALTER TABLE `servicio_materiales_consumidos`
  ADD CONSTRAINT `servicio_materiales_consumidos_ibfk_1` FOREIGN KEY (`ejecucion_id`) REFERENCES `servicio_ejecuciones` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `servicio_materiales_consumidos_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `servicio_materiales_consumidos_ibfk_3` FOREIGN KEY (`bodega_id`) REFERENCES `bodegas` (`id`),
  ADD CONSTRAINT `servicio_materiales_consumidos_ibfk_4` FOREIGN KEY (`lote_id`) REFERENCES `inventario_lotes` (`id`),
  ADD CONSTRAINT `servicio_materiales_consumidos_ibfk_5` FOREIGN KEY (`unidad_medida_id`) REFERENCES `mst_unidades_medida` (`id`),
  ADD CONSTRAINT `servicio_materiales_consumidos_ibfk_6` FOREIGN KEY (`usuario__id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `servicio_recursos`
--
ALTER TABLE `servicio_recursos`
  ADD CONSTRAINT `servicio_recursos_ibfk_1` FOREIGN KEY (`servicio_id`) REFERENCES `servicios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `servicio_recursos_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `servicio_recursos_ibfk_3` FOREIGN KEY (`usuario__id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
