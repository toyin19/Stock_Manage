/**
 * Quantity management
 */
document.addEventListener('DOMContentLoaded',()=>{
    const qtyDecrement=document.querySelector('#qty-decrement');
    const qtyIncrement=document.querySelector('#qty-increment');
    
    qtyDecrement.addEventListener('click', decrementQuantity);
    
    qtyIncrement.addEventListener('click', incrementQuantity);
    function incrementQuantity() {
        console.log('ok')
        let input = document.querySelector('#quantite');
        console.log(input.value);
        if (parseInt(input.value) < 100) {
            input.value++;
            setPrix();
        }
    }
    
    function decrementQuantity() {
        let input = document.querySelector('#quantite');
        if (parseInt(input.value) > 1) {
            input.value--;
            setPrix();
        }
    }
})


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
                optionsHTML += `<option data-prix="${value.prix_unitaire}" value="${value.id}">${value.nom_article} - ${value.quantite} disponible</option>`;
            });
        return optionsHTML;
    }
});

/**
 * Submit form
 */
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('#buy-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        const produits = [];
        const productBlock=document.querySelectorAll('.checkout-flex');
        productBlock.forEach((product)=>{
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
        })
       .catch(error => {
            console.error('Erreur:', error);
        });
    });
});