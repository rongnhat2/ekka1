const LayoutView = {
	Category: {
		render_top(data){
			data.map(v => {
                $(".category-nav-list").append(`<li><a href="/category?tag=${v.id}">${v.name}</a></li>`)
            })
		}
	},
    Cart: {
        add_to_card(name, callback) {
            $(document).on("click", `.action-add-to-card`, function () {
                var atr = ($(this).attr("atr") || "").trim();
                if (atr === name) {
                    callback($(this));
                }
            });
        },
        update() {
            var cardData = localStorage.getItem("card");
            var count =
                !cardData || !String(cardData).trim()
                    ? 0
                    : String(cardData)
                          .split("-")
                          .filter(function (id) {
                              return id && id.length;
                          }).length;
            $(".cart-count").html(count);
        },
    },
    /** Đồng bộ localStorage: card (id-id), size (s,s), color (c,c), quantity (1-1) — cùng thứ tự index. */
    CartLocal: {
        read() {
            var raw = localStorage.getItem("card");
            var cards =
                !raw || !String(raw).trim()
                    ? []
                    : String(raw)
                          .split("-")
                          .map(function (s) {
                              return String(s).trim();
                          })
                          .filter(function (s) {
                              return s.length > 0;
                          });
            if (!cards.length) {
                return { cards: [], sizes: [], colors: [], qtys: [] };
            }
            var parseParallel = function (key, sep, len) {
                var v = localStorage.getItem(key);
                if (v == null || v === "") {
                    var empty = [];
                    for (var z = 0; z < len; z++) {
                        empty[z] = "";
                    }
                    return empty;
                }
                var parts = String(v)
                    .split(sep)
                    .map(function (x) {
                        return String(x).trim();
                    });
                var out = [];
                for (var i = 0; i < len; i++) {
                    out[i] = parts[i] != null && parts[i] !== "" ? parts[i] : "";
                }
                return out;
            };
            var n = cards.length;
            var sizes = parseParallel("size", ",", n);
            var colors = parseParallel("color", ",", n);
            var qRaw = localStorage.getItem("quantity");
            var qtys = [];
            if (qRaw == null || qRaw === "") {
                for (var j = 0; j < n; j++) {
                    qtys[j] = "1";
                }
            } else {
                var qParts = String(qRaw)
                    .split("-")
                    .map(function (x) {
                        return String(x).trim();
                    });
                for (var k = 0; k < n; k++) {
                    var q = qParts[k];
                    var nq = parseInt(q, 10);
                    qtys[k] =
                        !isNaN(nq) && nq > 0 ? String(nq) : "1";
                }
            }
            return { cards: cards, sizes: sizes, colors: colors, qtys: qtys };
        },
        write(cards, sizes, colors, qtys) {
            if (!cards.length) {
                localStorage.removeItem("card");
                localStorage.removeItem("size");
                localStorage.removeItem("color");
                localStorage.removeItem("quantity");
                return;
            }
            localStorage.setItem("card", cards.join("-"));
            localStorage.setItem("size", sizes.join(","));
            localStorage.setItem("color", colors.join(","));
            localStorage.setItem("quantity", qtys.join("-"));
        },
        /**
         * Lấy size/color đang chọn từ trang chi tiết; bắt buộc nếu có tùy chọn tương ứng.
         * $btn: nút .action-add-to-card
         */
        readVariationFromButton($btn) {
            var $root = $btn.closest(".single-pro-content");
            if (!$root.length) {
                $root = $(".single-pro-content").first();
            }
            var needSize = $root.find(".product-size li").length > 0;
            var needColor = $root.find(".product-color li").length > 0;
            var sizeId = $root
                .find(".product-size .is-active")
                .attr("size-id");
            var colorId = $root
                .find(".product-color .is-active")
                .attr("color-id");
            return {
                needSize: needSize,
                needColor: needColor,
                sizeId: sizeId && String(sizeId) ? String(sizeId) : "",
                colorId: colorId && String(colorId) ? String(colorId) : "",
            };
        },
        showVariantAlert(msg) {
            var $row = $(".ec-pro-variation").first();
            if (!$row.length) {
                $row = $(".ec-pro-variation-size");
            }
            if (!$row.length) {
                $row = $(".ec-pro-variation-color");
            }
            $row.find(".alert").remove();
            if (msg) {
                $row.append(
                    '<div class="alert alert-danger" role="alert">' +
                        msg +
                        "</div>",
                );
            }
        },
        addFromButton($btn) {
            var dataId = $btn.attr("data-id");
            if (dataId == null || dataId === "") {
                return false;
            }
            dataId = String(dataId);
            var v = LayoutView.CartLocal.readVariationFromButton($btn);
            if (v.needSize && !v.sizeId) {
                LayoutView.CartLocal.showVariantAlert("Hãy chọn size");
                return false;
            }
            if (v.needColor && !v.colorId) {
                LayoutView.CartLocal.showVariantAlert("Hãy chọn màu");
                return false;
            }
            LayoutView.CartLocal.showVariantAlert("");

            var st = LayoutView.CartLocal.read();
            var idx = st.cards.indexOf(dataId);
            if (idx > -1) {
                var prev = parseInt(st.qtys[idx], 10) || 1;
                st.qtys[idx] = String(prev + 1);
                st.sizes[idx] = v.sizeId;
                st.colors[idx] = v.colorId;
            } else {
                st.cards.push(dataId);
                st.sizes.push(v.sizeId);
                st.colors.push(v.colorId);
                st.qtys.push("1");
            }
            LayoutView.CartLocal.write(
                st.cards,
                st.sizes,
                st.colors,
                st.qtys,
            );
            $btn.text("✔ đã thêm");
            return true;
        },
    },
    onPushSearch(){
        var search_data = LayoutView.toSlug($(".product-search-field").val());
        return `keyword=${search_data}`
    },
    toSlug(title){
        slug = title.toLowerCase();
        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, " - ");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        return slug;
    },
};
(() => { 
    $(document).on('click', '[modal-control]', function() {
        var name = $(this).attr('modal-control')
        $(`.I-modal[modal-block=${name}]`).addClass('active');
        $("html").addClass("o-hidden")
    });
    $(document).mouseup(function(e) {
        var container = $(".modal-dialog");
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            $('.I-modal').removeClass('active');
            $("html").removeClass("o-hidden")
        }
    });
    function init(){ 
        getCategory(); 
        LayoutView.Cart.update();
    }
    function getCategory(){
        Api.Category.GetAll()
            .done(res => {
                LayoutView.Category.render_top(res.data);
            })
            .fail(err => {  })
            .always(() => { });
    }
    LayoutView.Cart.add_to_card("Add to card", function (item) {
        if (LayoutView.CartLocal.addFromButton(item)) {
            LayoutView.Cart.update();
        }
    });
    $(document).on('click', '.header-search-button', function() {
        window.location.href = `/category?${LayoutView.onPushSearch()}` ;
    });
    init()
})();