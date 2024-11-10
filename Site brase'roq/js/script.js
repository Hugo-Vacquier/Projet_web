document.addEventListener("DOMContentLoaded", function() {
    const mainImg = document.getElementById("main-img");
    const productDescription = document.getElementById("product-description");
    const prevBtn = document.getElementById("prev-btn");
    const nextBtn = document.getElementById("next-btn");
    

    let currentIndex = 0;
    let images = [];

    

    // Charger les images et descriptions depuis le fichier XML
    function loadImages() {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "img/IMGViewer.xml", true);
        xhr.onload = function() {
            if (this.status === 200) {
                const xml = this.responseXML;
                images = Array.from(xml.getElementsByTagName("image"));

                // Afficher la première image
                displayImage(currentIndex);

                // Changer l'image toutes les 5 secondes
                setInterval(function() {
                    currentIndex = (currentIndex + 1) % images.length;
                    displayImage(currentIndex);
                }, 5000);
            }
        };
        xhr.send();
    }

    document.addEventListener("DOMContentLoaded", function() {
        const burgerMenu = document.getElementById("burger-menu");
        const navbar = document.querySelector(".navbar");
    
        burgerMenu.addEventListener("click", function() {
            navbar.classList.toggle("active"); // Affiche ou cache le menu
        });
    });
    

    // Fonction pour afficher l'image et la description
    function displayImage(index) {
        const src = images[index].getElementsByTagName("src")[0].textContent;
        const description = images[index].getElementsByTagName("description")[0].textContent;
    
        console.log("Chargement de l'image :", src);  // Ajout pour déboguer
        console.log("Description :", description);
    
        mainImg.src = src;
        productDescription.textContent = description;
    }    
    

    // Navigation manuelle
    prevBtn.addEventListener("click", function() {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        displayImage(currentIndex);
    });

    nextBtn.addEventListener("click", function() {
        currentIndex = (currentIndex + 1) % images.length;
        displayImage(currentIndex);
    });

    loadImages();

    
});

