// Sélection des éléments HTML pour la galerie et les boutons de filtre
const filterButtons = document.querySelectorAll(".filter-btn");
const products = document.querySelectorAll(".product-item");

// Fonction pour afficher les produits en fonction de la catégorie sélectionnée
function displayProducts(category) {
    products.forEach(product => {
        const productCategory = product.getAttribute("data-category");
        if (category === "Tous" || category === productCategory) {
            product.style.display = "block";
        } else {
            product.style.display = "none";
        }
    });
}

// Gestion des événements de clic sur les boutons de filtre
filterButtons.forEach(button => {
    button.addEventListener("click", (e) => {
        const category = e.target.getAttribute("data-category");
        displayProducts(category);

        // Mettre en surbrillance le bouton sélectionné
        filterButtons.forEach(btn => btn.classList.remove("active"));
        e.target.classList.add("active");
    });
});

// Gestion du bouton de renseignement
const infoButtons = document.querySelectorAll(".info-btn");
infoButtons.forEach(button => {
    button.addEventListener("click", (e) => {
        const productId = e.target.getAttribute("data-product-id");
        const userMessage = prompt("Entrez votre demande de renseignement pour ce produit:");

        if (userMessage) {
            // Envoie la requête AJAX pour enregistrer le renseignement dans la base de données
            fetch("enregistrer_renseignement.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: `product_id=${productId}&message=${encodeURIComponent(userMessage)}`
            })
            .then(response => response.text())
            .then(data => {
                if (data.includes("Insertion réussie")) {
                    alert("Votre demande de renseignement a été envoyée avec succès !");
                } else {
                    alert("Erreur lors de l'envoi de votre demande de renseignement.");
                }
            })
            .catch(error => console.error("Erreur:", error));
        }
    });
});

function demanderRenseignement(productId) {
    const message = prompt("Entrez votre demande de renseignement pour ce produit:");

    if (message) {
        fetch('../enregistrer_renseignement.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `product_id=${productId}&message=${encodeURIComponent(message)}`
        })
        .then(response => response.text())
        .then(data => {
            console.log("Réponse du serveur :", data); // Affiche la réponse dans la console
            if (data.includes("Insertion réussie")) {
                alert("Votre demande de renseignement a été envoyée avec succès !");
            } else {
                alert("Erreur lors de l'envoi de votre demande de renseignement.");
            }
        })
        .catch(error => {
            console.error("Erreur lors de l'envoi de la demande de renseignement :", error);
            alert("Une erreur est survenue. Veuillez réessayer.");
        });
    }
}
