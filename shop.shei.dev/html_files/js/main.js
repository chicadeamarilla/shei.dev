$(document).ready(function () {



    function setCookie(name, value, days) {
        let expires = "";
        if (days) {
            const date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + encodeURIComponent(value) + expires + "; path=/";
    }

    function getCookie(name) {
        const nameEQ = name + "=";
        const ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i].trim();
            if (c.indexOf(nameEQ) === 0) {
                return decodeURIComponent(c.substring(nameEQ.length, c.length));
            }
        }
        return null;
    }


     $('#search-input').on('keyup', function () {
 
        let query = $(this).val().trim();
        console.log(query);


    

        $.ajax({
            url: 'https://api.shei.dev/backend/web/product/search?q='+query,   // your PHP handler
            type: 'GET',
            
            success: function (response) {
                // response should be HTML or JSON
                $('#search-results').html(response).show();
            }
        }); 

    });


    let path = window.location.pathname;

    // Extract file name
    let fileName = path.substring(path.lastIndexOf('/') + 1);

    console.log(fileName);

    if (getCookie("user-app-id") && fileName == "login.php") {
        window.location.href = "index.php";
    }

    if (getCookie("user-app-id")) {

        $("#sign_in_link").html(getCookie("user-app-id"));
        $("#sign_in_link").attr('href', 'logout.php');

    }


    $.ajax({
        url: 'https://api.shei.dev/backend/web/product_category/product_category_list',
        type: 'GET',
        success: function (response) {
            console.log("hi 5");
            response = JSON.parse(response);
            Object.values(response.data).forEach(cat => {
                $("#all_cats,#home_category_list").append(`
    <li><a href="/html_files/shop.php?product_category_id=${cat.id}">${cat.name}</a></li>`);
            });

        }
    });


    const urlParams = new URLSearchParams(window.location.search);

    if (urlParams.has('product_category_id')) {





        console.log('id param exists:', urlParams.get('product_category_id'));

        $.ajax({
            url: 'https://api.shei.dev/backend/web/product/product_list?id=' + urlParams.get('product_category_id'),
            type: 'GET',
            success: function (response) {
                response = JSON.parse(response);
                $("#cat_name").html(response.name);



                console.log(response.data);
                Object.values(response.data).forEach(product => {
                    $("#product_list").append(`
    <div class="product-wrap">
      <div class="product">
        <figure class="product-media">
          <a href="product.html?id=${product.id}">
            <img src="https://api.shei.dev/backend/web/${product.image}" alt="${product.name}" width="280" height="315">
          </a>
          <div class="product-label-group">
            ${product.isNew ? '<label class="product-label label-new">new</label>' : ''}
            ${product.discount ? `<label class="product-label label-sale">${product.discount}% OFF</label>` : ''}
          </div>
          <div class="product-action-vertical">
            <a href="#" class="btn-product-icon btn-cart" title="Add to cart"><i class="d-icon-bag"></i></a>
            <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"><i class="d-icon-heart"></i></a>
          </div>
          <div class="product-action">
            <a href="#" class="btn-product btn-quickview" title="Quick View">Quick View</a>
          </div>
        </figure>
        <div class="product-details">
          <div class="product-cat">
            <a href="#">${product.description}</a>
          </div>
          <h3 class="product-name">
            <a href="product.html?id=${product.id}">${product.name}</a>
          </h3>
          <div class="product-price">
            <ins class="new-price">$${product.price}</ins>
          </div>
          <div class="ratings-container">
            <div class="ratings-full">
              <span class="ratings" style="width:${product.rating * 20}%"></span>
            </div>
            <a href="#" class="rating-reviews">(${product.reviews} reviews)</a>
          </div>
        </div>
      </div>
    </div>
  `);

                });






                console.log('Response:', response);
            },
            error: function (xhr) {
                console.error('Error:', xhr);
            }
        });





    } else {
        console.log('no id param');
    }


    $("#LOGIN").click(function () {


        //console.log("hi hi");
        if (!$('#singin-email').val() && !$('#singin-password').val()) {
            return;
        }
        event.preventDefault();
        $.ajax({
            url: "https://api.shei.dev/backend/web/user/login",   // your server script
            type: "POST",        // or "GET"
            data: { user_email: $('#singin-email').val(), user_password: $('#singin-password').val() }, // data to send
            success: function (response) {


                //alert(response);
                //$("#test").html(response);
                //$("#result").html("Server says: " + response);
                //window.location.href = "demo18.html";
                response = JSON.parse(response);
                //console.log(response);
                //return;

                if (response.err) {
                    Toastify({
                        text: response.err,
                        duration: 3000,
                        destination: "https://github.com/apvarun/toastify-js",

                        close: true,
                        gravity: "top", // `top` or `bottom`
                        position: "left", // `left`, `center` or `right`
                        stopOnFocus: true, // Prevents dismissing of toast on hover
                        style: {
                            background: "linear-gradient(to right, #ff0707ff, #8d0d5cff)",
                        },

                    }).showToast();
                } else {


                    setCookie("user-app-id", response.user_id, 10000);

                    Toastify({
                        text: response.ok,
                        duration: 3000,
                        destination: "https://github.com/apvarun/toastify-js",

                        close: true,
                        gravity: "top", // `top` or `bottom`
                        position: "left", // `left`, `center` or `right`
                        stopOnFocus: true, // Prevents dismissing of toast on hover
                        style: {
                            background: "linear-gradient(to right, #63e722ff, #179933ff)",
                        },



                    }).showToast();

                    setTimeout(() => {
                        window.location.href = "index.php";
                    }, 3000);





                }



            },
            error: function (xhr, status, error) {
                //alert(error);




            }
        });
    });
});
