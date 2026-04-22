const View = {
    Description: {
        // Lưu lại state lựa chọn hiện tại trên UI
        selected: {
            size_id: null,
            color_id: null,
        },
        // Helper để lấy đúng variant theo lựa chọn size / color, nếu không khớp thì default
        getSelectedVariant(data) {
            const size_id = View.Description.selected.size_id;
            const color_id = View.Description.selected.color_id;
            if (data.product_var && data.product_var.length) {
                // Ưu tiên filter cả 2
                let variant = data.product_var.find(
                    (v) =>
                        (!size_id || v.size_id == size_id) &&
                        (!color_id || v.color_id == color_id),
                );
                if (!variant && (size_id || color_id)) {
                    // filter theo size
                    variant = data.product_var.find(
                        (v) => !size_id || v.size_id == size_id,
                    );
                }
                if (!variant && (size_id || color_id)) {
                    // filter theo color
                    variant = data.product_var.find(
                        (v) => !color_id || v.color_id == color_id,
                    );
                }
                // fallback: default = product_var[0]
                return variant || data.product_var[0];
            }
            return null;
        },
        render(data) {
            // Lấy thông tin giỏ hàng từ localStorage
            const cards =
                localStorage.getItem("card") == null
                    ? []
                    : localStorage.getItem("card").split("-");
            const size_id =
                localStorage.getItem("size") == null
                    ? []
                    : localStorage.getItem("size").split(",");
            const color_id =
                localStorage.getItem("color") == null
                    ? []
                    : localStorage.getItem("color").split(",");
            const id_index = cards.indexOf(data.id + "");

            // Lấy danh sách size (duy nhất) và màu (duy nhất) dựa vào các product_var
            const sizeSet = {};
            const colorSet = {};
            (data.product_var || []).forEach((v) => {
                sizeSet[v.size_id] = v.size_name;
                colorSet[v.color_id] = v.color_name;
            });

            const sizeList = Object.entries(sizeSet)
                .map(
                    ([id, name]) =>
                        `<li size-id="${id}"><span>${name}</span></li>`,
                )
                .join("");
            const colorList = Object.entries(colorSet)
                .map(
                    ([id, name]) =>
                        `<li color-id="${id}"><span style="background-color: ${name};"></span> ${name}</li>`,
                )
                .join("");

            $(".product-size").html(sizeList);
            $(".product-color").html(colorList);

            // --- Xử lý chọn size/màu ban đầu và state ---
            // Use saved value or default
            let selected_size = null,
                selected_color = null;

            if (size_id[id_index]) {
                selected_size = size_id[id_index];
            } else if (Object.keys(sizeSet).length > 0) {
                selected_size = Object.keys(sizeSet)[0];
            }

            if (color_id && color_id[id_index]) {
                selected_color = color_id[id_index];
            } else if (Object.keys(colorSet).length > 0) {
                selected_color = Object.keys(colorSet)[0];
            }

            // Gán vào state
            View.Description.selected.size_id = selected_size;
            View.Description.selected.color_id = selected_color;

            // set active UI
            if (selected_size)
                $(`.product-size li[size-id="${selected_size}"]`).addClass(
                    "is-active",
                );
            if (selected_color)
                $(`.product-color li[color-id="${selected_color}"]`).addClass(
                    "is-active",
                );

            // Render giá đúng theo variant được chọn (size+color)
            const variant = View.Description.getSelectedVariant(data);

            let real_prices = 0,
                sell_prices = 0;
            let discount = data.discount || 0;
            let prices = "";

            if (variant) {
                real_prices = View.formatNumber(
                    discount == 0
                        ? variant.prices
                        : variant.prices - (variant.prices * discount) / 100,
                );
                sell_prices = View.formatNumber(
                    (variant.prices * discount) / 100,
                );
                if (discount != 0) {
                    prices += `<del> <span class="new-price">${View.formatNumber(variant.prices)}</span>  đ </del>`;
                }
                prices += `<span class="new-price">${real_prices} đ</span> `;
            } else {
                // fallback nếu không có variant
                real_prices = View.formatNumber(
                    data.discount == 0
                        ? data.prices
                        : data.prices - (data.prices * data.discount) / 100,
                );
                sell_prices = View.formatNumber(
                    (data.prices * data.discount) / 100,
                );
                if (discount != 0) {
                    prices += `<del> <span class="new-price">${View.formatNumber(data.prices)}</span>  đ </del>`;
                }
                prices += `<span class="new-price">${real_prices} đ</span> `;
            }

            $(".action-add-to-card").attr("data-id", data.id);
            $(".action-add-to-card").html(
                cards.includes(data.id + "") ? "✔ đã thêm" : "+ Giỏ hàng",
            );

            $(".product-name").text(data.name);
            $(".product-description").html(data.description);
            $(".product-detail").html(data.detail);
            $(".product-prices").html(prices);
        },
        // Được gọi lại để re-render giá khi lựa chọn thay đổi (size/color)
        updatePrices(data) {
            // Render giá theo variant
            const variant = View.Description.getSelectedVariant(data);
            let real_prices = 0,
                sell_prices = 0;
            let discount = data.discount || 0;
            let prices = "";
            if (variant) {
                real_prices = View.formatNumber(
                    discount == 0
                        ? variant.prices
                        : variant.prices - (variant.prices * discount) / 100,
                );
                sell_prices = View.formatNumber(
                    (variant.prices * discount) / 100,
                );
                if (discount != 0) {
                    prices += `<del> <span class="new-price">${View.formatNumber(variant.prices)}</span>  đ </del>`;
                }
                prices += `<span class="new-price">${real_prices} đ</span> `;
            } else {
                real_prices = View.formatNumber(
                    data.discount == 0
                        ? data.prices
                        : data.prices - (data.prices * data.discount) / 100,
                );
                sell_prices = View.formatNumber(
                    (data.prices * data.discount) / 100,
                );
                if (discount != 0) {
                    prices += `<del> <span class="new-price">${View.formatNumber(data.prices)}</span>  đ </del>`;
                }
                prices += `<span class="new-price">${real_prices} đ</span> `;
            }
            $(".product-prices").html(prices);
        },
    },
    Images: {
        render_list(data) {
            if (!data) return;
            data.split(",").map((value, key) => {
                $(".single-product-cover").append(`
                    <div class="single-slide zoom-image-hover">
                        <img class="img-responsive" src="/${value}" alt="">
                    </div>
                `);
                $(".single-nav-thumb").append(`
                    <div class="single-slide">
                        <img class="img-responsive" src="/${value}" alt="">
                    </div>
                `);
            });
            $(".single-product-cover").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: false,
                asNavFor: ".single-nav-thumb",
            });

            $(".single-nav-thumb").slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                asNavFor: ".single-product-cover",
                dots: false,
                arrows: true,
                focusOnSelect: true,
            });
        },
    },
    RelatedProduct: {
        render(data) {
            var cards =
                localStorage.getItem("card") == null
                    ? ""
                    : localStorage.getItem("card").split("-");
            data.map((v) => {
                var image = v.images && v.images.split(",")[0];
                // Dự đoán mảng product_var truyền về ở sản phẩm liên quan
                let size = "",
                    color = "";
                if (v.product_var && v.product_var.length) {
                    // danh sách unique size
                    const sizeSet = {};
                    const colorSet = {};
                    v.product_var.forEach((pr) => {
                        sizeSet[pr.size_id] = pr.size_name;
                        colorSet[pr.color_id] = pr.color_name;
                    });
                    size = Object.values(sizeSet)
                        .map(
                            (sz) =>
                                `<li><a href="#" class="ec-opt-sz">${sz}</a></li>`,
                        )
                        .join("");
                    color = Object.values(colorSet)
                        .map(
                            (clr) =>
                                `<li><a href="#" class="ec-opt-clr-img"><span style="background-color: ${clr};"></span></a></li>`,
                        )
                        .join("");
                }
                var discount =
                    v.discount == 0
                        ? ""
                        : `<span class="percentage">${v.discount}%</span><span class="flags"> <span class="sale">Sale</span> </span>`;
                var real_prices = View.formatNumber(
                    v.discount == 0 && v.product_var && v.product_var[0]
                        ? v.product_var[0].prices
                        : v.product_var && v.product_var[0]
                          ? v.product_var[0].prices -
                            (v.product_var[0].prices * v.discount) / 100
                          : v.prices - (v.prices * v.discount) / 100,
                );
                var discount_value =
                    v.discount == 0 && v.product_var && v.product_var[0]
                        ? ""
                        : v.discount != 0 && v.product_var && v.product_var[0]
                          ? `<span class="old-price">${View.formatNumber(v.product_var[0].prices)} đ</span>`
                          : v.discount != 0
                            ? `<span class="old-price">${View.formatNumber(v.prices)} đ</span>`
                            : "";
                $(".product-related").append(`
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
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `);
            });
        },
    },
    isNumberKey(evt) {
        var charCode = evt.which ? evt.which : event.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
        return true;
    },
    formatNumber(num) {
        if (typeof num === "undefined" || num === null) return "";
        const n = parseInt(num);
        return n.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
    },
    URL: {
        get(id) {
            var urlParam = new URLSearchParams(window.location.search);
            return urlParam.get(id);
        },
    },
    // Bổ sung phản ứng cho click size & color
    init(productData = null) {
        $(document).on("keypress", `.product-quantity`, function (event) {
            return View.isNumberKey(event);
        });

        // Lưu cache tạm thời cho dữ liệu sản phẩm đang xem
        if (!View._currentProduct) View._currentProduct = null;

        // Khi chọn size
        $(document).on("click", `.product-size li`, function (event) {
            const size_id = $(this).attr("size-id");
            $(".product-size li").removeClass("is-active");
            $(this).addClass("is-active");

            View.Description.selected.size_id = size_id;
            // update UI giá theo size (và color hiện tại)
            if (View._currentProduct) {
                View.Description.updatePrices(View._currentProduct);
            }
        });

        // Khi chọn màu
        $(document).on("click", `.product-color li`, function (event) {
            const color_id = $(this).attr("color-id");
            $(".product-color li").removeClass("is-active");
            $(this).addClass("is-active");

            View.Description.selected.color_id = color_id;
            // update UI giá theo color (và size hiện tại)
            if (View._currentProduct) {
                View.Description.updatePrices(View._currentProduct);
            }
        });
    },
};

(() => {
    // Định nghĩa biến lưu lại data sản phẩm hiện tại ở ngoài
    let _productData = null;
    View.init();

    function init() {
        getProduct();
        getRelatedProduct();
    }

    function debounce(f, timeout) {
        let isLock = false;
        let timeoutID = null;
        return function (item) {
            if (!isLock) {
                f(item);
                isLock = true;
            }
            clearTimeout(timeoutID);
            timeoutID = setTimeout(function () {
                isLock = false;
            }, timeout);
        };
    }

    function getProduct() {
        Api.Product.GetOne(View.URL.get("id"))
            .done((res) => {
                if (res && res.data) {
                    // Lưu lại dữ liệu sp hiện tại
                    _productData = res.data;
                    View._currentProduct = res.data; // lưu cho event handler dùng lại
                    View.Images.render_list(res.data.images);
                    View.Description.render(res.data);
                }
            })
            .fail((err) => {})
            .always(() => {});
    }
    function getRelatedProduct() {
        Api.Product.GetRelated(View.URL.get("id"))
            .done((res) => {
                // Danh sách vẫn là mảng
                View.RelatedProduct.render(res.data);
            })
            .fail((err) => {})
            .always(() => {});
    }
    init();
})();
