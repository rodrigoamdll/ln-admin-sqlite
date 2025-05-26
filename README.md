# 🌩️ Conexión a ZEUS wallet por medio de un Nodo Lightning

Este proyecto está diseñado como una práctica educativa para estudiantes, permitiéndoles conectarse a un nodo **LND** (Lightning Network Daemon) creado en **Polar** simulado a través de la aplicación **Zeus Wallet**, utilizando un entorno de desarrollo local.

## 📋 Descripción del Proyecto

El objetivo es que cada estudiante pueda:
- Obtener sus **credenciales únicas** (host, puerto y macaroon) para conectarse a un nodo Lightning creado en **Polar**.
- Escanear un **código QR** con **Zeus Wallet** y conectar su wallet al nodo.
- Realizar pagos usando **Lightning Network**, interactuando con la extensión **Alby**.

Este entorno esta desaroollado en PHP y se ejecuta localmente utilizando **XAMPP** como servidor web y base de datos.

---

## ⚙️ Requisitos Previos

Para ejecutar este proyecto necesitas instalar lo siguiente:

### 🖥️ Software
- [Visual Studio Code (VS Code)](https://code.visualstudio.com/)
- [XAMPP](https://www.apachefriends.org/es/index.html)

---

## 🚀 ¿Qué hace el proyecto?

### Para el educador (vía panel de administración):
- Crear, ver y eliminar usuarios con sus respectivos nodos.
- Cada usuario tiene una entrada única en la base de datos `lightning.db`.

### Para los estudiantes:
- Ingresan un identificador único entregado por el docente.
- Ven sus credenciales (host, puerto, macaroon).
- Obtienen un código QR para conectarse a su nodo con **Zeus Wallet**.
- Siguen los pasos visuales guiados para usar Lightning Network.

---

## 🛠️ Cómo ejecutar el proyecto

1. Instala **XAMPP** y asegúrate de tener Apache encendido.
2. Clona este repositorio o en la carpeta `C:\xampp\htdocs\`.
3. Abre **VS Code** en esa carpeta.
4. Accede a `http://localhost/ln-admin-sqlite/index.html` desde tu navegador y comparte este enlace con tus estudiantes, por medio del cual ingresaran a la plataforma.
5. Para ingresar al panel de educador, ve a `http://localhost/ln-admin-sqlite/auth/login.php` 
6. Para ver las credenciales de inicio de sesión abre el archivo `login.php` ubicado en la carpeta `auth` y ve a la linea 15 ahí podrás visualizar las credenciales
7. Si deseas cambiar las credenciales, siempre en la linea 15 del archivo `login.php` puedes modificar los valores que estan entre comillas dobles para lo cual tendrás que guardar los cambios presionando `Ctrl + S`.

