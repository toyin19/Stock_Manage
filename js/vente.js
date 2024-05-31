/**
 * Define price
 */
function annuleVente(idVente, idArticle, quantite) {
    if (confirm("Voulez vous vraiment annuler cette vente ?")) {
        window.location.href = "../model/annuleVente.php?idVente=" + idVente + "&idArticle=" + idArticle + "&quantite=" + quantite
    }
}
function setPrix() {
    let totalPrix = 0;
    const products = document.querySelectorAll('.checkout-flex');
    products.forEach(product => {
        var article = product.querySelector('#id_article');
        var quantite = product.querySelector('#quantite');
        var prixElement = document.querySelector('#prix'); 

        var prixUnitaire = article.options[article.selectedIndex].getAttribute('data-prix');

        totalPrix += Number(quantite.value) * Number(prixUnitaire);

        prixElement.setAttribute('value', totalPrix.toString());
        console.log(totalPrix);

        setQuantity(product);
    });
}


function setQuantity(product) {
    var selectElement = product.querySelector('#id_article');
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    if (selectedOption.value !== "") {
        var quantityLimit = selectedOption.getAttribute('data-quantity');
        var inputElement = product.querySelector('#quantite');
        inputElement.setAttribute('max', quantityLimit);
    } else {
        var inputElement = product.querySelector('#quantite');
        inputElement.removeAttribute('max');
    }
}

/**
 * Quantity management
 */
document.addEventListener('DOMContentLoaded', () => {
    const products = document.querySelectorAll('.checkout-flex');
    products.forEach(product => {
        const qtyDecrement = product.querySelector('#qty-decrement');
        const qtyIncrement = product.querySelector('#qty-increment');

        qtyDecrement.addEventListener('click', () => decrementQuantity(product));
        qtyIncrement.addEventListener('click', () => incrementQuantity(product));
    });

    function incrementQuantity(product) {
        let input = product.querySelector('#quantite');
        let max = input.getAttribute('max');
        if (parseInt(input.value) < max) {
            input.value++;
            setPrix(); 
        }
    }

    function decrementQuantity(product) {
        let input = product.querySelector('#quantite');
        if (parseInt(input.value) > 1) {
            input.value--;
            setPrix();
        }
    }
});

/**
 * Add product
 */
document.addEventListener('DOMContentLoaded', () => {
    const addProduct = document.querySelector('#addProduct');
    const productsContainer = document.querySelector('#products');
    const products = JSON.parse(productsContainer.getAttribute('data-products'));
    let index = 2;
    addProduct.addEventListener('click', addProductField);
    function addProductField() {
        // Création du contenu HTML à ajouter
        const newProductHTML = `
            <div class="checkout-flex" id="product-${index}">
                <div class="checkout-flex__article">
                    <label for="id_article">Article</label>
                    <select onchange="setPrix()" name="id_article" id="id_article">
                        ${getArticlesOptions()}
                    </select>
                </div>
                <div class="checkout-flex__quantity">
                    <label for="quantite">Quantité</label>
                    <div class="quantity-controls">
                        <p id="qty-decrement" class="qty-btn">-</p>
                        <input onkeyup="setPrix()" value="0" type="number" name="quantite" id="quantite" placeholder="Veuillez entrer la quantité" min="1" />
                        <p id="qty-increment" class="qty-btn">+</p>
                    </div>
                </div>
            </div>
        `;

        const newProductElement = document.createElement('div');
        newProductElement.id = 'products';
        newProductElement.innerHTML = newProductHTML;
        productsContainer.appendChild(newProductElement);
        index++;
    }

    // Fonction pour générer les options de l'article
    function getArticlesOptions() {
        let optionsHTML = '';
        console.log(products)
        products.forEach((value, key) => {
            optionsHTML += `<option data-prix="${value.prix_unitaire}" data-quantity="${value.quantite}" value="${value.id}">${value.nom_article} - ${value.quantite} disponible</option>`;
        });
        return optionsHTML;
    }
});

/**
 * Submit form
 */
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('#buy-form');
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        const produits = [];
        const productBlock = document.querySelectorAll('.checkout-flex');
        productBlock.forEach((product) => {
            const idArticle = product.querySelector('#id_article').value;
            const quantite = product.querySelector('#quantite').value;
            produits.push({ id: idArticle, quantite: quantite });
        })

        const formData = new FormData(form);
        formData.append('produits', JSON.stringify(produits));

        fetch(form.action, {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                console.log('Succès:', data);
                window.location.reload();
            })
            .catch(error => {
                console.error('Erreur:', error);
            });
    });
});