//add to cart
function add_to_cart() {
    $(document).ready(function() {
        $(".cart-btn").each(function() {
            $(this).click(function() {

                var cookies = document.cookie.split(";");
                var i;
                var temp = [];
                for (i = 0; i < cookies.length; i++) {
                    var key = cookies[i].split("=");

                    if (key[0].trim() != '_au_') {
                        temp[i] = key[0].trim();
                    } else {
                        temp = "matched";
                    }
                }
                if (temp == "matched") {
                    var product_id = $(this).attr("product-id");
                    var product_title = $(this).attr("product-title");
                    var product_brand = $(this).attr("product-brand");
                    var product_price = $(this).attr("product-price");
                    var product_pic = $(this).attr("product-pic");
                    $.ajax({
                        type: "POST",
                        url: "http://localhost/shop/pages/php/cart.php",
                        data: {
                            product_id: product_id,
                            product_title: product_title,
                            product_brand: product_brand,
                            product_price: product_price,
                            product_pic: product_pic
                        },
                        success: function(response) {
                            if (response.trim() == "success") {
                                // alert($(".cart-notification").prop("nodeName"));
                                if ($(".cart-notification").prop("nodeName") != undefined) {
                                    var no = Number($(".cart-notification span").html());
                                    no++;
                                    $(".cart-notification span").html(no);
                                } else {
                                    var div = document.createElement("DIV");
                                    div.style.position = "absolute";
                                    div.style.background = "red";
                                    div.style.color = "whitesmoke";
                                    div.style.width = "25px";
                                    div.style.height = "25px";
                                    div.style.fontWeight = "bold";
                                    div.style.borderRadius = "50%";
                                    div.style.zIndex = "10000";
                                    div.style.top = "-10px";
                                    div.style.left = "25px";
                                    div.className = "cart-notification";
                                    var span = document.createElement("SPAN");
                                    span.innerHTML = 1;
                                    $(div).append(span);
                                    $(".cart-link").append(div);
                                }
                            } else {
                                alert(response);
                            }
                        }
                    });
                } else {
                    window.location = "signin.php";
                }
            });
        });
    });
}
add_to_cart();
//remove cart product
$(document).ready(function() {
    $(".delete-card-btn").each(function() {
        $(this).click(function() {
            var delete_btn = this;
            var product_id = $(this).attr("product-id");
            $.ajax({
                type: "POST",
                url: "remove_cart.php",
                data: {
                    product_id: product_id
                },
                success: function(response) {
                    if (response.trim() == "success") {
                        var delete_box = delete_btn.parentElement.parentElement.parentElement;
                        delete_box.remove();
                    } else {
                        alert(response);
                    }
                }
            });
        });
    });
});

//buy now 
function buy_now() {
    $(document).ready(function() {
        $(".buy-now").each(function() {
            $(this).click(function() {
                var product_id = $(this).attr("product-id");
                window.location = "http://localhost/shop/pages/php/buy_product.php?product_id=" + product_id;
            });
        })
    });
}
buy_now();
//purchase button

$(document).ready(function() {
    $(".purchase-btn").click(function() {
        var pay_mode = $("input[name='pay-mode']:checked").val();
        if (pay_mode) {
            var id = $(this).attr("product-id");
            var product_title = $(this).attr("product-title");
            var product_brand = $(this).attr("product-brand");
            var product_price = $(this).attr("product-price");
            var quantity = $(".quantity").val();
            if (pay_mode == "online") {
                window.location = "../../pay/pay.php?id=" + id + "&product-title=" +
                    product_title + "&product-brand=" + product_brand + "&product-price=" +
                    product_price + "&qnt=" + quantity;
            } else {
                window.location = "../../pay/purchase_entry.php?id=" + id + "&title=" +
                    product_title + "&brand=" + product_brand + "&price=" +
                    product_price + "&qnt=" + quantity + "&payment-mode=cod";
            }
        } else {
            alert("Please choose a payment mode");
        }

    });
});


//pincode
$(document).ready(function() {
    $(".pincode-btn").click(function() {
        var pincode = $(".pincode-field").val();
        $.ajax({
            type: "POST",
            url: "check_pincode.php",
            data: {
                pincode: pincode
            },
            success: function(response) {
                $(".pincode-message").html(response);
            }
        });
    });
});

//stocks control
$(document).ready(function() {
    $(".quantity").on("input", function() {
        var stocks = Number($('.stocks').html());
        if ($(this).val() > stocks) {
            alert("Negative stocks");
            $(this).val('1');
        }
    });
});

//preview
$(document).ready(function() {
    $(".thumb_pic").each(function() {
        $(this).click(function() {
            var src = $(this).attr('src');
            $(".preview").attr("src", src);
        });
    });
});

//filter
$(document).ready(function() {
    $(".filter-btn").each(function() {
        $(this).click(function() {
            $(".filter-btn").each(function() {
                $(this).removeClass("btn-primary rounded px-2 shadow-sm");
            });
            $(this).addClass("btn-primary rounded px-2 shadow-sm");
            var cat_name = $(this).attr("cat-name");
            var brand = $(this).attr("brand");
            $.ajax({
                type: "POST",
                url: "filter.php",
                data: {
                    cat_name: cat_name,
                    brand: brand
                },
                beforeSend: function() {
                    $(".product-result").html("Loading...");
                },
                success: function(response) {
                    $(".product-result").html("");
                    var all_data = JSON.parse(response.trim());
                    var i;
                    if (all_data.length == 0) {
                        $(".product-result").html("<h2 ><i class='fa fa-shopping-cart'></i> No Product is avaliable</h2>");
                    } else {
                        for (i = 0; i < all_data.length; i++) {
                            var div = document.createElement("DIV");
                            div.className = "text-center  border shadow-sm p-3 mb-4";
                            var img = document.createElement("IMG");
                            img.src = "../../" + all_data[i].thumb_pic;
                            img.width = "250";
                            img.height = "316";
                            //brand
                            var brand_span = document.createElement("SPAN");
                            brand_span.className = "text-uppercase font-weight-bold p-0 m-0";
                            brand_span.innerHTML = "<br>" + all_data[i].brands + "</br>";
                            //title
                            var title_span = document.createElement("SPAN");
                            title_span.className = "text-uppercase p-0 m-0";
                            title_span.innerHTML = "<br>" + all_data[i].title + "</br>";
                            //price
                            var price_span = document.createElement("SPAN");
                            price_span.className = "text-uppercase p-0 m-0";
                            price_span.innerHTML = "<br><i class='fa fa-rupee'></i> " +
                                all_data[i].price + "</br>";
                            //add to  cart
                            var cart_btn = document.createElement("BUTTON");
                            cart_btn.className = "btn btn-danger mt-3 mr-3 cart-btn";
                            cart_btn.innerHTML = "<i class='fa fa-shopping-cart'></i> ADD TO CART";
                            $(cart_btn).attr("product-title", all_data[i].title);
                            $(cart_btn).attr("product-id", all_data[i].id);
                            $(cart_btn).attr("product-price", all_data[i].price);
                            $(cart_btn).attr("product-brand", all_data[i].brands);
                            $(cart_btn).attr("product-pic", all_data[i].thumb_pic);
                            //buy now
                            var buy_btn = document.createElement("BUTTON");
                            buy_btn.className = "btn btn-primary mt-3 mr-3 buy-now";
                            buy_btn.innerHTML = "<i class='fa fa-shopping-bag'></i> BUY NOW";
                            $(buy_btn).attr("product-title", all_data[i].title);
                            $(buy_btn).attr("product-id", all_data[i].id);
                            $(buy_btn).attr("product-price", all_data[i].price);
                            $(buy_btn).attr("product-brand", all_data[i].brands);
                            $(buy_btn).attr("product-pic", all_data[i].thumb_pic);

                            $(div).append(img);
                            $(div).append(brand_span);
                            $(div).append(title_span);
                            $(div).append(price_span);
                            $(div).append(cart_btn);
                            $(div).append(buy_btn);
                            $(".product-result").append(div);

                        }
                        add_to_cart();
                        buy_now();
                    }
                }
            });
        });
    });
});

//default filter button
$(document).ready(function() {
    var filter = $(".filter-btn");
    filter[0].click();
});

//filter by price
$(document).ready(function() {
    $('.price-filter-btn').click(function() {
        var min_price = $(".min-price").val();
        var max_price = $(".max-price").val();
        var c_name = $(this).attr('cat-name');
        console.log(c_name);
        $.ajax({
            type: "POST",
            url: "filter_by_price.php",
            data: {
                min_price: min_price,
                max_price: max_price,
                c_name: c_name
            },
            beforeSend: function() {
                $(".product-result").html("Loading..");
            },
            success: function(response) {

                $(".product-result").html("");
                var all_data = JSON.parse(response.trim());
                var i;
                if (all_data.length == 0) {
                    $(".product-result").html("<h2 ><i class='fa fa-shopping-cart'></i> No Product is avaliable</h2>");
                } else {
                    for (i = 0; i < all_data.length; i++) {
                        var div = document.createElement("DIV");
                        div.className = "text-center  border shadow-sm p-3 mb-4";
                        var img = document.createElement("IMG");
                        img.src = "../../" + all_data[i].thumb_pic;
                        img.width = "250";
                        img.height = "316";
                        //brand
                        var brand_span = document.createElement("SPAN");
                        brand_span.className = "text-uppercase font-weight-bold p-0 m-0";
                        brand_span.innerHTML = "<br>" + all_data[i].brands + "</br>";
                        //title
                        var title_span = document.createElement("SPAN");
                        title_span.className = "text-uppercase font-weight-bold p-0 m-0";
                        title_span.innerHTML = "<br>" + all_data[i].title + "</br>";
                        //price
                        var price_span = document.createElement("SPAN");
                        price_span.className = "text-uppercase font-weight-bold p-0 m-0";
                        price_span.innerHTML = "<br><i class='fa fa-rupee'></i> " +
                            all_data[i].price + "</br>";
                        //add to  cart
                        var cart_btn = document.createElement("BUTTON");
                        cart_btn.className = "btn btn-danger mt-3 mr-3 cart-btn";
                        cart_btn.innerHTML = "<i class='fa fa-shopping-cart'></i> ADD TO CART";
                        $(cart_btn).attr("product-title", all_data[i].title);
                        $(cart_btn).attr("product-id", all_data[i].id);
                        $(cart_btn).attr("product-price", all_data[i].price);
                        $(cart_btn).attr("product-brand", all_data[i].brands);
                        $(cart_btn).attr("product-pic", all_data[i].thumb_pic);
                        //buy now
                        var buy_btn = document.createElement("BUTTON");
                        buy_btn.className = "btn btn-primary mt-3 mr-3 buy-now";
                        buy_btn.innerHTML = "<i class='fa fa-shopping-bag'></i> BUY NOW";
                        $(buy_btn).attr("product-title", all_data[i].title);
                        $(buy_btn).attr("product-id", all_data[i].id);
                        $(buy_btn).attr("product-price", all_data[i].price);
                        $(buy_btn).attr("product-brand", all_data[i].brands);
                        $(buy_btn).attr("product-pic", all_data[i].thumb_pic);

                        $(div).append(img);
                        $(div).append(brand_span);
                        $(div).append(title_span);
                        $(div).append(price_span);
                        $(div).append(cart_btn);
                        $(div).append(buy_btn);
                        $(".product-result").append(div);

                    }
                    add_to_cart();
                    buy_now();
                }
            }
        });
    });
});