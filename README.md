# 🎲 Rollers Casino

>Proyecto universitario que simula un casino en línea, desarrollado como parte de la materia **Redes de Computadoras II**.  
Incluye compra y configuración de **VPS**, dominio `.sv`, despliegue en **Ubuntu 16** con **CyberPanel**, y medidas de seguridad (**HTTPS/SSL, firewall, configuración de puertos**).  
Frontend con **HTML/CSS/JS/AJAX** y backend en **PHP + MySQL**.

[![PHP](https://img.shields.io/badge/PHP-Backend-blue)]() 
[![MySQL](https://img.shields.io/badge/MySQL-Database-orange)]() 
[![Ubuntu](https://img.shields.io/badge/Ubuntu-16.04-important)]() 
[![CyberPanel](https://img.shields.io/badge/Panel-CyberPanel-success)]() 
[![SSL](https://img.shields.io/badge/Security-SSL%20%2F%20HTTPS-brightgreen)]()
[![Licencia MIT](https://img.shields.io/badge/Licencia-MIT-green.svg)](LICENSE)


---

## 📑 Tabla de contenidos
- [Descripción](#descripción)
- [Contexto Académico](#contexto-academico)
- [Juegos](#juegos)
- [Arquitectura y Tecnologías](#arquitectura-y-tecnologías)
- [Estructura del Proyecto](#estructura-del-proyecto)
- [Instalación y Despliegue](#instalacion-y-despliegue)
- [Base de Datos](#base-de-datos)
- [Seguridad](#seguridad)
- [Documentación](#documentación)
- [Créditos](#créditos)
- [Licencia](#licencia)
- [Roadmap / Mejoras Futuras](#roadmap--mejoras-futuras)

---

## 📌 Descripción
**Rollers Casino** es una aplicación web que simula un casino en línea con fichas virtuales.  
El objetivo principal fue **integrar desarrollo web con administración y seguridad de servidores**.

---

## 🎓 Contexto Académico
- Materia: **Redes de Computadoras II**.  
- Objetivo: cotizar y configurar un **VPS** (Linux), adquirir un **dominio .sv**, y desplegar un proyecto web seguro.  
- **Proveedor VPS:** Contabo (contratado por **1 mes** con fines prácticos).  
- **Proveedor Dominio:** Hostinger.  
- Resultado: Proyecto auditado y calificación **9+**.

---

## 🎮 Juegos
1. **Número más grande**  
   El jugador y el crupier lanzan 2 dados; gana la suma más alta.
2. **Par o impar**  
   Se lanzan los dados al mismo tiempo y previo al lanzamiento el jugador predice si la suma de los dados será **par** o **impar**.

---

## 🛠 Arquitectura y Tecnologías
- **Frontend:** HTML5, CSS3, JavaScript, **AJAX**
- **Backend:** PHP (procedimientos almacenados)
- **Base de Datos:** MySQL
- **Servidor:** Ubuntu 16 en VPS (Contabo)
- **Gestión de servidor:** CyberPanel + CLI
- **Seguridad:** HTTPS/SSL, hashing de contraseñas, validación de rutas, firewall y administración de puertos

---

## 📂 Estructura del Proyecto
<img width="539" height="537" alt="image" src="https://github.com/user-attachments/assets/21d545ec-925a-4382-bf14-6dee4deea678" />



---

## 🚀 Instalación y Despliegue
> **Requisitos:** VPS Linux (Ubuntu 16+), CyberPanel, Apache/Nginx, PHP, MySQL, SSL.

1. Clonar este repositorio en el directorio web del servidor.
2. Instalar Apache/Nginx, PHP y MySQL.
3. Configurar HTTPS/SSL en CyberPanel.
4. Crear la base de datos e importar `BD/rollerscasinoBD.sql`.
5. Configurar credenciales y variables de entorno.
6. Ajustar permisos de carpetas necesarias.
7. Acceder mediante el dominio configurado.

> **Nota:** No usar `credenciales.txt` en entornos reales.

---

## 🗄 Base de Datos
- **usuarios** → registro, autenticación y cantidad de fichas.
- **puntajes** → resultados por usuario/juego.

---

## 🔒 Seguridad
- Contraseñas: hashing seguro.
- SQL: procedimientos almacenados + validaciones.
- Sesiones: control de rutas y acceso.
- Transporte: HTTPS/SSL activo.
- Servidor: firewall y puertos configurados.

---

## 📚 Documentación
`Documentacion/RollersCasino Documentacion..pdf` incluye:
- Manual de usuario
- Cotización de dominio y VPS
- Marco legal sobre juegos en línea en El Salvador

---

## 👥 Créditos
Proyecto desarrollado por **Salvador Zeledón** y equipo.  
Materia: Redes de Computadoras II.  
Calificación: **9+**.

---
## 📜 Licencia
Este proyecto está bajo la licencia **MIT**.  
Consulta el archivo [LICENSE](LICENSE) para más detalles.

---

## 🛠 Roadmap / Mejoras Futuras
- Actualizar a **Ubuntu LTS** reciente y **PHP moderno**.
- Migrar a **API REST**.
- Sustituir `credenciales.txt` por `.env` seguro.
- Añadir **tests** y CI/CD.
- Dockerizar para despliegue reproducible.
- Añadir capturas y demo en línea.

---
