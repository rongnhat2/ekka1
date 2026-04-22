const View = {
    Cart: {
        render(data) {
            // Lấy dữ liệu giỏ hàng từ localStorage
            var cards =
                localStorage.getItem("card") == null
                    ? []
                    : localStorage.getItem("card").split("-");
            var size_id =
                localStorage.getItem("size") == null
                    ? []
                    : localStorage.getItem("size").split(",");
            var quantitys =
                localStorage.getItem("quantity") == null
                    ? []
                    : localStorage.getItem("quantity").split("-");
            var id_index = cards.indexOf(data.id + "");

            var image = data.images.split(",")[0];
            var discount = (data.prices * data.discount) / 100;
            var real_prices =
                data.discount == 0 ? data.prices : data.prices - discount;

            let prices = "";
            if (discount != 0) {
                prices += `<del class="m-r-10">${View.formatNumber(data.prices)} đ</del>`;
            }
            prices += `<span class="amount"> ${View.formatNumber(real_prices)} đ </span>`;

            // Quantity hiện tại của sản phẩm (xử lý tương tự với giỏ hàng)
            let qty =
                quantitys && id_index > -1 && quantitys[id_index]
                    ? quantitys[id_index]
                    : 1;
            qty = parseInt(qty) || 1;

            $(".cart-list").append(`
                <tr data-id="${data.id}"
                    data-prices="${data.prices}" 
                    data-real-prices="${real_prices}"
                    data-discount="${discount}"
                    data-discount-value="${data.discount}"
                    data-total-prices="${data.prices * qty}"
                    data-total-discount="${discount * qty}"
                    data-total-real-prices="${real_prices * qty}"
                    data-quatity="${qty}">
                    <td data-label="Product" class="ec-cart-pro-name"><a href="/product?id=${data.id}">
                        <img class="ec-cart-pro-img mr-4" src="/${image}" alt="" />${data.name}</a>
                    </td>
                    <td data-label="Price" class="ec-cart-pro-price">
                        ${prices}
                    </td>
                    <td >
                        ${size_id[id_index] || ""}
                    </td>
                    <td data-label="Quantity" class="ec-cart-pro-qty" style="text-align: center;">
                        <div class="cart-qty-plus-minus">
                            <input class="cart-plus-minus input-qty" type="text" name="cartqtybutton" value="${qty}" />
                        </div>
                    </td>
                    <td data-label="Total" class="ec-cart-pro-subtotal data-total-prices">${View.formatNumber(real_prices * qty)} đ</td>
                    <td data-label="Remove" class="ec-cart-pro-remove">
                        <a href="#" class="remove-item"><i class="ecicon eci-trash-o"></i></a>
                    </td>
                </tr> 
            `);
            View.Cart.setTotal();
        },
        setTotal() {
            var subtotal = 0;
            var discount = 0;
            var total = 0;
            $(".cart-list tr").each(function (index, el) {
                subtotal += +$(this).attr("data-total-prices");
                discount += +$(this).attr("data-total-discount");
                total += +$(this).attr("data-total-real-prices");
            });
            $(".sub-total").html(View.formatNumber(subtotal) + " đ");
            $(".discount-total").html(
                "- " + View.formatNumber(discount) + " đ",
            );
            $(".real-total").html(View.formatNumber(total) + " đ");
            $(".real-total").attr("data-total", total);
        },
    },
    Product: {
        renderNew(data) {
            data.map((v) => {
                var image = v.images.split(",")[0];
                var metadata = JSON.parse(v.metadata);
                var size = (metadata.size || [])
                    .map(
                        (sz) =>
                            `<li><a href="#" class="ec-opt-sz">${sz}</a></li>`,
                    )
                    .join("");
                var color = (metadata.color || [])
                    .map(
                        (cl) =>
                            `<li><a href="#" class="ec-opt-clr-img" ><span style="background-color: ${cl};"></span></a></li>`,
                    )
                    .join("");
                var discount =
                    v.discount == 0
                        ? ""
                        : `<span class="percentage">${v.discount}%</span><span class="flags"> <span class="sale">Sale</span> </span>`;
                var real_prices = View.formatNumber(
                    v.discount == 0
                        ? v.prices
                        : v.prices - (v.prices * v.discount) / 100,
                );
                var discount_value =
                    v.discount == 0
                        ? ""
                        : `<span class="old-price">${View.formatNumber(v.prices)} đ</span>`;
                $(".new-product").append(`
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6  ec-product-content" data-animation="fadeIn">
                        <div class="ec-product-inner">
                            <div class="ec-pro-image-outer">
                                <div class="ec-pro-image">
                                    <a href="/product?id=${v.id}" class="image">
                                        <img class="main-image" src="${image}" alt="Product" />
                                    </a>
                                    ${discount}
                                </div>
                            </div>
                            <div class="ec-pro-content">
                                <h5 class="ec-pro-title"><a href="/product?id=${v.id}">${v.name}</a></h5>
                                <span class="ec-price">
                                    ${discount_value}
                                    <span class="new-price">${real_prices} đ</span>
                                </span>
                                <div class="ec-pro-option">
                                    <div class="ec-pro-color">
                                        <span class="ec-pro-opt-label">Color</span>
                                        <ul class="ec-opt-swatch ec-change-img">
                                            ${color}
                                        </ul>
                                    </div>
                                    <div class="ec-pro-size">
                                        <span class="ec-pro-opt-label">Size</span>
                                        <ul class="ec-opt-size">
                                            ${size}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`);
            });
            $(".new-product").append(
                `<div class="col-sm-12 shop-all-btn"><a href="/category?sort=1">Xem thêm</a></div>`,
            );
        },
    },
    formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
    },
    isNumberKey(evt) {
        var charCode = evt.which ? evt.which : event.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
        return true;
    },
    onRemove(callback) {
        $(document).on("click", `.remove-item`, function (event) {
            var father = $(this).closest("tr");
            var id = father.attr("data-id");
            father.remove();
            callback(id);
        });
    },
    onCheckout(callback) {
        $(document).on("click", `.action-checkout`, function (event) {
            callback($(".real-total").attr("data-total"));
        });
    },
    init() {
        $(document).on("keypress", `.input-qty`, function (event) {
            return View.isNumberKey(event);
        });
        $(document).on("keyup", `.input-qty`, function (event) {
            var father = $(this).closest("tr");
            var prices = father.attr("data-prices");
            var real_prices = father.attr("data-real-prices");
            var discount = father.attr("data-discount");
            var quantity = parseInt(father.find(".input-qty").val()) || 1;

            father
                .find(".data-total-prices")
                .html(View.formatNumber(real_prices * quantity) + " đ");
            father.attr("data-quatity", quantity);
            father.attr("data-total-prices", prices * quantity);
            father.attr("data-total-discount", discount * quantity);
            father.attr("data-total-real-prices", real_prices * quantity);

            // Đồng bộ quantity vào localStorage (xử lý tương tự với giỏ hàng)
            var cards =
                localStorage.getItem("card") == null
                    ? []
                    : localStorage.getItem("card").split("-");
            var curr_id = father.attr("data-id");
            var idx = cards.indexOf(curr_id);
            var quantitys =
                localStorage.getItem("quantity") == null
                    ? []
                    : localStorage.getItem("quantity").split("-");
            if (idx > -1) {
                quantitys[idx] = quantity;
                localStorage.setItem("quantity", quantitys.join("-"));
            }
            View.Cart.setTotal();
        });
    },
};
(() => {
    View.init();
    function init() {
        getCart();
        getNewArrivals();
    }
    View.onRemove((id) => {
        // Xử lý xóa item: đồng bộ với cả "card", "size" và "quantity"
        var cards = localStorage.getItem("card")
            ? localStorage.getItem("card").split("-")
            : [];
        var sizes = localStorage.getItem("size")
            ? localStorage.getItem("size").split(",")
            : [];
        var colors = localStorage.getItem("color")
            ? localStorage.getItem("color").split(",")
            : [];
        var quantitys = localStorage.getItem("quantity")
            ? localStorage.getItem("quantity").split("-")
            : [];

        var idx = cards.indexOf(id);
        if (idx > -1) {
            cards.splice(idx, 1);
            sizes.splice(idx, 1);
            colors.splice(idx, 1);
            quantitys.splice(idx, 1);

            if (!cards.length) {
                localStorage.removeItem("card");
                localStorage.removeItem("size");
                localStorage.removeItem("color");
                localStorage.removeItem("quantity");
            } else {
                localStorage.setItem("card", cards.join("-"));
                localStorage.setItem("size", sizes.join(","));
                localStorage.setItem("color", colors.join(","));
                localStorage.setItem("quantity", quantitys.join("-"));
            }
        }
        View.Cart.setTotal();
    });
    View.onCheckout((total_prices) => {
        // Lưu quantity hiện tại lần cuối khi checkout
        var quantity_list = [];
        $(".cart-list tr").each(function (index, el) {
            let qty = $(this).find(".input-qty").val();
            quantity_list.push(qty);
        });
        localStorage.setItem("quantity", quantity_list.join("-"));
        localStorage.setItem("total_prices", total_prices);
    });
    function getCart() {
        var cart_item =
            localStorage.getItem("card") == null
                ? []
                : localStorage.getItem("card").split("-");
        cart_item.forEach((v) => {
            if (v) getItem(v);
        });
    }
    function getItem(id) {
        Api.Product.GetOneItem(id)
            .done((res) => {
                if (res.data && res.data[0]) {
                    View.Cart.render(res.data[0]);
                }
            })
            .fail((err) => {})
            .always(() => {});
    }
    function getNewArrivals() {
        Api.Product.NewArrivals()
            .done((res) => {
                View.Product.renderNew(res.data);
            })
            .fail((err) => {})
            .always(() => {});
    }
    init();
})();
