// Manejo del encabezado fijo al hacer scroll
const headerMenu = document.querySelector('.hm-header');
console.log(headerMenu.offsetTop);

window.addEventListener('scroll', () => {
    if (window.pageYOffset > 80) {
        headerMenu.classList.add('header-fixed');
    } else {
        headerMenu.classList.remove('header-fixed');
    }
});

/*=========================================
    TABS
==========================================*/
if (document.querySelector('.hm-tabs')) {

    const tabLinks = document.querySelectorAll('.hm-tab-link');
    const tabsContent = document.querySelectorAll('.tabs-content');

    tabLinks[0].classList.add('active');

    if (document.querySelector('.tabs-content')) {
        tabsContent[0].classList.add('tab-active');
    }

    for (let i = 0; i < tabLinks.length; i++) {

        tabLinks[i].addEventListener('click', () => {

            tabLinks.forEach((tab) => tab.classList.remove('active'));
            tabLinks[i].classList.add('active');

            tabsContent.forEach((tabCont) => tabCont.classList.remove('tab-active'));
            tabsContent[i].classList.add('tab-active');

        });

    }

}

/*=========================================
    MENÚ MÓVIL
==========================================*/

const menu = document.querySelector('.icon-menu');
const menuClose = document.querySelector('.cerrar-menu');

menu.addEventListener('click', () => {
    document.querySelector('.header-menu-movil').classList.add('active');
});

menuClose.addEventListener('click', () => {
    document.querySelector('.header-menu-movil').classList.remove('active');
});

/*=========================================
    FUNCIONALIDAD DE USUARIO Y CARRITO
==========================================*/

// Simulación de estado de login y carrito
let isLoggedIn = true; // Cambiar a 'false' si el usuario no está logueado
let username = "Juan Pérez"; // Nombre del usuario logueado (esto debe ser dinámico)
let cartCount = 3; // Ejemplo de cuántos artículos hay en el carrito

// Función para actualizar la interfaz de usuario
function updateUserInterface() {
    const userInfo = document.getElementById("userInfo");
    const loginBtn = document.getElementById("loginBtn");
    const cartCountElement = document.getElementById("cartCount");
    const usernameElement = document.getElementById("username");

    if (isLoggedIn) {
        // Si está logueado, mostrar nombre y opciones
        userInfo.style.display = "block";
        loginBtn.style.display = "none";
        usernameElement.innerText = username;
        cartCountElement.innerText = cartCount;
    } else {
        // Si no está logueado, mostrar solo el botón de login
        userInfo.style.display = "none";
        loginBtn.style.display = "block";
    }
}

// Función para manejar el menú desplegable
function toggleDropdown() {
    const dropdownContent = document.getElementById("dropdownContent");
    dropdownContent.classList.toggle("show");
}

// Función para cerrar sesión
function logout() {
    // Aquí deberías implementar la lógica para cerrar sesión (borrar cookies, etc.)
    isLoggedIn = false;
    updateUserInterface();
}

// Función para manejar el carrito de compras
function updateCartCount(newCount) {
    const cartCountElement = document.getElementById("cartCount");
    cartCountElement.innerText = newCount;
    cartCount = newCount; // Actualiza la cantidad en el estado global
}

// Llamamos a updateUserInterface para actualizar la interfaz con el estado actual
window.onload = function() {
    updateUserInterface();
};
