/**
 * created by: tushar Khan
 * email : tushar.khan0122@gmail.com
 * date : 1/5/2025
 */


$(document).ready(function () {
    function loadCategories() {
        const xhttp = new XMLHttpRequest();
        xhttp.open("GET", 'lib/list_cat.php')
        xhttp.onload = function () {
            let data = JSON.parse(this.response);
            const categoryDropdown = $('#product_category');
            const categoryList = $('#category-list');
            categoryDropdown.empty();
            categoryList.empty();

            data.forEach(category => {
                categoryDropdown.append(`<option value="${category.id}">${category.name}</option>`);
                categoryList.append(`<li>${category.name}</li>`);
            });
        }
        xhttp.send();
    }

    $('#category-form').on('submit', function (e) {
        e.preventDefault();
        $.post($(this).attr('action'), $(this).serialize(), function () {
            loadCategories();
        });
    });

    var optionIndex = 1; // Start from the next available index

    document.getElementById('add-option').addEventListener('click', function () {
        const container = document.getElementById('options-container');

        const optionHTML = ` <hr>
            <div class="option-item form-group" data-index="${optionIndex}">
                <label>Option Name:</label>
                <input type="text" name="options[${optionIndex}][name]" class="form-control" required>
                
                <label>Image:</label>
                <input type="file" name="options[${optionIndex}][image]" class="form-control" required>
                
                <label>Price:</label>
                <input type="number" name="options[${optionIndex}][price]" class="form-control" required>
                
                <button type="button" class="remove-option">Remove</button>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', optionHTML);
        optionIndex++;
    });

    document.getElementById('options-container').addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-option')) {
            e.target.parentElement.remove();
        }
    });

    function loadProducts() {
        const xhttp = new XMLHttpRequest();
        xhttp.open("GET", 'lib/list.php')
        xhttp.onload = function () {
            let data = JSON.parse(this.response);
            const productList = $('#product-list');
            productList.empty();

            data.forEach(product => {
                productList.append(`

<tr>
<td>${product.category_name}</td>
<td>${product.product_name}</td>
<td><img src="${product.image_path}" alt="${product.option_name}" width="100"></td>
<td>${product.price} BDT</td>
<td>${product.option_name}</td>
<td class="btn-group" role="group" >
    <button class="add-to-cart btn btn-primary" data-id="${product.id}">Add to Cart</button>
    <button class="remove-from-cart btn btn-info" data-id="${product.id}">Remove from Cart</button>
</td>
</tr>
                `);
            });
        }
        xhttp.send();
    }

    $(document).on('click', '.add-to-cart, .remove-from-cart', function () {
        const productId = $(this).data('id');
        const action = $(this).hasClass('add-to-cart') ? 'add' : 'remove';

        $.post('lib/cart.php', { product_id: productId, action: action }, function () {
            loadProducts();
        });
    });

    loadCategories();
    loadProducts();
});

