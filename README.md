# 🌩️ Proyecto de Práctica: Conexión de Estudiantes a un Nodo Lightning

Este proyecto está diseñado como una práctica educativa para estudiantes, permitiéndoles conectarse a un nodo **LND** (Lightning Network Daemon) simulado a través de la aplicación **Zeus Wallet**, utilizando un entorno de desarrollo local.

## 📋 Descripción del Proyecto

El objetivo es que cada estudiante pueda:
- Obtener sus **credenciales únicas** (host, puerto y macaroon) para conectarse a un nodo Lightning creado en **Polar**.
- Escanear un **código QR** con **Zeus Wallet** y conectar su wallet al nodo.
- Realizar pagos usando **Lightning Network**, interactuando con la extensión **Alby**.

Este entorno se basa en PHP y se ejecuta localmente utilizando **XAMPP** como servidor web y base de datos.

---

## ⚙️ Requisitos Previos

Para ejecutar este proyecto necesitas:

### 🖥️ Software
- [Visual Studio Code (VS Code)](https://code.visualstudio.com/)
- [XAMPP](https://www.apachefriends.org/es/index.html)

### 📦 Extensiones recomendadas para VS Code:
- **Prettier - Code formatter** (para formatear HTML, CSS, JS)
- **PHP Intelephense** (para formatear y asistir en archivos PHP)

---


---

## 🚀 ¿Qué hace el proyecto?

### Para los estudiantes:
- Ingresan un identificador único entregado por el docente.
- Ven sus credenciales (host, puerto, macaroon).
- Obtienen un código QR para conectarse a su nodo con **Zeus Wallet**.
- Siguen los pasos visuales guiados para usar Lightning Network.

### Para el docente (vía panel de administración):
- Crear, ver y eliminar usuarios con sus respectivos nodos.
- Cada usuario tiene una entrada única en la base de datos `lightning.db`.

---

## 🛠️ Cómo ejecutar el proyecto

1. Instala **XAMPP** y asegúrate de tener Apache encendido.
2. Clona este repositorio o copia los archivos en `C:\xampp\htdocs\proyecto-lightning\`.
3. Abre **VS Code** en esa carpeta.
4. Accede a `http://localhost/proyecto-lightning/index.html` desde tu navegador.
5. Para ingresar al panel docente, ve a `http://localhost/proyecto-lightning/login.php`.

---

## 🧠 Tecnología utilizada

- **PHP** – Backend
- **HTML, CSS (Bootstrap)** – Interfaz web
- **JavaScript** – Generación de QR dinámico
- **SQLite** – Base de datos ligera
- **QR Code Styling JS** – Librería para generar códigos QR personalizados
- **Zeus Wallet** – Wallet Lightning para pruebas
- **Alby** – Extensión para pagos Lightning

---

## 📝 Créditos

Este proyecto fue desarrollado como parte de una práctica educativa universitaria para promover el aprendizaje de tecnologías de pago descentralizado.

---
